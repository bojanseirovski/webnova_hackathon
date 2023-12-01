<?php
require_once 'autoload.php';

use Exodus\SDK;

$username = "testuser123";
$baseUrl = "";
$apiKey = "";
$noradId = 1;
$lon = '-79.6';
$lat = '43.7';
$net = '2023-03-01 00:00:00';
$nlt = '2023-03-04 00:00:00';
$missionType = 'Hyperspectral';
$missionDescription = 'Test Mission';

const AWS_S3_ACCESS_KEY = '';
const AWS_S3_SECRET_KEY = '';
const AWS_S3_BUCKET = 'exodusorbitals';


$satAPI = new SDK($username, $apiKey, $baseUrl);

// get available satellites
$satellites = $satAPI->getSatellites();
// get available instruments for the satellite with norad_id
$instruments = $satAPI->getInstruments($noradId);

// get times on target
$times = $satAPI->getTimesOnTarget($noradId,1,$lat, $lon,$nlt, $net);

// create a mission, schedule data retrieval according to the date_available value
$mission = $satAPI->createMission($missionType, $noradId, 1, $lat, $lon, $nlt, $net, $missionDescription);

$dataKey = $mission->getDataKey();
$dateAvailable = $mission->getDateAvailable();
//  wait 2 seconds for S3
sleep(2);
//  get the data information
$dataDownload = $satAPI->getDataDownload($dataKey);

// download an archive with the mission data
var_dump($dataDownload->getDataUrl());

$file_name = basename(parse_url($dataDownload->getDataUrl(), PHP_URL_PATH));
var_dump($file_name);
// download data from S3
use Aws\S3\S3Client;
$region = 'us-east-2';
$version = 'latest';

$s3client = new S3Client([
    'region' => $region,
    'version' => $version,
    'credentials' => [
        'key' => AWS_S3_ACCESS_KEY,
        'secret' => AWS_S3_SECRET_KEY
    ]
    
]);

$file = $s3client->getObject([
    'Bucket' => AWS_S3_BUCKET,
    'Key' => 'downlink/'.$file_name,
]);
$body = $file->get('Body');
var_dump($file);
// save the file
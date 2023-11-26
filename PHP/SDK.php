<?php
/**
 * SDK for the satellite API
 *
 * Bojan Seirovski
 * bojan.seirovski@exodusorbitals.com
 * Exodus Orbitals
 */
namespace Exodus;

use Exodus\src\BaseSdk;
use Exodus\src\RequestType;
use Exodus\Response\Satellite;
use Exodus\Response\Instrument;
use Exodus\Response\DataDownload;
use Exodus\Response\TimesOnTarget;
use Exodus\Response\Mission;

class SDK extends BaseSdk
{
    /**
     * constructor
     *
     * @param string $username
     * @param string $apiKey
     * @param string $baseUrl
     */
    public function __construct(string $username, string $apiKey, string $baseUrl)
    {
        $this->baseUrl = $baseUrl;
        parent::__construct($username, $apiKey);
    }

    /**
     * getSatellites
     *
     * @return array[Satellite]
     */
    public function getSatellites(): array
    {
        $endpoint = "satellites";
        $satellitesJson = $this->makeRequest($endpoint, RequestType::GET);
        return $this->getSatelliteObjects($satellitesJson);
    }

    /**
     * getInstruments
     *
     * @param integer $noradId
     * @return array
     */
    public function getInstruments(int $noradId): array
    {
        $endpoint = "instruments";
        $data = [
            "norad_id" => $noradId,
        ];
        $instrumentJson = $this->makeRequest($endpoint, RequestType::GET, $data);
        return $this->getInstrumentObjects($instrumentJson);
    }

    /**
     * getTimesOnTarget
     *
     * @param integer $noradId
     * @param integer $instrumentId
     * @param string $lat
     * @param string $lng
     * @param string $nlt
     * @param string $net
     * @return array
     */
    public function getTimesOnTarget(int $noradId, int $instrumentId, string $lat, string $lng, string $nlt, string $net): array
    {
        $endpoint = "times_on_target";
        $data = [
            "norad_id" => $noradId,
            "instrument_id" => $instrumentId,
            "lat" => $lat,
            "lng" => $lng,
            "nlt" => $nlt,
            "net" => $net,
        ];

        $jsonTimes = $this->makeRequest($endpoint, RequestType::GET, $data);
        return $this->getTimesOnTargetObj($jsonTimes);
    }

    /**
     * createMission
     *
     * @param string $user
     * @param string $missionType
     * @param integer $noradId
     * @param integer $instrumentId
     * @param string $lat
     * @param string $lng
     * @param string $nlt
     * @param string $net
     * @param string $description
     * @return Mission
     */
    public function createMission(string $missionType, int $noradId, int $instrumentId, string $lat, string $lng, string $nlt, string $net, string $description): Mission
    {
        $endpoint = "create_mission";
        $data = [
            "api_key" => $this->apiKey,
            "user"=>$this->username,
            "norad_id" => $noradId,
            "instrument_id" => $instrumentId,
            "lat" => $lat,
            "lon" => $lng,
            "nlt" => $nlt,
            "net" => $net,
            "mission_type"=>$missionType,
            "description" => $description,
        ];
        $jsonMission = $this->makeRequest($endpoint, RequestType::POST, $data);

        return $this->getMissionObj($jsonMission);
    }

    /**
     * getDataDownload
     *
     * @param string $dataKey
     * @return DataDownload
     */
    public function getDataDownload(string $dataKey): DataDownload
    {
        $endpoint = "data_download";
        $data = [
            "user" => $this->username,
            "api_key" => $this->apiKey,
            "data_key" => $dataKey,
        ];
        $jsonDataDownload = $this->makeRequest($endpoint, RequestType::GET, $data);
        return $this->getDataDownloadObj($jsonDataDownload);
    }

    /**
     * getSatelliteObjects
     *
     * @param array $resp
     * @return array
     */
    private function getSatelliteObjects(array $resp): array
    {
        $satObjects = [];
        foreach ($resp as $sat) {
            $satOb = new Satellite($sat->description, $sat->name, $sat->norad_id, $sat->tle1, $sat->tle2, $sat->type);
            $satObjects[] = $satOb;
        }
        return $satObjects;
    }

    /**
     * getInstrumentObjects
     *
     * @param array $resp
     * @return array
     */
    private function getInstrumentObjects(array $resp): array
    {
        $instrumentObjects = [];
        foreach ($resp[0]->instruments as $inst) {
            $instOb = new Instrument($inst->d, $inst->f, $inst->fov, $inst->id, $inst->pixel, $inst->sensor, $inst->type);
            $instrumentObjects[] = $instOb;
        }
        return $instrumentObjects;
    }

    /**
     * getTimesOnTargetObj
     *
     * @param array|\stdClass $resp
     * @return array
     */
    private function getTimesOnTargetObj(array|\stdClass $resp): array
    {
        $allTmsObj = [];
        foreach ($resp->target_passes as $times) {
            $tms = new TimesOnTarget($times[0], $times[1]);
            $allTmsObj[] = $tms;
        }
        return $allTmsObj;
    }

    /**
     * getMissionObj
     *
     * @param \stdClass $resp
     * @return Exodus\Response\Mission
     */
    private function getMissionObj($resp): Mission
    {
        return new Mission($resp->data_key[0], $resp->date_available[0], $resp->status);
    }

    /**
     * getDataDownloadObj
     *
     * @param \stdClass $resp
     * @return DataDownload
     */
    private function getDataDownloadObj($resp): DataDownload
    {
        return new DataDownload($resp->data_url, $resp->logs_url, $resp->status);
    }
}
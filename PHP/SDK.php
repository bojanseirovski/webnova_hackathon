<?php

namespace Exodus;

use Exodus\src\BaseSdk;
use Exodus\src\RequestType;

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
     * @return array
     */
    public function getSatellites(): array
    {
        $endpoint = "satellites";
        return $this->makeRequest($endpoint, RequestType::GET);

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
        return $this->makeRequest($endpoint, RequestType::GET, $data);

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
        return $this->makeRequest($endpoint, RequestType::GET, $data);

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
     * @return array
     */
    public function createMission(string $missionType, int $noradId, int $instrumentId, string $lat, string $lng, string $nlt, string $net, string $description): array
    {
        $endpoint = "create_mission";
        $data = [
            "api_key" => $this->apiKey,
            "user"=>$this->username,
            "norad_id" => $noradId,
            "instrument_id" => $instrumentId,
            "lat" => $lat,
            "lng" => $lng,
            "nlt" => $nlt,
            "net" => $net,
            "mission_type"=>$missionType,
            "description" => $description,
        ];
        return $this->makeRequest($endpoint, RequestType::POST, $data);

    }

    /**
     * getDataDownload
     *
     * @param string $dataKey
     * @return array
     */
    public function getDataDownload(string $dataKey): array
    {
        $endpoint = "data_download";
        $data = [
            "user" => $this->username,
            "api_key" => $this->apiKey,
            "data_key" => $dataKey,
        ];
        return $this->makeRequest($endpoint, RequestType::GET, $data);

    }

}
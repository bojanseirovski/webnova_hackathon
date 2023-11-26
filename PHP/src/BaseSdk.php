<?php
/**
 * SDK for the satellite API
 * Base SDK, curl calls
 * Bojan Seirovski
 * bojan.seirovski@exodusorbitals.com
 * Exodus Orbitals
 */
namespace Exodus\src;

use Exodus\Exception\ExodusException;
use Exodus\Exception\ExodusInvalidResponse;


class BaseSdk
{
    protected $headers = [
        'Content-Type:application/json',
    ];

    /**
     * API KEY
     *
     * @var string
     */
    protected $apiKey;

    /**
     * user name
     *
     * @var string
     */
    protected $username;

    /**
     * base API url
     *
     * @var string
     */
    protected $baseUrl;

    public function __construct(string $username, string $apiKey)
    {
        $this->apiKey = $apiKey;
        $this->username = $username;
    }

    /**
     * makeRequest
     *
     * @param string $endpoint
     * @param string $type
     * @param array $data
     * @return array|\stdClass
     */
    protected function makeRequest(string $endpoint, string $type, array $data = []): array|\stdClass
    {
        $url = $this->baseUrl . $endpoint;
        $response = [];
        try {
            $resp = $this->doCurl($url, $type, $data);
            if (!$this->validateResponse($resp)) {
                throw new ExodusInvalidResponse("Invalid response");
            }
            $response = json_decode($resp);
        } catch (ExodusException $ee) {
            echo "Exodus error - ".$ee->getMessage();
        }
        return $response;
    }

    /**
     * doCurl
     *
     * @param string $url
     * @param string $type
     * @param array $data
     * @return string
     */
    private function doCurl(string $url, string $type, array $data): string
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POST, 0);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $this->headers);

        if ($type === RequestType::POST) {
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POST, strlen(json_encode($data)));
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        }
        if ($type === RequestType::GET) {
            $url = sprintf("%s?%s", $url, http_build_query($data));
        }
        curl_setopt($ch, CURLOPT_URL, $url);
        $result = curl_exec($ch);
        $curl_error = curl_error($ch);

        curl_close($ch);

        if (!empty($curl_error)) {
            throw new ExodusException($curl_error);
        }
        return $result;
    }

    /**
     * validateResponse
     *
     * @param string $resp
     * @return boolean
     */
    private function validateResponse(string $resp): bool
    {
        return !empty($resp) && is_string($resp) && is_array(json_decode($resp, true)) && json_last_error() == 0;
    }
}

<?php

namespace Exodus\src;

use Exodus\Exception\ExodusException;
use Exodus\Exception\ExodusInvalidResponse;


class BaseSdk
{
    protected $headers = [
        'Content-Type' => 'application/json',
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
     * @return array
     */
    protected function makeRequest(string $endpoint, string $type, array $data = []): array
    {
        $url = $this->baseUrl . $endpoint;
        $response = [];
        try {
            $resp = $this->doCurl($url, $type, $data);
            if (!$this->validateResponse($resp)) {
                throw new ExodusInvalidResponse();
            }
            $response = json_decode($resp);
        } catch (ExodusException $ee) {
            
        } catch (\Exception $e) {

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
        if ($type === RequestType::POST) {
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POST, count($data));
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        }
        if ($type === RequestType::GET) {
            $url = sprintf("%s?%s", $url, http_build_query($data));
        }
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $this->headers);
        curl_setopt($ch, CURLOPT_URL, $url);
        $result = curl_exec($ch);
        curl_close($ch);

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
        return !empty($string) && is_string($string) && is_array(json_decode($string, true)) && json_last_error() == 0;
    }
}

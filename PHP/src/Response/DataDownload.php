<?php
/**
 * SDK for the satellite API
 * Data download response class
 * Bojan Seirovski
 * bojan.seirovski@exodusorbitals.com
 * Exodus Orbitals
 */
namespace Exodus\Response;

class DataDownload 
{
    /** @var string */
    private $dataUrl;

    /** @var string */
    private $status;

    /** @var string */
    private $logsUrl;

    /**
     * construct
     *
     * @param string $dataUrl
     * @param string $logsUrl
     * @param string $status
     */
    public function __construct(string $dataUrl, string $logsUrl, string $status)
    {
        $this->dataUrl = $dataUrl;
        $this->logsUrl = $logsUrl;
        $this->status = $status;
    }
    

    /**
     * Get the value of dataUrl
     * @return string
     */ 
    public function getDataUrl(): string
    {
        return $this->dataUrl;
    }

    /**
     * Get the value of status
     * @return string
     */ 
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * Get the value of logsUrl
     * @return string
     */ 
    public function getLogsUrl(): string
    {
        return $this->logsUrl;
    }
}

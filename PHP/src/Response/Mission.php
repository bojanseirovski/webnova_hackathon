<?php
/**
 * SDK for the satellite API
 * Create mission response class
 * Bojan Seirovski
 * bojan.seirovski@exodusorbitals.com
 * Exodus Orbitals
 */
namespace Exodus\Response;

class Mission
{
    /** @var string */
    private $dataKey;

    /** @var string */
    private $dateAvailable;

    /** @var string */
    private $status;

    /**
     * constructor
     *
     * @param string $dataKey
     * @param string $dateAvailable
     * @param string $status
     */
    public function __construct(string $dataKey, string $dateAvailable, string $status)
    {
        $this->dataKey = $dataKey;
        $this->dateAvailable = $dateAvailable;
        $this->status = $status;
        
    }

    /**
     * Get the value of dataKey
     * @return string
     */ 
    public function getDataKey(): string
    {
        return $this->dataKey;
    }

    /**
     * Get the value of dateAvailable
     * @return string
     */ 
    public function getDateAvailable(): string
    {
        return $this->dateAvailable;
    }

    /**
     * Get the value of status
     * @return string
     */ 
    public function getStatus(): string
    {
        return $this->status;
    }
}
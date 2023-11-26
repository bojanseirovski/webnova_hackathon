<?php
/**
 * SDK for the satellite API
 * Times on target response class
 * Bojan Seirovski
 * bojan.seirovski@exodusorbitals.com
 * Exodus Orbitals
 */
namespace Exodus\Response;

class TimesOnTarget
{
    /** @var string */
    private $startTime;
    /** @var string */
    private $endTime;

    /**
     * construct
     *
     * @param string $startTime
     * @param string $endTime
     */
    public function __construct(string $startTime, string $endTime)
    {
        $this->startTime = $startTime;
        $this->endTime = $endTime;
    }


    /**
     * Get the value of startTime
     * @return string
     */ 
    public function getStartTime(): string
    {
        return $this->startTime;
    }

    /**
     * Get the value of endTime
     * @return string
     */ 
    public function getEndTime(): string
    {
        return $this->endTime;
    }
}
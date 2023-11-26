<?php

/**
 * SDK for the satellite API
 * Satellite instruments response class
 * Bojan Seirovski
 * bojan.seirovski@exodusorbitals.com
 * Exodus Orbitals
 */

namespace Exodus\Response;

class Instrument
{
    /** @var float */
    private $d;

    /** @var float */
    private $f;

    /** @var float */
    private $fov;

    /** @var int */
    private $id;

    /** @var int */
    private $pixel;

    /** @var array */
    private $sensor;

    /** @var string */
    private $type;

    /**
     * construct
     *
     * @param float $d
     * @param float $f
     * @param float $fov
     * @param integer $id
     * @param integer $pixel
     * @param array $sensor
     * @param string $type
     */
    public function __construct(float $d, float $f, float $fov, int $id, int $pixel, array $sensor, string $type)
    {
        $this->d = $d;
        $this->f = $f;
        $this->fov = $fov;
        $this->id = $id;
        $this->pixel = $pixel;
        $this->sensor = $sensor;
        $this->type = $type;
    }

    /**
     * Get the value of d
     * @return float
     */
    public function getD(): float
    {
        return $this->d;
    }

    /**
     * Get the value of f
     * @return float
     */
    public function getF(): float
    {
        return $this->f;
    }

    /**
     * Get the value of fov
     * @return float
     */
    public function getFov(): float
    {
        return $this->fov;
    }

    /**
     * Get the value of id
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Get the value of pixel
     * @return float
     */
    public function getPixel(): float
    {
        return $this->pixel;
    }

    /**
     * Get the value of sensor
     * @return array
     */
    public function getSensor(): array
    {
        return $this->sensor;
    }

    /**
     * Get the value of type
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }
}

<?php
/**
 * SDK for the satellite API
 * Satellite information response class
 *
 * Bojan Seirovski
 * bojan.seirovski@exodusorbitals.com
 * Exodus Orbitals
 */
namespace Exodus\Response;

class Satellite
{
    /** @var string */
    private $description;

    /** @var string */
    private $name;

    /** @var int */
    private $noradId;

    /** @var string */
    private $tle1;

    /** @var string */
    private $tle2;

    /** @var string */
    private $type;

    /**
     * construct
     *
     * @param string $description
     * @param string $name
     * @param integer $noradId
     * @param string $tle1
     * @param string $tle2
     * @param string $type
     */
    public function __construct(string $description, string $name, int $noradId, string $tle1, string $tle2, string $type)
    {
        $this->description = $description;
        $this->name = $name;
        $this->noradId = $noradId;
        $this->tle1 = $tle1;
        $this->tle2 = $tle2;
        $this->type = $type;
    }

    /**
     * Get the value of description
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * Get the value of name
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Get the value of noradId
     * @return int
     */
    public function getNoradId(): int
    {
        return $this->noradId;
    }

    /**
     * Get the value of tle1
     * @return string
     */
    public function getTle1(): string
    {
        return $this->tle1;
    }

    /**
     * Get the value of tle2
     * @return string
     */
    public function getTle2(): string
    {
        return $this->tle2;
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

<?php
/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 */

namespace SnelstartPHP\Model\V2;

use SnelstartPHP\Model\SnelstartObject;
use SnelstartPHP\Model\Type\Dagboeksoort;

class Dagboek extends SnelstartObject
{
    /**
     * De omschrijving van het dagboek.
     *
     * @var string|null
     */
    private $omschrijving;

    /**
     * Het dagboek soort.
     *
     * @var Dagboeksoort|null
     */
    private $soort;

    /**
     * Een vlag dat aangeeft of het dagboek niet meer actief is binnen de administratie.
     * Indien true, dan kan het dagboek als "verwijderd" worden beschouwd.
     *
     * @var bool|null
     */
    private $nonactief;

    /**
     * Het nummer van het dagboek.
     *
     * @var int|null
     */
    private $nummer;

    public function getOmschrijving(): ?string
    {
        return $this->omschrijving;
    }

    public function setOmschrijving(string $omschrijving): self
    {
        $this->omschrijving = $omschrijving;

        return $this;
    }

    public function getSoort(): ?Dagboeksoort
    {
        return $this->soort;
    }

    public function setSoort(Dagboeksoort $soort): self
    {
        $this->soort = $soort;

        return $this;
    }

    public function isNonactief(): ?bool
    {
        return $this->nonactief;
    }

    public function setNonactief(bool $nonactief): self
    {
        $this->nonactief = $nonactief;

        return $this;
    }

    public function getNummer(): ?int
    {
        return $this->nummer;
    }

    public function setNummer(int $nummer): self
    {
        $this->nummer = $nummer;

        return $this;
    }
}

<?php
/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 */

namespace SnelstartPHP\Model\V2;

use Money\Money;
use SnelstartPHP\Model\Kostenplaats;
use SnelstartPHP\Model\SnelstartObject;

class Grootboekmutatie extends SnelstartObject
{
    /**
     * De gegevenscontainer voor een grootboekreferentie.
     *
     * @var Grootboek|null
     */
    private $grootboek;

    /**
     * De gegevenscontainer voor een kostenplaats referentie.
     *
     * @var Kostenplaats|null
     */
    private $kostenplaats;

    /**
     * Datum
     *
     * @var \DateTimeInterface|null
     */
    private $datum;

    /**
     * Datum aangemaakt of voor het laatst gewijzigd.
     *
     * @var \DateTimeInterface|null
     */
    private $modifiedOn;

    /**
     * De gegevenscontainer voor een Dagboekreferentie.
     *
     * @var Dagboek|null
     */
    private $dagboek;

    /**
     * De omschrijving.
     *
     * @var string|null
     */
    private $omschrijving;

    /**
     * Debet
     *
     * @var Money|null
     */
    private $debet;

    /**
     * Credit
     *
     * @var Money|null
     */
    private $credit;

    /**
     * Waarde Debet - Credit
     *
     * @var Money|null
     */
    private $saldo;

    /**
     * De bijlagen van deze grootboekmutatie.
     *
     * @var Document[]
     */
    private $documents = [];

    /**
     * Boekstuk
     *
     * @var string|null
     */
    private $boekstuk;

    /**
     * FactuurNummer
     *
     * @var string|null
     */
    private $factuurNummer;

    /**
     * De gegevenscontainer voor een relatie.
     *
     * @var Relatie|null
     */
    private $relatiePublicIdentifier;

    public function getGrootboek(): ?Grootboek
    {
        return $this->grootboek;
    }

    public function setGrootboek(?Grootboek $grootboek): self
    {
        $this->grootboek = $grootboek;

        return $this;
    }

    public function getKostenplaats(): ?Kostenplaats
    {
        return $this->kostenplaats;
    }

    public function setKostenplaats(?Kostenplaats $kostenplaats): self
    {
        $this->kostenplaats = $kostenplaats;

        return $this;
    }

    public function getDatum(): ?\DateTimeInterface
    {
        return $this->datum;
    }

    public function setDatum(?\DateTimeInterface $datum): self
    {
        $this->datum = $datum;

        return $this;
    }

    public function getModifiedOn(): ?\DateTimeInterface
    {
        return $this->modifiedOn;
    }

    public function setModifiedOn(?\DateTimeInterface $modifiedOn): self
    {
        $this->modifiedOn = $modifiedOn;

        return $this;
    }

    public function getDagboek(): ?Dagboek
    {
        return $this->dagboek;
    }

    public function setDagboek(?Dagboek $dagboek): self
    {
        $this->dagboek = $dagboek;

        return $this;
    }

    public function getOmschrijving(): ?string
    {
        return $this->omschrijving;
    }

    public function setOmschrijving(?string $omschrijving): self
    {
        $this->omschrijving = $omschrijving;

        return $this;
    }

    public function getDebet(): ?Money
    {
        return $this->debet;
    }

    public function setDebet(?Money $debet): self
    {
        $this->debet = $debet;

        return $this;
    }

    public function getCredit(): ?Money
    {
        return $this->credit;
    }

    public function setCredit(?Money $credit): self
    {
        $this->credit = $credit;

        return $this;
    }

    public function getSaldo(): ?Money
    {
        return $this->saldo;
    }

    public function setSaldo(?Money $saldo): self
    {
        $this->saldo = $saldo;

        return $this;
    }

    /**
     * @return Document[]
     */
    public function getDocuments(): array
    {
        return $this->documents;
    }

    /**
     * @param Document[] $documents
     */
    public function setDocuments(array $documents): self
    {
        $this->documents = $documents;

        return $this;
    }

    public function getBoekstuk(): ?string
    {
        return $this->boekstuk;
    }

    public function setBoekstuk(?string $boekstuk): self
    {
        $this->boekstuk = $boekstuk;

        return $this;
    }

    public function getFactuurNummer(): ?string
    {
        return $this->factuurNummer;
    }

    public function setFactuurNummer(?string $factuurNummer): self
    {
        $this->factuurNummer = $factuurNummer;

        return $this;
    }

    public function getRelatiePublicIdentifier(): ?Relatie
    {
        return $this->relatiePublicIdentifier;
    }

    public function setRelatiePublicIdentifier(?Relatie $relatiePublicIdentifier): self
    {
        $this->relatiePublicIdentifier = $relatiePublicIdentifier;

        return $this;
    }
}

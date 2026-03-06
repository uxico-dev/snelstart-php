<?php
/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 */

namespace SnelstartPHP\Mapper\V2;

use Psr\Http\Message\ResponseInterface;
use Ramsey\Uuid\Uuid;
use SnelstartPHP\Mapper\AbstractMapper;
use SnelstartPHP\Model\Kostenplaats;
use SnelstartPHP\Model\V2 as Model;

class GrootboekmutatieMapper extends AbstractMapper
{
    public function find(ResponseInterface $response): Model\Grootboekmutatie
    {
        $this->setResponseData($response);
        return $this->mapResultToGrootboekmutatieModel(new Model\Grootboekmutatie());
    }

    public function findAll(ResponseInterface $response): \Generator
    {
        $this->setResponseData($response);
        yield from $this->mapManyResultsToSubMappers();
    }

    protected function mapResultToGrootboekmutatieModel(Model\Grootboekmutatie $grootboekmutatie, array $data = []): Model\Grootboekmutatie
    {
        $data = empty($data) ? $this->responseData : $data;

        /**
         * @var Model\Grootboekmutatie $grootboekmutatie
         */
        $grootboekmutatie = $this->mapArrayDataToModel($grootboekmutatie, $data);

        if (isset($data["grootboek"]["id"])) {
            $grootboekmutatie->setGrootboek(Model\Grootboek::createFromUUID(Uuid::fromString($data["grootboek"]["id"])));
        }

        if (isset($data["kostenplaats"]["id"])) {
            $grootboekmutatie->setKostenplaats(Kostenplaats::createFromUUID(Uuid::fromString($data["kostenplaats"]["id"])));
        }

        if (isset($data["dagboek"]["id"])) {
            $grootboekmutatie->setDagboek(Model\Dagboek::createFromUUID(Uuid::fromString($data["dagboek"]["id"])));
        }

        if (isset($data["debet"])) {
            $grootboekmutatie->setDebet($this->getMoney($data["debet"]));
        }

        if (isset($data["credit"])) {
            $grootboekmutatie->setCredit($this->getMoney($data["credit"]));
        }

        if (isset($data["saldo"])) {
            $grootboekmutatie->setSaldo($this->getMoney($data["saldo"]));
        }

        if (isset($data["documents"])) {
            $documents = [];
            foreach ($data["documents"] as $document) {
                $documents[] = $this->mapArrayDataToModel(new Model\Document(), $document);
            }
            $grootboekmutatie->setDocuments($documents);
        }

        if (isset($data["relatiePublicIdentifier"]["id"])) {
            $grootboekmutatie->setRelatiePublicIdentifier(
                Model\Relatie::createFromUUID(Uuid::fromString($data["relatiePublicIdentifier"]["id"]))
            );
        }

        return $grootboekmutatie;
    }

    protected function mapManyResultsToSubMappers(): \Generator
    {
        foreach ($this->responseData as $grootboekmutatieData) {
            yield $this->mapResultToGrootboekmutatieModel(new Model\Grootboekmutatie(), $grootboekmutatieData);
        }
    }
}

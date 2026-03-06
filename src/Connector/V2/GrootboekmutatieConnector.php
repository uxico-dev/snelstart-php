<?php
/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 */

namespace SnelstartPHP\Connector\V2;

use Ramsey\Uuid\UuidInterface;
use SnelstartPHP\Connector\BaseConnector;
use SnelstartPHP\Exception\SnelstartResourceNotFoundException;
use SnelstartPHP\Mapper\V2 as Mapper;
use SnelstartPHP\Model\V2 as Model;
use SnelstartPHP\Request\ODataRequestData;
use SnelstartPHP\Request\V2 as Request;
use SnelstartPHP\Request\ODataRequestDataInterface;

class GrootboekmutatieConnector extends BaseConnector
{
    public function find(UuidInterface $id): ?Model\Grootboekmutatie
    {
        try {
            $mapper = new Mapper\GrootboekmutatieMapper();
            $request = new Request\GrootboekmutatieRequest();

            return $mapper->find($this->connection->doRequest($request->find($id)));
        } catch (SnelstartResourceNotFoundException $e) {
            return null;
        }
    }

    /**
     * @return iterable<Model\Grootboekmutatie>
     */
    public function findAll(?ODataRequestDataInterface $ODataRequestData = null, bool $fetchAll = false, iterable $previousResults = null): iterable
    {
        $request = new Request\GrootboekmutatieRequest();
        $mapper = new Mapper\GrootboekmutatieMapper();
        $ODataRequestData = $ODataRequestData ?? new ODataRequestData();
        $hasItems = false;

        foreach ($mapper->findAll($this->connection->doRequest($request->findAll($ODataRequestData))) as $grootboekmutatie) {
            $hasItems = true;
            yield $grootboekmutatie;
        }

        if ($fetchAll && $hasItems) {
            if ($previousResults === null) {
                $ODataRequestData->setSkip($ODataRequestData->getTop());
            } else {
                $ODataRequestData->setSkip($ODataRequestData->getSkip() + $ODataRequestData->getTop());
            }

            yield from $this->findAll($ODataRequestData, true, []);
        }
    }
}

<?php
/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 */

namespace SnelstartPHP\Connector\V2;

use SnelstartPHP\Connector\BaseConnector;
use SnelstartPHP\Mapper\V2 as Mapper;
use SnelstartPHP\Model\V2 as Model;
use SnelstartPHP\Request\ODataRequestData;
use SnelstartPHP\Request\V2 as Request;
use SnelstartPHP\Request\ODataRequestDataInterface;

class DagboekConnector extends BaseConnector
{
    /**
     * @return iterable<Model\Dagboek>
     */
    public function findAll(?ODataRequestDataInterface $ODataRequestData = null, bool $fetchAll = false, iterable $previousResults = null): iterable
    {
        $request = new Request\DagboekRequest();
        $mapper = new Mapper\DagboekMapper();
        $ODataRequestData = $ODataRequestData ?? new ODataRequestData();
        $count = 0;

        foreach ($mapper->findAll($this->connection->doRequest($request->findAll($ODataRequestData))) as $dagboek) {
            $count++;
            yield $dagboek;
        }

        if ($fetchAll && $count >= $ODataRequestData->getTop()) {
            if ($previousResults === null) {
                $ODataRequestData->setSkip($ODataRequestData->getTop());
            } else {
                $ODataRequestData->setSkip($ODataRequestData->getSkip() + $ODataRequestData->getTop());
            }

            yield from $this->findAll($ODataRequestData, true, []);
        }
    }
}

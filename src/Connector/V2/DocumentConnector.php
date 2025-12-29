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
use SnelstartPHP\Request\V2 as Request;

class DocumentConnector extends BaseConnector
{
    public function find(UuidInterface $uuid): ?Model\Document
    {
        $documentRequest = new Request\DocumentRequest();
        $documentMapper = new Mapper\DocumentMapper();

        try {
            return $documentMapper->find($this->connection->doRequest($documentRequest->find($uuid)));
        } catch (SnelstartResourceNotFoundException $e) {
            return null;
        }
    }
}

<?php
/**
 * @author  OptiWise Technologies B.V. <info@optiwise.nl>
 * @project SnelstartApiPHP
 */

namespace SnelstartPHP\Connector\V2;

use Ramsey\Uuid\UuidInterface;
use SnelstartPHP\Connector\BaseConnector;
use SnelstartPHP\Exception\PreValidationException;
use SnelstartPHP\Exception\SnelstartResourceNotFoundException;
use SnelstartPHP\Mapper\V2\VerkooporderMapper;
use SnelstartPHP\Model\V2\Verkooporder;
use SnelstartPHP\Request\V2\VerkooporderRequest;

class VerkooporderConnector extends BaseConnector
{
    public function find(UuidInterface $id): ?Verkooporder
    {
        try {
            $verkooporderMapper = new VerkooporderMapper();
            $verkooporderRequest = new VerkooporderRequest();

            return $verkooporderMapper->find($this->connection->doRequest($verkooporderRequest->find($id)));
        } catch (SnelstartResourceNotFoundException $e) {
            return null;
        }
    }


    public function add(Verkooporder $verkooporder): Verkooporder
    {
        if ($verkooporder->getId() !== null) {
            throw PreValidationException::unexpectedIdException();
        }

        $verkooporderMapper = new VerkooporderMapper();
        $verkooporderRequest = new VerkooporderRequest();

        return $verkooporderMapper->add($this->connection->doRequest($verkooporderRequest->add($verkooporder)));
    }

    public function delete(Verkooporder $verkooporder): void
    {
        if ($verkooporder->getId() !== null) {
            throw PreValidationException::shouldHaveAnIdException();
        }

        $verkooporderMapper = new VerkooporderMapper();
        $verkooporderRequest = new VerkooporderRequest();

        $verkooporderMapper->delete($this->connection->doRequest($verkooporderRequest->delete($verkooporder)));
    }
}

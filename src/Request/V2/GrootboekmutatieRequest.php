<?php
/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 */

namespace SnelstartPHP\Request\V2;

use GuzzleHttp\Psr7\Request;
use Psr\Http\Message\RequestInterface;
use Ramsey\Uuid\UuidInterface;
use SnelstartPHP\Request\BaseRequest;
use SnelstartPHP\Request\ODataRequestDataInterface;

class GrootboekmutatieRequest extends BaseRequest
{
    public function findAll(ODataRequestDataInterface $ODataRequestData): RequestInterface
    {
        return new Request("GET", "grootboekmutaties?" . $ODataRequestData->getHttpCompatibleQueryString());
    }

    public function find(UuidInterface $id): RequestInterface
    {
        return new Request("GET", "grootboekmutaties/" . $id->toString());
    }
}

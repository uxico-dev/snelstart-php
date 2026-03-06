<?php

namespace SnelstartPHP\Tests\Request\V2;

use SnelstartPHP\Request\ODataRequestData;
use SnelstartPHP\Request\V2\DagboekRequest;
use PHPUnit\Framework\TestCase;

class DagboekRequestTest extends TestCase
{
    /**
     * @var DagboekRequest
     */
    private $dagboekRequest;

    public function setUp(): void
    {
        $this->dagboekRequest = new DagboekRequest();
    }

    public function testFindAll(): void
    {
        $ODataRequestData = new ODataRequestData();
        $request = $this->dagboekRequest->findAll($ODataRequestData);

        $this->assertEquals('GET', $request->getMethod());
        $this->assertStringStartsWith('dagboeken?', (string) $request->getUri());
    }
}

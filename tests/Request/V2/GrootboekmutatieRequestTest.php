<?php

namespace SnelstartPHP\Tests\Request\V2;

use Ramsey\Uuid\Uuid;
use SnelstartPHP\Request\ODataRequestData;
use SnelstartPHP\Request\V2\GrootboekmutatieRequest;
use PHPUnit\Framework\TestCase;

class GrootboekmutatieRequestTest extends TestCase
{
    /**
     * @var GrootboekmutatieRequest
     */
    private $grootboekmutatieRequest;

    public function setUp(): void
    {
        $this->grootboekmutatieRequest = new GrootboekmutatieRequest();
    }

    public function testFindAll(): void
    {
        $ODataRequestData = new ODataRequestData();
        $request = $this->grootboekmutatieRequest->findAll($ODataRequestData);

        $this->assertEquals('GET', $request->getMethod());
        $this->assertStringStartsWith('grootboekmutaties?', (string) $request->getUri());
    }

    public function testFind(): void
    {
        $uuid = Uuid::uuid4();
        $request = $this->grootboekmutatieRequest->find($uuid);

        $this->assertEquals('GET', $request->getMethod());
        $this->assertEquals(sprintf('%s/%s', 'grootboekmutaties', $uuid->toString()), (string) $request->getUri());
    }
}

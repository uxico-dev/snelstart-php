<?php

namespace SnelstartPHP\Tests\Mapper\V2\VerkooporderMapper;

use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use SnelstartPHP\Mapper\V2\VerkooporderMapper;
use SnelstartPHP\Utils;

class NullArtikelTest extends TestCase
{
    public function testRegelWithoutArtikelCanBeMapped(): void
    {
        $verkooporderData = [
            "id" => "9d4c47d5-54ca-4960-9a9d-4f6f74811d24",
            "relatie" => [
                "id" => "44d237a9-3bbb-4b6c-8e7c-f57665c7dc16",
            ],
            "procesStatus" => "Order",
            "incassomachtiging" => null,
            "afleveradres" => null,
            "factuuradres" => null,
            "kostenplaats" => null,
            "regels" => [[
                "artikel" => null,
                "omschrijving" => "Handmatige regel",
                "stuksprijs" => "10.00",
                "aantal" => 1,
                "kortingsPercentage" => 0,
                "totaal" => "10.00",
            ]],
            "factuurkorting" => null,
            "totaalExclusiefBtw" => null,
            "totaalInclusiefBtw" => null,
            "verkoopfactuur" => null,
            "verkoopordersjabloon" => null,
            "verkooporderBtwIngaveModel" => null,
            "verkoopOrderStatus" => null,
        ];

        $verkooporderResponse = new Response(200, [], Utils::jsonEncode($verkooporderData));

        $verkooporder = (new VerkooporderMapper())->find($verkooporderResponse);
        $regels = $verkooporder->getRegels();

        $this->assertCount(1, $regels);
        $this->assertNull($regels[0]->getArtikel());
        $this->assertSame("Handmatige regel", $regels[0]->getOmschrijving());
    }
}

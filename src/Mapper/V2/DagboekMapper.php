<?php
/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 */

namespace SnelstartPHP\Mapper\V2;

use Psr\Http\Message\ResponseInterface;
use SnelstartPHP\Mapper\AbstractMapper;
use SnelstartPHP\Model\Type\Dagboeksoort;
use SnelstartPHP\Model\V2 as Model;

class DagboekMapper extends AbstractMapper
{
    public function findAll(ResponseInterface $response): \Generator
    {
        $this->setResponseData($response);
        yield from $this->mapManyResultsToSubMappers();
    }

    protected function mapResultToDagboekModel(Model\Dagboek $dagboek, array $data = []): Model\Dagboek
    {
        $data = empty($data) ? $this->responseData : $data;

        /**
         * @var Model\Dagboek $dagboek
         */
        $dagboek = $this->mapArrayDataToModel($dagboek, $data);

        if (isset($data["soort"])) {
            $dagboek->setSoort(new Dagboeksoort($data["soort"]));
        }

        return $dagboek;
    }

    protected function mapManyResultsToSubMappers(): \Generator
    {
        foreach ($this->responseData as $dagboekData) {
            yield $this->mapResultToDagboekModel(new Model\Dagboek(), $dagboekData);
        }
    }
}

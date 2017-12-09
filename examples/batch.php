<?php

require('../vendor/autoload.php');

class PlaceDocument extends \Jaddek\ElasticPlace\Document
{
    public $index = 'place';
    public $type = 'place';
}


class PlaceBuilder extends \Jaddek\ElasticPlace\Document\Builder
{
    public function createDocument(): \Jaddek\ElasticPlace\Document
    {
        return new PlaceDocument();
    }
}

$collection = new \Jaddek\ElasticPlace\Document\Collection\BatchCollection(new \Jaddek\ElasticPlace\Query\Builder());

$builder = new PlaceBuilder();

$collection->addDocument($builder->index(['name' => 'entity name', 'address' => 'entity address']));
$collection->addDocument($builder->update(['name' => 'entity name', 'address' => 'entity address'],1));
$collection->addDocument($builder->upsert(['name' => 'entity name', 'address' => 'entity address']));
$collection->addDocument($builder->delete(1));

$client = \Elasticsearch\ClientBuilder::create()->build();

$result = $client->bulk(['body' => $collection->getDocuments()]);

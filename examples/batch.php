<?php

require('../vendor/autoload.php');

use Jaddek\ElasticPlace;

class PlaceDocument extends ElasticPlace\Document
{
    public $index = 'place';
    public $type = 'place';
}

class PlaceFactory extends ElasticPlace\Factory
{
    public function createDocument(): ElasticPlace\Document
    {
        return new PlaceDocument();
    }
}

$collection = new ElasticPlace\Collection();
$factory    = new PlaceFactory();
$builder    = new ElasticPlace\Builder();

$collection->addDocument($factory->makeIndexDocument(['name' => 'entity name', 'address' => 'entity address']));
$collection->addDocument($factory->makeUpdateDocument(['name' => 'entity name', 'address' => 'entity address'], 1));
$collection->addDocument($factory->makeUpsertDocument(['name' => 'entity name', 'address' => 'entity address']));
$collection->addDocument($factory->makeDeleteDocument(1));

$document = new ElasticPlace\Document();
$document->setBody(['name' => 'entity name', 'address' => 'entity address'])->setId(1)->setActionIndex()->setIndex('place')->setType('place');
$collection->addDocument($document);

$result = (new ElasticPlace\ClientWrapper())->bulk($collection);





<?php

require('../vendor/autoload.php');

$data = ['name' => 'entity name', 'address' => 'entity address'];

use Jaddek\ElasticPlace;

class PlaceDocument extends ElasticPlace\Document
{
    public $index = 'place';
    public $type = 'place';
}

$document = (new PlaceDocument())->setBody($data)->setId(1);

$wrapper = new ElasticPlace\ClientWrapper();

$result = $wrapper->upsert($document);

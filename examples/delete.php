<?php

require('../vendor/autoload.php');


use Jaddek\ElasticPlace;

class PlaceDocument extends ElasticPlace\Document
{
    public $index = 'place';
    public $type = 'place';
}

$document = (new PlaceDocument())->setId(1);

$wrapper = new ElasticPlace\ClientWrapper();

$result = $wrapper->delete($document);

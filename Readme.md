# ElasticSearch PHP client
Wrapped official client https://github.com/elastic/elasticsearch-php**

## Usage

### Initial setup

1. Install composer. `curl -s http://getcomposer.org/installer | php`
2. Create `composer.json` containing:

    ```js
    {
        "require" : {
            "jaddek/elasticplace" : "*"
        }
    }
    ```
3. Run `./composer.phar install`
4. Keep up-to-date: `./composer.phar update`

### Batch
```php
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

$collection->addDocument($factory->makeIndexDocument(['name' => 'entity name', 'address' => 'entity address']));
$collection->addDocument($factory->makeUpdateDocument(['name' => 'entity name', 'address' => 'entity address'], 1));
$collection->addDocument($factory->makeUpsertDocument(['name' => 'entity name', 'address' => 'entity address']));
$collection->addDocument($factory->makeDeleteDocument(1));

$result = (new ElasticPlace\ClientWrapper())->bulk($collection);
```

### Batch 2
```php
require('../vendor/autoload.php');

use Jaddek\ElasticPlace;

$document = new ElasticPlace\Document();
$document->setBody(['name' => 'entity name', 'address' => 'entity address'])
         ->setId(1)
         ->setActionIndex()
         ->setIndex('place')
         ->setType('place')
;

$collection = new ElasticPlace\Collection();
$collection->addDocument($document);

$result = (new ElasticPlace\ClientWrapper())->bulk($collection);
```

### Index
```php
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

$result = $wrapper->index($document);
```

### Index 2
```php
require('../vendor/autoload.php');

$data = ['name' => 'entity name', 'address' => 'entity address'];

use Jaddek\ElasticPlace;


$document = new ElasticPlace\Document();
$document->setBody(['name' => 'entity name', 'address' => 'entity address'])
         ->setId(1)
         ->setActionIndex()
         ->setIndex('place')
         ->setType('place')
;

$wrapper = new ElasticPlace\ClientWrapper();
$result = $wrapper->index($document);
```

### Update
```php
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
$result = $wrapper->update($document);
```

### Update 2
```php
require('../vendor/autoload.php');

$data = ['name' => 'entity name', 'address' => 'entity address'];

use Jaddek\ElasticPlace;


$document = new ElasticPlace\Document();
$document->setBody(['name' => 'entity name', 'address' => 'entity address'])
         ->setId(1)
         ->setActionIndex()
         ->setIndex('place')
         ->setType('place')
;

$wrapper = new ElasticPlace\ClientWrapper();
$result = $wrapper->update($document);
```

### Upsert
```php
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
```

### Upsert 2
```php
require('../vendor/autoload.php');

$data = ['name' => 'entity name', 'address' => 'entity address'];

use Jaddek\ElasticPlace;


$document = new ElasticPlace\Document();
$document->setBody(['name' => 'entity name', 'address' => 'entity address'])
         ->setId(1)
         ->setActionIndex()
         ->setIndex('place')
         ->setType('place')
;

$wrapper = new ElasticPlace\ClientWrapper();
$result = $wrapper->upsert($document);
```
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

```
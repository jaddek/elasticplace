<?php

namespace Jaddek\ElasticPlace;

use Elasticsearch\ClientBuilder;
use Elasticsearch\Client;

/**
 * Class Client
 */
class ClientWrapper
{
    /**
     * @var Client $client
     */
    private $client;

    /**
     * @var
     */
    private $builder;

    /**
     * Client constructor.
     *
     * @param array $config
     */
    public function __construct(array $config = [])
    {
        $quiet = $config['quiet'] ?? false;
        unset($config['quiet']);

        $this->client  = ClientBuilder::fromConfig($config, $quiet);
        $this->builder = new Builder();
    }

    /**
     * @return \Elasticsearch\Client
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @param Collection $collection
     *
     * @return array
     */
    public function bulk(Collection $collection)
    {
        $params = (new Builder())->buildBulkBody($collection);

        return $this->getClient()->bulk(['body' => $params]);
    }

    /**
     * @param Document $document
     *
     * @return array
     */
    public function index(Document $document)
    {
        $params = $this->builder->buildSimpleBody($document->setActionIndex());

        return $this->getClient()->index($params);
    }

    /**
     * @param Document $document
     *
     * @return array
     */
    public function update(Document $document)
    {
        $params = $this->builder->buildSimpleBody($document->setActionUpdate());

        return $this->getClient()->update($params);
    }

    /**
     * @param Document $document
     *
     * @return array
     */
    public function upsert(Document $document)
    {
        $params = $this->builder->buildSimpleBody($document->setActionUpsert());

        return $this->getClient()->update($params);
    }

    /**
     * @param Document $document
     *
     * @return array
     */
    public function delete(Document $document)
    {
        $params = $this->builder->buildSimpleBody($document->setActionDelete());

        return $this->getClient()->delete($params);
    }

    /**
     * @param Client $client
     */
    public function setClient(Client $client): void
    {
        $this->client = $client;
    }

    /**
     * @param $name
     * @param $arguments
     *
     * @return mixed
     */
    public function __call($name, $arguments)
    {
        return call_user_func_array([$this->getClient(), $name], $arguments);
    }
}

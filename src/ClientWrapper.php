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
     * Client constructor.
     *
     * @param array $config
     */
    public function __construct(array $config = [])
    {
        $quiet = $config['quiet'] ?? false;
        unset($config['quiet']);

        $this->client = ClientBuilder::fromConfig($config, $quiet);
    }

    /**
     * @return \Elasticsearch\Client
     */
    public function getClient()
    {
        return $this->client;
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

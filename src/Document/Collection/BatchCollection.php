<?php

namespace Jaddek\ElasticPlace\Document\Collection;

use Jaddek\ElasticPlace\Document;
use Jaddek\ElasticPlace\Query\Builder;

/**
 *
 */
class BatchCollection
{
    /**
     * @var Builder
     */
    protected $builder;
    /**
     * @var
     */
    protected $documents;

    /**
     * @param Builder $builder
     */
    public function __construct(Builder $builder)
    {
        $this->builder = $builder;
    }

    /**
     * @return mixed
     */
    public function getDocuments()
    {
        return $this->documents;
    }

    /**
     * @param Document $document
     */
    public function addDocument(Document $document)
    {
        $destination = $this->builder->buildDestination($document, true);
        $query       = $this->builder->buildQuery($document);

        $this->documents[] = [$document->getAction() => $destination];

        if ($query) {
            $this->documents[] = $query;
        }
    }
}

<?php

namespace Jaddek\ElasticPlace;

/**
 *
 */
class Collection
{
    /**
     * @var Factory
     */
    protected $builder;
    /**
     * @var
     */
    protected $documents;

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
        $this->documents[] = $document;
    }
}

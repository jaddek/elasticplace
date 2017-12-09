<?php

namespace Jaddek\ElasticPlace\Query;

use Jaddek\ElasticPlace\Document;

/**
 *
 */
class Builder
{
    /**
     * @param Document $document
     *
     * @return array|mixed
     */
    public function buildQuery(Document $document)
    {
        switch (true) {
            case $document->isActionUpdate():
                $query = ['doc' => $document->getDocument()];
                break;
            case $document->isActionUpsert():
                $query = ['doc' => $document->getDocument(), 'doc_as_upsert' => 1];
                break;
            case $document->isActionIndex():
                $query = $document->getDocument();
                break;
            case $document->isActionDelete():
                break;
            default:
                throw new \RuntimeException("Unknown action {$document->getAction()}");
        }

        return $query ?? [];
    }

    /**
     * @param Document $document
     * @param bool     $prefix
     *
     * @return array
     */
    public function buildDestination(Document $document, bool $prefix = false): array
    {
        $index = ($prefix ? '_index' : 'index');
        $type  = ($prefix ? '_type' : 'type');
        $id    = ($prefix ? '_id' : 'id');

        $destination = [
            $index => $document->getIndex(),
            $type  => $document->getType(),
        ];

        if ($document->hasId()) {
            $destination[$id] = $document->getId();
        }

        return $destination;
    }
}

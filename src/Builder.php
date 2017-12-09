<?php

namespace Jaddek\ElasticPlace;

class Builder
{
    /**
     * @param Document $document
     *
     * @return array
     */
    public function buildSimpleBody(Document $document)
    {
        $body         = $this->buildDestination($document);

        if ($document->hasBody()) {
            $body['body'] = $this->buildQuery($document);
        }

        return $body;
    }

    /**
     * @param Collection $collection
     *
     * @return array
     */
    public function buildBulkBody(Collection $collection)
    {
        /** @var Document $document */
        foreach ($collection->getDocuments() as $document) {

            $result[] = [$document->getAction() => $this->buildDestination($document, true)];

            if ($document->hasBody()) {
                $result[] = $this->buildQuery($document);
            }
        }

        return $result ?? [];
    }

    /**
     * @param Document $document
     *
     * @return array|mixed
     */
    protected function buildQuery(Document $document)
    {
        switch (true) {
            case $document->isActionUpdate():
                $query = ['doc' => $document->getBody()];
                break;
            case $document->isActionUpsert():
                $query = ['doc' => $document->getBody(), 'doc_as_upsert' => 1];
                break;
            case $document->isActionIndex():
                $query = $document->getBody();
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
    protected function buildDestination(Document $document, bool $prefix = false): array
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

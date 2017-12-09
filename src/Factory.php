<?php

namespace Jaddek\ElasticPlace;

/**
 *
 */
abstract class Factory
{
    /**
     * @return Document
     */
    abstract public function createDocument(): Document;

    /**
     * @param string     $action
     * @param null       $id
     * @param array|null $data
     *
     * @return Document
     */
    public function populate(string $action, $id = null, array $data = null )
    {
        return $this->createDocument()
            ->setAction($action)
            ->setBody($data)
            ->setId($id);
    }

    /**
     * @param array $data
     * @param null  $id
     *
     * @return Document
     */
    public function makeIndexDocument(array $data, $id = null): Document
    {
        return $this->populate(Document::ACTION_INDEX, $id, $data);
    }

    /**
     * @param array $data
     * @param null  $id
     *
     * @return Document
     */
    public function makeUpsertDocument(array $data, $id = null): Document
    {
        return $this->populate(Document::ACTION_UPSERT, $id, $data);
    }

    /**
     * @param array $data
     * @param null  $id
     *
     * @return Document
     */
    public function makeUpdateDocument(array $data, $id = null): Document
    {
        return $this->populate(Document::ACTION_UPDATE, $id, $data);
    }

    /**
     * @param $id
     *
     * @return Document
     */
    public function makeDeleteDocument($id)
    {
        return $this->populate(Document::ACTION_DELETE, $id);
    }
}

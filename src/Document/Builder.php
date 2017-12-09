<?php

namespace Jaddek\ElasticPlace\Document;

use Jaddek\ElasticPlace\Document;

/**
 *
 */
abstract class Builder
{
    /**
     * @return Document
     */
    abstract public function createDocument(): Document;

    /**
     * @param string     $action
     * @param array|null $data
     * @param null       $id
     *
     * @return Document
     */
    protected function populate(string $action, $id = null, ?array $data = null )
    {
        return $this->createDocument()
            ->setAction($action)
            ->setDocument($data)
            ->setId($id);
    }

    /**
     * @param array $data
     * @param null  $id
     *
     * @return Document
     */
    public function index(array $data, $id = null): Document
    {
        return $this->populate(Document::ACTION_INDEX, $id, $data);
    }

    /**
     * @param array $data
     * @param null  $id
     *
     * @return Document
     */
    public function upsert(array $data, $id = null): Document
    {
        return $this->populate(Document::ACTION_UPSERT, $id, array_merge($data, ['upsert' => 1]));
    }

    /**
     * @param array $data
     * @param null  $id
     *
     * @return Document
     */
    public function update(array $data, $id = null): Document
    {
        return $this->populate(Document::ACTION_UPDATE, $id, $data);
    }

    /**
     * @param $id
     *
     * @return Document
     */
    public function delete($id)
    {
        return $this->populate(Document::ACTION_DELETE, $id);
    }
}

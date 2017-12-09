<?php

namespace Jaddek\ElasticPlace;

/**
 *
 */
abstract class Document
{
    /**
     *
     */
    const ACTION_DELETE = 'delete';

    /**
     *
     */
    const ACTION_UPDATE = 'update';

    /**
     *
     */
    const ACTION_INDEX = 'index';

    /**
     *
     */
    const ACTION_UPSERT = 'upsert';

    /**
     * @var
     */
    protected $index;
    /**
     * @var
     */
    protected $type;
    /**
     * @var
     */
    protected $id;
    /**
     * @var
     */
    protected $action;

    /**
     * @var
     */
    protected $document;

    /**
     * @return mixed
     */
    public function getIndex()
    {
        return $this->index;
    }

    /**
     * @param $index
     *
     * @return Document
     */
    public function setIndex($index): self
    {
        $this->index = $index;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param $type
     *
     * @return Document
     */
    public function setType($type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param $id
     *
     * @return Document
     */
    public function setId($id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return bool
     */
    public function hasId(): bool
    {
        return !empty($this->id);
    }

    /**
     * @return mixed
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * @param $action
     *
     * @return Document
     */
    public function setAction($action): self
    {
        $this->action = $action;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDocument()
    {
        return $this->document;
    }

    /**
     * @param $document
     *
     * @return Document
     */
    public function setDocument($document): self
    {
        $this->document = $document;

        return $this;
    }

    /**
     * @return bool
     */
    public function isActionDelete()
    {
        return $this->action === self::ACTION_DELETE;
    }

    /**
     * @return bool
     */
    public function isActionIndex()
    {
        return $this->action === self::ACTION_INDEX;
    }

    /**
     * @return bool
     */
    public function isActionUpdate()
    {
        return $this->action === self::ACTION_UPDATE;
    }

    /**
     * @return bool
     */
    public function isActionUpsert()
    {
        return $this->action === self::ACTION_UPSERT;
    }
}

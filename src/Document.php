<?php

namespace Jaddek\ElasticPlace;

/**
 *
 */
class Document
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
    protected $body;

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
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @return bool
     */
    public function hasBody()
    {
        return empty($this->body) === false;
    }

    /**
     * @param $body
     *
     * @return Document
     */
    public function setBody($body): self
    {
        $this->body = $body;

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
     * @return Document
     */
    public function setActionDelete(): self
    {
        $this->action = self::ACTION_DELETE;

        return $this;
    }

    /**
     * @return bool
     */
    public function isActionIndex()
    {
        return $this->action === self::ACTION_INDEX;
    }

    /**
     * @return Document
     */
    public function setActionIndex(): self
    {
        $this->action = self::ACTION_INDEX;

        return $this;
    }

    /**
     * @return bool
     */
    public function isActionUpdate()
    {
        return $this->action === self::ACTION_UPDATE;
    }

    /**
     * @return Document
     */
    public function setActionUpdate(): self
    {
        $this->action = self::ACTION_UPDATE;

        return $this;
    }

    /**
     * @return bool
     */
    public function isActionUpsert()
    {
        return $this->action === self::ACTION_UPSERT;
    }

    /**
     * @return Document
     */
    public function setActionUpsert(): self
    {
        $this->action = self::ACTION_UPSERT;

        return $this;
    }

    public function toArray($mode)
    {
        $array = [
            'index' => $this->index,
            'type'  => $this->type,
            'body' => $this->body
        ];

        if ($this->hasId()) {
            $array['id'] = $this->id;
        }

        return $array;
    }
}

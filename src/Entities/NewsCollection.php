<?php

namespace App\Entities;

use ArrayAccess;
use JsonSerializable;
use RuntimeException;

class NewsCollection implements ArrayAccess, JsonSerializable, \Iterator
{
    private array $container = [];

    private $index = 0;

    public function __construct()
    {
        $this->index = 0;
    }

    public function add(NewsItem $item)
    {
        $this->container[] = $item;
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize()
    {
        return $this->container;
    }

    public function current()
    {
        return $this->container[$this->index];
    }

    public function key()
    {
        return $this->index;
    }

    public function next()
    {
        $this->index++;
    }

    public function rewind()
    {
        $this->index = 0;
    }

    public function valid()
    {
        return $this->index < count($this->container);
    }

    public function merge(NewsCollection $collection)
    {
        $this->container = array_merge($this->container, $collection->toArray());
    }

    public function toArray(): array
    {
        return $this->container;
    }

    /**
     * @inheritDoc
     */
    public function offsetExists($offset)
    {
        return isset($this->container[$offset]);
    }

    /**
     * @inheritDoc
     */
    public function offsetGet($offset)
    {
        return $this->container[$offset] ?? null;
    }

    /**
     * @inheritDoc
     */
    public function offsetSet($offset, $value)
    {
        throw new RuntimeException('NewsCollection does not support array set');
    }

    /**
     * @inheritDoc
     */
    public function offsetUnset($offset)
    {
        unset($this->container[$offset]);
    }
}

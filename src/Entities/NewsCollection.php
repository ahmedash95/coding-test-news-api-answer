<?php

namespace App\Entities;

use JsonSerializable;

class NewsCollection implements JsonSerializable, \Iterator
{
	private $container = [];

	private $index = 0;

	public function __construct()
	{
		$this->index = 0;
	}


	public function add(NewsItem $item) {
		$this->container[] = $item;
	}

	/**
	 * @inheritDoc
	 */
	public function jsonSerialize()
	{
		return $this->container;
	}

	public function current() {
		return $this->container[$this->index];
	}

	public function key() {
		return $this->index;
	}

	public function next() {
		$this->index++;
	}

	public function rewind() {
		$this->index = 0;
	}

	public function valid() {
		return $this->index < count($this->container);
	}
}
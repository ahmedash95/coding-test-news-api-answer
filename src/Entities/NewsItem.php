<?php

namespace App\Entities;

use DateTime;
use JsonSerializable;

class NewsItem implements JsonSerializable
{
	private String $title;
	private String $author;
	private String $image;
	private DateTime $publishDate;
	private String $source;
	private String $url;
	private $dateFormat = "Y-m-d h:i";

	/**
	 * @return String
	 */
	public function getTitle(): String
	{
		return $this->title;
	}

	/**
	 * @param String $title
	 */
	public function setTitle(String $title): void
	{
		$this->title = $title;
	}

	/**
	 * @return String
	 */
	public function getAuthor(): String
	{
		return $this->author;
	}

	/**
	 * @param String $author
	 */
	public function setAuthor(String $author): void
	{
		$this->author = $author;
	}

	/**
	 * @return String
	 */
	public function getImage(): String
	{
		return $this->image;
	}

	/**
	 * @param String $image
	 */
	public function setImage(String $image): void
	{
		$this->image = $image;
	}

	/**
	 * @return DateTime
	 */
	public function getPublishDate(): DateTime
	{
		return $this->publishDate;
	}

	/**
	 * @param DateTime $publishDate
	 */
	public function setPublishDate(DateTime $publishDate): void
	{
		$this->publishDate = $publishDate;
	}

	/**
	 * @return String
	 */
	public function getSource(): String
	{
		return $this->source;
	}

	/**
	 * @param String $source
	 */
	public function setSource(String $source): void
	{
		$this->source = $source;
	}

	/**
	 * @return String
	 */
	public function getUrl(): String
	{
		return $this->url;
	}

	/**
	 * @param String $url
	 */
	public function setUrl(String $url): void
	{
		$this->url = $url;
	}

	/**
	 * @param string $dateFormat
	 */
	public function setDateFormat(string $dateFormat): void
	{
		$this->dateFormat = $dateFormat;
	}

	public function toArray() : array
	{
		return [
			'title' => $this->getTitle(),
			'author' => $this->getAuthor(),
			'image' => $this->getImage(),
			'publish_date' => $this->getPublishDate()->format($this->dateFormat),
			'source' => $this->getSource(),
			'url' => $this->getUrl(),
		];
	}

	/**
	 * @inheritDoc
	 */
	public function jsonSerialize()
	{
		return $this->toArray();
	}
}
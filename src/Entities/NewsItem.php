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
    private $dateFormat = 'Y-m-d h:i';

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getAuthor(): string
    {
        return $this->author;
    }

    /**
     * @param string $author
     */
    public function setAuthor(string $author): void
    {
        $this->author = $author;
    }

    /**
     * @return string
     */
    public function getImage(): string
    {
        return $this->image;
    }

    /**
     * @param string $image
     */
    public function setImage(string $image): void
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
     * @return string
     */
    public function getSource(): string
    {
        return $this->source;
    }

    /**
     * @param string $source
     */
    public function setSource(string $source): void
    {
        $this->source = $source;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @param string $url
     */
    public function setUrl(string $url): void
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

    public function toArray(): array
    {
        return [
            'title'        => $this->getTitle(),
            'author'       => $this->getAuthor(),
            'image'        => $this->getImage(),
            'publish_date' => $this->getPublishDate()->format($this->dateFormat),
            'source'       => $this->getSource(),
            'url'          => $this->getUrl(),
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

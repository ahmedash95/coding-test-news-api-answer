<?php

namespace App\Repositories;

use App\Entities\NewsCollection;
use App\Entities\NewsItem;
use Package\BrokenProvider\BrokenProvider;
use Package\FoxNews\FoxNews;

class BrokenProviderRepository implements NewsRepositoryInterface
{
	private function getProvider(): BrokenProvider
	{
		return new BrokenProvider();
	}

	public function all(): NewsCollection
	{
		$collection = new NewsCollection();
		foreach ($this->getProvider()->getNewsFromAPI()['articles'] as $row) {
			$item = new NewsItem();
			$item->setTitle($row['title']);
			$item->setAuthor($row['author']);
			$item->setImage($row['urlToImage'] ?? "");
			$item->setPublishDate(new DateTime($row['publishedAt']));
			$item->setSource($row['source']['name']);
			$item->setUrl($row['url']);
			$collection->add($item);
		}

		return $collection;
	}
}
<?php

namespace App\Repositories;

use App\Entities\NewsCollection;
use App\Entities\NewsItem;
use DateTime;
use Package\NYTimes\NewYorkTimes;

class NYTimesRepository implements NewsRepositoryInterface
{
    private function getProvider(): NewYorkTimes
    {
        return new NewYorkTimes();
    }

    public function all(): NewsCollection
    {
        $collection = new NewsCollection();
        foreach ($this->getProvider()->getNews() as $row) {
            $item = new NewsItem();
            $item->setTitle((string) $row->title);
            $item->setAuthor((string) $row->author);
            $item->setImage((string) $row->image);
            $item->setPublishDate(new DateTime((string) $row->published_at));
            $item->setSource((string) $row->source);
            $item->setUrl((string) $row->url);
            $collection->add($item);
        }

        return $collection;
    }
}

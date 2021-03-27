<?php

namespace App;

use App\Entities\NewsItem;
use App\Repositories\NewsRepositoryInterface;
use Psr\Log\LoggerInterface;
use RuntimeException;

class NewsAggregator
{
	/**
	 * @var NewsRepositoryInterface[] $providers
	 */
	private array $providers = [];

	/**
	 * @var LoggerInterface
	 */
	private LoggerInterface $logger;

	/**
	 * NewsAggregator constructor.
	 * @param LoggerInterface $logger
	 */
	public function __construct(LoggerInterface $logger)
	{
		$this->logger = $logger;
	}


	public function addProvider(NewsRepositoryInterface $repository)
	{
		$this->providers[] = $repository;
	}

	public function get()
	{
		$news = [];
		foreach ($this->providers as $provider) {
			/** @var NewsItem $item */
			try {
				foreach ($provider->all() as $item) {
					$news[] = $item->toArray();
				}
			} catch (RuntimeException $e) {
				$this->logger->error(sprintf('Provider [%s] data not found.', get_class($provider)));
			}
		}

		return $news;
	}
}
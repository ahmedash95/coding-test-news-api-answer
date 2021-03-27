<?php declare(strict_types=1);


use App\Entities\NewsCollection;
use App\Entities\NewsItem;
use App\NewsAggregator;
use App\Repositories\NewsRepositoryInterface;
use PHPUnit\Framework\TestCase;
use Psr\Log\LoggerInterface;

final class AggregatorTest extends TestCase
{
	private $logger;

	public function setUp(): void
	{
		parent::setUp();

		$this->logger = $this->createMock(LoggerInterface::class);
	}

	public function test_news_are_being_returned()
	{
		$aggregator = new NewsAggregator($this->logger);
		$aggregator->addProvider(new TestNewsRepository());
		$results = $aggregator->get();

		$this->assertCount(1, $results);
		$this->assertEquals('Fake title', $results[0]->getTitle());
	}

	public function test_provider_errors_are_catchable()
	{
		$this->logger
			->expects($this->once())
			->method('error')
			->with($this->callback(function ($message) {
				$this->assertEquals($message, "Provider [TestBrokenRepository] data not found.");
				return true;
			}));

		$aggregator = new NewsAggregator($this->logger);
		$aggregator->addProvider(new TestBrokenRepository());
		$aggregator->get();

	}

	public function test_provider_errors_does_not_break_aggregator()
	{
		$aggregator = new NewsAggregator($this->logger);
		$aggregator->addProvider(new TestBrokenRepository());
		$result = $aggregator->get();

		$this->assertIsArray($result->toArray());
	}
}

class TestNewsRepository implements NewsRepositoryInterface
{
	public function all(): NewsCollection
	{
		$collection = new NewsCollection();
		$item = new NewsItem();
		$item->setTitle('Fake title');
		$item->setAuthor('Fake author');
		$item->setImage('Fake image');
		$item->setSource('Fake source');
		$item->setPublishDate(new DateTime());
		$item->setUrl('Fake url');

		$collection->add($item);

		return $collection;
	}
}

class TestBrokenRepository implements NewsRepositoryInterface
{
	public function all(): NewsCollection
	{
		throw new RuntimeException('File data not found.');
	}
}
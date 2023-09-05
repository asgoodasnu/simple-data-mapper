<?php

declare(strict_types=1);

namespace Test\Asgoodasnew\SimpleDataMapperBundle\Collector;

use Asgoodasnew\SimpleDataMapperBundle\Collector\ConfigurationBuilderCollector;
use Asgoodasnew\SimpleDataMapperBundle\Collector\SimpleDataMapperCollector;
use Asgoodasnew\SimpleDataMapperBundle\Configuration\Configuration;
use Asgoodasnew\SimpleDataMapperBundle\Loader\Loader;
use Asgoodasnew\SimpleDataMapperBundle\SimpleDataMapper;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class SimpleDataMapperCollectorTest extends TestCase
{
    private SimpleDataMapper $simpleDataMapper;

    private MockObject $loader;

    private MockObject $collector;

    private \Closure $closure;

    private MockObject $configuration;

    protected function setUp(): void
    {
        $this->collector = $this->createMock(ConfigurationBuilderCollector::class);
        $this->loader = $this->createMock(Loader::class);
        $this->closure = function () { return []; };
        $this->configuration = $this->createMock(Configuration::class);

        $this->collector
            ->expects($this->once())
            ->method('getCollectedConfiguration')
            ->willReturn($this->configuration);

        $this->simpleDataMapper = new SimpleDataMapperCollector($this->collector);
    }

    public function testItThrowsAnExceptionIfNameForLoaderIsNotFound(): void
    {
        $this->configuration
            ->expects($this->once())
            ->method('getLoader')
            ->willThrowException(new \InvalidArgumentException());

        $this->expectException(\InvalidArgumentException::class);

        $this->simpleDataMapper->map('XXX', []);
    }

    public function testItThrowsAnExceptionIfNameForClosureIsNotFound(): void
    {
        $this->configuration
            ->expects($this->once())
            ->method('getClosure')
            ->willThrowException(new \InvalidArgumentException());

        $this->expectException(\InvalidArgumentException::class);

        $this->simpleDataMapper->map('XXX', []);
    }

    /**
     * @param array<string>        $keys
     * @param array<string, mixed> $map
     * @dataProvider dataProvider
     */
    public function testItCanMap(array $keys, array $map, ?string $expected, string $key): void
    {
        $this->configuration
            ->expects($this->once())
            ->method('getLoader')
            ->with('XXX')
            ->willReturn($this->loader);

        $this->loader
            ->expects($this->once())
            ->method('load')
            ->willReturn($map);

        $this->closure = function () use ($keys) { return $keys; };

        $this->configuration
            ->expects($this->once())
            ->method('getClosure')
            ->with('XXX')
            ->willReturn($this->closure);

        $this->assertSame($expected, $this->simpleDataMapper->map('XXX', []));
    }

    /**
     * @return array<mixed>
     */
    public function dataProvider(): array
    {
        return [
            [['id'], ['id' => 'id'], 'id', 'id'],
            [[], ['id' => 'id'], null, 'id'],
        ];
    }
}

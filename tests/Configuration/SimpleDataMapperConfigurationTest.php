<?php

declare(strict_types=1);

namespace Test\Asgoodasnew\SimpleDataMapperBundle\Configuration;

use Asgoodasnew\SimpleDataMapperBundle\Configuration\Configuration;
use Asgoodasnew\SimpleDataMapperBundle\Loader\Loader;
use PHPUnit\Framework\Attributes\AllowMockObjectsWithoutExpectations;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

#[CoversClass(Configuration::class)]
class SimpleDataMapperConfigurationTest extends TestCase
{
    private Configuration $configuration;

    /** @var Loader|MockObject */
    private $loader;

    /** @var \Closure */
    private $closure;

    protected function setUp(): void
    {
        $this->loader = $this->createMock(Loader::class);
        $this->closure = function () {
            return [];
        };

        $this->configuration = (new Configuration())
            ->addMapping(
                'mapping',
                $this->loader,
                $this->closure
            );
    }

    #[AllowMockObjectsWithoutExpectations]
    public function testItCanGetAClosure(): void
    {
        $this->assertSame($this->closure, $this->configuration->getClosure('mapping'));
    }

    #[AllowMockObjectsWithoutExpectations]
    public function testItCanGetALoader(): void
    {
        $this->assertSame($this->loader, $this->configuration->getLoader('mapping'));
    }

    #[AllowMockObjectsWithoutExpectations]
    public function testItThrowsExceptionOnInvalidNameForClosure(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        $this->assertSame($this->closure, $this->configuration->getClosure('wrong'));
    }

    #[AllowMockObjectsWithoutExpectations]
    public function testItThrowsExceptionOnInvalidNameForLoader(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        $this->assertSame($this->loader, $this->configuration->getLoader('wrong'));
    }
}

<?php

declare(strict_types=1);

namespace Test\Asgoodasnew\SimpleDataMapperBundle\Configuration;

use Asgoodasnew\SimpleDataMapperBundle\Configuration\Configuration;
use Asgoodasnew\SimpleDataMapperBundle\Loader\Loader;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

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
        $this->closure = function () { return []; };

        $this->configuration = (new Configuration())
            ->addMapping(
                'mapping',
                $this->loader,
                $this->closure
            );
    }

    public function testItCanGetAClosure(): void
    {
        $this->assertSame($this->closure, $this->configuration->getClosure('mapping'));
    }

    public function testItCanGetALoader(): void
    {
        $this->assertSame($this->loader, $this->configuration->getLoader('mapping'));
    }

    public function testItThrowsExceptionOnInvalidNameForClosure(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        $this->assertSame($this->closure, $this->configuration->getClosure('wrong'));
    }

    public function testItThrowsExceptionOnInvalidNameForLoader(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        $this->assertSame($this->loader, $this->configuration->getLoader('wrong'));
    }
}

<?php

declare(strict_types=1);

namespace Test\Asgoodasnew\SimpleDataMapperBundle;

use Asgoodasnew\SimpleDataMapperBundle\AsgoodasnewSimpleDataMapperBundle;
use Asgoodasnew\SimpleDataMapperBundle\Collector\ConfigurationBuilderCollector;
use Asgoodasnew\SimpleDataMapperBundle\Collector\SimpleDataMapperCollector;
use Asgoodasnew\SimpleDataMapperBundle\DependencyInjection\AsgoodasnewSimpleDataMapperExtension;
use Asgoodasnew\SimpleDataMapperBundle\SimpleDataMapper;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\UsesClass;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\HttpKernel\Kernel;

#[CoversClass(SimpleDataMapperCollector::class)]
#[UsesClass(ConfigurationBuilderCollector::class)]
#[UsesClass(AsgoodasnewSimpleDataMapperExtension::class)]
class FunctionalTest extends TestCase
{
    public function testServiceWiring(): void
    {
        $kernel = new SimpleDataMapperTestingKernel('test', true);
        $kernel->boot();
        $container = $kernel->getContainer();
        $simpleDataMapper = $container->get('asgoodasnew_simple_data_mapper.simple_data_mapper');
        $this->assertInstanceOf(SimpleDataMapper::class, $simpleDataMapper);
    }
}

class SimpleDataMapperTestingKernel extends Kernel
{
    public function registerBundles(): iterable
    {
        return [
            new AsgoodasnewSimpleDataMapperBundle(),
        ];
    }

    public function registerContainerConfiguration(LoaderInterface $loader): void
    {
    }
}

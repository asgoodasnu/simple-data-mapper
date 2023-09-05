<?php

declare(strict_types=1);

namespace Test\Asgoodasnew\SimpleDataMapperBundle;

use Asgoodasnew\SimpleDataMapperBundle\AsgoodasnewSimpleDataMapperBundle;
use Asgoodasnew\SimpleDataMapperBundle\SimpleDataMapper;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\HttpKernel\Kernel;

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

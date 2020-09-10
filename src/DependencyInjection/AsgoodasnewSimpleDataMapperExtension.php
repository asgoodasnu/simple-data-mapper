<?php

declare(strict_types=1);

namespace Asgoodasnew\SimpleDataMapperBundle\DependencyInjection;

use Asgoodasnew\SimpleDataMapperBundle\Collector\ConfigurationHandler;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;

class AsgoodasnewSimpleDataMapperExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {
        $this->loadServices($container);

        $this->autoconfigureConfigurationBuilder($container);
    }

    private function loadServices(ContainerBuilder $container): void
    {
        $loader = new XmlFileLoader(
            $container,
            new FileLocator(__DIR__ . '/../Resources/config')
        );

        $loader->load('services.xml');
    }

    private function autoconfigureConfigurationBuilder(ContainerBuilder $container): void
    {
        $container->registerForAutoconfiguration(ConfigurationHandler::class)
            ->addTag('sdm.container_builder');
    }
}

<?php

declare(strict_types=1);

use Asgoodasnew\SimpleDataMapperBundle\Collector\ConfigurationBuilderCollector;
use Asgoodasnew\SimpleDataMapperBundle\Collector\SimpleDataMapperCollector;
use Asgoodasnew\SimpleDataMapperBundle\SimpleDataMapper;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

use function Symfony\Component\DependencyInjection\Loader\Configurator\service;
use function Symfony\Component\DependencyInjection\Loader\Configurator\tagged_iterator;

return static function (ContainerConfigurator $container): void {
    $services = $container->services();

    $services
        ->set('asgoodasnew_simple_data_mapper.simple_data_mapper', SimpleDataMapperCollector::class)
        ->public()
        ->arg(0, service('asgoodasnew_simple_data_mapper.configuration_builder_collector'));

    $services
        ->alias(SimpleDataMapper::class, 'asgoodasnew_simple_data_mapper.simple_data_mapper');

    $services
        ->set('asgoodasnew_simple_data_mapper.configuration_builder_collector', ConfigurationBuilderCollector::class)
        ->arg(0, tagged_iterator('sdm.container_builder'));
};

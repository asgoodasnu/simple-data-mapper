<?php

declare(strict_types=1);

namespace Asgoodasnew\SimpleDataMapperBundle\Collector;

use Asgoodasnew\SimpleDataMapperBundle\Configuration\Configuration;
use Asgoodasnew\SimpleDataMapperBundle\ConfigurationHandler;

class ConfigurationBuilderCollector
{
    private iterable $handler;

    public function __construct(iterable $handler)
    {
        $this->handler = $handler;
    }

    public function getCollectedConfiguration(): Configuration
    {
        $configuration = new Configuration();

        /** @var ConfigurationHandler $configurationBuilder */
        foreach ($this->handler as $configurationBuilder) {
            $configurationBuilder->handle($configuration);
        }

        return $configuration;
    }
}

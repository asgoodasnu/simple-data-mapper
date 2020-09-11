<?php

declare(strict_types=1);

namespace Asgoodasnew\SimpleDataMapperBundle\Collector;

use Asgoodasnew\SimpleDataMapperBundle\Configuration\Configuration;
use Asgoodasnew\SimpleDataMapperBundle\SimpleDataMapper;

class SimpleDataMapperCollector implements SimpleDataMapper
{
    private Configuration $configuration;

    public function __construct(ConfigurationBuilderCollector $configurationBuilderCollector)
    {
        $this->configuration = $configurationBuilderCollector->getCollectedConfiguration();
    }

    /**
     * @param array<mixed> $objects
     */
    public function map(string $name, array $objects): ?string
    {
        return $this->reduceArray(
            $this->configuration->getLoader($name)->load(),
            $this->configuration->getClosure($name)(...$objects)
        );
    }

    /**
     * @param array<mixed>  $array
     * @param array<string> $keys
     */
    private function reduceArray(array $array, array $keys): ?string
    {
        if (empty($keys)) {
            return null;
        }

        while ($key = array_shift($keys)) {
            $array = $array[$key] ?? null;
        }

        return $array;
    }
}

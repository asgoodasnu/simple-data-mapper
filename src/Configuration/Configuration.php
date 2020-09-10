<?php

declare(strict_types=1);

namespace Asgoodasnew\SimpleDataMapperBundle\Configuration;

use Asgoodasnew\SimpleDataMapperBundle\Loader\Loader;

class Configuration
{
    /** @var array<string, array<string, mixed>> */
    private array $mapping = [];

    public function addMapping(
        string $name,
        Loader $loader,
        \Closure $closure
    ): Configuration {
        $this->mapping[$name]['closure'] = $closure;
        $this->mapping[$name]['loader'] = $loader;

        return $this;
    }

    public function getClosure(string $name): \Closure
    {
        if (!isset($this->mapping[$name]['closure'])) {
            throw new \InvalidArgumentException(sprintf('No SimpleDataMapa Closure registered for name "%s"', $name));
        }

        return $this->mapping[$name]['closure'];
    }

    public function getLoader(string $name): Loader
    {
        if (!isset($this->mapping[$name]['loader'])) {
            throw new \InvalidArgumentException(sprintf('No SimpleDataMapperLoader registered for name "%s"', $name));
        }

        return $this->mapping[$name]['loader'];
    }
}

<?php

namespace Asgoodasnew\SimpleDataMapperBundle\Collector;

use Asgoodasnew\SimpleDataMapperBundle\Configuration\Configuration;

interface ConfigurationHandler
{
    public function handle(Configuration $configuration): void;
}
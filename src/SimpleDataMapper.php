<?php

namespace Asgoodasnew\SimpleDataMapperBundle;

interface SimpleDataMapper
{
    /**
     * @param array<mixed> $objects
     */
    public function map(string $name, array $objects): ?string;
}
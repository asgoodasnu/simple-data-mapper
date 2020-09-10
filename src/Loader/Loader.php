<?php

namespace Asgoodasnew\SimpleDataMapperBundle\Loader;

interface Loader
{
    /**
     * @return array<string, mixed>
     */
    public function load(): array;
}

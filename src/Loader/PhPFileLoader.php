<?php

declare(strict_types=1);

namespace Asgoodasnew\SimpleDataMapperBundle\Loader;

class PhPFileLoader implements Loader
{
    private string $path;

    public function __construct(string $path)
    {
        $this->path = $path;
    }

    public function load(): array
    {
        return require $this->path;
    }
}

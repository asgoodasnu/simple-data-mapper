<?php

declare(strict_types=1);

namespace Test\Asgoodasnew\SimpleDataMapperBundle;

use Asgoodasnew\SimpleDataMapperBundle\AsgoodasnewSimpleDataMapperBundle;
use Asgoodasnew\SimpleDataMapperBundle\SimpleDataMapper;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class AsgoodasnewSimpleDataMapperBundleTest extends TestCase
{
    public function testBundleClassExists(): void
    {
        $bundleClass = new AsgoodasnewSimpleDataMapperBundle();

        $this->assertInstanceOf(Bundle::class, $bundleClass);
    }
}

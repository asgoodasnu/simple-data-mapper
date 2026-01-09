<?php

declare(strict_types=1);

namespace Test\Asgoodasnew\SimpleDataMapperBundle;

use Asgoodasnew\SimpleDataMapperBundle\AsgoodasnewSimpleDataMapperBundle;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpKernel\Bundle\Bundle;

#[CoversClass(AsgoodasnewSimpleDataMapperBundle::class)]
class AsgoodasnewSimpleDataMapperBundleTest extends TestCase
{
    public function testBundleClassExists(): void
    {
        $bundleClass = new AsgoodasnewSimpleDataMapperBundle();

        $this->assertInstanceOf(Bundle::class, $bundleClass);
    }
}

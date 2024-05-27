<?php

declare(strict_types=1);

/*
 * This file is part of Alphpaca Stack (https://github.com/alphpaca/stack).
 *
 * (c) Jacob Tobiasz <jacob@alphpaca.io>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Tests\Alphpaca\ResourceBundle;

use Symfony\Bundle\FrameworkBundle\FrameworkBundle;
use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

class TestKernel extends Kernel
{
    use MicroKernelTrait;

    public function registerBundles(): array
    {
        return [
            new FrameworkBundle(),
        ];
    }

    protected function build(ContainerBuilder $container): void
    {
    }

    protected function configureContainer(ContainerConfigurator $container): void
    {
        $container->extension('framework', [
            'test' => true,
        ]);
    }

    protected function configureRoutes(RoutingConfigurator $routes): void
    {
    }

    public function getCacheDir(): string
    {
        return sys_get_temp_dir().'/alphpaca/var/cache/'.$this->getEnvironment();
        //        return __DIR__.'/../var/cache/'.$this->getEnvironment();
    }

    public function getLogDir(): string
    {
        return sys_get_temp_dir().'/alphpaca/log/'.$this->getEnvironment();
        //        return __DIR__.'/../var/log';
    }
}

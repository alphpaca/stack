<?php

declare(strict_types=1);

namespace Tests\Extension;

use PHPUnit\Event\TestSuite\Started;
use PHPUnit\Event\TestSuite\StartedSubscriber;
use PHPUnit\Runner\Extension\Extension;
use PHPUnit\Runner\Extension\Facade;
use PHPUnit\Runner\Extension\ParameterCollection;
use PHPUnit\TextUI\Configuration\Configuration;

final class PerSuiteEnvironmentVariablesExtension implements Extension
{
    public function bootstrap(Configuration $configuration, Facade $facade, ParameterCollection $parameters): void
    {
        $facade->registerSubscriber(new class implements StartedSubscriber {
            public function notify(Started $event): void
            {
                $config = require dirname(__DIR__) . '/config.php';
                $perSuiteEnvironments = $config['per_suite_environment_variables'];

                if (!array_key_exists($event->testSuite()->name(), $perSuiteEnvironments)) {
                    return;
                }

                $environmentVariables = $perSuiteEnvironments[$event->testSuite()->name()];

                foreach ($environmentVariables as $key => $value) {
                    putenv($key . '=' . $value);
                }
            }
        });
    }
}

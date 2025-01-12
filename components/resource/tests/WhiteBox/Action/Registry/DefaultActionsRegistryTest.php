<?php

declare(strict_types=1);

use Alphpaca\Component\Resource\Action\Registry\DefaultActionsRegistry;
use Alphpaca\Component\Resource\Action\Result\SuccessResult;
use Alphpaca\Contracts\Resource\Action\Context\Context;
use Alphpaca\Contracts\Resource\Action\Input\Input;
use Alphpaca\Contracts\Resource\Action\Middleware;
use Alphpaca\Contracts\Resource\Action\Registry\ActionCannotBeAddedException;
use Alphpaca\Contracts\Resource\Action\Registry\ActionMiddlewareCannotBeAddedException;
use Alphpaca\Contracts\Resource\Action\Result;
use Tests\Alphpaca\Component\Resource\WhiteBox\Action\Registry\DataFixtures\DummyAction;
use Tests\Alphpaca\Component\Resource\WhiteBox\Action\Registry\DataFixtures\DummyMiddleware;

describe('Default Actions Registry', function () {
    covers(DefaultActionsRegistry::class);

    it('stores resource actions', function () {
        $registry = new DefaultActionsRegistry();

        $registry->add('app_dummy_action', $dummyAction = new DummyAction());

        expect($registry->getByName('app_dummy_action'))->toBe($dummyAction);
    });

    it('returns resource actions by name', function () {
        $registry = new DefaultActionsRegistry();

        $registry->add('app_dummy_action', $dummyAction = new DummyAction());

        expect($registry->getByName('app_dummy_action'))->toBe($dummyAction)
            ->and($registry->getByName('app_dummy_action_2'))->toBeNull()
        ;
    });

    it('prevents adding actions with the same name', function () {
        $registry = new DefaultActionsRegistry();

        $registry->add('app_dummy_action', new DummyAction());
        $registry->add('app_dummy_action', new DummyAction());
    })->throws(ActionCannotBeAddedException::class, 'Action "app_dummy_action" cannot be added to the registry as the action with the same name already exists.');

    it('stores default middlewares', function () {
        $registry = new DefaultActionsRegistry();

        expect($registry->getDefaultMiddlewares())->toBe([]);

        $dummyMiddleware = new class implements Middleware {
            public function __invoke(Input $input, Context $context, callable $next): Result
            {
                return new SuccessResult();
            }
        };

        $registry->addDefaultMiddleware($dummyMiddleware);
        $registry->addDefaultMiddleware($dummyMiddleware, 10);

        expect($registry->getDefaultMiddlewares())->toBe([
            ['middleware' => $dummyMiddleware, 'priority' => 0],
            ['middleware' => $dummyMiddleware, 'priority' => 10],
        ]);
    });

    it('stores action middlewares', function () {
        $registry = new DefaultActionsRegistry();

        $dummyAction = new DummyAction();

        $registry->add('app_dummy_action', $dummyAction);
        $registry->add('app_zummy_action', $dummyAction);

        $dummyMiddleware = new DummyMiddleware();

        $registry->addActionMiddleware('app_dummy_action', $dummyMiddleware);
        $registry->addActionMiddleware('app_dummy_action', $dummyMiddleware, 10);
        $registry->addActionMiddleware('app_zummy_action', $dummyMiddleware, 20);

        expect($registry->getActionMiddlewares('app_dummy_action'))->toBe([
            ['middleware' => $dummyMiddleware, 'priority' => 0],
            ['middleware' => $dummyMiddleware, 'priority' => 10],
        ]);
    });

    it('throws an exception when trying to add an action middleware for a non-existing action', function () {
        $registry = new DefaultActionsRegistry();

        $registry->addActionMiddleware('app_dummy_action', new DummyMiddleware());
    })->throws(
        ActionMiddlewareCannotBeAddedException::class,
        sprintf('"%s" middleware cannot be added, as the "%s" action does not exist.', DummyMiddleware::class, 'app_dummy_action'),
    );
});

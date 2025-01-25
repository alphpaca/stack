<?php

declare(strict_types=1);

use Alphpaca\Component\Resource\Action\Registry\DefaultActionsRegistry;
use Alphpaca\Component\Resource\Action\Registry\MiddlewaresAwareActionsRegistry;
use Alphpaca\Component\Resource\Action\Result\SuccessResult;
use Alphpaca\Contracts\Resource\Action\Context\Context;
use Alphpaca\Contracts\Resource\Action\Input\Input;
use Alphpaca\Contracts\Resource\Action\Middleware;
use Alphpaca\Contracts\Resource\Action\Registry\ActionMiddlewareCannotBeAddedException;
use Alphpaca\Contracts\Resource\Action\Result;
use Tests\Alphpaca\Component\Resource\WhiteBox\Action\Registry\DataFixtures\DummyAction;
use Tests\Alphpaca\Component\Resource\WhiteBox\Action\Registry\DataFixtures\DummyMiddleware;

describe('Middlewares Aware Actions Registry', function () {
    covers(MiddlewaresAwareActionsRegistry::class);

    it('stores resource actions', function () {
        $registry = new MiddlewaresAwareActionsRegistry(new DefaultActionsRegistry());

        $registry->add('app_dummy_action', $dummyAction = new DummyAction());

        expect($registry->getByName('app_dummy_action'))->toBe($dummyAction);
    });

    it('returns resource actions by name', function () {
        $registry = new MiddlewaresAwareActionsRegistry(new DefaultActionsRegistry());

        $registry->add('app_dummy_action', $dummyAction = new DummyAction());

        expect($registry->getByName('app_dummy_action'))->toBe($dummyAction)
            ->and($registry->getByName('app_dummy_action_2'))->toBeNull()
        ;
    });

    it('returns an empty array while trying to get default middlewares, and no default middlewares are defined', function () {
        $registry = new MiddlewaresAwareActionsRegistry(new DefaultActionsRegistry());

        expect($registry->getDefaultMiddlewares())->toBe([]);
    });

    it('stores default middlewares', function () {
        $registry = new MiddlewaresAwareActionsRegistry(new DefaultActionsRegistry());

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
        $registry = new MiddlewaresAwareActionsRegistry(new DefaultActionsRegistry());

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

    it('returns an empty array when trying to get action middlewares for a non-existing action', function () {
        $registry = new MiddlewaresAwareActionsRegistry(new DefaultActionsRegistry());

        expect($registry->getActionMiddlewares('im_not_existing_action'))->toBe([]);
    });

    it('throws an exception when trying to add an action middleware for a non-existing action', function () {
        $registry = new MiddlewaresAwareActionsRegistry(new DefaultActionsRegistry());

        $registry->addActionMiddleware('app_dummy_action', new DummyMiddleware());
    })->throws(
        ActionMiddlewareCannotBeAddedException::class,
        sprintf('"%s" middleware cannot be added, as the "%s" action does not exist.', DummyMiddleware::class, 'app_dummy_action'),
    );
});

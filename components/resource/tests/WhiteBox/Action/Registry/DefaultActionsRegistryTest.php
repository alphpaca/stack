<?php

declare(strict_types=1);

use Alphpaca\Component\Resource\Action\Registry\DefaultActionsRegistry;
use Alphpaca\Contracts\Resource\Action\Registry\ActionCannotBeAddedException;
use Tests\Alphpaca\Component\Resource\WhiteBox\Action\Registry\DataFixtures\DummyAction;

describe('Default Actions Registry', function () {
    covers(DefaultActionsRegistry::class);

    it('stores resource actions', function () {
        $registry = new DefaultActionsRegistry();

        $registry->add($dummyAction = new DummyAction(name: 'app_dummy_action'));

        expect($registry->getByName('app_dummy_action'))->toBe($dummyAction);
    });

    it('returns resource actions by name', function () {
        $registry = new DefaultActionsRegistry();

        $registry->add($dummyAction = new DummyAction(name: 'app_dummy_action'));

        expect($registry->getByName('app_dummy_action'))->toBe($dummyAction)
            ->and($registry->getByName('app_dummy_action_2'))->toBeNull()
        ;
    });

    it('prevents adding actions with the same name', function () {
        $registry = new DefaultActionsRegistry();

        $registry->add(new DummyAction(name: 'app_dummy_action'));
        $registry->add(new DummyAction(name: 'app_dummy_action'));
    })->throws(ActionCannotBeAddedException::class, 'Action "app_dummy_action" cannot be added to the registry as the action with the same name already exists.');
});

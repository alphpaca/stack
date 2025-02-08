<?php declare(strict_types=1);

/*
 * This file is part of Alphpaca Stack (https://github.com/alphpaca/stack).
 *
 * (c) Jacob Tobiasz <jacob@alphpaca.io>
 *
 * This source file is subject to the Apache License 2.0 that is bundled
 * with this source code in the file LICENSE.
 */

use Alphpaca\Component\Resource\Action\Registry\DefaultActionsRegistry;
use Alphpaca\Contracts\Resource\Action\Registry\ActionCannotBeAddedException;
use Tests\Alphpaca\Component\Resource\WhiteBox\Action\Registry\DataFixtures\DummyAction;

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
});

<?php declare(strict_types=1);

/*
 * This file is part of Alphpaca Stack (https://github.com/alphpaca/stack).
 *
 * (c) Jacob Tobiasz <jacob@alphpaca.io>
 *
 * This source file is subject to the Apache License 2.0 that is bundled
 * with this source code in the file LICENSE.
 */

use Alphpaca\Component\Resource\Action\Context\ContextBag;
use Alphpaca\Component\Resource\Action\Input\InputBag;
use Alphpaca\Component\Resource\Action\Result\SuccessResult;
use Alphpaca\Component\Resource\Action\UpdateAction;

describe('Update Action', function () {
	covers(UpdateAction::class);

	it('returns success result once a resource is updated', function () {
		$action = new UpdateAction();

		$input = new InputBag();
		$context = new ContextBag();

		expect($action($input, $context))->toBeInstanceOf(SuccessResult::class);
	});
});

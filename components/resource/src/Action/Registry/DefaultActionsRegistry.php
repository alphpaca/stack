<?php declare(strict_types=1);

/*
 * This file is part of Alphpaca Stack (https://github.com/alphpaca/stack).
 *
 * (c) Jacob Tobiasz <jacob@alphpaca.io>
 *
 * This source file is subject to the Apache License 2.0 that is bundled
 * with this source code in the file LICENSE.
 */

namespace Alphpaca\Component\Resource\Action\Registry;

use Alphpaca\Contracts\Resource\Action\Action;
use Alphpaca\Contracts\Resource\Action\Registry\ActionCannotBeAddedException;
use Alphpaca\Contracts\Resource\Action\Registry\Registry;

final class DefaultActionsRegistry implements Registry
{
	/** @var array<string, Action> */
	private array $actions = [];

	public function add(string $name, Action $resourceAction): void
	{
		if (isset($this->actions[$name])) {
			throw new ActionCannotBeAddedException($name, $resourceAction, 'Action "%s" cannot be added to the registry as the action with the same name already exists.');
		}

		$this->actions[$name] = $resourceAction;
	}

	public function getByName(string $name): null|Action
	{
		return $this->actions[$name] ?? null;
	}
}

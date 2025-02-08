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
use Alphpaca\Component\Resource\Action\MiddlewareChainAction;
use Alphpaca\Component\Resource\Action\Result\SuccessResult;
use Alphpaca\Contracts\Resource\Action\Action;
use Alphpaca\Contracts\Resource\Action\Context\Context;
use Alphpaca\Contracts\Resource\Action\Input\Input;
use Alphpaca\Contracts\Resource\Action\Middleware;
use Alphpaca\Contracts\Resource\Action\Result;

describe('Middleware Chain Action', function () {
	covers(MiddlewareChainAction::class);

	it('invokes the middleware chain in the correct order', function () {
		$validationMiddleware = new class implements Middleware {

			public function __invoke(Input $input, Context $context, callable $next): Result
			{
				echo 'Validation middleware start';

				$result = $next($input, $context);

				echo 'Validation middleware end';

				return $result;
			}
		};

		$enrichInputMiddleware = new class implements Middleware {
			public function __invoke(Input $input, Context $context, callable $next): Result
			{
				echo 'Enrich input middleware start';

				$result = $next($input, $context);

				echo 'Enrich input middleware end';

				return $result;
			}
		};

		$action = new class implements Action {
			public function __invoke(Input $input, Context $context): Result
			{
				echo 'Action start';

				$result = new SuccessResult();

				echo 'Action end';

				return $result;
			}
		};

		$middlewareChain = new MiddlewareChainAction($action, $validationMiddleware, $enrichInputMiddleware);

		ob_start();
		$result = $middlewareChain(new InputBag(), new ContextBag());
		$output = ob_get_contents();
		ob_end_clean();

		expect($result)->toBeInstanceOf(SuccessResult::class)
			->and($output)->toBe('Validation middleware startEnrich input middleware startAction startAction endEnrich input middleware endValidation middleware end');
	});

	it('invokes only the action if no middleware is provided', function () {
		$originalAction = new class implements Action {
			public function __invoke(Input $input, Context $context): Result
			{
				echo 'Action start';

				$result = new SuccessResult();

				echo 'Action end';

				return $result;
			}
		};

		$middlewareChain = new MiddlewareChainAction($originalAction);

		ob_start();
		$result = $middlewareChain(new InputBag(), new ContextBag());
		$output = ob_get_contents();
		ob_end_clean();

		expect($result)->toBeInstanceOf(SuccessResult::class)
			->and($output)->toBe('Action startAction end');
	});
});

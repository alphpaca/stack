<?php

declare(strict_types=1);

use Alphpaca\Component\Resource\Action\Context\ContextBag;
use Alphpaca\Component\Resource\Action\GetSingleAction;
use Alphpaca\Component\Resource\Action\Input\InputBag;
use Alphpaca\Component\Resource\Action\Result\SuccessResult;

describe('Get Single Action', function () {
    covers(GetSingleAction::class);

    it('returns success result', function () {
        $action = new GetSingleAction();

        $input = new InputBag();
        $context = new ContextBag();

        expect($action($input, $context))->toBeInstanceOf(SuccessResult::class);
    });
});

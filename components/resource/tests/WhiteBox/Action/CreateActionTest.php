<?php

declare(strict_types=1);

use Alphpaca\Component\Resource\Action\Context\ContextBag;
use Alphpaca\Component\Resource\Action\CreateAction;
use Alphpaca\Component\Resource\Action\Input\InputBag;
use Alphpaca\Component\Resource\Action\Result\SuccessResult;

describe('Create Action', function () {
    covers(CreateAction::class);

    it('returns success result once a resource is created', function () {
        $action = new CreateAction();

        $input = new InputBag();
        $context = new ContextBag();

        expect($action($input, $context))->toBeInstanceOf(SuccessResult::class);
    });
});

<?php

declare(strict_types=1);

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

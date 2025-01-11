<?php

declare(strict_types=1);

use Alphpaca\Component\Resource\Action\Context\ContextBag;
use Alphpaca\Component\Resource\Action\DeleteAction;
use Alphpaca\Component\Resource\Action\Input\InputBag;
use Alphpaca\Component\Resource\Action\Result\SuccessResult;

describe('Delete Action', function () {
    covers(DeleteAction::class);

    it('returns success result once a resource is deleted', function () {
        $action = new DeleteAction();

        $input = new InputBag();
        $context = new ContextBag();

        expect($action($input, $context))->toBeInstanceOf(SuccessResult::class);
    });
});

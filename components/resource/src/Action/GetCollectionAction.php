<?php

declare(strict_types=1);

namespace Alphpaca\Component\Resource\Action;

use Alphpaca\Component\Resource\Action\Result\SuccessResult;
use Alphpaca\Contracts\Resource\Action\Action;
use Alphpaca\Contracts\Resource\Action\Context\Context;
use Alphpaca\Contracts\Resource\Action\Input\Input;
use Alphpaca\Contracts\Resource\Action\Result;

class GetCollectionAction implements Action
{
    public function __invoke(Input $input, Context $context): Result
    {
        return new SuccessResult();
    }
}

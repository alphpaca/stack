<?php

declare(strict_types=1);

namespace Alphpaca\Component\Resource\Action\Result;

use Alphpaca\Contracts\Resource\Action\Result;

readonly class GenericErrorResult implements Result
{
    public function isSuccessful(): bool
    {
        return false;
    }
}

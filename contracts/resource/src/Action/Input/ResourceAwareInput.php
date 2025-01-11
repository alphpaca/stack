<?php

declare(strict_types=1);

namespace Alphpaca\Contracts\Resource\Action\Input;

use Alphpaca\Contracts\Resource\Resource;

/**
 * A representation of a resource action input that is aware of the resource.
 *
 * @since 0.1
 */
interface ResourceAwareInput extends Input
{
    /**
     * Returns the resource associated with the input.
     *
     * @return Resource the resource
     *
     * @since 0.1
     */
    public function getResource(): Resource;
}

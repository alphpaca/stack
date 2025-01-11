<?php

declare(strict_types=1);

namespace Alphpaca\Contracts\Resource\Action\Context;

use Alphpaca\Contracts\Resource\Resource;

/**
 * A representation of a resource action context being aware of the resource.
 *
 * @since 0.1
 */
interface ResourceAwareContext extends Context
{
    /**
     * Returns the resource associated with the current context.
     *
     * @return Resource the resource
     *
     * @since 0.1
     */
    public function getResource(): Resource;
}

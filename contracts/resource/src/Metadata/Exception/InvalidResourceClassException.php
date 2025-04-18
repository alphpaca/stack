<?php declare(strict_types=1);

namespace Alphpaca\Contracts\Resource\Metadata\Exception;

use Alphpaca\Contracts\Resource\Metadata\ResourceInterface;

class InvalidResourceClassException extends \InvalidArgumentException
{
    /**
     * @param class-string $class
     */
    public static function dueToNonExistingClass(string $class): self
    {
        return new self(sprintf('Class "%s" does not exist.', $class));
    }

    /**
     * @param class-string $class
     */
    public static function dueToNonResourceClass(string $class): self
    {
        return new self(sprintf(
            'Class "%s" must implement the "%s" interface to be a valid resource.',
            $class,
            ResourceInterface::class,
        ));
    }
}
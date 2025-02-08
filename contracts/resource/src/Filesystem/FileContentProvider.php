<?php declare(strict_types=1);

/*
 * This file is part of Alphpaca Stack (https://github.com/alphpaca/stack).
 *
 * (c) Jacob Tobiasz <jacob@alphpaca.io>
 *
 * This source file is subject to the Apache License 2.0 that is bundled
 * with this source code in the file LICENSE.
 */

namespace Alphpaca\Contracts\Resource\Filesystem;

use Alphpaca\Contracts\Resource\Filesystem\Exception\FileCannotBeFoundException;
use Alphpaca\Contracts\Resource\Filesystem\Exception\FileCannotBeReadException;

/**
 * A representation of a service providing a file content.
 *
 * @since v0.1
 */
interface FileContentProvider
{
    /**
     * Returns the content of a given file. If the file cannot be found, an exception will be thrown.
     *
     * @throws FileCannotBeFoundException if the file cannot be found
     * @throws FileCannotBeReadException  if the file cannot be read
     *
     * @since v0.1
     */
    public function provide(string $path): string;
}

<?php declare(strict_types=1);

/*
 * This file is part of Alphpaca Stack (https://github.com/alphpaca/stack).
 *
 * (c) Jacob Tobiasz <jacob@alphpaca.io>
 *
 * This source file is subject to the Apache License 2.0 that is bundled
 * with this source code in the file LICENSE.
 */

namespace Alphpaca\Component\Resource\Filesystem;

use Alphpaca\Contracts\Resource\Filesystem\Exception\FileCannotBeFoundException;
use Alphpaca\Contracts\Resource\Filesystem\Exception\FileCannotBeReadException;
use Alphpaca\Contracts\Resource\Filesystem\FileContentProvider as FileContentProviderContract;
use Alphpaca\Contracts\Resource\Filesystem\FileExistenceChecker;

final readonly class FileContentProvider implements FileContentProviderContract
{
    public function __construct(
        private FileExistenceChecker $fileExistenceChecker,
    )
    {
    }

    public function provide(string $path): string
    {
        if (!$this->fileExistenceChecker->exists($path)) {
            throw new FileCannotBeFoundException(sprintf('File "%s" does not exist.', $path));
        }

        $content = file_get_contents($path);

	    if ($content === false) {
            throw new FileCannotBeReadException(sprintf('File "%s" cannot be read.', $path));
        }

        return $content;
    }
}

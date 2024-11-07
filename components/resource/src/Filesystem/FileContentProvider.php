<?php

declare(strict_types=1);

/*
 * This file is part of Alphpaca Stack (https://github.com/alphpaca/stack).
 *
 * (c) Jacob Tobiasz <jacob@alphpaca.io>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Alphpaca\Component\Resource\Filesystem;

use Alphpaca\Contracts\Resource\Filesystem\Exception\FileCannotBeFoundException;
use Alphpaca\Contracts\Resource\Filesystem\FileContentProvider as FileContentProviderContract;

final readonly class FileContentProvider implements FileContentProviderContract
{
    public function provide(string $path): string
    {
        $content = file_get_contents($path);

        if (false === $content) {
            throw new FileCannotBeFoundException();
        }

        return $content;
    }
}

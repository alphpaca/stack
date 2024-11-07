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

use Alphpaca\Contracts\Resource\Filesystem\FileExistenceChecker as FileExistenceCheckerContract;

final readonly class FileExistenceChecker implements FileExistenceCheckerContract
{
    public function exists(string $path): bool
    {
        return file_exists($path);
    }
}

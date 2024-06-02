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

namespace Alphpaca\ResourceBundle\Infrastructure\IO;

use Alphpaca\Contracts\IO\FilesystemInterface;

/** @internal */
final class Filesystem implements FilesystemInterface
{
    public function load(string $path): string
    {
        $content = file_get_contents($path);

        if (false === $content) {
            throw new \RuntimeException(sprintf('Failed to load file "%s".', $path));
        }

        return $content;
    }

    public function exists(string $path): bool
    {
        return file_exists($path);
    }
}

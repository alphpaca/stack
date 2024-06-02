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

namespace Tests\Alphpaca\ResourceBundle\WhiteBox\Loader\XmlLoader;

use Alphpaca\Contracts\IO\FilesystemInterface;

final class FakeFilesystem implements FilesystemInterface
{
    public function load(string $path): string
    {
        $validResource = <<<XML
            <?xml version="1.0" encoding="UTF-8"?>
            <resource-mapping>
                <resource name="dummy" class="\App\Resource\Dummy" />
            </resource-mapping>
            XML;

        return match (true) {
            str_ends_with($path, 'valid_resource.xml') => $validResource,
            default => '',
        };
    }

    public function exists(string $path): bool
    {
        return match (true) {
            str_ends_with($path, 'valid_resource.xml') => true,
            default => false,
        };
    }
}

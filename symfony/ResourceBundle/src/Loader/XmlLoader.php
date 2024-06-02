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

namespace Alphpaca\ResourceBundle\Loader;

use Alphpaca\Contracts\IO\FilesystemInterface;
use Alphpaca\Contracts\Resource\Loader\Exception\ResourceLoaderException;
use Alphpaca\Contracts\Resource\Loader\LoaderInterface;
use Alphpaca\Contracts\Resource\Metadata\ResourceMetadataInterface;
use Alphpaca\ResourceBundle\Metadata\ResourceMetadata;
use Symfony\Component\Config\Util\XmlUtils;

final readonly class XmlLoader implements LoaderInterface
{
    public function __construct(
        private FilesystemInterface $filesystem,
    ) {
    }

    public function load(mixed $source): ResourceMetadataInterface
    {
        if (!$this->filesystem->exists($source)) {
            throw new ResourceLoaderException(sprintf('The file "%s" does not exist.', $source));
        }

        $parsedXml = XmlUtils::parse($this->filesystem->load($source));
        $resource = $parsedXml->documentElement->firstElementChild;

        return new ResourceMetadata(
            $resource->attributes->getNamedItem('name')->nodeValue,
            $resource->attributes->getNamedItem('class')->nodeValue,
        );
    }

    public function supports(mixed $source): bool
    {
        return is_string($source) && str_ends_with($source, '.xml');
    }
}

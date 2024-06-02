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

namespace Tests\Alphpaca\ResourceBundle\WhiteBox\Loader;

use Alphpaca\Contracts\Resource\Loader\Exception\ResourceLoaderException;
use Alphpaca\ResourceBundle\Loader\XmlLoader;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Tests\Alphpaca\ResourceBundle\WhiteBox\Loader\XmlLoader\FakeFilesystem;

final class XmlLoaderTest extends TestCase
{
    #[Test]
    #[DataProvider('provideInvalidSources')]
    public function it_does_not_support_invalid_sources(mixed $source): void
    {
        $loader = $this->getTestSubject();
        $isSourceSupported = $loader->supports($source);

        $this->assertSame(false, $isSourceSupported);
    }

    #[Test]
    public function it_supports_valid_sources(): void
    {
        $loader = $this->getTestSubject();
        $isSourceSupported = $loader->supports('file.xml');

        $this->assertSame(true, $isSourceSupported);
    }

    public static function provideInvalidSources(): iterable
    {
        yield 'null' => [null];
        yield 'false' => [false];
        yield 'true' => [true];
        yield 'int' => [1];
        yield 'float' => [1.1];
        yield 'array' => [[]];
        yield 'object' => [new \stdClass()];
        yield 'non-xml-file-path' => ['file.txt'];
    }

    #[Test]
    public function it_throws_an_exception_when_a_given_file_does_not_exist(): void
    {
        $this->expectException(ResourceLoaderException::class);
        $this->expectExceptionMessage('The file "/app/i_am_not_existing.xml" does not exist.');

        $loader = $this->getTestSubject();
        $loader->load('/app/i_am_not_existing.xml');
    }

    #[Test]
    public function it_loads_resource_from_xml_file(): void
    {
        $loader = $this->getTestSubject();
        $metadata = $loader->load('valid_resource.xml');

        $this->assertSame('dummy', $metadata->getName());
        $this->assertSame('\App\Resource\Dummy', $metadata->getClass());
    }

    private function getTestSubject(): XmlLoader
    {
        return new XmlLoader(new FakeFilesystem());
    }
}

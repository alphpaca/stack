<?php declare(strict_types=1);

/*
 * This file is part of Alphpaca Stack (https://github.com/alphpaca/stack).
 *
 * (c) Jacob Tobiasz <jacob@alphpaca.io>
 *
 * This source file is subject to the Apache License 2.0 that is bundled
 * with this source code in the file LICENSE.
 */

namespace Alphpaca\Contracts\Resource\Parser;

use Alphpaca\Contracts\Resource\Parser\Exception\ParsingException;

/**
 * A representation of a PHP parser, transforming PHP code into an AST.
 *
 * @since v0.1
 */
interface PhpParser
{
    /**
     * Parses a given PHP code into an AST. If the code cannot be parsed, an exception will be thrown.
     *
     * @return array<mixed>
     *
     * @throws ParsingException
     *
     * @since v0.1
     */
    public function parse(string $code): array;
}

<?php

declare(strict_types=1);

/*
 * This file is part of Alphpaca Stack (https://github.com/alphpaca/stack).
 *
 * (c) Jacob Tobiasz <jacob@alphpaca.io>
 *
 * This source file is subject to the Apache License 2.0 that is bundled
 * with this source code in the file LICENSE.
 */

namespace Alphpaca\Component\Resource\Parser;

use Alphpaca\Contracts\Resource\Parser\Exception\ParsingException;
use Alphpaca\Contracts\Resource\Parser\PhpParser as PhpParserContract;
use PhpParser\Node;
use PhpParser\NodeTraverserInterface;
use PhpParser\Parser;

final readonly class PhpParser implements PhpParserContract
{
    public function __construct(
        private Parser $parser,
        private NodeTraverserInterface $nodeTraverser,
    ) {
    }

    /**
     * @return array<Node>
     */
    public function parse(string $code): array
    {
        $statements = $this->parser->parse($code);

        if (null === $statements) {
            throw new ParsingException();
        }

        return $this->nodeTraverser->traverse($statements);
    }
}

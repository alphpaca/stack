<?php

declare(strict_types=1);

use Alphpaca\Component\Resource\Parser\PhpParser;
use Alphpaca\Contracts\Resource\Parser\Exception\ParsingException;
use PhpParser\NodeTraverserInterface;
use PhpParser\Parser;

describe('Php Parser', function () {
    it('parses a provided code and returns an array of elements', function () {
        $parser = mock(Parser::class);
        $parser->expects('parse')->with('my amazing php script')->andReturns(['some', 'array', 'for', 'traverser']);

        $nodeTraverser = mock(NodeTraverserInterface::class);
        $nodeTraverser->expects('traverse')->with(['some', 'array', 'for', 'traverser'])->andReturns(['some', 'array', 'from', 'traverser']);

        $testSubject = new PhpParser($parser, $nodeTraverser);
        $result = $testSubject->parse('my amazing php script');

        expect($result)->toBe(['some', 'array', 'from', 'traverser']);
    });

    it('throws an exception if a provided code cannot be parsed', function () {
        $parser = mock(Parser::class);
        $parser->expects('parse')->andReturns(null);

        $nodeTraverser = mock(NodeTraverserInterface::class);

        $testSubject = new PhpParser($parser, $nodeTraverser);
        $testSubject->parse('my amazing php script');
    })->throws(ParsingException::class);
});
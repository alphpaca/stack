<?php

declare(strict_types=1);

use Alphpaca\Component\Resource\Action\Context\ContextBag;

describe('Context Bag', function () {
    it('stores values', function () {
        $contextBag = new ContextBag();

        $contextBag->add('foo', 'bar');

        expect($contextBag->get('foo'))->toBe('bar');
    });

    it('retrieves values', function () {
        $contextBag = new ContextBag(['foo' => 'bar']);

        expect($contextBag->get('foo'))->toBe('bar');
    });

    it('fallbacks to default values when key is not found', function () {
        $inputBag = new ContextBag();

        expect($inputBag->get('foo', 'bar'))->toBe('bar');
    });

    it('returns whether a key exists', function () {
        $inputBag = new ContextBag(['foo' => 'bar']);

        expect($inputBag->has('foo'))->toBeTrue()
            ->and($inputBag->has('bar'))->toBeFalse()
        ;
    });
});

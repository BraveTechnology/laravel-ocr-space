<?php

it('can parse a engine type', function (): void {
    $engine = \Codesmiths\LaravelOcrSpace\Enums\OcrSpaceEngine::from('1');

    expect($engine)->toBe(\Codesmiths\LaravelOcrSpace\Enums\OcrSpaceEngine::Engine1);
});

it('throws exception if engine type is invalid', function (): void {
    dd(\Codesmiths\LaravelOcrSpace\Enums\OcrSpaceEngine::fromString('3'));
})->throws(\ValueError::class, 'Invalid engine type "3".');

<?php

it('can parse a engine type', function (): void {
    $engine = \Tdwesten\OcrSpace\Enums\OcrSpaceEngine::from('1');

    expect($engine)->toBe(\Tdwesten\OcrSpace\Enums\OcrSpaceEngine::Engine1);
});

it('throws exception if engine type is invalid', function (): void {
    dd(\Tdwesten\OcrSpace\Enums\OcrSpaceEngine::fromString('3'));
})->throws(\ValueError::class, 'Invalid engine type "3".');

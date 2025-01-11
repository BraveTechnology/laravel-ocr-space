<?php

use Codesmiths\LaravelOcrSpace\Enums\Language;
use Codesmiths\LaravelOcrSpace\Enums\OcrSpaceEngine;

it('can be tranformed to array', function (): void {

    $options = new \Codesmiths\LaravelOcrSpace\OcrSpaceOptions(
        overlayRequired: true,
        fileType: 'image/png',
        isTable: true,
        OCREngine: OcrSpaceEngine::Engine1,
        scale: true,
        isSearchablePdfHideTextLayer: true,
        isCreateSearchablePdf: true,
        detectOrientation: true,
        language: Language::English,
    );

    expect($options->toArray())->toBe([
        [
            'name' => 'language',
            'contents' => 'eng',
        ],
        [
            'name' => 'isOverlayRequired',
            'contents' => 'true',
        ],
        [
            'name' => 'filetype',
            'contents' => 'image/png',
        ],
        [
            'name' => 'detectOrientation',
            'contents' => 'true',
        ],
        [
            'name' => 'isCreateSearchablePdf',
            'contents' => 'true',
        ],
        [
            'name' => 'isSearchablePdfHideTextLayer',
            'contents' => 'true',
        ],
        [
            'name' => 'scale',
            'contents' => 'true',
        ],
        [
            'name' => 'isTable',
            'contents' => 'true',
        ],
        [
            'name' => 'OCREngine',
            'contents' => '1',
        ],
    ]);
});

it('can be tranformed to array with null values', function (): void {
    $options = new \Codesmiths\LaravelOcrSpace\OcrSpaceOptions;

    expect($options->toArray())->toBe([
        [
            'name' => 'isOverlayRequired',
            'contents' => 'false',
        ],
        [
            'name' => 'detectOrientation',
            'contents' => 'false',
        ],
        [
            'name' => 'isCreateSearchablePdf',
            'contents' => 'false',
        ],
        [
            'name' => 'isSearchablePdfHideTextLayer',
            'contents' => 'false',
        ],
        [
            'name' => 'scale',
            'contents' => 'false',
        ],
        [
            'name' => 'isTable',
            'contents' => 'false',
        ],
    ]);
});

it('can set options', function (): void {
    $options = new \Codesmiths\LaravelOcrSpace\OcrSpaceOptions;

    $options->language(Language::English);
    $options->overlayRequired(true);
    $options->fileType('application/pdf');
    $options->detectOrientation(true);
    $options->isCreateSearchablePdf(true);
    $options->isSearchablePdfHideTextLayer(true);
    $options->scale(true);
    $options->isTable(true);
    $options->OCREngine(OcrSpaceEngine::Engine1);

    expect($options->toArray())->toBe([
        [
            'name' => 'language',
            'contents' => 'eng',
        ],
        [
            'name' => 'isOverlayRequired',
            'contents' => 'true',
        ],
        [
            'name' => 'filetype',
            'contents' => 'application/pdf',
        ],
        [
            'name' => 'detectOrientation',
            'contents' => 'true',
        ],
        [
            'name' => 'isCreateSearchablePdf',
            'contents' => 'true',
        ],
        [
            'name' => 'isSearchablePdfHideTextLayer',
            'contents' => 'true',
        ],
        [
            'name' => 'scale',
            'contents' => 'true',
        ],
        [
            'name' => 'isTable',
            'contents' => 'true',
        ],
        [
            'name' => 'OCREngine',
            'contents' => '1',
        ],
    ]);
});

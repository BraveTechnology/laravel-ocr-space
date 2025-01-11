<?php

it('parses an image file', function (): void {
    $filePath = __DIR__.'/../Fixtures/test-image.png';
    $service = new \Tdwesten\OcrSpace\OcrSpace;
    $options = new \Tdwesten\OcrSpace\OcrSpaceOptions;

    $response = $service->parseImageFile(
        filePath: $filePath,
        options: $options,
    );

    expect($response)->toBeInstanceOf(\Tdwesten\OcrSpace\ValueObjects\OcrSpaceResponse::class)
        ->and($response->hasError())->toBeFalse()
        ->and($response->getParsedResults())->count(1)
        ->and($response->getParsedResults()[0])->toBeInstanceOf(\Tdwesten\OcrSpace\ValueObjects\ParsedResult::class);
});

it('parses a binary image', function (): void {
    $filePath = __DIR__.'/../Fixtures/test-image.png';
    $service = new \Tdwesten\OcrSpace\OcrSpace;
    $options = new \Tdwesten\OcrSpace\OcrSpaceOptions;
    $options = $options->fileType('image/png');

    $response = $service->parseImageBinary(
        file_get_contents($filePath),
        $options,
    );

    expect($response)->toBeInstanceOf(\Tdwesten\OcrSpace\ValueObjects\OcrSpaceResponse::class)
        ->and($response->hasError())->toBeFalse()
        ->and($response->getParsedResults())->count(1);
});

it('parses a base64 image', function (): void {
    $filePath = __DIR__.'/../Fixtures/test-image.png';
    $service = new \Tdwesten\OcrSpace\OcrSpace;
    $options = new \Tdwesten\OcrSpace\OcrSpaceOptions;
    $options = $options->fileType('image/png');

    $response = $service->parseImageBase64(
        base64_encode(file_get_contents($filePath)),
        $options,
    );

    expect($response)->toBeInstanceOf(\Tdwesten\OcrSpace\ValueObjects\OcrSpaceResponse::class)
        ->and($response->hasError())->toBeFalse()
        ->and($response->getParsedResults())->count(1);
});

it('parses an image url', function (): void {
    $service = new \Tdwesten\OcrSpace\OcrSpace;
    $options = new \Tdwesten\OcrSpace\OcrSpaceOptions;

    $response = $service->parseImageUrl(
        'https://tdwesten.github.io/ocr-space-api-wrapper/test-image.png',
        $options,
    );

    expect($response)->toBeInstanceOf(\Tdwesten\OcrSpace\ValueObjects\OcrSpaceResponse::class)
        ->and($response->hasError())->toBeFalse()
        ->and($response->getParsedResults())->count(1);
});

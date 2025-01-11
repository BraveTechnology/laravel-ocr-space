# Laravel OCR Space

Laravel OCR Space is a package that allows you to use the [OCR.Space](https://ocr.space/ocrapi) API in your Laravel application for Optical Character Recognition (OCR).

## Installation

You can install the package via composer:

```bash
composer require cdsmiths/laravel-ocr-space
```

You can publish the config file with:

```bash
php artisan vendor:publish --provider="Codesmiths\LaravelOcrSpace\LaravelOcrSpaceServiceProvider" --tag="config"
```

## Usage

### Get a free Ocr.Space api key

You can get a free api key from [ocr.space](https://ocr.space/ocrapi/freekey). This key is required to use the package.

### Parsing an Image file

```php
use Codesmiths\LaravelOcrSpace\OcrSpaceOptions;
use Codesmiths\LaravelOcrSpace\Facades\LaravelOcrSpace;

$filePath = 'path/to/image.jpg';

$result = $service->parseImageFile(
    $filePath,
    OcrSpaceOptions::make(),
);

dd($result);
```

### Parsing an Image URL

```php
use Codesmiths\LaravelOcrSpace\OcrSpaceOptions;
use Codesmiths\LaravelOcrSpace\Facades\LaravelOcrSpace;

$imageUrl = 'https://example.com/image.jpg';

$options = new \Codesmiths\LaravelOcrSpace\OcrSpaceOptions();

$result = $service->parseImageUrl(
    url: $imageUrl,
    options: OcrSpaceOptions::make(),
);

dd($result);
```

### Parsing an base64 encoded image

```php
use Codesmiths\LaravelOcrSpace\OcrSpaceOptions;
use Codesmiths\LaravelOcrSpace\Facades\LaravelOcrSpace;

$base64Image = 'base64-encoded-image';

$result = $service->parseBase64Image(
    base64Image: $base64Image,
    options: OcrSpaceOptions::make(),
);

dd($result);
```

### Parsing an binary image

```php

use Codesmiths\LaravelOcrSpace\OcrSpaceOptions;
use Codesmiths\LaravelOcrSpace\Facades\LaravelOcrSpace;

$binaryImage = file_get_contents('path/to/image.jpg');

// File type is required for binary images
$options = OcrSpaceOptions::make()
    ->fileType('jpg');

$result = $service->parseBinaryImage(
    $binaryImage,
    $options,
);

dd($result);
```

### Parsing with parseImage method

```php
use Codesmiths\LaravelOcrSpace\OcrSpaceOptions;
use Codesmiths\LaravelOcrSpace\Facades\LaravelOcrSpace;
use Codesmiths\LaravelOcrSpace\Enums\InputType;

$filePath = 'path/to/image.jpg';

$result = $service->parseImage(
    InputType::File
    $filePath,
    OcrSpaceOptions::make(),
);

dd($result);
```

### Options

You can pass options to the `parseImageFile`, `parseImageUrl`, `parseBase64Image`, `parseBinaryImage` and `parseImage` methods.

```php
use Codesmiths\LaravelOcrSpace\OcrSpaceOptions;
use Codesmiths\LaravelOcrSpace\Enums\Language;
use Codesmiths\LaravelOcrSpace\Enums\OcrSpaceEngine;

// All possible options
$options = OcrSpaceOptions::make()
        ->language(Language::English)
        ->overlayRequired(true)
        ->fileType('image/png')
        ->detectOrientation(true)
        ->isCreateSearchablePdf(true)
        ->isSearchablePdfHideTextLayer(true)
        ->scale(true)
        ->isTable(true)
        ->OCREngine(OcrSpaceEngine::Engine1);

```

# License / Credits

Ocr.Space API is a product of [ocr.space](https://ocr.space/ocrapi). This package is not affiliated with ocr.space.

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

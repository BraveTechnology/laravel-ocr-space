<?php

use Tdwesten\OcrSpace\Enums\Language;

it('can parse a language', function (): void {
    $language = Language::from('eng');

    expect($language)->toBe(Language::English);
});

<?php

it('can be instantiated', function () {
    $options = new \Codesmiths\LaravelOcrSpace\OcrSpaceOptions;
    expect($options)->toBeInstanceOf(\Codesmiths\LaravelOcrSpace\OcrSpaceOptions::class);
});

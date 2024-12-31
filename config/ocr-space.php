<?php

// config for Thomas Van Der Westen/OcrSpace
return [
    /**
     * ---------------------------------------------------------------
     * OCR Space API Key
     * ---------------------------------------------------------------
     */
    'api_key' => env('OCR_SPACE_API_KEY'),

    /**
     * ---------------------------------------------------------------
     * OCR Space API URL
     * ---------------------------------------------------------------
     */
    'api_url' => env('OCR_SPACE_API_URL', 'https://api.ocr.space/parse/image'),
];

<?php

namespace Tdwesten\OcrSpace\Tests;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Http;
use Orchestra\Testbench\TestCase as Orchestra;
use Tdwesten\OcrSpace\OcrSpaceServiceProvider;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();

        Factory::guessFactoryNamesUsing(
            fn (string $modelName): string => 'Tdwesten\\OcrSpace\\Database\\Factories\\'.class_basename($modelName).'Factory'
        );

        Http::fake([
            'https://api.ocr.space/parse/image' => function () {
                $testResponse = fopen(__DIR__.'/stubs/test-response.json', 'r');

                return Http::response($testResponse);
            },
        ]);
    }

    protected function getPackageProviders($app)
    {
        return [
            OcrSpaceServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app): void
    {
        config()->set('database.default', 'testing');
        config()->set('ocr-space.api_key', '798f2847dd88957');
    }
}

<?php

namespace Codesmiths\LaravelOcrSpace\Tests;

use Codesmiths\LaravelOcrSpace\LaravelOcrSpaceServiceProvider;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Http;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();

        Factory::guessFactoryNamesUsing(
            fn (string $modelName): string => 'Codesmiths\\LaravelOcrSpace\\Database\\Factories\\'.class_basename($modelName).'Factory'
        );

        Http::fake([
            'https://api.ocr.space/parse/image' => function () {
                $testResponse = fopen(__DIR__.'/Fixtures/test-response.json', 'r');

                return Http::response($testResponse);
            },
        ]);
    }

    protected function getPackageProviders($app)
    {
        return [
            LaravelOcrSpaceServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app): void
    {
        config()->set('database.default', 'testing');
        config()->set('ocr-space.api_key', '798f2847dd88957');
    }
}

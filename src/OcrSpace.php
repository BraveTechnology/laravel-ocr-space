<?php

declare(strict_types=1);

namespace Tdwesten\OcrSpace;

use Illuminate\Support\Facades\Http;
use Tdwesten\OcrSpace\Enums\InputType;
use Tdwesten\OcrSpace\Exceptions\InvalidRequestException;
use Tdwesten\OcrSpace\ValueObjects\OcrSpaceResponse;

class OcrSpace
{
    public function getApiKey(): string
    {
        return $this->getConfigValue('api_key');
    }

    public function getApiUrl(): string
    {
        return $this->getConfigValue('api_url');
    }

    public function getConfigValue(string $key): string
    {
        $key = sprintf('ocr-space.%s', $key);
        $value = config($key);

        if (empty($value)) {
            throw new \Exception(sprintf('OCR Space config value for key "%s" is not set.', $key));
        }

        if (! is_string($value)) {
            throw new \Exception(sprintf('OCR Space config value for key "%s" must be a string.', $key));
        }

        return $value;
    }

    public function parseImage(
        InputType $inputType,
        string $filePath,
        OcrSpaceOptions $options
    ): OcrSpaceResponse {
        $client = Http::asMultipart();
        $client->withHeaders([
            'apikey' => $this->getApiKey(),
        ]);

        $mimeType = $options->fileType ?? false;

        $data = [
            ...$this->parseImageData($inputType, $filePath, $mimeType),
            ...$options->toArray(),
        ];

        $response = $client->post($this->getApiUrl(), $data);

        /**
         * @var array{
         *      ParsedResults: array<int, array{
         *          TextOverlay: array{
         *              Lines: array<int, array{
         *                  Words: array<int, array{
         *                      WordText: string,
         *                      Left: int,
         *                      Top: int,
         *                      Height: int,
         *                      Width: int
         *                  }>,
         *                  MaxHeight: int,
         *                  MinTop: int,
         *              }>,
         *              HasOverlay: bool,
         *              Message: string,
         *          },
         *          FileParseExitCode: string,
         *          ParsedText: string,
         *          ErrorMessage: string|null,
         *          ErrorDetails: string|null,
         *      }>,
         *      OCRExitCode: int|null,
         *      IsErroredOnProcessing: bool|null,
         *      ErrorMessage: array<int, string>|null,
         *      ErrorDetails: string|null,
         *      ProcessingTimeInMilliseconds: int|null,
         *      SearchablePDFURL: string|null
         * } $data The response data
         */
        $data = $response->json();

        $result = OcrSpaceResponse::fromResponse($data);

        if ($result->hasError()) {
            throw new InvalidRequestException((string) $result->getErrorDetails());
        }

        return $result;
    }

    /**
     * @param  InputType  $inputType  The parsing type
     * @param  string  $filePath  The file path
     * @return array<int, array<string, bool|resource|string>> The parsed image data
     */
    protected function parseImageData(InputType $inputType, string $filePath, string|false $mimeType): array
    {
        return match ($inputType) {
            InputType::Binary => [
                [
                    'name' => 'base64image',
                    'contents' => $this->covertBinaryImageToBase64($filePath),
                ],
                [
                    'name' => 'fileType',
                    'contents' => $mimeType,
                ],
            ],
            InputType::Base64 => [
                [
                    'name' => 'base64image',
                    'contents' => $filePath,
                ],
                [
                    'name' => 'fileType',
                    'contents' => $mimeType,
                ],
            ],
            InputType::File => [
                [
                    'name' => 'file',
                    'contents' => fopen($filePath, 'r'),
                ],
                [
                    'name' => 'filetype',
                    'contents' => $mimeType,
                ],
            ],
            InputType::Url => [
                [
                    'name' => 'url',
                    'contents' => $filePath,
                ],
            ]
        };
    }

    private function covertBinaryImageToBase64(string $image): string
    {
        return base64_encode($image);
    }

    public function parseImageFile(string $filePath, OcrSpaceOptions $options): OcrSpaceResponse
    {
        return $this->parseImage(InputType::File, $filePath, $options);
    }

    public function parseImageBinary(string $binary, OcrSpaceOptions $options): OcrSpaceResponse
    {
        if ($options->fileType === null) {
            throw new \Exception('The file type is required for binary images in the options.');
        }

        return $this->parseImageBase64(base64_encode($binary), $options);
    }

    public function parseImageBase64(string $base64, OcrSpaceOptions $options): OcrSpaceResponse
    {
        return $this->parseImage(InputType::Base64, 'data:'.$options->fileType.';base64,'.$base64, $options);
    }

    public function parseImageUrl(string $url, OcrSpaceOptions $options): OcrSpaceResponse
    {
        return $this->parseImage(InputType::Url, $url, $options);
    }
}

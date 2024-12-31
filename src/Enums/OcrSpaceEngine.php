<?php

namespace Tdwesten\OcrSpace\Enums;

enum OcrSpaceEngine: string
{
    case Engine1 = '1';
    case Engine2 = '2';

    /**
     * Get the OcrSpaceEngine from a string value.
     *
     * @throws \ValueError
     */
    public static function fromString(string $value): OcrSpaceEngine
    {
        return match ($value) {
            '1' => self::Engine1,
            '2' => self::Engine2,
            default => throw new \ValueError(sprintf('Invalid engine type "%s".', $value)),
        };
    }
}

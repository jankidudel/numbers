<?php

declare(strict_types=1);

namespace App\Service;

// interface NumberConverterStrategyInterface
/**
 * Converts any numeric type integer representation
 */
interface NumSystemToIntStrategyInterface
{
    /**
     * @param string $type
     *
     * @return bool
     */
    public function isConvertable(int $numeralSystem): bool;

    /**
     * @return string
     */
    public function convert(string $value): int;
}

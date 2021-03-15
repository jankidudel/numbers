<?php

declare(strict_types=1);

namespace App\Service;

/**
 * Converts integer to any other numeral system representation
 */
interface IntToNumSystemStrategyInterface
{
    /**
     * @param int $type
     *
     * @return bool
     */
    public function isConvertable(int $numeralSystem): bool;

    /**
     * @return string
     */
    public function convert(int $value): string;
}

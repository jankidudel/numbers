<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\ConvertedNumber;

class IntToHex implements IntToNumSystemStrategyInterface
{
    public function isConvertable(int $numeralSystem): bool
    {
        return $numeralSystem === ConvertedNumber::TYPE_HEX;
    }

    public function convert(int $value): string
    {
        return dechex($value);
    }
}

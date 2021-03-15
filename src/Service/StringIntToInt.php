<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\ConvertedNumber;

class StringIntToInt implements NumSystemToIntStrategyInterface
{
    public function isConvertable(int $numeralSystem): bool
    {
        return $numeralSystem === ConvertedNumber::TYPE_INTEGER;
    }

    public function convert(string $value): int
    {
        $res = (int)$value;

        return $res;
    }
}

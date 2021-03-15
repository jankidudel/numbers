<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\ConvertedNumber;

class HexToInt implements NumSystemToIntStrategyInterface
{
    public function isConvertable(int $numeralSystem): bool
    {
        return $numeralSystem === ConvertedNumber::TYPE_HEX;
    }

    public function convert(string $value): int
    {
        $res = hexdec($value);

        return $res;
    }
}

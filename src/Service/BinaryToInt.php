<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\ConvertedNumber;

class BinaryToInt implements NumSystemToIntStrategyInterface
{
    public function isConvertable(int $numeralSystem): bool
    {
        return $numeralSystem === ConvertedNumber::TYPE_BINARY;
    }

    public function convert(string $value): int
    {
        $res = bindec($value);

        return $res;
    }
}

<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\ConvertedNumber;

class IntToStringInt implements IntToNumSystemStrategyInterface
{
    public function isConvertable(int $numeralSystem): bool
    {
        return $numeralSystem === ConvertedNumber::TYPE_INTEGER;
    }

    public function convert(int $value): string
    {
        return (string)$value;
    }
}

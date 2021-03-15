<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\ConvertedNumber;

class IntToBinary implements IntToNumSystemStrategyInterface
{
    public function isConvertable(int $numeralSystem): bool
    {
        return $numeralSystem === ConvertedNumber::TYPE_BINARY;
    }

    public function convert(int $value): string
    {
        return decbin($value);
    }
}

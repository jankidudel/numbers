<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\ConvertedNumber;

class RomanToInt implements NumSystemToIntStrategyInterface
{
    public function isConvertable(int $numeralSystem): bool
    {
        return $numeralSystem === ConvertedNumber::TYPE_ROMAN;
    }

    public function convert(string $value): int
    {
        // @todo: replace, copied form stackoverflow
        $romans = array(
            'M' => 1000,
            'CM' => 900,
            'D' => 500,
            'CD' => 400,
            'C' => 100,
            'XC' => 90,
            'L' => 50,
            'XL' => 40,
            'X' => 10,
            'IX' => 9,
            'V' => 5,
            'IV' => 4,
            'I' => 1,
        );

        $roman = $value;
        $result = 0;

        foreach ($romans as $key => $value) {
            while (strpos($roman, $key) === 0) {
                $result += $value;
                $roman = substr($roman, strlen($key));
            }
        }

        return $result;
    }
}

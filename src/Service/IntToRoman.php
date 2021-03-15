<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\ConvertedNumber;

class IntToRoman implements IntToNumSystemStrategyInterface // NumSystemToIntStrategyInterface
{
    public function isConvertable(int $numeralSystem): bool
    {
        return $numeralSystem === ConvertedNumber::TYPE_ROMAN;
    }

    public function convert(int $value): string
    {
        // @todo: replace, copied form stackoverflow
        $n = intval($value);
        $result = '';

        $lookup =
            [
                'M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400,
                'C' => 100, 'XC' => 90, 'L' => 50, 'XL' => 40,
                'X' => 10, 'IX' => 9, 'V' => 5, 'IV' => 4, 'I' => 1,
            ];

        foreach ($lookup as $roman => $value) {
            // Look for number of matches
            $matches = intval($n / $value);

            // Concatenate characters
            $result .= str_repeat($roman, $matches);

            // Substract that from the number
            $n = $n % $value;
        }

        return $result;
    }
}

<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\ConvertedNumber;

class NumberConverterContext
{
    private $numSystemToIntStrategies;
    private $intToNumSystemStrategies;


    public function addNumSystemToIntStrategy(NumSystemToIntStrategyInterface $strategy): void
    {
        $this->numSystemToIntStrategies[] = $strategy;
    }

    public function addIntToNumSystemConversionStrategy(IntToNumSystemStrategyInterface $strategy): void
    {
        $this->intToNumSystemStrategies[] = $strategy;
    }

    public function convertToInt(string $value, $numeralSystem): int
    {
        foreach ($this->numSystemToIntStrategies as $strategy) {
            if ($strategy->isconvertable($numeralSystem)) {
                return $strategy->convert($value);
            }
        }

        throw new \InvalidArgumentException(sprintf('Cannot convert from type %s', $numeralSystem));
    }

    public function convertToNumSystem(int $value, $numeralSystem): string
    {
        foreach ($this->intToNumSystemStrategies as $strategy) {
            if ($strategy->isconvertable($numeralSystem)) {
                return $strategy->convert($value);
            }
        }

        throw new \InvalidArgumentException(sprintf('Cannot convert to type %s', $numeralSystem));
    }
}

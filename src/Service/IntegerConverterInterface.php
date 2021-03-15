<?php

declare(strict_types=1);

namespace App\Service;

interface IntegerConverterInterface
{
    public function convertInteger(int $integer): string;
}

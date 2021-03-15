<?php

declare(strict_types=1);

namespace App\Service;

use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Validator\Validator\ValidatorInterface;

use App\Repository\ConvertedNumberRepository;
use App\Service\NumberConverterContext;
use App\Entity\ConvertedNumber;

class ConverterFacade
{
    private NumberConverterContext $converter;
    private ConvertedNumberRepository $repo;
    private ValidatorInterface $validator;

    public function __construct(
        NumberConverterContext $converterContext,
        ConvertedNumberRepository $repo,
        ValidatorInterface $validator
    ) {
        $this->converter = $converterContext;
        $this->repo = $repo;
        $this->validator = $validator;
    }

    public function convert(string $requestContent): string
    {
        $serializer = new Serializer(
            [new DateTimeNormalizer(['datetime_format' => 'd.m.Y H:i:s']), new GetSetMethodNormalizer()],
            [new JsonEncoder()]
        );

        /** @var ConvertedNumber $obj */
        $obj = $serializer->deserialize($requestContent, ConvertedNumber::class, "json");

        $intVal = $this->converter->convertToInt($obj->getOriginal(), $obj->getNumeralTypeFrom());
        $convertedVal = $this->converter->convertToNumSystem($intVal, $obj->getNumeralTypeTo());

        $obj->setOriginalInteger($intVal);
        $obj->setConverted($convertedVal);

        $errors = $this->validator->validate($obj);
        if (count($errors)) {
            throw new \Exception((string) $errors);
        }

        $this->repo->save($obj);

        // @todo: probably not a good idea to serialize here
        $res = $serializer->serialize($obj, 'json');

        return $res;
    }
}

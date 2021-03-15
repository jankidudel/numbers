<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\ConvertedNumber;
use App\Repository\ConvertedNumberRepository;
use App\Service\ConverterFacade;
use Nelmio\ApiDocBundle\Annotation\Model;
use OpenApi\Annotations as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api/numerals", name="numerals")
 */
class NumeralsController extends AbstractController
{
    /**
     * @Route(
     *     "/convert",
     *     name="numerals_convert",
     *     methods={"POST"},
     * )
     *
     * @OA\RequestBody(
     *     description="Convert a number, types:
            <ul>
            <li>0 = binary</li>
            <li>1 = integer</li>
            <li>2 = roman</li>
            <li>3 = hex</li>
            </ul>
          ",
     *     required=true,
     *     @OA\JsonContent(
     *         ref=@Model(
     *             type=ConvertedNumber::class,
     *             groups={"write"}
     *         )
     *     )
     * )
     * @OA\Response(
     *     response=200,
     *     description="Returns the converted number",
     *     @OA\JsonContent(
     *         ref=@Model(
     *             type=ConvertedNumber::class
     *         )
     *     )
     * )
     */
    public function convert(Request $request, ConverterFacade $converterFacade): JsonResponse
    {
        $res = $converterFacade->convert($request->getContent());

        return new JsonResponse($res, 200, [], true);
    }

    /**
     * @Route(
     *     "/recent",
     *     name="numerals_recent",
     *     methods={"GET"},
     * )
     *
     * @OA\Parameter(
     *     name="count",
     *     in="query",
     *     description="How many recent numbers",
     *     @OA\Schema(type="number", default="10")
     * )
     *
     * @OA\Response(
     *     response=200,
     *     description="Returns the converted number",
     *     @OA\JsonContent(
     *         type="array",
     *         @OA\Items(ref=@Model(type=ConvertedNumber::class))
     *     )
     * )
     */
    public function recent(Request $request, ConvertedNumberRepository $repo): JsonResponse
    {
        $count = $request->query->getInt('count', 10);
        $data = $repo->findRecent($count);

        return new JsonResponse($data);
    }

    /**
     * @Route(
     *     "/top/",
     *     name="numerals_top",
     *     methods={"GET"},
     * )
     *
     * @OA\Parameter(
     *     name="count",
     *     in="query",
     *     description="How many recent numbers",
     *     @OA\Schema(type="number", default="10")
     * )
     */
    public function top(Request $request, ConvertedNumberRepository $repo): JsonResponse
    {
        $count = $request->query->getInt('count', 10);
        $data = $repo->findTopConverted($count);

        return new JsonResponse($data);
    }
}

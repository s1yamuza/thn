<?php

namespace THN\Apps\Backoffice\Controller;

use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use THN\Backoffice\Hotel\Application\Transformer\ListHotelResponseTransformer;
use THN\Backoffice\Hotel\Application\UseCase\ListHotelUseCase;

class ListHotelController extends AbstractController
{
    private $usecase;
    private $transformer;

    public function __construct(
        ListHotelUseCase $usecase
    ) {
        $this->usecase = $usecase;
        $this->transformer = new ListHotelResponseTransformer();
    }

    public function __invoke(Request $request): Response
    {
        try {
            $useCaseResponse = $this->usecase->execute();
            $hotels = $useCaseResponse->hotels();

            $responseData = $this->transformer->transform(...$hotels);
        } catch (Exception $e) {
            // handle exception
        }

        return $this->render('base.html.twig', [
            'hotels' => $responseData
        ]);
    }
}

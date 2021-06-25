<?php

namespace THN\Controller;

use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use THN\Backoffice\Hotel\Application\Transformer\GetReservationResponseTransformer;
use THN\Backoffice\Hotel\Application\UseCase\GetHotelReservationUseCase;
use THN\Backoffice\Hotel\Application\UseCase\GetHotelReservationUseCaseRequest;

class GetHotelReservationController extends AbstractController
{
    private $usecase;
    private $transformer;

    public function __construct(
        GetHotelReservationUseCase $usecase
    ) {
        $this->usecase = $usecase;
        $this->transformer = new GetReservationResponseTransformer();
    }

    public function __invoke(Request $request): Response
    {
        $useCaseRequest = new GetHotelReservationUseCaseRequest($request->get('id'));

        try {
            $useCaseResponse = $this->usecase->execute($useCaseRequest->hotelId());
            $reservations = $useCaseResponse->reservation();

            $responseData = $this->transformer->transform(...$reservations);
        } catch (Exception $e) {
            // handle exception
            //die;
        }

        return $this->render('base.html.twig', [
            'reservations' => $responseData
        ]);
    }
}

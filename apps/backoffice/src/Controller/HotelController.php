<?php

namespace THN\Apps\Backoffice\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use THN\Backoffice\Hotel\Infrastructure\Persistence\THNPDO;

class HotelController extends AbstractController
{
    private $pdo;

    public function __construct(THNPDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function list(): Response
    {
        $hotels = $this->pdo->query("SELECT * FROM `hotel`");

        return $this->render('base.html.twig', [
            'hotels' => $hotels
        ]);
    }
}

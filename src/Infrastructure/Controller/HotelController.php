<?php

namespace THN\Infrastructure\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class HotelController extends AbstractController
{

    public function list(): Response
    {
        return $this->render('base.html.twig');
    }
}

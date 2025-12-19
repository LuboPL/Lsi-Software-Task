<?php

declare(strict_types=1);

namespace LsiSoftwareTask\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

final class ReportController extends AbstractController
{
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'message' => 'Symfony + Twig + Doctrine ready',
        ]);
    }
}

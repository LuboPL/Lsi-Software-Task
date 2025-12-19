<?php

declare(strict_types=1);

namespace LsiSoftwareTask\Controller;

use LsiSoftwareTask\Form\ExportHistoryFilterType;
use LsiSoftwareTask\Dto\ExportHistoryFilter;
use LsiSoftwareTask\Repository\ExportHistoryRepositoryInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class ReportController extends AbstractController
{
    public function index(Request $request, ExportHistoryRepositoryInterface $repository): Response
    {
        $form = $this->createForm(ExportHistoryFilterType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && !$form->isValid()) {
            $this->addFlash('error', 'Data od nie moze byc pozniejsza niz data do.');
        }

        $data = $form->getData();
        $filterData = is_array($data) ? $data : [];
        $filter = new ExportHistoryFilter(
            $filterData['location'] ?? null,
            $filterData['dateFrom'] ?? null,
            $filterData['dateTo'] ?? null
        );
        $records = $repository->findByLocalAndDateRange(
            $filter->location,
            $filter->dateFrom,
            $filter->dateTo
        );

        return $this->render('report/export.html.twig', [
            'form' => $form->createView(),
            'records' => $records,
        ]);
    }
}

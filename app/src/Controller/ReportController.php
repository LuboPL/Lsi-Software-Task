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
    public function __construct(
        private readonly ExportHistoryRepositoryInterface $repository
    ) {
    }
    public function index(Request $request): Response
    {
        $form = $this->createForm(ExportHistoryFilterType::class, null, [
            'locations' => $this->repository->getDistinctLocations(),
        ]);
        $form->handleRequest($request);

        /** @var ExportHistoryFilter|null $filter */
        $filter = $form->getData();
        $records = $this->repository->findByLocalAndDateRange(
            $filter?->location,
            $filter?->dateFrom,
            $filter?->dateTo
        );

        return $this->render('report/export_history.html.twig', [
            'form' => $form->createView(),
            'records' => $records,
        ]);
    }
}

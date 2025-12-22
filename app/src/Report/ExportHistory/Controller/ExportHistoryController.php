<?php

declare(strict_types=1);

namespace LsiSoftwareTask\Report\ExportHistory\Controller;

use LsiSoftwareTask\Report\ExportHistory\Form\ExportHistoryFilterType;
use LsiSoftwareTask\Report\ExportHistory\Criteria\ExportHistoryCriteria;
use LsiSoftwareTask\Report\ExportHistory\Query\ExportHistoryReportQueryInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class ExportHistoryController extends AbstractController
{
    public function __construct(
        private readonly ExportHistoryReportQueryInterface $exportHistoryReportQuery
    ) {
    }

    public function index(Request $request): Response
    {
        $form = $this->createForm(ExportHistoryFilterType::class);
        $form->handleRequest($request);

        /** @var ExportHistoryCriteria $criteria */
        $criteria = $form->getData();

        if (!$form->isSubmitted() || $form->isValid()) {
            $records = $this->exportHistoryReportQuery->fetch($criteria);
        }

        return $this->render('report/export_history.html.twig', [
            'form' => $form->createView(),
            'records' => $records ?? [],
        ]);
    }
}

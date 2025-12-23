<?php

declare(strict_types=1);

namespace LsiSoftwareTask\Report\ExportHistory\Controller;

use LsiSoftwareTask\Report\ExportHistory\Form\ExportHistoryFilterType;
use LsiSoftwareTask\Report\ExportHistory\Form\ExportHistoryFilter;
use LsiSoftwareTask\Report\ExportHistory\Mapper\ExportHistoryCriteriaMapper;
use LsiSoftwareTask\Report\ExportHistory\Query\ExportHistoryReportQueryInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class ExportHistoryController extends AbstractController
{
    public function __construct(
        private readonly ExportHistoryReportQueryInterface $exportHistoryReportQuery,
    ) {
    }

    public function index(Request $request): Response
    {
        $form = $this->createForm(ExportHistoryFilterType::class);
        $form->handleRequest($request);

        /** @var ExportHistoryFilter $filter */
        $filter = $form->getData();

        if (!$form->isSubmitted() || $form->isValid()) {
            $records = $this->exportHistoryReportQuery->fetch(ExportHistoryCriteriaMapper::fromFilter($filter));
        }

        return $this->render('report/export_history.html.twig', [
            'form' => $form->createView(),
            'records' => $records ?? [],
        ]);
    }
}

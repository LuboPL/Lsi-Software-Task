<?php

declare(strict_types=1);

namespace LsiSoftwareTask\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormError;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use LsiSoftwareTask\Repository\ExportHistoryRepositoryInterface;

final class ExportHistoryFilterType extends AbstractType
{
    public function __construct(
        private readonly ExportHistoryRepositoryInterface $repository
    ) {
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $locations = $this->repository->getDistinctLocations();
        $locationChoices = array_fill_keys($locations, $locations);

        $builder
            ->add('location', ChoiceType::class, [
                'required' => false,
                'choices' => $locationChoices,
            ])
            ->add('dateFrom', DateType::class, [
                'required' => false,
                'widget' => 'single_text',
                'input' => 'datetime_immutable',
            ])
            ->add('dateTo', DateType::class, [
                'required' => false,
                'widget' => 'single_text',
                'input' => 'datetime_immutable',
            ])
            ->add('submit', SubmitType::class);

        $builder->addEventListener(FormEvents::POST_SUBMIT, function (FormEvent $event): void {
            $data = $event->getData();
            if (!is_array($data)) {
                return;
            }

            $dateFrom = $data['dateFrom'] ?? null;
            $dateTo = $data['dateTo'] ?? null;
            if ($dateFrom instanceof \DateTimeImmutable && $dateTo instanceof \DateTimeImmutable && $dateFrom > $dateTo) {
                $event->getForm()->addError(new FormError('Data od nie moze byc pozniejsza niz data do.'));
            }
        });
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'csrf_protection' => false,
            'method' => 'GET',
        ]);
    }
}

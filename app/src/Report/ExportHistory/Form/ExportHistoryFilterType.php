<?php

declare(strict_types=1);

namespace LsiSoftwareTask\Report\ExportHistory\Form;

use LsiSoftwareTask\Report\ExportHistory\Criteria\ExportHistoryCriteria;
use LsiSoftwareTask\Report\ExportHistory\Provider\LocationProviderInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class ExportHistoryFilterType extends AbstractType
{
    public function __construct(
        private readonly LocationProviderInterface $locationProvider
    ) {
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $locations = $this->locationProvider->getLocations();
        $builder
            ->add('locationName', ChoiceType::class, [
                'required' => false,
                'choices' => array_combine($locations, $locations),
                'choice_translation_domain' => false,
            ])
            ->add('exportFrom', DateType::class, [
                'required' => false,
                'widget' => 'single_text',
                'input' => 'datetime_immutable',
            ])
            ->add('exportTo', DateType::class, [
                'required' => false,
                'widget' => 'single_text',
                'input' => 'datetime_immutable',
            ])
            ->addEventListener(FormEvents::SUBMIT, function (FormEvent $event): void {
                $criteria = $event->getData();
                if (false === $criteria instanceof ExportHistoryCriteria) {
                    return;
                }

                $criteria->normalize();
                $event->setData($criteria);
            });
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ExportHistoryCriteria::class,
            'data' => new ExportHistoryCriteria(),
            'csrf_protection' => false,
            'method' => 'GET',
        ]);
    }

    public function getBlockPrefix(): string
    {
        return '';
    }
}

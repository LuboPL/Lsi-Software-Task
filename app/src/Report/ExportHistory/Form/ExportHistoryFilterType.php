<?php

declare(strict_types=1);

namespace LsiSoftwareTask\Report\ExportHistory\Form;

use LsiSoftwareTask\Report\ExportHistory\Form\Transformer\EndOfDayTransformer;
use LsiSoftwareTask\Report\ExportHistory\Provider\LocationProviderInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class ExportHistoryFilterType extends AbstractType
{
    public function __construct(
        private readonly LocationProviderInterface $locationProvider,
    ) {
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $locations = $this->locationProvider->getLocations();
        $locationChoices = $locations !== [] ? array_combine($locations, $locations) : [];
        $builder
            ->add('locationName', ChoiceType::class, [
                'required' => false,
                'choices' => $locationChoices,
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
            ]);

        $builder->get('exportTo')->addModelTransformer(new EndOfDayTransformer());
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ExportHistoryFilter::class,
            'data' => new ExportHistoryFilter(),
            'csrf_protection' => false,
            'method' => 'GET',
        ]);
    }

    public function getBlockPrefix(): string
    {
        return '';
    }
}

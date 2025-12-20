<?php

declare(strict_types=1);

namespace LsiSoftwareTask\Form;

use LsiSoftwareTask\Dto\ExportHistoryFilter;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class ExportHistoryFilterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('location', ChoiceType::class, [
                'required' => false,
                'placeholder' => '— all —',
                'choices' => array_combine($options['locations'], $options['locations']),
                'choice_translation_domain' => false,
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
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ExportHistoryFilter::class,
            'csrf_protection' => false,
            'method' => 'GET',
            'locations' => [],
        ]);

        $resolver->setAllowedTypes('locations', 'array');
    }

    public function getBlockPrefix(): string
    {
        return '';
    }
}

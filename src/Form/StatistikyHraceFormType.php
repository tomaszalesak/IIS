<?php

namespace App\Form;

use App\Entity\StatistikyHrace;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class StatistikyHraceFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('dva_body')
            ->add('tri_body',IntegerType::class, ['label' => 'Tři body','required' => false])
            ->add('fauly')
            ->add('body')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => StatistikyHrace::class,
        ]);
    }
}

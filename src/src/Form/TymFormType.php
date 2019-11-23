<?php

namespace App\Form;

use App\Entity\Tym;
use App\Entity\Typ;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TymFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('jmeno')
            ->add('typ',EntityType::class, [
                'class' => Typ::class,
                'choice_label' => 'nazev',
                'placeholder' => 'Vyber typ týmu'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Tym::class,
        ]);
    }
}

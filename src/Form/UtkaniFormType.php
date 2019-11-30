<?php

namespace App\Form;

use App\Entity\Utkani;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UtkaniFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('domaci_body',TextType::class, ['label' => 'Domácí *'])
            ->add('hoste_body',TextType::class, ['label' => 'Hosté *'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Utkani::class,
        ]);
    }
}

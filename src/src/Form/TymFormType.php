<?php

namespace App\Form;

use App\Entity\Tym;
use App\Entity\Typ;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TymFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('jmeno',TextType::class, ['label' => 'Název týmu *'])
            ->add('popis',TextareaType::class,[
                'attr' => ['rows' => '7'],
                'label' => 'Popis týmu',
                'required' => false
            ])
            ->add('adresa')
            ->add('typ',EntityType::class, [
                'class' => Typ::class,
                'choice_label' => 'nazev',
                'label' => 'Typ *',
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

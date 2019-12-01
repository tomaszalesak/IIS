<?php

namespace App\Form;

use App\Entity\Turnaj;
use App\Entity\Typ;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TurnajFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nazev',TextType::class, ['label' => 'Název turnaje *'])
            ->add('popis',TextareaType::class,[
                'attr' => ['rows' => '7'],
                'label' => 'Popis turnaje',
                'required' => false
            ])
            ->add('adresa')
            ->add('datum',DateType::class,['data' => new \DateTime("now")])
            ->add('pocet_tymu', ChoiceType::class, [
                'label' => 'Vyber počet týmů *',
                'choices'  => [
                    '4' => 4,
                    '8' => 8,
                    '16' => 16,
                ],
            ])


            ->add('typ',EntityType::class, [
                'class' => Typ::class,
                'choice_label' => 'nazev',
                'label' => 'Typ *',
                'placeholder' => 'Vyber typ turnaje'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Turnaj::class,
        ]);
    }
}

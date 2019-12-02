<?php

namespace App\Form;

use App\Entity\Uzivatel;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class ZmenaUzivateleFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username',TextType::class, [
                'label' => 'Uživatelské jméno *',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Toto pole nesmí být prázdné']),
                ]])
            ->add('jmeno',TextType::class, [
                'mapped' => false,
                'label' => 'Jméno *',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Toto pole nesmí být prázdné'])
                ]])
            ->add('prijmeni',TextType::class, [
                'mapped' => false,
                'label' => 'Příjmení *',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Toto pole nesmí být prázdné'])
                ]])
            ->add('datum_narozeni',BirthdayType::class, [
                'placeholder' => [
                    'year' => 'Rok', 'month' => 'Měsíc', 'day' => 'Den',
                ]
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Uzivatel::class,
        ]);
    }
}

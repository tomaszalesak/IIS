<?php

namespace App\Form;

use App\Entity\Uzivatel;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Unique;

class RegistrationFormType extends AbstractType
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

            ->add('Password', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'label' => 'Heslo *',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Toto pole nesmí být prázdné',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Vaše heslo musí být nejméně {{ limit }} znaky dlouhé',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
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

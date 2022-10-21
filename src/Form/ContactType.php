<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Contact;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\GreaterThanOrEqual;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\LessThanOrEqual;
use Symfony\Component\Validator\Constraints\NotBlank;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez remplir ce champ'
                    ]),
                    new Length([
                        'min' => 2,
                        'minMessage' => 'Nom Invalide !'
                    ])
                    ],
                'attr' => ['placeholder' => 'Name ']
            ])
            ->add('lastname', TextType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez remplir ce champ'
                    ]),
                    new Length([
                        'min' => 2,
                        'minMessage' => 'Prénom Invalide !'
                    ])
                    ],
                'attr' => ['placeholder' => 'Last Name'],
            ])
            ->add('phoneNumber', TelType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez remplir ce champ'
                    ]),
                    new Length([
                        'min' => 10,
                        'minMessage' => 'Téléphone Invalide !',
                        'max' => 10,
                        'maxMessage' => 'Téléphone Invalide !'
                    ])
                ],
                'attr' => ['placeholder' => '0123456789']
            ])
            ->add('adresse', TextType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez remplir ce champ'
                    ]),
                    ],
                'attr' => ['placeholder' => '784 Rue du Code'],
            ])
            ->add('ville', TextType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez remplir ce champ'
                    ]),
                ],
                'attr' => ['placeholder' => 'SymfonyCity'],
            ])
            ->add('age', IntegerType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez remplir ce champ'
                    ]),
                    new GreaterThanOrEqual([
                        'value' => 15,
                        'message' => 'Age supérieur ou égal a 15'
                    ]),
                    new LessThanOrEqual([
                        'value' => 120,
                        'message' => 'Age inférieur ou égal a 120'
                    ]),
                    ],
                'attr' => ['placeholder' => '>= 15 | =< 120'],
            ])
            ->add('category', EntityType::class, [
                'class' => Category::class,
                'choice_label' => 'titre'
            ])
            ->add('submit', SubmitType::class,[
                'attr' => ['class' => 'btn btn-success ']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}

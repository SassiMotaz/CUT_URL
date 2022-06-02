<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

        ->add('Date',TextType::class, [
            'attr' => [
                'class'=>'form-control',
                'placeHolder'=>'mm/jj/aaaa',
            ]
        ])
        ->add('type',TextType::class, [
            'attr' => [
                'class'=>'form-control',
                'placeHolder'=>'Saisir votre Profession',
            ]
        ])
        ->add('tel',TextType::class, [
            'attr' => [
                'class'=>'form-control',
                'placeHolder'=>'Saisir numéro téléphone'
            ]
        ])
        ->add('adr',TextType::class, [
            'attr' => [
                'class'=>'form-control',
                'placeHolder'=>'N° Rue , Code , Ville , Pays ',
            ]
        ])
        ->add('img',TextType::class, [
            'attr' => [
                'class'=>'form-control',
                'placeHolder'=>'Saisir lien de image'
            ]
        ])
        ->add('Nom', TextType::class, [
            'attr' => [
                'class' => 'form-control',
                'placeHolder'=>'Saisir votre nom',
            ],
            'constraints'=>[
                new NotBlank([
                    'message' => 'Entré votre Nom',
                ]),
                new Length([
                    'min' => 2,
                    'minMessage' => 'Votre nom doit comporter au moins {{ limit }} caractères',
                    // max length allowed by Symfony for security reasons
                    'max' => 10,
                    'maxMessage'=>'Votre Nom doit comporter au  moins de {{ limit }} caractères',
                ]),
            ],
            
        ])
        ->add('Prenom', TextType::class, [
            'attr' => [
                'class' => 'form-control',
                'placeHolder'=>'Saisir votre Prénom',
            ],
            'constraints'=>[
                new NotBlank([
                    'message' => 'Entré votre Prénom',
                ]),
                new Length([
                    'min' => 3,
                    'minMessage' => 'Votre Prénom doit comporter au moins {{ limit }} caractères',
                    // max length allowed by Symfony for security reasons
                    'max' => 15,
                    'maxMessage'=>'Votre Prénom doit comporter au  moins de {{ limit }} caractères',
                ]),
            ],
        ])
            ->add('email', EmailType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'placeHolder'=>'abc123@exemple.com',
                ]
            ])
            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'attr' => [
                    'autocomplete' => 'new-password',
                    'class' => 'form-control',
                    'placeHolder'=>'Saisir Votre Mot de passe'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Entré votre un mot de passe',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Votre mot de passe doit comporter au moins {{ limit }} caractères',
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
            'data_class' => User::class,
        ]);
    }
}

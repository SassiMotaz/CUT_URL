<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email',TextType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],])
            ->add('Nom',TextType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],])
            ->add('Prenom',TextType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],])
            ->add('Date',TextType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],])
            ->add('img',TextType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],])
            ->add('tel',TextType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],])
            ->add('adr',TextType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],])
            ->add('type',TextType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}

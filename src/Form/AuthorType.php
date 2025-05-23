<?php

namespace App\Form;

use App\Entity\Author;
use App\Entity\Book;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class AuthorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', null, [
                'label' => 'Nom : ',
            ])
            ->add('dateOfBirth', null, [
                'input' => 'datetime_immutable',
                'widget' => 'single_text',
                'label' => 'Date de naissance : ',
            ])
            ->add('dateOfDeath', null, [
                'input' => 'datetime_immutable',
                'widget' => 'single_text',
                'required' => false,
                'label' => 'Date de décès : ',
            ])
            ->add('nationality', TextType::class, [
                'required' => false,
                'label' => 'Nationalité : ',
            ])
            ->add('books', EntityType::class, [
                'class' => Book::class,
                'choice_label' => 'title',
                'multiple' => true,
                'required' => false,
                'label' => 'Ouvrage : ',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Author::class,
        ]);
    }
}

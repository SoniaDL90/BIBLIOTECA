<?php

namespace App\Form;

use App\Entity\Book;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BookType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titulo')
            ->add('autor')
            ->add('isbn')
            ->add('editorial')
            ->add('anioPublicacion')
            ->add('genero')
            ->add('ejemplaresTotales')
            ->add('ejemplaresDisponibles')
            ->add('descripcion')
            ->add('imagenPortada')
            ->add('fechaCreacion')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Book::class,
        ]);
    }
}

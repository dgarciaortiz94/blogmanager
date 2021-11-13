<?php

namespace App\Form;

use App\Entity\Podcast;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PodcastType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'required' => true,
                'label' => 'Título'
            ])
            ->add('description', TextareaType::class, [
                'required' => true,
                'label' => 'Contenido'
            ])
            ->add('audio', FileType::class, [
                'label' => 'Podcast',
                'mapped' => false
            ])
            ->add('picture', FileType::class, [
                'label' => 'Imagen de portada',
                'mapped' => false
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Enviar'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Podcast::class,
        ]);
    }
}

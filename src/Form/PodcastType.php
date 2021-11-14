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
use Symfony\Component\Validator\Constraints\File;

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
            ->add('podcast', FileType::class, [
                'required' => false,
                'label' => 'Podcast',
                'mapped' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '10024k',
                        'mimeTypesMessage' => 'Por favor, carga un archivo válido. Tamaño máximo: 10 MB.',
                    ])
                ],
            ])
            ->add('image', FileType::class, [
                'required' => false,
                'label' => 'Imagen de portada',
                'mapped' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '10024k',
                        'mimeTypes' => [
                            'image/png',
                            'image/jpg',
                            'image/jpeg'
                        ],
                        'mimeTypesMessage' => 'Por favor, carga un archivo válido. Tamaño máximo: 10 MB. Formatos: .jpg, .jpeg y .png',
                    ])
                ],
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

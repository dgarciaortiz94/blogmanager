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
                'label' => false,
                'attr' => [
                    'placeholder' => 'Escribe aquí tu título',
                    'class' => 'mb-3'
                ]
            ])
            ->add('description', TextareaType::class, [
                'required' => true,
                'label' => false,
                'attr' => [
                    'placeholder' => 'Contenido del artículo',
                    'cols' => '100',
                    'rows' => '10',
                    'class' => 'mb-3'
                ]
            ])
            ->add('podcast', FileType::class, [
                'required' => true,
                'label' => false,
                'mapped' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '10024k',
                        'mimeTypesMessage' => 'Por favor, carga un archivo válido. Tamaño máximo: 10 MB.',
                    ])
                ],
                'attr' => [
                    'class' => 'mb-3'
                ]
            ])
            ->add('image', FileType::class, [
                'required' => true,
                'label' => false,
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
                'attr' => [
                    'class' => 'mb-5'
                ]
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Enviar',
                'attr' => [
                    'class' => 'btn btn-primary'
                ]
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

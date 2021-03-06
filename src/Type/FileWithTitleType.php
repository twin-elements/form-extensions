<?php

namespace TwinElements\FormExtensions\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FileWithTitleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Tytuł pliku'
            ])
            ->add('file', TEUploadType::class, [
                'label' => 'Plik',
                'required' => false,
                'conf' => $options['conf'],
                'file_type' => ($options['file_type'] ? $options['file_type'] : null)
            ]);
        if ($options['file_type'] === 'image') {
            $builder->add('mini', TEUploadType::class, [
                'label' => 'Miniatura',
                'required' => false,
                'conf' => $options['conf'],
                'file_type' => 'image'
            ]);
        }
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver
            ->setDefault('conf', null)
            ->setDefault('file_type', null);
    }

    public function getBlockPrefix()
    {
        return 'file_with_title_type';
    }
}

<?php

namespace TwinElements\FormExtensions\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * @deprecated use FileWithTitleType instead
 */
class SingleAttachmentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Nazwa załącznika',
            ])
            ->add('file', TEUploadType::class, [
                'label' => 'Załącznik',
                'required' => false,
                'conf' => $options['conf']
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefault('conf', null);
    }

    public function getBlockPrefix()
    {
        return 'single_attachment_type';
    }
}

<?php

namespace TwinElements\FormExtensions\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TEUploadType extends AbstractType
{

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'attr' => [
//                'readonly' => true,
                'class' => 'filemanager-input',
                'autocomplete' => 'off'
            ]
        ]);
    }

    public function getParent()
    {
        return TextType::class;
    }


    public function getBlockPrefix()
    {
        return 'core_admin_bundle_teupload_type';
    }
}

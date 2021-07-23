<?php

namespace TwinElements\FormExtensions\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TextInCollectionType extends AbstractType
{

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'attr' => [
                'class' => 'form-control input',
            ],
            'required' => false,
        ]);
    }

    public function getBlockPrefix()
    {
        return 'text_in_collection_type';
    }

    public function getParent()
    {
        return TextType::class;
    }


}

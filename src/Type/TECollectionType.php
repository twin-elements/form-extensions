<?php

namespace TwinElements\FormExtensions\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TECollectionType extends AbstractType
{

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefined('vertical')
            ->setDefaults([
            'allow_add' => true,
            'allow_delete' => true,
            'delete_empty' => true,
            'attr' => [
                'class' => 'core-admin-bundle-tecollection-type'
            ],
            'entry_options' => [
                'label' => false,
//                'empty_data' => null
            ],
        ]);
    }


    public function getParent()
    {
        return CollectionType::class;
    }


    public function getBlockPrefix()
    {
        return 'core_admin_bundle_tecollection_type';
    }
}

<?php

namespace TwinElements\FormExtensions\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class StandardCollectionType extends AbstractType
{

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'entry_options' => [
                'label' => false,
            ],
            'allow_add' => true,
            'allow_delete' => true,
            'attr' => [
                'class' => 'collection-type-form-container col-md-9 col-lg-10'
            ],
            'label_attr' => [
                'class' => 'col-md-2'
            ],
            'by_reference' => false,
        ]);
    }

    public function getParent()
    {
        return CollectionType::class;
    }

    public function getBlockPrefix()
    {
        return 'standard_collection_type';
    }


}

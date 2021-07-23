<?php

namespace TwinElements\FormExtensions\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TEChooseLinkType extends AbstractType
{

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => null,
            'required' => false,
            'error_bubbling' => true,
            'compound' => false
        ]);
    }

    public function getBlockPrefix()
    {
        return 'core_admin_bundle_techoose_link_type';
    }
}

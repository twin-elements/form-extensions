<?php

namespace TwinElements\FormExtensions\Type;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TEEntityType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'label_attr' => [
                'class' => 'col-md-3 col-lg-2'
            ],
            'attr' => [
                'class' => 'input select2'
            ],
            'placeholder' => 'Wybierz'
        ]);
    }

    public function getParent()
    {
        return EntityType::class;
    }
}

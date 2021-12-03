<?php

namespace TwinElements\FormExtensions\Type\Extension;

use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;
use TwinElements\FormExtensions\Type\TECollectionType;

class TECollectionTypeExtension extends AbstractTypeExtension
{
    public static function getExtendedTypes() :iterable
    {
        return [TECollectionType::class];
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'vertical' => false,
            'new_card_label' => '',
            'card_label_field' => '',
            'min' => 1,
            'max' => 100,
            'allow_change_position' => true
        ]);
    }


    public function buildView(FormView $view, FormInterface $form, array $options)
    {
            $view->vars['vertical'] = $options['vertical'];
        $view->vars['new_card_label'] = $options['new_card_label'];
        $view->vars['card_label_field'] = $options['card_label_field'];
        $view->vars['min'] = $options['min'];
        $view->vars['max'] = $options['max'];
        $view->vars['allow_change_position'] = $options['allow_change_position'];
    }


}

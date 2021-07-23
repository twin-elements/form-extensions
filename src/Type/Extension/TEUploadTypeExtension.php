<?php

namespace TwinElements\FormExtensions\Type\Extension;

use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;
use TwinElements\FormExtensions\Type\TEUploadType;

class TEUploadTypeExtension extends AbstractTypeExtension
{
    public function getExtendedTypes() :iterable
    {
        return array(TEUploadType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'delete_button_text' => 'Skasuj plik',
            'add_button_text' => 'Wybierz plik',
            'placeholder' => '',
            'file_type' => 'file',
            'conf' => null,
            'allow_copy' => true,
        ]);
    }


    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        $view->vars['delete_button_text'] = $options['delete_button_text'];
        $view->vars['add_button_text'] = $options['add_button_text'];
        $view->vars['placeholder'] = $options['placeholder'];
        $view->vars['file_type'] = $options['file_type'];
        $view->vars['allow_copy'] = $options['allow_copy'];
        if(!is_null($options['conf'])){
            $view->vars['conf'] = $options['conf'];
        } else {
            switch ($options['file_type']){
                case 'file':
                    $view->vars['conf'] = 'button';
                    break;
                case 'image':
                    $view->vars['conf'] = 'image_button';
                    break;
                default:
                    $view->vars['conf'] = 'button';
                    break;
            }
        }
    }


}

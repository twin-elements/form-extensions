<?php

namespace TwinElements\FormExtensions\Type;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class SaveType extends SubmitType
{
    public function getBlockPrefix()
    {
        return 'save_button';
    }
}

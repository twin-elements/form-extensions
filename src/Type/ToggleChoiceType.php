<?php

namespace TwinElements\FormExtensions\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use TwinElements\Component\AdminTranslator\AdminTranslator;

class ToggleChoiceType extends AbstractType
{
    /**
     * @var AdminTranslator $translator
     */
    private $translator;

    public function __construct(AdminTranslator $translator)
    {
        $this->translator = $translator;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'choices' => [
                $this->translator->translate('admin_type.yes') => 1,
                $this->translator->translate('admin_type.no') => 0
            ],
            'expanded' => true,
            'label' => $this->translator->translate('admin_type.active')
        ]);
    }

    public function getParent()
    {
        return ChoiceType::class;
    }

}

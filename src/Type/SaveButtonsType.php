<?php

namespace TwinElements\FormExtensions\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Contracts\Translation\TranslatorInterface;
use TwinElements\AdminBundle\Service\AdminTranslator;

class SaveButtonsType extends AbstractType
{
    /**
     * @var TranslatorInterface $translator
     */
    private $translator;

    public function __construct(AdminTranslator $translator)
    {
        $this->translator = $translator;

    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('save', SubmitType::class, [
                'label' => $this->translator->translate('admin.save'),
                'attr' => [
                    'class' => 'btn btn-primary'
                ]
            ])
            ->add('save_and_back', SubmitType::class, [
                'label' => $this->translator->translate('admin.save_and_back'),
                'attr' => [
                    'class' => 'btn btn-primary'
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'mapped' => false,
            'label' => false
        ]);
    }

    public function getBlockPrefix()
    {
        return 'save_buttons';
    }
}

<?php

namespace TwinElements\FormExtensions\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AttachmentsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->addEventListener(FormEvents::SUBMIT, function (FormEvent $event) {
            $data = array_filter($event->getData(), function ($attachment) {
                return !(!$attachment['title'] && !$attachment['file']);
            });
            $event->setData(count($data) ? array_values($data) : null);
        });
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'entry_type' => SingleAttachmentType::class,
            'min' => 0,
            'max' => 20,
            'label' => 'Załączniki',
            'help' => 'Aby utworzyć nową sekcję załączników, wpisz jej nazwę do pola Nazwa załącznika nie dodając samego załącznika'
        ]);
    }

    public function getParent()
    {
        return TECollectionType::class;
    }
}

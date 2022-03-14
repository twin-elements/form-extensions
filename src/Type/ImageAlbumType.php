<?php

namespace TwinElements\FormExtensions\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use TwinElements\AdminBundle\Service\AdminTranslator;

class ImageAlbumType extends AbstractType
{
    private AdminTranslator $translator;

    public function __construct(AdminTranslator $translator)
    {
        $this->translator = $translator;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->addEventListener(FormEvents::SUBMIT, function (FormEvent $event) {
            $data = array_filter($event->getData(), function ($image) {
                return !(!$image['title'] && !$image['file']);
            });
            $event->setData(count($data) ? array_values($data) : null);
        });
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'entry_type' => FileWithTitleType::class,
            'entry_options' => [
                'file_type' => 'image',
                'label' => $this->translator->translate('admin_type.image_album.choose_image')
            ],
            'min' => 0,
            'max' => 20,
            'label' => $this->translator->translate('admin_type.image_album.image_album'),
        ]);
    }

    public function getParent()
    {
        return TECollectionType::class;
    }
}

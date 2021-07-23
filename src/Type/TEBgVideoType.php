<?php

/**
 * @deprecated remove this
 */
namespace TwinElements\FormExtensions\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TEBgVideoType extends AbstractType
{

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefined('vertical')
            ->setDefaults([
//                'allow_add' => false,
                'allow_delete' => false,
                'delete_empty' => false,
                'required' => false,
                'allow_change_position' => false,
                'min' => 2,
                'max' => 2,
                'attr' => [
                    'class' => 'core-admin-bundle-tecollection-type'
                ],
                'entry_options' => [
                    'label' => false,
                ],
                'entry_type' => TEUploadType::class,
                'new_card_label' => 'Wybierz pliki wideo',
                'help' => 'Proszę wybrać w polach powyżej pliki o rozszerzeniu MP4 oraz WEBM. UWAGA! Zalecana długość filmu - 15-20 sekund'
            ]);
    }

    public function getParent()
    {
        return TECollectionType::class;
    }


    public function getBlockPrefix()
    {
        return 'core_admin_bundle_tebg_video_type';
    }
}

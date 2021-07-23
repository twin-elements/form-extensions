<?php

namespace TwinElements\FormExtensions\Type;

use App\Bundle\CoreAdminBundle\Utils\MomentFormatConverter;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Defines the custom form field type used to manipulate datetime values across
 * Bootstrap Date\Time Picker javascript plugin.
 *
 * See http://symfony.com/doc/current/cookbook/form/create_custom_field_type.html
 *
 * @author Yonel Ceruto <yonelceruto@gmail.com>
 */
class DatePickerType extends AbstractType
{
    private $formatConverter;

    public function __construct()
    {
        $this->formatConverter = new MomentFormatConverter();
    }

    /**
     * {@inheritdoc}
     */
    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        $view->vars['attr']['data-date-format'] = $this->formatConverter->convert($options['format']);
        $view->vars['attr']['data-date-locale'] = 'pl';
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'widget' => 'single_text',
            'label_attr' => [
                'class' => 'col-md-3 col-lg-2'
            ],
            'attr' => [
                'class' => 'form-control input'
            ],
            'html5' => false
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getParent()
    {
        return DateType::class;
    }
}

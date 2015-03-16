<?php
/**
 * Class TestType
 * @package Foued\Bundle\recaptchaBundle
 *
 * TestType.php
 *
 * @autor   : Foued Dghaies <foued@dghaies.de>
 */
namespace Foued\Bundle\recaptchaBundle\Form;

use Foued\Bundle\recaptchaBundle\Form\Type\RecaptchaType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TestType extends AbstractType
{
    public function __construct(){

    }
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'vorname',
                null,
                array(
                    'label_attr' => array('class' => 'required c-3'),
                    'attr' => array(
                        'class' => 'c-7',
                        "required" => "required"
                    )
                )
            )
            ->add(
                'nachname',
                null,
                array(
                    'label_attr' => array('class' => 'required c-3'),
                    'attr' => array(
                        'class' => 'c-7',
                        "required" => "required"
                    )
                )
            )
            ->add(
                'email',
                null,
                array(
                    'label' => 'E-Mail',
                    'label_attr' => array('class' => 'required c-3'),
                    'attr' => array(
                        'class' => 'c-7',
                        "required" => "required"
                    )
                )
            )

          ->add(
                'recaptcha',
               'recaptcha',
                array(
                    'site_key' => "6LcSiQMTAAAAAGBNuDSMkp1U0oEmCrpvTN3fLipF"
                )
            )  ->add(
                'submit',
                'submit',
                array(
                    'label' => 'Teilnehmen',
                    'attr' => array(
                        'class' => 'btn'
                    )
                )
            )
        ;
    }


    /**
     * @return string
     */
    public function getName()
    {
        return 'testForm';
    }
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(

        ));
    }
}

<?php
/**
 * Class RecaptchaType
 *
 * @package Foued\Bundle\RecaptchaBundle
 *
 * RecaptchaType.php
 *
 * @autor   : Foued Dghaies <foued@dghaies.de>
 */
namespace Foued\Bundle\RecaptchaBundle\Form\Type;

use Foued\Bundle\RecaptchaBundle\EventListener\RecaptchaListener;
use Foued\Bundle\RecaptchaBundle\Validator\Constraints\RecaptchaValidator;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormBuilderInterface;

class RecaptchaType extends AbstractType
{

    private $options;
    private $recaptchaValidator;
    private $listener;
    public function __construct(RecaptchaListener $listener ,$site_key = null)
    {
        $this->options['site_key'] = $site_key;
        $this->listener = $listener;
    }

    /**
     * {@inheritdoc}
     */
    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        if (!$options['site_key']) {
            $options['site_key'] = $this->options['site_key'];
        }
        #var_dump($view); die;
        $view->vars = array_merge($view->vars, array(
            'site_key' => $options['site_key']

        ));
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->addEventSubscriber($this->listener);
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            "label" => false,
            'site_key' => ""
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getParent()
    {
        return 'hidden';
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'recaptcha';
    }
}

<?php
/**
 * Class RecaptchaListener
 * @package Foued\Bundle\recaptchaBundle
 *
 * RecaptchaListener.php
 *
 * @autor   : Foued Dghaies <foued@dghaies.de>
 */
namespace Foued\Bundle\recaptchaBundle\EventListener;

use Foued\Bundle\recaptchaBundle\Validator\Constraints\RecaptchaValidator;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormError;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Validator\Constraint;

class RecaptchaListener implements EventSubscriberInterface
{
    private $validator;
    private $constraint;

    public function __construct(RecaptchaValidator $validator, Constraint $constriant)
    {
        $this->validator = $validator;
        $this->constraint = $constriant;
    }

    public static function getSubscribedEvents()
    {
        return array(
            FormEvents::PRE_SET_DATA => 'onPreSetData',
            FormEvents::SUBMIT => 'onPostSubmit',
        );
    }

    public function onPreSetData(FormEvent $event)
    {

    }

    public function onPostSubmit(FormEvent $event)
    {
        $recaptcha_response = $event->getData();
        $isValide = $this->validator->validate($_POST['g-recaptcha-response'], $this->constraint);
        if (!$isValide) {
            $form = $event->getForm();
            $form->addError(new FormError($this->constraint->message));
        }
    }
}
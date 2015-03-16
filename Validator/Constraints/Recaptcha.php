<?php
/**
 * Class Recaptcha
 * @package Foued\Bundle\recaptchaBundle
 *
 * Recaptcha.php
 *
 * @autor   : Foued Dghaies <foued@dghaies.de>
 */
namespace Foued\Bundle\recaptchaBundle\Validator\Constraints;
use Symfony\Component\Validator\Constraint;

class Recaptcha extends Constraint{
    public $message = 'No valid Captcha!';
}




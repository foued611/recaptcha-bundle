<?php
/**
 * Class RecaptchaValidator
 * @package Foued\Bundle\recaptchaBundle
 *
 * RecaptchaValidator.php
 *
 * @autor   : Foued Dghaies <foued@dghaies.de>
 */
namespace Foued\Bundle\recaptchaBundle\Validator\Constraints;

use ReCaptcha\ReCaptcha;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class RecaptchaValidator extends ConstraintValidator
{
    private $verifier;

    public function __construct(ReCaptcha $verifier)
    {
        $this->verifier = $verifier;

    }

    public function validate($value, Constraint $constraint)
    {
        try {
            $response = $this->verifier->verify($value);
            if (!$response->isSuccess()) {
                if (is_object($this->context)) {
                    $this->context->buildViolation($constraint->message)
                        ->setParameter('%string%', $value)
                        ->addViolation();
                } else {
                    return false;
                }
            }
            return true;
        } catch (\Exception $e) {
            //@TODO logging
            return false;
        }


    }

    public function validatedBy()
    {
        return 'recaptcha';
    }
}
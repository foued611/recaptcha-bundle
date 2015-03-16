<?php

namespace Foued\Bundle\recaptchaBundle\Controller;

use Foued\Bundle\recaptchaBundle\Form\TestType;
use ReCaptcha\ReCaptcha;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $form = $this->createCform();
        return $this->render('FouedrecaptchaBundle:Default:index.html.twig', array('form' => $form->createView()));
    }
    public function handlerAction(Request $request){
        $form = $this->createCform();

        $form->handleRequest($request);

       var_dump($form->isValid());
        var_dump($form->getErrors());
        die;
    }
        private function createCform(){
           return $this->createForm(
                new TestType(), null, array(
                'action' => $this->generateUrl('form_submit'),
                'method' => 'POST',
            ) );
        }

}

<?php
/**
 * Class Post
 *
 * @package Foued\Bundle\RecaptchaBundle
 *
 * Post.php
 *
 * @autor   : Foued Dghaies <foued@dghaies.de>
 */
namespace Foued\Bundle\RecaptchaBundle\ReCaptcha\RequestMethod;

use ReCaptcha\RequestMethod;
use ReCaptcha\RequestParameters;


class Post implements RequestMethod
{
    private $proxy;
    public function __construct($proxy= null){
        $this->proxy = $proxy;
    }
    /**
     * {@inheritdoc}
     */
    const SITE_VERIFY_URL = 'https://www.google.com/recaptcha/api/siteverify';

    /**
     * {@inheritdoc}
     */
    public function submit(RequestParameters $params)
    {
        /**
         * PHP 5.6.0 changed the way you specify the peer name for SSL context options.
         * Using "CN_name" will still work, but it will raise deprecated errors.
         */
        $peer_key = version_compare(PHP_VERSION, '5.6.0', '<') ? 'CN_name' : 'peer_name';
        $options = array(
            'http' => array(
                'header' => "Content-type: application/x-www-form-urlencoded\r\n",
                'method' => 'POST',
                'content' => $params->toQueryString(),
                // Force the peer to validate (not needed in 5.6.0+, but still works
                'verify_peer' => true,
                // Force the peer validation to use www.google.com
                $peer_key => 'www.google.com',
                'proxy' => $this->proxy,
                'request_fulluri' => true
            ),
        );
        $context = stream_context_create($options);
        return file_get_contents(self::SITE_VERIFY_URL, false, $context);
    }
}

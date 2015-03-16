<?php
/**
 * Class FouedrecaptchaExtension
 * @package Foued\Bundle\RecaptchaBundle
 *
 * FouedRecaptchaExtension.php
 *
 * @autor   : Foued Dghaies <foued@dghaies.de>
 */
namespace Foued\Bundle\RecaptchaBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class FouedRecaptchaExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('services.xml');
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);
        $twigResources = $container->getParameter('twig.form.resources');
        $container->setParameter('twig.form.resources', array_merge(array('FouedRecaptchaBundle::Form::recaptcha.html.twig'), $twigResources));


        $container->setParameter('recaptcha.site_key', $config['site_key']);
        $container->setParameter('recaptcha.secret', $config['secret']);
        $container->setParameter('recaptcha.proxy', $config['proxy']);
    }
}

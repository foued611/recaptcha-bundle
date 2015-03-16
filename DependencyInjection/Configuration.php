<?php
/**
 * Class Configuration
 * @package Foued\Bundle\RecaptchaBundle
 *
 * Configuration.php
 *
 * @autor   : Foued Dghaies <foued@dghaies.de>
 */
namespace Foued\Bundle\RecaptchaBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link
 * http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('Fouedrecaptcha');
        $rootNode
            ->children()
                ->scalarNode('site_key')
                ->defaultValue("")
            ->end()
                ->scalarNode('secret')
                ->defaultValue("")
            ->end()
                ->scalarNode('proxy')
                ->defaultValue("")
            ->end()
        ->end();
        return $treeBuilder;
    }
}

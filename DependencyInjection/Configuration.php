<?php

namespace Fabz29\CmsBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Class Configuration
 * @package Fabz29\CmsBundle\DependencyInjection
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('fabz29_cms');

        $rootNode->
            children()->
                arrayNode("roles_allowed")->canBeUnset()->prototype('scalar')->end()->
            end();

        return $treeBuilder;
    }
}

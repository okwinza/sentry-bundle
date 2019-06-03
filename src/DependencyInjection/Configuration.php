<?php

namespace CitePolitique\Sentry\DependencyInjection;

use Monolog\Logger;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder('sentry');
        $treeBuilder->getRootNode()
            ->children()
                ->scalarNode('dsn')->isRequired()->end()
                ->scalarNode('action_level')->defaultValue(Logger::ERROR)->end()
                ->arrayNode('ignored_http_codes')
                    ->prototype('variable')->end()
                    ->defaultValue([403, 404, 405])
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}

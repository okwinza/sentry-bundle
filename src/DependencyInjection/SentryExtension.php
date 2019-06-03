<?php

namespace CitePolitique\Sentry\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

class SentryExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.xml');

        $container->setParameter('citepolitique.sentry.dsn', $config['dsn']);
        $container->setParameter('citepolitique.sentry.action_level', $config['action_level']);
        $container->setParameter('citepolitique.sentry.ignored_http_codes', $config['ignored_http_codes']);
    }
}

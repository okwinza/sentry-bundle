<?php

namespace Tests\CitePolitique\Sentry\Kernel;

use CitePolitique\Sentry\SentryBundle;
use Symfony\Bundle\FrameworkBundle\FrameworkBundle;
use Symfony\Bundle\MonologBundle\MonologBundle;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\HttpKernel\Kernel;

class SentryAppKernel extends Kernel
{
    use AppKernelTrait;

    public function registerBundles()
    {
        return [new FrameworkBundle(), new MonologBundle(), new SentryBundle()];
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(__DIR__.'/config/framework.yaml', 'yaml');
        $loader->load(__DIR__.'/config/monolog.yaml', 'yaml');
    }
}

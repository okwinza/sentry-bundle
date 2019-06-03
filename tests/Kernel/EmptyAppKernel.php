<?php

namespace Tests\CitePolitique\Sentry\Kernel;

use CitePolitique\Sentry\SentryBundle;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\HttpKernel\Kernel;

class EmptyAppKernel extends Kernel
{
    use AppKernelTrait;

    public function registerBundles()
    {
        return [new SentryBundle()];
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
    }
}

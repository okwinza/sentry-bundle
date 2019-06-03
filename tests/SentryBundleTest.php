<?php

namespace Tests\CitePolitique\Sentry;

use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpKernel\Kernel;
use Tests\CitePolitique\Sentry\Kernel\EmptyAppKernel;
use Tests\CitePolitique\Sentry\Kernel\FrameworkAppKernel;
use Tests\CitePolitique\Sentry\Kernel\SentryAppKernel;

class SentryBundleTest extends TestCase
{
    public function provideKernels()
    {
        yield 'empty' => [new EmptyAppKernel('test', true)];
        yield 'framework' => [new FrameworkAppKernel('test', true)];
        yield 'sentry' => [new SentryAppKernel('test', true)];
    }

    /**
     * @dataProvider provideKernels
     */
    public function testBootKernel(Kernel $kernel)
    {
        $kernel->boot();
        $this->assertArrayHasKey('SentryBundle', $kernel->getBundles());
    }

    public function testMonologConfigured()
    {
        $kernel = new SentryAppKernel('test', true);
        $kernel->boot();

        $container = $kernel->getContainer();
        $this->assertTrue($container->has('citepolitique.sentry.activation_strategy'));
        $this->assertTrue($container->has('citepolitique.sentry.monolog_handler'));

        $this->assertSame('https://xxx@sentry.io/xxx', $container->getParameter('citepolitique.sentry.dsn'));
        $this->assertSame(500, $container->getParameter('citepolitique.sentry.action_level'));
        $this->assertSame([400], $container->getParameter('citepolitique.sentry.ignored_http_codes'));
    }
}

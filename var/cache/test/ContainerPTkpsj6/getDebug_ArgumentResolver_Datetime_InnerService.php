<?php

namespace ContainerPTkpsj6;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getDebug_ArgumentResolver_Datetime_InnerService extends App_KernelTestDebugContainer
{
    /**
     * Gets the private 'debug.argument_resolver.datetime.inner' shared service.
     *
     * @return \Symfony\Component\HttpKernel\Controller\ArgumentResolver\DateTimeValueResolver
     */
    public static function do($container, $lazyLoad = true)
    {
        include_once \dirname(__DIR__, 4).'/vendor/symfony/http-kernel/Controller/ArgumentValueResolverInterface.php';
        include_once \dirname(__DIR__, 4).'/vendor/symfony/http-kernel/Controller/ArgumentResolver/DateTimeValueResolver.php';

        return $container->privates['debug.argument_resolver.datetime.inner'] = new \Symfony\Component\HttpKernel\Controller\ArgumentResolver\DateTimeValueResolver();
    }
}

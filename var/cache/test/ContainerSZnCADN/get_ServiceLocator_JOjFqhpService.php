<?php

namespace ContainerSZnCADN;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class get_ServiceLocator_JOjFqhpService extends App_KernelTestDebugContainer
{
    /**
     * Gets the private '.service_locator.JOjFqhp' shared service.
     *
     * @return \Symfony\Component\DependencyInjection\ServiceLocator
     */
    public static function do($container, $lazyLoad = true)
    {
        return $container->privates['.service_locator.JOjFqhp'] = new \Symfony\Component\DependencyInjection\Argument\ServiceLocator($container->getService, [
            'helper' => ['privates', 'App\\Helpers\\LuckyRouteData', 'getLuckyRouteDataService', true],
        ], [
            'helper' => 'App\\Helpers\\LuckyRouteData',
        ]);
    }
}

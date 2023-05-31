<?php

namespace ContainerRBSDVbO;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class get_ServiceLocator_Hyo7pFService extends App_KernelTestsDebugContainer
{
    /**
     * Gets the private '.service_locator.Hyo_7pF' shared service.
     *
     * @return \Symfony\Component\DependencyInjection\ServiceLocator
     */
    public static function do($container, $lazyLoad = true)
    {
        return $container->privates['.service_locator.Hyo_7pF'] = new \Symfony\Component\DependencyInjection\Argument\ServiceLocator($container->getService, [
            'gameHandler' => ['privates', 'App\\Game\\GameHandler', 'getGameHandlerService', true],
        ], [
            'gameHandler' => 'App\\Game\\GameHandler',
        ]);
    }
}

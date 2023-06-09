<?php

namespace ContainerA12MCZa;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class get_ServiceLocator_Q9850KJService extends App_KernelTestsDebugContainer
{
    /**
     * Gets the private '.service_locator.Q9850KJ' shared service.
     *
     * @return \Symfony\Component\DependencyInjection\ServiceLocator
     */
    public static function do($container, $lazyLoad = true)
    {
        return $container->privates['.service_locator.Q9850KJ'] = new \Symfony\Component\DependencyInjection\Argument\ServiceLocator($container->getService, [
            'gameHandler' => ['privates', 'App\\Game\\GameMoneyHandler', 'getGameMoneyHandlerService', true],
        ], [
            'gameHandler' => 'App\\Game\\GameMoneyHandler',
        ]);
    }
}

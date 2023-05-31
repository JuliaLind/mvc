<?php

namespace ContainerRAaxae6;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class get_ServiceLocator_VptkjFlService extends App_KernelDevDebugContainer
{
    /**
     * Gets the private '.service_locator.VptkjFl' shared service.
     *
     * @return \Symfony\Component\DependencyInjection\ServiceLocator
     */
    public static function do($container, $lazyLoad = true)
    {
        return $container->privates['.service_locator.VptkjFl'] = new \Symfony\Component\DependencyInjection\Argument\ServiceLocator($container->getService, [
            'cardHandler' => ['privates', 'App\\Cards\\CardLandingHandler', 'getCardLandingHandlerService', true],
        ], [
            'cardHandler' => 'App\\Cards\\CardLandingHandler',
        ]);
    }
}

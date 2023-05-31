<?php

namespace ContainerS9Zu0CK;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class get_ServiceLocator_WQSKPJOService extends App_KernelDevDebugContainer
{
    /**
     * Gets the private '.service_locator.WQSKPJO' shared service.
     *
     * @return \Symfony\Component\DependencyInjection\ServiceLocator
     */
    public static function do($container, $lazyLoad = true)
    {
        return $container->privates['.service_locator.WQSKPJO'] = new \Symfony\Component\DependencyInjection\Argument\ServiceLocator($container->getService, [
            'cardHandler' => ['privates', 'App\\Cards\\CardHandler', 'getCardHandlerService', true],
            'creator' => ['privates', 'App\\Cards\\PlayerCreator', 'getPlayerCreatorService', true],
        ], [
            'cardHandler' => 'App\\Cards\\CardHandler',
            'creator' => 'App\\Cards\\PlayerCreator',
        ]);
    }
}
<?php

namespace ContainerA12MCZa;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class get_ServiceLocator_ZQEfZjZService extends App_KernelTestsDebugContainer
{
    /**
     * Gets the private '.service_locator.ZQEfZjZ' shared service.
     *
     * @return \Symfony\Component\DependencyInjection\ServiceLocator
     */
    public static function do($container, $lazyLoad = true)
    {
        return $container->privates['.service_locator.ZQEfZjZ'] = new \Symfony\Component\DependencyInjection\Argument\ServiceLocator($container->getService, [
            'cardHandler' => ['privates', 'App\\Cards\\JsonCardHandler', 'getJsonCardHandlerService', true],
            'converter' => ['privates', 'App\\Helpers\\JsonConverter', 'getJsonConverterService', true],
            'creator' => ['privates', 'App\\Cards\\PlayerCreator', 'getPlayerCreatorService', true],
        ], [
            'cardHandler' => 'App\\Cards\\JsonCardHandler',
            'converter' => 'App\\Helpers\\JsonConverter',
            'creator' => 'App\\Cards\\PlayerCreator',
        ]);
    }
}

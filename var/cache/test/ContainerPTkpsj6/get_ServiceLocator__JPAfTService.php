<?php

namespace ContainerPTkpsj6;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class get_ServiceLocator__JPAfTService extends App_KernelTestDebugContainer
{
    /**
     * Gets the private '.service_locator..JPAfT_' shared service.
     *
     * @return \Symfony\Component\DependencyInjection\ServiceLocator
     */
    public static function do($container, $lazyLoad = true)
    {
        return $container->privates['.service_locator..JPAfT_'] = new \Symfony\Component\DependencyInjection\Argument\ServiceLocator($container->getService, [
            'converter' => ['privates', 'App\\Helpers\\JsonConverter', 'getJsonConverterService', true],
            'handler' => ['privates', 'App\\Helpers\\JsonHandler', 'getJsonHandlerService', true],
        ], [
            'converter' => 'App\\Helpers\\JsonConverter',
            'handler' => 'App\\Helpers\\JsonHandler',
        ]);
    }
}

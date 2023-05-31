<?php

namespace ContainerRBSDVbO;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class get_ServiceLocator_O_HPovEService extends App_KernelTestsDebugContainer
{
    /**
     * Gets the private '.service_locator.o.hPovE' shared service.
     *
     * @return \Symfony\Component\DependencyInjection\ServiceLocator
     */
    public static function do($container, $lazyLoad = true)
    {
        return $container->privates['.service_locator.o.hPovE'] = new \Symfony\Component\DependencyInjection\Argument\ServiceLocator($container->getService, [
            'helper' => ['privates', 'App\\Helpers\\MainControllerHelper', 'getMainControllerHelperService', true],
        ], [
            'helper' => 'App\\Helpers\\MainControllerHelper',
        ]);
    }
}

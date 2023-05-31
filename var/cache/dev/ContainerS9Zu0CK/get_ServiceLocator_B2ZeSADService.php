<?php

namespace ContainerS9Zu0CK;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class get_ServiceLocator_B2ZeSADService extends App_KernelDevDebugContainer
{
    /**
     * Gets the private '.service_locator.B2ZeSAD' shared service.
     *
     * @return \Symfony\Component\DependencyInjection\ServiceLocator
     */
    public static function do($container, $lazyLoad = true)
    {
        return $container->privates['.service_locator.B2ZeSAD'] = new \Symfony\Component\DependencyInjection\Argument\ServiceLocator($container->getService, [
            'bookRepository' => ['privates', 'App\\Repository\\BookRepository', 'getBookRepositoryService', true],
        ], [
            'bookRepository' => 'App\\Repository\\BookRepository',
        ]);
    }
}

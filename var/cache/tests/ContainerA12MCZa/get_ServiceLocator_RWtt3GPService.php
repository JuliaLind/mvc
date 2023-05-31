<?php

namespace ContainerA12MCZa;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class get_ServiceLocator_RWtt3GPService extends App_KernelTestsDebugContainer
{
    /**
     * Gets the private '.service_locator.RWtt3GP' shared service.
     *
     * @return \Symfony\Component\DependencyInjection\ServiceLocator
     */
    public static function do($container, $lazyLoad = true)
    {
        return $container->privates['.service_locator.RWtt3GP'] = new \Symfony\Component\DependencyInjection\Argument\ServiceLocator($container->getService, [
            'bookRepository' => ['privates', 'App\\Repository\\BookRepository', 'getBookRepositoryService', true],
            'converter' => ['privates', 'App\\Helpers\\JsonConverter', 'getJsonConverterService', true],
        ], [
            'bookRepository' => 'App\\Repository\\BookRepository',
            'converter' => 'App\\Helpers\\JsonConverter',
        ]);
    }
}

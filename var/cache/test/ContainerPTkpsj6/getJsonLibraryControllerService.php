<?php

namespace ContainerPTkpsj6;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getJsonLibraryControllerService extends App_KernelTestDebugContainer
{
    /**
     * Gets the public 'App\Controller\JsonLibraryController' shared autowired service.
     *
     * @return \App\Controller\JsonLibraryController
     */
    public static function do($container, $lazyLoad = true)
    {
        include_once \dirname(__DIR__, 4).'/vendor/symfony/framework-bundle/Controller/AbstractController.php';
        include_once \dirname(__DIR__, 4).'/src/Controller/JsonLibraryController.php';

        $container->services['App\\Controller\\JsonLibraryController'] = $instance = new \App\Controller\JsonLibraryController();

        $instance->setContainer(($container->privates['.service_locator.jIxfAsi'] ?? $container->load('get_ServiceLocator_JIxfAsiService'))->withContext('App\\Controller\\JsonLibraryController', $container));

        return $instance;
    }
}

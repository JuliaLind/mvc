<?php

namespace ContainerRAaxae6;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getJsonDealManyCardsControllerService extends App_KernelDevDebugContainer
{
    /**
     * Gets the public 'App\Controller\JsonDealManyCardsController' shared autowired service.
     *
     * @return \App\Controller\JsonDealManyCardsController
     */
    public static function do($container, $lazyLoad = true)
    {
        include_once \dirname(__DIR__, 4).'/vendor/symfony/framework-bundle/Controller/AbstractController.php';
        include_once \dirname(__DIR__, 4).'/src/Controller/JsonDealManyCardsController.php';

        $container->services['App\\Controller\\JsonDealManyCardsController'] = $instance = new \App\Controller\JsonDealManyCardsController();

        $instance->setContainer(($container->privates['.service_locator.jIxfAsi'] ?? $container->load('get_ServiceLocator_JIxfAsiService'))->withContext('App\\Controller\\JsonDealManyCardsController', $container));

        return $instance;
    }
}

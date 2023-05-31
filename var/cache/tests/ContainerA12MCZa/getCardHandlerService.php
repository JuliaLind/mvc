<?php

namespace ContainerA12MCZa;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getCardHandlerService extends App_KernelTestsDebugContainer
{
    /**
     * Gets the private 'App\Cards\CardHandler' shared autowired service.
     *
     * @return \App\Cards\CardHandler
     */
    public static function do($container, $lazyLoad = true)
    {
        include_once \dirname(__DIR__, 4).'/src/Cards/CardHandler.php';

        return $container->privates['App\\Cards\\CardHandler'] = new \App\Cards\CardHandler();
    }
}
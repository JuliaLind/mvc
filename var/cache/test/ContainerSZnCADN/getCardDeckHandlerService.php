<?php

namespace ContainerSZnCADN;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getCardDeckHandlerService extends App_KernelTestDebugContainer
{
    /**
     * Gets the private 'App\Cards\CardDeckHandler' shared autowired service.
     *
     * @return \App\Cards\CardDeckHandler
     */
    public static function do($container, $lazyLoad = true)
    {
        include_once \dirname(__DIR__, 4).'/src/Cards/CardDeckHandler.php';

        return $container->privates['App\\Cards\\CardDeckHandler'] = new \App\Cards\CardDeckHandler();
    }
}

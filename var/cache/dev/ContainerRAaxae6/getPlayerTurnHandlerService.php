<?php

namespace ContainerRAaxae6;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getPlayerTurnHandlerService extends App_KernelDevDebugContainer
{
    /**
     * Gets the private 'App\Game\PlayerTurnHandler' shared autowired service.
     *
     * @return \App\Game\PlayerTurnHandler
     */
    public static function do($container, $lazyLoad = true)
    {
        include_once \dirname(__DIR__, 4).'/src/Game/PlayerTurnHandler.php';
        include_once \dirname(__DIR__, 4).'/src/Game/RoundHandler.php';

        return $container->privates['App\\Game\\PlayerTurnHandler'] = new \App\Game\PlayerTurnHandler(($container->privates['App\\Game\\RoundHandler'] ?? ($container->privates['App\\Game\\RoundHandler'] = new \App\Game\RoundHandler())));
    }
}

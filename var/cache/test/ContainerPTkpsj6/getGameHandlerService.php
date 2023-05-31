<?php

namespace ContainerPTkpsj6;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getGameHandlerService extends App_KernelTestDebugContainer
{
    /**
     * Gets the private 'App\Game\GameHandler' shared autowired service.
     *
     * @return \App\Game\GameHandler
     */
    public static function do($container, $lazyLoad = true)
    {
        include_once \dirname(__DIR__, 4).'/src/Game/GameHandler.php';

        return $container->privates['App\\Game\\GameHandler'] = new \App\Game\GameHandler();
    }
}

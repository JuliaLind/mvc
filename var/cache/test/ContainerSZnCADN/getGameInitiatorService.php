<?php

namespace ContainerSZnCADN;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getGameInitiatorService extends App_KernelTestDebugContainer
{
    /**
     * Gets the private 'App\Game\GameInitiator' shared autowired service.
     *
     * @return \App\Game\GameInitiator
     */
    public static function do($container, $lazyLoad = true)
    {
        include_once \dirname(__DIR__, 4).'/src/Game/GameInitiator.php';

        return $container->privates['App\\Game\\GameInitiator'] = new \App\Game\GameInitiator();
    }
}

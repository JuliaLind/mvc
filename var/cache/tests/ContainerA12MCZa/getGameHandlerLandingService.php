<?php

namespace ContainerA12MCZa;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getGameHandlerLandingService extends App_KernelTestsDebugContainer
{
    /**
     * Gets the private 'App\Game\GameHandlerLanding' shared autowired service.
     *
     * @return \App\Game\GameHandlerLanding
     */
    public static function do($container, $lazyLoad = true)
    {
        include_once \dirname(__DIR__, 4).'/src/Game/GameHandlerLanding.php';

        return $container->privates['App\\Game\\GameHandlerLanding'] = new \App\Game\GameHandlerLanding();
    }
}

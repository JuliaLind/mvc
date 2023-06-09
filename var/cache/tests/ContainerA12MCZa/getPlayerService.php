<?php

namespace ContainerA12MCZa;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getPlayerService extends App_KernelTestsDebugContainer
{
    /**
     * Gets the private 'App\Cards\Player' shared autowired service.
     *
     * @return \App\Cards\Player
     */
    public static function do($container, $lazyLoad = true)
    {
        include_once \dirname(__DIR__, 4).'/src/Cards/Player.php';
        include_once \dirname(__DIR__, 4).'/src/Cards/CardHand.php';

        return $container->privates['App\\Cards\\Player'] = new \App\Cards\Player('Player 1', new \App\Cards\CardHand());
    }
}

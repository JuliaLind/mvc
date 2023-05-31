<?php

namespace ContainerPTkpsj6;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getPlayerCreatorService extends App_KernelTestDebugContainer
{
    /**
     * Gets the private 'App\Cards\PlayerCreator' shared autowired service.
     *
     * @return \App\Cards\PlayerCreator
     */
    public static function do($container, $lazyLoad = true)
    {
        include_once \dirname(__DIR__, 4).'/src/Cards/PlayerCreator.php';

        return $container->privates['App\\Cards\\PlayerCreator'] = new \App\Cards\PlayerCreator();
    }
}

<?php

namespace ContainerRBSDVbO;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getLuckyRouteDataService extends App_KernelTestsDebugContainer
{
    /**
     * Gets the private 'App\Helpers\LuckyRouteData' shared autowired service.
     *
     * @return \App\Helpers\LuckyRouteData
     */
    public static function do($container, $lazyLoad = true)
    {
        include_once \dirname(__DIR__, 4).'/src/Helpers/LuckyRouteData.php';

        return $container->privates['App\\Helpers\\LuckyRouteData'] = new \App\Helpers\LuckyRouteData();
    }
}

<?php

namespace ContainerS9Zu0CK;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getMainControllerHelperService extends App_KernelDevDebugContainer
{
    /**
     * Gets the private 'App\Helpers\MainControllerHelper' shared autowired service.
     *
     * @return \App\Helpers\MainControllerHelper
     */
    public static function do($container, $lazyLoad = true)
    {
        include_once \dirname(__DIR__, 4).'/src/Helpers/MainControllerHelper.php';

        return $container->privates['App\\Helpers\\MainControllerHelper'] = new \App\Helpers\MainControllerHelper();
    }
}

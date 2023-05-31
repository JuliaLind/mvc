<?php

namespace ContainerRBSDVbO;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getJsonConverterService extends App_KernelTestsDebugContainer
{
    /**
     * Gets the private 'App\Helpers\JsonConverter' shared autowired service.
     *
     * @return \App\Helpers\JsonConverter
     */
    public static function do($container, $lazyLoad = true)
    {
        include_once \dirname(__DIR__, 4).'/src/Helpers/JsonConverter.php';

        return $container->privates['App\\Helpers\\JsonConverter'] = new \App\Helpers\JsonConverter();
    }
}
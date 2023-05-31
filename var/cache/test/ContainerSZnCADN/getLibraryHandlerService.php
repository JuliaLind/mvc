<?php

namespace ContainerSZnCADN;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getLibraryHandlerService extends App_KernelTestDebugContainer
{
    /**
     * Gets the private 'App\Library\LibraryHandler' shared autowired service.
     *
     * @return \App\Library\LibraryHandler
     */
    public static function do($container, $lazyLoad = true)
    {
        include_once \dirname(__DIR__, 4).'/src/Library/LibraryHandler.php';
        include_once \dirname(__DIR__, 4).'/src/Library/BookSaver.php';
        include_once \dirname(__DIR__, 4).'/src/Library/BookUpdator.php';
        include_once \dirname(__DIR__, 4).'/src/Library/BookRemover.php';

        return $container->privates['App\\Library\\LibraryHandler'] = new \App\Library\LibraryHandler(($container->privates['App\\Library\\BookSaver'] ?? ($container->privates['App\\Library\\BookSaver'] = new \App\Library\BookSaver())), ($container->privates['App\\Library\\BookUpdator'] ?? ($container->privates['App\\Library\\BookUpdator'] = new \App\Library\BookUpdator())), ($container->privates['App\\Library\\BookRemover'] ?? ($container->privates['App\\Library\\BookRemover'] = new \App\Library\BookRemover())));
    }
}

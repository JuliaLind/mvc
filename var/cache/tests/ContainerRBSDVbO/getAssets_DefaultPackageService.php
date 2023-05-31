<?php

namespace ContainerRBSDVbO;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getAssets_DefaultPackageService extends App_KernelTestsDebugContainer
{
    /**
     * Gets the private 'assets._default_package' shared service.
     *
     * @return \Symfony\Component\Asset\PathPackage
     */
    public static function do($container, $lazyLoad = true)
    {
        include_once \dirname(__DIR__, 4).'/vendor/symfony/asset/PackageInterface.php';
        include_once \dirname(__DIR__, 4).'/vendor/symfony/asset/Package.php';
        include_once \dirname(__DIR__, 4).'/vendor/symfony/asset/PathPackage.php';

        return $container->privates['assets._default_package'] = new \Symfony\Component\Asset\PathPackage('', ($container->privates['assets._version__default'] ?? $container->load('getAssets_VersionDefaultService')), ($container->privates['assets.context'] ?? $container->load('getAssets_ContextService')));
    }
}
<?php

namespace ContainerRBSDVbO;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getTwig_Extension_SecurityService extends App_KernelTestsDebugContainer
{
    /**
     * Gets the private 'twig.extension.security' shared service.
     *
     * @return \Symfony\Bridge\Twig\Extension\SecurityExtension
     */
    public static function do($container, $lazyLoad = true)
    {
        include_once \dirname(__DIR__, 4).'/vendor/twig/twig/src/Extension/ExtensionInterface.php';
        include_once \dirname(__DIR__, 4).'/vendor/twig/twig/src/Extension/AbstractExtension.php';
        include_once \dirname(__DIR__, 4).'/vendor/symfony/twig-bridge/Extension/SecurityExtension.php';

        $a = ($container->privates['security.authorization_checker'] ?? $container->getSecurity_AuthorizationCheckerService());

        if (isset($container->privates['twig.extension.security'])) {
            return $container->privates['twig.extension.security'];
        }
        $b = ($container->privates['security.impersonate_url_generator'] ?? $container->load('getSecurity_ImpersonateUrlGeneratorService'));

        if (isset($container->privates['twig.extension.security'])) {
            return $container->privates['twig.extension.security'];
        }

        return $container->privates['twig.extension.security'] = new \Symfony\Bridge\Twig\Extension\SecurityExtension($a, $b);
    }
}

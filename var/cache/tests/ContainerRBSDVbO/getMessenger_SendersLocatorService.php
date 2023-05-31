<?php

namespace ContainerRBSDVbO;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getMessenger_SendersLocatorService extends App_KernelTestsDebugContainer
{
    /**
     * Gets the private 'messenger.senders_locator' shared service.
     *
     * @return \Symfony\Component\Messenger\Transport\Sender\SendersLocator
     */
    public static function do($container, $lazyLoad = true)
    {
        include_once \dirname(__DIR__, 4).'/vendor/symfony/messenger/Transport/Sender/SendersLocatorInterface.php';
        include_once \dirname(__DIR__, 4).'/vendor/symfony/messenger/Transport/Sender/SendersLocator.php';

        $a = ($container->privates['.service_locator.c7f47p7'] ?? $container->load('get_ServiceLocator_C7f47p7Service'));

        if (isset($container->privates['messenger.senders_locator'])) {
            return $container->privates['messenger.senders_locator'];
        }

        return $container->privates['messenger.senders_locator'] = new \Symfony\Component\Messenger\Transport\Sender\SendersLocator(['Symfony\\Component\\Mailer\\Messenger\\SendEmailMessage' => [0 => 'async'], 'Symfony\\Component\\Notifier\\Message\\ChatMessage' => [0 => 'async'], 'Symfony\\Component\\Notifier\\Message\\SmsMessage' => [0 => 'async']], $a);
    }
}

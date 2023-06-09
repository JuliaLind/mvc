<?php

namespace ContainerRBSDVbO;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class get_ServiceLocator_Zgz1dKtService extends App_KernelTestsDebugContainer
{
    /**
     * Gets the private '.service_locator.zgz1dKt' shared service.
     *
     * @return \Symfony\Component\DependencyInjection\ServiceLocator
     */
    public static function do($container, $lazyLoad = true)
    {
        return $container->privates['.service_locator.zgz1dKt'] = new \Symfony\Component\DependencyInjection\Argument\ServiceLocator($container->getService, [
            'cardHandler' => ['privates', 'App\\Cards\\CardDeckHandler', 'getCardDeckHandlerService', true],
            'deck' => ['privates', 'App\\Cards\\DeckOfCards', 'getDeckOfCardsService', true],
        ], [
            'cardHandler' => 'App\\Cards\\CardDeckHandler',
            'deck' => 'App\\Cards\\DeckOfCards',
        ]);
    }
}

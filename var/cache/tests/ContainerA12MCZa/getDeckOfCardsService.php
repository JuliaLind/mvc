<?php

namespace ContainerA12MCZa;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getDeckOfCardsService extends App_KernelTestsDebugContainer
{
    /**
     * Gets the private 'App\Cards\DeckOfCards' shared autowired service.
     *
     * @return \App\Cards\DeckOfCards
     */
    public static function do($container, $lazyLoad = true)
    {
        include_once \dirname(__DIR__, 4).'/src/Cards/DeckOfCards.php';

        return $container->privates['App\\Cards\\DeckOfCards'] = new \App\Cards\DeckOfCards();
    }
}
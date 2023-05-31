<?php

namespace ContainerSZnCADN;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class get_ServiceLocator_Xr0fs2yService extends App_KernelTestDebugContainer
{
    /**
     * Gets the private '.service_locator.Xr0fs2y' shared service.
     *
     * @return \Symfony\Component\DependencyInjection\ServiceLocator
     */
    public static function do($container, $lazyLoad = true)
    {
        return $container->privates['.service_locator.Xr0fs2y'] = new \Symfony\Component\DependencyInjection\Argument\ServiceLocator($container->getService, [
            'App\\Controller\\CardController::deal' => ['privates', '.service_locator.WQSKPJO', 'get_ServiceLocator_WQSKPJOService', true],
            'App\\Controller\\CardController::deck' => ['privates', '.service_locator.zgz1dKt', 'get_ServiceLocator_Zgz1dKtService', true],
            'App\\Controller\\CardController::draw' => ['privates', '.service_locator.TbQnfRD', 'get_ServiceLocator_TbQnfRDService', true],
            'App\\Controller\\CardController::drawMany' => ['privates', '.service_locator.TbQnfRD', 'get_ServiceLocator_TbQnfRDService', true],
            'App\\Controller\\CardController::shuffle' => ['privates', '.service_locator.zgz1dKt', 'get_ServiceLocator_Zgz1dKtService', true],
            'App\\Controller\\CardLandingController::card' => ['privates', '.service_locator.VptkjFl', 'get_ServiceLocator_VptkjFlService', true],
            'App\\Controller\\Game21Controller::bankPlaying' => ['privates', '.service_locator.2mgl6YI', 'get_ServiceLocator_2mgl6YIService', true],
            'App\\Controller\\Game21Controller::bet' => ['privates', '.service_locator.Q9850KJ', 'get_ServiceLocator_Q9850KJService', true],
            'App\\Controller\\Game21Controller::gameDoc' => ['privates', '.service_locator..jNOpKJ', 'get_ServiceLocator__JNOpKJService', true],
            'App\\Controller\\Game21Controller::init' => ['privates', '.service_locator.aLUT_A_', 'get_ServiceLocator_ALUTAService', true],
            'App\\Controller\\Game21Controller::main' => ['privates', '.service_locator..jNOpKJ', 'get_ServiceLocator__JNOpKJService', true],
            'App\\Controller\\Game21Controller::play' => ['privates', '.service_locator.Hyo_7pF', 'get_ServiceLocator_Hyo7pFService', true],
            'App\\Controller\\Game21Controller::playerDraw' => ['privates', '.service_locator.aN97.3Q', 'get_ServiceLocator_AN97_3QService', true],
            'App\\Controller\\Game21Controller::selectAmount' => ['privates', '.service_locator.Q9850KJ', 'get_ServiceLocator_Q9850KJService', true],
            'App\\Controller\\JsonCardDealController::jsonDeal' => ['privates', '.service_locator.ZQEfZjZ', 'get_ServiceLocator_ZQEfZjZService', true],
            'App\\Controller\\JsonCardDeckController::jsonDeck' => ['privates', '.service_locator.XVgdBtA', 'get_ServiceLocator_XVgdBtAService', true],
            'App\\Controller\\JsonCardDeckController::jsonShuffle' => ['privates', '.service_locator.XVgdBtA', 'get_ServiceLocator_XVgdBtAService', true],
            'App\\Controller\\JsonController::apis' => ['privates', '.service_locator.4z88Q58', 'get_ServiceLocator_4z88Q58Service', true],
            'App\\Controller\\JsonController::jsonQuote' => ['privates', '.service_locator..JPAfT_', 'get_ServiceLocator__JPAfTService', true],
            'App\\Controller\\JsonDealManyCardsController::jsonDrawMany' => ['privates', '.service_locator.WaMDEoP', 'get_ServiceLocator_WaMDEoPService', true],
            'App\\Controller\\JsonDealOneCardController::jsonDraw' => ['privates', '.service_locator.WaMDEoP', 'get_ServiceLocator_WaMDEoPService', true],
            'App\\Controller\\JsonGame21Controller::jsonGame' => ['privates', '.service_locator.vq74bGk', 'get_ServiceLocator_Vq74bGkService', true],
            'App\\Controller\\JsonLibraryController::showABookByIsbn' => ['privates', '.service_locator.B2ZeSAD', 'get_ServiceLocator_B2ZeSADService', true],
            'App\\Controller\\JsonLibraryController::showAllBooks' => ['privates', '.service_locator.RWtt3GP', 'get_ServiceLocator_RWtt3GPService', true],
            'App\\Controller\\LibraryController::createBook' => ['privates', '.service_locator.dD9JOvL', 'get_ServiceLocator_DD9JOvLService', true],
            'App\\Controller\\LibraryController::deleteBookByIsbn' => ['privates', '.service_locator.dD9JOvL', 'get_ServiceLocator_DD9JOvLService', true],
            'App\\Controller\\LibraryController::resetBook' => ['privates', '.service_locator.GQZbvNR', 'get_ServiceLocator_GQZbvNRService', true],
            'App\\Controller\\LibraryController::showAllBooks' => ['privates', '.service_locator.B2ZeSAD', 'get_ServiceLocator_B2ZeSADService', true],
            'App\\Controller\\LibraryController::showBookByIsbn' => ['privates', '.service_locator.B2ZeSAD', 'get_ServiceLocator_B2ZeSADService', true],
            'App\\Controller\\LibraryUpdateBookController::updateBook' => ['privates', '.service_locator.dD9JOvL', 'get_ServiceLocator_DD9JOvLService', true],
            'App\\Controller\\LibraryUpdateBookController::updateBookForm' => ['privates', '.service_locator.B2ZeSAD', 'get_ServiceLocator_B2ZeSADService', true],
            'App\\Controller\\MainController::about' => ['privates', '.service_locator.o.hPovE', 'get_ServiceLocator_O_HPovEService', true],
            'App\\Controller\\MainController::home' => ['privates', '.service_locator.o.hPovE', 'get_ServiceLocator_O_HPovEService', true],
            'App\\Controller\\MainController::metrics' => ['privates', '.service_locator.o.hPovE', 'get_ServiceLocator_O_HPovEService', true],
            'App\\Controller\\MainController::number' => ['privates', '.service_locator.JOjFqhp', 'get_ServiceLocator_JOjFqhpService', true],
            'App\\Controller\\MainController::report' => ['privates', '.service_locator.o.hPovE', 'get_ServiceLocator_O_HPovEService', true],
            'App\\Kernel::loadRoutes' => ['privates', '.service_locator.xUrKPVU', 'get_ServiceLocator_XUrKPVUService', true],
            'App\\Kernel::registerContainerConfiguration' => ['privates', '.service_locator.xUrKPVU', 'get_ServiceLocator_XUrKPVUService', true],
            'kernel::loadRoutes' => ['privates', '.service_locator.xUrKPVU', 'get_ServiceLocator_XUrKPVUService', true],
            'kernel::registerContainerConfiguration' => ['privates', '.service_locator.xUrKPVU', 'get_ServiceLocator_XUrKPVUService', true],
            'App\\Controller\\CardController:deal' => ['privates', '.service_locator.WQSKPJO', 'get_ServiceLocator_WQSKPJOService', true],
            'App\\Controller\\CardController:deck' => ['privates', '.service_locator.zgz1dKt', 'get_ServiceLocator_Zgz1dKtService', true],
            'App\\Controller\\CardController:draw' => ['privates', '.service_locator.TbQnfRD', 'get_ServiceLocator_TbQnfRDService', true],
            'App\\Controller\\CardController:drawMany' => ['privates', '.service_locator.TbQnfRD', 'get_ServiceLocator_TbQnfRDService', true],
            'App\\Controller\\CardController:shuffle' => ['privates', '.service_locator.zgz1dKt', 'get_ServiceLocator_Zgz1dKtService', true],
            'App\\Controller\\CardLandingController:card' => ['privates', '.service_locator.VptkjFl', 'get_ServiceLocator_VptkjFlService', true],
            'App\\Controller\\Game21Controller:bankPlaying' => ['privates', '.service_locator.2mgl6YI', 'get_ServiceLocator_2mgl6YIService', true],
            'App\\Controller\\Game21Controller:bet' => ['privates', '.service_locator.Q9850KJ', 'get_ServiceLocator_Q9850KJService', true],
            'App\\Controller\\Game21Controller:gameDoc' => ['privates', '.service_locator..jNOpKJ', 'get_ServiceLocator__JNOpKJService', true],
            'App\\Controller\\Game21Controller:init' => ['privates', '.service_locator.aLUT_A_', 'get_ServiceLocator_ALUTAService', true],
            'App\\Controller\\Game21Controller:main' => ['privates', '.service_locator..jNOpKJ', 'get_ServiceLocator__JNOpKJService', true],
            'App\\Controller\\Game21Controller:play' => ['privates', '.service_locator.Hyo_7pF', 'get_ServiceLocator_Hyo7pFService', true],
            'App\\Controller\\Game21Controller:playerDraw' => ['privates', '.service_locator.aN97.3Q', 'get_ServiceLocator_AN97_3QService', true],
            'App\\Controller\\Game21Controller:selectAmount' => ['privates', '.service_locator.Q9850KJ', 'get_ServiceLocator_Q9850KJService', true],
            'App\\Controller\\JsonCardDealController:jsonDeal' => ['privates', '.service_locator.ZQEfZjZ', 'get_ServiceLocator_ZQEfZjZService', true],
            'App\\Controller\\JsonCardDeckController:jsonDeck' => ['privates', '.service_locator.XVgdBtA', 'get_ServiceLocator_XVgdBtAService', true],
            'App\\Controller\\JsonCardDeckController:jsonShuffle' => ['privates', '.service_locator.XVgdBtA', 'get_ServiceLocator_XVgdBtAService', true],
            'App\\Controller\\JsonController:apis' => ['privates', '.service_locator.4z88Q58', 'get_ServiceLocator_4z88Q58Service', true],
            'App\\Controller\\JsonController:jsonQuote' => ['privates', '.service_locator..JPAfT_', 'get_ServiceLocator__JPAfTService', true],
            'App\\Controller\\JsonDealManyCardsController:jsonDrawMany' => ['privates', '.service_locator.WaMDEoP', 'get_ServiceLocator_WaMDEoPService', true],
            'App\\Controller\\JsonDealOneCardController:jsonDraw' => ['privates', '.service_locator.WaMDEoP', 'get_ServiceLocator_WaMDEoPService', true],
            'App\\Controller\\JsonGame21Controller:jsonGame' => ['privates', '.service_locator.vq74bGk', 'get_ServiceLocator_Vq74bGkService', true],
            'App\\Controller\\JsonLibraryController:showABookByIsbn' => ['privates', '.service_locator.B2ZeSAD', 'get_ServiceLocator_B2ZeSADService', true],
            'App\\Controller\\JsonLibraryController:showAllBooks' => ['privates', '.service_locator.RWtt3GP', 'get_ServiceLocator_RWtt3GPService', true],
            'App\\Controller\\LibraryController:createBook' => ['privates', '.service_locator.dD9JOvL', 'get_ServiceLocator_DD9JOvLService', true],
            'App\\Controller\\LibraryController:deleteBookByIsbn' => ['privates', '.service_locator.dD9JOvL', 'get_ServiceLocator_DD9JOvLService', true],
            'App\\Controller\\LibraryController:resetBook' => ['privates', '.service_locator.GQZbvNR', 'get_ServiceLocator_GQZbvNRService', true],
            'App\\Controller\\LibraryController:showAllBooks' => ['privates', '.service_locator.B2ZeSAD', 'get_ServiceLocator_B2ZeSADService', true],
            'App\\Controller\\LibraryController:showBookByIsbn' => ['privates', '.service_locator.B2ZeSAD', 'get_ServiceLocator_B2ZeSADService', true],
            'App\\Controller\\LibraryUpdateBookController:updateBook' => ['privates', '.service_locator.dD9JOvL', 'get_ServiceLocator_DD9JOvLService', true],
            'App\\Controller\\LibraryUpdateBookController:updateBookForm' => ['privates', '.service_locator.B2ZeSAD', 'get_ServiceLocator_B2ZeSADService', true],
            'App\\Controller\\MainController:about' => ['privates', '.service_locator.o.hPovE', 'get_ServiceLocator_O_HPovEService', true],
            'App\\Controller\\MainController:home' => ['privates', '.service_locator.o.hPovE', 'get_ServiceLocator_O_HPovEService', true],
            'App\\Controller\\MainController:metrics' => ['privates', '.service_locator.o.hPovE', 'get_ServiceLocator_O_HPovEService', true],
            'App\\Controller\\MainController:number' => ['privates', '.service_locator.JOjFqhp', 'get_ServiceLocator_JOjFqhpService', true],
            'App\\Controller\\MainController:report' => ['privates', '.service_locator.o.hPovE', 'get_ServiceLocator_O_HPovEService', true],
            'kernel:loadRoutes' => ['privates', '.service_locator.xUrKPVU', 'get_ServiceLocator_XUrKPVUService', true],
            'kernel:registerContainerConfiguration' => ['privates', '.service_locator.xUrKPVU', 'get_ServiceLocator_XUrKPVUService', true],
        ], [
            'App\\Controller\\CardController::deal' => '?',
            'App\\Controller\\CardController::deck' => '?',
            'App\\Controller\\CardController::draw' => '?',
            'App\\Controller\\CardController::drawMany' => '?',
            'App\\Controller\\CardController::shuffle' => '?',
            'App\\Controller\\CardLandingController::card' => '?',
            'App\\Controller\\Game21Controller::bankPlaying' => '?',
            'App\\Controller\\Game21Controller::bet' => '?',
            'App\\Controller\\Game21Controller::gameDoc' => '?',
            'App\\Controller\\Game21Controller::init' => '?',
            'App\\Controller\\Game21Controller::main' => '?',
            'App\\Controller\\Game21Controller::play' => '?',
            'App\\Controller\\Game21Controller::playerDraw' => '?',
            'App\\Controller\\Game21Controller::selectAmount' => '?',
            'App\\Controller\\JsonCardDealController::jsonDeal' => '?',
            'App\\Controller\\JsonCardDeckController::jsonDeck' => '?',
            'App\\Controller\\JsonCardDeckController::jsonShuffle' => '?',
            'App\\Controller\\JsonController::apis' => '?',
            'App\\Controller\\JsonController::jsonQuote' => '?',
            'App\\Controller\\JsonDealManyCardsController::jsonDrawMany' => '?',
            'App\\Controller\\JsonDealOneCardController::jsonDraw' => '?',
            'App\\Controller\\JsonGame21Controller::jsonGame' => '?',
            'App\\Controller\\JsonLibraryController::showABookByIsbn' => '?',
            'App\\Controller\\JsonLibraryController::showAllBooks' => '?',
            'App\\Controller\\LibraryController::createBook' => '?',
            'App\\Controller\\LibraryController::deleteBookByIsbn' => '?',
            'App\\Controller\\LibraryController::resetBook' => '?',
            'App\\Controller\\LibraryController::showAllBooks' => '?',
            'App\\Controller\\LibraryController::showBookByIsbn' => '?',
            'App\\Controller\\LibraryUpdateBookController::updateBook' => '?',
            'App\\Controller\\LibraryUpdateBookController::updateBookForm' => '?',
            'App\\Controller\\MainController::about' => '?',
            'App\\Controller\\MainController::home' => '?',
            'App\\Controller\\MainController::metrics' => '?',
            'App\\Controller\\MainController::number' => '?',
            'App\\Controller\\MainController::report' => '?',
            'App\\Kernel::loadRoutes' => '?',
            'App\\Kernel::registerContainerConfiguration' => '?',
            'kernel::loadRoutes' => '?',
            'kernel::registerContainerConfiguration' => '?',
            'App\\Controller\\CardController:deal' => '?',
            'App\\Controller\\CardController:deck' => '?',
            'App\\Controller\\CardController:draw' => '?',
            'App\\Controller\\CardController:drawMany' => '?',
            'App\\Controller\\CardController:shuffle' => '?',
            'App\\Controller\\CardLandingController:card' => '?',
            'App\\Controller\\Game21Controller:bankPlaying' => '?',
            'App\\Controller\\Game21Controller:bet' => '?',
            'App\\Controller\\Game21Controller:gameDoc' => '?',
            'App\\Controller\\Game21Controller:init' => '?',
            'App\\Controller\\Game21Controller:main' => '?',
            'App\\Controller\\Game21Controller:play' => '?',
            'App\\Controller\\Game21Controller:playerDraw' => '?',
            'App\\Controller\\Game21Controller:selectAmount' => '?',
            'App\\Controller\\JsonCardDealController:jsonDeal' => '?',
            'App\\Controller\\JsonCardDeckController:jsonDeck' => '?',
            'App\\Controller\\JsonCardDeckController:jsonShuffle' => '?',
            'App\\Controller\\JsonController:apis' => '?',
            'App\\Controller\\JsonController:jsonQuote' => '?',
            'App\\Controller\\JsonDealManyCardsController:jsonDrawMany' => '?',
            'App\\Controller\\JsonDealOneCardController:jsonDraw' => '?',
            'App\\Controller\\JsonGame21Controller:jsonGame' => '?',
            'App\\Controller\\JsonLibraryController:showABookByIsbn' => '?',
            'App\\Controller\\JsonLibraryController:showAllBooks' => '?',
            'App\\Controller\\LibraryController:createBook' => '?',
            'App\\Controller\\LibraryController:deleteBookByIsbn' => '?',
            'App\\Controller\\LibraryController:resetBook' => '?',
            'App\\Controller\\LibraryController:showAllBooks' => '?',
            'App\\Controller\\LibraryController:showBookByIsbn' => '?',
            'App\\Controller\\LibraryUpdateBookController:updateBook' => '?',
            'App\\Controller\\LibraryUpdateBookController:updateBookForm' => '?',
            'App\\Controller\\MainController:about' => '?',
            'App\\Controller\\MainController:home' => '?',
            'App\\Controller\\MainController:metrics' => '?',
            'App\\Controller\\MainController:number' => '?',
            'App\\Controller\\MainController:report' => '?',
            'kernel:loadRoutes' => '?',
            'kernel:registerContainerConfiguration' => '?',
        ]);
    }
}

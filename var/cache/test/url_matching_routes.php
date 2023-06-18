<?php

/**
 * This file has been auto-generated
 * by the Symfony Routing Component.
 */

return [
    false, // $matchHost
    [ // $staticRoutes
        '/card/deck' => [[['_route' => 'deck', '_controller' => 'App\\Controller\\CardController::deck'], null, ['GET' => 0], null, false, false, null]],
        '/card/deck/shuffle' => [[['_route' => 'shuffle', '_controller' => 'App\\Controller\\CardController::shuffle'], null, ['POST' => 0], null, false, false, null]],
        '/card/deck/draw' => [[['_route' => 'draw', '_controller' => 'App\\Controller\\CardController::draw'], null, ['POST' => 0], null, false, false, null]],
        '/card' => [[['_route' => 'card', '_controller' => 'App\\Controller\\CardLandingController::card'], null, null, null, false, false, null]],
        '/game' => [[['_route' => 'gameMain', '_controller' => 'App\\Controller\\Game21Controller::main'], null, ['GET' => 0], null, false, false, null]],
        '/game/doc' => [[['_route' => 'gameDoc', '_controller' => 'App\\Controller\\Game21Controller::gameDoc'], null, ['GET' => 0], null, false, false, null]],
        '/game/select-amount' => [[['_route' => 'selectAmount', '_controller' => 'App\\Controller\\Game21Controller::selectAmount'], null, ['GET' => 0], null, false, false, null]],
        '/game/draw' => [[['_route' => 'playerDraw', '_controller' => 'App\\Controller\\Game21Controller::playerDraw'], null, ['POST' => 0], null, false, false, null]],
        '/game/bank-playing' => [[['_route' => 'bankPlaying', '_controller' => 'App\\Controller\\Game21Controller::bankPlaying'], null, ['POST' => 0], null, false, false, null]],
        '/game/play' => [[['_route' => 'play', '_controller' => 'App\\Controller\\Game21Controller::play'], null, ['GET' => 0], null, false, false, null]],
        '/api/deck' => [[['_route' => 'jsonDeck', '_controller' => 'App\\Controller\\JsonCardDeckController::jsonDeck'], null, ['GET' => 0], null, false, false, null]],
        '/api/deck/shuffle' => [[['_route' => 'jsonShuffle', '_controller' => 'App\\Controller\\JsonCardDeckController::jsonShuffle'], null, ['POST' => 0], null, false, false, null]],
        '/api' => [[['_route' => 'api', '_controller' => 'App\\Controller\\JsonController::apis'], null, null, null, false, false, null]],
        '/api/quote' => [[['_route' => 'quote', '_controller' => 'App\\Controller\\JsonController::jsonQuote'], null, null, null, false, false, null]],
        '/api/deck/draw' => [[['_route' => 'jsonDraw', '_controller' => 'App\\Controller\\JsonDealOneCardController::jsonDraw'], null, ['POST' => 0], null, false, false, null]],
        '/api/game' => [[['_route' => 'jsonGame', '_controller' => 'App\\Controller\\JsonGame21Controller::jsonGame'], null, ['GET' => 0], null, false, false, null]],
        '/api/library/books' => [[['_route' => 'books_json', '_controller' => 'App\\Controller\\JsonLibraryController::showAllBooks'], null, null, null, false, false, null]],
        '/library' => [[['_route' => 'library', '_controller' => 'App\\Controller\\LibraryController::index'], null, null, null, false, false, null]],
        '/library/create' => [[['_route' => 'create_form', '_controller' => 'App\\Controller\\LibraryController::createBookForm'], null, null, null, false, false, null]],
        '/library/create_new' => [[['_route' => 'book_create', '_controller' => 'App\\Controller\\LibraryController::createBook'], null, ['POST' => 0], null, false, false, null]],
        '/library/read_many' => [[['_route' => 'read_many', '_controller' => 'App\\Controller\\LibraryController::showAllBooks'], null, null, null, false, false, null]],
        '/library/reset' => [[['_route' => 'reset_library', '_controller' => 'App\\Controller\\LibraryController::resetBook'], null, ['POST' => 0], null, false, false, null]],
        '/library/update_one' => [[['_route' => 'book_update', '_controller' => 'App\\Controller\\LibraryUpdateBookController::updateBook'], null, ['POST' => 0], null, false, false, null]],
        '/' => [[['_route' => 'home', '_controller' => 'App\\Controller\\MainController::home'], null, null, null, false, false, null]],
        '/about' => [[['_route' => 'about', '_controller' => 'App\\Controller\\MainController::about'], null, null, null, false, false, null]],
        '/report' => [[['_route' => 'report', '_controller' => 'App\\Controller\\MainController::report'], null, null, null, false, false, null]],
        '/lucky' => [[['_route' => 'lucky', '_controller' => 'App\\Controller\\MainController::number'], null, null, null, false, false, null]],
        '/metrics' => [[['_route' => 'metrics', '_controller' => 'App\\Controller\\MainController::metrics'], null, null, null, false, false, null]],
        '/project/api/bot-plays' => [[['_route' => 'api-bot-plays', '_controller' => 'App\\Controller\\ProjectApiController::apiOneRound'], null, ['POST' => 0], null, false, false, null]],
        '/project/api/results' => [[['_route' => 'api-results', '_controller' => 'App\\Controller\\ProjectApiController::apiResults'], null, ['POST' => 0], null, false, false, null]],
        '/proj/register' => [[['_route' => 'register', '_controller' => 'App\\Controller\\ProjectAuthController::projRegister'], null, ['POST' => 0], null, false, false, null]],
        '/proj/login' => [[['_route' => 'login', '_controller' => 'App\\Controller\\ProjectAuthController::projLogin'], null, ['POST' => 0], null, false, false, null]],
        '/proj/logout' => [[['_route' => 'logout', '_controller' => 'App\\Controller\\ProjectAuthController::projLogout'], null, ['GET' => 0], null, false, false, null]],
        '/proj/shop' => [[['_route' => 'shop', '_controller' => 'App\\Controller\\ProjectAuthController::projShop'], null, null, null, false, false, null]],
        '/proj/register-form' => [[['_route' => 'register-form', '_controller' => 'App\\Controller\\ProjectFormController::projRegisterForm'], null, null, null, false, false, null]],
        '/proj/play' => [[['_route' => 'proj-play', '_controller' => 'App\\Controller\\ProjectGameController::projPlay'], null, null, null, false, false, null]],
        '/proj/init' => [[['_route' => 'proj-init', '_controller' => 'App\\Controller\\ProjectGameController::projInit'], null, null, null, false, false, null]],
        '/proj' => [[['_route' => 'proj', '_controller' => 'App\\Controller\\ProjectMainController::projLanding'], null, null, null, false, false, null]],
        '/proj/api' => [[['_route' => 'proj-api', '_controller' => 'App\\Controller\\ProjectMainController::projApiLanding'], null, null, null, false, false, null]],
        '/proj/about' => [[['_route' => 'proj-about', '_controller' => 'App\\Controller\\ProjectMainController::projAbout'], null, null, null, false, false, null]],
        '/proj/rules' => [[['_route' => 'proj-rules', '_controller' => 'App\\Controller\\ProjectMainController::projRules'], null, null, null, false, false, null]],
    ],
    [ // $regexpList
        0 => '{^(?'
                .'|/card/deck/d(?'
                    .'|raw/(\\d+)(*:31)'
                    .'|eal/(\\d+)/(\\d+)(*:53)'
                .')'
                .'|/game/(?'
                    .'|init(?:/(\\d+))?(*:85)'
                    .'|bet/(\\d+)(*:101)'
                .')'
                .'|/api/(?'
                    .'|deck/d(?'
                        .'|eal/(\\d+)/(\\d+)(*:142)'
                        .'|raw/(\\d+)(*:159)'
                    .')'
                    .'|library/book/([^/]++)(*:189)'
                .')'
                .'|/library/(?'
                    .'|read_one/([^/]++)(*:227)'
                    .'|delete/([^/]++)(*:250)'
                    .'|update/([^/]++)(*:273)'
                .')'
                .'|/project/api/place\\-card/(\\d+)/(\\d+)(*:318)'
            .')/?$}sDu',
    ],
    [ // $dynamicRoutes
        31 => [[['_route' => 'drawMany', '_controller' => 'App\\Controller\\CardController::drawMany'], ['number'], ['POST' => 0], null, false, true, null]],
        53 => [[['_route' => 'deal', '_controller' => 'App\\Controller\\CardController::deal'], ['players', 'cards'], ['POST' => 0], null, false, true, null]],
        85 => [[['_route' => 'init', 'level' => 0, '_controller' => 'App\\Controller\\Game21Controller::init'], ['level'], ['POST' => 0], null, false, true, null]],
        101 => [[['_route' => 'bet', '_controller' => 'App\\Controller\\Game21Controller::bet'], ['amount'], ['POST' => 0], null, false, true, null]],
        142 => [[['_route' => 'jsonDeal', '_controller' => 'App\\Controller\\JsonCardDealController::jsonDeal'], ['players', 'cards'], ['POST' => 0], null, false, true, null]],
        159 => [[['_route' => 'jsonDrawMany', '_controller' => 'App\\Controller\\JsonDealManyCardsController::jsonDrawMany'], ['number'], ['POST' => 0], null, false, true, null]],
        189 => [[['_route' => 'single_book_json', '_controller' => 'App\\Controller\\JsonLibraryController::showABookByIsbn'], ['isbn'], null, null, false, true, null]],
        227 => [[['_route' => 'read_one', '_controller' => 'App\\Controller\\LibraryController::showBookByIsbn'], ['isbn'], null, null, false, true, null]],
        250 => [[['_route' => 'book_delete_by_isbn', '_controller' => 'App\\Controller\\LibraryController::deleteBookByIsbn'], ['isbn'], ['POST' => 0], null, false, true, null]],
        273 => [[['_route' => 'update_form', '_controller' => 'App\\Controller\\LibraryUpdateBookController::updateBookForm'], ['isbn'], null, null, false, true, null]],
        318 => [
            [['_route' => 'api-place-card', '_controller' => 'App\\Controller\\ProjectApiController::apiNew'], ['row', 'col'], ['POST' => 0], null, false, true, null],
            [null, null, null, null, false, false, 0],
        ],
    ],
    null, // $checkCondition
];

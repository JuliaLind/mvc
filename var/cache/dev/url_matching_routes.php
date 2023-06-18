<?php

/**
 * This file has been auto-generated
 * by the Symfony Routing Component.
 */

return [
    false, // $matchHost
    [ // $staticRoutes
        '/_profiler' => [[['_route' => '_profiler_home', '_controller' => 'web_profiler.controller.profiler::homeAction'], null, null, null, true, false, null]],
        '/_profiler/search' => [[['_route' => '_profiler_search', '_controller' => 'web_profiler.controller.profiler::searchAction'], null, null, null, false, false, null]],
        '/_profiler/search_bar' => [[['_route' => '_profiler_search_bar', '_controller' => 'web_profiler.controller.profiler::searchBarAction'], null, null, null, false, false, null]],
        '/_profiler/phpinfo' => [[['_route' => '_profiler_phpinfo', '_controller' => 'web_profiler.controller.profiler::phpinfoAction'], null, null, null, false, false, null]],
        '/_profiler/xdebug' => [[['_route' => '_profiler_xdebug', '_controller' => 'web_profiler.controller.profiler::xdebugAction'], null, null, null, false, false, null]],
        '/_profiler/open' => [[['_route' => '_profiler_open_file', '_controller' => 'web_profiler.controller.profiler::openAction'], null, null, null, false, false, null]],
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
                .'|/_(?'
                    .'|error/(\\d+)(?:\\.([^/]++))?(*:38)'
                    .'|wdt/([^/]++)(*:57)'
                    .'|profiler/([^/]++)(?'
                        .'|/(?'
                            .'|search/results(*:102)'
                            .'|router(*:116)'
                            .'|exception(?'
                                .'|(*:136)'
                                .'|\\.css(*:149)'
                            .')'
                        .')'
                        .'|(*:159)'
                    .')'
                .')'
                .'|/card/deck/d(?'
                    .'|raw/(\\d+)(*:193)'
                    .'|eal/(\\d+)/(\\d+)(*:216)'
                .')'
                .'|/game/(?'
                    .'|init(?:/(\\d+))?(*:249)'
                    .'|bet/(\\d+)(*:266)'
                .')'
                .'|/api/(?'
                    .'|deck/d(?'
                        .'|eal/(\\d+)/(\\d+)(*:307)'
                        .'|raw/(\\d+)(*:324)'
                    .')'
                    .'|library/book/([^/]++)(*:354)'
                .')'
                .'|/library/(?'
                    .'|read_one/([^/]++)(*:392)'
                    .'|delete/([^/]++)(*:415)'
                    .'|update/([^/]++)(*:438)'
                .')'
                .'|/project/api/(?'
                    .'|place\\-card/(\\d+)/(\\d+)(*:486)'
                    .'|user/([^/]++)(*:507)'
                .')'
            .')/?$}sDu',
    ],
    [ // $dynamicRoutes
        38 => [[['_route' => '_preview_error', '_controller' => 'error_controller::preview', '_format' => 'html'], ['code', '_format'], null, null, false, true, null]],
        57 => [[['_route' => '_wdt', '_controller' => 'web_profiler.controller.profiler::toolbarAction'], ['token'], null, null, false, true, null]],
        102 => [[['_route' => '_profiler_search_results', '_controller' => 'web_profiler.controller.profiler::searchResultsAction'], ['token'], null, null, false, false, null]],
        116 => [[['_route' => '_profiler_router', '_controller' => 'web_profiler.controller.router::panelAction'], ['token'], null, null, false, false, null]],
        136 => [[['_route' => '_profiler_exception', '_controller' => 'web_profiler.controller.exception_panel::body'], ['token'], null, null, false, false, null]],
        149 => [[['_route' => '_profiler_exception_css', '_controller' => 'web_profiler.controller.exception_panel::stylesheet'], ['token'], null, null, false, false, null]],
        159 => [[['_route' => '_profiler', '_controller' => 'web_profiler.controller.profiler::panelAction'], ['token'], null, null, false, true, null]],
        193 => [[['_route' => 'drawMany', '_controller' => 'App\\Controller\\CardController::drawMany'], ['number'], ['POST' => 0], null, false, true, null]],
        216 => [[['_route' => 'deal', '_controller' => 'App\\Controller\\CardController::deal'], ['players', 'cards'], ['POST' => 0], null, false, true, null]],
        249 => [[['_route' => 'init', 'level' => 0, '_controller' => 'App\\Controller\\Game21Controller::init'], ['level'], ['POST' => 0], null, false, true, null]],
        266 => [[['_route' => 'bet', '_controller' => 'App\\Controller\\Game21Controller::bet'], ['amount'], ['POST' => 0], null, false, true, null]],
        307 => [[['_route' => 'jsonDeal', '_controller' => 'App\\Controller\\JsonCardDealController::jsonDeal'], ['players', 'cards'], ['POST' => 0], null, false, true, null]],
        324 => [[['_route' => 'jsonDrawMany', '_controller' => 'App\\Controller\\JsonDealManyCardsController::jsonDrawMany'], ['number'], ['POST' => 0], null, false, true, null]],
        354 => [[['_route' => 'single_book_json', '_controller' => 'App\\Controller\\JsonLibraryController::showABookByIsbn'], ['isbn'], null, null, false, true, null]],
        392 => [[['_route' => 'read_one', '_controller' => 'App\\Controller\\LibraryController::showBookByIsbn'], ['isbn'], null, null, false, true, null]],
        415 => [[['_route' => 'book_delete_by_isbn', '_controller' => 'App\\Controller\\LibraryController::deleteBookByIsbn'], ['isbn'], ['POST' => 0], null, false, true, null]],
        438 => [[['_route' => 'update_form', '_controller' => 'App\\Controller\\LibraryUpdateBookController::updateBookForm'], ['isbn'], null, null, false, true, null]],
        486 => [[['_route' => 'api-place-card', '_controller' => 'App\\Controller\\ProjectApiController::apiNew'], ['row', 'col'], ['POST' => 0], null, false, true, null]],
        507 => [
            [['_route' => 'api-user', '_controller' => 'App\\Controller\\ProjectApiController::apiUser'], ['email'], ['GET' => 0], null, false, true, null],
            [null, null, null, null, false, false, 0],
        ],
    ],
    null, // $checkCondition
];

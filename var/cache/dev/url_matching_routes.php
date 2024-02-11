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
        '/' => [[['_route' => 'home', '_controller' => 'App\\Controller\\MainController::home'], null, null, null, false, false, null]],
        '/about' => [[['_route' => 'about', '_controller' => 'App\\Controller\\MainController::about'], null, null, null, false, false, null]],
        '/report' => [[['_route' => 'report', '_controller' => 'App\\Controller\\MainController::report'], null, null, null, false, false, null]],
        '/metrics' => [[['_route' => 'metrics', '_controller' => 'App\\Controller\\MainController::metrics'], null, null, null, false, false, null]],
        '/proj/api/bot-plays' => [[['_route' => 'api-bot-plays', '_controller' => 'App\\Controller\\ProjectApiController1::apiOneRound'], null, ['POST' => 0], null, false, false, null]],
        '/proj/api/transactions' => [[['_route' => 'api-transactions', '_controller' => 'App\\Controller\\ProjectApiController3::apiTransactions'], null, ['GET' => 0], null, false, false, null]],
        '/proj/api/game-state' => [[['_route' => 'api-game-state', '_controller' => 'App\\Controller\\ProjectApiController5::apiGameState'], null, null, null, false, false, null]],
        '/proj/api/users' => [[['_route' => 'api-users', '_controller' => 'App\\Controller\\ProjectApiController6::apiUsers'], null, ['GET' => 0], null, false, false, null]],
        '/proj/api/leaderboard' => [[['_route' => 'api-leaderboard', '_controller' => 'App\\Controller\\ProjectApiController7::apiLeaderboard'], null, ['GET' => 0], null, false, false, null]],
        '/proj/api/results' => [[['_route' => 'api-results', '_controller' => 'App\\Controller\\ProjectApiController8::apiResults'], null, ['POST' => 0], null, false, false, null]],
        '/proj/register' => [[['_route' => 'register', '_controller' => 'App\\Controller\\ProjectAuthController::projRegister'], null, ['POST' => 0], null, false, false, null]],
        '/proj/login' => [[['_route' => 'login', '_controller' => 'App\\Controller\\ProjectAuthController::projLogin'], null, ['POST' => 0], null, false, false, null]],
        '/proj/logout' => [[['_route' => 'logout', '_controller' => 'App\\Controller\\ProjectAuthController::projLogout'], null, ['GET' => 0], null, false, false, null]],
        '/proj/select-amount' => [[['_route' => 'select-amount', '_controller' => 'App\\Controller\\ProjectCoinsController::selectAmount'], null, null, null, false, false, null]],
        '/proj/api' => [[['_route' => 'proj-api', '_controller' => 'App\\Controller\\ProjectController::projApiLanding'], null, null, null, false, false, null]],
        '/proj/about' => [[['_route' => 'proj-about', '_controller' => 'App\\Controller\\ProjectController::projAbout'], null, null, null, false, false, null]],
        '/proj/about/database' => [[['_route' => 'proj-db', '_controller' => 'App\\Controller\\ProjectController::projDb'], null, null, null, false, false, null]],
        '/proj/rules' => [[['_route' => 'proj-rules', '_controller' => 'App\\Controller\\ProjectController::projRules'], null, null, null, false, false, null]],
        '/proj/register-form' => [[['_route' => 'register-form', '_controller' => 'App\\Controller\\ProjectController::projRegisterForm'], null, null, null, false, false, null]],
        '/proj/init' => [[['_route' => 'proj-init', '_controller' => 'App\\Controller\\ProjectInitController::projInit'], null, null, null, false, false, null]],
        '/proj' => [[['_route' => 'proj', '_controller' => 'App\\Controller\\ProjectLandingController::projLanding'], null, null, null, false, false, null]],
        '/proj/place-card' => [[['_route' => 'place-card', '_controller' => 'App\\Controller\\ProjectMoveCardController::placeCard'], null, null, null, false, false, null]],
        '/proj/play' => [[['_route' => 'proj-play', '_controller' => 'App\\Controller\\ProjectPlayController::projPlay'], null, null, null, false, false, null]],
        '/proj/reset' => [[['_route' => 'reset_project', '_controller' => 'App\\Controller\\ProjectResetController::resetProj'], null, ['POST' => 0], null, false, false, null]],
        '/proj/scores-single' => [[['_route' => 'proj-scores-single', '_controller' => 'App\\Controller\\ProjectScoresController::projScoresSingle'], null, null, null, false, false, null]],
        '/proj/leaderboard' => [[['_route' => 'proj-leaderboard', '_controller' => 'App\\Controller\\ProjectScoresController::projLeaderboard'], null, null, null, false, false, null]],
        '/proj/shop' => [[['_route' => 'shop', '_controller' => 'App\\Controller\\ProjectShopController::projShop'], null, null, null, false, false, null]],
        '/proj/transactions' => [[['_route' => 'proj-trans', '_controller' => 'App\\Controller\\ProjectShopController::projTrans'], null, null, null, false, false, null]],
        '/proj/purchase-suggestion' => [[['_route' => 'purchase-suggestion', '_controller' => 'App\\Controller\\ProjectSuggestionController::projPurchaseSuggest'], null, ['POST' => 0], null, false, false, null]],
        '/proj/show-suggestion' => [[['_route' => 'show-suggestion', '_controller' => 'App\\Controller\\ProjectSuggestionController::projShowSuggest'], null, null, null, false, false, null]],
        '/proj/undo' => [[['_route' => 'undo', '_controller' => 'App\\Controller\\ProjectUndoController::undo'], null, ['POST' => 0], null, false, false, null]],
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
                .'|/proj/(?'
                    .'|api/(?'
                        .'|user/([^/]++)(*:198)'
                        .'|place\\-card/(\\d+)/(\\d+)(*:229)'
                    .')'
                    .'|p(?'
                        .'|urchase/(\\d+)(*:255)'
                        .'|ick\\-card/(\\d+)(*:278)'
                    .')'
                    .'|move\\-card/(\\d+)/(\\d+)(*:309)'
                    .'|one\\-round/(\\d+)/(\\d+)(*:339)'
                    .'|set\\-fromslot/(\\d+)/(\\d+)(*:372)'
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
        198 => [[['_route' => 'api-user', '_controller' => 'App\\Controller\\ProjectApiController2::apiUser'], ['email'], ['GET' => 0], null, false, true, null]],
        229 => [[['_route' => 'api-place-card', '_controller' => 'App\\Controller\\ProjectApiController4::apiPlaceCard'], ['row', 'col'], ['POST' => 0], null, false, true, null]],
        255 => [[['_route' => 'purchase', '_controller' => 'App\\Controller\\ProjectCoinsController::projPurchase'], ['coins'], ['POST' => 0], null, false, true, null]],
        278 => [[['_route' => 'pick-card', '_controller' => 'App\\Controller\\ProjectPickCardController::pickCard'], ['balance'], null, null, false, true, null]],
        309 => [[['_route' => 'move-card', '_controller' => 'App\\Controller\\ProjectMoveCardController::moveCard'], ['row', 'col'], ['POST' => 0], null, false, true, null]],
        339 => [[['_route' => 'proj-round', '_controller' => 'App\\Controller\\ProjectOneRoundController::projRound'], ['row', 'col'], ['POST' => 0], null, false, true, null]],
        372 => [
            [['_route' => 'set-fromslot', '_controller' => 'App\\Controller\\ProjectPickCardController::setFromSlot'], ['row', 'col'], ['POST' => 0], null, false, true, null],
            [null, null, null, null, false, false, 0],
        ],
    ],
    null, // $checkCondition
];

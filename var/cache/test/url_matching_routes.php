<?php

/**
 * This file has been auto-generated
 * by the Symfony Routing Component.
 */

return [
    false, // $matchHost
    [ // $staticRoutes
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
                .'|/proj/(?'
                    .'|api/(?'
                        .'|user/([^/]++)(*:36)'
                        .'|place\\-card/(\\d+)/(\\d+)(*:66)'
                    .')'
                    .'|p(?'
                        .'|urchase/(\\d+)(*:91)'
                        .'|ick\\-card/(\\d+)(*:113)'
                    .')'
                    .'|move\\-card/(\\d+)/(\\d+)(*:144)'
                    .'|one\\-round/(\\d+)/(\\d+)(*:174)'
                    .'|set\\-fromslot/(\\d+)/(\\d+)(*:207)'
                .')'
            .')/?$}sDu',
    ],
    [ // $dynamicRoutes
        36 => [[['_route' => 'api-user', '_controller' => 'App\\Controller\\ProjectApiController2::apiUser'], ['email'], ['GET' => 0], null, false, true, null]],
        66 => [[['_route' => 'api-place-card', '_controller' => 'App\\Controller\\ProjectApiController4::apiPlaceCard'], ['row', 'col'], ['POST' => 0], null, false, true, null]],
        91 => [[['_route' => 'purchase', '_controller' => 'App\\Controller\\ProjectCoinsController::projPurchase'], ['coins'], ['POST' => 0], null, false, true, null]],
        113 => [[['_route' => 'pick-card', '_controller' => 'App\\Controller\\ProjectPickCardController::pickCard'], ['balance'], null, null, false, true, null]],
        144 => [[['_route' => 'move-card', '_controller' => 'App\\Controller\\ProjectMoveCardController::moveCard'], ['row', 'col'], ['POST' => 0], null, false, true, null]],
        174 => [[['_route' => 'proj-round', '_controller' => 'App\\Controller\\ProjectOneRoundController::projRound'], ['row', 'col'], ['POST' => 0], null, false, true, null]],
        207 => [
            [['_route' => 'set-fromslot', '_controller' => 'App\\Controller\\ProjectPickCardController::setFromSlot'], ['row', 'col'], ['POST' => 0], null, false, true, null],
            [null, null, null, null, false, false, 0],
        ],
    ],
    null, // $checkCondition
];

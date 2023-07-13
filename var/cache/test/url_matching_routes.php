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
        '/card' => [[['_route' => 'card', '_controller' => 'App\\Controller\\CardController::card'], null, null, null, false, false, null]],
        '/card/deck/draw' => [[['_route' => 'draw', '_controller' => 'App\\Controller\\CardController2::draw'], null, ['POST' => 0], null, false, false, null]],
        '/game' => [[['_route' => 'gameMain', '_controller' => 'App\\Controller\\Game21Controller::main'], null, ['GET' => 0], null, false, false, null]],
        '/game/doc' => [[['_route' => 'gameDoc', '_controller' => 'App\\Controller\\Game21Controller::gameDoc'], null, ['GET' => 0], null, false, false, null]],
        '/game/bank-playing' => [[['_route' => 'bankPlaying', '_controller' => 'App\\Controller\\Game21Controller2::bankPlaying'], null, ['POST' => 0], null, false, false, null]],
        '/game/select-amount' => [[['_route' => 'selectAmount', '_controller' => 'App\\Controller\\Game21Controller3::selectAmount'], null, ['GET' => 0], null, false, false, null]],
        '/game/play' => [[['_route' => 'play', '_controller' => 'App\\Controller\\Game21Controller6::play'], null, ['GET' => 0], null, false, false, null]],
        '/game/draw' => [[['_route' => 'playerDraw', '_controller' => 'App\\Controller\\Game21Controller7::playerDraw'], null, ['POST' => 0], null, false, false, null]],
        '/api/deck' => [[['_route' => 'jsonDeck', '_controller' => 'App\\Controller\\JsonCardController2::jsonDeck'], null, ['GET' => 0], null, false, false, null]],
        '/api/deck/draw' => [[['_route' => 'jsonDraw', '_controller' => 'App\\Controller\\JsonCardController4::jsonDraw'], null, ['POST' => 0], null, false, false, null]],
        '/api/deck/shuffle' => [[['_route' => 'jsonShuffle', '_controller' => 'App\\Controller\\JsonCardController5::jsonShuffle'], null, ['POST' => 0], null, false, false, null]],
        '/api' => [[['_route' => 'api', '_controller' => 'App\\Controller\\JsonController::apis'], null, null, null, false, false, null]],
        '/api/quote' => [[['_route' => 'quote', '_controller' => 'App\\Controller\\JsonController2::jsonQuote'], null, null, null, false, false, null]],
        '/api/game' => [[['_route' => 'jsonGame', '_controller' => 'App\\Controller\\JsonGame21Controller::jsonGame'], null, ['GET' => 0], null, false, false, null]],
        '/api/library/books' => [[['_route' => 'books_json', '_controller' => 'App\\Controller\\JsonLibraryController::showAllBooks'], null, null, null, false, false, null]],
        '/library/read_many' => [[['_route' => 'read_many', '_controller' => 'App\\Controller\\LibraryController::showAllBooks'], null, null, null, false, false, null]],
        '/library/create_new' => [[['_route' => 'book_create', '_controller' => 'App\\Controller\\LibraryCreateNewController::createBook'], null, ['POST' => 0], null, false, false, null]],
        '/library/create' => [[['_route' => 'create_form', '_controller' => 'App\\Controller\\LibraryCreateNewController2::createBookForm'], null, null, null, false, false, null]],
        '/library' => [[['_route' => 'library', '_controller' => 'App\\Controller\\LibraryLandingController::index'], null, null, null, false, false, null]],
        '/library/reset' => [[['_route' => 'reset_library', '_controller' => 'App\\Controller\\LibraryResetController::resetBook'], null, ['POST' => 0], null, false, false, null]],
        '/library/update_one' => [[['_route' => 'book_update', '_controller' => 'App\\Controller\\LibraryUpdateController2::updateBook'], null, ['POST' => 0], null, false, false, null]],
        '/' => [[['_route' => 'home', '_controller' => 'App\\Controller\\MainController::home'], null, null, null, false, false, null]],
        '/about' => [[['_route' => 'about', '_controller' => 'App\\Controller\\MainController::about'], null, null, null, false, false, null]],
        '/report' => [[['_route' => 'report', '_controller' => 'App\\Controller\\MainController::report'], null, null, null, false, false, null]],
        '/lucky' => [[['_route' => 'lucky', '_controller' => 'App\\Controller\\MainController::number'], null, null, null, false, false, null]],
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
                .'|/proj/(?'
                    .'|api/(?'
                        .'|user/([^/]++)(*:311)'
                        .'|place\\-card/(\\d+)/(\\d+)(*:342)'
                    .')'
                    .'|p(?'
                        .'|urchase/(\\d+)(*:368)'
                        .'|ick\\-card/(\\d+)(*:391)'
                    .')'
                    .'|set\\-fromslot/(\\d+)/(\\d+)(*:425)'
                    .'|move\\-card/(\\d+)/(\\d+)(*:455)'
                    .'|one\\-round/(\\d+)/(\\d+)(*:485)'
                .')'
            .')/?$}sDu',
    ],
    [ // $dynamicRoutes
        31 => [[['_route' => 'drawMany', '_controller' => 'App\\Controller\\CardController2::drawMany'], ['number'], ['POST' => 0], null, false, true, null]],
        53 => [[['_route' => 'deal', '_controller' => 'App\\Controller\\CardController2::deal'], ['players', 'cards'], ['POST' => 0], null, false, true, null]],
        85 => [[['_route' => 'init', 'level' => 0, '_controller' => 'App\\Controller\\Game21Controller4::init'], ['level'], ['POST' => 0], null, false, true, null]],
        101 => [[['_route' => 'bet', '_controller' => 'App\\Controller\\Game21Controller5::bet'], ['amount'], ['POST' => 0], null, false, true, null]],
        142 => [[['_route' => 'jsonDeal', '_controller' => 'App\\Controller\\JsonCardController::jsonDeal'], ['players', 'cards'], ['POST' => 0], null, false, true, null]],
        159 => [[['_route' => 'jsonDrawMany', '_controller' => 'App\\Controller\\JsonCardController3::jsonDrawMany'], ['number'], ['POST' => 0], null, false, true, null]],
        189 => [[['_route' => 'single_book_json', '_controller' => 'App\\Controller\\JsonLibraryController::showABookByIsbn'], ['isbn'], null, null, false, true, null]],
        227 => [[['_route' => 'read_one', '_controller' => 'App\\Controller\\LibraryController::showBookByIsbn'], ['isbn'], null, null, false, true, null]],
        250 => [[['_route' => 'book_delete_by_isbn', '_controller' => 'App\\Controller\\LibraryController::deleteBookByIsbn'], ['isbn'], ['POST' => 0], null, false, true, null]],
        273 => [[['_route' => 'update_form', '_controller' => 'App\\Controller\\LibraryUpdateController::updateBookForm'], ['isbn'], null, null, false, true, null]],
        311 => [[['_route' => 'api-user', '_controller' => 'App\\Controller\\ProjectApiController2::apiUser'], ['email'], ['GET' => 0], null, false, true, null]],
        342 => [[['_route' => 'api-place-card', '_controller' => 'App\\Controller\\ProjectApiController4::apiPlaceCard'], ['row', 'col'], ['POST' => 0], null, false, true, null]],
        368 => [[['_route' => 'purchase', '_controller' => 'App\\Controller\\ProjectCoinsController::projPurchase'], ['coins'], ['POST' => 0], null, false, true, null]],
        391 => [[['_route' => 'pick-card', '_controller' => 'App\\Controller\\ProjectMoveCardController::pickCard'], ['balance'], null, null, false, true, null]],
        425 => [[['_route' => 'set-fromslot', '_controller' => 'App\\Controller\\ProjectMoveCardController::setFromSlot'], ['row', 'col'], ['POST' => 0], null, false, true, null]],
        455 => [[['_route' => 'move-card', '_controller' => 'App\\Controller\\ProjectMoveCardController::moveCard'], ['row', 'col'], ['POST' => 0], null, false, true, null]],
        485 => [
            [['_route' => 'proj-round', '_controller' => 'App\\Controller\\ProjectOneRoundController::projRound'], ['row', 'col'], ['POST' => 0], null, false, true, null],
            [null, null, null, null, false, false, 0],
        ],
    ],
    null, // $checkCondition
];

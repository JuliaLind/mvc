<?php

// This file has been auto-generated by the Symfony Routing Component.

return [
    '_preview_error' => [['code', '_format'], ['_controller' => 'error_controller::preview', '_format' => 'html'], ['code' => '\\d+'], [['variable', '.', '[^/]++', '_format', true], ['variable', '/', '\\d+', 'code', true], ['text', '/_error']], [], [], []],
    '_wdt' => [['token'], ['_controller' => 'web_profiler.controller.profiler::toolbarAction'], [], [['variable', '/', '[^/]++', 'token', true], ['text', '/_wdt']], [], [], []],
    '_profiler_home' => [[], ['_controller' => 'web_profiler.controller.profiler::homeAction'], [], [['text', '/_profiler/']], [], [], []],
    '_profiler_search' => [[], ['_controller' => 'web_profiler.controller.profiler::searchAction'], [], [['text', '/_profiler/search']], [], [], []],
    '_profiler_search_bar' => [[], ['_controller' => 'web_profiler.controller.profiler::searchBarAction'], [], [['text', '/_profiler/search_bar']], [], [], []],
    '_profiler_phpinfo' => [[], ['_controller' => 'web_profiler.controller.profiler::phpinfoAction'], [], [['text', '/_profiler/phpinfo']], [], [], []],
    '_profiler_xdebug' => [[], ['_controller' => 'web_profiler.controller.profiler::xdebugAction'], [], [['text', '/_profiler/xdebug']], [], [], []],
    '_profiler_search_results' => [['token'], ['_controller' => 'web_profiler.controller.profiler::searchResultsAction'], [], [['text', '/search/results'], ['variable', '/', '[^/]++', 'token', true], ['text', '/_profiler']], [], [], []],
    '_profiler_open_file' => [[], ['_controller' => 'web_profiler.controller.profiler::openAction'], [], [['text', '/_profiler/open']], [], [], []],
    '_profiler' => [['token'], ['_controller' => 'web_profiler.controller.profiler::panelAction'], [], [['variable', '/', '[^/]++', 'token', true], ['text', '/_profiler']], [], [], []],
    '_profiler_router' => [['token'], ['_controller' => 'web_profiler.controller.router::panelAction'], [], [['text', '/router'], ['variable', '/', '[^/]++', 'token', true], ['text', '/_profiler']], [], [], []],
    '_profiler_exception' => [['token'], ['_controller' => 'web_profiler.controller.exception_panel::body'], [], [['text', '/exception'], ['variable', '/', '[^/]++', 'token', true], ['text', '/_profiler']], [], [], []],
    '_profiler_exception_css' => [['token'], ['_controller' => 'web_profiler.controller.exception_panel::stylesheet'], [], [['text', '/exception.css'], ['variable', '/', '[^/]++', 'token', true], ['text', '/_profiler']], [], [], []],
    'deck' => [[], ['_controller' => 'App\\Controller\\CardController::deck'], [], [['text', '/card/deck']], [], [], []],
    'shuffle' => [[], ['_controller' => 'App\\Controller\\CardController::shuffle'], [], [['text', '/card/deck/shuffle']], [], [], []],
    'card' => [[], ['_controller' => 'App\\Controller\\CardController::card'], [], [['text', '/card']], [], [], []],
    'draw' => [[], ['_controller' => 'App\\Controller\\CardController2::draw'], [], [['text', '/card/deck/draw']], [], [], []],
    'drawMany' => [['number'], ['_controller' => 'App\\Controller\\CardController2::drawMany'], ['number' => '\\d+'], [['variable', '/', '\\d+', 'number', true], ['text', '/card/deck/draw']], [], [], []],
    'deal' => [['players', 'cards'], ['_controller' => 'App\\Controller\\CardController2::deal'], ['players' => '\\d+', 'cards' => '\\d+'], [['variable', '/', '\\d+', 'cards', true], ['variable', '/', '\\d+', 'players', true], ['text', '/card/deck/deal']], [], [], []],
    'gameMain' => [[], ['_controller' => 'App\\Controller\\Game21Controller::main'], [], [['text', '/game']], [], [], []],
    'gameDoc' => [[], ['_controller' => 'App\\Controller\\Game21Controller::gameDoc'], [], [['text', '/game/doc']], [], [], []],
    'bankPlaying' => [[], ['_controller' => 'App\\Controller\\Game21Controller2::bankPlaying'], [], [['text', '/game/bank-playing']], [], [], []],
    'selectAmount' => [[], ['_controller' => 'App\\Controller\\Game21Controller3::selectAmount'], [], [['text', '/game/select-amount']], [], [], []],
    'init' => [['level'], ['level' => 0, '_controller' => 'App\\Controller\\Game21Controller4::init'], ['level' => '\\d+'], [['variable', '/', '\\d+', 'level', true], ['text', '/game/init']], [], [], []],
    'bet' => [['amount'], ['_controller' => 'App\\Controller\\Game21Controller5::bet'], ['amount' => '\\d+'], [['variable', '/', '\\d+', 'amount', true], ['text', '/game/bet']], [], [], []],
    'play' => [[], ['_controller' => 'App\\Controller\\Game21Controller6::play'], [], [['text', '/game/play']], [], [], []],
    'playerDraw' => [[], ['_controller' => 'App\\Controller\\Game21Controller7::playerDraw'], [], [['text', '/game/draw']], [], [], []],
    'jsonDeal' => [['players', 'cards'], ['_controller' => 'App\\Controller\\JsonCardController::jsonDeal'], ['players' => '\\d+', 'cards' => '\\d+'], [['variable', '/', '\\d+', 'cards', true], ['variable', '/', '\\d+', 'players', true], ['text', '/api/deck/deal']], [], [], []],
    'jsonDeck' => [[], ['_controller' => 'App\\Controller\\JsonCardController2::jsonDeck'], [], [['text', '/api/deck']], [], [], []],
    'jsonDrawMany' => [['number'], ['_controller' => 'App\\Controller\\JsonCardController3::jsonDrawMany'], ['number' => '\\d+'], [['variable', '/', '\\d+', 'number', true], ['text', '/api/deck/draw']], [], [], []],
    'jsonDraw' => [[], ['_controller' => 'App\\Controller\\JsonCardController4::jsonDraw'], [], [['text', '/api/deck/draw']], [], [], []],
    'jsonShuffle' => [[], ['_controller' => 'App\\Controller\\JsonCardController5::jsonShuffle'], [], [['text', '/api/deck/shuffle']], [], [], []],
    'api' => [[], ['_controller' => 'App\\Controller\\JsonController::apis'], [], [['text', '/api']], [], [], []],
    'quote' => [[], ['_controller' => 'App\\Controller\\JsonController2::jsonQuote'], [], [['text', '/api/quote']], [], [], []],
    'jsonGame' => [[], ['_controller' => 'App\\Controller\\JsonGame21Controller::jsonGame'], [], [['text', '/api/game']], [], [], []],
    'books_json' => [[], ['_controller' => 'App\\Controller\\JsonLibraryController::showAllBooks'], [], [['text', '/api/library/books']], [], [], []],
    'single_book_json' => [['isbn'], ['_controller' => 'App\\Controller\\JsonLibraryController::showABookByIsbn'], [], [['variable', '/', '[^/]++', 'isbn', true], ['text', '/api/library/book']], [], [], []],
    'read_one' => [['isbn'], ['_controller' => 'App\\Controller\\LibraryController::showBookByIsbn'], [], [['variable', '/', '[^/]++', 'isbn', true], ['text', '/library/read_one']], [], [], []],
    'book_delete_by_isbn' => [['isbn'], ['_controller' => 'App\\Controller\\LibraryController::deleteBookByIsbn'], [], [['variable', '/', '[^/]++', 'isbn', true], ['text', '/library/delete']], [], [], []],
    'read_many' => [[], ['_controller' => 'App\\Controller\\LibraryController::showAllBooks'], [], [['text', '/library/read_many']], [], [], []],
    'book_create' => [[], ['_controller' => 'App\\Controller\\LibraryCreateNewController::createBook'], [], [['text', '/library/create_new']], [], [], []],
    'create_form' => [[], ['_controller' => 'App\\Controller\\LibraryCreateNewController2::createBookForm'], [], [['text', '/library/create']], [], [], []],
    'library' => [[], ['_controller' => 'App\\Controller\\LibraryLandingController::index'], [], [['text', '/library']], [], [], []],
    'reset_library' => [[], ['_controller' => 'App\\Controller\\LibraryResetController::resetBook'], [], [['text', '/library/reset']], [], [], []],
    'update_form' => [['isbn'], ['_controller' => 'App\\Controller\\LibraryUpdateController::updateBookForm'], [], [['variable', '/', '[^/]++', 'isbn', true], ['text', '/library/update']], [], [], []],
    'book_update' => [[], ['_controller' => 'App\\Controller\\LibraryUpdateController2::updateBook'], [], [['text', '/library/update_one']], [], [], []],
    'home' => [[], ['_controller' => 'App\\Controller\\MainController::home'], [], [['text', '/']], [], [], []],
    'about' => [[], ['_controller' => 'App\\Controller\\MainController::about'], [], [['text', '/about']], [], [], []],
    'report' => [[], ['_controller' => 'App\\Controller\\MainController::report'], [], [['text', '/report']], [], [], []],
    'lucky' => [[], ['_controller' => 'App\\Controller\\MainController::number'], [], [['text', '/lucky']], [], [], []],
    'metrics' => [[], ['_controller' => 'App\\Controller\\MainController::metrics'], [], [['text', '/metrics']], [], [], []],
    'api-bot-plays' => [[], ['_controller' => 'App\\Controller\\ProjectApiController1::apiOneRound'], [], [['text', '/proj/api/bot-plays']], [], [], []],
    'api-user' => [['email'], ['_controller' => 'App\\Controller\\ProjectApiController2::apiUser'], [], [['variable', '/', '[^/]++', 'email', true], ['text', '/proj/api/user']], [], [], []],
    'api-transactions' => [[], ['_controller' => 'App\\Controller\\ProjectApiController3::apiTransactions'], [], [['text', '/proj/api/transactions']], [], [], []],
    'api-place-card' => [['row', 'col'], ['_controller' => 'App\\Controller\\ProjectApiController4::apiPlaceCard'], ['row' => '\\d+', 'col' => '\\d+'], [['variable', '/', '\\d+', 'col', true], ['variable', '/', '\\d+', 'row', true], ['text', '/proj/api/place-card']], [], [], []],
    'api-game-state' => [[], ['_controller' => 'App\\Controller\\ProjectApiController5::apiGameState'], [], [['text', '/proj/api/game-state']], [], [], []],
    'api-users' => [[], ['_controller' => 'App\\Controller\\ProjectApiController6::apiUsers'], [], [['text', '/proj/api/users']], [], [], []],
    'api-leaderboard' => [[], ['_controller' => 'App\\Controller\\ProjectApiController7::apiLeaderboard'], [], [['text', '/proj/api/leaderboard']], [], [], []],
    'api-results' => [[], ['_controller' => 'App\\Controller\\ProjectApiController8::apiResults'], [], [['text', '/proj/api/results']], [], [], []],
    'register' => [[], ['_controller' => 'App\\Controller\\ProjectAuthController::projRegister'], [], [['text', '/proj/register']], [], [], []],
    'login' => [[], ['_controller' => 'App\\Controller\\ProjectAuthController::projLogin'], [], [['text', '/proj/login']], [], [], []],
    'logout' => [[], ['_controller' => 'App\\Controller\\ProjectAuthController::projLogout'], [], [['text', '/proj/logout']], [], [], []],
    'purchase' => [['coins'], ['_controller' => 'App\\Controller\\ProjectCoinsController::projPurchase'], ['coins' => '\\d+'], [['variable', '/', '\\d+', 'coins', true], ['text', '/proj/purchase']], [], [], []],
    'select-amount' => [[], ['_controller' => 'App\\Controller\\ProjectCoinsController::selectAmount'], [], [['text', '/proj/select-amount']], [], [], []],
    'proj-api' => [[], ['_controller' => 'App\\Controller\\ProjectController::projApiLanding'], [], [['text', '/proj/api']], [], [], []],
    'proj-about' => [[], ['_controller' => 'App\\Controller\\ProjectController::projAbout'], [], [['text', '/proj/about']], [], [], []],
    'proj-db' => [[], ['_controller' => 'App\\Controller\\ProjectController::projDb'], [], [['text', '/proj/about/database']], [], [], []],
    'proj-rules' => [[], ['_controller' => 'App\\Controller\\ProjectController::projRules'], [], [['text', '/proj/rules']], [], [], []],
    'register-form' => [[], ['_controller' => 'App\\Controller\\ProjectController::projRegisterForm'], [], [['text', '/proj/register-form']], [], [], []],
    'proj-init' => [[], ['_controller' => 'App\\Controller\\ProjectInitController::projInit'], [], [['text', '/proj/init']], [], [], []],
    'proj' => [[], ['_controller' => 'App\\Controller\\ProjectLandingController::projLanding'], [], [['text', '/proj']], [], [], []],
    'set-fromslot' => [['row', 'col'], ['_controller' => 'App\\Controller\\ProjectMoveCardController::setFromSlot'], ['row' => '\\d+', 'col' => '\\d+'], [['variable', '/', '\\d+', 'col', true], ['variable', '/', '\\d+', 'row', true], ['text', '/proj/set-fromslot']], [], [], []],
    'move-card' => [['row', 'col'], ['_controller' => 'App\\Controller\\ProjectMoveCardController::moveCard'], ['row' => '\\d+', 'col' => '\\d+'], [['variable', '/', '\\d+', 'col', true], ['variable', '/', '\\d+', 'row', true], ['text', '/proj/move-card']], [], [], []],
    'pick-card' => [['balance'], ['_controller' => 'App\\Controller\\ProjectMoveCardController::pickCard'], ['balance' => '\\d+'], [['variable', '/', '\\d+', 'balance', true], ['text', '/proj/pick-card']], [], [], []],
    'proj-round' => [['row', 'col'], ['_controller' => 'App\\Controller\\ProjectOneRoundController::projRound'], ['row' => '\\d+', 'col' => '\\d+'], [['variable', '/', '\\d+', 'col', true], ['variable', '/', '\\d+', 'row', true], ['text', '/proj/one-round']], [], [], []],
    'purchase-peek' => [[], ['_controller' => 'App\\Controller\\ProjectPeekController::purchasePeekCheat'], [], [['text', '/proj/purchase-peek-cheat']], [], [], []],
    'deck-peek' => [[], ['_controller' => 'App\\Controller\\ProjectPeekController::deckPeek'], [], [['text', '/proj/deck-peek']], [], [], []],
    'proj-play' => [[], ['_controller' => 'App\\Controller\\ProjectPlayController::projPlay'], [], [['text', '/proj/play']], [], [], []],
    'reset_project' => [[], ['_controller' => 'App\\Controller\\ProjectResetController::resetProj'], [], [['text', '/proj/reset']], [], [], []],
    'proj-scores-single' => [[], ['_controller' => 'App\\Controller\\ProjectScoresController::projScoresSingle'], [], [['text', '/proj/scores-single']], [], [], []],
    'proj-leaderboard' => [[], ['_controller' => 'App\\Controller\\ProjectScoresController::projLeaderboard'], [], [['text', '/proj/leaderboard']], [], [], []],
    'shop' => [[], ['_controller' => 'App\\Controller\\ProjectShopController::projShop'], [], [['text', '/proj/shop']], [], [], []],
    'proj-trans' => [[], ['_controller' => 'App\\Controller\\ProjectShopController::projTrans'], [], [['text', '/proj/transactions']], [], [], []],
    'purchase-suggestion' => [[], ['_controller' => 'App\\Controller\\ProjectSuggestionController::projPurchaseSuggest'], [], [['text', '/proj/purchase-suggestion']], [], [], []],
    'show-suggestion' => [[], ['_controller' => 'App\\Controller\\ProjectSuggestionController::projShowSuggest'], [], [['text', '/proj/show-suggestion']], [], [], []],
    'undo' => [[], ['_controller' => 'App\\Controller\\ProjectUndoController::undo'], [], [['text', '/proj/undo']], [], [], []],
];

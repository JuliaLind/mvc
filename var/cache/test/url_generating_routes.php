<?php

// This file has been auto-generated by the Symfony Routing Component.

return [
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
    'book_create' => [[], ['_controller' => 'App\\Controller\\LibraryController::createBook'], [], [['text', '/library/create_new']], [], [], []],
    'update_form' => [['isbn'], ['_controller' => 'App\\Controller\\LibraryController2::updateBookForm'], [], [['variable', '/', '[^/]++', 'isbn', true], ['text', '/library/update']], [], [], []],
    'reset_library' => [[], ['_controller' => 'App\\Controller\\LibraryController3::resetBook'], [], [['text', '/library/reset']], [], [], []],
    'book_update' => [[], ['_controller' => 'App\\Controller\\LibraryController4::updateBook'], [], [['text', '/library/update_one']], [], [], []],
    'read_one' => [['isbn'], ['_controller' => 'App\\Controller\\LibraryController5::showBookByIsbn'], [], [['variable', '/', '[^/]++', 'isbn', true], ['text', '/library/read_one']], [], [], []],
    'book_delete_by_isbn' => [['isbn'], ['_controller' => 'App\\Controller\\LibraryController5::deleteBookByIsbn'], [], [['variable', '/', '[^/]++', 'isbn', true], ['text', '/library/delete']], [], [], []],
    'read_many' => [[], ['_controller' => 'App\\Controller\\LibraryController5::showAllBooks'], [], [['text', '/library/read_many']], [], [], []],
    'library' => [[], ['_controller' => 'App\\Controller\\LibraryController6::index'], [], [['text', '/library']], [], [], []],
    'create_form' => [[], ['_controller' => 'App\\Controller\\LibraryController7::createBookForm'], [], [['text', '/library/create']], [], [], []],
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
    'proj' => [[], ['_controller' => 'App\\Controller\\ProjectController1::projLanding'], [], [['text', '/proj']], [], [], []],
    'shop' => [[], ['_controller' => 'App\\Controller\\ProjectController1::projShop'], [], [['text', '/proj/shop']], [], [], []],
    'proj-trans' => [[], ['_controller' => 'App\\Controller\\ProjectController1::projTrans'], [], [['text', '/proj/transactions']], [], [], []],
    'proj-round' => [['row', 'col'], ['_controller' => 'App\\Controller\\ProjectController3::projRound'], ['row' => '\\d+', 'col' => '\\d+'], [['variable', '/', '\\d+', 'col', true], ['variable', '/', '\\d+', 'row', true], ['text', '/proj/one-round']], [], [], []],
    'proj-unset-suggest' => [[], ['_controller' => 'App\\Controller\\ProjectController3::projUnsetSuggest'], [], [['text', '/proj/unset-suggestion']], [], [], []],
    'set-fromslot' => [['row', 'col'], ['_controller' => 'App\\Controller\\ProjectController4::setFromSlot'], ['row' => '\\d+', 'col' => '\\d+'], [['variable', '/', '\\d+', 'col', true], ['variable', '/', '\\d+', 'row', true], ['text', '/proj/set-fromslot']], [], [], []],
    'move-card' => [['row', 'col'], ['_controller' => 'App\\Controller\\ProjectController4::moveCard'], ['row' => '\\d+', 'col' => '\\d+'], [['variable', '/', '\\d+', 'col', true], ['variable', '/', '\\d+', 'row', true], ['text', '/proj/move-card']], [], [], []],
    'pick-card' => [['balance'], ['_controller' => 'App\\Controller\\ProjectController4::pickCard'], ['balance' => '\\d+'], [['variable', '/', '\\d+', 'balance', true], ['text', '/proj/pick-card']], [], [], []],
    'proj-api' => [[], ['_controller' => 'App\\Controller\\ProjectController5::projApiLanding'], [], [['text', '/proj/api']], [], [], []],
    'proj-about' => [[], ['_controller' => 'App\\Controller\\ProjectController5::projAbout'], [], [['text', '/proj/about']], [], [], []],
    'proj-rules' => [[], ['_controller' => 'App\\Controller\\ProjectController5::projRules'], [], [['text', '/proj/rules']], [], [], []],
    'register-form' => [[], ['_controller' => 'App\\Controller\\ProjectController5::projRegisterForm'], [], [['text', '/proj/register-form']], [], [], []],
    'purchase' => [['coins'], ['_controller' => 'App\\Controller\\ProjectController6::projPurchase'], ['coins' => '\\d+'], [['variable', '/', '\\d+', 'coins', true], ['text', '/proj/purchase']], [], [], []],
    'select-amount' => [[], ['_controller' => 'App\\Controller\\ProjectController6::selectAmount'], [], [['text', '/proj/select-amount']], [], [], []],
    'undo' => [[], ['_controller' => 'App\\Controller\\ProjectController7::undo'], [], [['text', '/proj/undo']], [], [], []],
    'purchase-suggestion' => [[], ['_controller' => 'App\\Controller\\ProjectController7::showSuggestion'], [], [['text', '/proj/purchase-suggestion']], [], [], []],
    'deck-peek' => [[], ['_controller' => 'App\\Controller\\ProjectController7::deckPeek'], [], [['text', '/proj/deck-peek']], [], [], []],
    'purchase-peek' => [[], ['_controller' => 'App\\Controller\\ProjectController7::purchasePeekCheat'], [], [['text', '/proj/purchase-peek-cheat']], [], [], []],
    'proj-scores-single' => [[], ['_controller' => 'App\\Controller\\ProjectController8::projScoresSingle'], [], [['text', '/proj/scores-single']], [], [], []],
    'proj-leaderboard' => [[], ['_controller' => 'App\\Controller\\ProjectController8::projLeaderboard'], [], [['text', '/proj/leaderboard']], [], [], []],
    'proj-init' => [[], ['_controller' => 'App\\Controller\\ProjectController9::projInit'], [], [['text', '/proj/init']], [], [], []],
    'proj-play' => [[], ['_controller' => 'App\\Controller\\ProjectController9::projPlay'], [], [['text', '/proj/play']], [], [], []],
];

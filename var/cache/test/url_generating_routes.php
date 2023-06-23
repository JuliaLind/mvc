<?php

// This file has been auto-generated by the Symfony Routing Component.

return [
    'deck' => [[], ['_controller' => 'App\\Controller\\CardController::deck'], [], [['text', '/card/deck']], [], [], []],
    'shuffle' => [[], ['_controller' => 'App\\Controller\\CardController::shuffle'], [], [['text', '/card/deck/shuffle']], [], [], []],
    'draw' => [[], ['_controller' => 'App\\Controller\\CardController::draw'], [], [['text', '/card/deck/draw']], [], [], []],
    'drawMany' => [['number'], ['_controller' => 'App\\Controller\\CardController::drawMany'], ['number' => '\\d+'], [['variable', '/', '\\d+', 'number', true], ['text', '/card/deck/draw']], [], [], []],
    'deal' => [['players', 'cards'], ['_controller' => 'App\\Controller\\CardController::deal'], ['players' => '\\d+', 'cards' => '\\d+'], [['variable', '/', '\\d+', 'cards', true], ['variable', '/', '\\d+', 'players', true], ['text', '/card/deck/deal']], [], [], []],
    'card' => [[], ['_controller' => 'App\\Controller\\CardController::card'], [], [['text', '/card']], [], [], []],
    'gameMain' => [[], ['_controller' => 'App\\Controller\\Game21Controller::main'], [], [['text', '/game']], [], [], []],
    'gameDoc' => [[], ['_controller' => 'App\\Controller\\Game21Controller::gameDoc'], [], [['text', '/game/doc']], [], [], []],
    'init' => [['level'], ['level' => 0, '_controller' => 'App\\Controller\\Game21Controller::init'], ['level' => '\\d+'], [['variable', '/', '\\d+', 'level', true], ['text', '/game/init']], [], [], []],
    'selectAmount' => [[], ['_controller' => 'App\\Controller\\Game21Controller::selectAmount'], [], [['text', '/game/select-amount']], [], [], []],
    'bet' => [['amount'], ['_controller' => 'App\\Controller\\Game21Controller::bet'], ['amount' => '\\d+'], [['variable', '/', '\\d+', 'amount', true], ['text', '/game/bet']], [], [], []],
    'playerDraw' => [[], ['_controller' => 'App\\Controller\\Game21Controller::playerDraw'], [], [['text', '/game/draw']], [], [], []],
    'bankPlaying' => [[], ['_controller' => 'App\\Controller\\Game21Controller::bankPlaying'], [], [['text', '/game/bank-playing']], [], [], []],
    'play' => [[], ['_controller' => 'App\\Controller\\Game21Controller::play'], [], [['text', '/game/play']], [], [], []],
    'jsonDeal' => [['players', 'cards'], ['_controller' => 'App\\Controller\\JsonCardController::jsonDeal'], ['players' => '\\d+', 'cards' => '\\d+'], [['variable', '/', '\\d+', 'cards', true], ['variable', '/', '\\d+', 'players', true], ['text', '/api/deck/deal']], [], [], []],
    'jsonDeck' => [[], ['_controller' => 'App\\Controller\\JsonCardController2::jsonDeck'], [], [['text', '/api/deck']], [], [], []],
    'jsonShuffle' => [[], ['_controller' => 'App\\Controller\\JsonCardController2::jsonShuffle'], [], [['text', '/api/deck/shuffle']], [], [], []],
    'jsonDrawMany' => [['number'], ['_controller' => 'App\\Controller\\JsonCardController3::jsonDrawMany'], ['number' => '\\d+'], [['variable', '/', '\\d+', 'number', true], ['text', '/api/deck/draw']], [], [], []],
    'jsonDraw' => [[], ['_controller' => 'App\\Controller\\JsonCardController4::jsonDraw'], [], [['text', '/api/deck/draw']], [], [], []],
    'api' => [[], ['_controller' => 'App\\Controller\\JsonController::apis'], [], [['text', '/api']], [], [], []],
    'quote' => [[], ['_controller' => 'App\\Controller\\JsonController::jsonQuote'], [], [['text', '/api/quote']], [], [], []],
    'jsonGame' => [[], ['_controller' => 'App\\Controller\\JsonGame21Controller::jsonGame'], [], [['text', '/api/game']], [], [], []],
    'books_json' => [[], ['_controller' => 'App\\Controller\\JsonLibraryController::showAllBooks'], [], [['text', '/api/library/books']], [], [], []],
    'single_book_json' => [['isbn'], ['_controller' => 'App\\Controller\\JsonLibraryController::showABookByIsbn'], [], [['variable', '/', '[^/]++', 'isbn', true], ['text', '/api/library/book']], [], [], []],
    'library' => [[], ['_controller' => 'App\\Controller\\LibraryController::index'], [], [['text', '/library']], [], [], []],
    'create_form' => [[], ['_controller' => 'App\\Controller\\LibraryController::createBookForm'], [], [['text', '/library/create']], [], [], []],
    'book_create' => [[], ['_controller' => 'App\\Controller\\LibraryController::createBook'], [], [['text', '/library/create_new']], [], [], []],
    'read_one' => [['isbn'], ['_controller' => 'App\\Controller\\LibraryController::showBookByIsbn'], [], [['variable', '/', '[^/]++', 'isbn', true], ['text', '/library/read_one']], [], [], []],
    'read_many' => [[], ['_controller' => 'App\\Controller\\LibraryController::showAllBooks'], [], [['text', '/library/read_many']], [], [], []],
    'book_delete_by_isbn' => [['isbn'], ['_controller' => 'App\\Controller\\LibraryController::deleteBookByIsbn'], [], [['variable', '/', '[^/]++', 'isbn', true], ['text', '/library/delete']], [], [], []],
    'reset_library' => [[], ['_controller' => 'App\\Controller\\LibraryController::resetBook'], [], [['text', '/library/reset']], [], [], []],
    'update_form' => [['isbn'], ['_controller' => 'App\\Controller\\LibraryController2::updateBookForm'], [], [['variable', '/', '[^/]++', 'isbn', true], ['text', '/library/update']], [], [], []],
    'book_update' => [[], ['_controller' => 'App\\Controller\\LibraryController2::updateBook'], [], [['text', '/library/update_one']], [], [], []],
    'home' => [[], ['_controller' => 'App\\Controller\\MainController::home'], [], [['text', '/']], [], [], []],
    'about' => [[], ['_controller' => 'App\\Controller\\MainController::about'], [], [['text', '/about']], [], [], []],
    'report' => [[], ['_controller' => 'App\\Controller\\MainController::report'], [], [['text', '/report']], [], [], []],
    'lucky' => [[], ['_controller' => 'App\\Controller\\MainController::number'], [], [['text', '/lucky']], [], [], []],
    'metrics' => [[], ['_controller' => 'App\\Controller\\MainController::metrics'], [], [['text', '/metrics']], [], [], []],
    'api-bot-plays' => [[], ['_controller' => 'App\\Controller\\ProjectApiController1::apiOneRound'], [], [['text', '/proj/api/bot-plays']], [], [], []],
    'api-place-card' => [['row', 'col'], ['_controller' => 'App\\Controller\\ProjectApiController1::apiPlaceCard'], ['row' => '\\d+', 'col' => '\\d+'], [['variable', '/', '\\d+', 'col', true], ['variable', '/', '\\d+', 'row', true], ['text', '/proj/api/place-card']], [], [], []],
    'api-results' => [[], ['_controller' => 'App\\Controller\\ProjectApiController1::apiResults'], [], [['text', '/proj/api/results']], [], [], []],
    'api-game-state' => [[], ['_controller' => 'App\\Controller\\ProjectApiController1::apiGameState'], [], [['text', '/proj/api/game-state']], [], [], []],
    'api-user' => [['email'], ['_controller' => 'App\\Controller\\ProjectApiController2::apiUser'], [], [['variable', '/', '[^/]++', 'email', true], ['text', '/proj/api/user']], [], [], []],
    'api-users' => [[], ['_controller' => 'App\\Controller\\ProjectApiController2::apiUsers'], [], [['text', '/proj/api/users']], [], [], []],
    'api-transactions' => [[], ['_controller' => 'App\\Controller\\ProjectApiController3::apiTransactions'], [], [['text', '/proj/api/transactions']], [], [], []],
    'api-leaderboard' => [[], ['_controller' => 'App\\Controller\\ProjectApiController3::apiLeaderboard'], [], [['text', '/proj/api/leaderboard']], [], [], []],
    'proj' => [[], ['_controller' => 'App\\Controller\\ProjectController1::projLanding'], [], [['text', '/proj']], [], [], []],
    'shop' => [[], ['_controller' => 'App\\Controller\\ProjectController1::projShop'], [], [['text', '/proj/shop']], [], [], []],
    'proj-trans' => [[], ['_controller' => 'App\\Controller\\ProjectController1::projTrans'], [], [['text', '/proj/transactions']], [], [], []],
    'register' => [[], ['_controller' => 'App\\Controller\\ProjectController2::projRegister'], [], [['text', '/proj/register']], [], [], []],
    'login' => [[], ['_controller' => 'App\\Controller\\ProjectController2::projLogin'], [], [['text', '/proj/login']], [], [], []],
    'logout' => [[], ['_controller' => 'App\\Controller\\ProjectController2::projLogout'], [], [['text', '/proj/logout']], [], [], []],
    'proj-init' => [[], ['_controller' => 'App\\Controller\\ProjectController3::projInit'], [], [['text', '/proj/init']], [], [], []],
    'proj-round' => [['row', 'col'], ['_controller' => 'App\\Controller\\ProjectController3::projRound'], ['row' => '\\d+', 'col' => '\\d+'], [['variable', '/', '\\d+', 'col', true], ['variable', '/', '\\d+', 'row', true], ['text', '/proj/one-round']], [], [], []],
    'proj-play' => [[], ['_controller' => 'App\\Controller\\ProjectController3::projPlay'], [], [['text', '/proj/play']], [], [], []],
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
    'show-suggestion' => [[], ['_controller' => 'App\\Controller\\ProjectController7::showSuggestion'], [], [['text', '/proj/show-suggestion']], [], [], []],
    'deck-peek' => [[], ['_controller' => 'App\\Controller\\ProjectController7::deckPeek'], [], [['text', '/proj/deck-peek']], [], [], []],
    'purchase-peek' => [[], ['_controller' => 'App\\Controller\\ProjectController7::purchasePeekCheat'], [], [['text', '/proj/purchase-peek-cheat']], [], [], []],
    'proj-scores-single' => [[], ['_controller' => 'App\\Controller\\ProjectController8::projScoresSingle'], [], [['text', '/proj/scores-single']], [], [], []],
    'proj-leaderboard' => [[], ['_controller' => 'App\\Controller\\ProjectController8::projLeaderboard'], [], [['text', '/proj/leaderboard']], [], [], []],
];

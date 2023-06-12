<?php

// This file has been auto-generated by the Symfony Routing Component.

return [
    'deck' => [[], ['_controller' => 'App\\Controller\\CardController::deck'], [], [['text', '/card/deck']], [], [], []],
    'shuffle' => [[], ['_controller' => 'App\\Controller\\CardController::shuffle'], [], [['text', '/card/deck/shuffle']], [], [], []],
    'draw' => [[], ['_controller' => 'App\\Controller\\CardController::draw'], [], [['text', '/card/deck/draw']], [], [], []],
    'drawMany' => [['number'], ['_controller' => 'App\\Controller\\CardController::drawMany'], ['number' => '\\d+'], [['variable', '/', '\\d+', 'number', true], ['text', '/card/deck/draw']], [], [], []],
    'deal' => [['players', 'cards'], ['_controller' => 'App\\Controller\\CardController::deal'], ['players' => '\\d+', 'cards' => '\\d+'], [['variable', '/', '\\d+', 'cards', true], ['variable', '/', '\\d+', 'players', true], ['text', '/card/deck/deal']], [], [], []],
    'card' => [[], ['_controller' => 'App\\Controller\\CardLandingController::card'], [], [['text', '/card']], [], [], []],
    'gameMain' => [[], ['_controller' => 'App\\Controller\\Game21Controller::main'], [], [['text', '/game']], [], [], []],
    'gameDoc' => [[], ['_controller' => 'App\\Controller\\Game21Controller::gameDoc'], [], [['text', '/game/doc']], [], [], []],
    'init' => [['level'], ['level' => 0, '_controller' => 'App\\Controller\\Game21Controller::init'], ['level' => '\\d+'], [['variable', '/', '\\d+', 'level', true], ['text', '/game/init']], [], [], []],
    'selectAmount' => [[], ['_controller' => 'App\\Controller\\Game21Controller::selectAmount'], [], [['text', '/game/select-amount']], [], [], []],
    'bet' => [['amount'], ['_controller' => 'App\\Controller\\Game21Controller::bet'], ['amount' => '\\d+'], [['variable', '/', '\\d+', 'amount', true], ['text', '/game/bet']], [], [], []],
    'playerDraw' => [[], ['_controller' => 'App\\Controller\\Game21Controller::playerDraw'], [], [['text', '/game/draw']], [], [], []],
    'bankPlaying' => [[], ['_controller' => 'App\\Controller\\Game21Controller::bankPlaying'], [], [['text', '/game/bank-playing']], [], [], []],
    'play' => [[], ['_controller' => 'App\\Controller\\Game21Controller::play'], [], [['text', '/game/play']], [], [], []],
    'jsonDeal' => [['players', 'cards'], ['_controller' => 'App\\Controller\\JsonCardDealController::jsonDeal'], ['players' => '\\d+', 'cards' => '\\d+'], [['variable', '/', '\\d+', 'cards', true], ['variable', '/', '\\d+', 'players', true], ['text', '/api/deck/deal']], [], [], []],
    'jsonDeck' => [[], ['_controller' => 'App\\Controller\\JsonCardDeckController::jsonDeck'], [], [['text', '/api/deck']], [], [], []],
    'jsonShuffle' => [[], ['_controller' => 'App\\Controller\\JsonCardDeckController::jsonShuffle'], [], [['text', '/api/deck/shuffle']], [], [], []],
    'api' => [[], ['_controller' => 'App\\Controller\\JsonController::apis'], [], [['text', '/api']], [], [], []],
    'quote' => [[], ['_controller' => 'App\\Controller\\JsonController::jsonQuote'], [], [['text', '/api/quote']], [], [], []],
    'jsonDrawMany' => [['number'], ['_controller' => 'App\\Controller\\JsonDealManyCardsController::jsonDrawMany'], ['number' => '\\d+'], [['variable', '/', '\\d+', 'number', true], ['text', '/api/deck/draw']], [], [], []],
    'jsonDraw' => [[], ['_controller' => 'App\\Controller\\JsonDealOneCardController::jsonDraw'], [], [['text', '/api/deck/draw']], [], [], []],
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
    'update_form' => [['isbn'], ['_controller' => 'App\\Controller\\LibraryUpdateBookController::updateBookForm'], [], [['variable', '/', '[^/]++', 'isbn', true], ['text', '/library/update']], [], [], []],
    'book_update' => [[], ['_controller' => 'App\\Controller\\LibraryUpdateBookController::updateBook'], [], [['text', '/library/update_one']], [], [], []],
    'home' => [[], ['_controller' => 'App\\Controller\\MainController::home'], [], [['text', '/']], [], [], []],
    'about' => [[], ['_controller' => 'App\\Controller\\MainController::about'], [], [['text', '/about']], [], [], []],
    'report' => [[], ['_controller' => 'App\\Controller\\MainController::report'], [], [['text', '/report']], [], [], []],
    'lucky' => [[], ['_controller' => 'App\\Controller\\MainController::number'], [], [['text', '/lucky']], [], [], []],
    'metrics' => [[], ['_controller' => 'App\\Controller\\MainController::metrics'], [], [['text', '/metrics']], [], [], []],
    'api-one-round' => [[], ['_controller' => 'App\\Controller\\ProjectApiController::apiOneRound'], [], [['text', '/project/api/game']], [], [], []],
    'api-new' => [[], ['_controller' => 'App\\Controller\\ProjectApiController::apiNew'], [], [['text', '/project/api/new']], [], [], []],
    'api-results' => [[], ['_controller' => 'App\\Controller\\ProjectApiController::apiResults'], [], [['text', '/project/api/results']], [], [], []],
    'register' => [[], ['_controller' => 'App\\Controller\\ProjectAuthController::projRegister'], [], [['text', '/proj/register']], [], [], []],
    'login' => [[], ['_controller' => 'App\\Controller\\ProjectAuthController::projLogin'], [], [['text', '/proj/login']], [], [], []],
    'logout' => [[], ['_controller' => 'App\\Controller\\ProjectAuthController::projLogout'], [], [['text', '/proj/logout']], [], [], []],
    'register-form' => [[], ['_controller' => 'App\\Controller\\ProjectFormController::projRegisterForm'], [], [['text', '/proj/register-form']], [], [], []],
    'proj' => [[], ['_controller' => 'App\\Controller\\ProjectMainController::projLanding'], [], [['text', '/proj']], [], [], []],
    'proj-api' => [[], ['_controller' => 'App\\Controller\\ProjectMainController::projApiLanding'], [], [['text', '/proj/api']], [], [], []],
    'proj-about' => [[], ['_controller' => 'App\\Controller\\ProjectMainController::projAbout'], [], [['text', '/proj/about']], [], [], []],
];

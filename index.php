<?php

require_once 'Blackjack.php';
require_once 'Card.php';
require_once 'Dealer.php';
require_once 'Deck.php';
require_once 'Player.php';

$blackjack = new Blackjack();
$deck = new Deck();

$dealer = new Dealer($blackjack, $deck);
$dealer->addPlayer(new Player('Ischa'));
$dealer->addPlayer(new Player('Merel'));

$dealer->playGame();

?>

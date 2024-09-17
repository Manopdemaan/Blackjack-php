<?php
require_once 'Card.php';
require_once 'Deck.php';
require_once 'Player.php';
require_once 'Dealer.php';
require_once 'Blackjack.php';

$deck = new Deck();
$blackjack = new Blackjack();
$dealer = new Dealer($blackjack, $deck);

$dealer->addPlayer(new Player('Ischa'));
$dealer->addPlayer(new Player('Merel'));

$dealer->playGame();
?>

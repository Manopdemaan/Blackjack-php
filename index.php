<?php

require_once 'Card.php';
require_once 'Deck.php';
require_once 'Player.php';

try {
    $deck = new Deck();
    $player = new Player('PLayer1');

    for ($i = 0; $i < 3; $i++) {
        $player->addCard($deck->drawCard());
    }

    echo $player->showHand() . PHP_EOL;
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage() . PHP_EOL;
}
?>

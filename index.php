<?php

require_once 'Card.php';
require_once 'Deck.php';
require_once 'Player.php';
require_once 'Blackjack.php';

$deck = new Deck();
$blackjack = new Blackjack();
$player = new Player('Maaike', $blackjack);

$player->addCard($deck->drawCard());
$player->addCard($deck->drawCard());

echo $player->showHand() . PHP_EOL;
echo $player->getScore() . PHP_EOL;

while (true) {
    echo "Wil je nog een kaart? (ja/nee): ";
    $input = trim(fgets(STDIN));

    if (strtolower($input) === 'ja') {
        $player->addCard($deck->drawCard());
        echo $player->showHand() . PHP_EOL;
        $score = $player->getScore();
        echo $score . PHP_EOL;

        if ($score === "Busted" || $score === "Blackjack" || $score === "Twenty-One" || $score === "Five Card Charlie") {
            break;
        }
    } else {
        break;
    }
}

echo "Einde van het spel!" . PHP_EOL;
echo $player->showHand() . PHP_EOL;
echo $player->getScore() . PHP_EOL;

?>

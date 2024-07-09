<?php

require_once 'Card.php';

$kaarten = [
    new Kaart('Klaveren', 'Boer'),
    new Kaart('Ruiten', 'Boer'),
    new Kaart('Ruiten', '5')
];

foreach ($kaarten as $kaart) {
    echo $kaart->show() . PHP_EOL;
}
?>

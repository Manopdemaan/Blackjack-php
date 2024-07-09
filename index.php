<?php

require_once 'Card.php';

try {
    $kaarten = [
        new Card('Klaveren', 'Boer'),
        new Card('Ruiten', 'Boer'),
        new Card('Ruiten', '5'),
        new Card('Schoffels', '6')
    ];

    foreach ($kaarten as $kaart) {
        echo $kaart->show() . PHP_EOL;
    }
} catch (InvalidArgumentException $e) {
    echo 'Error: ' . $e->getMessage() . PHP_EOL;
}
?>

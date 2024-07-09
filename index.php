<?php

require_once 'Card.php';

try {
    $kaarten = [
        new Kaart('Klaveren', 'Boer'),
        new Kaart('Ruiten', 'Boer'),
        new Kaart('Ruiten', '5'),
        new Kaart('Schoffels', '6')
    ];

    foreach ($kaarten as $kaart) {
        echo $kaart->show() . PHP_EOL;
    }
} catch (InvalidArgumentException $e) {
    echo 'Error: ' . $e->getMessage() . PHP_EOL;
}
?>

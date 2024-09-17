<?php
class Deck {
    private $cards = [];

    public function __construct() {
        $suits = ['Hearts', 'Diamonds', 'Clubs', 'Spades'];
        $values = ['2', '3', '4', '5', '6', '7', '8', '9', '10', 'Jack', 'Queen', 'King', 'Ace'];

        foreach ($suits as $suit) {
            foreach ($values as $value) {
                $this->cards[] = new Card($suit, $value);
            }
        }

        shuffle($this->cards);
    }

    public function drawCard() {
        return array_shift($this->cards);
    }
}
?>

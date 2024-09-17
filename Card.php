<?php
class Card {
    private $suit;
    private $value;

    private static $suitSymbols = [
        'Hearts' => '♥',
        'Diamonds' => '♦',
        'Clubs' => '♣',
        'Spades' => '♠'
    ];

    public function __construct($suit, $value) {
        $this->suit = $suit;
        $this->value = $value;
    }

    public function getSuit() {
        return $this->suit;
    }

    public function getValue() {
        return $this->value;
    }

    public function __toString() {
        $valueDisplay = $this->value;
        switch ($valueDisplay) {
            case 'Jack':
                $valueDisplay = 'J';
                break;
            case 'Queen':
                $valueDisplay = 'Q';
                break;
            case 'King':
                $valueDisplay = 'K';
                break;
            case 'Ace':
                $valueDisplay = 'A';
                break;
        }
        return $valueDisplay . self::$suitSymbols[$this->suit];
    }
}
?>

<?php

class Player
{
    private string $name;
    private array $hand = [];

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function addCard(Card $card): void
    {
        $this->hand[] = $card;
    }

    public function showHand(): string
    {
        $cardsInHand = array_map(function (Card $card) {
            return $card->show();
        }, $this->hand);

        return $this->name . " heeft " . implode(" ", $cardsInHand);
    }
}
?>

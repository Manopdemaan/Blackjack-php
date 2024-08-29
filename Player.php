<?php

class Player
{
    private string $name;
    private array $hand = [];
    private Blackjack $blackjack;

    public function __construct(string $name, Blackjack $blackjack)
    {
        $this->name = $name;
        $this->blackjack = $blackjack;
    }

    public function addCard(Card $card): void
    {
        $this->hand[] = $card;
    }

    public function getScore(): string
    {
        return $this->blackjack->scoreHand($this->hand);
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

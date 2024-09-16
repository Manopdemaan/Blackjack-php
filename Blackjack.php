<?php

class Blackjack
{
    public function scoreHand(array $hand): string
    {
        $score = 0;
        $cardCount = count($hand);

        foreach ($hand as $card) {
            $score += $card->score();
        }

        if ($score > 21) {
            return "Busted";
        } elseif ($score === 21 && $cardCount === 2) {
            return "Blackjack";
        } elseif ($score === 21) {
            return "Twenty-One";
        } elseif ($cardCount === 5 && $score <= 21) {
            return "Five Card Charlie";
        }

        return (string)$score;
    }

    public function getScore(array $hand): int
    {
        $score = 0;
        foreach ($hand as $card) {
            $score += $card->score();
        }
        return $score;
    }
}

?>

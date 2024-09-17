<?php
class Blackjack {
    public function getScore($hand) {
        $score = 0;
        $aces = 0;

        foreach ($hand as $card) {
            $value = $card->getValue();
            if ($value == 'Jack' || $value == 'Queen' || $value == 'King') {
                $score += 10;
            } elseif ($value == 'Ace') {
                $aces++;
                $score += 11;
            } else {
                $score += (int) $value;
            }
        }

        while ($score > 21 && $aces > 0) {
            $score -= 10;
            $aces--;
        }

        return $score;
    }
}
?>

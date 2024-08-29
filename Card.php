<?php

class Card
{
    private string $suit;
    private string $value;

    public function __construct(string $suit, string $value)
    {
        $this->validateSuit($suit);
        $this->validateValue($value);
        $this->suit = $suit;
        $this->value = $value;
    }

    public function show(): string
    {
        $suitSymbols = [
            'Klaveren' => '♣',
            'Ruiten' => '♦',
            'Harten' => '♥',
            'Schoppen' => '♠'
        ];

        $valueSymbols = [
            'Boer' => 'B',
            'Vrouw' => 'V',
            'Heer' => 'H',
            'Aas' => 'A'
        ];

        $symbol = $suitSymbols[$this->suit] ?? '';
        $value = $valueSymbols[$this->value] ?? $this->value;

        return $symbol . $value;
    }

    public function score(): int
    {
        $valueSymbols = ['Boer' => 10, 'Vrouw' => 10, 'Heer' => 10, 'Aas' => 11];

        return $valueSymbols[$this->value] ?? (int)$this->value;
    }

    private function validateSuit(string $suit): void
    {
        $validSuits = ['Harten', 'Ruiten', 'Klaveren', 'Schoppen'];
        if (!in_array($suit, $validSuits)) {
            throw new InvalidArgumentException("Ongeldige kleur: $suit");
        }
    }

    private function validateValue(string $value): void
    {
        $validValues = ['2', '3', '4', '5', '6', '7', '8', '9', '10', 'Boer', 'Vrouw', 'Heer', 'Aas'];
        if (!in_array($value, $validValues)) {
            throw new InvalidArgumentException("Ongeldige waarde: $value");
        }
    }
}
?>

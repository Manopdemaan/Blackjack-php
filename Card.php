<?php

class Kaart
{
    private string $kleur;
    private string $waarde;

    public function __construct(string $kleur, string $waarde)
    {
        $this->validateSuit($kleur);
        $this->validateValue($waarde);
        $this->kleur = $kleur;
        $this->waarde = $waarde;
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

        $symbol = $suitSymbols[$this->kleur] ?? '';
        $value = $valueSymbols[$this->waarde] ?? $this->waarde;

        return $symbol . $value;
    }

    private function validateSuit(string $suit): void
    {
        $validSuits = ['Harten', 'Ruiten', 'Klaveren', 'Schoppen'];
        if (!in_array($suit, $validSuits)) {
            throw new InvalidArgumentException("invalid suit given: $suit");
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

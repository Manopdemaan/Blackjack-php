<?php

class Kaart
{
    public string $kleur;
    public string $waarde;

    public function __construct(string $kleur, string $waarde)
    {
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
}
?>

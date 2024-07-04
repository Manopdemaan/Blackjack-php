<?php

class Kaart {
    public string $kleur;
    public string $waarde;

    public function __construct (string $kleur, string $waarde)
    {
        $this->kleur = $kleur;
        $this->waarde = $waarde;
    }
}
?>

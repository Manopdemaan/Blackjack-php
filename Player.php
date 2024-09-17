<?php
class Player {
    private $hand = [];
    private $name;

    public function __construct($name) {
        $this->name = $name;
    }

    public function addCard($card) {
        $this->hand[] = $card;
    }

    public function getHand() {
        return $this->hand;
    }

    public function getName() {
        return $this->name;
    }

    public function clearHand() {
        $this->hand = [];
    }
}
?>

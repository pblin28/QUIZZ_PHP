<?php

abstract class Question {
    protected $uuid;
    protected $label;

    public function __construct($uuid, $label) {
        $this->uuid = $uuid;
        $this->label = $label;
    }

    public function getLabel() {
        return $this->label;
    }
    public function getUuid() {
        return $this->uuid;
    }

    abstract public function display();
}

?>

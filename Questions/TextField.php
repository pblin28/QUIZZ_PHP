<?php

require_once('Question.php');

class TextField extends Question {
    public function __construct($uuid, $label, $correctAnswer) {
        parent::__construct($uuid, $label);
        $this->correctAnswer = $correctAnswer;
    }
    public function display() {
        echo "<div class='question'>";
        echo "<h2>{$this->getLabel()}</h2>";
        echo "<input type='text' name='{$this->getUuid()}' placeholder='Votre réponse'>";
        echo "</div>";
    }
    public function getCorrectAnswer() {
        return $this->correctAnswer;
    }
}
?>

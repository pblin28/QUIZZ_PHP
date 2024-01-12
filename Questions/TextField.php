<?php

require_once('Question.php');

class TextField extends Question {
    public function display() {
        echo "<div class='question'>";
        echo "<h2>{$this->getLabel()}</h2>";
        echo "<input type='text' name='{$this->getLabel()}' placeholder='Votre réponse'>";
        echo "</div>";
    }
}

?>

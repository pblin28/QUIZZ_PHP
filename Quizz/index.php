<?php

require_once('../AutoLoad/auto-loader.php');
require_once('../Questions/RadioQuestions.php');
require_once('../Questions/TextField.php');

// Charger le fichier JSON
$jsonData = json_decode(file_get_contents('../Model/model.json'), true);

// Liste des questions
$questions = array();

foreach ($jsonData as $data) {
    if ($data['type'] === 'radio') {
        $questions[] = new RadioQuestions($data['uuid'], $data['label'], $data['choices'], $data['correct']);
    } elseif ($data['type'] === 'text') {
        $questions[] = new TextField($data['uuid'], $data['label']);
    }
}

// Affiche le formulaire
echo "<h1>Répondez aux questions</h1>";
echo '<form method="post" action="">';

foreach ($questions as $question) {
    $question->display();
}

// Bouton de validation
echo '<input type="submit" value="Valider">';
echo '</form>';

// Traite la réponse...
?>

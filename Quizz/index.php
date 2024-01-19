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
        $questions[] = new TextField($data['uuid'], $data['label'],$data['correct']);
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
$cpt=0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Traite les réponses ici
    foreach ($questions as $question) {
        $uuid = $question->getUuid();
        if ($question->getCorrectAnswer() == $_POST[$uuid]){
            $cpt+=1;
        }


    }
    echo '<p> vous avez ';
    echo $cpt; 
    echo ' Réponses correctes</p>';
}
// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     // Traite les réponses ici
//     var_dump($_POST);
//     foreach ($questions as $question) {
//         $uuid = $question->getUuid();
//         if ($question instanceof RadioQuestions) {
//             // Pour les questions de type radio
//             $answer = isset($_POST[$uuid]) ? $_POST[$uuid] : null;
//             // Traitez la réponse (enregistrez-la dans la base de données, par exemple)
//             // ...
//         } elseif ($question instanceof TextField) {
//             // Pour les questions de type texte
//             $answer = isset($_POST[$uuid]) ? $_POST[$uuid] : null;
//         }
//         var_dump($answer);
//     }
// }
// Traite la réponse...
?>

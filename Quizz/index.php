<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Votre Titre</title>
    <link rel="stylesheet" type="text/css" href="../Static/style.css">
</head>
<body>

<nav>
    <h1>Quizz</h1>
</nav>

<?php

require_once('../AutoLoad/auto-loader.php');
require_once('../Questions/RadioQuestions.php');
require_once('../Questions/TextField.php');
require_once('../Static/style.css');

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

//Aficher le formulaire
echo '<form method="post" action="">';

foreach ($questions as $question) {
    $question->display();
}


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
<input type="submit" value="Valider">
<p>Vous avez <?php echo $cpt; ?> réponses correctes</p>
</body>
</html>

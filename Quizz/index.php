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

// Traite la réponse
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $score = 0;
    $correctQuestions = array(); // Tableau pour stocker les questions correctes

    foreach ($questions as $question) {
        $reponse_utilisateur = isset($_POST[$question->getLabel()]) ? $_POST[$question->getLabel()] : null;


// Bouton de validation
echo '<input type="submit" value="Valider">';
echo '</form>';g
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
?>

<h1>Répondez aux questions</h1>

<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <?php foreach ($questions as $question): ?>
        <?php $question->display(); ?>
    <?php endforeach; ?>

    <input type="hidden" name="score" value="0">
    <input type="submit" value="Valider">
</form>

<!-- Afficher le score et la liste des questions correctes après la soumission du formulaire -->
<?php if ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
    <p>Votre score est : <?php echo $score; ?></p>

    <?php if ($score > 0): ?>
        <h2>Questions correctes :</h2>
        <ul>
            <?php foreach ($correctQuestions as $correctQuestion): ?>
                <li><?php echo $correctQuestion->getLabel(); ?></li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>Aucune question correcte.</p>
    <?php endif; ?>
<?php endif; ?>

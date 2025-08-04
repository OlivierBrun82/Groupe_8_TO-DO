<?php
// Initialisation de la session pour ne pas perdres les données
    session_start();
// Supression de la session
    // session_destroy();

// Initialisation des catégories si elles n'existent pas
if (!isset($_SESSION['todos'])) {
    $_SESSION['todos'] = [
        'course' => [],
        'travail' => [],
        'perso' => []
    ];
}

// Ajout de tâche
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['task'], $_POST['category'])) {
    $task = trim($_POST['task']);
    $cat = $_POST['category'];

    if ($task !== '' && isset($_SESSION['todos'][$cat])) {
        $_SESSION['todos'][$cat][] = $task;

    }
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////// Modifier le dernier if si ajout de sauvegarde de case coché //////////////////////////////////////////////////
/* $_SESSION['todos'][$cat][] = [
    'text' => $task,
    'done' => false
];                              */
/*  ----------------et ajout juste apres de :---------------------------------------------
// Mise à jour des tâches cochées (état fait/non fait)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    foreach ($_SESSION['todos'] as $category => &$tasks) {
        foreach ($tasks as $i => &$task) {
            // Si cette tâche est cochée dans le formulaire
            if (isset($_POST['done'][$category]) && in_array($i, $_POST['done'][$category])) {
                $task['done'] = true;
            } else {
                $task['done'] = false;
            }
        }
    }
    unset($task, $tasks); // Pour éviter les références persistantes
}                                            */

// Suppression de tâche
if (isset($_GET['delete'], $_GET['category'])) {
    $index = (int)$_GET['delete'];
    $cat = $_GET['category'];

    if (isset($_SESSION['todos'][$cat][$index])) {
        unset($_SESSION['todos'][$cat][$index]);
        $_SESSION['todos'][$cat] = array_values($_SESSION['todos'][$cat]); // Réindexation
    }
}
?>
<!--_______________________________________________________________________________________________
                    DEBUT DE LA PARTIE HTML
_________________________________________________________________________________________________-->

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style.css">
    <title>TODO LIST</title>
</head>
<?php
    include '../includes/header.php';
    include '../includes/main.php';
    include '../includes/footer.php';
?>    
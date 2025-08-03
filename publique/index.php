<?php
session_start();

// Initialiser la liste des tâches s'il n'y en a pas encore
if (!isset($_SESSION['tasks'])) {
    $_SESSION['tasks'] = [];
}

// Ajouter une tâche
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['task']) && !empty(trim($_POST['task']))) {
    $_SESSION['tasks'][] = htmlspecialchars($_POST['task']);
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit();
}

// Supprimer une tâche
if (isset($_GET['delete'])) {
    $index = (int) $_GET['delete'];
    if (isset($_SESSION['tasks'][$index])) {
        unset($_SESSION['tasks'][$index]);
        $_SESSION['tasks'] = array_values($_SESSION['tasks']); // Réindexer
    }
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>To-Do List avec PHP</title>
    <style>
        body { font-family: Arial; margin: 2em; }
        form { margin-bottom: 1em; }
        ul { list-style: none; padding: 0; }
        li { margin-bottom: 0.5em; }
        .delete { color: red; text-decoration: none; margin-left: 1em; }
    </style>
</head>
<body>

    <h1>📝 Ma To-Do List</h1>

    <form method="post">
        <input type="text" name="task" placeholder="Ajouter une tâche" required>
        <button type="submit">Ajouter</button>
    </form>

    <?php if (!empty($_SESSION['tasks'])): ?>
        <ul>
            <?php foreach ($_SESSION['tasks'] as $index => $task): ?>
                <li>
                    <?= htmlspecialchars($task) ?>
                    <a class="delete" href="?delete=<?= $index ?>" onclick="return confirm('Supprimer cette tâche ?')">❌</a>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>Aucune tâche pour le moment.</p>
    <?php endif; ?>

</body>
</html>

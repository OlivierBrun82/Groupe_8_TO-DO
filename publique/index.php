
<?php
session_start();

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
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>To-Do List</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<?php include "../includes/header.php" ?>
<body>
    <h1>Ma To-Do List par Catégorie</h1>

    <form method="POST" class="add-form">
        <input type="text" name="task" placeholder="Nouvelle tâche" required>
        <select name="category">
            <option value="course">Course</option>
            <option value="travail">Travail</option>
            <option value="perso">Perso</option>
        </select>
        <button type="submit">Ajouter</button>
    </form>

    <div class="todo-container">
        <?php foreach ($_SESSION['todos'] as $category => $tasks): ?>
            <section class="todo-category">
                <h2><?= ucfirst($category) ?></h2>
                <?php if (empty($tasks)): ?>
                    <p class="empty">Aucune tâche pour cette catégorie.</p>
                <?php else: ?>
                    <ul>
                        <?php foreach ($tasks as $index => $task): ?>
                            <li>
                                <input type="checkbox" disabled>
                                <span><?= htmlspecialchars($task) ?></span>
                                <a class="delete-btn" href="?delete=<?= $index ?>&category=<?= $category ?>">🗑</a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </section>
        <?php endforeach; ?>
    </div>
<?php include "../includes/footer.php" ?>
</body>
</html>
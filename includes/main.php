<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style.css">
    <title>main</title>
</head>

<main>
    <form action="" method="post">
        <input type="text" name="task" placeholder="Ajouter une nouvelle tâche ici"  required>
        <select name="category" required>
            <option value="">Choisiser une catégorie</option>
            <?php
                foreach ($a as $b) {
                    echo '<option value="' . htmlspecialchars($cat) . '">' . '</option>';
                }

            ?>
        </select>
    </form>
    <h2 class="title">MES TO-DO LIST</h2>
<!-------------------------- MES TABLEAUX TO DO LIST ------------------------------->
    <div>
        <h3 class="title">Liste de course</h3>
        <div>

        </div>
    </div>
</main>
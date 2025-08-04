<!---------------------------------------------------------------------------------->
<!-------------------------- FORMULAIRE -------------------------------------------->
<!---------------------------------------------------------------------------------->
    <main>
        <form class="formContainer" action="" method="POST">
            <div>
                <input class="inputArea" type="text" name="task" placeholder="Ajouter une nouvelle tâche ici"  required> <!-- input pour entrer une tache -->
                <select class="selectMenu" name="category" required>           <!-- menu déroulant pour selectionner un tableau de tache -->
                    <option value="course">Course</option>
                    <option value="travail">Travail</option>
                    <option value="perso">Perso</option>
                </select>
            </div>
            <button class="submitBtn" type="submit">Ajouter</button>
        </form>
<!---------------------------------------------------------------------------------->
<!-------------------------- MES TABLEAUX TO DO LIST ------------------------------->
<!---------------------------------------------------------------------------------->
        <!-- <h2 class="title">MES TO-DO LIST</h2> -->
<!-------------------------- LES TABLEAUX ------------------------------------------>
        <div class="todosContainer">
            <?php foreach ($_SESSION["todos"] as $category => $tasks) { ?> <!-- Boucle sur chaque catégorie en incluant les taches qu'on leur a assigné -->
                <section class="todoContainer">
                    <h3 class="title todoTitle"><?= $category ?></h3>
                    <?php if (empty($tasks)) { ?>
                        <p class="empty">Aucune tâche pour cette catégorie.</p>
                    <?php } else { ?>
                        <ul>
                            <?php foreach ($tasks as $index => $task) { ?>
                                <li>
                                    <input type="checkbox">
<!-- ---------------------------------------------------------------------------------------------------------------------- -->
<!----------------------------- a ajouter si sauvegarde des taches coché ----------------------------------------------------->
                                <!-- <input -->
                                    <!-- type="checkbox" -->
                                    <!-- name="done[<//?= htmlspecialchars($category) ?>][]" -->
                                    <!-- value="<//?= $index ?>" -->
                                    <!-- <//?= $task['done'] ? 'checked' : '' ?> -->
                                >
                                    <a class="delete-btn" href="?delete=<?= $index ?>&category=<?= $category ?>">🗑</a>
                                    <span><?= htmlspecialchars($task) ?></span>
                                </li>
                            <?php } ?>
                        </ul>
                    <?php } ?>
                </section>
            <?php } ?>
        </div>
    </main>
</body>
</html>
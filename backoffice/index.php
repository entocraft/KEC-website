<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Publier un article</title>
        <link href="../css/backoffice.css" rel="stylesheet">
    </head>
    <body>
        <h1>Publier un nouvel article</h1>
        <form action="submit.php" method="POST" enctype="multipart/form-data">
            <label for="title">Titre de l'article :</label><br>
            <input type="text" id="title" name="title" required><br><br>

            <label for="content">Contenu de l'article :</label><br>
            <textarea id="content" name="content" rows="10" required></textarea><br><br>

            <label for="image">Image :</label><br>
            <input type="file" id="image" name="image" accept="image/*"><br><br>

            <button type="submit">Publier</button>
        </form>
        <section>
            <?php
                // Configuration du fichier JSON contenant les articles
                $jsonFile = '../json_data/articles.json';

                // Vérifie si le fichier JSON existe
                if (file_exists($jsonFile)) {
                    // Charge les articles depuis le fichier JSON
                    $articles = json_decode(file_get_contents($jsonFile), true);

                    // Vérifie si le tableau des articles n'est pas vide
                    if (!empty($articles)) {
                        echo '<ul>';  // Ouvre la liste HTML

                        // Parcourt chaque article et affiche le titre, le contenu et l'image si disponible
                        foreach ($articles as $article) {
                            $title = htmlspecialchars($article['title']);
                            $content = htmlspecialchars(substr($article['content'], 0, 100)) . '...'; // Contenu limité à 100 caractères
                            $date = $article['date'];
                            $image = isset($article['image']) && !empty($article['image']) ? $article['image'] : null;

                            // Affiche chaque article dans la liste
                            echo '<li>';
                            echo '<h3>' . $title . '</h3>';
                            echo '<p><strong>Date :</strong> ' . $date . '</p>';
                            echo '<p>' . $content . '</p>';

                            if ($image) {
                                // Affiche l'image si elle existe
                                echo '<p><img src="' . $image . '" alt="' . $title . '" style="max-width: 150px; max-height: 150px;"></p>';
                            }

                            echo '<a href="article_detail.php?id=' . urlencode($title) . '">Lire l\'article complet</a>'; // Lien vers l'article détaillé
                            echo '</li>';
                        }

                        echo '</ul>';  // Ferme la liste HTML
                    } else {
                        echo 'Aucun article trouvé.';
                    }
                } else {
                    echo 'Le fichier des articles est introuvable.';
                }
                ?>
        </section>
    </body>
</html>

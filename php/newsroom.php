<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Karting Endurance Championship</title>
        <link href="../css/base.css" rel="stylesheet">
        <link href="../css/newsroom.css" rel="stylesheet">
    </head>
    <header>
        <nav>
            <ul>
                <li><a href="../index.html"><img src="imgs/kec_logo.png"></a></li>
                <li><a href="../calendar.html">CALENDAR</a></li>
                <li class="active"><a href="newsroom.php">NEWSROOM</a></li>
                <li><a href="ticketing.php">TICKETING</a></li>
                <li><a href="shop.php">SHOP</a></li>
            </ul>
        </nav>
    </header>
    <body>
        <section>
            <?php
                // Lire les données JSON
                $jsonFile = '../json_data/articles.json';
                $articles = json_decode(file_get_contents($jsonFile), true);

                // Vérifier si des articles sont disponibles
                if (!empty($articles)) {
                    foreach ($articles as $article) {
                        echo '<a class="article-item" href="article_viewer.php?id=' . htmlspecialchars($article['id']) . '">';
                        echo '<article>';
                        echo '<img src="' . htmlspecialchars($article['image']) . '" alt="Image de l\'article" class="article-image">';
                        echo '<h2 class="article-title">' . htmlspecialchars($article['title']) . '</h2>';
                        echo '<span class="article-date">' . htmlspecialchars($article['date']) . '</span>';
                        echo '</article>';
                        echo '</a>';
                    }
                } else {
                    echo '<p>Aucun article disponible pour le moment.</p>';
                }
            ?>
        </section>
    </body>
    <footer>
        <div class="col">
            <a href="https://www.get-media.fr">The association</a>
            <a href="../contact.html">Contact us</a>
            <a href="../contact.html">Become a partener</a>
        </div>
        <div class="col">
            <a href="../calendar.html">Calendar</a>
            <a href="teams.php">All teams</a>
        </div>
    </footer>
</html>
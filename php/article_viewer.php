<?php
// Charger le JSON des articles
$jsonData = file_get_contents('../json_data/articles.json'); // Remplacez le chemin par celui de votre fichier JSON
$articles = json_decode($jsonData, true);

// Récupérer l'id via $_GET
$articleId = $_GET['id'];

// Initialiser une variable pour l'article trouvé
$selectedArticle = null;

// Rechercher l'article correspondant
if ($articleId) {
    foreach ($articles as $article) {
        if ($article['id'] === $articleId) {
            $selectedArticle = $article;
            break;
        }
    }
}

// Afficher l'article ou un message d'erreur
if ($selectedArticle) {
    ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Karting Endurance Championship</title>
        <link href="../css/base.css" rel="stylesheet">
        <link href="../css/article.css" rel="stylesheet">
    </head>
    <header>
        <nav>
            <ul>
                <li><a href="../index.html"><img src="../imgs/kec_logo.png"></a></li>
                <li><a href="../calendar.html">CALENDAR</a></li>
                <li class="active"><a href="newsroom.php">NEWSROOM</a></li>
                <li><a href="ticketing.php">TICKETING</a></li>
                <li><a href="shop.php">SHOP</a></li>
            </ul>
        </nav>
    </header>
    <body>
        <section class="container">
            <h1><?php echo htmlspecialchars($selectedArticle['title']); ?></h1>
            <p><em>Published on: <?php echo htmlspecialchars($selectedArticle['date']); ?></em></p>
            <img src="<?php echo htmlspecialchars($selectedArticle['image']); ?>" alt="Article Image" style="max-width: 100%; height: auto;">
            <div>
                <?php echo nl2br(htmlspecialchars($selectedArticle['content'])); ?>
            </div>
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
<?php
} else {
    echo "<h1>Article not found</h1>";
    echo "<p>The article with the specified ID does not exist.</p>";
}
?>
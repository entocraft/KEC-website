<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Boutique KEC</title>
    <link href="../css/base.css" rel="stylesheet">
    <link href="../css/shop.css" rel="stylesheet">
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="../index.html"><img src="../imgs/kec_logo.png" alt="Logo"></a></li>
                <li><a href="../calendar.html">CALENDAR</a></li>
                <li><a href="newsroom.php">NEWSROOM</a></li>
                <li><a href="ticketing.php">TICKETING</a></li>
                <li><a href="shop.php">SHOP</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <h1>Boutique KEC</h1>
        <nav class="categories">
            <a href="?category=all" class="category">Tous les produits</a>
            <a href="?category=Vêtements" class="category">Vêtements</a>
            <a href="?category=Accessoires" class="category">Accessoires</a>
            <a href="?category=Equipements" class="category">Équipements</a>
        </nav>

        <section class="shop-items">
            <?php
                // Charger le JSON
                $json = file_get_contents('../json_data/liste-boutique.json');
                $shopData = json_decode($json, true);

                // Récupérer la catégorie sélectionnée (par défaut "all")
                $selectedCategory = isset($_GET['category']) ? $_GET['category'] : 'all';

                // Parcourir les catégories
                foreach ($shopData['Boutique'] as $category => $items) {
                    // Si une catégorie est sélectionnée, ignorer les autres
                    if ($selectedCategory !== 'all' && $selectedCategory !== $category) {
                        continue;
                    }

                    // Parcourir les produits de la catégorie
                    foreach ($items as $itemName => $itemData) {
                        echo '<div class="shop-card">';
                        echo '<img src="' . htmlspecialchars($itemData['Chemin_photo']) . '" alt="' . htmlspecialchars($itemName) . '">';
                        echo '<h2>' . htmlspecialchars($itemName) . '</h2>';
                        echo '<p class="price">' . htmlspecialchars($itemData['Prix']) . '</p>';
                        echo '<button class="buy-button">Acheter</button>';
                        echo '</div>';
                    }
                }
            ?>
        </section>
    </main>
</body>
<footer>
        <div class="col">
            <a href="https://www.get-media.fr">The association</a>
            <a href="../contact.html">Contact us</a>
            <a href="../contact.html">Become a partner</a>
        </div>
        <div class="col">
            <a href="../calendar.html">Calendar</a>
            <a href="teams.php">All teams</a>
        </div>
    </footer>
</html>

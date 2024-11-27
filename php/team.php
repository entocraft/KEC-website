<!DOCTYPE html>
<html lang="fr">
    <head>
        <?php
            // Récupérer le pays passé dans l'URL (ex : ?country=PT)
            $country = $_GET["country"];

            // Charger le fichier JSON
            $json = file_get_contents('../json_data/liste-equipe.json');
            $raw = json_decode($json, true);

            // Vérifier si le pays existe dans les données JSON
            if (isset($raw['Liste_equipe'][$country])) {
                $teams = $raw['Liste_equipe'][$country];  // Récupérer les équipes du pays

                // Réindexer les équipes pour éviter des indices manquants après filtrage
                $data = array_values($teams);
            } else {
                $data = [];  // Si le pays n'existe pas, on retourne un tableau vide
            }
        ?>
        <meta charset="UTF-8">
        <title>Karting Endurance Championship</title>
        <link href="../css/base.css" rel="stylesheet">
        <link href="../css/clock.css" rel="stylesheet">
        <link href="../css/calendar.css" rel="stylesheet">
        <link href="../css/teams.css" rel="stylesheet">
    </head>
    <header>
            <nav>
                <ul>
                    <li><a href="../index.html"><img src="../imgs/kec_logo.png" alt="Logo"></a></li>
                    <li><a href="../calendar.html">CALENDAR</a></li>
                    <li><a href="../newsroom.html">NEWSROOM</a></li>
                    <li><a href="../ticketing.html">TICKETING</a></li>
                    <li><a href="../shop.html">SHOP</a></li>
                </ul>
            </nav>
        </header>
    <body>
        <section>
            <?php
                // Vérifier si des équipes existent pour le pays demandé
                if (!empty($data)):  // Si des équipes sont trouvées
                    foreach ($data as $team):  // Parcours des équipes du pays
                        echo "<div class='equipe'>";
                            echo "<img src='" . htmlspecialchars($team['Chemin_logo']) . "' alt='Logo " . htmlspecialchars($team['Description']) . "' />";
                            echo "<h2>" . htmlspecialchars($team['Description']) . "</h2>";
                            echo "<p>Manager: " . htmlspecialchars($team['Manager']) . "</p>";
                            echo "<p>Numéros de kart: " . implode(', ', $team['Numéro_de_kart']) . "</p>";
                        echo "</div>";
                    endforeach;
                else:
                    echo "<p>Aucune équipe trouvée pour ce pays.</p>";  // Si aucune équipe n'est trouvée
                endif;
            ?>
        </section>
    </body>
    <footer>
        <div class="col">
            <a href="https://www.get-media.fr">The association</a>
            <a href="contact.html">Contact us</a>
            <a href="contact.html">Become a partener</a>
        </div>
        <div class="col">
            <a href="calendar.html">Calendar</a>
            <a href="php/teams.php">All teams</a>
        </div>
    </footer>
</html>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <?php
            // Charger le fichier JSON contenant les équipes
            $json = file_get_contents('../json_data/liste-equipe.json');
            $raw = json_decode($json, true);

            // Récupérer la liste des pays (clés du tableau Liste_equipe)
            $countries = array_keys($raw['Liste_equipe']);
            
            // Récupérer le pays ou "toutes les équipes" passé dans l'URL
            $country = isset($_GET['country']) ? $_GET['country'] : 'all';  // "all" pour toutes les équipes par défaut

            // Si le pays spécifique est choisi
            if ($country !== 'all' && isset($raw['Liste_equipe'][$country])) {
                $teams = $raw['Liste_equipe'][$country];  // Récupérer les équipes du pays
                $data = array_values($teams);  // Réindexer pour éviter des indices manquants
            } else {
                // Si "all" est choisi ou aucun pays spécifique n'est trouvé, afficher toutes les équipes
                $data = [];
                foreach ($raw['Liste_equipe'] as $country_teams) {
                    $data = array_merge($data, array_values($country_teams));
                }
            }
        ?>
        <meta charset="UTF-8">
        <title>Karting Endurance Championship</title>
        <link href="../css/base.css" rel="stylesheet">
        <link href="../css/clock.css" rel="stylesheet">
        <link href="../css/calendar.css" rel="stylesheet">
        <link href="../css/team.css" rel="stylesheet"> <!-- CSS spécifique aux équipes -->
    </head>
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
    <body>
        <section class="teams-section">
            <!-- Formulaire de sélection de pays avec une option "Toutes les équipes" -->
            <form method="GET" action="" class="country-select-form">
                <select name="country" id="country" onchange="this.form.submit()">
                    <option value="all" <?php echo ($country === 'all') ? 'selected' : ''; ?>>ALL</option>
                    <?php
                        // Afficher la liste des pays dans le menu déroulant
                        foreach ($countries as $c) {
                            $selected = ($c === $country) ? 'selected' : '';
                            echo "<option value='$c' $selected>" . strtoupper($c) . "</option>";
                        }
                    ?>
                </select>
            </form>

            <h1>Teams list<?php echo ($country === 'all') ? '' : ' pour le pays : ' . strtoupper($country); ?></h1>

            <?php
                // Vérifier si des équipes existent pour le pays demandé ou "toutes les équipes"
                if (!empty($data)):  // Si des équipes sont trouvées
                    foreach ($data as $team):  // Parcours des équipes
                        echo "<div class='team-item'>";
                            // Affichage du drapeau du pays (assumons qu'il existe une image avec le nom du pays)
                            echo "<img src='../imgs/flags/".strtolower($team['Pays']).".png' alt='Drapeau de ".htmlspecialchars($team['Pays'])."' class='country-flag' />";
                            echo "<img src='".$team['Chemin_logo']."' alt='Logo de ".htmlspecialchars($team['Equipe'])."' class='country-flag' />";
                            echo "<h2>" . htmlspecialchars($team['Equipe']) . "</h2>";
                            echo "<p><strong>Manager:</strong> " . htmlspecialchars($team['Manager']) . "</p>";
                            echo "<p><strong>Karts:</strong> " . implode(', ', $team['Numéro_de_kart']) . "</p>";
                        echo "</div>";
                    endforeach;
                else:
                    echo "<p>No teams found.</p>";  // Si aucune équipe n'est trouvée
                endif;
            ?>
        </section>
    </body>
</html>

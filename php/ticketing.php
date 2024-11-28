<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Karting Endurance Championship</title>
        <link href="../css/base.css" rel="stylesheet">
        <link href="../css/clock.css" rel="stylesheet">
        <link href="../css/calendar.css" rel="stylesheet">
        <link href="../css/ticket.css" rel="stylesheet">
    </head>
    <body>
        <header>
            <nav>
                <ul>
                    <li><a href="../index.html"><img src="../imgs/kec_logo.png" alt="KEC Logo"></a></li>
                    <li><a href="../calendar.html">CALENDAR</a></li>
                    <li><a href="newsroom.php">NEWSROOM</a></li>
                    <li class="active"><a href="ticketing.php">TICKETING</a></li>
                    <li><a href="shop.php">SHOP</a></li>
                </ul>
            </nav>
        </header>

        <h1>Réservez vos tickets</h1>

        <?php
            // Charger le fichier JSON contenant les informations sur les courses
            $jsonData = file_get_contents('../json_data/liste-circuit.json');
            $courses = json_decode($jsonData, true)["Courses"];

            // Boucle pour afficher chaque course
            foreach ($courses as $code => $course) {
                echo '<div class="ticket-item">';
                echo '<div class="ticket-summary">';
                // Drapeau et nom de la course
                echo '<img src="' . htmlspecialchars($course['Drapeau']) . '" alt="Drapeau ' . htmlspecialchars($course['Nom']) . '" class="ticket-flag">';
                echo '<span class="ticket-name">' . htmlspecialchars($course['Nom']) . '</span>';
                // Icônes pour chaque place (masqué dans le résumé)
                echo '<div class="ticket-icons">';
                foreach ($course['place'] as $placeName => $placeDetails) {
                    foreach ($placeDetails['Icônes'] as $icone) {
                        // Ne pas afficher ici, mais dans les détails
                        // echo '<img src="' . htmlspecialchars("../imgs/icons/" . $icone . ".png") . '" alt="Icone" class="place-icon">';
                    }
                }
                echo '</div>';
                // Prix de base
                echo '<span class="ticket-price">À partir de ' . htmlspecialchars($course['Prix_de_base']) . '€</span>';
                // Bouton pour afficher les détails
                echo '<button class="details-button">En savoir plus</button>';
                echo '</div>';

                // Détails de la course avec les places et les prix
                echo '<div class="ticket-details" style="display:none;">';
                echo '<h3>Choisissez votre place</h3>';
                // Boucle pour afficher les différentes places disponibles
                foreach ($course['place'] as $placeName => $placeDetails) {
                    echo '<div class="day-card">';
                    echo '<h4>' . htmlspecialchars($placeName) . '</h4>';
                    echo '<p>' . htmlspecialchars($placeDetails['Description']) . '</p>';
                    foreach ($placeDetails['Prix'] as $duration => $price) {
                        echo '<span class="day-price">' . htmlspecialchars($duration) . ': ' . htmlspecialchars($price) . '</span><br>';
                    }
                    foreach ($placeDetails['Icônes'] as $icone) {
                        // Afficher ici les icônes, dans la section des détails
                        echo '<img src="' . htmlspecialchars("../imgs/icons/" . $icone . ".png") . '" alt="Icone" class="place-icon">';
                    }
                    echo '</div>';
                }
                echo '</div>';
                echo '</div>';
            }
        ?>

        <script>
            // Lorsque le bouton "En savoir plus" est cliqué, afficher/masquer les détails
            document.querySelectorAll('.details-button').forEach(function(button) {
                button.addEventListener('click', function() {
                    const details = this.closest('.ticket-item').querySelector('.ticket-details');
                    details.style.display = (details.style.display === 'block') ? 'none' : 'block';
                });
            });
        </script>
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

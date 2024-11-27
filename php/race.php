<!DOCTYPE html>
<html>
    <head>
        <?php
            $race = $_GET["country"];

            $json = file_get_contents('../json_data/liste-circuit.json');
            $circuits = json_decode($json, true);

            $data = $circuits[$race];
        ?>
        <meta charset="UTF-8">
        <title>Karting Endurance Championship</title>
        <link href="../css/base.css" rel="stylesheet">
        <link href="../css/clock.css" rel="stylesheet">
        <link href="../css/calendar.css" rel="stylesheet">
        <link href="../css/table.css" rel="stylesheet">
    </head>
    <header>
        <nav>
            <ul>
                <li><a href="../index.html"><img src="../imgs/kec_logo.png"></a></li>
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
                echo "<p><strong>Localisation:</strong> " . htmlspecialchars($data['Localisation']) . "</p>";
                echo "<p><strong>Taille:</strong> " . htmlspecialchars($data['Taille']) . "</p>";
                echo "<p><strong>Virages:</strong> " . htmlspecialchars($data['Virage']) . "</p>";
                echo "<img src='" . htmlspecialchars($data['chemin_image']) . "' alt='Image du circuit' />";
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
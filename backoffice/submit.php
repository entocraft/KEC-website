<?php
// Configuration
$uploadDir = '../imgs/articles/';
$jsonFile = '../json_data/articles.json';

// Vérifie si le formulaire est soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Vérifie et récupère les données du formulaire
    $title = trim($_POST['title']);
    $content = trim($_POST['content']);
    $date = date('Y-m-d H:i:s');
    $imagePath = null; // Initialise l'image comme null

    // Vérifie si un fichier a été uploadé
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['image']['tmp_name'];
        $fileName = basename($_FILES['image']['name']);
        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];

        // Vérifie l'extension de l'image
        if (in_array($fileExtension, $allowedExtensions)) {
            // Génère un nom unique pour éviter les conflits
            $newFileName = uniqid('img_', true) . '.' . $fileExtension;
            $destPath = $uploadDir . $newFileName;

            // Déplace l'image dans le dossier uploads
            if (move_uploaded_file($fileTmpPath, $destPath)) {
                $imagePath = $destPath; // Définit le chemin de l'image
            } else {
                echo "Erreur lors du téléchargement de l'image.";
                exit; // Arrête le script si l'image ne peut pas être téléchargée
            }
        } else {
            echo "Extension de fichier non autorisée. Extensions acceptées : jpg, jpeg, png, gif.";
            exit; // Arrête le script si l'extension est incorrecte
        }
    }

    // Prépare les données de l'article
    $article = [
        'title' => $title,
        'content' => $content,
        'image' => $imagePath, // Ajoute null si aucune image n'est fournie
        'date' => $date
    ];

    // Charge les articles existants
    if (file_exists($jsonFile)) {
        $articles = json_decode(file_get_contents($jsonFile), true);
    } else {
        $articles = [];
    }

    // Ajoute le nouvel article
    $articles[] = $article;

    // Sauvegarde les articles dans le fichier JSON
    file_put_contents($jsonFile, json_encode($articles, JSON_PRETTY_PRINT));

    echo "Article publié avec succès !";
} else {
    echo "Méthode non autorisée.";
}
?>

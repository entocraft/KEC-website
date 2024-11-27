<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $subject = filter_input(INPUT_POST, 'subject', FILTER_SANITIZE_STRING);
    $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
    $message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING);

    if ($email && $subject && $title && $message) {
        // Destinataire de l'email
        $to = 'contact@get-media.fr'; // Remplacez par l'adresse email de réception
        $fullSubject = "[" . ucfirst($subject) . "] " . $title;

        // En-têtes de l'email
        $headers = "From: $email\r\n";
        $headers .= "Reply-To: $email\r\n";
        $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

        // Envoi de l'email
        if (mail($to, $fullSubject, $message, $headers)) {
            echo "Message envoyé avec succès.";
        } else {
            echo "Erreur lors de l'envoi du message.";
        }
    } else {
        echo "Veuillez remplir tous les champs correctement.";
    }
} else {
    echo "Méthode non autorisée.";
}
?>

<?php
session_start();
require_once('user.class.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérifier si l'utilisateur est connecté
    if (!isset($_SESSION['email'])) {
        echo "User not logged in.";
        exit();
    }

    // Récupérer l'email de l'utilisateur
    $email = $_SESSION['email'];

    // Vérifier si un fichier a été téléchargé
    if ($_FILES['new_image']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = 'img/';
        $uploadPath = $uploadDir . basename($_FILES['new_image']['name']);
    
        if (move_uploaded_file($_FILES['new_image']['tmp_name'], $uploadPath)) {
            // Appeler la fonction pour mettre à jour l'image dans la classe User
            $user = new User();
            $result = $user->updateImg($email, $uploadPath);
            header('location: dashboard/settings.php');
    }
    }}
?>

<?php
session_start();
require_once('user.class.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $email = $_SESSION['email'];
    $oldPassword = $_POST['old_password'];
    $newNom = $_POST['new_nom'];
    $newPassword = $_POST['new_password'];
    $newNumTel = $_POST['new_num_tel'];

    $user = new User();
    $result = $user->updateUser($email, $oldPassword, $newNom, $newPassword, $newNumTel);
    if ($result) {
        header('location: dashboard/settings.php');
        exit(); // Ajout pour arrêter l'exécution après la redirection
    } else {
        echo "Failed to update user information.";
    }
}
?>

<?php
require_once('user.class.php');
session_start();
$user = new User();
if (isset($_POST['user_id']) && isset($_POST['new_role'])) {
    // Récupérer l'ID de l'utilisateur à partir de la requête
    $user_id = $_POST['user_id'];
    $new_role = $_POST['new_role'];

    // Appeler la fonction appropriée en fonction du nouveau rôle souhaité
    if ($new_role == 'admin') {
        $user ->change_role_to_admin($user_id);
    } elseif ($new_role == 'user') {
        $user ->change_role_to_user($user_id);
    }
    header('location: dashboard/tables.php');
    exit();
} else {
    // Si l'ID de l'utilisateur ou le nouveau rôle n'est pas défini, afficher un message d'erreur ou rediriger vers une autre page
    header('Location: error.php'); // Rediriger vers une page d'erreur
    exit();
}
?>

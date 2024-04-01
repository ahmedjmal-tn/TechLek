<?php
require_once('user.class.php');
session_start();


$session_lifetime = 1800; 
session_set_cookie_params($session_lifetime);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['login_email']) && isset($_POST['login_password'])) {
        $email = $_POST['login_email'];
        $password = $_POST['login_password'];
        $user = new User();
        $result = $user->connect_user($email, $password);
        if ($result) {
            $_SESSION["connecte"] = "1";
            $_SESSION["email"] = $email;
            $_SESSION["nom"] = $user->get_nom_by_email($email); 
            header('Location: index.php');
            exit();
        } else {
            header('Location: SignIn.html');
            exit();
        }
    } elseif (isset($_POST['register_name']) && isset($_POST['register_phone']) && isset($_POST['register_email']) && isset($_POST['register_password'])) {
        $user = new User();
        $user->nom_user = $_POST['register_name'];
        $user->num_tel = $_POST['register_phone'];
        $user->email = $_POST['register_email'];
        $user->password = $_POST['register_password'];
        $user->add_user();

        $_SESSION["connecte"] = "1";
        $_SESSION["email"] = $_POST['register_email'];
        $_SESSION["nom"] = $_POST['register_name'];
        header('Location: index.php');
        exit();
    }
}

?>

<?php
require_once('pdo.php');

class User
{
    public $id_user;
    public $nom_user;
    public $num_tel;
    public $email;
    public $password;

    function add_user()
    {
        $cnx = new Connexion();
        $pdo = $cnx->CNXbase();
        $req = "insert into compte (nom, num_tel, email, password) values ('$this->nom_user', '$this->num_tel', '$this->email', '$this->password')";
        $pdo->exec($req) or print_r($pdo->errorInfo());
    }
    function connect_user($email, $password)
    {

        $cnx = new Connexion();
        $pdo = $cnx->CNXbase();
        $sql = "SELECT * FROM compte WHERE email = '$email' AND password = '$password'";
        $result = $pdo->query($sql);
        if ($result && $result->rowCount() > 0) {

            $user = $result->fetch(PDO::FETCH_ASSOC);
            return $user;
        } else {
            return false;
        }
    }
    function get_nom_by_email($email)
    {
        $cnx = new Connexion();
        $pdo = $cnx->CNXbase();
        $sql = "SELECT nom FROM compte WHERE email = '$email'";
        $result = $pdo->query($sql);
        if ($result && $result->rowCount() > 0) {
            $user = $result->fetch(PDO::FETCH_ASSOC);
            return $user['nom'];
        } else {
            return false;
        }
    }
    function get_user($email)
{
    $cnx = new Connexion();
    $pdo = $cnx->CNXbase();
    $sql = "SELECT * FROM compte WHERE email = '$email'";
    $result = $pdo->query($sql);
    if ($result && $result->rowCount() > 0) {
        $user = $result->fetch(PDO::FETCH_ASSOC);
        return $user;
    } else {
        return false;
    }
}
function get_all_users()
{
    $cnx = new Connexion();
    $pdo = $cnx->CNXbase();
    $sql = "SELECT * FROM compte";
    $result = $pdo->query($sql);
    if ($result) {
        return $result->fetchAll(PDO::FETCH_ASSOC);
    } else {
        return false;
    }
}


function delete_user($id)
{
    $cnx = new Connexion();
    $pdo = $cnx->CNXbase();
    $sql = "DELETE FROM compte WHERE id = '$id'";
    $pdo->exec($sql);
}

public function updateImg($email, $newImage)
{
    $cnx = new Connexion();
    $pdo = $cnx->CNXbase();

    // Préparation de la requête pour mettre à jour l'image
    $sql = "UPDATE compte SET image = :newImage WHERE email = :email";

    // Exécution de la requête
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':newImage', $newImage);
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    // Vérification si la mise à jour a réussi
    if ($stmt->rowCount() > 0) {
        return true; // Succès de la mise à jour
    } else {
        return false; // Échec de la mise à jour
    }
}
function updateUser($email, $oldPassword, $newNom, $newPassword, $newNumTel)
{
    $cnx = new Connexion();
    $pdo = $cnx->CNXbase();

    // Vérification si l'ancien mot de passe est correct
    $stmt = $pdo->prepare("SELECT * FROM compte WHERE email = :email AND password = :oldPassword");
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':oldPassword', $oldPassword);
    $stmt->execute();

    // Si l'ancien mot de passe est correct, effectuer la mise à jour des informations utilisateur
    if ($stmt->rowCount() > 0) {
        $sql = "UPDATE compte SET nom = :newNom, password = :newPassword, num_tel = :newNumTel WHERE email = :email";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':newNom', $newNom);
        $stmt->bindParam(':newPassword', $newPassword);
        $stmt->bindParam(':newNumTel', $newNumTel);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return true; // Succès de la mise à jour
    } else {
        return false; // Échec de la mise à jour (mot de passe incorrect)
    }
}


function change_role_to_admin($id)
{
    $cnx = new Connexion();
    $pdo = $cnx->CNXbase();
    $sql = "UPDATE compte SET role = 'admin' WHERE id = '$id'";
    $pdo->exec($sql);
}
function change_role_to_user($id)
{
    $cnx = new Connexion();
    $pdo = $cnx->CNXbase();
    $sql = "UPDATE compte SET role = 'user' WHERE id = '$id'";
    $pdo->exec($sql);
}
}
?>
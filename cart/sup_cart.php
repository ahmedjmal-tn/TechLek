<?php
require_once('cart.class.php');
$cart = new Cart();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if(isset($_POST['id_cart'])) {
        $id_cart = $_POST['id_cart'];
        $id_user = $_POST['id_user'];
        $cart->restoreStock($id_user );
        $cart->removeFromCart($id_cart);
        header("Location: ../cart.php");
        exit; 
    } else {

        echo "L'identifiant du produit à supprimer n'a pas été spécifié.";
    }
} else {
    echo "Cette page ne peut être accédée directement.";
}
?>

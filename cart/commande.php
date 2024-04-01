<?php
require_once('cart.class.php');
$cart = new Cart();
$product_id = $_POST['id_produit'];
$quantity = $_POST['quantite'];
$cart->updateStock($product_id , $quantity);
$cart->clearCart();
header("Location: ../confirmation.php");
?>
<?php
session_start();
require_once('session.php');
Verifier_session();
require_once('user.class.php');
$us=new user();
$x=$us-> get_user($_SESSION['email']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <link rel="shortcut icon" href="img/logo.svg" type="image/x-icon" />
    <title>TechLek - Confirmation de commande</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Raleway:wght@600;800&display=swap"
        rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">



    <link href="css/bootstrap.min.css" rel="stylesheet">

    <link href="css/style.css" rel="stylesheet">
</head>

<body>


<div class="container-fluid confirmation-command py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="text-center mb-5">
                    <i class="fas fa-check-circle text-success fa-5x mb-3"></i>
                    <h2 class="text-success mb-3">Order Confirmed!</h2>
                    <p>Your order has been confirmed successfully. You will soon receive an email confirmation with the details of your order.</p>
                </div>
                <div class="text-center">
                    <a href="shop.php" class="btn btn-primary">Back to Shop</a>
                </div>
            </div>
        </div>
    </div>
</div>

    <!-- Confirmation de commande End -->

    <!-- Footer Start -->
    <!-- Your footer code goes here -->
    <!-- Footer End -->

    <!-- JavaScript Libraries -->
    <!-- Your JavaScript libraries goes here -->

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>

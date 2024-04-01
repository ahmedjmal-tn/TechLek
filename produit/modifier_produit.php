<?php
session_start();
require_once('../session.php');
require_once('produit.class.php');
Verifier_session();

$pr = new Produit();
$res = $pr->getProduct($_GET['id']);
$data = $res;
$id = $data[0]['id_produit'];
$nom = $data[0]['nom_produit']; 
$desc = $data[0]['description']; 
$cat = $data[0]['categorie']; 
$prix = $data[0]['prix']; 
$stock = $data[0]['stock'];
$image = $data[0]['image'];  
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../img/logo.svg" type="image/x-icon" />
    <title>TechLek</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles -->
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            max-width: 600px;
            margin-top: 50px;
        }
        .btn-custom {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-custom:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="text-center mb-4">Update Product</h2>
        <form action="update_Product.php" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
                <input type="hidden" id="id" name="id" value="<?php echo $id; ?>">
            </div>
            <div class="mb-3">
                <label for="nom" class="form-label">Product Name</label>
                <input type="text" class="form-control" id="nom" name="nom" value="<?php echo $nom; ?>" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3" required><?php echo $desc; ?></textarea>
            </div>
            <div class="mb-3">
                <label for="categorie" class="form-label">Category</label>
                <input type="text" class="form-control" id="categorie" name="categorie" value="<?php echo $cat; ?>" required>
            </div>
            
            <div class="mb-3">
                <label for="prix" class="form-label">Price</label>
                <input type="number" step="0.01" class="form-control" id="prix" name="prix" value="<?php echo $prix; ?>" required>
            </div>
            <div class="mb-3">
                <label for="stock" class="form-label">Stock</label>
                <input type="number" class="form-control" id="stock" name="stock" value="<?php echo $stock; ?>" required>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Image</label>
                <input type="file" class="form-control" id="image" name="image"value="img/<?php echo $image; ?>" required>
            </div> 
            <button type="submit" class="btn btn-custom">Update Product</button>
        </form>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

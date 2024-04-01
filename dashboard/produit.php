<?php
session_start();
require_once('../session.php');
require_once('../produit/produit.class.php');
require_once('../user.class.php');
$us=new user();
$x=$us-> get_user($_SESSION['email']);
Verifier_session(); 
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="../img/logo.svg" type="image/x-icon" />
    <title>TechLek</title>

    <!-- ========== All CSS files linkup ========= -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/css/lineicons.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="assets/css/materialdesignicons.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="assets/css/fullcalendar.css" />
    <link rel="stylesheet" href="assets/css/fullcalendar.css" />
    <link rel="stylesheet" href="assets/css/main.css" />
  </head>
  <body>
    <!-- ======== Preloader =========== -->
    <div id="preloader">
      <div class="spinner"></div>
    </div>
    <!-- ======== Preloader =========== -->

    <!-- ======== sidebar-nav start =========== -->
    <aside class="sidebar-nav-wrapper">
    <div class="navbar-logo">
      <a href="../index.php">
          <img src="../img/logo.svg" alt="logo" />
        </a>
      </div>
      <nav class="sidebar-nav">
      <ul>
    <a
      href="#0"
      data-bs-toggle="collapse"
      data-bs-target="#ddmenu_1"
      aria-controls="ddmenu_1"
      aria-expanded="false"
      aria-label="Toggle navigation"
    >
    <li class="nav-item">
        <a href="dashboard.php">
            <span class="icon">
                <i class="fa-solid fa-house"></i> <!-- Utilisation de l'icône spécifique -->
            </span>
            <span class="text">Dashboard</span>
        </a>
    </li>
    <li class="nav-item">
        <a href="settings.php">
            <span class="icon">
                <i class="fa-solid fa-cog"></i> <!-- Utilisation de l'icône spécifique -->
            </span>
            <span class="text">Edit Profile</span>
        </a>
    </li>
    <li class="nav-item">
        <?php
            if (isset($_SESSION['email'])) {
                require_once('../user.class.php');
                $user = new User();
                // Obtenez les détails de l'utilisateur connecté
                $userData = $user->get_user($_SESSION['email']);
                if ($userData && ($userData['role'] == 'admin' || $userData['role'] == 'super_admin'))  {
                    // Si l'utilisateur a le rôle d'administrateur, affichez les liens supplémentaires
                    echo '
                        <a href="tables.php">
                            <span class="icon">
                                <i class="fa-solid fa-users"></i> 
                            </span>
                            <span class="text">Edit User</span>
                        </a>
                        <a href="produit.php">
                            <span class="icon">
                                <i class="fa-solid fa-box"></i> 
                            </span>
                            <span class="text">Product</span>
                        </a>';
                }
            }
        ?>
    </li>
</ul>


      </nav>
    </aside>
    <div class="overlay"></div>
    <!-- ======== sidebar-nav end =========== -->

    <!-- ======== main-wrapper start =========== -->
    <main class="main-wrapper">
      <!-- ========== header start ========== -->
      <header class="header">
        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-5 col-md-5 col-6">
              <div class="header-left d-flex align-items-center">
                <div class="menu-toggle-btn mr-15">
                  <button id="menu-toggle" class="main-btn primary-btn btn-hover">
                    <i class="lni lni-chevron-left me-2"></i> Menu
                  </button>
                </div>
                <div class="header-search d-none d-md-flex">
                  <form action="#">
                    <input type="text" placeholder="Search..." />
                    <button><i class="lni lni-search-alt"></i></button>
                  </form>
                </div>
              </div>
            </div>
            <div class="col-lg-7 col-md-7 col-6">
              <div class="header-right">
                
              
                <!-- profile start -->
                <div class="profile-box ml-15">
                  <button class="dropdown-toggle bg-transparent border-0" type="button" id="profile"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <div class="profile-info">
                      <div class="info">
                        <div class="image">
                        <img src="../<?php echo $x['image']; ?>" alt="" />
                        </div>
                        <div>
                          <h6 class="fw-500"><?php echo $x['nom']; ?></h6>
                          
                        </div>
                      </div>
                    </div>
                  </button>
                  <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profile">
                    <li>
                      <div class="author-info flex items-center !p-1">
                        <div class="image">
                        <img src="../<?php echo $x['image']; ?>" alt="" />
                        </div>
                        <div class="content">
                          <h4 class="text-sm"><?php echo $x['nom']; ?></h4>
                          <a class="text-black/40 dark:text-white/40 hover:text-black dark:hover:text-white text-xs" href="#"><?php echo $_SESSION['email']; ?></a>
                        </div>
                      </div>
                    </li>
                    <li class="divider"></li>
                    <li>
                      <a href="#0">
                        <i class="lni lni-user"></i> View Profile
                      </a>
                    </li>
                    <li class="divider"></li>
                    <li>
                    <a href="../deconnexion.php" class="my-auto ms-3"> <i class="lni lni-exit"></i> Sign Out </a>
                    </li>
                  </ul>
                </div>
                <!-- profile end -->
              </div>
            </div>
          </div>
        </div>
      </header>
      <!-- ========== header end ========== -->



      <!-- ========== table components start ========== -->
      <section class="table-components">
        <div class="container-fluid">
          <!-- ========== title-wrapper start ========== -->
          <div class="title-wrapper pt-30">
            <div class="row align-items-center">
              <div class="col-md-6">
                <div class="title">
                  <h2>Tables</h2>
                </div>
              </div>
              <!-- end col -->
              <div class="col-md-6">
                <div class="breadcrumb-wrapper">
                  <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item">
                        <a href="#0">Dashboard</a>
                      </li>
                      <li class="breadcrumb-item active" aria-current="page">
                        Tables
                      </li>
                    </ol>
                  </nav>
                </div>
              </div>
              <!-- end col -->
            </div>
            <!-- end row -->
          </div>
          <!-- ========== title-wrapper end ========== -->
          <div class="row">
    <div class="col-lg-12">
        <div class="card-style mb-30">

        <h6 class="mb-10">List of Products</h6>
<p class="text-sm mb-20">Here is the list of available products:</p>
            <div class="table-wrapper table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>image </th>
                            
                            <th>Nom</th>
                            <th>Description</th>
                            <th>Prix</th>
                            <th>Stock</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $produit = new Produit();
                        $products = $produit->listerProduits();
                        if ($products) {
                            foreach ($products as $product) {
                                $description = strlen($product['description']) > 200 ? substr($product['description'], 0, 200) . "..." : $product['description'];
                                ?>
                                <tr>
                                    <td><img src="../img/<?php echo $product['image']; ?>" alt="Product Image" style="max-width: 50px; max-height: 50px;"></td>
                                    <td><?php echo $product['nom_produit']; ?></td>
                                    <td><?php echo $description; ?></td>
                                    <td><?php echo $product['prix']; ?></td>
                                    <td><?php echo $product['stock']; ?></td>
                                    <td>
                                        <a href="../produit/modifier_produit.php?id=<?php echo $product['id_produit']; ?>" class="btn btn-primary btn-sm">edit</i></a>
                                        <a href="../produit/supProd.php?id=<?php echo $product['id_produit']; ?>" class="btn btn-danger btn-sm">delete</i></a>
                                    </td>
                                </tr>
                                <?php
                            }
                        } else {
                            echo "<tr><td colspan='6'>Aucun produit trouvé</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <!-- Ajout du bouton pour ajouter un produit -->
            <a href="../produit/add_Products.php" class="btn btn-success"><i class="fas fa-plus"></i> Ajouter Produit</a>
        </div>
    </div>
</div>


     




    <!-- ========= All Javascript files linkup ======== -->
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/Chart.min.js"></script>
    <script src="assets/js/dynamic-pie-chart.js"></script>
    <script src="assets/js/moment.min.js"></script>
    <script src="assets/js/fullcalendar.js"></script>
    <script src="assets/js/jvectormap.min.js"></script>
    <script src="assets/js/world-merc.js"></script>
    <script src="assets/js/polyfill.js"></script>
    <script src="assets/js/main.js"></script>
  </body>
</html>

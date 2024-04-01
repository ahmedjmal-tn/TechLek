<?php
session_start();
require_once('../session.php');
require_once('../user.class.php');
$us = new user();
$x = $us->get_user($_SESSION['email']);

Verifier_session();

$user = new User();
$users = $user->get_all_users(); // Récupérer tous les utilisateurs
// Vérifier si le formulaire a été soumis
if (isset($_POST['user_id']) && isset($_POST['make_admin'])) {
  // Récupérer l'ID de l'utilisateur à partir du formulaire
  $user_id = $_POST['user_id'];

  // Appeler la méthode pour changer le rôle de l'utilisateur en administrateur
  $user->change_role_to_admin($user_id);

  // Rediriger vers une autre page ou afficher un message de succès, etc.
  // Par exemple :
  header("Location: dashboard.php");
  exit; // Arrêter l'exécution du script après la redirection
}
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
        <a href="#0" data-bs-toggle="collapse" data-bs-target="#ddmenu_1" aria-controls="ddmenu_1" aria-expanded="false" aria-label="Toggle navigation">
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
              if ($userData && ($userData['role'] == 'admin' || $userData['role'] == 'super_admin')) {
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
                <button class="dropdown-toggle bg-transparent border-0" type="button" id="profile" data-bs-toggle="dropdown" aria-expanded="false">
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

              <h6 class="mb-10">List of Users</h6>
              <p class="text-sm mb-20">Here is the list of available users:</p>
              <div class="table-wrapper table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                      <th>
                        <h6>#</h6>
                      </th>
                      <th>
                        <h6>Name</h6>
                      </th>
                      <th>
                        <h6>Email</h6>
                      </th>
                      <th>
                        <h6>Action</h6> <!-- Changer le titre de la colonne -->
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    if ($users) {
                      foreach ($users as $user) {
                        echo "<tr>";
                        echo "<td><div name='user_id'>{$user['id']}</div></td>";
                        echo "<td>{$user['nom']}</td>";
                        echo "<td>{$user['email']}</td>";
                        echo "<td>";

                        // Condition pour la suppression et la promotion
                        if ($x['role'] == 'super_admin') {
                          // Si l'utilisateur actuel est un super_admin, aucun bouton de suppression ne sera affiché pour cet utilisateur
                          if ($user['role'] != 'super_admin') {
                            // Seuls les utilisateurs autres que les super_admin peuvent être supprimés
                            echo "<a href='../sup.php?id={$user['id']}' class='btn btn-danger btn-sm'>Supprimer</a>";
                          }
                        } elseif ($x['role'] == 'admin') {
                          if ($user['role'] == 'user') {
                            echo "<a href='../sup.php?id={$user['id']}' class='btn btn-danger btn-sm'>Supprimer</a>";
                          }
                        }

                        echo "<form method='POST' action='../change_role.php'>";
                        echo "<input type='hidden' name='user_id' value='{$user['id']}'>";

                        if ($x['role'] == 'super_admin') {
                          if ($user['role'] == 'user') {
                              echo "<input type='hidden' name='new_role' value='admin'>";
                              echo "<button type='submit' name='make_admin' class='btn btn-primary btn-sm'>Promote to Admin</button>";
                          } elseif ($user['role'] == 'admin') {
                              echo "<input type='hidden' name='new_role' value='user'>";
                              echo "<button type='submit' name='make_user' class='btn btn-primary btn-sm'>Demote to User</button>";
                          }
                      }
                        echo "</form>";

                        echo "</td>";
                        echo "</tr>";
                      }
                    }



                    ?>
                  </tbody>
                </table>
              </div>

            </div>
            <!-- end card -->
          </div>
          <!-- end col -->
        </div>
        <!-- end row -->
      </div>
      <!-- ========== tables-wrapper end ========== -->
      </div>
      <!-- end container -->
    </section>
    <!-- ========== table components end ========== -->

    <!-- ========== footer start =========== -->
    <footer class="footer">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-6 order-last order-md-first">
            <div class="copyright text-center text-md-start">
              <p class="text-sm">
                Designed and Developed by
                <a href="https://plainadmin.com" rel="nofollow" target="_blank">
                  PlainAdmin
                </a>
              </p>
            </div>
          </div>
          <!-- end col-->
          <div class="col-md-6">
            <div class="terms d-flex justify-content-center justify-content-md-end">
              <a href="#0" class="text-sm">Term & Conditions</a>
              <a href="#0" class="text-sm ml-15">Privacy & Policy</a>
            </div>
          </div>
        </div>
        <!-- end row -->
      </div>
      <!-- end container -->
    </footer>
    <!-- ========== footer end =========== -->
  </main>
  <!-- ======== main-wrapper end =========== -->

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
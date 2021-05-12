<?php
session_start()

?> 

<!DOCTYPE html>
<html lang="FR">

<head>

  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

  <meta name="description" content="Envie d'une pizza, d'un plat à emporter ?" />
  <meta name="author" content="Hayduns" />
  <meta content="food" name="keywords">


  <title>Fooster</title>
  
  

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Poppins:300,300i,400,400i,600,600i,700,700i|Satisfy|Comic+Neue:300,300i,400,400i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/icofont/icofont.min.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="assets/vendor/venobox/venobox.css" rel="stylesheet">
  <link href="assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

</head>

<body>
    

                                

    <div class="l-main">

        <div class="hautdepage">
                <?php
                    include("includes/navbar.php");
                    
                ?>
            </div>

       
       
       
       
       
                <!-- Page Content -->
                   

                    <?php if (isset($_GET['Page'])) {
                    switch ($_GET['Page']) {

                        case 'prod':
                        include("Controleurs/c_produit.php");
                        break;

                  
                        case 'produit':
                        include("Vues/produit.php");
                        break;

                        case 'home': include("pages/home.php");break;
                        case 'profil': include("pages/profil.php");break;

                        case 'menu': include("pages/menu.php");break;
                        case 'test': include("test.php"); break;


                      
                        default:
                        include("Vues/erreur/Erreur.php");
                        break;
                    }
                    } else {
                        header('Location: index.php?Page=home');
                    }

                    ?>

                   
            <!-- /.container -->
       
       
       
        <div class="basdepage">
            <?php
                include("includes/footer.php");
            ?>
        </div>
    </div>



       
            <!-- Vendor JS Files -->
            <script src="assets/vendor/jquery/jquery.min.js"></script>
            <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
            <script src="assets/vendor/jquery.easing/jquery.easing.min.js"></script>
            <script src="assets/vendor/php-email-form/validate.js"></script>
            <script src="assets/vendor/jquery-sticky/jquery.sticky.js"></script>
            <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
            <script src="assets/vendor/venobox/venobox.min.js"></script>
            <script src="assets/vendor/owl.carousel/owl.carousel.min.js"></script>

            <!-- Main JS File -->
            <script src="assets/js/main.js"></script>
    </body>
</html>


<?php
    // fonction pour vérifier les input 
    function verifyInput($var){
        $var = htmlspecialchars($var);
        $var = trim($var);
        $var = stripslashes($var);
        return $var;
    }

    @$pseudo = verifyInput($_POST['pseudo']);
    @$mp = verifyInput($_POST['mp']);
    @$login = $_POST['login'];

    $error = "";
    $valid = "";

    if(isset($login)){
        if(empty($pseudo) || empty($mp)){
            $error = "Champ laissé Vide !";
        }

        if(empty($error)){
            require('./bdd/connexionBdd.php');

            $requete = $connexion->prepare("SELECT * FROM admin WHERE pseudo=? and motDePasse=?");
			$requete ->execute(array($pseudo, $mp));
			$verify_user = $requete -> rowCount();

            if ($verify_user==1) {
				$var = $requete -> fetch();
					session_start();
					$_SESSION['pseudo'] = $var['pseudo'];

					header('Location:profil.php');

				}
			else
			{
				$error = "Vous avez entré de fausses informations !" ;
			}
        }
    }
?>
<?php session_start(); ?>
<?php session_destroy(); ?>
<!DOCTYPE html>
<html lang="en"></html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin-Le grenier du Septentrion</title>

    <link rel="shortcut icon" href="../assets/img/gds.jpg">

    <link href="../assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
    <link href="../assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/vendor/icofont/icofont.min.css" rel="stylesheet">
    <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="../assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="../assets/vendor/venobox/venobox.css" rel="stylesheet">
    <link href="../assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="../assets/vendor/aos/aos.css" rel="stylesheet">  
    
    <link href="../assets/css/style.css" rel="stylesheet">

</head>
<body>
    <!-- ======= Header ======= -->
    <header id="header" class="fixed-top d-flex align-items-center">
        <div class="container">
            <div class="header-container d-flex align-items-center justify-content-between">
                <div class="logo">
                    <h1 class="text-light"><a href="#"><span>Le Grenier du Septentrion / ADMIN</span></a></h1>
                </div>

            </div><!-- End Header Container -->
        </div>
    </header><!-- End Header -->

    <style>
        .contact{
            margin-top:50px;
        }
    </style>

    <section class="contact">
        <div class="container">
            <div class="section-title">
                <h2>Authentification</h2>
            </div>

            <div data-aos="fade-up" data-aos-delay="100">
                <?php if(isset($login) && empty($error)) { ?> <div class="alert alert-success"><?php echo $valid ?></div><?php }  ?>
                
                <?php if(isset($login) && !empty($error)) { ?> <div class="alert alert-danger"><?php echo $error ?></div><?php } ?>
                <form method="post" role="form" class="php-email-form mt-4" enctype="multipart/form-data">
                    
                    <div class="form-group mt-3">
                        <input name="pseudo" type="text" class="form-control" placeholder="Entrer le Pseudo">
                    </div>
                    <div class="form-group mt-3">
                        <input name="mp" type="password" class="form-control" placeholder="Entrer le Mot de Passe">
                    </div>
                    
                    <div class="text-center"><button name="login" type="submit">S'authentifier</button></div>
                </form>
            </div>
        </div>
    </section>


    <script src="../assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="../assets/vendor/swiper/swiper-bundle.min.js"></script>      
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/vendor/waypoints/jquery.waypoints.min.js"></script>
    <script src="../assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="../assets/vendor/venobox/venobox.min.js"></script>
    <script src="../assets/vendor/owl.carousel/owl.carousel.min.js"></script>
    <script src="../assets/vendor/aos/aos.js"></script>
    <script src="../assets/vendor/purecounter/purecounter.js"></script>

    
    <script src="../assets/js/main.js"></script>
</body>
</html>

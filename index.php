<?php
    require('admin/bdd/connexionBdd.php');

    $requete2 = $connexion->query("SELECT * FROM `admin` ");

    $admin = $requete2->fetch();
?>
<?php
    require('admin/bdd/connexionBdd.php');

    $requete1 = $connexion->query("SELECT * FROM `commentaires` WHERE etatAdmin = 1 and etatUser = 1");

    $requete = $connexion->query("SELECT * FROM `images` WHERE etat = 1  ORDER BY moment DESC");

    function typeImage($var){
        switch ($var){
            case "miel":
                $var =  "Miel";
                return $var;
                break;

            case "cassoulet":
                $var = "Cassoulet";
                return $var;
                break;

            case "beurreDeKarité":
                $var = "Beurre de Karité";
                return $var;
                break;

            case "farineDeCossette":
                $var = "Farine de Cossette";
                return $var;
                break;
        }
    }
?>
<?php
    // fonction pour vérifier les input 
    function verifyInput($var){
        $var = htmlspecialchars($var);
        $var = trim($var);
        $var = stripslashes($var);
        return $var;
    }

    @$name = verifyInput($_POST['name']);
    @$prenom = verifyInput($_POST['prenom']);
    @$email = verifyInput($_POST['email']);
    @$message = verifyInput($_POST['message']);
    @$send = $_POST['send'];

    $error = "";
    $valid = "";

    if(isset($send)){
        if(empty($name) || empty($prenom) || empty($email) || empty($message)){
            $error = "Champ laissé Vide !";
        }

        if(empty($error)){
            require('admin/bdd/connexionBdd.php');

            $requete = $connexion -> prepare("INSERT INTO commentaires(nom, prenom, email, commentaire, date, time) VALUES (?,?,?,?,NOW(),NOW())");
    
            $requete -> execute(array($name, $prenom, $email, $message));
            
            $valid = "Commentaire envoyé";
        }
    }
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $admin["nomSociete"] ?></title>

    <link rel="shortcut icon" href="assets/img/gds.jpg" >

    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
    <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/icofont/icofont.min.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="assets/vendor/venobox/venobox.css" rel="stylesheet">
    <link href="assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="assets/vendor/aos/aos.css" rel="stylesheet">  
    
    <link href="assets/css/style.css" rel="stylesheet">

</head>
<body>
    <!-- ======= Header ======= -->
    <header id="header" class="fixed-top d-flex align-items-center">
        <div class="container">
            <div class="header-container d-flex align-items-center justify-content-between">
                <div class="logo">
                    <h1 class="text-light"><a href="index.php"><span><?php echo $admin["nomSociete"] ?></span></a></h1>
                </div>
                <nav id="navbar" class="navbar">
                    <ul>
                        <li><a class="nav-link scrollto active" href="#hero">Accueil</a></li>
                        <li><a class="nav-link scrollto" href="#about">A propos</a></li>
                        <li><a class="nav-link scrollto" href="#services">Services</a></li>
                        <li><a class="nav-link scrollto" href="#comments">Commentaires</a></li>

                        <li><a class="getstarted scrollto" href="#contact">Nous-Contactez</a></li>
                    </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
                </nav><!-- .navbar -->

            </div><!-- End Header Container -->
        </div>
    </header><!-- End Header -->

    <!-- ======= Hero Section ======= -->
    <section id="hero" class="d-flex align-items-center">
        <div class="container text-center position-relative" data-aos="fade-in" data-aos-delay="200">
            <h1>Bienvenue sur le site du grenier du septentrion</h1>
            <h2>Nous vous proposons des produits bio naturels de qualité supérieure</h2>
        </div>
    </section><!-- End Hero -->

     <!-- ======= About Section ======= -->
    <section id="about" class="about">
        <div class="container" data-aos="fade-up">
            <div class="row">
                <div class="col-lg-4">
                    <div class="section-title" data-aos="fade-right">
                        <h2>A PROPOS</h2>
                    </div>
                </div>    
            </div>
  
            <div class="row">
                <div class="col-lg-6 order-1 order-lg-2" data-aos="fade-left" data-aos-delay="100">
                    <?php echo '<img src="admin/imageChef/'.$admin["imgAdmin"].'" class="img-fluid"> ' ?>    
                </div>
                <div class="col-lg-6 pt-4 pt-lg-0 order-2 order-lg-1 content">
                    <p class="font-italic">
                        Le <strong>Grenier du Septentrion</strong> vous offre des produits bio naturels de qualité supérieure pouvant servir pour vos besoins personnels ou dans la fabrication des produits cosmétiques. Nous avons du miel pur sans mélange du haut du nord du Bénin, du beurre de karité bio, de la poudre de baobab pur, de la farine de Cossette d'ignagne <em>télibô</em> sans mélange.
                    </p>
                    <h5>Nos Produits</h5>
                    <ul>
                        <li><i class="icofont-check-circled"></i>Miel</li>
                        <li><i class="icofont-check-circled"></i>Cassoulet</li>
                        <li><i class="icofont-check-circled"></i>Beurre de Karité</li>
                        <li><i class="icofont-check-circled"></i>Farine de Cossette</li>
                    </ul>
                    
                </div>
            </div>
        </div>
    </section><!-- End About Section -->
  
    <!-- ======= Services Section ======= -->
    <section id="services" class="portfolio">
        <div class="container">
  
            <div class="section-title" data-aos="fade-left">
                <h2>Nos Produits</h2>
            </div>
  
            <div class="row" data-aos="fade-up" data-aos-delay="100">
                <div class="col-lg-12 d-flex justify-content-center">
                <ul id="portfolio-flters">
                    <li data-filter="*" class="filter-active">Tout</li>
                    <li data-filter=".miel">Miel</li>
                    <li data-filter=".beurreDeKarité">Beurre de karité</li>
                    <li data-filter=".cassoulet">Cassoulet</li>
                    <li data-filter=".farineDeCossette">Farine de Cossette</li>
                </ul>
                </div>
            </div>
  
            <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="200">

                <?php

                    while($resultats = $requete->fetch()){
                        echo'
                        <div class="col-lg-4 col-md-6 portfolio-item '.$resultats["categorieImg"].'">
                            <div class="portfolio-wrap">
                                <img src="admin/image/'.$resultats["image"].'" class="img-fluid" alt=""  width="400" height="400">
                                <div class="portfolio-info"> 
                                    <h4>'.typeImage($resultats["categorieImg"]).'</h4>
                                    <div class="portfolio-links">
                                        <a href="admin/image/'.$resultats["image"].'" data-gallery="portfolioGallery" class="portfolio-lightbox" title="'.typeImage($resultats["categorieImg"]).'"><i class="bx bx-plus"></i></a>
                                        <a href="servicesDetails.php" title="More Details"><i class="bx bx-link"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        ';
                    }
                ?>
  
            </div>
        </div>
    </section><!-- End Portfolio Section -->

    <!-- ======= Comments Section ======= -->
    <section id="comments" class="testimonials section-bg">
        <div class="container">
            <div>
              <div class="section-title" data-aos="fade-right">
                <h2>Ce qu'ils pensent de nous</h2>
              </div>
            </div>

            <div data-aos="fade-up" data-aos-delay="100">
                <div class="testimonials-slider swiper-container" data-aos="fade-up" data-aos-delay="100">
                    <div class="swiper-wrapper">

                        <?php
                            
                            while($resultat = $requete1->fetch()){

                                echo '
                                    <div class="swiper-slide">
                                        <div class="testimonial-item">
                                            <p>
                                                <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                                                '.$resultat["commentaire"].'
                                                <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                                            </p>
                                            <h3>'.$resultat["nom"].' '.$resultat["prenom"].'</h3>
                                            <h4 style="display:flex; justify-content:space-around;">
                                                <span><i class="bi-calendar"></i> '.$resultat["date"].'</span>
                                                <span><i class="bi-clock"></i> '.$resultat["time"].'</span>
                                            </h4>
                                        </div>
                                    </div>
                                ';

                            }
                        ?>


                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </div>
    </section><!-- End Testimonials Section -->
  
    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
        <div class="container">
            <div class="section-title">
                <h2>Nous-Contactez</h2>
            </div>

            <div data-aos="fade-up" data-aos-delay="100">
                <div class="row">
                    <div class="col-lg-6 mt-4">
                        <div class="info">
                            <i class="bi bi-geo-alt"></i>
                            <h4>Localisation:</h4>
                            <p><?php echo $admin["localisation"] ?></p>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="info w-100 mt-4">
                            <i class="bi bi-facebook"></i>
                            <h4>Facebook:</h4>
                            <p><?php echo $admin["facebook"] ?></p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 mt-4">
                        <div class="info">
                            <i class="bi bi-envelope"></i>
                            <h4>Email:</h4>
                            <p><?php echo $admin["email"] ?></p>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="info w-100 mt-4">
                            <i class="bi bi-whatsapp"></i>
                            <h4>Whatsapp:</h4>
                            <p><?php echo $admin["whatsapp"] ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- End Contact Section -->

    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
        <div class="container">
            <div class="section-title">
                <h2>Envoyer un Commentaire</h2>
            </div>

            <div data-aos="fade-up" data-aos-delay="100">

                <?php if(isset($send) && !empty($error)) { ?> <div class="alert alert-danger"><?php echo $error ?></div><?php } ?>

                <?php if(isset($send) && empty($error)) { ?> <div class="alert alert-success"><?php echo $valid ?></div><?php } ?>
                
                <form action="" method="post" role="form" class="php-email-form mt-4">
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <input type="text" name="name" class="form-control" id="name" placeholder="Nom" required>
                        </div>
                        <div class="col-md-6 form-group mt-3 mt-md-0">
                            <input type="text" class="form-control" name="prenom" id="email" placeholder="Prenom" required>
                        </div>
                    </div>
                    <div class="form-group mt-3">
                        <input type="email" class="form-control" name="email" id="subject" placeholder="Email" required>
                    </div>
                    <div class="form-group mt-3">
                        <textarea class="form-control" name="message" rows="5" placeholder="Votre Commentaire" required></textarea>
                    </div>
                    <div class="text-center"><button name="send" type="submit">Envoyer le Commentaire</button></div>
                </form>
            </div>
        </div>
    </section><!-- End Contact Section -->

    <!-- ======= Footer ======= -->
    <footer id="footer">
        <div class="">
            <div class="copyright">
                &copy;  <strong><span><?php echo $admin["nomSociete"] ?> - <?php echo date("Y") ?></span></strong>
            </div>
        </div>
    </footer><!-- End Footer -->

  
  

    <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>      
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/waypoints/jquery.waypoints.min.js"></script>
    <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="assets/vendor/venobox/venobox.min.js"></script>
    <script src="assets/vendor/owl.carousel/owl.carousel.min.js"></script>
    <script src="assets/vendor/aos/aos.js"></script>
    <script src="assets/vendor/purecounter/purecounter.js"></script>

    
    <script src="assets/js/main.js"></script>

   
   
</body>
</html>
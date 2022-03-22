<?php    
    require('admin/bdd/connexionBdd.php');

    $requete = $connexion->query("SELECT * FROM `images` WHERE etat = 1  ORDER BY moment DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Le grenier du Septentrion - Détails_Services</title>

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

  <main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>Détails de nos produits</h2>
          <ol>
            <li><a href="index.php">Home</a></li>
            <li>Détails des Produits</li>
          </ol>
        </div>

      </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= Portfolio Details Section ======= -->
    <section id="portfolio-details" class="portfolio-details">
      <div class="container">

        <div class="row gy-4">

          <div class="col-lg-8">
            <div class="portfolio-details-slider swiper-container">
              <div class="swiper-wrapper align-items-center">

              <?php

                  while($resultats = $requete->fetch()){
                      echo'
                      <div class="swiper-slide">
                        <img src="admin/image/'.$resultats["image"].'" alt="" width="400" height="400">
                      </div>
                      ';
                  }
              ?>

              </div>
              <div class="swiper-pagination"></div>
            </div>
          </div>

          <div class="col-lg-4">
            <div class="portfolio-description">
              <h2>Description de nos Produits</h2>
              <ul>
                  <li style="list-style:none;"><i class="icofont-check-circled" style="color:#faa500; font-size: 20px; padding-right: 10px;"></i>Miel</li>
              </ul>
              <p>
                <strong>
                  Du miel Bio pur, bien lourd venant du Nord-Bénin pour vos besoins personnels et autres...(2500 FCFA / litre)
                </strong>
              </p>

              <ul>
                  <li style="list-style:none;"><i class="icofont-check-circled" style="color:#faa500; font-size: 20px; padding-right: 10px;"></i>Cassoulet</li>
              </ul>
              <p>
                <strong>
                  Le cassoulet est un plat traditionnel dont la base est un ragoût de haricots blancs, longuement mijoté pour être fondant en bouche. Dans ce ragoût sont ajoutés, selon les versions, du jarret de port, de la saucisse, de l'agneau ou de la perdrix. On peut y trouver aussi de la tomate, du céleri ou de la carotte.
                </strong>
              </p>

              <ul>
                  <li style="list-style:none;"><i class="icofont-check-circled" style="color:#faa500; font-size: 20px; padding-right: 10px;"></i>Beurre de Karité</li>
              </ul>
              <p>
                <strong>
                  Naturellement riches en vitamines A, D, E, F et en acides gras éssentiels, le beurre de karité présente de multiples vertus non seulement pour les soins corporels mais également à d'autres fins. <br>
                </strong>
              </p>

              <ul>
                  <li style="list-style:none;"><i class="icofont-check-circled" style="color:#faa500; font-size: 20px; padding-right: 10px;"></i>Farine de Cossette</li>
              </ul>
              <p>
                <strong>
                  La farine de Cossette d'Igname bien tendre sans mélange pouvant aussi vous servir dans la fabrication du Wassa-Wassa. (700FCFA / mesure)
                </strong>
              </p>
            </div>
          </div>

        </div>

      </div>
    </section><!-- End Portfolio Details Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">
        <div class="">
            <div class="copyright">
                &copy;  <strong><span>Le grenier du Septentrion - <?php echo date("Y") ?></span></strong>
            </div>
        </div>
    </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/purecounter/purecounter.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>
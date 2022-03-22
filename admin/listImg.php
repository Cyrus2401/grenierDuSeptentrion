<?php    
    require('./bdd/connexionBdd.php');

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

<?php require('header.php') ?>

    <style>
        #contact{
            margin-top:50px;
        }
    </style>

    <section id="contact" class="portfolio">
        <div class="container">
  
            <div class="section-title" data-aos="fade-left">
                <h2>Images Publiées</h2>
            </div>
  
            <div class="row" data-aos="fade-up" data-aos-delay="100">
                <div class="col-lg-12 d-flex justify-content-center">
                    <ul id="portfolio-flters">
                        <li data-filter="*" class="filter-active">Tout</li>
                        <li data-filter=".miel">Miel</li>
                        <li data-filter=".cassoulet">Cassoulet</li>
                        <li data-filter=".beurreDeKarité">Beurre de karité</li>
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
                                <img src="image/'.$resultats["image"].'" class="img-fluid" alt=""s>
                                <div class="portfolio-info"> 
                                    <h4>'.typeImage($resultats["categorieImg"]).'</h4>
                                    <div class="portfolio-links">
                                        <a href="image/'.$resultats["image"].'" data-gallery="portfolioGallery" class="portfolio-lightbox" title="'.typeImage($resultats["categorieImg"]).'"><i class="bx bx-plus"></i></a>
                                        <a href="deleteImg.php?image='.$resultats["id_image"].'"><i class="bi-trash"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        ';
                    }
                ?>

            </div>
        </div>
    </section>


<?php require('footer.php') ?>
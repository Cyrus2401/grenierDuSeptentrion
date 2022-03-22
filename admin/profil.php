<?php require("header.php") ?>
<style>
    .contact{
        margin-top:50px;
    }
    .info p{ 
        margin:3em; 
    }
    .info .title{
        font-size:1.5em;
        font-weight:bold;
    }
    .info img{
        margin-top:1em;
        width:50%;
    }
    .infoResult{
        font-size:1.2em;
        color:#faa500;
        
    }
</style>

    <section class="contact">
        <div class="container">
            <div class="section-title">
                <h2>Profil de la Société</h2>
            </div>

            <div data-aos="fade-up" data-aos-delay="100">
                <?php    
                    require('./bdd/connexionBdd.php');

                    $requete = $connexion->query("SELECT * FROM `admin` ");
                    
                    $resultats = $requete->fetch()

                ?>

                <div class="info">
                    <p>
                        <span class="title">Nom de la société :</span> 
                        <span class="infoResult"><?php echo $resultats["nomSociete"] ?></span>
                    </p>
                    <p>
                        <span class="title">Localisation de la société : </span>
                        <span class="infoResult"><?php echo $resultats["localisation"] ?></span>
                    </p>
                    <p>
                        <span class="title">Page Facebook de la société : </span>
                        <span class="infoResult"><?php echo $resultats["facebook"] ?></span>
                    </p>
                    <p>
                        <span class="title">Numéro Whatsapp de la société : </span>
                        <span class="infoResult"><?php echo $resultats["whatsapp"] ?></span>
                    </p>
                    <p>
                        <span class="title">Email de la société : </span>
                        <span class="infoResult"><?php echo $resultats["email"] ?></span>
                    </p>
                    <p>
                        <span class="title">Image : </span><br>
                        <?php echo '<img src="./imageChef/'.$resultats["imgAdmin"].' "> ' ?>
                    </p>
                    
                </div>
            </div>
        </div>
    </section>

    <?php require("footer.php") ?>
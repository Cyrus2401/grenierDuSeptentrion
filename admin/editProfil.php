<?php
    // fonction pour vérifier les input 
    function verifyInput($var){
        $var = htmlspecialchars($var);
        $var = trim($var);
        $var = stripslashes($var);
        return $var;
    }

    @$nom = verifyInput($_POST['nom']);
    @$localisation = verifyInput($_POST['localisation']);
    @$pageFb = verifyInput($_POST['pageFb']);
    @$whatsapp = verifyInput($_POST['whatsapp']);
    @$email = verifyInput($_POST['email']);
    @$edit = $_POST['edit'];

    $error = "";
    $valid = "";

    if(isset($edit) && isset($_FILES['image'])){
        if(empty($nom) || empty($localisation) || empty($pageFb) || empty($whatsapp)  || empty($email)){
            $error = "Champ laissé Vide !";
        }

        //Variables de stockage de l'image
        $image = $_FILES['image']['tmp_name'];
        $name = $_FILES['image']['name'];
        $size = $_FILES['image']['size'];
        $imageError = $_FILES['image']['error'];
        $type = $_FILES['image']['type'];

        //Afficher l'extension de l'image
        $tab_extension = explode('.', $name);
        $extension = strtolower(end($tab_extension));

        //tableau des extensions autorisees
        $extensions_autorisees = ['png','jpg','jpeg'];
        $taile_max = 10000000;

        /* gestion de l'image */
        if(in_array($extension, $extensions_autorisees) && $size <= $taile_max && $imageError == 0){
            if(empty($error)){
                $name_unique = uniqid('',true);
                $fileName = $name_unique.'.'.$extension;

                move_uploaded_file($image, "./imageChef/".$fileName);

                require('./bdd/connexionBdd.php');

                $requete = $connexion -> prepare("UPDATE admin SET nomSociete =:nomSociete, localisation=:localisation, facebook=:facebook, whatsapp=:whatsapp, email=:email, imgAdmin=:imgAdmin");
                    
                $requete->bindValue(':nomSociete', $nom, PDO::PARAM_STR);
                $requete->bindValue(':localisation', $localisation, PDO::PARAM_STR);
                $requete->bindValue(':facebook', $pageFb, PDO::PARAM_STR);
                $requete->bindValue(':whatsapp', $whatsapp, PDO::PARAM_STR); 
                $requete->bindValue(':email', $email, PDO::PARAM_STR); 
                $requete->bindValue(':imgAdmin', $fileName, PDO::PARAM_STR);

                $executeIsOk = $requete->execute();
                
                if($executeIsOk)
                    $valid = "Modification effectuée avec succès ";
                else    
                    $error = "Echec de la mise à jour"; 
            }
        }
        else
        {
            $error = "Veuiller choisir une image qui ne pèse pas plus de 10Mo!";
        }
    }
?>
<?php require("header.php") ?>

    <style>
        .contact{
            margin-top:50px;
        }
    </style>

    <div class="containerInfo">
    
        <?php    
            require('./bdd/connexionBdd.php');
            
            $requete = $connexion->query("SELECT * FROM `admin` ");
            
            $resultats = $requete->fetch()
        ?>

        <section class="contact">
            <div class="container">
                <div class="section-title">
                    <h2>Modifier le Profil</h2>
                </div>

                <div data-aos="fade-up" data-aos-delay="100">
                    <?php if(isset($edit) && empty($error)) { ?> <div class="alert alert-success"><?php echo $valid ?></div><?php }  ?>
                    
                    <?php if(isset($edit) && !empty($error)) { ?> <div class="alert alert-danger"><?php echo $error ?></div><?php } ?>
                    <form method="post" role="form" class="php-email-form mt-4" enctype="multipart/form-data">
                        
                        <div class="form-group mt-3">
                            <input type="text" value="<?php echo $resultats["nomSociete"] ?>" name="nom" class="form-control" id="name" placeholder="Nom de la Société" required>
                        </div>
                        <div class="form-group mt-3">
                            <input type="text" value="<?php echo $resultats["localisation"] ?>" class="form-control" name="localisation" id="email" placeholder="Localisation de la Société" required>
                        </div>
                        <div class="form-group mt-3">
                            <input type="text" value="<?php echo $resultats["facebook"] ?>" class="form-control" name="pageFb" id="email" placeholder="Page Facebook de la Société" required>
                        </div>
                        <div class="form-group mt-3">
                            <input value="<?php echo $resultats["whatsapp"] ?>" type="tel" class="form-control" name="whatsapp" id="email" placeholder="Numéro Whatsapp de la Société" required>
                        </div>
                        <div class="form-group mt-3">
                            <input value="<?php echo $resultats["email"] ?>" type="email" class="form-control" name="email" id="subject" placeholder="Email de la Société" required>
                        </div>
                        <div class="form-group mt-3">
                            <input name="image" type="file" class="form-control" required>
                        </div>
                        
                        <div class="text-center"><button name="edit" type="submit">Modifier le Profil</button></div>
                    </form>
                </div>
            </div>
        </section>
    </div>

<?php require("footer.php") ?>
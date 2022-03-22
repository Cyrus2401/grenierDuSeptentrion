<?php require('header.php') ?>

    <?php
        @$categorieImg = $_POST['categorieImg'];
        @$add = $_POST['add'];

        $error = "";
        $valid = "";

        if(isset($add) && isset($_FILES['image'])){
            if(empty($categorieImg)){
                $error = "Veuiller choisir une catégorie de l'image";
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

                    move_uploaded_file($image, "./image/".$fileName);

                    require('./bdd/connexionBdd.php');

                    $requete1 = $connexion->prepare("SELECT * FROM images WHERE nomImg=? and categorieImg=? and etat=1");
                    $requete1 ->execute(array($name, $categorieImg));
                    $verifyRequete1 = $requete1->rowCount();

                    if($verifyRequete1 == 1){
                        $error = "Cette image a déjà été enregistré !";
                    }
                    else{
                        $requete = $connexion -> prepare("INSERT INTO images(nomImg, image, categorieImg, moment) VALUES (?,?,?, now())");
            
                        $requete -> execute(array($name, $fileName, $categorieImg)); 
                        $valid = "Une nouvelle image a été ajouté avec success !";
                    }
                }
            }
            else
            {
                $error = "Veuiller choisir une image qui ne pèse pas plus de 10Mo!";
            }
        }
    ?>

    <style>
        .contact{
            margin-top:50px;
        }
    </style>

    <section class="contact">
        <div class="container">
            <div class="section-title">
                <h2>Ajouter une Image</h2>
            </div>

            <div data-aos="fade-up" data-aos-delay="100">
                <?php if(isset($add) && empty($error)) { ?> <div class="alert alert-success"><?php echo $valid ?></div><?php }  ?>
                
                <?php if(isset($add) && !empty($error)) { ?> <div class="alert alert-danger"><?php echo $error ?></div><?php } ?>
                <form method="post" role="form" class="php-email-form mt-4" enctype="multipart/form-data">
                    
                    <div class="form-group mt-3">
                        <select name="categorieImg" id="" class="form-select" >
                            <option value="">Catégorie de l'Image</option>
                            <option value="miel">Miel</option>
                            <option value="cassoulet">Cassoulet</option>
                            <option value="beurreDeKarité">Beurre de Karité</option>
                            <option value="farineDeCossette">Farine de Cossette</option>
                        </select>
                    </div>
                    <div class="form-group mt-3">
                        <input name="image" type="file" class="form-control" >
                    </div>
                    
                    <div class="text-center"><button name="add" type="submit">Ajouter une Image</button></div>
                </form>
            </div>
        </div>
    </section>

<?php require('footer.php') ?>
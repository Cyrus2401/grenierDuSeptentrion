<?php 
        @$idImage = $_POST['idImage'];
        @$deleteImage = $_POST['deleteImage'];

        $error = "";
        $valid = "";

        if(isset($deleteImage)){
            require('./bdd/connexionBdd.php');

            $requete = $connexion -> prepare("UPDATE images SET etat = 0 WHERE id_image =:num LIMIT 1");
            $requete->bindValue(':num', $_POST['idImage'], PDO::PARAM_INT);

            $executeIsOk = $requete->execute();

            if($executeIsOk){  
                header('Location:listImg.php');
            }    
        }


    ?>

<?php require("header.php") ?>

<style>
    #container{
        margin-top: 100px;
        position: absolute;
        top:40%;
        left:50%;
        transform:translate(-50%, -50%);
    }
    p{
        display:flex;
        justify-content:space-around;
    }
</style>

    <?php
        require('./bdd/connexionBdd.php');

        $requete = $connexion->prepare("SELECT * FROM `images` WHERE id_image = :num");

        $requete->bindValue(':num', $_GET['image'], PDO::PARAM_INT);

        $executeIsOk = $requete->execute();

        $commentaire = $requete->fetch();   

    ?>
    <div id="container" data-aos="fade-up" data-aos-delay="100">
        <form method="POST" class="form formDelete">   
            <div>
                <label class="form-label mb-3">Voulez-vous vraiment supprimer cette image ?</label>
                
                <p>
                    <input type="hidden" name="idImage" value="<?php echo $commentaire['id_image']; ?>">
                    <button  name="deleteImage" type="submit" class="btn btn-danger">Supprimer</button> 
                    <a href="listImg.php" type="button" class="btn btn-primary">Annuler</a>
                </p>
            </div>
        </form>
    </div>  

<?php require("footer.php"); ?>
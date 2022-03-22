<?php 
        @$idComment = $_POST['idComment'];
        @$deleteComment = $_POST['deleteComment'];

        $error = "";
        $valid = "";

        if(isset($deleteComment)){
            require('./bdd/connexionBdd.php');

            $requete = $connexion -> prepare("UPDATE commentaires SET etatAdmin = 0 and etatUser = 0 WHERE id_comment =:num LIMIT 1");
            $requete->bindValue(':num', $_POST['idComment'], PDO::PARAM_INT);

            $executeIsOk = $requete->execute();

            if($executeIsOk){  
                header('Location:comments.php');
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

        $requete = $connexion->prepare("SELECT * FROM `commentaires` WHERE id_comment = :num");

        $requete->bindValue(':num', $_GET['commentaire'], PDO::PARAM_INT);

        $executeIsOk = $requete->execute();

        $commentaire = $requete->fetch();   

    ?>
    <div id="container" data-aos="fade-up" data-aos-delay="100">
        <form method="POST" class="form formDelete">   
            <div>
                <label class="form-label mb-3">Voulez-vous vraiment supprimer ce commentaire ?</label>
                
                <p>
                    <input type="hidden" name="idComment" value="<?php echo $commentaire['id_comment']; ?>">
                    <button  name="deleteComment" type="submit" class="btn btn-danger">Supprimer</button> 
                    <a href="comments.php" type="button" class="btn btn-primary">Annuler</a>
                </p>
            </div>
        </form>
    </div>  

<?php require("footer.php"); ?>
<?php
    require('./bdd/connexionBdd.php');

    $requete = $connexion->query("SELECT * FROM `commentaires` WHERE etatAdmin = 1 and etatUser = 0 ORDER BY date, time DESC");
?>    

<?php require('header.php') ?>

    <style>
        .contact{
            margin-top:50px;
        }
        .testimonial-item {
            box-sizing: content-box;
            padding: 30px 30px 0 30px;
            margin: 30px 15px;
            text-align: center;
            min-height: 350px;
            box-shadow: 0px 2px 12px rgba(0, 0, 0, 0.08);
            background: #fff;
        }
        .testimonial-item .testimonial-img {
            width: 90px;
            border-radius: 50%;
            border: 4px solid #fff;
            margin: 0 auto;
        }
        .testimonial-item h3 {
            font-size: 18px;
            font-weight: bold;
            margin: 10px 0 5px 0;
            color: #111;
        }
        .testimonial-item h4 {
            font-size: 14px;
            color: #999;
            margin: 0;
        }
        .testimonial-item .quote-icon-left,  .testimonial-item .quote-icon-right {
            color: #faa500;
            font-size: 26px;
        }
        .testimonial-item .quote-icon-left {
            display: inline-block;
            left: -5px;
            position: relative;
        }
        .testimonial-item .quote-icon-right {
            display: inline-block;
            right: -5px;
            position: relative;
            top: 10px;
        }
        .testimonial-item p {
            font-style: italic;
            margin: 0 auto 15px auto;
        }
        form{
            display:flex;
            justify-content:space-around;
        }
    </style>

    <section class="contact">
        <div class="container">
            <div class="section-title">
                <h2>Les Nouveaux Commentaires</h2>
            </div>

            <div id="divContainer" class="row">
                <?php    
                    
                    while($resultats = $requete->fetch()){
                        echo'
                            <div class="testimonial-item col-xs-4 col-sm-3 col-md-3">
                                <p>
                                    <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                                    '.$resultats["commentaire"].'
                                    <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                                </p>
                                <img src="assets/img/testimonials/testimonials-4.jpg" class="testimonial-img" alt="">
                                <h3>'.$resultats["nom"].' '.$resultats["prenom"].'</h3>
                                <form action="post">
                                    <h4><a href="publierComment.php?commentaire='.$resultats["id_comment"].'" type="submit" name="delete">Publier</a></h4>
                                    <h4><a href="deleteComment.php?commentaire='.$resultats["id_comment"].'" type="submit" name="delete">Supprimer</a></h4>
                                </form>
                            </div>

                        ';
                    }
                ?>
            </div>
    </section>

<?php require('footer.php') ?>
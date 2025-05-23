<?php 
            include_once "connexion.php";
            if(isset($_POST['button'])){
                extract($_POST);

                if(!empty($_POST['numero']) && !empty($_POST['nom']) && !empty($_POST['jours']) && !empty($_POST['tarif'])){
                    $req = mysqli_query($conn, "INSERT INTO visiteur VALUE('$numero', '$nom', '$jours', '$tarif')");
                    if($req){
                        header("Location: affichage.php");
                    }
                    else($message = "Visiteur non ajouter");
                }
                else{
                    $message = "Le visiteur a déjà été ajouter ou un champ n'a pas été rempli";
                }
            }
        ?>
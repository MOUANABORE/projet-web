<?php
    $bdd = new PDO('mysql:host=localhost;dbname=lego;charset=utf8', 'root', '');

    function SommeTotal($bdd){
        if($bdd){
            $req =$bdd-> query("SELECT SUM(montant) AS total FROM nouveau_liste");
            $donnees = $req->fetch();
            return $donnees['total'];                   
        }
    } 

    function categorieDisplay($bdd){
        if($bdd){
            $req =$bdd-> query("SELECT categorie AS categorie FROM nouveau_cas WHERE id=2");
            $donnees = $req->fetch();
            return $donnees['categorie'];                    
        }
    }
    
    function displayName($bdd){
        if($bdd){
            $req =$bdd-> query("SELECT nom, prenom FROM nouveau_cas WHERE id=2");
            $donnees = $req->fetch();
            return
             $donnees['nom']. " " .$donnees['prenom'];
             ;                   
        }
    }

    
    function displayAdmin($bdd){
        $email = "mouanabore78@gmail.com";
        $passe = "123456";
        $req =$bdd-> prepare("SELECT nom FROM administrateurs WHERE email=? AND pass=?");
        $req ->execute(array($email, $passe));
        if($req->rowCount() > 0)
            {
                $donnees = $req->fetch();
                return $donnees['nom'];
            }
        else
        $req ->closeCursor();
       
    } 
?>


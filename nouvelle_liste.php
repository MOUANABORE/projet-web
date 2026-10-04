<?php

    try{
        $bdd = new PDO("mysql:host=localhost;dbname=lego;charset=utf8", "root", "");
        if(isset($_POST['Envoyer'])){
        if(!empty($_POST['nom']) AND !empty($_POST['prenom']) AND !empty($_POST['somme']) AND !empty($_POST['nom_et_prenom'])){
            $nom = htmlspecialchars($_POST['nom']);
            $prenom = htmlspecialchars($_POST['prenom']);
            $somme = htmlspecialchars($_POST['somme']);
            $nom_et_prenom = htmlspecialchars($_POST['nom_et_prenom']);
            
                $req = $bdd->prepare("INSERT INTO nouveau_liste(nom,prenom, montant, nom_et_prenom) VALUES(?, ?, ?, ?)");
                $req->execute(array($nom, $prenom, $somme, $nom_et_prenom));
                header('Location: index.php');
            }
        }
    
    }
    catch(PDOException $e)
    {
        die("Erreur: " . $e->getMessage());
    }
?>



<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="bootstrap-icons-1.13.1/bootstrap-icons-1.13.1/bootstrap-icons.css">
    <style type="text/css">
        .sidebar{
          min-height: 100vh;
          position: fixed;
        }

        .sidebar h3{
          color: white;
          margin: 1.6rem;
        }
        i{
          padding: 10px;
        }

        .sidebar a{
          text-decoration: none;
          display: flex;
          color: #fff;
          align-items: center;
          padding: 10px 15px;
        }

        .sidebar a:hover, .sidebar a.active{
          background: rgba(22, 6, 82, 0.575);
          color: white;
        }

        .card:hover{
          background: #054164;
          transform: translateY(-10px);
          transition: .5s ease;
          color: white;
        }

    </style>
    <title>Document</title>
</head>
<body>
  <div class="container-fluid">
    <div class="row">
      <nav class="col-md-3 col-lg-2 d-md-block bg-primary sidebar">
        <h3 class="fw-bold">LEGO</h3>
        <a href="index.php"><i class="bi bi-house-fill"></i>Accueil</a>
        <a href="recherche.php"><i class="bi bi-folder2"></i>Nouveau cas</a>
        <a href="nouvelle_liste.php"><i class="bi bi-list-task"></i>Nouvelle liste</a>
        <a href="consulter_liste.php"><i class="bi bi-list-check"></i>Consulter les listes</a>
        <a href="caisse.php"><i class="bi bi-coin"></i>Caisse</a>
        <a href="connexion.php"><i class="bi bi-box-arrow-right"></i>Se déconnecter</a>

        <span class="mt-5 ms-3 bg-danger p-2 text-white rounded-2">
            <?php
              require('function.php');
              $profil = displayAdmin($bdd);
              echo "Admin: ".$profil;
            ?>
        </span> 
        
      </nav>

      <main class="col-md-9 col-lg-10 ms-sm-auto px-dm-0 py-4">
        <h1 class="mb-4 text-center">Contribution du membre</h1>

        <div class="row g-4 d-flex justify-content-center"> 
            <div class="col-sm-6">       
                <form action="" method="POST">
                    <fieldset>
                    <div class="mb-3">
                        <label for="nom" class="form-label">Nom</label>
                        <input type="text" class="form-control" id="nom" name="nom" placeholder="Saisir votre nom..." autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <label for="prenom" class="form-label">Prénom</label>
                        <input type="text" class="form-control" id="prenom" name="prenom" placeholder="Saisir votre prénom..." autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <label for="somme" class="form-label">Somme</label>
                        <input type="number" class="form-control" id="somme" name="somme" placeholder="Saisir la montant..." autocomplete="off">
                    </div>

                    <div class="mb-3">
                            <label class="form-label">Date</label>
                            <input type="date" class="form-control" id="date" required>
                        </div>

                    <div class="mb-3">
                        <label for="nom" class="form-label">Pour soutenir:</label>
                        <input type="text" class="form-control" id="nom" name="nom_et_prenom" placeholder="Nom et prénom de la personne éprouvée..." autocomplete="off">
                    </div>
                    <input type="submit" value="Envoyer" name="Envoyer" class="btn btn-primary">
                    <button type="button" class="btn btn-success"><a href="liste.php" class="text-decoration-none text-white">Voir la liste</a></button>
                    </fieldset>
                </form>

            </div>
        </div>
      </main>
    </div>

  </div>
    
    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>
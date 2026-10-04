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
          <h1 class="mb-3 text-center">Administration de LEGO</h1>
          <div class="d-flex justify-content-between">
              <h3 class="fw-semibold my-4"> 
                <?php
                  $nom = displayName($bdd);
                  echo "Contribution pour: ".$nom;
                ?>
              </h3>
              <span class="my-4 bg-danger p-2 text-white rounded-2">
                <?php
                  $categorie = categorieDisplay($bdd);
                  echo "Catégorie: ".$categorie;
                ?>
              </span>
          </div>
          <div class="table-responsive">
            <?php
              try{
                  $bdd = new PDO('mysql:host=localhost;dbname=lego;charset=utf8', 'root', '');
                  $req = $bdd->query('SELECT id, nom, prenom, montant FROM nouveau_liste');

                      ?>
                     <div class="table-responsive">
                       <table class="table table-striped">
                         <thead class="table-dark">
                           <tr>
                             <th>N°</th>
                             <th>Nom</th>
                             <th>Prénom</th>
                             <th>Montant</th>
                           </tr>
                         </thead>
                          <tbody>
                           <?php while($donnees = $req->fetch()){
                               ?>
                                 <tr>
                                   <td><?php echo $donnees['id']; ?></td>
                                   <td><?php echo $donnees['nom']; ?></td>
                                   <td><?php echo $donnees['prenom'] ;?></td>
                                   <td><?php echo $donnees['montant'];?></td>
                                 </tr>
                               <?php
                           }  
                           ?>                    
                           </tbody>    
                       </table>
                     </div>  
                      <?php
                }
               catch(Exception $e)
                {
                  // En cas d'erreur précédemment, on affiche un message et on arrête tout
                  die('Erreur : '.$e->getMessage());
                }
            ?>
          </div>

          <small class="bg-success mt-2 p-2 text-white">
            <?php
              $totalSomme = SommeTotal($bdd);
              echo "Somme totale: ".$totalSomme. " FCFA";
            ?>
          </small>
      </main>

    </div>
  </div>
    
    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>
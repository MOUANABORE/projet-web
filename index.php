<?php
  
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
        
            <h1 class="mb-4 text-center">Administration de LEGO</h1>
        <div class="row g-4 mb-4">
            <div class="col-sm-6 col-lg-3 d-flex">
                <div class="card">
                  <div class="card-body">
                    <div class="card-title fw-bold text-primary"><i class="bi bi-sign-dead-end-fill"></i>Décès</div>
                    <p>Tout membre du groupe se doit de soutenir un autre membre ayant perdu un parent direct (Papa ou Maman).</p>
                    <span class="badge bg-dark">A partir de 2000 FCFA</span>
                  </div>
                </div>
            </div>

            <div class="col-sm-6 col-lg-3 d-flex">
                <div class="card">
                  <div class="card-body">
                    <div class="card-title fw-bold text-primary"><i class="bi bi-brightness-alt-high-fill"></i>Nouvelle naissance</div>
                    <p>Tout membre du groupe se doit de soutenir un autre membre dans le cas d'une
                      nouvelle naissance.
                    </p>
                    <span class="badge bg-dark">A partir de 2500 FCFA</span>
                  </div>
                </div>
            </div>

            <div class="col-sm-6 col-lg-3 d-flex">
                <div class="card">
                  <div class="card-body">
                    <div class="card-title fw-bold text-primary"><i class="bi bi-person-fill-lock"></i>Cas de maladie</div>
                    <p>Tout membre du groupe se doit de soutenir un autre membre dans le cas d'une
                      maladie touchant sa santé.</p>
                    <span class="badge bg-dark">Indéfini</span>
                  </div>
                </div>
            </div>

            <div class="col-sm-6 col-lg-3 d-flex">
                <div class="card">
                  <div class="card-body">
                    <div class="card-title fw-bold text-primary"><i class="bi bi-forward-fill"></i>Urgence</div>
                    <p>Tout membre du groupe se doit de soutenir un autre membre se trouvant
                      dans un cas d'Urgence.</p>
                    <span class="badge bg-dark">Indéfini</span>
                  </div>
                </div>
            </div>
        </div>           
        </div>
      </main>
    </div>

  </div>
    
    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>
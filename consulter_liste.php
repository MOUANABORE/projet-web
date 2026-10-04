<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="bootstrap-icons-1.13.1/bootstrap-icons-1.13.1/bootstrap-icons.css">
    <style type="text/css">
      .search-box {
            background: #f8f9fa;
            padding: 30px;
            border-radius: 10px;
            margin-bottom: 30px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .form-group {
            display: flex;
            gap: 15px;
            align-items: center;
            justify-content: center;
            flex-wrap: wrap;
        }

        label {
            font-size: 18px;
            font-weight: bold;
            color: #555;
        }

        input[type="text"] {
            flex: 1;
            min-width: 250px;
            padding: 12px 20px;
            font-size: 16px;
            border: 2px solid #ddd;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        input[type="text"]:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 10px rgba(102,126,234,0.3);
        }

        button {
            padding: 12px 30px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        button:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(0,0,0,0.2);
        }

        .results {
            margin-top: 30px;
        }

        .results h2 {
            color: #333;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 3px solid #667eea;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 15px rgba(0,0,0,0.1);
        }

        th {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 15px;
            text-align: left;
            font-weight: bold;
        }

        td {
            padding: 12px 15px;
            border-bottom: 1px solid #eee;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        .no-result {
            text-align: center;
            padding: 40px;
            background: #fff3cd;
            border: 1px solid #ffc107;
            border-radius: 8px;
            color: #856404;
            font-size: 18px;
        }

        .message {
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            text-align: center;
        }

        .message.error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .stats {
            margin-top: 20px;
            padding: 10px;
            background: #e7f3ff;
            border-radius: 8px;
            text-align: center;
            color: #004085;
        }

        @media (max-width: 768px) {
            .container {
                padding: 15px;
            }
            
            th, td {
                padding: 8px 10px;
                font-size: 14px;
            }
            
            h1 {
                font-size: 1.8em;
            }
        }
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
        <h1>Recherche dans la base LEGO</h1>
        
        <div class="search-box">
            <form method="GET" action="">
                <div class="form-group">
                    <label for="nom">Nom à rechercher :</label>
                    <input type="text" 
                           name="nom" 
                           id="nom" 
                           placeholder="Entrez le nom à rechercher..."
                           value="<?= isset($_GET['nom']) ? htmlspecialchars($_GET['nom']) : '' ?>"
                           autocomplete="off">
                    <button type="submit">🔍 Rechercher</button>
                </div>
            </form>
        </div>

        <div class="results">
            <?php
              $bdd = new PDO("mysql:host=localhost;dbname=lego;charset=utf8", "root", "");
            // Vérifier si un nom a été soumis
            if (isset($_GET['nom']) && !empty(trim($_GET['nom']))) {
                $nom_recherche = trim($_GET['nom']);
                
                // Requête préparée pour éviter les injections SQL
                $sql = "SELECT * FROM nouveau_cas WHERE nom = :nom";
                $req = $bdd->prepare($sql);
                $req->execute([':nom' => $nom_recherche]);
                
                // Compter le nombre de résultats
                $count = $req->rowCount();
                
                if ($count > 0) {
                    echo "<h2>📋 Résultats pour : " . htmlspecialchars($nom_recherche) . "</h2>";
                    echo "<div class='stats'>✅ " . $count . " résultat(s) trouvé(s)</div>";
                    ?>
                    
                    <table class="table">
                        <thead class="table-dark">
                            <tr>
                                <th>Nom</th>
                                <th>Prénom</th>
                                <th>Catégorie</th>
                                <th>Année</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($result = $req->fetch(PDO::FETCH_ASSOC)): ?>
                            <tr>
                                <td><?= htmlspecialchars($result['nom']) ?></td>
                                <td><?= htmlspecialchars($result['prenom']) ?></td>
                                <td><?= htmlspecialchars($result['categorie']) ?></td>
                                <td><?= htmlspecialchars($result['Annee']) ?></td>
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                    
                    <?php
                } else {
                    echo "<div class='no-result'>";
                    echo "❌ Aucun résultat trouvé pour le nom : <strong>" . htmlspecialchars($nom_recherche) . "</strong>";
                    echo "<br><br>Veuillez vérifier l'orthographe ou essayer un autre nom.";
                    echo "</div>";
                }
            } elseif (isset($_GET['nom']) && empty($_GET['nom'])) {
                echo "<div class='message error'>⚠️ Veuillez saisir un nom à rechercher.</div>";
            } else {
                // Afficher un message d'accueil avec quelques exemples
                ?>
                
                <?php
                
                // Optionnel: Afficher les 5 derniers enregistrements
                $preview = $bdd->query("SELECT * FROM nouveau_cas LIMIT 10");
                if ($preview->rowCount() > 0) {
                    echo "<h3 style='margin-top: 30px;'>📌 Aperçu des derniers enregistrements :</h3>";
                    ?>
                    <table class="table">
                        <thead class="table-dark">
                            <tr>
                                <th>Nom</th>
                                <th>Prénom</th>
                                <th>Catégorie</th>
                                <th>Année</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = $preview->fetch()): ?>
                            <tr>
                                <td><?= htmlspecialchars($row['nom']) ?></td>
                                <td><?= htmlspecialchars($row['prenom']) ?></td>
                                <td><?= htmlspecialchars($row['categorie']) ?></td>
                                <td><?= htmlspecialchars($row['Annee']) ?></td>
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                    <?php
                }
            }
            ?>
        </div>
      </main>
    </div>

  </div>
    
    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>
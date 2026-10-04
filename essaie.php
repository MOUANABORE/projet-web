<?php
// Connexion à la base de données
$bdd = new PDO('mysql:host=localhost;dbname=LEGO;charset=utf8', 'root', '');
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recherche dans la base LEGO</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            border-radius: 15px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            overflow: hidden;
            padding: 30px;
        }

        h1 {
            color: #333;
            text-align: center;
            margin-bottom: 30px;
            font-size: 2.5em;
        }

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
    </style>
</head>
<body>
    <div class="container">
        <h1>🔍 Recherche dans la base LEGO</h1>
        
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
            // Vérifier si un nom a été soumis
            if (isset($_GET['nom']) && !empty(trim($_GET['nom']))) {
                $nom_recherche = trim($_GET['nom']);
                
                // Requête préparée pour éviter les injections SQL
                $sql = "SELECT * FROM nouvelle_liste WHERE nom = :nom";
                $req = $bdd->prepare($sql);
                $req->execute([':nom' => $nom_recherche]);
                
                // Compter le nombre de résultats
                $count = $req->rowCount();
                
                if ($count > 0) {
                    echo "<h2>📋 Résultats pour : " . htmlspecialchars($nom_recherche) . "</h2>";
                    echo "<div class='stats'>✅ " . $count . " résultat(s) trouvé(s)</div>";
                    ?>
                    
                    <table>
                        <thead>
                            <tr>
                                <th>Nom</th>
                                <th>Prénom</th>
                                <th>Montant</th>
                                <th>Cas</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($result = $req->fetch(PDO::FETCH_ASSOC)): ?>
                            <tr>
                                <td><?= htmlspecialchars($result['nom']) ?></td>
                                <td><?= htmlspecialchars($result['prenom']) ?></td>
                                <td style="color: #28a745; font-weight: bold;">
                                    <?= number_format($result['montant'], 0, ',', ' ') ?> €
                                </td>
                                <td><?= htmlspecialchars($result['cas']) ?></td>
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
                <div class="no-result" style="background: #e7f3ff; border-color: #004085;">
                    <h3>💡 Comment utiliser la recherche ?</h3>
                    <p>Entrez un nom dans le champ ci-dessus et cliquez sur "Rechercher" pour voir les informations correspondantes.</p>
                    <p style="margin-top: 15px;">La recherche est exacte (sensible à la casse). Assurez-vous d'écrire le nom correctement.</p>
                </div>
                <?php
                
                // Optionnel: Afficher les 5 derniers enregistrements
                $preview = $bdd->query("SELECT * FROM nouvelle_liste LIMIT 5");
                if ($preview->rowCount() > 0) {
                    echo "<h3 style='margin-top: 30px;'>📌 Aperçu des derniers enregistrements :</h3>";
                    ?>
                    <table>
                        <thead>
                            <tr>
                                <th>Nom</th>
                                <th>Prénom</th>
                                <th>Montant</th>
                                <th>Cas</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = $preview->fetch()): ?>
                            <tr>
                                <td><?= htmlspecialchars($row['nom']) ?></td>
                                <td><?= htmlspecialchars($row['prenom']) ?></td>
                                <td><?= number_format($row['montant'], 0, ',', ' ') ?> €</td>
                                <td><?= htmlspecialchars($row['cas']) ?></td>
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                    <?php
                }
            }
            ?>
        </div>
    </div>
</body>
</html>

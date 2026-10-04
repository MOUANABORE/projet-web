<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="bootstrap-icons-1.13.1/bootstrap-icons-1.13.1/bootstrap-icons.css">
    <style type="text/css">
       /* Main content */
        .main-content {
            margin-left: 260px;
            padding: 20px;
        }

        /* Stats cards */
        .stat-card {
            background: white;
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            transition: transform 0.3s;
            margin-bottom: 20px;
        }

        .stat-card:hover {
            transform: translateY(-5px);
        }

        .stat-icon {
            font-size: 2.5rem;
            color: #667eea;
        }

        .stat-value {
            font-size: 1.8rem;
            font-weight: bold;
            color: #333;
        }

        .stat-label {
            color: #666;
            font-size: 0.9rem;
        }

        /* Cards */
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
            margin-bottom: 20px;
        }

        .card-header {
            background: white;
            border-bottom: 2px solid #f0f0f0;
            border-radius: 15px 15px 0 0 !important;
            padding: 15px 20px;
            font-weight: 600;
        }

        /* Table */
        .table {
            margin-bottom: 0;
        }

        .table th {
            border-top: none;
            font-weight: 600;
            color: #555;
        }

        .badge-success {
            background: #10b981;
            color: white;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.8rem;
        }

        .badge-danger {
            background: #ef4444;
            color: white;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.8rem;
        }

        .badge-warning {
            background: #f59e0b;
            color: white;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.8rem;
        }

        .btn-primary-custom {
            background: #667eea;
            border: none;
            border-radius: 10px;
            padding: 10px 20px;
            transition: all 0.3s;
        }

        .btn-primary-custom:hover {
            background: #5a67d8;
            transform: translateY(-2px);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                margin-left: -260px;
            }
            .sidebar.active {
                margin-left: 0;
            }
            .main-content {
                margin-left: 0;
            }
            .stat-value {
                font-size: 1.4rem;
            }
        }

        /* Animation */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .fade-in {
            animation: fadeIn 0.5s ease-out;
        }

        /* Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }
        ::-webkit-scrollbar-thumb {
            background: #667eea;
            border-radius: 4px;
        }
        /*-----------------------------------------*/
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
          transform: translateY(-10px);
          transition: .5s ease;
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
        <div class="row fade-in">
        <div class="col-md-3">
            <div class="stat-card">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="stat-value">2.450.000 <small>FCFA</small></div>
                        <div class="stat-label">Solde actuel</div>
                    </div>
                    <div class="stat-icon">
                        <i class="bi bi-wallet2"></i>
                    </div>
                </div>
                <div class="mt-2 small text-success">
                    <i class="bi bi-arrow-up"></i> +12.5% ce mois
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="stat-value">350.000 <small>FCFA</small></div>
                        <div class="stat-label">Cotisations (mai)</div>
                    </div>
                    <div class="stat-icon">
                        <i class="bi bi-graph-up"></i>
                    </div>
                </div>
                <div class="mt-2 small text-success">
                    <i class="bi bi-check-circle"></i> 28/35 membres
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="stat-value">180.000 <small>FCFA</small></div>
                        <div class="stat-label">Aides versées</div>
                    </div>
                    <div class="stat-icon">
                        <i class="bi bi-heart"></i>
                    </div>
                </div>
                <div class="mt-2 small text-danger">
                    <i class="bi bi-arrow-down"></i> 6 demandes traitées
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="stat-value">85 <small>%</small></div>
                        <div class="stat-label">Membres à jour</div>
                    </div>
                    <div class="stat-icon">
                        <i class="bi bi-people"></i>
                    </div>
                </div>
                <div class="mt-2 small text-warning">
                    <i class="bi bi-clock"></i> 7 impayés
                </div>
            </div>
        </div>
    </div>

    <div class="row fade-in mt-5">
        <div class="col-md-7">
            <div class="card">
                <div class="card-header">
                    <i class="bi bi-graph-up"></i> Évolution de la caisse (2026)
                </div>
                <div class="card-body">
                    <canvas id="caisseChart" height="250"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="card">
                <div class="card-header">
                    <i class="bi bi-plus-circle"></i> Nouvelle transaction
                </div>
                <div class="card-body">
                    <form id="transactionForm">
                        <div class="mb-3">
                            <label class="form-label">Type de transaction</label>
                            <select class="form-select" id="typeTransaction" required>
                                <option value="">Choisir...</option>
                                <option value="naissance">👶 Aide naissance</option>
                                <option value="deces">⚰️ Aide décès</option>
                                <option value="soutenance">🎓 Aide soutenance</option>
                                <option value="urgence">🚨 Aide urgence</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Membre concerné</label>
                            <select class="form-select" id="membre" required>
                                <option value="">Sélectionner...</option>
                                <option>Daniel MOUANABORE</option>
                                <option>ATSANGO Félix</option>
                                <option>Steve OKEMBA</option>
                                <option>ANDOKANDE Welcome</option>
                                <option>Mondesir AKOUL</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Montant (FCFA)</label>
                            <input type="number" class="form-control" id="montant" placeholder="Ex: 2500" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Date</label>
                            <input type="date" class="form-control" id="date" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea class="form-control" id="description" rows="2" placeholder="Motif, justificatif..."></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary-custom w-100">
                            <i class="bi bi-save"></i> Enregistrer la transaction
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div> 
    
    <!-- Règles et alertes -->
    <div class="row fade-in mt-5">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <i class="bi bi-calculator"></i> Règles de la caisse
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between">
                            <span><i class="bi bi-gift text-primary"></i> Aide naissance</span>
                            <span class="fw-bold">5000 FCFA</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span><i class="bi bi-heart-broken text-danger"></i> Aide décès</span>
                            <span class="fw-bold">2.000 FCFA</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span><i class="bi bi-trophy text-warning"></i> Aide soutenance</span>
                            <span class="fw-bold">2500 FCFA</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span><i class="bi bi-exclamation-triangle text-danger"></i> Urgence</span>
                            <span class="fw-bold">Sur validation</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <i class="bi bi-bell"></i> Alertes & Notifications
                </div>
                <div class="card-body">
                    <div class="alert alert-warning">
                        <i class="bi bi-exclamation-triangle"></i>
                        <strong>⚠️ Alerte solde faible :</strong> Le solde est inférieur à 300.000 FCFA
                    </div>
                    <div class="alert alert-danger">
                        <i class="bi bi-people"></i>
                        <strong>⏰ Retards de paiement :</strong> 7 membres n'ont pas payé la cotisation de mai
                    </div>
                    <div class="alert alert-info">
                        <i class="bi bi-calendar"></i>
                        <strong>📅 Échéance :</strong> Cotisation juin à payer avant le 10/06/2026
                    </div>
                    <div class="alert alert-success">
                        <i class="bi bi-check-circle"></i>
                        <strong>✅ Dernière aide :</strong> Aide décès versée à la famille de M. Koffi (100.000 FCFA)
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Historique des transactions -->
    <div class="card fade-in mt-5">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span><i class="bi bi-clock-history"></i> Historique des transactions</span>
            <div>
                <button class="btn btn-sm btn-outline-primary me-2">
                    <i class="bi bi-download"></i> Excel
                </button>
                <button class="btn btn-sm btn-outline-secondary">
                    <i class="bi bi-printer"></i> Imprimer
                </button>
            </div>
        </div>
        <div class="card-body" style="max-height: 400px; overflow-y: auto;">
            <table class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th>Date</th>
                        <th>Type</th>
                        <th>Membre</th>
                        <th>Description</th>
                        <th>Montant</th>
                        <th>Statut</th>
                    </tr>
                </thead>
                <tbody id="transactionTable">
                    <tr>
                        <td>15/05/2026</td>
                        <td><span class="badge-success">Cotisation</span></td>
                        <td>Jean Kouadio</td>
                        <td>Cotisation mai 2026</td>
                        <td class="text-success">+10.000 FCFA</td>
                        <td><i class="bi bi-check-circle text-success"></i> Validé</td>
                    </tr>
                    <tr>
                        <td>10/05/2026</td>
                        <td><span class="badge-danger">Aide naissance</span></td>
                        <td>Marie Koné</td>
                        <td>Naissance des jumeaux</td>
                        <td class="text-danger">-50.000 FCFA</td>
                        <td><i class="bi bi-check-circle text-success"></i> Approuvé</td>
                    </tr>
                    <tr>
                        <td>05/05/2026</td>
                        <td><span class="badge-danger">Aide décès</span></td>
                        <td>Famille Koffi</td>
                        <td>Décès du père</td>
                        <td class="text-danger">-100.000 FCFA</td>
                        <td><i class="bi bi-check-circle text-success"></i> Approuvé</td>
                    </tr>
                    <tr>
                        <td>28/04/2026</td>
                        <td><span class="badge-success">Cotisation</span></td>
                        <td>Paul Yao</td>
                        <td>Cotisation avril 2026</td>
                        <td class="text-success">+10.000 FCFA</td>
                        <td><i class="bi bi-check-circle text-success"></i> Validé</td>
                    </tr>
                    <tr>
                        <td>20/04/2026</td>
                        <td><span class="badge-warning">Soutenance</span></td>
                        <td>Alice N'Guessan</td>
                        <td>Soutenance master</td>
                        <td class="text-danger">-25.000 FCFA</td>
                        <td><i class="bi bi-check-circle text-success"></i> Approuvé</td>
                    </tr>
                    <tr>
                        <td>15/04/2026</td>
                        <td><span class="badge-success">Cotisation</span></td>
                        <td>Marie Koné</td>
                        <td>Cotisation avril 2026</td>
                        <td class="text-success">+10.000 FCFA</td>
                        <td><i class="bi bi-check-circle text-success"></i> Validé</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="card-footer text-center">
            <small class="text-muted">📊 23 transactions enregistrées ce mois-ci</small>
        </div>
    </div>

        

      </main>
    </div>

  </div>
    
    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>
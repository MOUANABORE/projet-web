<?php
    $bdd = new PDO("mysql:host=localhost;dbname=lego;charset=utf8", "root", "");
    try{
        if(isset($_POST['Envoyer'])){
          if(!empty($_POST['email']) AND !empty($_POST['password'])){
              $mail = htmlspecialchars($_POST['email']);
              $passe = htmlspecialchars($_POST['password']);
      
              $req = $bdd->prepare("SELECT email, pass  FROM administrateurs WHERE email =:email AND pass =:pass");
              $req->execute(['email' => $mail, 'pass'=> $passe]);
              if($req->rowCount() > 0 ){
                 echo '<script>window.location.href="index.php"</script>';
              }
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
    </style>
    <title>Document</title>
</head>
<body>
    
  <div class="container">
    <div class="row d-flex justify-content-center">
        <h1 class="text-center text-primary mt-5">Connexion</h1>
            <div class="col-sm-6">       
                <form action="" method="POST">
                    <fieldset>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Saisir votre email..." autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Mot de passe</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Saisir votre Mot de passe..." autocomplete="off">
                    </div>

                    <input type="submit" value="Envoyer" name="Envoyer" class="btn btn-primary">

                    </fieldset>
                </form>

            </div>
    </div>
</div>
    
    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>
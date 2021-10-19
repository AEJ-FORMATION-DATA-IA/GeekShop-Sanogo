<?php
session_start();

try{
    $bdd = new PDO('mysql:host=localhost;dbname=GeekShop;charset=utf8', 'root', "");
}
catch(Exeption $e){

    die ('Error: ' . $e->getMessage());
}

if(isset($_POST['login'])) {
  if (!empty($_POST['pseudo'] AND !empty($_POST['password']))) {
      $pseudo= htmlspecialchars($_POST['pseudo']);
      $mdp =sha1($_POST['password']);
      
    $recup = $bdd->prepare('SELECT * FROM admins WHERE pseudo =? AND pass=?');
    $recup->execute(array($pseudo, $mdp));
    $donnee = $recup->fetch();
    $exist = $recup->rowCount();

    if ($exist==0) {
        $erreur= 'Pseudo ou mot de pass incorrect';
    }else{
        $_SESSION['pseudo']=$donnee['pseudo'];
        header('Location:index.php');
    }

  }else{
      $erreur = 'Veuillez remplir tous les champs.';
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Custom Css files link  -->
    <link rel="stylesheet" href="./Assets/Css/myStyle.css">

     <!-- Bootstrap css files link -->
     <link rel="stylesheet" href="./Assets/bootstrap/bootstrap.css">
    <link rel="stylesheet" href="./Assets/bootstrap/bootstrap-grid.css">
    <link rel="stylesheet" href="./Assets/bootstrap/bootstrap-reboot.min.css">

    <!-- Bootstrap Css link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-uWxY/CJNBR+1zjPWmfnSnVxwRheevXITnMqoEIeG1LJrdI0GlVs/9cVSyPYXdcSF" crossorigin="anonymous">
    <title>GeekShop</title>
</head>

<body>
<header class="">
        
        <nav class="disp-flex justify-between pad-10">
            <h1 class="navbar-brand text-white ft-size-18 ">GeekShop</h1>
            <div class="">
                <ul class="nav disp-inline-block">
                    <li class="nav-item m-2 "><a href="register.php">S'inscrire</a></li>
                </ul>
            </div>
        </nav>
</header>
    <div class="disp-flex justify-content-center flex-column align-items-center border height">
        <form action="" method="POST" class="border">
            <h1 class="text-center">CONNEXION</h1>
            <div class="m-2">
                <label for="pseudo">Pseudo</label>
                <input type="text" name="pseudo" id="pseudo" placeholder="Votre pseudo" minlength="3" class="full-width" value='<?php echo $donnee['pseudo'] ?>'>
            </div>
            <div class="m-2">
                <label for="mdp">Mot de passe </label>
                <input type="password" name="password" id="mdp" placeholder="***********" class="full-width">
            </div>
            <div class="m-2">
            <input type="submit" class="register-btn" name="login" value="Se connecter">
            </div>
        </form>
        <p>
            <?php 
            if(isset($erreur)){
                echo $erreur;
            }
            ?>
        </p>
    </div>










    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kQtW33rZJAHjgefvhyyzcGF3C5TFyBQBA13V1RKPf4uH+bwyzQxZ6CmMZHmNBEfJ"
        crossorigin="anonymous"></script>
</body>

</html>
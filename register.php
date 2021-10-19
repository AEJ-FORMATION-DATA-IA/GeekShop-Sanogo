<?php
try {
   $bdd=new PDO('mysql:host=localhost;dbname=GeekShop;', 'root',''); 

} catch (Exeption $e) {
    die('Error: ' .$e->getMessage());
}

//Si on clique sur le bouton s'inscrire 
if(isset($_POST['register'])) {

    //Verifier que tous les champs sont remplis
    if (!empty($_POST['pseudo']) AND !empty($_POST['password']) AND !empty($_POST['password_confirm'])) {

        //creation de variable pour les entrées 
        $pseudo=htmlspecialchars($_POST['pseudo']);
        $password=sha1($_POST['password']);
        $password_conf=sha1($_POST['password_confirm']);

        //Verifier que les mots de passe sont identique
            if($_POST['password']==$_POST['password_confirm']){

                //Envoyer les infos dans la base de donnée
                $inscription =$bdd->prepare('INSERT INTO admins(pseudo, pass) VALUES(?,?)');
                $inscription->execute(array($pseudo, $password));

                //Rediriger vers la page de connexion.
                header('Location: login.php');
            }else{
                $erreur= 'Les mots de passe ne correspondent pas';
            }
    }else{
        $erreur = 'Veuillez remplir tous les champs!';
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

<!-- La barre de navigation  -->
<header class="">
        
        <nav class="disp-flex justify-between pad-10">
            <h1 class="navbar-brand text-white ft-size-18 ">GeekShop</h1>
            <div class="">
                <ul class="nav disp-inline-block">
                    <li class="nav-item m-2 "><a href="login.php">Se connecter</a></li>
                </ul>
            </div>
        </nav>
</header>
    <!-- La div contenant le formulaire  -->
    <div class="disp-flex justify-content-center flex-column align-items-center border height">

    <!-- Formulaire  -->
        <form action="" method="POST" class="border">
            <h1 class="text-center">INSCRIPTION</h1>

            <!-- Le champ pseudo  -->
            <div class="m-2">
                <label for="pseudo">Pseudo</label>
                <input type="text" name="pseudo" id="pseudo" placeholder="Votre pseudo" class="full-width">
            </div>

            <!-- Le champ mot de passe  -->
            <div class="m-2">
                <label for="mdp">Mot de passe </label>
                <input type="password" name="password" id="mdp" placeholder="**********" class="full-width">
            </div>

            <!-- Le champ confirmation de mot de passe  -->
            <div class="m-2">
                <label for="mdp">Confirmer le mot de passe </label>
                <input type="password" name="password_confirm" id="mdp" placeholder="**********" class="full-width">
            </div>

            <!-- Le bouton s'incrire  -->
            <div class="m-2">
            <input type="submit" class="register-btn" name="register" value="S'inscrire">
            </div>
        </form>

        <!-- Le message d'erreur  -->
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
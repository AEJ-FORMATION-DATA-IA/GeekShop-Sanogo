<?php
session_start();

//Connexion a la base de donnée
 try {
    $bdd=new PDO('mysql:host=localhost;dbname=GeekShop;', 'root',''); 

 } catch (Exeption $e) {
     die('Error: ' .$e->getMessage());
 }

    //recuperer la reference du produit et le mettre dans la variable ref
    if (!empty($_GET['reference'])) {
        $ref = htmlspecialchars($_GET['reference']);
    }

    //Si on clique sur le bouton enregister 
    if(empty($_POST['update'])){

        //Recuperer l'élément dans la base de donnée qui à la reference recuperée
        $valeur_actuelle = $bdd->prepare('SELECT * FROM Produits WHERE reference=?');
        $valeur_actuelle->execute(array($ref));
        $info_prod = $valeur_actuelle->fetch();

        //Mettre la valeur libelle recupérée dans la variable nom
        $nom=$info_prod['libelle'];

        //Mettre la valeur quantite_minimale recupérée dans la variable min
        $quant_min=$info_prod['quantite_minimale'];

        //Mettre la valeur quantite_en_stock recupérée dans la variable stock
        $quant_stock=$info_prod['quantite_en_stock'];
    }else{

        //S'il y'a modification du produit, faire la mise à jour
        $lib = $_POST['libelle'];
        $min = $_POST['minimale'];
        $stock = $_POST['stock'];
        if (!empty($lib) AND !empty($min) AND !empty($stock)) {

                $modif=$bdd->prepare('UPDATE Produits SET libelle=?, quantite_minimale=?, quantite_en_stock=? WHERE reference=? ');
                $modif->execute(array($lib,$min,$stock,$ref));

                //Redirection vers la liste des produits
                header('Location: index.php');
        }
        else{
            $erreur='Veuillez remplir tous les champs ';
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
    <?php include('header.php');?>

    <div class="container row">
        <div class="col-sm-">
            <div class="disp-flex mt-5 flex-column align-items-center">

                <!-- Le formulaire  -->
                <form action="" method="POST" class="border full-width">
                    <h1 class="text-center bg-secondary text-white p-2">Modifier un produit</h1>

                    <!-- Le nom du produit à modifier  -->
                    <div class="m-2 row">
                        <label for="libelle" class="ft-size-18 col-md-6">Modifier le nom du produit </label>
                        <input type="text" name="libelle" id="libelle"
                            placeholder="Quel produit souhaitez vous ajouter ?" minlength="3"
                            class="full-widh col-md-6" value="<?php echo $nom; ?>">
                    </div>

                    <!-- La quantité du produit à modifier  -->
                    <div class="m-2 row">
                        <label for="Q_min" class="ft-size-18 col-md-6">Modifier la Quantité minimale </label>
                        <input type="number" name="minimale" id="Q_min" placeholder="0" class="full-widt col-md-6" value="<?php echo $quant_min; ?>">
                    </div>

                    <!-- La quantité en stock à modifier  -->
                    <div class="m-2 row">
                        <label for="Q_stock" class="ft-size-18 col-md-6">Modifier la Quantité en stock </label>
                        <input type="number" name="stock" id="Q_stock" placeholder="0" class="full-widt col-md-6" value="<?php echo $quant_stock; ?>">
                    </div>

                    <!-- Le bouton enregistrer  -->
                    <div class="m-2">
                        <input type="submit" class="register-btn btn-success" name="update" value="Enregister">
                    </div>
                </form>

                <!-- Le message d'erreur  -->
                
                    <?php 
                        if(isset($erreur)){
                            echo '<p class="alert bg-warning mt-3">'.$erreur . '</p>';}
                    ?>
            </div>
        </div>
    </div>


    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kQtW33rZJAHjgefvhyyzcGF3C5TFyBQBA13V1RKPf4uH+bwyzQxZ6CmMZHmNBEfJ" crossorigin="anonymous">
    </script>
</body>

</html>
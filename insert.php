<?php
session_start();
 try {
    $bdd=new PDO('mysql:host=localhost;dbname=GeekShop;', 'root',''); 

 } catch (Exeption $e) {
     die('Error: ' .$e->getMessage());
 }

 //Quand le bouton ajouter un produit est actionné
if(isset($_POST['inserer'])){
    if(!empty($_POST['libelle']) AND !empty($_POST['minimale']) AND !empty($_POST['stock'])){

        $libelle=htmlspecialchars($_POST['libelle']);
        $minim=$_POST['minimale'];
        $stock=$_POST['stock'];

        if ($minim<$stock) {
            $insert = $bdd->prepare('INSERT INTO Produits(libelle, quantite_minimale, quantite_en_stock) VALUES(?,?,?)');
            $insert->execute(array($_POST['libelle'],$_POST['minimale'], $_POST['stock']));
    
            header('Location:index.php');
        }else{
            $erreur='La quantité en stock ne dois pas être inférieure à la quantité minimale.';
        }
        
    }else{
        echo $erreur = 'Veuillez remplir tous les champs ';
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
    <?php include('header.php');?>

    <!-- La div contenant le formulaire -->
    <div class="disp-flex mt-5 flex-column align-items-center border height">

        <!-- Le formulaire  -->
        <form action="" method="POST" class="border full-width">
            <h1 class="text-center bg-secondary text-white p-2">Ajouter un produit</h1>

            <!-- le nom du produit  -->
            <div class="m-2">
                <label for="libelle" class="ft-size-18">Nom du produit</label>
                <input type="text" name="libelle" id="libelle" placeholder="Quel produit souhaitez vous ajouter ?"
                    minlength="3" class="full-width">
            </div>

            <!-- La quantite minimale -->
            <div class="m-2">
                <label for="Q_min" class="ft-size-18">Quantité minimale </label>
                <input type="number" name="minimale" id="Q_min" placeholder="0" class="full-width">
            </div>

            <!-- La quantite en stock -->
            <div class="m-2">
                <label for="Q_stock" class="ft-size-18">Quantité en stock </label>
                <input type="number" name="stock" id="Q_stock" placeholder="0" class="full-width">
            </div>

            <!-- Le bouton ajouter le produit  -->
            <div class="m-2">
                <input type="submit" class="register-btn btn-success" name="inserer" value="Ajouter le produit">
            </div>
        </form>

        <!-- Le message d'erreur -->
        <?php 
             if(isset($erreur))
                    echo '<p class="alert bg-warning mt-3">'.$erreur . '</p>';
        ?>
    </div>


    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kQtW33rZJAHjgefvhyyzcGF3C5TFyBQBA13V1RKPf4uH+bwyzQxZ6CmMZHmNBEfJ" crossorigin="anonymous">
    </script>
</body>

</html>
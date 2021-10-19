<?php 
session_start();
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
    
    <div class="container dashbord mt-5">
        <div class="row">
            <div class="disp-flex align-items-center justify-content-between">
                <h1><strong>Liste des produits</strong> </h1><a href="insert.php" class="btn btn-success">Ajouter un
                    produit</a> <a href="rupture.php" class="btn text-white btn-warning">Produits en rupture de stock</a> 
            </div>
            <table class="table table-striped text-center table-bordered">
                <thead>
                    <tr>
                        <th>PRODUITS</th>
                        <th>Quantité minimale</th>
                        <th>Quantité en stock</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        require_once('bd_connect.php');
                        $selection= $bdd->query('SELECT * FROM Produits ORDER BY reference DESC');
                        while($prod = $selection->fetch()){
                            echo '<tr>';
                            echo '<td>'. $prod['libelle']. '</td>';
                            echo '<td>'. $prod['quantite_minimale']. '</td>';
                            echo '<td>'. $prod['quantite_en_stock']. '</td>';
                            echo  '<td> <a href="update.php?reference=' .$prod['reference']. '" class="btn btn-primary"> Modifier</a> <a href="delete.php?reference=' .$prod['reference'].'" class="btn btn-danger"> Supprimer</a> </td>';
                            echo '</tr>';
                        }
                    ?>

                </tbody>
            </table>
        </div>
    </div>






</body>

</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Custom Css files link  -->
    <link rel="stylesheet" href="./Assets/Css/myStyle.css">

    <!-- Bootstrap css files link  -->
    <link rel="stylesheet" href="./Assets/bootstrap/bootstrap.css">
    <link rel="stylesheet" href="./Assets/bootstrap/bootstrap-grid.css">
    <link rel="stylesheet" href="./Assets/bootstrap/bootstrap-reboot.min.css">

    <!-- Bootstrap Css link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-uWxY/CJNBR+1zjPWmfnSnVxwRheevXITnMqoEIeG1LJrdI0GlVs/9cVSyPYXdcSF" crossorigin="anonymous">    <title>Geekshop</title>
</head>
<body>
    <?php include('header.php'); ?>

    <div class="container mt-5">
    <table class="table table-striped text-center table-bordered">
                <thead>
                    <tr>
                        <th>PRODUITS</th>
                        <th>Quantité minimale</th>
                        <th>Quantité en stock</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        require_once('bd_connect.php');
                        $selection= $bdd->query('SELECT * FROM Produits WHERE quantite_minimale>quantite_en_stock');
                        while($prod = $selection->fetch()){
                            echo '<tr>';
                            echo '<td>'. $prod['libelle']. '</td>';
                            echo '<td>'. $prod['quantite_minimale']. '</td>';
                            echo '<td>'. $prod['quantite_en_stock']. '</td>';
                            echo '</tr>';
                        }
                    ?>

                </tbody>
            </table>
    </div>
</body>
</html>
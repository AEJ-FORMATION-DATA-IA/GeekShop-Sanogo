<?php
 try {
    $bdd=new PDO('mysql:host=localhost;dbname=GeekShop;', 'root',''); 

 } catch (Exeption $e) {
     die('Error: ' .$e->getMessage());
 }
<<?php include '../Modelo/BD/bd.php'?>
<?php 

session_start();
session_destroy();
header("Location: ../login.php");
?>
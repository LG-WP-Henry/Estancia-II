<?php 
include '../BD/bd.php';


    if(isset($_GET['idAdministrador'])){
        $ID = $_GET['idAdministrador'];
        $delete = "Delete from administrador where idAdministrador=$ID;";
        $execute = mysqli_query($conn, $delete);
        header("Location: ../../Vista/crudAdministrador/consultaAdmin.php");
    }else{
        echo"No se pudo eliminar";
        header("Location: ../../Vista/crudAdministrador/consultaAdmin.php");
    }

?>
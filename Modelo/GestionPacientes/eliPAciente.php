<?php 
include '../BD/bd.php';


    if(isset($_GET['idPaciente'])){
        $ID = $_GET['idPaciente'];
        $delete = "Delete from paciente where idPaciente=$ID;";
        $execute = mysqli_query($conn, $delete);
        header("Location: ../../Vista/crudPaciente/consultaPacientes.php");
    }else{
        echo"No se pudo eliminar";
        header("Location: ../../Vista/crudPaciente/consultaPacientes.php");
    }

?>
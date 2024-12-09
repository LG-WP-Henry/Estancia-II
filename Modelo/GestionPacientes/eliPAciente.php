<?php 
include '../BD/bd.php';


    if(isset($_GET['idPaciente'])){
        $ID = $_GET['idPaciente'];
        $delete = "Delete from paciente where idPaciente=$ID;";
        $execute = mysqli_query($conn, $delete);
        sleep(2);
        header("Location: ../../Vista/crudPaciente/consultaPacientes.php");
    }

?>
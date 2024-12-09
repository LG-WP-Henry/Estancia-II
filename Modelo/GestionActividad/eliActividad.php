<?php 
include '../BD/bd.php';


    if(isset($_GET['idActividades'])){
        $ID = $_GET['idActividades'];
        $sql = "DELETE FROM actividades WHERE idActividades = $ID;";
        $execute = mysqli_query($conn, $sql);
        //echo $ID;
        sleep(2);
        header("Location: ../../Vista/crudActividades/consultarActividades.php");
    }else{
        echo "no se encontro el dato a elminiar";
    }
    
?>
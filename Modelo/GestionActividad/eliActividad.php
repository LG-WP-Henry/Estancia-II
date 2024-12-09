<?php 
include '../BD/bd.php';


    if(isset($_GET['idActividades'])){
        $ID = $_GET['idActividades'];
        $sql = "DELETE FROM actividades WHERE idActividades = $ID;";
        $execute = mysqli_query($conn, $sql);
        //echo $ID;
        //sleep(2);
        //header("Location: ../../Vista/crudActividades/consultarActividades.php");
        echo "<script>alert('la actividad se elimino correctamente');window.location.href='../../Vista/crudActividades/consultarActividades.php';</script>";
    }else{
        //echo "no se encontro el dato a elminiar";
        echo "<script>alert('Error al eliminar');window.location.href='../../Vista/crudActividades/altaActividad.php';</script>";
    }
    
?>
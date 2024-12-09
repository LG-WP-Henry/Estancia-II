<?php 
include '../../Modelo/BD/bd.php';

if(isset($_GET['idActividades']) && !empty($_GET['idActividades'])){
    $ID = $_GET['idActividades'];
    $select = "SELECT * FROM actividades WHERE idActividades=$ID;";
    $execute = mysqli_query($conn, $select);
    if(mysqli_num_rows($execute)){
        $row = mysqli_fetch_array($execute);
        $pregunta = $row['Actividad'];
       
    }
} else {
    echo "No existen registros";
}

if(isset($_POST['actualizar'])){
    $id = $_GET['idActividades'];
    $pregunta = $_POST['actividad'];
    

    $sql = "UPDATE actividades SET Actividad = '$pregunta' WHERE idActividades = $id;";

    if($conn->query($sql) === TRUE){
        
        echo "<script>alert('la actividad se actualizo correctamente');window.location.href='../../Vista/crudActividades/consultarActividades.php';</script>";
    } else {
        echo "<script>alert('Error al actualizo');window.location.href='../../Vista/crudActividades/altaActividad.php';</script>";
    }
}
?>
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
        header("Location: ../../Vista/crudActividades/consultarActividades.php");
    } else {
        echo "Error al actualizar: " . mysqli_error($conn);
    }
}
?>
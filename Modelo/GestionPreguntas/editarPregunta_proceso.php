<?php 
include '../../Modelo/BD/bd.php';

if(isset($_GET['idPregunta']) && !empty($_GET['idPregunta'])){
    $ID = $_GET['idPregunta'];
    $select = "SELECT * FROM preguntas WHERE idPregunta=$ID;";
    $execute = mysqli_query($conn, $select);
    if(mysqli_num_rows($execute)){
        $row = mysqli_fetch_array($execute);
        $pregunta = $row['Pregunta'];
       
    }
} else {
    echo "No existen registros";
}

if(isset($_POST['actualizar'])){
    $id = $_GET['idPregunta'];
    $pregunta = $_POST['pregunta'];
    

    $sql = "UPDATE preguntas SET 
            Pregunta = '$pregunta'
        WHERE idPregunta = $id;";

    if($conn->query($sql) === TRUE){
        header("Location: ../../Vista/crudPreguntas/consultarPreguntas.php");
    } else {
        echo "Error al actualizar: " . mysqli_error($conn);
    }
}
?>
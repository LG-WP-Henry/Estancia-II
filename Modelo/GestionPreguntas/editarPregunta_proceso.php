<?php 
include '../../Modelo/BD/bd.php';

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
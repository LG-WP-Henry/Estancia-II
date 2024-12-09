<?php 
include '../BD/bd.php';


    if(isset($_GET['idPregunta'])){
        $ID = $_GET['idPregunta'];
        $sql = "DELETE FROM preguntas WHERE idPregunta = $ID;";
        $execute = mysqli_query($conn, $sql);
        //echo $ID;
        sleep(2);
        header("Location: ../../Vista/crudPreguntas/consultarPreguntas.php");
    }else{
        echo "no se encontro el dato a elminiar";
    }
    
?>
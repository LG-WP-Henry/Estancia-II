<?php
include '../../Modelo/BD/bd.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pregunta = $_POST['pregunta'];


    $sqlPregunta = "INSERT INTO preguntas (Pregunta)
                    VALUES ('$pregunta')";

    if ($conn->query($sqlPregunta) === TRUE) {
        $idPregunta = $conn->insert_id;
        echo "<script>alert('la pregunta se agrego correctamente');window.location.href='../../Vista/crudPreguntas/consultarPreguntas.php';</script>";
    } else {
        echo "<script>alert('Error al agregar');window.location.href='../../Vista/crudPreguntas/altapregunta.php';</script>";
    }
}

$conn->close();
?>
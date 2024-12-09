<?php
include '../../Modelo/BD/bd.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $actividad = $_POST['actividad'];


    $sqlActividad = "INSERT INTO actividades (Actividad)
                    VALUES ('$actividad')";

    if ($conn->query($sqlActividad) === TRUE) {
        $idActividad = $conn->insert_id;
        echo "<script>alert('la actividad se agrego correctamente');window.location.href='../../Vista/crudActividades/consultarActividades.php';</script>";
    } else {
        echo "<script>alert('Error al agregar');window.location.href='../../Vista/crudActividades/altaActividad.php';</script>";
    }
}

$conn->close();
?>
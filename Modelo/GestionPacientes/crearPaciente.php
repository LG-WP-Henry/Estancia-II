<?php
include '../../Modelo/BD/bd.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $apPaterno = $_POST['apPaterno'];
    $apMaterno = $_POST['apMaterno'];
    $sexo = $_POST['sexo'];
    $telefono = $_POST['telefono'];
    $direccion = $_POST['direccion'];
    $fechaNac = $_POST['fechaNac'];

    $sqlPaciente = "INSERT INTO paciente (Nombre, ApPaterno, ApMaterno, sexo, telefono, direccion, fechaNac)
                    VALUES ('$nombre', '$apPaterno', '$apMaterno', '$sexo', '$telefono', '$direccion', '$fechaNac')";

    if ($conn->query($sqlPaciente) === TRUE) {
        $idPaciente = $conn->insert_id;
        echo "<script>alert('Paciente agregado correctamente');window.location.href='../../Vista/crudPaciente/consultaPacientes.php';</script>";
    } else {
        echo "<script>alert('Error al agregar paciente');window.location.href='../../Vista/crudPaciente/crearPaciente.php';</script>";
    }
}

$conn->close();
?>


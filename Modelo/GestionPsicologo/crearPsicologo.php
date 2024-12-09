<?php
include '../BD/bd.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cedula = $_POST['cedula'];
    $nombre = $_POST['nombre'];
    $apPaterno = $_POST['apPaterno'];
    $apMaterno = $_POST['apMaterno'];
    $sexo = $_POST['sexo'];
    $telefono = $_POST['telefono'];
    $direccion = $_POST['direccion'];
    $fechaNac = $_POST['fechaNac'];

    $sqlPsicologo = "INSERT INTO Psicologo (Cedula, Nombre, ApPaterno, ApMaterno, sexo, telefono, direccion, fechaNac)
                    VALUES ('$cedula','$nombre', '$apPaterno', '$apMaterno', '$sexo', '$telefono', '$direccion', '$fechaNac')";

    if ($conn->query($sqlPsicologo) === TRUE) {
        $idPsicologo = $conn->$cedula;
        echo "<script>alert('Psicologo agregado correctamente');window.location.href='../../Vista/crudPsicologo/consultaPsicologo.php';</script>";
    } else {
        echo "<script>alert('Error al agregar Psicologo');window.location.href='../../Vista/indexAdmin.php';</script>";
    }
}

$conn->close();
?>


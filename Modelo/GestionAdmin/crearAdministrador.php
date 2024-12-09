<?php
include '../BD/bd.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $apPaterno = $_POST['apPaterno'];
    $apMaterno = $_POST['apMaterno'];

    // Insertar en la tabla Administrador
    $sqlAdministrador = "INSERT INTO Administrador (Nombre, ApPaterno, ApMaterno)
                            VALUES ('$nombre', '$apPaterno', '$apMaterno')";

    // Verificar ambos inserts
    if ($conn->query($sqlAdministrador)){
        echo "<script>alert('Administrador agregado correctamente');window.location.href='../../Vista/crudAdministrador/consultaAdmin.php';</script>";
    } else {
        echo "<script>alert('Error al agregar Administrador');window.location.href='../../Vista/indexAdmin.php';</script>";
    }
}

$conn->close();
?>

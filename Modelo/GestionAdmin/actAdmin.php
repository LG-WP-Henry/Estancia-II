<?php
// Conexión a la base de datos
include '../../Modelo/BD/bd.php';
$idAdministrador = $_GET['idAdministrador'];

if (isset($idAdministrador)) {
    $nombre = $_POST['nombre'];
    $apPaterno = $_POST['apPaterno'];
    $apMaterno = $_POST['apMaterno'];
    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];

    // Consultas de actualización
    $updateAdministrador = "UPDATE administrador SET 
                                Nombre = '$nombre', 
                                ApPaterno = '$apPaterno', 
                                ApMaterno = '$apMaterno'
                            WHERE idAdministrador = $idAdministrador;";

    $updateCredenciales = "UPDATE credenciales SET 
                                usuario = '$usuario', 
                                contrasena = '$contrasena'
                            WHERE id_usuario = $idAdministrador 
                            AND tipo_usuario = 'Administrador';";

    // Ejecutar consultas
    if (mysqli_query($conn, $updateAdministrador) && mysqli_query($conn, $updateCredenciales)) {
        echo "<script>alert('Administrador actualizado correctamente');window.location.href='../../Vista/crudAdministrador/consultaAdmin.php';</script>";
    } else {
        echo "Error al actualizar los datos: " . mysqli_error($conn);
    }
}

// Cerrar conexión
mysqli_close($conn);
?>

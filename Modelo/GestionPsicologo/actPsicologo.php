<?php 
include '../../Modelo/BD/bd.php';


// Verificar si el formulario ha sido enviado.
if (isset($_POST['actualizar'])) {
    // Recuperar datos del formulario.
    $cedula = $_GET['Cedula'];
    $nombre = $_POST['nombre'];
    $aPaterno = $_POST['apPaterno'];
    $aMaterno = $_POST['apMaterno'];
    $sexo = $_POST['sexo'];
    $telefono = $_POST['telefono'];
    $direccion = $_POST['direccion'];
    $fechaNac = $_POST['fechaNac'];
    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];

    // Actualizar los datos en la base de datos.
    $sqlPsicologo = "UPDATE psicologo SET 
                        Nombre = '$nombre', 
                        ApPaterno = '$aPaterno', 
                        ApMaterno = '$aMaterno', 
                        sexo = '$sexo', 
                        telefono = '$telefono', 
                        direccion = '$direccion', 
                        fechaNac = '$fechaNac' 
                    WHERE Cedula = $cedula;";

    $sqlCredenciales = "UPDATE credenciales SET 
                            usuario = '$usuario', 
                            contrasena = '$contrasena' 
                        WHERE id_usuario = $cedula AND tipo_usuario = 'Psicólogo';";

    if (mysqli_query($conn, $sqlPsicologo) && mysqli_query($conn, $sqlCredenciales)) {
        echo "<script>alert('Psicólogo actualizado correctamente.');window.location.href='../../Vista/crudPsicologo/consultaPsicologo.php';</script>";
    } else {
        echo "Error al actualizar los datos: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>

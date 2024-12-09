<?php 
include '../../Modelo/BD/bd.php';

if(isset($_GET['Cedula']) && !empty($_GET['Cedula'])){
    $cedula = $_GET['Cedula'];
    $selectPsicologo = "SELECT * FROM psicologo WHERE Cedula=$cedula;";
    $selectCredenciales = "SELECT usuario, contrasena FROM credenciales WHERE id_usuario=$cedula AND tipo_usuario='Psicólogo';";

    $executePsicologo = mysqli_query($conn, $selectPsicologo);
    $executeCredenciales = mysqli_query($conn, $selectCredenciales);

    if(mysqli_num_rows($executePsicologo) && mysqli_num_rows($executeCredenciales)){
        $rowPsicologo = mysqli_fetch_array($executePsicologo);
        $rowCredenciales = mysqli_fetch_array($executeCredenciales);

        $nombre = $rowPsicologo['Nombre'];
        $aPaterno = $rowPsicologo['ApPaterno'];
        $aMaterno = $rowPsicologo['ApMaterno'];
        $sexo = $rowPsicologo['sexo'];
        $telefono = $rowPsicologo['telefono'];
        $direccion = $rowPsicologo['direccion'];
        $fechaNac = $rowPsicologo['fechaNac'];
        $usuario = $rowCredenciales['usuario'];
        $contrasena = $rowCredenciales['contrasena'];
    }
} else {
    echo "No existen registros";
}

if(isset($_POST['actualizar'])){
    $nombre = $_POST['nombre'];
    $aPaterno = $_POST['apPaterno'];
    $aMaterno = $_POST['apMaterno'];
    $sexo = $_POST['sexo'];
    $telefono = $_POST['telefono'];
    $direccion = $_POST['direccion'];
    $fechaNac = $_POST['fechaNac'];
    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];

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

    if(mysqli_query($conn, $sqlPsicologo) && mysqli_query($conn, $sqlCredenciales)){
        echo "<script>alert('Psicologo actualizado correctamente');window.location.href='../../Vista/crudPsicologo/consultaPsicologo.php';</script>";
    } else {
        echo "Error al actualizar: " . mysqli_error($conn);
    }
}
?>

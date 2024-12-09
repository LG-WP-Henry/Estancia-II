<?php 
include '../../Modelo/BD/bd.php';

if(isset($_POST['actualizar'])){
    $id = $_GET['idPaciente'];
    $nombre = $_POST['nombre'];
    $aPaterno = $_POST['apPaterno'];
    $aMaterno = $_POST['apMaterno'];
    $sexo = $_POST['sexo'];
    $telefono = $_POST['telefono'];
    $direccion = $_POST['direccion'];
    $fechaNac = $_POST['fechaNac'];

    $sql = "UPDATE paciente SET 
            Nombre = '$nombre', 
            ApPaterno = '$aPaterno', 
            ApMaterno = '$aMaterno', 
            sexo = '$sexo', 
            telefono = '$telefono', 
            direccion = '$direccion', 
            fechaNac = '$fechaNac' 
        WHERE idPaciente = $id;";

    if($conn->query($sql) === TRUE){
        echo "<script>alert('Paciente actualizado');window.location.href='../../Vista/crudPaciente/consultaPacientes.php';</script>";
        
    } else {
        echo "Error al actualizar: " . mysqli_error($conn);
    }
}
?>

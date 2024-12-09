<?php 
include '../../Modelo/BD/bd.php';

if(isset($_GET['idPaciente']) && !empty($_GET['idPaciente'])){
    $ID = $_GET['idPaciente'];
    $select = "SELECT * FROM Paciente WHERE idPaciente=$ID;";
    $execute = mysqli_query($conn, $select);
    if(mysqli_num_rows($execute)){
        $row = mysqli_fetch_array($execute);
        $nombre = $row['Nombre'];
        $aPaterno = $row['ApPaterno'];
        $aMaterno = $row['ApMaterno'];
        $sexo = $row['sexo'];
        $telefono = $row['telefono'];
        $direccion = $row['direccion'];
        $fechaNac = $row['fechaNac'];
    }
} else {
    echo "No existen registros";
}

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
        header("Location: ../../Vista/crudPaciente/consultaPacientes.php");
    } else {
        echo "Error al actualizar: " . mysqli_error($conn);
    }
}
?>

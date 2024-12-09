<?php
include '../BD/bd.php';

// Verificar que se ha pasado el id de la cita en la URL y que el formulario ha sido enviado
if (isset($_GET['idCita']) && !empty($_GET['idCita']) && isset($_POST['actualizar'])) {
    $idCita = $_GET['idCita'];

    // Obtener los valores enviados desde el formulario
    $fecha = $_POST['fecha'];
    $cedulaCita = $_POST['cedulaCita'];

    // Actualizar los datos de la cita
    $sql = "UPDATE citas SET 
                Fecha = '$fecha',
                
                CedulaCita = $cedulaCita 
            WHERE idCitas = $idCita";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Cita actualizada con éxito');window.location.href='../../Vista/crudCitas/verCitasPsicologo.php';</script>";
    } else {
        echo "Error al actualizar: " . mysqli_error($conn);
    }
} else {
    echo "Error: no se proporcionaron los datos necesarios.";
    echo $GET['idCitas'];
    echo $_POST['cedulaCita'];
    echo $_POST['fecha'];

}

mysqli_close($conn);
?>

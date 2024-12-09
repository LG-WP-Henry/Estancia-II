<?php

include '../BD/bd.php';

if (isset($_GET['idCitas'])) {
    $idCita = $_GET['idCitas'];
    $delete = "DELETE FROM citas WHERE idCitas = $idCita;";
    $execute = mysqli_query($conn, $delete);

    if ($execute) {
        echo "<script>alert('Cita eliminada');window.location.href='../../indexPsicologo.php';</script>";
    } else {
        echo "<script>alert('Error al eliminar la cita');window.location.href='../../indexPsicologo.php';</script>";
    }
} else {
    echo "<script>alert('ID de cita no proporcionado');window.location.href='../../indexPsicologo.php';</script>";
}

?>

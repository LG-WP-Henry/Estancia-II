<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'Psicólogo') {
    header("Location: ../../login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar Actividad</title>
    <link rel="stylesheet" href="../Estilos/stylesForAddPAc.css">
</head>
<body>
    <h2>Agregar una nueva Actividad</h2>
<a href="consultaPacientes.php"></a>
    <form method="post" action="../../Modelo/GestionActividad/crearActividad.php" class="form">
        <label>Actividad:</label>
        <input type="text" name="actividad" required><br><br>

        <input type="submit" value="Agregar Actividad">
    </form>
</body>
</html>
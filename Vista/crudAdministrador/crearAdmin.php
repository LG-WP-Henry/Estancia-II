<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'Administrador') {
    header("Location: ../../login.php");
    exit();
}
include '../../Vista/includes/headerRegresar.php';

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registrar Administrador</title>
    <link rel="stylesheet" href="../../Vista/Estilos/stylesForAddPAc.css"> <!-- Ruta de tu archivo CSS -->
</head>
<body>
    <h2>Registrar Nuevo Administrador</h2>
    <!-- Formulario con clases para aplicar los estilos -->
    <form method="post" action="../../Modelo/GestionAdmin/crearAdministrador.php" class="form">

        <label>Nombre:</label>
        <input type="text" name="nombre" required><br><br>

        <label>Apellido Paterno:</label>
        <input type="text" name="apPaterno" required><br><br>

        <label>Apellido Materno:</label>
        <input type="text" name="apMaterno" required><br><br>

        <input type="submit" value="Registrar Administrador">
    </form>
</body>
</html>

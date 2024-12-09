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
    <title>Registrar Psicologo</title>
    <link rel="stylesheet" href="../Vista/Estilos/stylesForAddPAc.css"> <!-- Ruta de tu archivo CSS -->
</head>
<body>
    <h2>Registrar Nuevo Psicologo</h2>
    <!-- Formulario con clases para aplicar los estilos -->
    <form method="post" action="../Modelo/GestionPacientes/crearPsicologo.php" class="form">
        <label>Cedula:</label>
        <input type="text" name="cedula" required><br><br>

        <label>Nombre:</label>
        <input type="text" name="nombre" required><br><br>

        <label>Apellido Paterno:</label>
        <input type="text" name="apPaterno" required><br><br>

        <label>Apellido Materno:</label>
        <input type="text" name="apMaterno" required><br><br>

        <label>Sexo:</label>
        <input type="text" name="sexo" required><br><br>

        <label>Teléfono:</label>
        <input type="text" name="telefono" required><br><br>

        <label>Dirección:</label>
        <input type="text" name="direccion" required><br><br>

        <label>Fecha de Nacimiento:</label>
        <input type="date" name="fechaNac" required><br><br>

        <input type="submit" value="Registrar Psicologo">
    </form>
</body>
</html>

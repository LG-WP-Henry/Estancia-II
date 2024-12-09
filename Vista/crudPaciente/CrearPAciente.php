<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] == 'Paciente') {
    header("Location: ../../login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registrar Paciente</title>
    <link rel="stylesheet" href="../Estilos/stylesForAddPAc.css">
</head>
<body>
    <h2>Registrar Nuevo Paciente</h2>
<a href="consultaPacientes.php"></a>
    <form method="post" action="../../Modelo/GestionPacientes/crearPaciente.php" class="form">
        <label>Nombre:</label>
        <input type="text" name="nombre" required><br><br>

        <label>Apellido Paterno:</label>
        <input type="text" name="apPaterno" required><br><br>

        <label>Apellido Materno:</label>
        <input type="text" name="apMaterno" required><br><br>

        <label>Sexo:</label>
        <select id="sexo" name="sexo" class="dropdown" required>
                <option value="" disabled selected>Sexo</option>
                <option value="Masculino">Masculino</option>
                <option value="Femenino">Femenino</option>
        </select>

        <label>Teléfono:</label>
        <input type="text" name="telefono" required><br><br>

        <label>Dirección:</label>
        <input type="text" name="direccion" required><br><br>

        <label>Fecha de Nacimiento:</label>
        <input type="date" name="fechaNac" required><br><br>

        <input type="submit" value="Registrar Paciente">
    </form>
</body>
</html>

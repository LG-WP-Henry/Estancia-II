<?php

include '../../Vista/includes/headerRegresar.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registrar Psicólogo</title>
    <link rel="stylesheet" href="../../Vista/Estilos/stylesForAddPAc.css"> <!-- Ruta de tu archivo CSS -->
</head>
<body>
    <h2>Registrar Nuevo Psicólogo</h2>
    <!-- Formulario con clases para aplicar los estilos -->
    <form method="post" action="../../Modelo/GestionPsicologo/crearPsicologo.php" class="form">

        <input type="hidden" name="Cedula" value="0">

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
        </select><br><br>

        <label>Teléfono:</label>
        <input type="text" name="telefono" required><br><br>

        <label>Dirección:</label>
        <input type="text" name="direccion" required><br><br>

        <label>Fecha de Nacimiento:</label>
        <input type="date" name="fechaNac" required><br><br>

        <input type="submit" value="Registrar Psicólogo">
    </form>
</body>
</html>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Psicólogo</title>
    <link rel="stylesheet" href="../../Vista/Estilos/StylesForAddPAc.css">
</head>
<body>
    <h2>Editar Psicólogo</h2>

    <?php
    include '../../Modelo/BD/bd.php';
    
    $cedula = $_GET['cedula'];

    $sqlPsicologo = "SELECT * FROM psicologo WHERE Cedula = $cedula";
    $sqlCredenciales = "SELECT usuario, contrasena FROM credenciales WHERE id_usuario = $cedula AND tipo_usuario = 'Psicólogo'";

    $resultadoPsicologo = mysqli_query($conn, $sqlPsicologo);
    $resultadoCredenciales = mysqli_query($conn, $sqlCredenciales);

    if ($resultadoPsicologo && mysqli_num_rows($resultadoPsicologo) > 0 && $resultadoCredenciales && mysqli_num_rows($resultadoCredenciales) > 0) {
        $rowPsicologo = mysqli_fetch_assoc($resultadoPsicologo);
        $rowCredenciales = mysqli_fetch_assoc($resultadoCredenciales);
    ?>
    
    <form method="post" action="../../Modelo/GestionPsicologo/actPsicologo.php?Cedula=<?php echo $cedula; ?>" class="form">
        <label>Nombre:</label>
        <input type="text" name="nombre" value="<?php echo $rowPsicologo['Nombre']; ?>" required><br><br>

        <label>Apellido Paterno:</label>
        <input type="text" name="apPaterno" value="<?php echo $rowPsicologo['ApPaterno']; ?>" required><br><br>

        <label>Apellido Materno:</label>
        <input type="text" name="apMaterno" value="<?php echo $rowPsicologo['ApMaterno']; ?>" required><br><br>

        <label>Sexo:</label>
        <input type="text" name="sexo" value="<?php echo $rowPsicologo['sexo']; ?>" required><br><br>

        <label>Teléfono:</label>
        <input type="text" name="telefono" value="<?php echo $rowPsicologo['telefono']; ?>" required><br><br>

        <label>Dirección:</label>
        <input type="text" name="direccion" value="<?php echo $rowPsicologo['direccion']; ?>" required><br><br>

        <label>Fecha de Nacimiento:</label>
        <input type="date" name="fechaNac" value="<?php echo $rowPsicologo['fechaNac']; ?>" required><br><br>

        <label>Usuario:</label>
        <input type="text" name="usuario" value="<?php echo $rowCredenciales['usuario']; ?>" required><br><br>

        <label>Contraseña:</label>
        <input type="password" name="contrasena" value="<?php echo $rowCredenciales['contrasena']; ?>" required><br><br>

        <input type="submit" name="actualizar" value="Guardar Cambios">
    </form>

    <?php
    } else {
        echo "<p>Error: No se encontraron datos del psicólogo.</p>";
    }

    mysqli_close($conn);
    ?>
</body>
</html>

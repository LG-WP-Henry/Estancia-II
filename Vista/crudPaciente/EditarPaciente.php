<!DOCTYPE html>
<html lang="es">
<head>
    <?php     include '../includes/headerregresar.php'; ?>
    <meta charset="UTF-8">
    <title>Editar Paciente</title>
    <link rel="stylesheet" href="../../Vista/Estilos/StylesForAddPAc.css">
</head>
<body>
    <h2>Editar Paciente</h2>

    <?php
    include '../../Modelo/BD/bd.php';


    $id = $_GET['idPaciente'];

    $sql = "SELECT * FROM paciente WHERE idPaciente = $id";
    $resultado = mysqli_query($conn, $sql);

    if ($resultado && mysqli_num_rows($resultado) > 0) {
        $row = mysqli_fetch_assoc($resultado);
    ?>
    
    <form method="post" action="../../Modelo/GestionPacientes/actPaciente.php? idPaciente=<?php echo $id; ?>" class="form">
        <label>Nombre:</label>
        <input type="text" name="nombre" value="<?php echo $row['Nombre']; ?>" required><br><br>

        <label>Apellido Paterno:</label>
        <input type="text" name="apPaterno" value="<?php echo $row['ApPaterno']; ?>" required><br><br>

        <label>Apellido Materno:</label>
        <input type="text" name="apMaterno" value="<?php echo $row['ApMaterno']; ?>" required><br><br>

        <label>Sexo:</label>
        <select id="sexo" name="sexo" class="dropdown" required>
                <option value="<?php echo $row['sexo']; ?>" disabled selected><?php echo $row['sexo']; ?></option>
                <option value="Masculino">Masculino</option>
                <option value="Femenino">Femenino</option>
        </select>

        <label>Teléfono:</label>
        <input type="text" name="telefono" value="<?php echo $row['telefono']; ?>" required><br><br>

        <label>Dirección:</label>
        <input type="text" name="direccion" value="<?php echo $row['direccion']; ?>" required><br><br>

        <label>Fecha de Nacimiento:</label>
        <input type="date" name="fechaNac" value="<?php echo $row['fechaNac']; ?>" required><br><br>

        <input type="submit" name="actualizar" value="Guardar Cambios">
    </form>

    <?php
    } else {
        echo "<p>Error: No se encontraron datos del paciente.</p>";
    }

    mysqli_close($conn);
    ?>
</body>
</html>


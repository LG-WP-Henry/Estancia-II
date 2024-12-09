<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Actividad</title>
    <link rel="stylesheet" href="../../Estilos/StylesForAddPAc.css">
</head>
<body>
    <h2>Editar Actividad</h2>

    <?php
    include '../../Modelo/BD/bd.php';
    
    $id = $_GET['idActividades'];

    $sql = "SELECT * FROM actividades WHERE idActividades = $id";
    $resultado = mysqli_query($conn, $sql);

    if ($resultado && mysqli_num_rows($resultado) > 0) {
        $row = mysqli_fetch_assoc($resultado);
    ?>
    
    <form method="post" action="../../Modelo/GestionActividad/editarActividad_proceso.php? idActividades=<?php echo $id; ?>" class="form">
        <label>Actividad:</label>
        <input type="text" name="actividad" value="<?php echo $row['Actividad']; ?>" required><br><br>

    
        <input type="submit" name="actualizar" value="Guardar Cambios">
    </form>

    <?php
    } else {
        echo "<p>Error: No se encontraron actividades.</p>";
    }

    mysqli_close($conn);
    ?>
</body>
</html>
<?php
    include '../../Modelo/BD/bd.php';
    include '../includes/headerRegresar.php';
    
    $id = $_GET['idPregunta'];

    $sql = "SELECT * FROM preguntas WHERE idPregunta = $id";
    $resultado = mysqli_query($conn, $sql);

    if ($resultado && mysqli_num_rows($resultado) > 0) {
        $row = mysqli_fetch_assoc($resultado);
    ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Pregunta</title>
    <link rel="stylesheet" href="../Estilos/StylesForAddPAc.css">
</head>
<body>
    <h2>Editar Pregunta</h2>


    
    <form method="post" action="../../Modelo/GestionPreguntas/editarPregunta_proceso.php? idPregunta=<?php echo $id; ?>" class="form">
        <label>Pregunta:</label>
        <input type="text" name="pregunta" value="<?php echo $row['Pregunta']; ?>" required><br><br>

    
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
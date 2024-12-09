<!DOCTYPE html>
<html lang="es">
<head>
    <?php include '../includes/headerRegresar.php'; ?>
    <meta charset="UTF-8">
    <title>Editar Actividad</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../Estilos/StylesForAddPAc.css">
</head>
<body class="bg-light">


    <div class="container my-5">
        <h2 class="text-center text-primary mb-4">Editar Actividad</h2>
        <?php
        include '../../Modelo/BD/bd.php';
        
        $id = $_GET['idActividades'];

        $sql = "SELECT * FROM actividades WHERE idActividades = $id";
        $resultado = mysqli_query($conn, $sql);

        if ($resultado && mysqli_num_rows($resultado) > 0) {
            $row = mysqli_fetch_assoc($resultado);
        ?>
        
        <form method="post" action="../../Modelo/GestionActividad/editarActividad_proceso.php?idActividades=<?php echo $id; ?>" class="form">
            <div class="form-group">
                <label for="actividad">Actividad:</label>
                <input type="text" name="actividad" id="actividad" class="form-control" value="<?php echo $row['Actividad']; ?>" required>
            </div>
            <button type="submit" name="actualizar" class="btn btn-primary btn-block">Guardar Cambios</button>
        </form>

        <?php
        } else {
            echo "<p class='text-danger text-center'>Error: No se encontraron actividades.</p>";
        }

        mysqli_close($conn);
        ?>
    </div>

    <!-- Bootstrap JS, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJTYuOHqAyyHnO8MN4TEdgz1Duj8ST8f5T89B5FRz5eF1KpH" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+rZ7pihAxTfWv4w8rP5JpGVPH/nx1tW1p4GRTiqsbtGZR03p" crossorigin="anonymous"></script>
</body>
</html>

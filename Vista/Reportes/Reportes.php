<!DOCTYPE html>
<html lang="es">
<head>
    <?php include '../includes/headerRegresar.php';?>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generar Reportes</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body class="bg-light">
    <div class="container my-5">
        <h1 class="text-center text-primary mb-4">Generar Reportes</h1>
        <form action="../../controlador/Reportes.php" method="GET">
            <div class="form-group">
                <label for="tipo">Seleccione un reporte:</label>
                <select name="tipo" id="tipo" class="form-control" required>
                    <option value="">Seleccione un reporte</option>
                    <option value="hombres_mujeres">Porcentaje Hombres/Mujeres</option>
                    <option value="psicologos_semanal">Pacientes por Psicólogo (Semanal)</option>
                    <option value="psicologos_mensual">Pacientes por Psicólogo (Mensual)</option>
                    <option value="edad_promedio">Edad Promedio (Puntaje Alto)</option>
                    <option value="mejor_avance">Mejor Avance (Puntaje Bajo)</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Generar PDF</button>
        </form>
    </div>

    <!-- Bootstrap JS, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJTYuOHqAyyHnO8MN4TEdgz1Duj8ST8f5T89B5FRz5eF1KpH" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+rZ7pihAxTfWv4w8rP5JpGVPH/nx1tW1p4GRTiqsbtGZR03p" crossorigin="anonymous"></script>
</body>
</html>

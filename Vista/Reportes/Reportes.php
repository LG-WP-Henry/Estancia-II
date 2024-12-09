<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reportes</title>
</head>
<body>
    <h1>Generar Reportes</h1>
    <form action="../../controlador/Reportes.php" method="GET">
        <select name="tipo" required>
            <option value="">Seleccione un reporte</option>
            <option value="hombres_mujeres">Porcentaje Hombres/Mujeres</option>
            <option value="psicologos_semanal">Pacientes por Psicólogo (Semanal)</option>
            <option value="psicologos_mensual">Pacientes por Psicólogo (Mensual)</option>
            <option value="edad_promedio">Edad Promedio (Puntaje Alto)</option>
            <option value="mejor_avance">Mejor Avance (Puntaje Bajo)</option>
        </select>
        <button type="submit">Generar PDF</button>
    </form>
</body>
</html>

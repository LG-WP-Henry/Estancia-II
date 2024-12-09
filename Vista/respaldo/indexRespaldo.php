<?php
include '../includes/headerRegresar.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Backup y Restore</title>
    <!-- Enlace a Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Backup y Restore</h1>
        <div class="mb-4">
            <a href="../../Modelo/conect/Backup.php" class="btn btn-success w-100">Realizar copia de seguridad</a>
        </div>
        <form action="../../Modelo/conect/Restore.php" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="restoreFile" class="form-label">Cargar archivo SQL</label>
                <input type="file" name="restoreFile" id="restoreFile" class="form-control" accept=".sql" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Restaurar</button>
        </form>
    </div>
    <!-- Enlace a Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

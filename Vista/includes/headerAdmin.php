<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Enlace a Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <title>Panel del Psicólogo</title>
</head>
<body>

    <!-- Header -->
    <header class="bg-primary text-white py-3">
        <div class="container d-flex justify-content-between align-items-center">
            <!-- Left side links -->
            <div class="d-flex">
                <a href="Vista/respaldo/indexRespaldo.php" class="btn btn-link text-white">Base de datos</a>
                <a href="Vista/crudCitas/TodasCitas.php" class="btn btn-link text-white">Gestión de Citas</a>
                <a href="Vista/crudPaciente/consultaPacientes.php" class="btn btn-link text-white">Gestión de Pacientes</a>
                <a href="Vista/crudPsicologo/consultaPsicologo.php" class="btn btn-link text-white">Gestión de Psicólogos</a>
                <a href="Vista/crudAdministrador/consultaAdmin.php" class="btn btn-link text-white">Gestión de Administradores</a>
                <a href="Vista/Reportes/Reportes.php" class="btn btn-link text-white">Reportes</a>
                <a class="btn btn-link text-white" href="cambiar_contrasena.php">Cambiar Contraseña</a>
                <a class="btn btn-link text-white" href="Controlador/Logout.php">Cerrar Sesión</a>
            </div>
    </header>

    <!-- Bootstrap JS, jQuery, Popper.js -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</body>
</html>

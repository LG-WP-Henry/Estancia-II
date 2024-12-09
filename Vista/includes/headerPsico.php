<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel del Psicólogo</title>
    <style>
        /* Estilos básicos para el header */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #00bcd4;
            color: white;
            padding: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header-left a, .header-right a {
            color: white;
            text-decoration: none;
            margin: 0 10px;
            padding: 8px 12px;
            border-radius: 4px;
        }

        .header-left a:hover, .header-right a:hover {
            background-color: #008ba3;
        }

        .header-left {
            display: flex;
        }

        .header-right {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            right: 0;
            background-color: #ffffff;
            box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
            z-index: 1;
            min-width: 150px;
            border-radius: 4px;
        }

        .dropdown-content a {
            color: #333;
            padding: 12px 16px;
            display: block;
            text-decoration: none;
        }

        .dropdown-content a:hover {
            background-color: #f1f1f1;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }
    </style>
</head>
<body>
    <header>
        <div class="header-left">
            <a href="Vista/crudCitas/verCitasPsicologo.php">Gestión de Citas</a>
            <a href="Vista/crudPaciente/consultaPacientes.php">Gestión de Pacientes</a>
            <a href="Vista/crudPreguntas/consultarpreguntas.php">Gestión de Preguntas</a>
            <a href="Vista/crudPreguntas/crearCuestionario.php">Gestión de Test</a>
            <a href="gestion_avances.php">Gestión de Avances</a>
        </div>
        <div class="header-right dropdown">
            <a href="javascript:void(0)">Opciones</a>
            <div class="dropdown-content">
                <a href="cambiar_contrasena.php">Cambiar Contraseña</a>
                <a href="Controlador/Logout.php">Cerrar Sesión</a>
            </div>
        </div>
    </header>

    <!-- Resto del contenido de la página -->
</body>
</html>

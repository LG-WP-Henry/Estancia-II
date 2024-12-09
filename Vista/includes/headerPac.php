<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal del Paciente</title>
    <style>
        /* Estilos básicos para el header */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #00bcd4;
            color: black;
            padding: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header-left {
            display: flex;
            gap: 15px;
        }

        .header-left a{
            color: white;
        }

        .header-right  a{
            color: white;
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

        a {
            color: white;
            text-decoration: none;
            padding: 8px 12px;
        }

        a:hover {
            background-color: #008ba3;
            border-radius: 4px;
        }
    </style>
</head>
<body>
    <header>
        <div class="header-left">
            <a href="Vista/crudActividades/mostrar_Actividades_Paciente.php">Actividades Recetadas</a>
            <a href="Vista/crudPreguntas/Test.php">Cuestionarios Realizados</a>
            <a href="Vista/crudCitas/consultaCitas.php">Mostrar Citas</a>
            <a href="Vista/crudCitas/agendar.php">Agendar Cita</a>
        </div>
        <div class="header-right dropdown">
            <a href="javascript:void(0)">Opciones de Usuario</a>
            <div class="dropdown-content">
                <a href="cambiar_contrasena.php">Cambiar Contraseña</a>
                <a href="Controlador/Logout.php">Cerrar Sesión</a>
            </div>
        </div>
    </header>

    <!-- Resto del contenido de la página -->
</body>
</html>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel del Psicólogo</title>
    
    <!-- Normalize.css para resetear estilos -->
    <link rel="stylesheet" href="https://necolas.github.io/normalize.css/8.0.1/normalize.css">
    
    <!-- Google Fonts - Roboto -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    
    <!-- Estilos personalizados -->
    <link href="./Estilos/stylesIP.css" rel="stylesheet" type="text/css">
</head>
<body>

<nav class="navbar navbar-expand-lg"  style="background-color: #007bff; padding: 8px; position: fixed; top: 0; width: 100%; z-index: 1000;"> <!-- fixed-top lo mantiene en la parte superior -->
    <a class="navbar-brand" style="color:#000000">
        Psicólogo Panel
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
        <li class="nav-item">
                <a class="nav-link" href="gestion_avances.php">Gestión de Citas</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="Vista/crudPaciente/consultaPacientes.php">Gestión de Pacientes</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="gestion_preguntas.php">Gestión de Preguntas</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="gestion_test.php">Gestión de Test</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="gestion_avances.php">Gestión de Avances</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="opcionesDropdown" role="button" data-toggle="dropdown">
                    Opciones
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                <ul>
        <li><a href="Vista/crudPaciente/consultaPacientes.php">Gestión de Pacientes</a></li>
        <li><a href="gestion_preguntas.php">Gestión de Preguntas</a></li>
        <li><a href="gestion_test.php">Gestión de Test</a></li>
        <li><a href="gestion_avances.php">Gestión de Avances</a></li>
    </ul>
                </div>
            </li>
        </ul>
    </div>
</nav>

</body>
</html>

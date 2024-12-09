<?php include 'Vista/includes/header.php'; ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión</title>
    <h1>Bienvenido a SADNA</h1>
    
    <link rel="stylesheet" href="Vista/Estilos/styles.css">
</head>

<body>

    <div class="login-container">
        <h2>Inicio de Sesión</h2>
        <form action="Controlador/validacion.php" method="POST">
            <label for="username">Usuario:</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" required>

            <label for="role">Tipo de usuario:</label>
            <select id="role" name="role" class="dropdown" required>
                <option value="" disabled selected>Seleccione</option>
                <option value="Administrador">Administrador</option>
                <option value="Psicólogo">Psicólogo</option>
                <option value="Paciente">Paciente</option>
            </select>

            <input type="submit" value="Iniciar Sesión">
        </form>
    </div>

</body>

</html>

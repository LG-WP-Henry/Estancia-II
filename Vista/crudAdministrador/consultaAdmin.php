<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'Administrador') {
    header("Location: login.php");
    exit();
}

include '../../Modelo/BD/bd.php';
include '../../Vista/includes/headerRegresar.php';

// Consulta para obtener todos los administradores con todos los datos, usuario y contraseña
$sql = "SELECT a.idAdministrador, a.Nombre, a.ApPaterno, a.ApMaterno, 
                c.usuario, c.contrasena
        FROM administrador AS a
        JOIN credenciales AS c ON a.idAdministrador = c.id_usuario
        WHERE c.tipo_usuario = 'Administrador'";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>

<body>
    <div class="container my-5">
        <h1 class="text-center text-primary mb-4">Consulta Administrador</h1>

        <div class="text-right mb-3">
            <a href="CrearAdmin.php" class="btn btn-success">Agregar Administrador</a>
        </div>

        <h2 class="text-secondary">Lista de Administradores</h2>
        
        <div class="table-responsive">
            <table class="table table-hover table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Apellido Paterno</th>
                        <th>Apellido Materno</th>
                        <th>Usuario</th>
                        <th>Contraseña</th>
                        <th>Editar</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                        <tr>
                            <td><?php echo $row['idAdministrador']; ?></td>
                            <td><?php echo $row['Nombre']; ?></td>
                            <td><?php echo $row['ApPaterno']; ?></td>
                            <td><?php echo $row['ApMaterno']; ?></td>
                            <td><?php echo $row['usuario']; ?></td>
                            <td><?php echo $row['contrasena']; ?></td>
                            <td>
                                <a href="EditarAdmin.php?id=<?php echo $row['idAdministrador']; ?>" class="btn btn-primary btn-sm">Editar</a>
                            </td>
                            <td>
                                <a href="javascript:void(0);" onclick="confirmDelete(<?php echo $row['idAdministrador']; ?>)" class="btn btn-danger btn-sm">Eliminar</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <script>
    function confirmDelete(id) {
        if (confirm("¿Estás seguro de que deseas eliminar este registro?")) {
            window.location.href = "../../Modelo/GestionAdmin/eliAdministrador.php?idAdministrador=" + id;
        }
    }
    </script>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>

<?php
mysqli_close($conn);
?>

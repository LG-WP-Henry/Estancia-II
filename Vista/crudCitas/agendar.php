<?php
  include '../../Modelo/BD/bd.php';
  include '../includes/headerregresar.php';

  session_start();
  if (!isset($_SESSION['username'])) {
      header("Location: ../../login.php");
      exit();
  }

  $username = $_SESSION['username'];
  $sql = "SELECT id_usuario FROM credenciales WHERE usuario = '$username';";
  $result = mysqli_query($conn, $sql);
  $paciente = mysqli_fetch_assoc($result);
  ?>


<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Agendar Cita</title>
  <!-- Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

  <style>
    body {
      background-color: #f0f8ff; /* Azul pastel claro */
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }
    .form-container {
      background-color: white;
      padding: 30px;
      border-radius: 8px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      max-width: 500px;
      width: 100%;
    }
  </style>
</head>
<body>
  <div class="form-container">
    <h2 class="text-center mb-4">Agendar una Cita</h2>
    <form action="../../Modelo/GestionCitas/crearCita.php" method="POST">
      <div class="form-group">
        <label for="fecha">Fecha y Hora:</label>
        <input type="datetime-local" id="fecha" name="fecha" class="form-control" required>
      </div>

      <div class="form-group">
        <label for="psicologo">Psicólogo:</label>
        <select id="psicologo" name="CedulaCita" class="form-control" required>
          <?php
          $query = "SELECT Cedula, Nombre, ApPaterno FROM psicologo";
          $result = $conn->query($query);

          if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                  echo "<option value='" . $row['Cedula'] . "'>" . $row['Nombre'] . " " . $row['ApPaterno'] . "</option>";
              }
          } else {
              echo "<option>No hay psicólogos disponibles</option>";
          }
          ?>
        </select>
      </div>

      <input type="hidden" name="idPaciente" value="<?php echo $paciente['id_usuario']; ?>">

      <button type="submit" class="btn btn-primary btn-block">Agendar Cita</button>
    </form>
  </div>

  <!-- Bootstrap JS and dependencies -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

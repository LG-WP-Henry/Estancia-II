<?php
include 'conect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verificar si se cargó un archivo
    if (isset($_FILES['restoreFile']) && $_FILES['restoreFile']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['restoreFile']['tmp_name'];
        $fileName = $_FILES['restoreFile']['name'];
        $fileType = $_FILES['restoreFile']['type'];
        $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);

        // Validar extensión del archivo
        if ($fileExtension === 'sql') {
            // Leer el contenido del archivo
            $sqlContent = file_get_contents($fileTmpPath);

            if ($sqlContent) {
                // Conectar a la base de datos
                $con = mysqli_connect(SERVER, USER, PASS, BD);

                if (!$con) {
                    die("Error al conectar con el servidor: " . mysqli_connect_error());
                }

                mysqli_set_charset($con, 'utf8');

                // Ejecutar el contenido del archivo SQL
                if (mysqli_multi_query($con, $sqlContent)) {
                    // Esperar a que todas las consultas se ejecuten
                    do {
                        if ($result = mysqli_store_result($con)) {
                            mysqli_free_result($result);
                        }
                    } while (mysqli_next_result($con));

                    echo "<script>alert('Base de datos restaurada correctamente');window.location.href='../../Vista/respaldo/indexRespaldo.php';</script>";
                } else {
                    echo "Error al ejecutar las consultas: " . mysqli_error($con);
                }

                // Cerrar conexión
                mysqli_close($con);
            } else {
                echo "Error al leer el contenido del archivo.";
            }
        } else {
            echo "Por favor, suba un archivo con extensión .sql.";
        }
    } else {
        echo "No se cargó ningún archivo.";
    }
} else {
    echo "Método no permitido.";
}
?>

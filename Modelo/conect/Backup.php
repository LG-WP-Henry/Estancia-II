<?php
include 'conect.php';

$day = date("d");
$mont = date("m");
$year = date("Y");
$hora = date("H-i-s");
$fecha = $day . '_' . $mont . '_' . $year;
$DataBASE = $fecha . "_(" . $hora . "_hrs).sql";

$tables = array();
$result = SGBD::sql('SHOW TABLES');

if ($result) {
    while ($row = mysqli_fetch_row($result)) {
        $tables[] = $row[0];
    }
    $sql = 'SET FOREIGN_KEY_CHECKS=0;' . "\n\n";
    $sql .= 'CREATE DATABASE IF NOT EXISTS ' . BD . ";\n\n";
    $sql .= 'USE ' . BD . ";\n\n";

    $error = 0;
    foreach ($tables as $table) {
        $result = SGBD::sql('SELECT * FROM ' . $table);
        if ($result) {
            $numFields = mysqli_num_fields($result);
            $sql .= 'DROP TABLE IF EXISTS ' . $table . ';';
            $row2 = mysqli_fetch_row(SGBD::sql('SHOW CREATE TABLE ' . $table));
            $sql .= "\n\n" . $row2[1] . ";\n\n";
            for ($i = 0; $i < $numFields; $i++) {
                while ($row = mysqli_fetch_row($result)) {
                    $sql .= 'INSERT INTO ' . $table . ' VALUES(';
                    for ($j = 0; $j < $numFields; $j++) {
                        $row[$j] = addslashes($row[$j]);
                        $row[$j] = str_replace("\n", "\\n", $row[$j]);
                        if (isset($row[$j])) {
                            $sql .= '"' . $row[$j] . '"';
                        } else {
                            $sql .= '""';
                        }
                        if ($j < ($numFields - 1)) {
                            $sql .= ',';
                        }
                    }
                    $sql .= ");\n";
                }
            }
            $sql .= "\n\n\n";

            // Respaldo de triggers
            $triggerResult = SGBD::sql("SHOW TRIGGERS WHERE `Table` = '$table'");
            if ($triggerResult) {
                while ($triggerRow = mysqli_fetch_assoc($triggerResult)) {
                    $triggerName = $triggerRow['Trigger'];
                    $triggerTiming = $triggerRow['Timing'];
                    $triggerEvent = $triggerRow['Event'];
                    $triggerStatement = $triggerRow['Statement'];

                    $sql .= "DROP TRIGGER IF EXISTS `$triggerName`;\n\n";
                    $sql .= "CREATE TRIGGER `$triggerName` $triggerTiming $triggerEvent ON `$table`\n";
                    $sql .= "FOR EACH ROW $triggerStatement;\n\n";
                }
            }
        } else {
            $error = 1;
        }
    }

    if ($error == 1) {
        echo 'Ocurrió un error inesperado al crear la copia de seguridad';
    } else {
        $sql .= 'SET FOREIGN_KEY_CHECKS=1;';

        // Configurar encabezados para descarga
        header('Content-Type: application/sql');
        header('Content-Disposition: attachment; filename="' . $DataBASE . '"');
        header('Content-Length: ' . strlen($sql));

        // Enviar el contenido al navegador
        echo $sql;
        exit;
    }
} else {
    echo 'Ocurrió un error inesperado';
}

mysqli_free_result($result);
?>

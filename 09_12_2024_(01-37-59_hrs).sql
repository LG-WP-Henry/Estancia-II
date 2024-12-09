SET FOREIGN_KEY_CHECKS=0;

CREATE DATABASE IF NOT EXISTS Estanciaii;

USE Estanciaii;

DROP TABLE IF EXISTS actividades;

CREATE TABLE `actividades` (
  `idActividades` int(11) NOT NULL AUTO_INCREMENT,
  `Actividad` varchar(45) NOT NULL,
  PRIMARY KEY (`idActividades`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO actividades VALUES("1","Respiración profunda");
INSERT INTO actividades VALUES("2","Meditación guiada");
INSERT INTO actividades VALUES("3","Ejercicio físico");
INSERT INTO actividades VALUES("4","Diario de gratitud");
INSERT INTO actividades VALUES("5","Técnicas de relajación");
INSERT INTO actividades VALUES("6","Terapia cognitivo-conductual");
INSERT INTO actividades VALUES("7","Yoga para la ansiedad");
INSERT INTO actividades VALUES("8","Ejercicios de mindfulness");
INSERT INTO actividades VALUES("9","Dibujar o pintar");
INSERT INTO actividades VALUES("10","Escuchar música relajante");
INSERT INTO actividades VALUES("11","Técnicas de visualización");
INSERT INTO actividades VALUES("12","Lectura de libros");
INSERT INTO actividades VALUES("14","Practicar la meditación");
INSERT INTO actividades VALUES("15","Ejercicio cardiovascular");



DROP TABLE IF EXISTS administrador;

CREATE TABLE `administrador` (
  `idAdministrador` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(45) NOT NULL,
  `ApPaterno` varchar(45) NOT NULL,
  `ApMaterno` varchar(45) NOT NULL,
  PRIMARY KEY (`idAdministrador`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO administrador VALUES("1","Yohana","Vazquez","Velen");



DROP TRIGGER IF EXISTS `crear_credencial_administrador`;

CREATE TRIGGER `crear_credencial_administrador` AFTER INSERT ON `administrador`
FOR EACH ROW BEGIN
  INSERT INTO credenciales (id_usuario, usuario, contrasena, tipo_usuario)
  VALUES (NEW.idAdministrador, CONCAT(NEW.Nombre, '.', NEW.ApPaterno), 'contrasena123', 'Administrador');
END;

DROP TRIGGER IF EXISTS `eliminar_credenciales_administrador`;

CREATE TRIGGER `eliminar_credenciales_administrador` AFTER DELETE ON `administrador`
FOR EACH ROW BEGIN
    DELETE FROM credenciales WHERE id_usuario = OLD.idAdministrador;
END;

DROP TABLE IF EXISTS avances;

CREATE TABLE `avances` (
  `idAvances` int(11) NOT NULL AUTO_INCREMENT,
  `CedulaAv` int(11) NOT NULL,
  `IdPacienteAv` int(11) NOT NULL,
  `Puntaje` int(11) NOT NULL,
  `Actividad` int(11) DEFAULT NULL,
  `Observaciones` varchar(200) NOT NULL,
  `comentariosPac` varchar(400) DEFAULT NULL,
  PRIMARY KEY (`idAvances`),
  KEY `avances_ibfk_1` (`IdPacienteAv`),
  KEY `avances_ibfk_2` (`Actividad`),
  CONSTRAINT `avances_ibfk_1` FOREIGN KEY (`IdPacienteAv`) REFERENCES `paciente` (`idPaciente`) ON DELETE CASCADE,
  CONSTRAINT `avances_ibfk_2` FOREIGN KEY (`Actividad`) REFERENCES `actividades` (`idActividades`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO avances VALUES("3","22","7","15","6","nada","si");
INSERT INTO avances VALUES("4","22","7","15","7","nada","Esta actividad no me gusta, quisiese algo mej");
INSERT INTO avances VALUES("5","22","7","15","8","nada","");
INSERT INTO avances VALUES("6","22","7","15","9","nada","");



DROP TABLE IF EXISTS citas;

CREATE TABLE `citas` (
  `idCitas` int(11) NOT NULL AUTO_INCREMENT,
  `Fecha` datetime NOT NULL,
  `idPacienteCi` int(11) NOT NULL,
  `CedulaCita` int(11) NOT NULL,
  PRIMARY KEY (`idCitas`),
  KEY `citas_ibfk_1` (`CedulaCita`),
  KEY `citas_ibfk_2` (`idPacienteCi`),
  CONSTRAINT `citas_ibfk_1` FOREIGN KEY (`CedulaCita`) REFERENCES `psicologo` (`Cedula`) ON DELETE CASCADE,
  CONSTRAINT `citas_ibfk_2` FOREIGN KEY (`idPacienteCi`) REFERENCES `paciente` (`idPaciente`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO citas VALUES("1","2024-11-01 10:45:00","1","22");
INSERT INTO citas VALUES("2","2024-11-23 11:30:00","1","22");
INSERT INTO citas VALUES("3","2024-11-29 10:00:00","7","22");



DROP TABLE IF EXISTS credenciales;

CREATE TABLE `credenciales` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` varchar(10) NOT NULL,
  `usuario` varchar(100) NOT NULL,
  `contrasena` varchar(100) NOT NULL,
  `tipo_usuario` enum('Paciente','Psicólogo','Administrador') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO credenciales VALUES("1","22","Zochitl.Ramirez","contrasena123","Psicólogo");
INSERT INTO credenciales VALUES("2","1","Charizard.Astolfo","contrasena123","Paciente");
INSERT INTO credenciales VALUES("4","21","Yohana.Vazquez","contrasena123","Administrador");
INSERT INTO credenciales VALUES("7","5","Kenia.Ladal","contrasena123","Paciente");
INSERT INTO credenciales VALUES("8","6","Ramirez.Alfonso","contrasena123","Paciente");
INSERT INTO credenciales VALUES("9","7","Leonel.Calderon","contrasena123","Paciente");
INSERT INTO credenciales VALUES("10","8","America.Selena","contrasena123","Paciente");
INSERT INTO credenciales VALUES("11","9","Felen.Amatur","contrasena123","Paciente");



DROP TABLE IF EXISTS paciente;

CREATE TABLE `paciente` (
  `idPaciente` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(45) NOT NULL,
  `ApPaterno` varchar(45) NOT NULL,
  `ApMaterno` varchar(45) DEFAULT NULL,
  `sexo` varchar(45) DEFAULT NULL,
  `telefono` int(11) DEFAULT NULL,
  `direccion` varchar(50) DEFAULT NULL,
  `fechaNac` date DEFAULT NULL,
  PRIMARY KEY (`idPaciente`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO paciente VALUES("1","Charizard","Astolfo","Garnes","dragon","12345432","IslaPokemon","2000-04-12");
INSERT INTO paciente VALUES("5","Kenia","Ladal","Veronica","F","1234567890","Calle girasoles cardenaz 1","1990-01-01");
INSERT INTO paciente VALUES("6","Ramirez","Alfonso","Segovia","M","1234567891","Kelox, Berengena simon 2","1991-02-01");
INSERT INTO paciente VALUES("7","Leonel","Calderon","Arroyo","M","1234567892","Avedules45 Georga 3","1992-03-01");
INSERT INTO paciente VALUES("8","America","Selena","Maria","F","1234567893","Fiscali General 4","1993-04-01");
INSERT INTO paciente VALUES("9","Felen","Amatur","Gallardo","M","1234567894","Selenaski Sptimo 5","1994-05-01");



DROP TRIGGER IF EXISTS `crear_credencial_paciente`;

CREATE TRIGGER `crear_credencial_paciente` AFTER INSERT ON `paciente`
FOR EACH ROW BEGIN
  INSERT INTO credenciales (id_usuario, usuario, contrasena, tipo_usuario)
  VALUES (NEW.idPaciente, CONCAT(NEW.Nombre, '.', NEW.ApPaterno), 'contrasena123', 'Paciente');
END;

DROP TRIGGER IF EXISTS `eliminar_credenciales_paciente`;

CREATE TRIGGER `eliminar_credenciales_paciente` AFTER DELETE ON `paciente`
FOR EACH ROW BEGIN
    DELETE FROM credenciales WHERE id_usuario = OLD.idPaciente;
END;

DROP TABLE IF EXISTS preguntas;

CREATE TABLE `preguntas` (
  `idPregunta` int(11) NOT NULL AUTO_INCREMENT,
  `Pregunta` varchar(45) NOT NULL,
  PRIMARY KEY (`idPregunta`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO preguntas VALUES("1","¿Se siente ansioso frecuentemente?");
INSERT INTO preguntas VALUES("2","¿Tiene dificultad para relajarse?");
INSERT INTO preguntas VALUES("3","¿Se siente inquieto o agitado?");
INSERT INTO preguntas VALUES("4","¿Tiene problemas para dormir?");
INSERT INTO preguntas VALUES("5","¿Le cuesta concentrarse?");
INSERT INTO preguntas VALUES("6","¿Evita situaciones sociales?");
INSERT INTO preguntas VALUES("7","¿Tiene ataques de pánico?");
INSERT INTO preguntas VALUES("8","¿Se siente abrumado?");
INSERT INTO preguntas VALUES("9","¿Tiene miedo a perder el control?");
INSERT INTO preguntas VALUES("10","¿Tiene pensamientos negativos repetitivos?");
INSERT INTO preguntas VALUES("11","¿Se siente tenso o con músculos rígidos?");
INSERT INTO preguntas VALUES("12","¿Le preocupa constantemente el futuro?");
INSERT INTO preguntas VALUES("13","¿Tiene problemas para concentrarse?");
INSERT INTO preguntas VALUES("14","¿Se siente cansado sin razón aparente?");
INSERT INTO preguntas VALUES("15","¿Tiene problemas digestivos relacionados con ");



DROP TABLE IF EXISTS psicologo;

CREATE TABLE `psicologo` (
  `Cedula` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(45) NOT NULL,
  `ApPaterno` varchar(45) NOT NULL,
  `ApMaterno` varchar(45) NOT NULL,
  `sexo` varchar(45) DEFAULT NULL,
  `telefono` int(11) DEFAULT NULL,
  `direccion` varchar(50) DEFAULT NULL,
  `fechaNac` date DEFAULT NULL,
  PRIMARY KEY (`Cedula`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO psicologo VALUES("22","Zochitl","Ramirez","Aldana","Femenino","2147483647","DeNingunLugar","2003-01-22");



DROP TRIGGER IF EXISTS `crear_credencial_psicologo`;

CREATE TRIGGER `crear_credencial_psicologo` AFTER INSERT ON `psicologo`
FOR EACH ROW BEGIN
  INSERT INTO credenciales (id_usuario, usuario, contrasena, tipo_usuario)
  VALUES (NEW.Cedula, CONCAT(NEW.Nombre, '.', NEW.ApPaterno), 'contrasena123', 'Psicólogo');
END;

DROP TABLE IF EXISTS puntaje;

CREATE TABLE `puntaje` (
  `idPuntaje` int(11) NOT NULL AUTO_INCREMENT,
  `Puntaje` int(11) DEFAULT NULL,
  `idPacientePun` int(11) DEFAULT NULL,
  PRIMARY KEY (`idPuntaje`),
  KEY `puntaje_ibfk_1` (`idPacientePun`),
  CONSTRAINT `puntaje_ibfk_1` FOREIGN KEY (`idPacientePun`) REFERENCES `test` (`idPacienteTst`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;




DROP TABLE IF EXISTS test;

CREATE TABLE `test` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `CedulaAvTst` int(11) NOT NULL,
  `idPacienteTst` int(11) NOT NULL,
  `idPreguntaTst` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `idtestP` int(11) DEFAULT NULL,
  `realizado` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `test_ibfk_1` (`CedulaAvTst`),
  KEY `test_ibfk_2` (`idPacienteTst`),
  KEY `test_ibfk_3` (`idPreguntaTst`),
  CONSTRAINT `test_ibfk_1` FOREIGN KEY (`CedulaAvTst`) REFERENCES `psicologo` (`Cedula`) ON DELETE CASCADE,
  CONSTRAINT `test_ibfk_2` FOREIGN KEY (`idPacienteTst`) REFERENCES `paciente` (`idPaciente`) ON DELETE CASCADE,
  CONSTRAINT `test_ibfk_3` FOREIGN KEY (`idPreguntaTst`) REFERENCES `preguntas` (`idPregunta`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO test VALUES("26","22","7","1","2024-11-28","8667","1");
INSERT INTO test VALUES("27","22","7","6","2024-11-28","8667","1");
INSERT INTO test VALUES("28","22","7","7","2024-11-28","8667","1");
INSERT INTO test VALUES("29","22","7","8","2024-11-28","8667","1");
INSERT INTO test VALUES("30","22","7","10","2024-11-28","8667","1");
INSERT INTO test VALUES("31","22","7","12","2024-11-28","8667","1");



SET FOREIGN_KEY_CHECKS=1;
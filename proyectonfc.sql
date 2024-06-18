-- --------------------------------------------------------
-- Host:                         cpd.iesgrancapitan.org
-- Versión del servidor:         10.6.16-MariaDB-0ubuntu0.22.04.1 - Ubuntu 22.04
-- SO del servidor:              debian-linux-gnu
-- HeidiSQL Versión:             12.7.0.6874
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Volcando estructura de base de datos para grancapitan
CREATE DATABASE IF NOT EXISTS `grancapitan` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `grancapitan`;

-- Volcando estructura para tabla grancapitan.administracion
CREATE TABLE IF NOT EXISTS `administracion` (
  `idAdministracion` int(11) NOT NULL AUTO_INCREMENT,
  `idUsuario` int(11) NOT NULL,
  PRIMARY KEY (`idAdministracion`),
  KEY `idUsuario` (`idUsuario`),
  CONSTRAINT `administracion_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla grancapitan.administracion: ~1 rows (aproximadamente)
DELETE FROM `administracion`;
INSERT INTO `administracion` (`idAdministracion`, `idUsuario`) VALUES
	(1, 1);

-- Volcando estructura para tabla grancapitan.carro
CREATE TABLE IF NOT EXISTS `carro` (
  `idCarro` int(11) NOT NULL AUTO_INCREMENT,
  `idUsuario` int(11) DEFAULT NULL,
  `idProducto` int(11) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  PRIMARY KEY (`idCarro`),
  KEY `idUsuario` (`idUsuario`),
  KEY `carro_ibfk_2` (`idProducto`),
  CONSTRAINT `carro_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`idUsuario`),
  CONSTRAINT `carro_ibfk_2` FOREIGN KEY (`idProducto`) REFERENCES `productos` (`idProducto`)
) ENGINE=InnoDB AUTO_INCREMENT=249 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla grancapitan.carro: ~0 rows (aproximadamente)
DELETE FROM `carro`;

-- Volcando estructura para tabla grancapitan.conserje
CREATE TABLE IF NOT EXISTS `conserje` (
  `idConserje` int(11) NOT NULL AUTO_INCREMENT,
  `idUsuario` int(11) NOT NULL,
  PRIMARY KEY (`idConserje`) USING BTREE,
  KEY `idUsuario` (`idUsuario`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla grancapitan.conserje: ~1 rows (aproximadamente)
DELETE FROM `conserje`;
INSERT INTO `conserje` (`idConserje`, `idUsuario`) VALUES
	(2, 2);

-- Volcando estructura para tabla grancapitan.fechabajatarjetas
CREATE TABLE IF NOT EXISTS `fechabajatarjetas` (
  `idBaja` int(11) NOT NULL,
  `idTarjeta` varchar(50) NOT NULL,
  `Causa` enum('Baja_matricula',' Perdida','Deteriorio','Baja_Profesor') CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `Fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla grancapitan.fechabajatarjetas: ~0 rows (aproximadamente)
DELETE FROM `fechabajatarjetas`;

-- Volcando estructura para tabla grancapitan.perfiles
CREATE TABLE IF NOT EXISTS `perfiles` (
  `idPerfil` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(255) NOT NULL,
  PRIMARY KEY (`idPerfil`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla grancapitan.perfiles: ~5 rows (aproximadamente)
DELETE FROM `perfiles`;
INSERT INTO `perfiles` (`idPerfil`, `Nombre`) VALUES
	(1, 'Admin'),
	(2, 'Profesor'),
	(3, 'Alumno'),
	(4, 'Conserje'),
	(5, 'Secretario');

-- Volcando estructura para tabla grancapitan.productos
CREATE TABLE IF NOT EXISTS `productos` (
  `idProducto` int(11) NOT NULL AUTO_INCREMENT,
  `precio` varchar(10) NOT NULL,
  `codigo` varchar(10) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  PRIMARY KEY (`idProducto`),
  UNIQUE KEY `codigo` (`codigo`),
  UNIQUE KEY `precio` (`precio`),
  CONSTRAINT `chk_precio` CHECK (`precio` <> ''),
  CONSTRAINT `chk_codigo` CHECK (`codigo` <> ''),
  CONSTRAINT `chk_nombre` CHECK (`nombre` <> '')
) ENGINE=InnoDB AUTO_INCREMENT=82 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla grancapitan.productos: ~20 rows (aproximadamente)
DELETE FROM `productos`;
INSERT INTO `productos` (`idProducto`, `precio`, `codigo`, `nombre`) VALUES
	(1, '050', '050', '0.50€'),
	(2, '500', '500', '5.00€'),
	(3, '550', '550', '5.50€'),
	(4, '600', '600', '6.00€'),
	(5, '650', '650', '6.50€'),
	(6, '700', '700', '7.00€'),
	(7, '750', '750', '7.50€'),
	(8, '800', '800', '8.00€'),
	(9, '850', '850', '8.50€'),
	(10, '900', '900', '9.00€'),
	(11, '950', '950', '9.50€'),
	(12, '100', '100', '1.00€'),
	(13, '1000', '1000', '10.00€'),
	(14, '150', '150', '1.50€'),
	(15, '200', '200', '2.00€'),
	(16, '250', '250', '2.50€'),
	(17, '300', '300', '3.00€'),
	(18, '350', '350', '3.50€'),
	(19, '400', '400', '4.00€'),
	(20, '450', '450', '4.50€');

-- Volcando estructura para tabla grancapitan.recogidas
CREATE TABLE IF NOT EXISTS `recogidas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_padre` varchar(255) NOT NULL,
  `dni_padre` varchar(9) NOT NULL,
  `alumno` varchar(100) NOT NULL,
  `curso` varchar(50) NOT NULL,
  `fecha_salida` date NOT NULL DEFAULT '0000-00-00',
  `motivo_salida` varchar(100) NOT NULL,
  `otro_motivo` varchar(100) DEFAULT NULL,
  `opciones` varchar(100) NOT NULL,
  `otra_opcion` varchar(100) DEFAULT NULL,
  `relacion_familiar` varchar(100) DEFAULT NULL,
  `otro_familiar` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla grancapitan.recogidas: ~5 rows (aproximadamente)
DELETE FROM `recogidas`;
INSERT INTO `recogidas` (`id`, `nombre_padre`, `dni_padre`, `alumno`, `curso`, `fecha_salida`, `motivo_salida`, `otro_motivo`, `opciones`, `otra_opcion`, `relacion_familiar`, `otro_familiar`) VALUES
	(1, 'Jose Antonio', '34567384K', 'Enrique Guzman', '2ºGSASIRA', '2023-06-14', 'opcion1', '', 'opcion_a', '', NULL, NULL),
	(2, 'Maria', '12345654F', 'Alberto ', '2ºGSASIRA', '2023-06-13', 'opcion3', '', 'opcion_b', 'Libro Familia', '', ''),
	(3, 'Antonio Bermudez', '12345654F', 'Manuel ', '2ºGSDAWA', '2023-06-16', 'opcion2', '', 'opcion_b', 'Libro Familia', '', ''),
	(4, 'Pepe', '45125457P', 'Enrique Guzman', '2ºGSASIRA', '2023-06-08', 'Enfermedad o imprevisto médico urgente', '', 'DNI del Padre/Madre o Tutor legal o autorizado en Séneca', '', '', ''),
	(5, 'Maria', '12346578L', 'Alumno 1', '1ºESOD', '2023-06-19', 'Deber inexcusable', '', 'Otro', 'Libro familia', '', '');

-- Volcando estructura para tabla grancapitan.salida_recreo
CREATE TABLE IF NOT EXISTS `salida_recreo` (
  `NIE` varchar(9) NOT NULL DEFAULT '0',
  `FECHA` date NOT NULL DEFAULT '0000-00-00',
  `HORA` time NOT NULL DEFAULT '00:00:00',
  `Apellidos` varchar(60) NOT NULL DEFAULT '',
  `Nombre` varchar(30) NOT NULL DEFAULT '',
  PRIMARY KEY (`NIE`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- Volcando datos para la tabla grancapitan.salida_recreo: ~0 rows (aproximadamente)
DELETE FROM `salida_recreo`;

-- Volcando estructura para tabla grancapitan.tarjetas
CREATE TABLE IF NOT EXISTS `tarjetas` (
  `idTarjeta` varchar(50) NOT NULL DEFAULT 'AUTO_INCREMENT',
  `activo` tinyint(1) NOT NULL,
  PRIMARY KEY (`idTarjeta`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla grancapitan.tarjetas: ~5 rows (aproximadamente)
DELETE FROM `tarjetas`;
INSERT INTO `tarjetas` (`idTarjeta`, `activo`) VALUES
	('0441679171', 1),
	('0482006259', 1),
	('0482248819', 1),
	('0482648931', 1),
	('0482722259', 1);

-- Volcando estructura para tabla grancapitan.usuarios
CREATE TABLE IF NOT EXISTS `usuarios` (
  `idUsuario` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) DEFAULT NULL,
  `email` varchar(250) DEFAULT NULL,
  `nie` varchar(50) DEFAULT NULL,
  `unidad` varchar(20) DEFAULT NULL,
  `departamento` varchar(20) DEFAULT NULL,
  `idPerfil` int(11) NOT NULL,
  `last_present` time NOT NULL DEFAULT '00:00:00',
  `mayor_edad` varchar(2) DEFAULT NULL CHECK (`mayor_edad` in ('si','no')),
  `saldo` int(10) DEFAULT 0,
  PRIMARY KEY (`idUsuario`),
  UNIQUE KEY `email` (`email`,`nie`),
  UNIQUE KEY `email_2` (`email`),
  UNIQUE KEY `nie` (`nie`),
  KEY `idPerfil` (`idPerfil`),
  CONSTRAINT `FK_idPerfil` FOREIGN KEY (`idPerfil`) REFERENCES `perfiles` (`idPerfil`)
) ENGINE=InnoDB AUTO_INCREMENT=121 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla grancapitan.usuarios: ~26 rows (aproximadamente)
DELETE FROM `usuarios`;
INSERT INTO `usuarios` (`idUsuario`, `nombre`, `email`, `nie`, `unidad`, `departamento`, `idPerfil`, `last_present`, `mayor_edad`, `saldo`) VALUES
	(1, 'admin', 'admin@iesgrancapitan.org', '123456789', NULL, 'dpto-administrador', 1, '00:00:00', NULL, 1000),
	(2, 'conserje', 'conserje@iesgrancapitan.org', '987654321', NULL, 'dpto-conserjeria', 4, '00:00:00', NULL, 2000),
	(3, 'Jose', 'joseaguilera@iesgrancapitan.org', NULL, NULL, 'dpto-informatica', 2, '00:00:00', NULL, 0),
	(4, 'Federico', 'federico@iesgrancapitan.org', NULL, NULL, 'dpto-musica', 2, '00:00:00', NULL, 0),
	(5, 'Jose Ramón', 'jralbendin@iesgrancapitan.org', NULL, NULL, 'dpto-informatica', 2, '00:00:00', NULL, 0),
	(6, 'Jaime', 'jalcazar@iesgrancapitan.org', NULL, NULL, 'dpto-matematicas', 2, '00:00:00', NULL, 0),
	(7, 'Antonia', 'anruser@iesgrancapitan.org', NULL, NULL, 'dpto-economia-fol', 2, '00:00:00', NULL, 0),
	(8, 'Isabel', 'isaantunez@iesgrancapitan.org', NULL, NULL, 'dpto-matematicas', 2, '00:00:00', NULL, 0),
	(9, 'Sara', 'p19arsara@iesgrancapitan.org', NULL, NULL, 'dpto-hosteleria', 2, '00:00:00', NULL, 0),
	(10, 'Regino', 'reginoarribas@iesgrancapitan.org', NULL, NULL, 'dpto-hosteleria', 2, '00:00:00', NULL, 0),
	(11, 'Abel', 'abelper@iesgrancapitan.org', NULL, NULL, 'dpto-matematicas', 2, '00:00:00', NULL, 0),
	(12, 'Chaves', 'chaves@iesgrancapitan.org', '964563219', '2ºDAWA', NULL, 3, '00:00:00', 'si', 0),
	(13, 'Cebrián', 'cebri@iesgrancapitan.org', '741852963', '2ºDAWA', NULL, 3, '00:00:00', 'si', 0),
	(14, 'Mariscal', 'mariscal@iesgrancapitan.org', '963258741', '2ºDAWA', NULL, 3, '11:02:39', 'si', 0),
	(15, 'Virginia', 'virgi@iesgrancapitan.org', '789456123', '2ºDAWA', NULL, 3, '16:31:50', 'si', 0),
	(16, 'Joaquin', 'joa@iesgrancapitan.org', '321456987', '2ºASIRA', NULL, 3, '00:00:00', 'si', 0),
	(17, 'Alberto', 'alberto@iesgrancapitan.org', '123654789', '2ºASIRA', NULL, 3, '00:00:00', 'si', 0),
	(18, 'Sandra', 'sandra@iesgrancapitan.org', '147852369', '2ºASIRA', NULL, 3, '17:07:06', 'si', 0),
	(19, 'Miguel', 'miguel@iesgrancapitan.org', '369852147', '2ºASIRA', NULL, 3, '00:00:00', 'si', 0),
	(20, 'Risitas', 'risitas@iesgrancapitan.org', '753159654', '1ºESOD', NULL, 3, '06:57:09', 'no', 0),
	(21, 'Marcos', 'marcos@iesgrancapitan.org', '951357852', '3ºESOB', NULL, 3, '11:51:32', 'no', 0),
	(22, 'Enrique Guzman', 'enrique@iesgrancapitan.org', '852963741', '2ºASIRA', NULL, 3, '00:00:00', 'si', 0),
	(23, 'Carmen Tripiana', 'mctripiana@iesgrancapitan.org', '741963258', '2ºASIRA', 'dpto-informatica', 1, '11:56:37', 'si', 0),
	(24, 'David Lopez', 'david.lopez.fernandez@iesgrancapitan.org', '369159357', '2ºASIRA', 'dpto-informatica', 2, '00:00:00', 'si', 3000),
	(25, 'Javier', 'javierhosteleria@iesgrancapitan.org', '258456951', '2ºHOSTELERIA', NULL, 3, '10:17:18', 'si', 4000),
	(26, 'secretario1', 'secretario1@iesgrancapitan.org', '967456328', NULL, 'dpto-secretaria', 5, '00:00:00', 'si', 0);

-- Volcando estructura para tabla grancapitan.usuarios_tarjetas
CREATE TABLE IF NOT EXISTS `usuarios_tarjetas` (
  `idUserTarje` int(11) NOT NULL AUTO_INCREMENT,
  `idUsuario` int(11) NOT NULL,
  `idTarjeta` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`idUserTarje`),
  KEY `FK_idUser_Tarj` (`idUsuario`),
  KEY `FK_idTarj_User` (`idTarjeta`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla grancapitan.usuarios_tarjetas: ~5 rows (aproximadamente)
DELETE FROM `usuarios_tarjetas`;
INSERT INTO `usuarios_tarjetas` (`idUserTarje`, `idUsuario`, `idTarjeta`) VALUES
	(1, 1, '0482648931'),
	(30, 25, '0482006259'),
	(31, 2, '0482722259'),
	(32, 24, '0482248819'),
	(33, 26, '0441679171');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;

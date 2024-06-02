-- --------------------------------------------------------
-- Host:                         single-2364.banahosting.com
-- Versión del servidor:         10.6.17-MariaDB-cll-lve - MariaDB Server
-- SO del servidor:              Linux
-- HeidiSQL Versión:             12.3.0.6589
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Volcando estructura de base de datos para qymfjiir_rrhh
CREATE DATABASE IF NOT EXISTS `qymfjiir_rrhh` /*!40100 DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci */;
USE `qymfjiir_rrhh`;

-- Volcando estructura para tabla qymfjiir_rrhh.categoria
CREATE TABLE IF NOT EXISTS `categoria` (
  `idCategoria` int(11) NOT NULL AUTO_INCREMENT,
  `nomCategoria` varchar(45) NOT NULL,
  PRIMARY KEY (`idCategoria`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- Volcando datos para la tabla qymfjiir_rrhh.categoria: ~4 rows (aproximadamente)
DELETE FROM `categoria`;
INSERT INTO `categoria` (`idCategoria`, `nomCategoria`) VALUES
	(1, 'DIRECTOR DE GESTION'),
	(2, 'INFORMATICO'),
	(3, 'AUXILIAR ADMINISTRATIVO'),
	(4, 'JEFE PERSONAL');

-- Volcando estructura para tabla qymfjiir_rrhh.personal
CREATE TABLE IF NOT EXISTS `personal` (
  `idPersonal` int(11) NOT NULL AUTO_INCREMENT,
  `apellidos` varchar(45) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `fecNac` date NOT NULL,
  `idCategoria` int(11) NOT NULL,
  PRIMARY KEY (`idPersonal`),
  KEY `fk_Personal_Categoria1` (`idCategoria`),
  CONSTRAINT `fk_Personal_Categoria1` FOREIGN KEY (`idCategoria`) REFERENCES `categoria` (`idCategoria`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- Volcando datos para la tabla qymfjiir_rrhh.personal: ~6 rows (aproximadamente)
DELETE FROM `personal`;
INSERT INTO `personal` (`idPersonal`, `apellidos`, `nombre`, `fecNac`, `idCategoria`) VALUES
	(3, 'GARCIA GARCIA', 'FERNANDO', '1984-07-15', 1),
	(5, 'MARTIN MARTIN', 'JIMENA', '1997-04-15', 3),
	(6, 'JIMENEZ JIMENEZ', 'ADELA', '1967-02-14', 3),
	(7, 'ESTEVANEZ CASAS', 'ANGEL', '2004-03-16', 2),
	(8, 'GARCIA GONZALEZ', 'EVA', '1988-04-15', 4),
	(14, 'PEREZ MALDONADO', 'JUAN', '1957-03-12', 4);

-- Volcando estructura para tabla qymfjiir_rrhh.solicitud
CREATE TABLE IF NOT EXISTS `solicitud` (
  `idSolicitud` int(11) NOT NULL AUTO_INCREMENT,
  `fecSolicitud` date NOT NULL,
  `fecInicial` date NOT NULL,
  `fecFinal` date NOT NULL,
  `diasSolicitados` int(11) NOT NULL,
  `autorizado` tinyint(4) DEFAULT 0,
  `sustituto` tinyint(4) DEFAULT 0,
  `idPersonal` int(11) NOT NULL,
  PRIMARY KEY (`idSolicitud`),
  KEY `fk_Solicitudes_Personal1` (`idPersonal`),
  CONSTRAINT `fk_Solicitudes_Personal1` FOREIGN KEY (`idPersonal`) REFERENCES `personal` (`idPersonal`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- Volcando datos para la tabla qymfjiir_rrhh.solicitud: ~17 rows (aproximadamente)
DELETE FROM `solicitud`;
INSERT INTO `solicitud` (`idSolicitud`, `fecSolicitud`, `fecInicial`, `fecFinal`, `diasSolicitados`, `autorizado`, `sustituto`, `idPersonal`) VALUES
	(3, '2024-04-01', '2024-04-08', '2024-04-11', 4, 1, 0, 5),
	(11, '2024-04-15', '2024-02-10', '2024-02-15', 6, 2, 0, 5),
	(12, '2024-04-15', '2024-03-03', '2024-03-04', 2, 1, 0, 5),
	(14, '2024-04-15', '2024-02-18', '2024-02-20', 3, 1, 0, 7),
	(15, '2024-04-15', '2024-03-10', '2024-03-15', 6, 1, 0, 7),
	(16, '2024-04-15', '2024-01-03', '2024-01-05', 3, 1, 0, 7),
	(25, '2024-04-28', '2024-03-04', '2024-03-08', 5, 1, 0, 8),
	(26, '2024-04-28', '2024-04-08', '2024-04-09', 2, 0, 0, 8),
	(27, '2024-04-28', '2024-05-02', '2024-05-03', 2, 0, 0, 8),
	(28, '2024-05-22', '2024-05-01', '2024-05-03', 3, 1, 0, 5),
	(29, '2024-05-22', '2024-05-08', '2024-05-10', 3, 1, 0, 5),
	(30, '2024-05-22', '2024-05-14', '2024-05-14', 1, 1, 0, 5),
	(31, '2024-05-22', '2024-06-03', '2024-06-07', 5, 1, 0, 5),
	(32, '2024-05-22', '2024-05-06', '2024-05-09', 4, 0, 0, 7),
	(33, '2024-05-22', '2024-05-20', '2024-05-24', 5, 1, 0, 7),
	(34, '2024-05-22', '2024-06-03', '2024-06-14', 10, 1, 0, 7),
	(35, '2024-05-25', '2024-05-20', '2024-05-24', 5, 0, 0, 7);

-- Volcando estructura para tabla qymfjiir_rrhh.solicitud_has_sustituto
CREATE TABLE IF NOT EXISTS `solicitud_has_sustituto` (
  `idSolicitud` int(11) NOT NULL,
  `idSustituto` int(11) NOT NULL,
  PRIMARY KEY (`idSolicitud`,`idSustituto`),
  KEY `fk_Solicitud_has_Sustituto_Sustituto1` (`idSustituto`),
  CONSTRAINT `fk_Solicitud_has_Sustituto_Solicitud1` FOREIGN KEY (`idSolicitud`) REFERENCES `solicitud` (`idSolicitud`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Solicitud_has_Sustituto_Sustituto1` FOREIGN KEY (`idSustituto`) REFERENCES `sustituto` (`idSustituto`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- Volcando datos para la tabla qymfjiir_rrhh.solicitud_has_sustituto: ~6 rows (aproximadamente)
DELETE FROM `solicitud_has_sustituto`;
INSERT INTO `solicitud_has_sustituto` (`idSolicitud`, `idSustituto`) VALUES
	(3, 2),
	(12, 2),
	(14, 4),
	(29, 5),
	(31, 3),
	(33, 4),
	(34, 6);

-- Volcando estructura para tabla qymfjiir_rrhh.sustituto
CREATE TABLE IF NOT EXISTS `sustituto` (
  `idSustituto` int(11) NOT NULL AUTO_INCREMENT,
  `apellidos` varchar(45) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `fecNac` date NOT NULL,
  `idCategoria` int(11) NOT NULL,
  PRIMARY KEY (`idSustituto`),
  KEY `fk_Sustituto_Categoria1` (`idCategoria`),
  CONSTRAINT `fk_Sustituto_Categoria1` FOREIGN KEY (`idCategoria`) REFERENCES `categoria` (`idCategoria`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- Volcando datos para la tabla qymfjiir_rrhh.sustituto: ~6 rows (aproximadamente)
DELETE FROM `sustituto`;
INSERT INTO `sustituto` (`idSustituto`, `apellidos`, `nombre`, `fecNac`, `idCategoria`) VALUES
	(2, 'DIAZ MERCUDES', 'EDUARDO', '2005-04-15', 3),
	(3, 'ROMERO SANLUCAR', 'MARIA', '2024-04-15', 3),
	(4, 'PEREZ PARDILLO', 'RAUL', '0000-00-00', 2),
	(5, 'MANZANO PERAL', 'ANA', '0000-00-00', 3),
	(6, 'VERDUGO MORADO', 'MIGUEL', '0000-00-00', 2),
	(7, 'ESTUPENDO MORAL', 'JUAN', '0000-00-00', 4);

-- Volcando estructura para tabla qymfjiir_rrhh.usuarios
CREATE TABLE IF NOT EXISTS `usuarios` (
  `login` varchar(15) NOT NULL,
  `clave` varchar(15) NOT NULL,
  `acceso` int(11) NOT NULL,
  `idPersonal` int(11) NOT NULL,
  PRIMARY KEY (`login`),
  KEY `fk_Usuarios_Personal1` (`idPersonal`),
  CONSTRAINT `fk_Usuarios_Personal1` FOREIGN KEY (`idPersonal`) REFERENCES `personal` (`idPersonal`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- Volcando datos para la tabla qymfjiir_rrhh.usuarios: ~5 rows (aproximadamente)
DELETE FROM `usuarios`;
INSERT INTO `usuarios` (`login`, `clave`, `acceso`, `idPersonal`) VALUES
	('aestevanez', '123456', 1, 7),
	('ajimenez', '123456', 1, 6),
	('egarcia', '123456', 2, 8),
	('fgarcia', '123456', 3, 3),
	('jmartin', '123456', 1, 5);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;

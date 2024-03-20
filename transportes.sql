-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 25-11-2020 a las 15:47:27
-- Versión del servidor: 8.0.21
-- Versión de PHP: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `transportes`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `archivo`
--

DROP TABLE IF EXISTS `archivo`;
CREATE TABLE IF NOT EXISTS `archivo` (
  `codigo` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `nombre` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `tipo_documento` int DEFAULT NULL,
  `documento_id` int NOT NULL,
  `revision` int NOT NULL,
  `emision` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish2_ci DEFAULT NULL,
  `archivo` varchar(500) CHARACTER SET utf8 COLLATE utf8_spanish2_ci DEFAULT NULL,
  `estado` int NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `archivo`
--

INSERT INTO `archivo` (`codigo`, `nombre`, `tipo_documento`, `documento_id`, `revision`, `emision`, `archivo`, `estado`) VALUES
('R-001', 'MODELO DE EXPOSICION.pptx', 3, 1, 0, '18-10-2020', '../Documentos/MODELO DE EXPOSICION.pptx', 1),
('R-002', 'mejoras.txt', 3, 1, 0, '30-10-2020', '../Documentos/mejoras.txt', 1),
('PL-001', 'mejoras.txt', 2, 1, 0, '30-10-2020', '../Documentos/mejoras.txt', 1),
('DL-001', 'logo.png', 5, 5, 0, '04-11-2020', '../Documentos/logo.png', 1),
('R-003', 'PurpleWall.jpg', 3, 16, 0, '04-11-2020', '../Documentos/PurpleWall.jpg', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

DROP TABLE IF EXISTS `categoria`;
CREATE TABLE IF NOT EXISTS `categoria` (
  `id` int NOT NULL AUTO_INCREMENT,
  `categoria` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `cod_categoria` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id`, `categoria`, `cod_categoria`) VALUES
(1, 'Procedimientos', 'P'),
(2, 'Planes', 'PL'),
(3, 'Registros', 'R'),
(4, 'Informes', 'INF'),
(5, 'Documentos Legales', 'DL');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documento`
--

DROP TABLE IF EXISTS `documento`;
CREATE TABLE IF NOT EXISTS `documento` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `emision` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish2_ci DEFAULT NULL,
  `fecha_programada` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish2_ci DEFAULT NULL,
  `estado_documento` int NOT NULL,
  `tipo_documento` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `documento`
--

INSERT INTO `documento` (`id`, `nombre`, `emision`, `fecha_programada`, `estado_documento`, `tipo_documento`) VALUES
(1, 'Analisis FODA', NULL, NULL, 1, 1),
(2, 'Mapa de Procesos', NULL, '28-11-2020', 3, 1),
(3, 'Matriz de partes interesadas', NULL, '27-11-2020', 3, 1),
(4, 'Alcance', NULL, '28-11-2020', 3, 1),
(5, 'Politica', NULL, '04-12-2020', 4, 1),
(6, 'Evidencia de liderazgo y compromiso', NULL, NULL, 3, 1),
(7, 'Matriz de riesgos y oportunidades', NULL, '09-08-2020', 3, 1),
(8, 'Roles y responsabilidades', NULL, '17-08-2020', 3, 1),
(9, 'Matriz IPER', NULL, '21-09-2020', 3, 1),
(10, 'Matriz de requisitos legales', NULL, '25-10-2020', 3, 1),
(11, 'Planificacion de objetivos', NULL, '31-10-2020', 3, 1),
(12, 'Evidencia de recursos designados', NULL, '22-10-2020', 3, 2),
(13, 'Matriz de competencias', NULL, '10-10-2020', 3, 2),
(14, 'Plan de toma de consciencia', NULL, '24-10-2020', 3, 2),
(15, 'Matriz de comunicacion', NULL, '17-10-2020', 3, 2),
(16, 'Revision de planes', NULL, '26-10-2020', 4, 2),
(17, 'Documentacion', NULL, '28-10-2020', 3, 2),
(18, 'Planificacion de auditoria interna', NULL, '26-10-2020', 3, 3),
(19, 'Planificacion de auditoria externa', NULL, '17-06-2020', 3, 3),
(20, 'Informe de auditoria interna', NULL, '06-04-2020', 3, 3),
(21, 'Informe de auditoria externa', NULL, '15-06-2020', 3, 3),
(22, 'Revision por la direccion', NULL, '13-07-2020', 3, 3),
(23, 'Monitoreos', NULL, '17-10-2020', 3, 3),
(24, 'Informe de accidentes', NULL, '15-10-2020', 3, 3),
(25, 'Planilla de no conformidades auditoria interna', NULL, '24-10-2020', 3, 4),
(26, 'Planilla de no conformidades auditoria externa', NULL, '15-10-2020', 3, 4),
(27, 'Acciones de mejora', NULL, '29-10-2020', 3, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_documentos`
--

DROP TABLE IF EXISTS `estado_documentos`;
CREATE TABLE IF NOT EXISTS `estado_documentos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `estado` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `estado_documentos`
--

INSERT INTO `estado_documentos` (`id`, `estado`) VALUES
(1, 'no programado'),
(2, 'espera'),
(3, 'programado'),
(4, 'entregado'),
(5, 'reprogramado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_documentacion`
--

DROP TABLE IF EXISTS `tipo_documentacion`;
CREATE TABLE IF NOT EXISTS `tipo_documentacion` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `tipo_documentacion`
--

INSERT INTO `tipo_documentacion` (`id`, `nombre`) VALUES
(1, 'Planear'),
(2, 'Hacer'),
(3, 'Verificar'),
(4, 'Actuar');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `correo` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `nombre` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `apellido_materno` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `apellido_paterno` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `pwd` varchar(40) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `tipo_usuario` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  PRIMARY KEY (`correo`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`correo`, `nombre`, `apellido_materno`, `apellido_paterno`, `pwd`, `tipo_usuario`) VALUES
('correo_administrador@ejemplo.com', 'administrador', 'administrador', 'administrador', '21232f297a57a5a743894a0e4a801fc3', 'administrador'),
('correo_encargado@ejemplo.com', 'encargado documentacion', 'encargado documentacion', 'encargado documentacion', '21232f297a57a5a743894a0e4a801fc3', 'encargado'),
('correo_encargadocalidad@ejemplo.com', 'encargado calidad', 'encargado calidad', 'encargado calidad', '21232f297a57a5a743894a0e4a801fc3', 'encargado_calidad');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

--
-- Base de datos: `db_academico`
--
USE `db_academico`;

-- -- ------------------------ ------------------------------
--
-- Volcado de datos para la tabla `tipo_evaluacion`
-- 
INSERT INTO `tipo_evaluacion` (`teva_id`, `teva_nombre`,  `teva_estado`, `teva_estado_logico`) VALUES 
(1, 'Docencia', '1', '1'),
(2, 'Investigación', '1', '1'),
(3, 'Dirección y Gestión Académica', '1', '1');

-- -- ------------------------ ------------------------------
--
-- Volcado de datos para la tabla `tipo_distributivo`
-- 
INSERT INTO `tipo_distributivo` (`tdis_id`, `tdis_nombre`, `tdis_estado`, `tdis_estado_logico`) VALUES
(1, 'Docencia', '1', '1'),
(2, 'Tutorías', '1', '1'),
(3, 'Investigación', '1', '1'),
(4, 'Vinculación', '1', '1'),
(5, 'Administrativas', '1', '1'),
(6, 'Otras Actividades', '1', '1');

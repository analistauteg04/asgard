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

-- -- ------------------------ ------------------------------
--
-- Volcado de datos para la tabla `actividad_evaluacion`
-- -- ------------------------ ------------------------------
INSERT INTO `actividad_evaluacion` (`aeva_id`, `aeva_descripcion`, `aeva_nombre`, `aeva_estado`, `aeva_estado_logico`) VALUES
(1, 'Asistido por el docente', 'Asistido por el docente', '1', '1'),
(2, 'ABP', 'ABP', '1', '1'),
(3, 'ABI', 'ABI', '1', '1'),
(4, 'Trabajo colaborativo', 'Trabajo colaborativo', '1', '1'),
(5, 'Debates/Foros', 'Debates/Foros', '1', '1'),
(6, 'Análisis de casos', 'Análisis de casos', '1', '1'),
(7, 'Exposición de temas', 'Exposición de temas', '1', '1'),
(8, 'Talleres prácticos', 'Talleres prácticos', '1', '1'),
(9, 'Otros', 'Otros', '1', '1');

-- -- ------------------------ ------------------------------
--
-- Volcado de datos para la tabla `valor_desarrollo`
-- -- ------------------------ ------------------------------
INSERT INTO `valor_desarrollo` (`vdes_id`, `vdes_descripcion`, `vdes_nombre`, `vdes_estado`, `vdes_estado_logico`) VALUES
(1, 'Lealtad', 'Lealtad', '1', '1'),
(2, 'Compromiso', 'Compromiso', '1', '1'),
(3, 'Disciplina', 'Disciplina', '1', '1'),
(4, 'Solidaridad', 'Solidaridad', '1', '1'),
(5, 'Integridad', 'Integridad', '1', '1'),
(6, 'Puntualidad', 'Puntualidad', '1', '1'),
(7, 'Responsabilidad Social', 'Resp. Social', '1', '1'),
(8, 'Responsabilidad Ambiental', 'Resp. Ambiental', '1', '1'),
(9, 'Otros, 'Otros', '1', '1');
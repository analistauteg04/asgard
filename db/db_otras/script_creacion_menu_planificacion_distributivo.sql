--
-- Base de datos: `db_asgard`
-- OJO DEBE VERIFICARSE LOS CÓDIGOS DE LAS TABLAS AL PASAR A PRODUCCIÓN
USE `db_asgard`;

-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `modulo`
--

INSERT INTO `modulo` (`mod_id`, `apl_id`, `mod_nombre`, `mod_tipo`, `mod_dir_imagen`, `mod_url`, `mod_orden`, `mod_lang_file`, `mod_estado`, `mod_estado_logico`) VALUES
(16, 1, 'Planificación / Distributivo', 'Planificación / Distributivo', 'glyphicon glyphicon-book', 'planificacion/cronograma', 1, NULL,'1', '1');

-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `objeto_modulo`
--
INSERT INTO `objeto_modulo` (`omod_id`, `mod_id`, `omod_padre_id`, `omod_nombre`, `omod_tipo`, `omod_tipo_boton`, `omod_accion`, `omod_function`, `omod_dir_imagen`, `omod_entidad`, `omod_orden`, `omod_estado_visible`, `omod_lang_file`, `omod_estado`,`omod_estado_logico`) VALUES
(33, 16, 33, 'Planificacion', 'S', '0', 'Carga Cronograma', '', '', 'planificacion/cronograma', 1, '1', NULL, '1', '1'),
(34, 16, 34, 'Horario', 'S', '0', 'Horario', '', '', 'planificacion/horario', 1, '1', NULL, '1', '1'),
(35, 16, 35, 'Bloque', 'S', '0', 'Bloque', '', '', 'planificacion/bloque', 1, '1', NULL, '1', '1'),
(36, 16, 36, 'Semestre', 'S', '0', 'Semestre', '', '', 'planificacion/semestre', 1, '1', NULL, '1', '1');

-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `grup_obmo`
--
INSERT INTO `grup_obmo` (`gmod_id`, `gru_id`, `omod_id`,`gmod_estado` , `gmod_estado_logico`) VALUES
(70, 1, 33, '1', '1'),
(71, 1, 34, '1', '1'),
(72, 1, 35, '1', '1'),
(73, 1, 36, '1', '1');

-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `grup_obmo_grup_rol`
--
INSERT INTO `grup_obmo_grup_rol` (`gogr_id`, `grol_id`, `gmod_id`, `gogr_estado`, `gogr_estado_logico`) VALUES
(104, 1, 70, '1', '1'),
(105, 1, 71, '1', '1'),
(106, 1, 72, '1', '1'),
(107, 1, 73, '1', '1');
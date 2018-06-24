--
-- Base de datos: `db_asgard` SIEMPRE VERIFICAR QUE LOS IDS COINCIDAN
--
USE `db_asgard`;

-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `modulo`
--

    INSERT INTO `modulo` (`mod_id`, `apl_id`, `mod_nombre`, `mod_tipo`, `mod_dir_imagen`, `mod_url`, `mod_orden`, `mod_lang_file`, `mod_estado`, `mod_estado_logico`) VALUES
(12, 1, 'Evaluación', 'Evaluación', 'glyphicon glyphicon-folder-open', 'evaluacion/evaluar', 10, NULL,'1', '1');

-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `objeto_modulo`
--
INSERT INTO `objeto_modulo` (`omod_id`, `mod_id`, `omod_padre_id`, `omod_nombre`, `omod_tipo`, `omod_tipo_boton`, `omod_accion`, `omod_function`, `omod_dir_imagen`, `omod_entidad`, `omod_orden`, `omod_estado_visible`, `omod_lang_file`, `omod_estado`,`omod_estado_logico`) VALUES
(23, 12, 23, 'Evaluación Profesor', 'S', '0', 'Evaluar Profesor', '', '', 'evaluacion/evaluar', 1, '1', NULL, '1', '1'),
(24, 12, 24, 'Asignación Materia', 'S', '0', 'Asignar Materia', '', '', 'evaluacion/asignamateria', 2, '1', NULL, '0', '1'),
(25, 12, 25, 'Evaluaciones', 'S', '0', 'Listar Profesor', '', '', 'evaluacion/listarevaluacion', 3, '1', NULL, '1', '1');

-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `grup_obmo`
--
INSERT INTO `grup_obmo` (`gmod_id`, `gru_id`, `omod_id`,`gmod_estado` , `gmod_estado_logico`) VALUES
(65, 1, 23, '1', '1'),
(66, 1, 24, '1', '1'),
(67, 1, 25, '1', '1');

-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `grup_obmo_grup_rol`
--
INSERT INTO `grup_obmo_grup_rol` (`gogr_id`, `grol_id`, `gmod_id`, `gogr_estado`, `gogr_estado_logico`) VALUES
(104, 1, 65, '1', '1'),
(105, 1, 66, '1', '1'),
(106, 1, 67, '1', '1');
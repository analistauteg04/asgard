--
-- Base de datos: `db_asgard`
--
USE `db_asgard`;

-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `modulo`
--

    INSERT INTO `modulo` (`mod_id`, `apl_id`, `mod_nombre`, `mod_tipo`, `mod_dir_imagen`, `mod_url`, `mod_orden`, `mod_lang_file`, `mod_estado`, `mod_estado_logico`) VALUES
(17, 1, 'Gestión', 'Gestión', 'glyphicon glyphicon-folder-open', 'gestion/create', 17, NULL,'1', '1');

-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `objeto_modulo`
--
INSERT INTO `objeto_modulo` (`omod_id`, `mod_id`, `omod_padre_id`, `omod_nombre`, `omod_tipo`, `omod_tipo_boton`, `omod_accion`, `omod_function`, `omod_dir_imagen`, `omod_entidad`, `omod_orden`, `omod_estado_visible`, `omod_lang_file`, `omod_estado`,`omod_estado_logico`) VALUES
(38, 17, 38, 'Gestión Admisión', 'S', '0', 'Gestión Admisión', '', '', 'gestion/create', 1, '1', NULL, '1', '1'),
(39, 17, 39, 'Gestiones', 'S', '0', 'Gestiones', '', '', 'gestion/listargestion', 2, '1', NULL, '1', '1');


-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `grup_obmo`
--
INSERT INTO `grup_obmo` (`gmod_id`, `gru_id`, `omod_id`,`gmod_estado` , `gmod_estado_logico`) VALUES
(75, 1, 38, '1', '1'),
(76, 1, 39, '1', '1');

-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `grup_obmo_grup_rol`
--
INSERT INTO `grup_obmo_grup_rol` (`gogr_id`, `grol_id`, `gmod_id`, `gogr_estado`, `gogr_estado_logico`) VALUES
(109, 1, 75, '1', '1'),
(110, 1, 76, '1', '1');
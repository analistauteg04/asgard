INSERT INTO `modulo` (`mod_id`, `apl_id`, `mod_nombre`, `mod_tipo`, `mod_dir_imagen`, `mod_url`, `mod_orden`, `mod_lang_file`, `mod_estado`, `mod_estado_logico`) VALUES
(7, 1, 'Administración', 'Administración', 'glyphicon glyphicon-user', 'adminmetodoingreso/creaperiodo', 1, NULL,'1', '1');

INSERT INTO `objeto_modulo` (`omod_id`, `mod_id`, `omod_padre_id`, `omod_nombre`, `omod_tipo`, `omod_tipo_boton`, `omod_accion`, `omod_function`, `omod_dir_imagen`, `omod_entidad`, `omod_orden`, `omod_estado_visible`, `omod_lang_file`, `omod_estado`,`omod_estado_logico`) VALUES
(17, 7, 17, 'Período/Curso', 'S', '0', 'Período/Curso', '', 'nuevo.png', 'adminmetodoingreso/creaperiodo', 1, '1', NULL, '1', '1');

INSERT INTO `grup_obmo` (`gmod_id`, `gru_id`, `omod_id`,`gmod_estado` , `gmod_estado_logico`) VALUES
(40, 1, 17, '1', '1'),
(41, 10, 17, '1', '1');


INSERT INTO `grup_obmo_grup_rol` (`gogr_id`, `grol_id`, `gmod_id`, `gogr_estado`, `gogr_estado_logico`) VALUES
(58, 1, 40, '1', '1'),
(59, 15, 41, '1', '1');


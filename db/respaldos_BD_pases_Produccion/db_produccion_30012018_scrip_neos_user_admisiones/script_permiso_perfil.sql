INSERT INTO `modulo` (`mod_id`, `apl_id`, `mod_nombre`, `mod_tipo`, `mod_dir_imagen`, `mod_url`, `mod_orden`, `mod_lang_file`, `mod_estado`, `mod_estado_logico`) VALUES
(8, 1, 'Perfil', 'Perfil', 'glyphicon glyphicon-user', 'perfil/update', 1, NULL,'1', '1');

INSERT INTO `objeto_modulo` (`omod_id`, `mod_id`, `omod_padre_id`, `omod_nombre`, `omod_tipo`, `omod_tipo_boton`, `omod_accion`, `omod_function`, `omod_dir_imagen`, `omod_entidad`, `omod_orden`, `omod_estado_visible`, `omod_lang_file`, `omod_estado`,`omod_estado_logico`) VALUES
(18, 8, 18, 'Actualizar Perfil', 'S', '0', 'Actualizar Perfil', '', '', 'perfil/update', 1, '1', NULL, '1', '1');

INSERT INTO `grup_obmo` (`gmod_id`, `gru_id`, `omod_id`,`gmod_estado` , `gmod_estado_logico`) VALUES
(43, 1, 18, '1', '1'),
(44, 8, 18, '1', '1'),
(45, 9, 18, '1', '1'),
(46, 10, 18, '1', '1');

INSERT INTO `grup_obmo_grup_rol` (`gogr_id`, `grol_id`, `gmod_id`, `gogr_estado`, `gogr_estado_logico`) VALUES
(64, 1, 43, '1', '1'),
(65, 5, 44, '1', '1'),
(66, 6, 44, '1', '1'),
(67, 7, 44, '1', '1'),
(68, 8, 44, '1', '1'),
(69, 9, 45, '1', '1'),
(70, 16, 45, '1', '1'),
(71, 14, 46, '1', '1'),
(72, 15, 46, '1', '1');

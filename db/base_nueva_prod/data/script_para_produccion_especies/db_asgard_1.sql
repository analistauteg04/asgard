use 'db_asgard';

INSERT INTO `modulo` (`mod_id`, `apl_id`, `mod_nombre`, `mod_tipo`, `mod_dir_imagen`, `mod_url`, `mod_orden`, `mod_lang_file`, `mod_estado_visible`, `mod_estado`, `mod_fecha_creacion`, `mod_fecha_actualizacion`, `mod_estado_logico`) VALUES
(12, 1, 'Especies Valoradas', 'Especies Valoradas', 'glyphicon glyphicon-certificate', 'academico/especies/solicitudalumno', 12, 'academico', '1', '1', '2020-04-04 15:53:21', NULL, '1');

INSERT INTO `objeto_modulo` (`omod_id`, `mod_id`, `omod_padre_id`, `omod_nombre`, `omod_tipo`, `omod_tipo_boton`, `omod_accion`, `omod_function`, `omod_dir_imagen`, `omod_entidad`, `omod_orden`, `omod_estado_visible`, `omod_lang_file`, `omod_estado`, `omod_fecha_creacion`, `omod_fecha_actualizacion`, `omod_estado_logico`) VALUES
(197, 12, 197, 'Solicitud', 'P', '0', '', '', '', 'academico/especies/solicitudalumno', 1, '1', 'academico', '1', '2020-04-04 16:02:16', NULL, '1'),
(198, 12, 197, 'Crear Solicitud Especie', 'S', '0', '', '', '', 'academico/especies/new', 1, '0', 'academico', '1', '2020-04-04 17:12:47', NULL, '1'),
(199, 12, 197, 'Crear Solicitud Especie', 'A', '0', '', '', '', 'academico/especies/new', 1, '1', 'academico', '1', '2020-04-04 17:45:43', NULL, '1'),
(200, 12, 198, 'Grabar Solicitud Especie', 'A', '0', '', '', '', 'academico/especies/save', 1, '1', 'academico', '1', '2020-04-04 17:51:29', NULL, '1'),
(201, 12, 197, 'Subir Pago Especie', 'S', '0', '', '', '', 'academico/especies/cargarpago', 2, '0', 'academico', '1', '2020-04-04 20:43:52', NULL, '1'),
(202, 12, 201, 'Guardar Subir Pago', 'A', '0', '', '', '', 'academico/especies/cargarpago', 1, '1', 'academico', '1', '2020-04-04 20:50:26', NULL, '1');

INSERT INTO `obmo_acci` (`oacc_id`, `omod_id`, `acc_id`, `oacc_tipo_boton`, `oacc_cont_accion`, `oacc_function`, `oacc_estado`, `oacc_fecha_creacion`, `oacc_fecha_modificacion`, `oacc_estado_logico`) VALUES
(90, 199, 1, '0', 'academico/especies/new', '', '1', '2020-04-04 17:45:44', NULL, '1'),
(91, 200, 4, '1', '', 'guardarSolicitud', '1', '2020-04-04 17:51:29', NULL, '1'),
(92, 202, 4, '1', '', 'actualizarPago', '1', '2020-04-04 20:50:26', NULL, '1');

INSERT INTO `grup_obmo` (`gmod_id`, `gru_id`, `omod_id`, `gmod_estado`, `gmod_fecha_creacion`, `gmod_fecha_modificacion`, `gmod_estado_logico`) VALUES
(11014, 1, 197, '1', '2020-04-04 16:07:30', NULL, '1'),
(11015, 2, 197, '1', '2020-04-04 16:07:57', NULL, '1'),
(11016, 12, 197, '1', '2020-04-04 16:08:32', NULL, '1'),
(11017, 1, 198, '1', '2020-04-04 17:52:10', NULL, '1'),
(11018, 1, 199, '1', '2020-04-04 17:52:10', NULL, '1'),
(11019, 1, 200, '1', '2020-04-04 17:52:10', NULL, '1'),
(11020, 2, 198, '1', '2020-04-04 17:52:46', NULL, '1'),
(11021, 2, 199, '1', '2020-04-04 17:52:46', NULL, '1'),
(11022, 2, 200, '1', '2020-04-04 17:52:46', NULL, '1'),
(11023, 12, 198, '1', '2020-04-04 17:53:19', NULL, '1'),
(11024, 12, 199, '1', '2020-04-04 17:53:19', NULL, '1'),
(11025, 12, 200, '1', '2020-04-04 17:53:19', NULL, '1'),
(11026, 1, 201, '1', '2020-04-04 20:51:05', NULL, '1'),
(11027, 1, 202, '1', '2020-04-04 20:51:05', NULL, '1'),
(11028, 2, 201, '1', '2020-04-04 20:51:42', NULL, '1'),
(11029, 2, 202, '1', '2020-04-04 20:51:42', NULL, '1'),
(11030, 12, 201, '1', '2020-04-04 20:52:16', NULL, '1'),
(11031, 12, 202, '1', '2020-04-04 20:52:16', NULL, '1');

INSERT INTO `grup_obmo_grup_rol` (`gogr_id`, `grol_id`, `gmod_id`, `gogr_estado`, `gogr_fecha_creacion`, `gogr_fecha_modificacion`, `gogr_estado_logico`) VALUES
(12611, 1, 11014, '1', '2020-04-04 16:07:30', NULL, '1'),
(12612, 2, 11015, '1', '2020-04-04 16:07:57', NULL, '1'),
(12613, 37, 11016, '1', '2020-04-04 16:08:32', NULL, '1'),
(12614, 1, 11017, '1', '2020-04-04 17:52:10', NULL, '1'),
(12615, 1, 11018, '1', '2020-04-04 17:52:10', NULL, '1'),
(12616, 1, 11019, '1', '2020-04-04 17:52:10', NULL, '1'),
(12617, 2, 11020, '1', '2020-04-04 17:52:46', NULL, '1'),
(12618, 2, 11021, '1', '2020-04-04 17:52:46', NULL, '1'),
(12619, 2, 11022, '1', '2020-04-04 17:52:46', NULL, '1'),
(12620, 37, 11023, '1', '2020-04-04 17:53:19', NULL, '1'),
(12621, 37, 11024, '1', '2020-04-04 17:53:19', NULL, '1'),
(12622, 37, 11025, '1', '2020-04-04 17:53:19', NULL, '1'),
(12623, 1, 11026, '1', '2020-04-04 20:51:05', NULL, '1'),
(12624, 1, 11027, '1', '2020-04-04 20:51:05', NULL, '1'),
(12625, 2, 11028, '1', '2020-04-04 20:51:42', NULL, '1'),
(12626, 2, 11029, '1', '2020-04-04 20:51:42', NULL, '1'),
(12627, 37, 11030, '1', '2020-04-04 20:52:16', NULL, '1'),
(12628, 37, 11031, '1', '2020-04-04 20:52:16', NULL, '1');


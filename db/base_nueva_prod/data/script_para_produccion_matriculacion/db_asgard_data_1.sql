INSERT INTO `modulo` (`mod_id`, `apl_id`, `mod_nombre`, `mod_tipo`, `mod_dir_imagen`, `mod_url`, `mod_orden`, `mod_lang_file`, `mod_estado_visible`, `mod_estado`, `mod_fecha_creacion`, `mod_fecha_actualizacion`, `mod_estado_logico`) VALUES
(10, 1, 'Matriculación', 'Matriculación', 'glyphicon glyphicon-education', 'academico/matriculacion/index', 9, 'matriculacion', '1', '1', '2020-03-30 23:48:36', NULL, '1'),
(11, 1, 'Perfil', 'Perfil', 'glyphicon glyphicon-user', 'academico/perfil/index', 11, 'perfil', '1', '1', '2020-03-30 23:49:18', NULL, '1');

INSERT INTO `objeto_modulo` (`omod_id`, `mod_id`, `omod_padre_id`, `omod_nombre`, `omod_tipo`, `omod_tipo_boton`, `omod_accion`, `omod_function`, `omod_dir_imagen`, `omod_entidad`, `omod_orden`, `omod_estado_visible`, `omod_lang_file`, `omod_estado`, `omod_fecha_creacion`, `omod_fecha_actualizacion`, `omod_estado_logico`) VALUES
(184, 10, 184, 'Subir Pago', 'P', '0', '', '', '', 'academico/matriculacion/registropago', 1, '1', 'matriculacion', '1', '2020-03-31 00:47:51', NULL, '1'),
(185, 10, 185, 'Registro Matrícula', 'P', '0', '', '', '', 'academico/matriculacion/index', 2, '1', 'matriculacion', '1', '2020-03-31 00:50:09', NULL, '1'),
(186, 11, 186, 'Perfil', 'P', '0', '', '', '', 'academico/perfil/index', 1, '1', 'perfil', '1', '2020-03-31 00:51:39', NULL, '1'),
(187, 4, 187, 'Listar Matriculados', 'P', '0', '', '', '', 'academico/matriculacion/list', 11, '1', 'matriculacion', '1', '2020-03-31 00:53:29', NULL, '1'),
(188, 4, 188, 'Cargar Planificación', 'P', '0', '', '', '', 'academico/planificacion/index', 12, '1', 'matriculacion', '1', '2020-03-31 00:59:26', NULL, '1'),
(189, 3, 189, 'Pagos Matrícula', 'P', '0', '', '', '', 'academico/matriculacion/aprobacionpago', 12, '1', 'matriculacion', '1', '2020-03-31 01:04:38', NULL, '1'),
(190, 4, 187, 'Revisar Matriculación', 'S', '0', '', '', '', 'academico/matriculacion/registry', 1, '0', 'matriculacion', '1', '2020-03-31 01:09:25', NULL, '1'),
(191, 4, 188, 'Cargar Planificación', 'A', '0', '', '', '', 'academico/planificacion/upload', 1, '1', 'matriculacion', '1', '2020-03-31 01:11:40', NULL, '1'),
(192, 11, 186, 'Actualizar Perfil', 'A', '0', '', '', '', 'academico/perfil/update', 1, '1', 'matriculacion', '1', '2020-03-31 01:15:13', NULL, '1'),
(193, 10, 184, 'Cargar Pago', 'A', '0', '', '', '', 'academico/matriculacion/registropago', 1, '1', 'matriculacion', '1', '2020-03-31 01:19:07', NULL, '1'),
(194, 10, 185, 'Registro Online', 'A', '0', '', '', '', 'academico/matriculacion/registro', 1, '1', 'matriculacion', '1', '2020-03-31 01:22:07', NULL, '1'),
(195, 4, 190, 'Revisar Matriculación', 'A', '0', '', '', '', 'academico/matriculacion/updatepagoregistro', 1, '1', 'matriculacion', '1', '2020-03-31 01:23:42', NULL, '1'),
(196, 4, 187, 'Ver Registro Matrícula', 'S', '0', '', '', '', 'academico/matriculacion/view', 2, '0', 'matriculacion', '1', '2020-03-31 17:43:28', NULL, '1');

INSERT INTO `obmo_acci` (`oacc_id`, `omod_id`, `acc_id`, `oacc_tipo_boton`, `oacc_cont_accion`, `oacc_function`, `oacc_estado`, `oacc_fecha_creacion`, `oacc_fecha_modificacion`, `oacc_estado_logico`) VALUES
(85, 191, 14, '1', '', 'cargarDocumento', '1', '2020-03-31 01:11:40', NULL, '1'),
(86, 192, 4, '1', '', 'update', '1', '2020-03-31 01:15:13', NULL, '1'),
(87, 193, 14, '1', '', 'cargarDocumento', '1', '2020-03-31 01:19:07', NULL, '1'),
(88, 194, 4, '1', '', 'registro', '1', '2020-03-31 01:22:07', NULL, '1'),
(89, 195, 4, '1', '', 'generar', '1', '2020-03-31 01:23:42', NULL, '1');

INSERT INTO `grup_obmo` (`gmod_id`, `gru_id`, `omod_id`, `gmod_estado`, `gmod_fecha_creacion`, `gmod_fecha_modificacion`, `gmod_estado_logico`) VALUES
(10955, 12, 184, '1', '2020-03-31 01:31:05', NULL, '1'),
(10956, 12, 185, '1', '2020-03-31 01:31:05', NULL, '1'),
(10957, 12, 186, '1', '2020-03-31 01:31:05', NULL, '1'),
(10958, 12, 192, '1', '2020-03-31 01:31:05', NULL, '1'),
(10959, 12, 193, '1', '2020-03-31 01:31:05', NULL, '1'),
(10960, 12, 194, '1', '2020-03-31 01:31:05', NULL, '1'),
(10961, 1, 184, '1', '2020-03-31 01:31:49', NULL, '1'),
(10962, 1, 185, '1', '2020-03-31 01:31:49', NULL, '1'),
(10963, 1, 186, '1', '2020-03-31 01:31:49', NULL, '1'),
(10964, 1, 187, '1', '2020-03-31 01:31:50', NULL, '1'),
(10965, 1, 188, '1', '2020-03-31 01:31:50', NULL, '1'),
(10966, 1, 189, '1', '2020-03-31 01:31:50', NULL, '1'),
(10967, 1, 190, '1', '2020-03-31 01:31:50', NULL, '1'),
(10968, 1, 191, '1', '2020-03-31 01:31:50', NULL, '1'),
(10969, 1, 192, '1', '2020-03-31 01:31:50', NULL, '1'),
(10970, 1, 193, '1', '2020-03-31 01:31:50', NULL, '1'),
(10971, 1, 194, '1', '2020-03-31 01:31:50', NULL, '1'),
(10972, 1, 195, '1', '2020-03-31 01:31:50', NULL, '1'),
(10973, 2, 184, '1', '2020-03-31 01:33:03', NULL, '1'),
(10974, 2, 185, '1', '2020-03-31 01:33:03', NULL, '1'),
(10975, 2, 186, '1', '2020-03-31 01:33:03', NULL, '1'),
(10976, 2, 187, '1', '2020-03-31 01:33:03', NULL, '1'),
(10977, 2, 188, '1', '2020-03-31 01:33:03', NULL, '1'),
(10978, 2, 189, '1', '2020-03-31 01:33:03', NULL, '1'),
(10979, 2, 190, '1', '2020-03-31 01:33:03', NULL, '1'),
(10980, 2, 191, '1', '2020-03-31 01:33:03', NULL, '1'),
(10981, 2, 192, '1', '2020-03-31 01:33:03', NULL, '1'),
(10982, 2, 193, '1', '2020-03-31 01:33:03', NULL, '1'),
(10983, 2, 194, '1', '2020-03-31 01:33:03', NULL, '1'),
(10984, 2, 195, '1', '2020-03-31 01:33:03', NULL, '1'),
(10985, 5, 189, '1', '2020-03-31 01:34:27', NULL, '1'),
(10986, 6, 187, '1', '2020-03-31 01:36:09', NULL, '1'),
(10987, 6, 190, '1', '2020-03-31 01:36:09', NULL, '1'),
(10988, 6, 195, '1', '2020-03-31 01:36:10', NULL, '1'),
(10989, 7, 187, '1', '2020-03-31 01:37:33', NULL, '1'),
(10990, 7, 190, '1', '2020-03-31 01:37:33', NULL, '1'),
(10991, 7, 195, '1', '2020-03-31 01:37:33', NULL, '1'),
(10992, 1, 196, '1', '2020-03-31 17:44:01', NULL, '1'),
(10993, 2, 196, '1', '2020-03-31 17:44:25', NULL, '1'),
(10994, 6, 196, '1', '2020-03-31 17:45:06', NULL, '1'),
(10995, 7, 196, '1', '2020-03-31 17:46:17', NULL, '1');

INSERT INTO `grup_obmo_grup_rol` (`gogr_id`, `grol_id`, `gmod_id`, `gogr_estado`, `gogr_fecha_creacion`, `gogr_fecha_modificacion`, `gogr_estado_logico`) VALUES
(12369, 37, 10598, '1', '2020-03-31 01:31:04', NULL, '1'),
(12370, 37, 10599, '1', '2020-03-31 01:31:05', NULL, '1'),
(12371, 37, 10240, '1', '2020-03-31 01:31:05', NULL, '1'),
(12372, 37, 10241, '1', '2020-03-31 01:31:05', NULL, '1'),
(12373, 37, 10955, '1', '2020-03-31 01:31:05', NULL, '1'),
(12374, 37, 10956, '1', '2020-03-31 01:31:05', NULL, '1'),
(12375, 37, 10957, '1', '2020-03-31 01:31:05', NULL, '1'),
(12376, 37, 10958, '1', '2020-03-31 01:31:05', NULL, '1'),
(12377, 37, 10959, '1', '2020-03-31 01:31:05', NULL, '1'),
(12378, 37, 10960, '1', '2020-03-31 01:31:05', NULL, '1'),
(12379, 1, 10961, '1', '2020-03-31 01:31:49', NULL, '1'),
(12380, 1, 10962, '1', '2020-03-31 01:31:49', NULL, '1'),
(12381, 1, 10963, '1', '2020-03-31 01:31:50', NULL, '1'),
(12382, 1, 10964, '1', '2020-03-31 01:31:50', NULL, '1'),
(12383, 1, 10965, '1', '2020-03-31 01:31:50', NULL, '1'),
(12384, 1, 10966, '1', '2020-03-31 01:31:50', NULL, '1'),
(12385, 1, 10967, '1', '2020-03-31 01:31:50', NULL, '1'),
(12386, 1, 10968, '1', '2020-03-31 01:31:50', NULL, '1'),
(12387, 1, 10969, '1', '2020-03-31 01:31:50', NULL, '1'),
(12388, 1, 10970, '1', '2020-03-31 01:31:50', NULL, '1'),
(12389, 1, 10971, '1', '2020-03-31 01:31:50', NULL, '1'),
(12390, 1, 10972, '1', '2020-03-31 01:31:50', NULL, '1'),
(12391, 2, 10973, '1', '2020-03-31 01:33:03', NULL, '1'),
(12392, 2, 10974, '1', '2020-03-31 01:33:03', NULL, '1'),
(12393, 2, 10975, '1', '2020-03-31 01:33:03', NULL, '1'),
(12394, 2, 10976, '1', '2020-03-31 01:33:03', NULL, '1'),
(12395, 2, 10977, '1', '2020-03-31 01:33:03', NULL, '1'),
(12396, 2, 10978, '1', '2020-03-31 01:33:03', NULL, '1'),
(12397, 2, 10979, '1', '2020-03-31 01:33:03', NULL, '1'),
(12398, 2, 10980, '1', '2020-03-31 01:33:03', NULL, '1'),
(12399, 2, 10981, '1', '2020-03-31 01:33:03', NULL, '1'),
(12400, 2, 10982, '1', '2020-03-31 01:33:03', NULL, '1'),
(12401, 2, 10983, '1', '2020-03-31 01:33:03', NULL, '1'),
(12402, 2, 10984, '1', '2020-03-31 01:33:03', NULL, '1'),
(12403, 10, 10985, '1', '2020-03-31 01:34:27', NULL, '1'),
(12404, 11, 10985, '1', '2020-03-31 01:34:56', NULL, '1'),
(12405, 12, 10985, '1', '2020-03-31 01:35:12', NULL, '1'),
(12406, 15, 10986, '1', '2020-03-31 01:36:09', NULL, '1'),
(12407, 15, 10987, '1', '2020-03-31 01:36:10', NULL, '1'),
(12408, 15, 10988, '1', '2020-03-31 01:36:10', NULL, '1'),
(12409, 16, 10897, '1', '2020-03-31 01:36:33', NULL, '1'),
(12410, 16, 10898, '1', '2020-03-31 01:36:33', NULL, '1'),
(12411, 16, 10899, '1', '2020-03-31 01:36:33', NULL, '1'),
(12412, 16, 10900, '1', '2020-03-31 01:36:33', NULL, '1'),
(12413, 16, 10901, '1', '2020-03-31 01:36:33', NULL, '1'),
(12414, 16, 10902, '1', '2020-03-31 01:36:33', NULL, '1'),
(12415, 16, 10903, '1', '2020-03-31 01:36:33', NULL, '1'),
(12416, 16, 10904, '1', '2020-03-31 01:36:33', NULL, '1'),
(12417, 16, 10905, '1', '2020-03-31 01:36:33', NULL, '1'),
(12418, 16, 10906, '1', '2020-03-31 01:36:33', NULL, '1'),
(12419, 16, 10907, '1', '2020-03-31 01:36:33', NULL, '1'),
(12420, 16, 10908, '1', '2020-03-31 01:36:33', NULL, '1'),
(12421, 16, 10909, '1', '2020-03-31 01:36:34', NULL, '1'),
(12422, 16, 10910, '1', '2020-03-31 01:36:34', NULL, '1'),
(12423, 16, 10911, '1', '2020-03-31 01:36:34', NULL, '1'),
(12424, 16, 10912, '1', '2020-03-31 01:36:34', NULL, '1'),
(12425, 16, 10913, '1', '2020-03-31 01:36:34', NULL, '1'),
(12426, 16, 10914, '1', '2020-03-31 01:36:34', NULL, '1'),
(12427, 16, 10915, '1', '2020-03-31 01:36:34', NULL, '1'),
(12428, 16, 10916, '1', '2020-03-31 01:36:34', NULL, '1'),
(12429, 16, 10917, '1', '2020-03-31 01:36:34', NULL, '1'),
(12430, 16, 10918, '1', '2020-03-31 01:36:34', NULL, '1'),
(12431, 16, 10919, '1', '2020-03-31 01:36:34', NULL, '1'),
(12432, 16, 10920, '1', '2020-03-31 01:36:34', NULL, '1'),
(12433, 16, 10921, '1', '2020-03-31 01:36:34', NULL, '1'),
(12434, 16, 10986, '1', '2020-03-31 01:36:35', NULL, '1'),
(12435, 16, 10987, '1', '2020-03-31 01:36:35', NULL, '1'),
(12436, 16, 10988, '1', '2020-03-31 01:36:35', NULL, '1'),
(12437, 18, 10897, '1', '2020-03-31 01:36:57', NULL, '1'),
(12438, 18, 10898, '1', '2020-03-31 01:36:57', NULL, '1'),
(12439, 18, 10899, '1', '2020-03-31 01:36:57', NULL, '1'),
(12440, 18, 10900, '1', '2020-03-31 01:36:57', NULL, '1'),
(12441, 18, 10901, '1', '2020-03-31 01:36:57', NULL, '1'),
(12442, 18, 10902, '1', '2020-03-31 01:36:57', NULL, '1'),
(12443, 18, 10903, '1', '2020-03-31 01:36:57', NULL, '1'),
(12444, 18, 10904, '1', '2020-03-31 01:36:57', NULL, '1'),
(12445, 18, 10905, '1', '2020-03-31 01:36:57', NULL, '1'),
(12446, 18, 10906, '1', '2020-03-31 01:36:57', NULL, '1'),
(12447, 18, 10907, '1', '2020-03-31 01:36:57', NULL, '1'),
(12448, 18, 10908, '1', '2020-03-31 01:36:57', NULL, '1'),
(12449, 18, 10909, '1', '2020-03-31 01:36:57', NULL, '1'),
(12450, 18, 10910, '1', '2020-03-31 01:36:57', NULL, '1'),
(12451, 18, 10911, '1', '2020-03-31 01:36:57', NULL, '1'),
(12452, 18, 10912, '1', '2020-03-31 01:36:57', NULL, '1'),
(12453, 18, 10913, '1', '2020-03-31 01:36:57', NULL, '1'),
(12454, 18, 10914, '1', '2020-03-31 01:36:57', NULL, '1'),
(12455, 18, 10915, '1', '2020-03-31 01:36:57', NULL, '1'),
(12456, 18, 10916, '1', '2020-03-31 01:36:57', NULL, '1'),
(12457, 18, 10917, '1', '2020-03-31 01:36:57', NULL, '1'),
(12458, 18, 10918, '1', '2020-03-31 01:36:57', NULL, '1'),
(12459, 18, 10919, '1', '2020-03-31 01:36:57', NULL, '1'),
(12460, 18, 10920, '1', '2020-03-31 01:36:57', NULL, '1'),
(12461, 18, 10921, '1', '2020-03-31 01:36:57', NULL, '1'),
(12462, 18, 10171, '1', '2020-03-31 01:36:57', NULL, '1'),
(12463, 18, 10172, '1', '2020-03-31 01:36:57', NULL, '1'),
(12464, 18, 10173, '1', '2020-03-31 01:36:57', NULL, '1'),
(12465, 18, 10174, '1', '2020-03-31 01:36:57', NULL, '1'),
(12466, 18, 10175, '1', '2020-03-31 01:36:57', NULL, '1'),
(12467, 18, 10176, '1', '2020-03-31 01:36:57', NULL, '1'),
(12468, 18, 10177, '1', '2020-03-31 01:36:57', NULL, '1'),
(12469, 18, 10178, '1', '2020-03-31 01:36:57', NULL, '1'),
(12470, 18, 10179, '1', '2020-03-31 01:36:57', NULL, '1'),
(12471, 18, 10180, '1', '2020-03-31 01:36:57', NULL, '1'),
(12472, 18, 10181, '1', '2020-03-31 01:36:57', NULL, '1'),
(12473, 18, 10182, '1', '2020-03-31 01:36:58', NULL, '1'),
(12474, 18, 10702, '1', '2020-03-31 01:36:58', NULL, '1'),
(12475, 18, 10703, '1', '2020-03-31 01:36:58', NULL, '1'),
(12476, 18, 10183, '1', '2020-03-31 01:36:58', NULL, '1'),
(12477, 18, 10184, '1', '2020-03-31 01:36:58', NULL, '1'),
(12478, 18, 10185, '1', '2020-03-31 01:36:58', NULL, '1'),
(12479, 18, 10186, '1', '2020-03-31 01:36:58', NULL, '1'),
(12480, 18, 10187, '1', '2020-03-31 01:36:58', NULL, '1'),
(12481, 18, 10189, '1', '2020-03-31 01:36:58', NULL, '1'),
(12482, 18, 10190, '1', '2020-03-31 01:36:58', NULL, '1'),
(12483, 18, 10635, '1', '2020-03-31 01:36:58', NULL, '1'),
(12484, 18, 10636, '1', '2020-03-31 01:36:58', NULL, '1'),
(12485, 18, 10637, '1', '2020-03-31 01:36:58', NULL, '1'),
(12486, 18, 10638, '1', '2020-03-31 01:36:58', NULL, '1'),
(12487, 18, 10619, '1', '2020-03-31 01:36:58', NULL, '1'),
(12488, 18, 10620, '1', '2020-03-31 01:36:58', NULL, '1'),
(12489, 18, 10621, '1', '2020-03-31 01:36:58', NULL, '1'),
(12490, 18, 10622, '1', '2020-03-31 01:36:58', NULL, '1'),
(12491, 18, 10623, '1', '2020-03-31 01:36:58', NULL, '1'),
(12492, 18, 10624, '1', '2020-03-31 01:36:58', NULL, '1'),
(12493, 18, 10625, '1', '2020-03-31 01:36:58', NULL, '1'),
(12494, 18, 10639, '1', '2020-03-31 01:36:58', NULL, '1'),
(12495, 18, 10752, '1', '2020-03-31 01:36:58', NULL, '1'),
(12496, 18, 10761, '1', '2020-03-31 01:36:58', NULL, '1'),
(12497, 18, 10762, '1', '2020-03-31 01:36:58', NULL, '1'),
(12498, 18, 10986, '1', '2020-03-31 01:36:58', NULL, '1'),
(12499, 18, 10987, '1', '2020-03-31 01:36:58', NULL, '1'),
(12500, 18, 10988, '1', '2020-03-31 01:36:58', NULL, '1'),
(12501, 19, 10989, '1', '2020-03-31 01:37:33', NULL, '1'),
(12502, 19, 10990, '1', '2020-03-31 01:37:33', NULL, '1'),
(12503, 19, 10991, '1', '2020-03-31 01:37:33', NULL, '1'),
(12504, 20, 10872, '1', '2020-03-31 01:38:18', NULL, '1'),
(12505, 20, 10873, '1', '2020-03-31 01:38:18', NULL, '1'),
(12506, 20, 10874, '1', '2020-03-31 01:38:18', NULL, '1'),
(12507, 20, 10875, '1', '2020-03-31 01:38:18', NULL, '1'),
(12508, 20, 10876, '1', '2020-03-31 01:38:18', NULL, '1'),
(12509, 20, 10877, '1', '2020-03-31 01:38:18', NULL, '1'),
(12510, 20, 10878, '1', '2020-03-31 01:38:18', NULL, '1'),
(12511, 20, 10879, '1', '2020-03-31 01:38:19', NULL, '1'),
(12512, 20, 10880, '1', '2020-03-31 01:38:19', NULL, '1'),
(12513, 20, 10881, '1', '2020-03-31 01:38:19', NULL, '1'),
(12514, 20, 10882, '1', '2020-03-31 01:38:19', NULL, '1'),
(12515, 20, 10883, '1', '2020-03-31 01:38:19', NULL, '1'),
(12516, 20, 10884, '1', '2020-03-31 01:38:19', NULL, '1'),
(12517, 20, 10885, '1', '2020-03-31 01:38:19', NULL, '1'),
(12518, 20, 10886, '1', '2020-03-31 01:38:19', NULL, '1'),
(12519, 20, 10887, '1', '2020-03-31 01:38:19', NULL, '1'),
(12520, 20, 10888, '1', '2020-03-31 01:38:19', NULL, '1'),
(12521, 20, 10889, '1', '2020-03-31 01:38:19', NULL, '1'),
(12522, 20, 10890, '1', '2020-03-31 01:38:19', NULL, '1'),
(12523, 20, 10891, '1', '2020-03-31 01:38:19', NULL, '1'),
(12524, 20, 10892, '1', '2020-03-31 01:38:19', NULL, '1'),
(12525, 20, 10893, '1', '2020-03-31 01:38:19', NULL, '1'),
(12526, 20, 10894, '1', '2020-03-31 01:38:19', NULL, '1'),
(12527, 20, 10895, '1', '2020-03-31 01:38:19', NULL, '1'),
(12528, 20, 10896, '1', '2020-03-31 01:38:19', NULL, '1'),
(12529, 20, 10989, '1', '2020-03-31 01:38:20', NULL, '1'),
(12530, 20, 10990, '1', '2020-03-31 01:38:20', NULL, '1'),
(12531, 20, 10991, '1', '2020-03-31 01:38:20', NULL, '1'),
(12532, 22, 10872, '1', '2020-03-31 01:38:50', NULL, '1'),
(12533, 22, 10873, '1', '2020-03-31 01:38:50', NULL, '1'),
(12534, 22, 10874, '1', '2020-03-31 01:38:50', NULL, '1'),
(12535, 22, 10875, '1', '2020-03-31 01:38:50', NULL, '1'),
(12536, 22, 10876, '1', '2020-03-31 01:38:50', NULL, '1'),
(12537, 22, 10877, '1', '2020-03-31 01:38:50', NULL, '1'),
(12538, 22, 10878, '1', '2020-03-31 01:38:50', NULL, '1'),
(12539, 22, 10879, '1', '2020-03-31 01:38:50', NULL, '1'),
(12540, 22, 10880, '1', '2020-03-31 01:38:50', NULL, '1'),
(12541, 22, 10881, '1', '2020-03-31 01:38:50', NULL, '1'),
(12542, 22, 10882, '1', '2020-03-31 01:38:50', NULL, '1'),
(12543, 22, 10883, '1', '2020-03-31 01:38:50', NULL, '1'),
(12544, 22, 10884, '1', '2020-03-31 01:38:50', NULL, '1'),
(12545, 22, 10885, '1', '2020-03-31 01:38:50', NULL, '1'),
(12546, 22, 10886, '1', '2020-03-31 01:38:50', NULL, '1'),
(12547, 22, 10887, '1', '2020-03-31 01:38:50', NULL, '1'),
(12548, 22, 10888, '1', '2020-03-31 01:38:50', NULL, '1'),
(12549, 22, 10889, '1', '2020-03-31 01:38:50', NULL, '1'),
(12550, 22, 10890, '1', '2020-03-31 01:38:50', NULL, '1'),
(12551, 22, 10891, '1', '2020-03-31 01:38:50', NULL, '1'),
(12552, 22, 10892, '1', '2020-03-31 01:38:50', NULL, '1'),
(12553, 22, 10893, '1', '2020-03-31 01:38:50', NULL, '1'),
(12554, 22, 10894, '1', '2020-03-31 01:38:50', NULL, '1'),
(12555, 22, 10895, '1', '2020-03-31 01:38:50', NULL, '1'),
(12556, 22, 10896, '1', '2020-03-31 01:38:50', NULL, '1'),
(12557, 22, 10211, '1', '2020-03-31 01:38:50', NULL, '1'),
(12558, 22, 10212, '1', '2020-03-31 01:38:50', NULL, '1'),
(12559, 22, 10213, '1', '2020-03-31 01:38:50', NULL, '1'),
(12560, 22, 10214, '1', '2020-03-31 01:38:50', NULL, '1'),
(12561, 22, 10215, '1', '2020-03-31 01:38:50', NULL, '1'),
(12562, 22, 10216, '1', '2020-03-31 01:38:50', NULL, '1'),
(12563, 22, 10217, '1', '2020-03-31 01:38:50', NULL, '1'),
(12564, 22, 10218, '1', '2020-03-31 01:38:50', NULL, '1'),
(12565, 22, 10219, '1', '2020-03-31 01:38:51', NULL, '1'),
(12566, 22, 10220, '1', '2020-03-31 01:38:51', NULL, '1'),
(12567, 22, 10221, '1', '2020-03-31 01:38:51', NULL, '1'),
(12568, 22, 10222, '1', '2020-03-31 01:38:51', NULL, '1'),
(12569, 22, 10223, '1', '2020-03-31 01:38:51', NULL, '1'),
(12570, 22, 10224, '1', '2020-03-31 01:38:51', NULL, '1'),
(12571, 22, 10225, '1', '2020-03-31 01:38:51', NULL, '1'),
(12572, 22, 10226, '1', '2020-03-31 01:38:51', NULL, '1'),
(12573, 22, 10227, '1', '2020-03-31 01:38:51', NULL, '1'),
(12574, 22, 10229, '1', '2020-03-31 01:38:51', NULL, '1'),
(12575, 22, 10230, '1', '2020-03-31 01:38:51', NULL, '1'),
(12576, 22, 10751, '1', '2020-03-31 01:38:51', NULL, '1'),
(12577, 22, 10754, '1', '2020-03-31 01:38:51', NULL, '1'),
(12578, 22, 10756, '1', '2020-03-31 01:38:51', NULL, '1'),
(12579, 22, 10866, '1', '2020-03-31 01:38:51', NULL, '1'),
(12580, 22, 10812, '1', '2020-03-31 01:38:51', NULL, '1'),
(12581, 22, 10813, '1', '2020-03-31 01:38:51', NULL, '1'),
(12582, 22, 10818, '1', '2020-03-31 01:38:51', NULL, '1'),
(12583, 22, 10989, '1', '2020-03-31 01:38:51', NULL, '1'),
(12584, 22, 10990, '1', '2020-03-31 01:38:51', NULL, '1'),
(12585, 22, 10991, '1', '2020-03-31 01:38:51', NULL, '1'),
(12586, 1, 10992, '1', '2020-03-31 17:44:01', NULL, '1'),
(12587, 2, 10993, '1', '2020-03-31 17:44:25', NULL, '1'),
(12588, 15, 10994, '1', '2020-03-31 17:45:06', NULL, '1'),
(12589, 18, 10994, '1', '2020-03-31 17:45:57', NULL, '1'),
(12590, 19, 10995, '1', '2020-03-31 17:46:17', NULL, '1'),
(12591, 20, 10995, '1', '2020-03-31 17:46:42', NULL, '1'),
(12592, 22, 10995, '1', '2020-03-31 17:47:06', NULL, '1');
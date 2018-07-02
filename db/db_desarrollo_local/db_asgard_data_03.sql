--
-- Base de datos: `db_asgard`
--
USE `db_asgard`;
-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `ACCION`
--
INSERT INTO `accion` (`acc_id`, `acc_nombre`, `acc_url_accion`, `acc_tipo`, `acc_descripcion`, `acc_lang_file`, `acc_dir_imagen`, `acc_estado`, `acc_estado_logico`) VALUES
(1, 'Save', 'Save', 'General', 'Save', NULL, 'guardar.png' , '1', '1'),
(2, 'Approve', 'Approve', 'General', 'Approve', NULL, 'aprobar.png' , '1', '1'),
(3, 'Deny', 'Deny', 'General', 'Deny', NULL, 'negar.png', '1', '1');

-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `ETNIA`
--
INSERT INTO `etnia` (`etn_id`, `etn_nombre`, `etn_descripcion`, `etn_estado`, `etn_estado_logico`) VALUES
(1, 'Afroecuatoriano/a', 'Afroecuatoriano/a', '1', '1'),
(2, 'Blanco/a', 'Blanco/a', '1', '1'),
(3, 'Indígena', 'Indígena', '1', '1'),
(4, 'Mestizo/a', 'Mestizo/a', '1', '1'),
(5, 'Montubio/a', 'Montubio/a', '1', '1'),
(6, 'Otro', 'Otro', '1', '1'),
(7, 'Negro/a', 'Negro/a', '1', '1'),
(8, 'Mulato/a', 'Mulato/a', '1', '1'),
(9, 'No registra', 'No registra', '1', '1');

-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `ESTADO_CIVIL`
--
INSERT INTO `estado_civil` (`eciv_id`, `eciv_nombre`, `eciv_descripcion`, `eciv_estado`, `eciv_estado_logico`) VALUES
(1, 'Soltero', 'Soltero', '1', '1'),
(2, 'Casado', 'Casado', '1', '1'),
(3, 'Divorciado', 'Divorciado', '1', '1'),
(4, 'Unión Libre', 'Unión Libre', '1', '1'),
(5, 'Viudo', 'Viudo', '1', '1');

-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `TIPO_PARENTESCO`
--
INSERT INTO `tipo_parentesco` (`tpar_id`, `tpar_nombre`, `tpar_descripcion`, `tpar_grado`, `tpar_estado`, `tpar_estado_logico`) VALUES
(1, 'Esposo', 'descripción de parentesco', '1', '1', '1'),
(2, 'Esposa', 'descripción de parentesco', '1', '1', '1'),
(3, 'Hijo', 'descripción de parentesco', '1', '1', '1'),
(4, 'Hija', 'descripción de parentesco', '1', '1', '1'),
(5, 'Padre', 'descripción de parentesco', '1', '1', '1'),
(6, 'Madre', 'descripción de parentesco', '1', '1', '1'),
(7, 'Abuelo', 'descripción de parentesco', '0', '1', '1'),
(8, 'Abuela', 'descripción de parentesco', '0', '1', '1'),
(9, 'Hermano', 'descripción de parentesco', '0', '1', '1'),
(10, 'Hermana', 'descripción de parentesco', '0', '1', '1'),
(11, 'Tío', 'descripción de parentesco', '0', '1', '1'),
(12, 'Tía', 'descripción de parentesco', '0', '1', '1');

-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `TIPO_PASSWORD`
--
INSERT INTO `tipo_password` (`tpas_id`, `tpas_descripcion`, `tpas_validacion`, `tpas_observacion`, `tpas_estado`, `tpas_estado_logico`) VALUES
(1, 'Simples', '/^(?=.*[a-z])(?=.*[A-Z]).{VAR,}$/', 'Las claves simples deben cumplir con lo mínimo: Caracteres alfabéticos (Mayúsculas y minúsculas).', '1', '1'),
(2, 'Semicomplejas', '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\\d).{VAR,}$/', 'Las claves semicomplejas deben cumplir con lo mínimo: Caracteres alfabéticos (Mayúsculas y minúsculas). ', '1', '1'),
(3, 'Complejas', '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\\d)(?=.*[@\\,\\;#¿\\?\\}\\{\\]\\[\\-_¡!\\=&\\^:<>\\.\\+\\*\\/\\$\\(\\)]).{VAR,}$/', 'Las claves complejas deben cumplir con lo mínimo: Caracteres alfabéticos (Mayúsculas y minúsculas).\nSímbolos: @ , ; # ¿ ? } { ] [ - _ ¡ ! = & ^ : < > . + * / ( )', '1', '1');
-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `TIPO_PERSONA`
--
INSERT INTO `tipo_persona` (`tipe_id`, `tipe_nombre`, `tipe_estado`,`tipe_estado_logico`) VALUES
(1, 'Natural', '1', '1'),
(2, 'Jurídica', '1', '1');
-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `TIPO_SANGRE`
--
INSERT INTO `tipo_sangre` (`tsan_id`, `tsan_nombre`, `tsan_descripcion`, `tsan_estado`, `tsan_estado_logico`) VALUES
(1, 'AB +', 'descripción de tipo de sangre', '1', '1'),
(2, 'AB -', 'descripción de tipo de sangre', '1', '1'),
(3, 'A +', 'descripción de tipo de sangre', '1', '1'),
(4, 'A -', 'descripción de tipo de sangre', '1', '1'),
(5, 'B +', 'descripción de tipo de sangre', '1', '1'),
(6, 'B -', 'descripción de tipo de sangre', '1', '1'),
(7, 'O+', 'descripción de tipo de sangre', '1', '1'),
(8, 'O -', 'descripción de tipo de sangre', '1', '1');
-- --------------------------------------------------------

-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `APLICACION`
--
INSERT INTO `aplicacion` (`apl_id`, `apl_nombre`, `apl_tipo`,`apl_estado`, `apl_estado_logico`) VALUES
(1, 'Framework', 'General', '1', '1');


-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `PERSONA`
--

INSERT INTO `persona` (`per_id`, `per_pri_nombre`, `per_seg_nombre`, `per_pri_apellido`, `per_seg_apellido`, `per_cedula`, `per_ruc`, `per_pasaporte`, `etn_id`, `eciv_id`, `per_genero`, `pai_id_nacimiento`, `pro_id_nacimiento`, `can_id_nacimiento`, `per_fecha_nacimiento`, `per_celular`, `per_correo`, `per_foto`, `tsan_id`, `per_domicilio_sector`, `per_domicilio_cpri`, `per_domicilio_csec`, `per_domicilio_num`, `per_domicilio_ref`, `per_domicilio_telefono`, `pai_id_domicilio`, `pro_id_domicilio`, `can_id_domicilio`, `per_trabajo_nombre`, `per_trabajo_direccion`, `per_trabajo_telefono`, `per_trabajo_ext`, `pai_id_trabajo`, `pro_id_trabajo`, `can_id_trabajo`, `per_estado`, `per_fecha_creacion`, `per_fecha_modificacion`, `per_estado_logico`) VALUES
(1, 'Admin', '', 'UTEG', '', '2222222222', NULL, NULL, 1, 1, 'M', 57, 10, 87, NULL, NULL, NULL, NULL, 7, NULL, NULL, NULL, NULL, NULL, NULL, 57, 10, 87, NULL, NULL, NULL, NULL, 57, 10, 87, '1', '2017-03-23 20:50:44', NULL, '1'),
(2, 'Francisco', 'Hilario', 'Cedeño', 'Troya', '0926060385', NULL, NULL, 1, 1, 'M', 57, 10, 87, NULL, NULL, NULL, NULL, 7, NULL, NULL, NULL, NULL, NULL, NULL, 57, 10, 87, NULL, NULL, NULL, NULL, 57, 10, 87, '1', '2017-03-23 20:50:44', NULL, '1'),
(3, 'Diana', 'Nathaly', 'López', 'Armendáriz', '0923531792', NULL, NULL, 1, 1, 'F', 57, 10, 87, NULL, NULL, NULL, NULL, 7, NULL, NULL, NULL, NULL, NULL, NULL, 57, 10, 87, NULL, NULL, NULL, NULL, 57, 10, 87, '1', '2017-03-23 20:50:44', NULL, '1'),
(4, 'Giovanni', 'Antonio', 'Vergara', 'Zarate', '0917552564', NULL, NULL, 1, 1, 'M', 57, 10, 87, NULL, NULL, NULL, NULL, 7, NULL, NULL, NULL, NULL, NULL, NULL, 57, 10, 87, NULL, NULL, NULL, NULL, 57, 10, 87, '1', '2017-03-23 20:50:44', NULL, '1'),
(5, 'Grace', 'Katiuska', 'Viteri', 'Guzman', '0916704828', NULL, NULL, 1, 1, 'F', 57, 10, 87, NULL, NULL, NULL, NULL, 7, NULL, NULL, NULL, NULL, NULL, NULL, 57, 10, 87, NULL, NULL, NULL, NULL, 57, 10, 87, '1', '2017-03-23 20:50:44', NULL, '1'),
(6, 'Galo', 'Ernesto', 'Cabanilla', 'Guerra', '0910379411', NULL, NULL, 1, 1, 'M', 57, 10, 87, NULL, NULL, NULL, NULL, 7, NULL, NULL, NULL, NULL, NULL, NULL, 57, 10, 87, NULL, NULL, NULL, NULL, 57, 10, 87, '1', '2017-03-23 20:50:44', NULL, '1'),
(7, 'Mara', 'Karina', 'Cabanilla', 'Guerra', '0910379429', NULL, NULL, 1, 1, 'F', 57, 10, 87, NULL, NULL, NULL, NULL, 7, NULL, NULL, NULL, NULL, NULL, NULL, 57, 10, 87, NULL, NULL, NULL, NULL, 57, 10, 87, '1', '2017-03-23 20:50:44', NULL, '1'),
(8, 'Ana', 'María', 'Alcivar', 'Alcivar', '0923382717', NULL, NULL, 1, 1, 'F', 57, 10, 87, NULL, NULL, NULL, NULL, 7, NULL, NULL, NULL, NULL, NULL, NULL, 57, 10, 87, NULL, NULL, NULL, NULL, 57, 10, 87, '1', '2017-03-23 20:50:44', NULL, '1'),
(9, 'Italino', 'Daniel', 'Torres', 'Navarrete', '0919944413', NULL, NULL, 1, 1, 'M', 57, 10, 87, NULL, NULL, NULL, NULL, 7, NULL, NULL, NULL, NULL, NULL, NULL, 57, 10, 87, NULL, NULL, NULL, NULL, 57, 10, 87, '1', '2017-03-23 20:50:44', NULL, '1'),
(10, 'Felipe', 'Santiago', 'Sojos', 'Jara', '0703602656', NULL, NULL, 1, 1, 'M', 57, 10, 87, NULL, NULL, NULL, NULL, 7, NULL, NULL, NULL, NULL, NULL, NULL, 57, 10, 87, NULL, NULL, NULL, NULL, 57, 10, 87, '1', '2017-03-23 20:50:44', NULL, '1'),
(11, 'Nadya', 'Judith', 'Montes', 'Zavala', '1204646671', NULL, NULL, 1, 1, 'F', 57, 10, 87, NULL, NULL, NULL, NULL, 7, NULL, NULL, NULL, NULL, NULL, NULL, 57, 10, 87, NULL, NULL, NULL, NULL, 57, 10, 87, '1', '2017-03-23 20:50:44', NULL, '1'),
(12, 'Andrea', 'Rebeca', 'Bejarano', 'Macias', '0924239494', NULL, NULL, 1, 1, 'F', 57, 10, 87, NULL, NULL, NULL, NULL, 7, NULL, NULL, NULL, NULL, NULL, NULL, 57, 10, 87, NULL, NULL, NULL, NULL, 57, 10, 87, '1', '2017-03-23 20:50:44', NULL, '1'),
(13, 'Jose', 'Luis', 'Guerra', 'Cedeño', '0930526694', NULL, NULL, 1, 1, 'M', 57, 10, 87, NULL, NULL, NULL, NULL, 7, NULL, NULL, NULL, NULL, NULL, NULL, 57, 10, 87, NULL, NULL, NULL, NULL, 57, 10, 87, '1', '2017-03-23 20:50:44', NULL, '1'),
(14, 'Alicia', 'Del Rocio', 'Moran', 'Rivadeneira', '0906517594', NULL, NULL, 1, 1, 'F', 57, 10, 87, NULL, NULL, NULL, NULL, 7, NULL, NULL, NULL, NULL, NULL, NULL, 57, 10, 87, NULL, NULL, NULL, NULL, 57, 10, 87, '1', '2017-03-23 20:50:44', NULL, '1'),
(15, 'Fabiola', 'Esther', 'Mogro', 'Jara', '0925950289', NULL, NULL, 1, 1, 'F', 57, 10, 87, NULL, NULL, NULL, NULL, 7, NULL, NULL, NULL, NULL, NULL, NULL, 57, 10, 87, NULL, NULL, NULL, NULL, 57, 10, 87, '1', '2017-03-23 20:50:44', NULL, '1'),
(16, 'Luis', 'Miguel', 'Carrion', 'Araujo', '0922287230', NULL, NULL, 1, 1, 'M', 57, 10, 87, NULL, NULL, NULL, NULL, 7, NULL, NULL, NULL, NULL, NULL, NULL, 57, 10, 87, NULL, NULL, NULL, NULL, 57, 10, 87, '1', '2017-03-23 20:50:44', NULL, '1'),
(17, 'Diego', 'Marcelo', 'Mendoza', 'Salazar', '1311724056', NULL, NULL, 1, 1, 'M', 57, 10, 87, NULL, NULL, NULL, NULL, 7, NULL, NULL, NULL, NULL, NULL, NULL, 57, 10, 87, NULL, NULL, NULL, NULL, 57, 10, 87, '1', '2017-03-23 20:50:44', NULL, '1'),
(18, 'Lilibeth', 'Elizabeth', 'Mora', 'Pilatasig', '0930529516', NULL, NULL, 1, 1, 'M', 57, 10, 87, NULL, NULL, NULL, NULL, 7, NULL, NULL, NULL, NULL, NULL, NULL, 57, 10, 87, NULL, NULL, NULL, NULL, 57, 10, 87, '1', '2017-03-23 20:50:44', NULL, '1'),
(19, 'Gustavo', 'Adolfo', 'Ron', 'Lindao', '0930529515', NULL, NULL, 1, 1, 'M', 57, 10, 87, NULL, NULL, NULL, NULL, 7, NULL, NULL, NULL, NULL, NULL, NULL, 57, 10, 87, NULL, NULL, NULL, NULL, 57, 10, 87, '1', '2017-03-23 20:50:44', NULL, '1'),
(20, 'Verónica', 'Edith', 'Farfán', 'Escandón', '0918116617', NULL, NULL, 1, 1, 'M', 57, 10, 87, NULL, NULL, NULL, NULL, 7, NULL, NULL, NULL, NULL, NULL, NULL, 57, 10, 87, NULL, NULL, NULL, NULL, 57, 10, 87, '1', '2017-03-23 20:50:44', NULL, '1'),
(50, 'Marjorie', 'Sofía', 'San Andres', 'Samaniego', '0923008262', NULL, NULL, 1, 1, 'M', 57, 10, 87, NULL, NULL, NULL, NULL, 7, NULL, NULL, NULL, NULL, NULL, NULL, 57, 10, 87, NULL, NULL, NULL, NULL, 57, 10, 87, '1', '2017-03-23 20:50:44', NULL, '1'),
(51, 'Jorge', '', 'Coca', '', '4444444444', NULL, NULL, 1, 1, 'M', 57, 10, 87, NULL, NULL, NULL, NULL, 7, NULL, NULL, NULL, NULL, NULL, NULL, 57, 10, 87, NULL, NULL, NULL, NULL, 57, 10, 87, '1', '2017-08-25 09:55:00', NULL, '1'),
(52, 'Priscila', '', 'Recalde', '', '0902994243', NULL, NULL, 1, 1, 'M', 57, 10, 87, NULL, NULL, NULL, NULL, 7, NULL, NULL, NULL, NULL, NULL, NULL, 57, 10, 87, NULL, NULL, NULL, NULL, 57, 10, 87, '1', '2017-10-26 13:48:00', NULL, '1'),
(53, 'Pepita', 'Aracelly', 'Lara', 'Yance', '0913464657', NULL, NULL, 1, 1, 'M', 57, 10, 87, NULL, NULL, NULL, NULL, 7, NULL, NULL, NULL, NULL, NULL, NULL, 57, 10, 87, NULL, NULL, NULL, NULL, 57, 10, 87, '1', '2017-10-26 14:55:00', NULL, '1'),
(54, 'Andrés', 'Enrique', 'Hernandez', 'Lavayen','0914338793', NULL, NULL, 1, 1, 'M', 57, 10, 87, NULL, NULL, NULL, NULL, 7, NULL, NULL, NULL, NULL, NULL, NULL, 57, 10, 87, NULL, NULL, NULL, NULL, 57, 10, 87, '1', '2018-04-05 10:00:00', NULL, '1'),
(55, 'Angelyn', '', 'Sabando', '','0902030405', NULL, NULL, 1, 1, 'F', 57, 10, 87, NULL, NULL, NULL, NULL, 7, NULL, NULL, NULL, NULL, NULL, NULL, 57, 10, 87, NULL, NULL, NULL, NULL, 57, 10, 87, '1', '2018-05-10 17:30:00', NULL, '1'),
(56, 'Diana', '', 'Pineda', '','0906070809', NULL, NULL, 1, 1, 'F', 57, 10, 87, NULL, NULL, NULL, NULL, 7, NULL, NULL, NULL, NULL, NULL, NULL, 57, 10, 87, NULL, NULL, NULL, NULL, 57, 10, 87, '1', '2018-05-10 17:30:00', NULL, '1'),
(57, 'Xavier', '', 'Mosquera', '','0909080702', NULL, NULL, 1, 1, 'M', 57, 10, 87, NULL, NULL, NULL, NULL, 7, NULL, NULL, NULL, NULL, NULL, NULL, 57, 10, 87, NULL, NULL, NULL, NULL, 57, 10, 87, '1', '2018-05-10 17:30:00', NULL, '1'),
(58, 'Admisiones', '', '01', '','0901010101', NULL, NULL, 1, 1, 'M', 57, 10, 87, NULL, NULL, NULL, NULL, 7, NULL, NULL, NULL, NULL, NULL, NULL, 57, 10, 87, NULL, NULL, NULL, NULL, 57, 10, 87, '1', '2018-05-10 17:30:00', NULL, '1'),
(59, 'Admisiones', '', '02', '','0902020202', NULL, NULL, 1, 1, 'M', 57, 10, 87, NULL, NULL, NULL, NULL, 7, NULL, NULL, NULL, NULL, NULL, NULL, 57, 10, 87, NULL, NULL, NULL, NULL, 57, 10, 87, '1', '2018-05-10 17:30:00', NULL, '1'),
(60, 'Admisiones', '', '03', '','0903030303', NULL, NULL, 1, 1, 'M', 57, 10, 87, NULL, NULL, NULL, NULL, 7, NULL, NULL, NULL, NULL, NULL, NULL, 57, 10, 87, NULL, NULL, NULL, NULL, 57, 10, 87, '1', '2018-05-10 17:30:00', NULL, '1'),
(61, 'Admisiones', '', '04', '','0904040404', NULL, NULL, 1, 1, 'M', 57, 10, 87, NULL, NULL, NULL, NULL, 7, NULL, NULL, NULL, NULL, NULL, NULL, 57, 10, 87, NULL, NULL, NULL, NULL, 57, 10, 87, '1', '2018-05-10 17:30:00', NULL, '1'),
(62, 'Admisiones', '', '05', '','0905050505', NULL, NULL, 1, 1, 'M', 57, 10, 87, NULL, NULL, NULL, NULL, 7, NULL, NULL, NULL, NULL, NULL, NULL, 57, 10, 87, NULL, NULL, NULL, NULL, 57, 10, 87, '1', '2018-05-10 17:30:00', NULL, '1'),
(63, 'Admisiones', '', '06', '','0906060606', NULL, NULL, 1, 1, 'M', 57, 10, 87, NULL, NULL, NULL, NULL, 7, NULL, NULL, NULL, NULL, NULL, NULL, 57, 10, 87, NULL, NULL, NULL, NULL, 57, 10, 87, '1', '2018-05-10 17:30:00', NULL, '1'),
(64, 'Ventas', '', 'Posgrado01', '','0907070707', NULL, NULL, 1, 1, 'M', 57, 10, 87, NULL, NULL, NULL, NULL, 7, NULL, NULL, NULL, NULL, NULL, NULL, 57, 10, 87, NULL, NULL, NULL, NULL, 57, 10, 87, '1', '2018-05-10 17:30:00', NULL, '1'),
(65, 'Ventas', '', 'Posgrado02', '','0908080808', NULL, NULL, 1, 1, 'M', 57, 10, 87, NULL, NULL, NULL, NULL, 7, NULL, NULL, NULL, NULL, NULL, NULL, 57, 10, 87, NULL, NULL, NULL, NULL, 57, 10, 87, '1', '2018-05-10 17:30:00', NULL, '1'),
(66, 'SupervisorComercial', '', 'Posgrado', '','0909090909', NULL, NULL, 1, 1, 'M', 57, 10, 87, NULL, NULL, NULL, NULL, 7, NULL, NULL, NULL, NULL, NULL, NULL, 57, 10, 87, NULL, NULL, NULL, NULL, 57, 10, 87, '1', '2018-05-10 17:30:00', NULL, '1'),
(67, 'Karina', '', 'Muñoz', '', '0931648687', NULL, NULL, 1, 1, 'M', 57, 10, 87, NULL, NULL, NULL, NULL, 7, NULL, NULL, NULL, NULL, NULL, NULL, 57, 10, 87, NULL, NULL, NULL, NULL, 57, 10, 87, '1', '2018-03-27 10:00:00', NULL, '1'),
(68, 'Gustavo', '', 'La Mota', '', '0930231824', NULL, NULL, 1, 1, 'M', 57, 10, 87, NULL, NULL, NULL, NULL, 7, NULL, NULL, NULL, NULL, NULL, NULL, 57, 10, 87, NULL, NULL, NULL, NULL, 57, 10, 87, '1', '2018-03-27 10:00:00', NULL, '1'),
(69, 'Yasmila', '', 'Samaniego', '', '0910101010', NULL, NULL, 1, 1, 'M', 57, 10, 87, NULL, NULL, NULL, NULL, 7, NULL, NULL, NULL, NULL, NULL, NULL, 57, 10, 87, NULL, NULL, NULL, NULL, 57, 10, 87, '1', '2018-03-27 10:00:00', NULL, '1');

-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `TIPO_EMPRESA`
--
INSERT INTO `tipo_empresa` (`temp_id`, `temp_nombre`, `temp_descripcion`, `temp_estado`, `temp_estado_logico`) VALUES
(1, 'Empresa Pública', NULL, '1','1'),
(2, 'Empresa Privada', NULL, '1','1');

-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `USUARIO`
--
INSERT INTO `usuario` (`usu_id`, `per_id`, `usu_user`, `usu_sha`, `usu_password`, `usu_time_pass`, `usu_session`, `usu_last_login`, `usu_link_activo`, `usu_estado`, `usu_estado_logico`) VALUES
(1, 1, 'dlopez@uteg.edu.ec', 'aP0XxgvEdoBZ8sr19fnN34L_PxTqu3wd', 'HiafLl62OR9qInOO705nwDI3NTczY2Q5MDViYjM5NWFlYTFlZGZkZTdlNTA2MThhMTUzNjc1MjhlYTlkZGZjMDBhMjA2ZTZhMDFmMThkZTcbj9uW0LIhjc0Z1IwPfDMMAfqHOfxNRiKCxVPFWrGNLxzaIPDXaUGGCQH8cyM00AFArFj4MpKR7+fCPiSxXVuF', NULL, NULL, NULL, NULL, '1', '1' ),
(2, 2, 'fcedeno@uteg.edu.ec', 'aP0XxgvEdoBZ8sr19fnN34L_PxTqu3wd', 'HiafLl62OR9qInOO705nwDI3NTczY2Q5MDViYjM5NWFlYTFlZGZkZTdlNTA2MThhMTUzNjc1MjhlYTlkZGZjMDBhMjA2ZTZhMDFmMThkZTcbj9uW0LIhjc0Z1IwPfDMMAfqHOfxNRiKCxVPFWrGNLxzaIPDXaUGGCQH8cyM00AFArFj4MpKR7+fCPiSxXVuF', NULL, NULL, NULL, NULL, '1', '1' ),
(3, 3, 'jefedesarrollo@uteg.edu.ec', 'aP0XxgvEdoBZ8sr19fnN34L_PxTqu3wd', 'HiafLl62OR9qInOO705nwDI3NTczY2Q5MDViYjM5NWFlYTFlZGZkZTdlNTA2MThhMTUzNjc1MjhlYTlkZGZjMDBhMjA2ZTZhMDFmMThkZTcbj9uW0LIhjc0Z1IwPfDMMAfqHOfxNRiKCxVPFWrGNLxzaIPDXaUGGCQH8cyM00AFArFj4MpKR7+fCPiSxXVuF', NULL, NULL, NULL, NULL, '1', '1' ),
(4, 4, 'analistadesarrollo01@uteg.edu.ec', 'aP0XxgvEdoBZ8sr19fnN34L_PxTqu3wd', 'HiafLl62OR9qInOO705nwDI3NTczY2Q5MDViYjM5NWFlYTFlZGZkZTdlNTA2MThhMTUzNjc1MjhlYTlkZGZjMDBhMjA2ZTZhMDFmMThkZTcbj9uW0LIhjc0Z1IwPfDMMAfqHOfxNRiKCxVPFWrGNLxzaIPDXaUGGCQH8cyM00AFArFj4MpKR7+fCPiSxXVuF', NULL, NULL, NULL, NULL, '1', '1' ),
(5, 5, 'analistadesarrollo02@uteg.edu.ec', 'aP0XxgvEdoBZ8sr19fnN34L_PxTqu3wd', 'HiafLl62OR9qInOO705nwDI3NTczY2Q5MDViYjM5NWFlYTFlZGZkZTdlNTA2MThhMTUzNjc1MjhlYTlkZGZjMDBhMjA2ZTZhMDFmMThkZTcbj9uW0LIhjc0Z1IwPfDMMAfqHOfxNRiKCxVPFWrGNLxzaIPDXaUGGCQH8cyM00AFArFj4MpKR7+fCPiSxXVuF', NULL, NULL, NULL, NULL, '1', '1' ),
(6, 6, 'gcabanilla@uteg.edu.ec', 'aP0XxgvEdoBZ8sr19fnN34L_PxTqu3wd', 'HiafLl62OR9qInOO705nwDI3NTczY2Q5MDViYjM5NWFlYTFlZGZkZTdlNTA2MThhMTUzNjc1MjhlYTlkZGZjMDBhMjA2ZTZhMDFmMThkZTcbj9uW0LIhjc0Z1IwPfDMMAfqHOfxNRiKCxVPFWrGNLxzaIPDXaUGGCQH8cyM00AFArFj4MpKR7+fCPiSxXVuF', NULL, NULL, NULL, NULL, '1', '1' ),
(7, 7, 'mcabanilla@uteg.edu.ec', 'aP0XxgvEdoBZ8sr19fnN34L_PxTqu3wd', 'HiafLl62OR9qInOO705nwDI3NTczY2Q5MDViYjM5NWFlYTFlZGZkZTdlNTA2MThhMTUzNjc1MjhlYTlkZGZjMDBhMjA2ZTZhMDFmMThkZTcbj9uW0LIhjc0Z1IwPfDMMAfqHOfxNRiKCxVPFWrGNLxzaIPDXaUGGCQH8cyM00AFArFj4MpKR7+fCPiSxXVuF', NULL, NULL, NULL, NULL, '1', '1' ),
(8, 8, 'aalcivar@uteg.edu.ec', 'aP0XxgvEdoBZ8sr19fnN34L_PxTqu3wd', 'HiafLl62OR9qInOO705nwDI3NTczY2Q5MDViYjM5NWFlYTFlZGZkZTdlNTA2MThhMTUzNjc1MjhlYTlkZGZjMDBhMjA2ZTZhMDFmMThkZTcbj9uW0LIhjc0Z1IwPfDMMAfqHOfxNRiKCxVPFWrGNLxzaIPDXaUGGCQH8cyM00AFArFj4MpKR7+fCPiSxXVuF', NULL, NULL, NULL, NULL, '1', '1' ),
(9, 9, 'itorres@uteg.edu.ec', 'aP0XxgvEdoBZ8sr19fnN34L_PxTqu3wd', 'HiafLl62OR9qInOO705nwDI3NTczY2Q5MDViYjM5NWFlYTFlZGZkZTdlNTA2MThhMTUzNjc1MjhlYTlkZGZjMDBhMjA2ZTZhMDFmMThkZTcbj9uW0LIhjc0Z1IwPfDMMAfqHOfxNRiKCxVPFWrGNLxzaIPDXaUGGCQH8cyM00AFArFj4MpKR7+fCPiSxXVuF', NULL, NULL, NULL, NULL, '1', '1' ),
(10, 10, 'fsojos@uteg.edu.ec', 'aP0XxgvEdoBZ8sr19fnN34L_PxTqu3wd', 'HiafLl62OR9qInOO705nwDI3NTczY2Q5MDViYjM5NWFlYTFlZGZkZTdlNTA2MThhMTUzNjc1MjhlYTlkZGZjMDBhMjA2ZTZhMDFmMThkZTcbj9uW0LIhjc0Z1IwPfDMMAfqHOfxNRiKCxVPFWrGNLxzaIPDXaUGGCQH8cyM00AFArFj4MpKR7+fCPiSxXVuF', NULL, NULL, NULL, NULL, '1', '1' ),
(11, 11, 'nmontes@uteg.edu.ec', 'aP0XxgvEdoBZ8sr19fnN34L_PxTqu3wd', 'HiafLl62OR9qInOO705nwDI3NTczY2Q5MDViYjM5NWFlYTFlZGZkZTdlNTA2MThhMTUzNjc1MjhlYTlkZGZjMDBhMjA2ZTZhMDFmMThkZTcbj9uW0LIhjc0Z1IwPfDMMAfqHOfxNRiKCxVPFWrGNLxzaIPDXaUGGCQH8cyM00AFArFj4MpKR7+fCPiSxXVuF', NULL, NULL, NULL, NULL, '1', '1' ),
(12, 12, 'abejarano@uteg.edu.ec', 'aP0XxgvEdoBZ8sr19fnN34L_PxTqu3wd', 'HiafLl62OR9qInOO705nwDI3NTczY2Q5MDViYjM5NWFlYTFlZGZkZTdlNTA2MThhMTUzNjc1MjhlYTlkZGZjMDBhMjA2ZTZhMDFmMThkZTcbj9uW0LIhjc0Z1IwPfDMMAfqHOfxNRiKCxVPFWrGNLxzaIPDXaUGGCQH8cyM00AFArFj4MpKR7+fCPiSxXVuF', NULL, NULL, NULL, NULL, '1', '1' ),
(13, 13, 'supervisorcontactcenter@uteg.edu.ec', '98rN_xjra2UJIoPhYOYaAE-w6mTpWpEY', 'SlFGzJsJP6BIig0LZCnCC2QxMmU5ZGMwOTA0Nzk0NzAyNjlhMTA3ZjU3MmY4NjYxZGE5MjNmNjc1MDk0ZDMyZDI0Y2RlOWZlMjZhNjA5OGHGLjaFA3dz2C/PGQeIMYX9+Kfrt7vOh0SwjZMxcJiFAZL8HaokX3bOQwXy/lMWmmq5LNX80TJHhAJ+nX6wCScJ', NULL, NULL, NULL, NULL, '1', '1' ),
(14, 14, 'supervisorcomercialposgrado@uteg.edu.ec', 'aP0XxgvEdoBZ8sr19fnN34L_PxTqu3wd', 'HiafLl62OR9qInOO705nwDI3NTczY2Q5MDViYjM5NWFlYTFlZGZkZTdlNTA2MThhMTUzNjc1MjhlYTlkZGZjMDBhMjA2ZTZhMDFmMThkZTcbj9uW0LIhjc0Z1IwPfDMMAfqHOfxNRiKCxVPFWrGNLxzaIPDXaUGGCQH8cyM00AFArFj4MpKR7+fCPiSxXVuF', NULL, NULL, NULL, NULL, '1', '1' ),
(15, 15, 'admisiones01@uteg.edu.ec', 'aP0XxgvEdoBZ8sr19fnN34L_PxTqu3wd', 'HiafLl62OR9qInOO705nwDI3NTczY2Q5MDViYjM5NWFlYTFlZGZkZTdlNTA2MThhMTUzNjc1MjhlYTlkZGZjMDBhMjA2ZTZhMDFmMThkZTcbj9uW0LIhjc0Z1IwPfDMMAfqHOfxNRiKCxVPFWrGNLxzaIPDXaUGGCQH8cyM00AFArFj4MpKR7+fCPiSxXVuF', NULL, NULL, NULL, NULL, '0', '1' ),
(16, 16, 'contactcenter02@uteg.edu.ec', 'aP0XxgvEdoBZ8sr19fnN34L_PxTqu3wd', 'HiafLl62OR9qInOO705nwDI3NTczY2Q5MDViYjM5NWFlYTFlZGZkZTdlNTA2MThhMTUzNjc1MjhlYTlkZGZjMDBhMjA2ZTZhMDFmMThkZTcbj9uW0LIhjc0Z1IwPfDMMAfqHOfxNRiKCxVPFWrGNLxzaIPDXaUGGCQH8cyM00AFArFj4MpKR7+fCPiSxXVuF', NULL, NULL, NULL, NULL, '1', '1' ),
(17, 17, 'contactcenter03@uteg.edu.ec', 'aP0XxgvEdoBZ8sr19fnN34L_PxTqu3wd', 'HiafLl62OR9qInOO705nwDI3NTczY2Q5MDViYjM5NWFlYTFlZGZkZTdlNTA2MThhMTUzNjc1MjhlYTlkZGZjMDBhMjA2ZTZhMDFmMThkZTcbj9uW0LIhjc0Z1IwPfDMMAfqHOfxNRiKCxVPFWrGNLxzaIPDXaUGGCQH8cyM00AFArFj4MpKR7+fCPiSxXVuF', NULL, NULL, NULL, NULL, '1', '1' ),
(18, 18, 'contactcenter01@uteg.edu.ec', 'aP0XxgvEdoBZ8sr19fnN34L_PxTqu3wd', 'HiafLl62OR9qInOO705nwDI3NTczY2Q5MDViYjM5NWFlYTFlZGZkZTdlNTA2MThhMTUzNjc1MjhlYTlkZGZjMDBhMjA2ZTZhMDFmMThkZTcbj9uW0LIhjc0Z1IwPfDMMAfqHOfxNRiKCxVPFWrGNLxzaIPDXaUGGCQH8cyM00AFArFj4MpKR7+fCPiSxXVuF', NULL, NULL, NULL, NULL, '1', '1' ),
(19, 19, 'contactcenter04@uteg.edu.ec', 'aP0XxgvEdoBZ8sr19fnN34L_PxTqu3wd', 'HiafLl62OR9qInOO705nwDI3NTczY2Q5MDViYjM5NWFlYTFlZGZkZTdlNTA2MThhMTUzNjc1MjhlYTlkZGZjMDBhMjA2ZTZhMDFmMThkZTcbj9uW0LIhjc0Z1IwPfDMMAfqHOfxNRiKCxVPFWrGNLxzaIPDXaUGGCQH8cyM00AFArFj4MpKR7+fCPiSxXVuF', NULL, NULL, NULL, NULL, '1', '1' ),
(20, 20, 'colecturia@uteg.edu.ec', '98rN_xjra2UJIoPhYOYaAE-w6mTpWpEY', 'SlFGzJsJP6BIig0LZCnCC2QxMmU5ZGMwOTA0Nzk0NzAyNjlhMTA3ZjU3MmY4NjYxZGE5MjNmNjc1MDk0ZDMyZDI0Y2RlOWZlMjZhNjA5OGHGLjaFA3dz2C/PGQeIMYX9+Kfrt7vOh0SwjZMxcJiFAZL8HaokX3bOQwXy/lMWmmq5LNX80TJHhAJ+nX6wCScJ', NULL, NULL, NULL, NULL, '0', '1'),
(50, 50, 'msanandres@uteg.edu.ec', 'aP0XxgvEdoBZ8sr19fnN34L_PxTqu3wd', 'HiafLl62OR9qInOO705nwDI3NTczY2Q5MDViYjM5NWFlYTFlZGZkZTdlNTA2MThhMTUzNjc1MjhlYTlkZGZjMDBhMjA2ZTZhMDFmMThkZTcbj9uW0LIhjc0Z1IwPfDMMAfqHOfxNRiKCxVPFWrGNLxzaIPDXaUGGCQH8cyM00AFArFj4MpKR7+fCPiSxXVuF', NULL, NULL, NULL, NULL, '1', '1' ),
(51, 51, 'coordinadorfinanzas@uteg.edu.ec', 'aP0XxgvEdoBZ8sr19fnN34L_PxTqu3wd', 'HiafLl62OR9qInOO705nwDI3NTczY2Q5MDViYjM5NWFlYTFlZGZkZTdlNTA2MThhMTUzNjc1MjhlYTlkZGZjMDBhMjA2ZTZhMDFmMThkZTcbj9uW0LIhjc0Z1IwPfDMMAfqHOfxNRiKCxVPFWrGNLxzaIPDXaUGGCQH8cyM00AFArFj4MpKR7+fCPiSxXVuF', NULL, NULL, NULL, NULL, '1', '1' ),
(52, 52, 'secretariaonline@uteg.edu.ec', 'aP0XxgvEdoBZ8sr19fnN34L_PxTqu3wd', 'HiafLl62OR9qInOO705nwDI3NTczY2Q5MDViYjM5NWFlYTFlZGZkZTdlNTA2MThhMTUzNjc1MjhlYTlkZGZjMDBhMjA2ZTZhMDFmMThkZTcbj9uW0LIhjc0Z1IwPfDMMAfqHOfxNRiKCxVPFWrGNLxzaIPDXaUGGCQH8cyM00AFArFj4MpKR7+fCPiSxXVuF', NULL, NULL, NULL, NULL, '1', '1' ),
(53, 53, 'colecturia@uteg.edu.ec', 'aP0XxgvEdoBZ8sr19fnN34L_PxTqu3wd', 'HiafLl62OR9qInOO705nwDI3NTczY2Q5MDViYjM5NWFlYTFlZGZkZTdlNTA2MThhMTUzNjc1MjhlYTlkZGZjMDBhMjA2ZTZhMDFmMThkZTcbj9uW0LIhjc0Z1IwPfDMMAfqHOfxNRiKCxVPFWrGNLxzaIPDXaUGGCQH8cyM00AFArFj4MpKR7+fCPiSxXVuF', NULL, NULL, NULL, NULL, '1', '1' ),
(54, 54, 'ahernandez@uteg.edu.ec', 'aP0XxgvEdoBZ8sr19fnN34L_PxTqu3wd', 'HiafLl62OR9qInOO705nwDI3NTczY2Q5MDViYjM5NWFlYTFlZGZkZTdlNTA2MThhMTUzNjc1MjhlYTlkZGZjMDBhMjA2ZTZhMDFmMThkZTcbj9uW0LIhjc0Z1IwPfDMMAfqHOfxNRiKCxVPFWrGNLxzaIPDXaUGGCQH8cyM00AFArFj4MpKR7+fCPiSxXVuF', NULL, NULL, NULL, NULL, '1', '1' ),
(56, 56, 'decanasemipresencial@uteg.edu.ec', 'aP0XxgvEdoBZ8sr19fnN34L_PxTqu3wd', 'HiafLl62OR9qInOO705nwDI3NTczY2Q5MDViYjM5NWFlYTFlZGZkZTdlNTA2MThhMTUzNjc1MjhlYTlkZGZjMDBhMjA2ZTZhMDFmMThkZTcbj9uW0LIhjc0Z1IwPfDMMAfqHOfxNRiKCxVPFWrGNLxzaIPDXaUGGCQH8cyM00AFArFj4MpKR7+fCPiSxXVuF', NULL, NULL, NULL, NULL, '1', '1' ),
(57, 57, 'xmosquera@uteg.edu.ec', 'aP0XxgvEdoBZ8sr19fnN34L_PxTqu3wd', 'HiafLl62OR9qInOO705nwDI3NTczY2Q5MDViYjM5NWFlYTFlZGZkZTdlNTA2MThhMTUzNjc1MjhlYTlkZGZjMDBhMjA2ZTZhMDFmMThkZTcbj9uW0LIhjc0Z1IwPfDMMAfqHOfxNRiKCxVPFWrGNLxzaIPDXaUGGCQH8cyM00AFArFj4MpKR7+fCPiSxXVuF', NULL, NULL, NULL, NULL, '1', '1' ),
(58, 58, 'admisiones01@uteg.edu.ec', 'aP0XxgvEdoBZ8sr19fnN34L_PxTqu3wd', 'HiafLl62OR9qInOO705nwDI3NTczY2Q5MDViYjM5NWFlYTFlZGZkZTdlNTA2MThhMTUzNjc1MjhlYTlkZGZjMDBhMjA2ZTZhMDFmMThkZTcbj9uW0LIhjc0Z1IwPfDMMAfqHOfxNRiKCxVPFWrGNLxzaIPDXaUGGCQH8cyM00AFArFj4MpKR7+fCPiSxXVuF', NULL, NULL, NULL, NULL, '1', '1' ),
(59, 59, 'admisiones02@uteg.edu.ec', 'aP0XxgvEdoBZ8sr19fnN34L_PxTqu3wd', 'HiafLl62OR9qInOO705nwDI3NTczY2Q5MDViYjM5NWFlYTFlZGZkZTdlNTA2MThhMTUzNjc1MjhlYTlkZGZjMDBhMjA2ZTZhMDFmMThkZTcbj9uW0LIhjc0Z1IwPfDMMAfqHOfxNRiKCxVPFWrGNLxzaIPDXaUGGCQH8cyM00AFArFj4MpKR7+fCPiSxXVuF', NULL, NULL, NULL, NULL, '1', '1' ),
(60, 60, 'admisiones03@uteg.edu.ec', 'aP0XxgvEdoBZ8sr19fnN34L_PxTqu3wd', 'HiafLl62OR9qInOO705nwDI3NTczY2Q5MDViYjM5NWFlYTFlZGZkZTdlNTA2MThhMTUzNjc1MjhlYTlkZGZjMDBhMjA2ZTZhMDFmMThkZTcbj9uW0LIhjc0Z1IwPfDMMAfqHOfxNRiKCxVPFWrGNLxzaIPDXaUGGCQH8cyM00AFArFj4MpKR7+fCPiSxXVuF', NULL, NULL, NULL, NULL, '1', '1' ),
(61, 61, 'admisiones04@uteg.edu.ec', 'aP0XxgvEdoBZ8sr19fnN34L_PxTqu3wd', 'HiafLl62OR9qInOO705nwDI3NTczY2Q5MDViYjM5NWFlYTFlZGZkZTdlNTA2MThhMTUzNjc1MjhlYTlkZGZjMDBhMjA2ZTZhMDFmMThkZTcbj9uW0LIhjc0Z1IwPfDMMAfqHOfxNRiKCxVPFWrGNLxzaIPDXaUGGCQH8cyM00AFArFj4MpKR7+fCPiSxXVuF', NULL, NULL, NULL, NULL, '1', '1' ),
(62, 62, 'admisiones05@uteg.edu.ec', 'aP0XxgvEdoBZ8sr19fnN34L_PxTqu3wd', 'HiafLl62OR9qInOO705nwDI3NTczY2Q5MDViYjM5NWFlYTFlZGZkZTdlNTA2MThhMTUzNjc1MjhlYTlkZGZjMDBhMjA2ZTZhMDFmMThkZTcbj9uW0LIhjc0Z1IwPfDMMAfqHOfxNRiKCxVPFWrGNLxzaIPDXaUGGCQH8cyM00AFArFj4MpKR7+fCPiSxXVuF', NULL, NULL, NULL, NULL, '1', '1' ),
(63, 63, 'admisiones06@uteg.edu.ec', 'aP0XxgvEdoBZ8sr19fnN34L_PxTqu3wd', 'HiafLl62OR9qInOO705nwDI3NTczY2Q5MDViYjM5NWFlYTFlZGZkZTdlNTA2MThhMTUzNjc1MjhlYTlkZGZjMDBhMjA2ZTZhMDFmMThkZTcbj9uW0LIhjc0Z1IwPfDMMAfqHOfxNRiKCxVPFWrGNLxzaIPDXaUGGCQH8cyM00AFArFj4MpKR7+fCPiSxXVuF', NULL, NULL, NULL, NULL, '1', '1' ),
(64, 64, 'ventasposgrado01@uteg.edu.ec', 'aP0XxgvEdoBZ8sr19fnN34L_PxTqu3wd', 'HiafLl62OR9qInOO705nwDI3NTczY2Q5MDViYjM5NWFlYTFlZGZkZTdlNTA2MThhMTUzNjc1MjhlYTlkZGZjMDBhMjA2ZTZhMDFmMThkZTcbj9uW0LIhjc0Z1IwPfDMMAfqHOfxNRiKCxVPFWrGNLxzaIPDXaUGGCQH8cyM00AFArFj4MpKR7+fCPiSxXVuF', NULL, NULL, NULL, NULL, '1', '1' ),
(65, 65, 'ventasposgrado02@uteg.edu.ec', 'aP0XxgvEdoBZ8sr19fnN34L_PxTqu3wd', 'HiafLl62OR9qInOO705nwDI3NTczY2Q5MDViYjM5NWFlYTFlZGZkZTdlNTA2MThhMTUzNjc1MjhlYTlkZGZjMDBhMjA2ZTZhMDFmMThkZTcbj9uW0LIhjc0Z1IwPfDMMAfqHOfxNRiKCxVPFWrGNLxzaIPDXaUGGCQH8cyM00AFArFj4MpKR7+fCPiSxXVuF', NULL, NULL, NULL, NULL, '1', '1' ),
(66, 66, 'supervisorcomercialposgrado@uteg.ec', 'aP0XxgvEdoBZ8sr19fnN34L_PxTqu3wd', 'HiafLl62OR9qInOO705nwDI3NTczY2Q5MDViYjM5NWFlYTFlZGZkZTdlNTA2MThhMTUzNjc1MjhlYTlkZGZjMDBhMjA2ZTZhMDFmMThkZTcbj9uW0LIhjc0Z1IwPfDMMAfqHOfxNRiKCxVPFWrGNLxzaIPDXaUGGCQH8cyM00AFArFj4MpKR7+fCPiSxXVuF', NULL, NULL, NULL, NULL, '1', '1' ),
(67, 67, 'kmunoz@uteg.edu.ec', '60sU04pqQwiP0I5NLm0pbLFhU8x_eUJw', 'PMLFqAeA3TjsRNVHHkSrEzMwZDI4OTVlNjU1YzBjMTgxNzQ2NWM3YTQ3NTk1MjcwZWMzZjYxYThlMGFlZjgyZGQ3YzA5MjM1ZWFjMTY3MWXB0IJRlKOw/a2OCww0lEq+NsDMShqFj8ufvXsVXRlIqUwkv6yvkFcw0Y9+adGlvMMfTI/GXubd9+VqnfYSfdjl', NULL, NULL, NULL, NULL, '1', '1'),
(68, 68, 'glamota@uteg.edu.ec', '60sU04pqQwiP0I5NLm0pbLFhU8x_eUJw', 'PMLFqAeA3TjsRNVHHkSrEzMwZDI4OTVlNjU1YzBjMTgxNzQ2NWM3YTQ3NTk1MjcwZWMzZjYxYThlMGFlZjgyZGQ3YzA5MjM1ZWFjMTY3MWXB0IJRlKOw/a2OCww0lEq+NsDMShqFj8ufvXsVXRlIqUwkv6yvkFcw0Y9+adGlvMMfTI/GXubd9+VqnfYSfdjl', NULL, NULL, NULL, NULL, '1', '1'),
(69, 69, 'directortalento@uteg.edu.ec', '60sU04pqQwiP0I5NLm0pbLFhU8x_eUJw', 'PMLFqAeA3TjsRNVHHkSrEzMwZDI4OTVlNjU1YzBjMTgxNzQ2NWM3YTQ3NTk1MjcwZWMzZjYxYThlMGFlZjgyZGQ3YzA5MjM1ZWFjMTY3MWXB0IJRlKOw/a2OCww0lEq+NsDMShqFj8ufvXsVXRlIqUwkv6yvkFcw0Y9+adGlvMMfTI/GXubd9+VqnfYSfdjl', NULL, NULL, NULL, NULL, '1', '1');

INSERT INTO `empresa` (`emp_id`, `temp_id`, `emp_razon_social`, `emp_nombre_comercial`, `emp_alias`, `emp_ruc`, `emp_dominio`, `emp_imap_domain`, `emp_imap_port`, `emp_imap_user`, `emp_imap_pass`, `emp_direccion`, `emp_telefono`, `emp_descripcion`, `emp_estado`, `emp_fecha_creacion`, `emp_fecha_modificacion`, `emp_estado_logico`) VALUES
(1, 2, 'Empresa S.A', 'Empresa', 'Empresa', '', 'empresa.com', 'empresa.com', '587', '', '', NULL, NULL, NULL, '1', CURRENT_TIMESTAMP, NULL, '1');

INSERT INTO `empresa_persona`(`eper_id`, `emp_id`, `per_id`, `eper_estado`, `eper_fecha_creacion`, `eper_fecha_modificacion`, `eper_estado_logico`) VALUES
(1, 1, 1, '1', '2015-04-10 13:00:00', NULL, '1'),
(2, 1, 2, '1', '2015-04-10 13:00:00', NULL, '1');

-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `IDIOMA`
--
INSERT INTO `idioma` (`idi_id`, `idi_nombre`, `idi_tipo`,`idi_estado`, `idi_estado_logico`) VALUES
(1, 'Español', 'General', '1','1'),
(2, 'Ingles', 'General', '1','1');
-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `PLANTILLA`
--
INSERT INTO `plantilla` (`pla_id`, `pla_nombre`, `pla_tipo`, `pla_estado`, `pla_estado_logico`) VALUES
(1, 'Vitalius', 'General', '1', '1');
-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `CONFIGURACION_SEGURIDAD`
--
INSERT INTO `configuracion_seguridad` (`cseg_id`, `tpas_id`, `cseg_long_pass`, `cseg_expiracion`, `cseg_descripcion`, `cseg_observacion`, `cseg_estado`, `cseg_estado_logico`) VALUES
(1, 1, '5', 0, 'descripción seguridad', 'observación seguridad', '1','1'),
(2, 2, '6', 30, 'descripción seguridad', 'observación seguridad','1', '1'),
(3, 3, '7', 60, 'descripción seguridad', 'observación seguirdad','1', '1');
-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `GRUPO`
--
INSERT INTO `grupo` (`gru_id`,`gru_nombre`, `gru_descripcion`,`gru_estado`,`gru_estado_logico`) VALUES
(1,'Super Admin','Super Admin','1','1'),
(2,'Pre Interesado','Pre Interesado','1','1'),
(3,'Interesado','Interesado','1','1'),
(4,'Aspirante','Aspirante','1','1'),
(5,'Estudiante','Estudiante','1','1'),
(6,'Docente','Docente','1','1'),
(7,'Sistemas','Sistemas','1','1'),
(8,'Admisiones','Admisiones','1','1'),
(9,'Colecturia','Colecturia','1','1'),
(10,'Online','Online','1','1'),
(11,'Financiero','Financiero','1','1'),
(12,'Grado','Grado','1','1'),
(13,'Talento Humano','Talento Humano','1','1');
-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `ROL`
--
INSERT INTO `rol` (`rol_id`,`rol_nombre`, `rol_descripcion`, `rol_estado`,`rol_estado_logico`) VALUES
(1,'Super Administrador','Super Administrador','1','1'),
(2,'Pre Interesado','Pre Interesado','1','1'),
(3,'Interesado','Interesado','1','1'),
(4,'Aspirante','Aspirante','1','1'),
(5,'Estudiante','Estudiante','1','1'),
(6,'Docente','Docente','1','1'),
(7,'Admin Sistemas','Admin Sistemas','1','1'),
(8,'Admin Administrativo','Admin Administrativo','1','1'),
(9,'Director','Director','1','1'),
(10,'Jefe','Jefe','1','1'),
(11,'Coordinador Senior','Coordinador Senior','1','1'),
(12,'Coordinador Junior','Coordinador Junior','1','1'),
(13,'Supervisor Senior','Supervisor Senior','1','1'),
(14,'Supervisor Junior','Supervisor Junior','1','1'),
(15,'Analista Senior','Analista Senior','1','1'),
(16,'Analista Junior','Analista Junior','1','1'),
(17,'Asistente Senior','Asistente Senior','1','1'),
(18,'Asistente Junior','Asistente Junior','1','1'),
(19,'Ejecutivo Comercial','Ejecutivo Comercial','1','1'),
(20,'Secretaria','Secretaria','1','1');

-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `GRUP_ROL`
--
INSERT INTO `grup_rol` (`grol_id`, `gru_id`, `rol_id`, `grol_estado`,`grol_estado_logico`) VALUES
(1, 1, 1, '1','1'),
(2, 7, 10, '1','1'),
(3, 7, 15, '1','1'),
(4, 7, 16, '1','1'),
(5, 8, 10, '1','1'),
(6, 8, 11, '1','1'),
(7, 8, 13, '1','1'),
(8, 8, 19, '1','1'),
(9, 9, 10, '1','1'),
(10, 2, 2, '1','1'),
(11, 3, 3, '1','1'),
(12, 4, 4, '1','1'),
(13, 11, 11, '1','1'),
(14, 10, 10, '1','1'),
(15, 10, 20, '1','1'),
(16, 9, 16, '1','1'),
(17, 10, 11, '1','1'),
(18, 12, 10, '1','1'),
(19, 6, 6, '1','1'),
(20, 13, 9, '1','1');

-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `USUA_GROL`
--
INSERT INTO `usua_grol_eper` (`ugep_id`, `usu_id`, `eper_id`, `grol_id`, `ugep_estado`, `ugep_estado_logico`) VALUES
(1, 1, 1, 1, '1', '1'),
(2, 2, 1, 2, '1', '1'),
(3, 3, 1, 1, '1', '1'),
(4, 4, 1, 1, '1', '1'),
(5, 5, 1, 1, '1', '1'),
(6, 11, 1, 5, '1', '1'),
(7, 12, 1, 6, '1', '1'),  
(8, 13, 1, 7, '1', '1'),
(9, 14, 1, 8, '1', '1'),
(10, 15, 1, 8, '1', '1'),
(11, 16, 1, 8, '1', '1'),
(12, 17, 1, 8, '1', '1'),
(13, 18, 1, 8, '1', '1'),
(14, 19, 1, 8, '1', '1'),
(15, 20, 1, 9, '1', '1'),
(16, 51, 1, 13, '1', '1'),
(17, 8, 1, 14, '1', '1'),
(18, 52, 1, 15, '1', '1'),
(19, 53, 1, 9, '1', '1'),
(20, 54, 1, 17, '1', '1'),
(21, 58, 1, 8, '1', '1'), /* Nuevo */
(22, 59, 1, 8, '1', '1'),
(23, 60, 1, 8, '1', '1'),
(24, 61, 1, 8, '1', '1'),
(25, 62, 1, 8, '1', '1'),
(26, 63, 1, 8, '1', '1'),
(27, 64, 1, 8, '1', '1'),
(28, 65, 1, 8, '1', '1'),
(29, 66, 1, 7, '1', '1'),
(30, 56, 1, 18, '1', '1'),
(31, 57, 1, 18, '1', '1'),

(32, 67, 1, 19, '1', '1'),
(33, 68, 1, 19, '1', '1'),
(34, 69, 1, 20, '1', '1');

-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `MODULO`
--
INSERT INTO `modulo` (`mod_id`, `apl_id`, `mod_nombre`, `mod_tipo`, `mod_dir_imagen`, `mod_url`, `mod_orden`, `mod_lang_file`, `mod_estado`, `mod_estado_logico`) VALUES
(1, 1, 'Ficha Datos', 'Ficha Datos', 'glyphicon glyphicon-list-alt', 'ficha/createins', 1, NULL,'1', '1'),
(2, 1, 'Interesados', 'Interesados', 'glyphicon glyphicon-user', 'interesado/listarinteresados', 2, NULL,'1', '1'),
(3, 1, 'Solicitudes', 'Solicitudes', 'glyphicon glyphicon-file', 'solicitudinscripcion/listarsolpendiente', 3, NULL,'1', '1'),
(4, 1, 'Pagos', 'Pagos', 'glyphicon glyphicon-usd', 'registrarpago/listarpagosolicadm', 4, NULL,'1', '1'),
(5, 1, 'Configuraciones', 'Configuraciones', 'glyphicon glyphicon-cog', 'asignacionejecutivo/listarasignacion', 6, NULL,'1', '1'),
(6, 1, 'Aspirantes', 'Aspirantes', 'glyphicon glyphicon-education', 'aspirante/listaraspirantes', 5, NULL,'1', '1'),
(7, 1, 'Graduados', 'Graduados', 'glyphicon glyphicon-education', 'admingraduado/listarencuestados', 7, NULL,'1', '1'),
(8, 1, 'Expediente', 'Expediente', 'glyphicon glyphicon-user', 'expedienteprofesor/create', 8, NULL,'1', '1'),
(9, 1, 'Administración', 'Administración', 'glyphicon glyphicon-user', 'adminmetodoingreso/creaperiodo', 1, NULL,'1', '1'),
(10, 1, 'Perfil', 'Perfil', 'glyphicon glyphicon-user', 'perfil/update', 9, NULL,'1', '1'),
(11, 1, 'Gestión', 'Gestión', 'glyphicon glyphicon-folder-open', 'gestion/create', 17, NULL,'1', '1'),
(12, 1, 'Evaluación', 'Evaluación', 'glyphicon glyphicon-folder-open', 'evaluacion/evaluar', 1, NULL,'1', '1'),
(13, 1, 'Sistema Marcación', 'Sistema Marcación', 'glyphicon glyphicon-folder-open', 'marcacion/ingreso', 1, NULL,'1', '1'),
(14, 1, 'Facturación', 'Facturación', 'glyphicon glyphicon-usd', 'facturacion/listaritem', 1, NULL,'1', '1');

-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `OBJETO_MODULO`
--
INSERT INTO `objeto_modulo` (`omod_id`, `mod_id`, `omod_padre_id`, `omod_nombre`, `omod_tipo`, `omod_tipo_boton`, `omod_accion`, `omod_function`, `omod_dir_imagen`, `omod_entidad`, `omod_orden`, `omod_estado_visible`, `omod_lang_file`, `omod_estado`,`omod_estado_logico`) VALUES
(1, 1, 1, 'Crear Ficha Datos', 'S', '0', 'Crear Ficha Datos', '', '', 'ficha/createins', 1, '1', NULL, '1', '1'),
(2, 1, 2, 'Ver Ficha Datos', 'S', '0', 'Ver Ficha Datos', '', '', 'ficha/view', 1, '1', NULL, '1', '1'),
(3, 2, 3, 'Interesados', 'S', '0', 'Interesados', '', '', 'interesado/listarinteresados', 1, '1', NULL, '1', '1'),
(4, 3, 4, 'Solicitudes Pre-aprobadas', 'S', '0', 'Solicitudes', '', '', 'solicitudinscripcion/listarsolprepapro', 1, '1', NULL, '1', '1'),
(5, 3, 5, 'Solicitudes Pendientes', 'S', '0', 'Solicitudes', '', '', 'solicitudinscripcion/listarsolpendiente', 1, '1', NULL, '1', '1'),
(6, 3, 6, 'Solicitudes', 'S', '0', 'Consulta Solicitudes', '', '', 'solicitudinscripcion/listarsolinteresado', 1, '1', NULL, '1', '1'),
(7, 3, 7, 'Crear Solicitud Inscripción', 'S', '0', 'Solicitud', '', 'nuevo.png', 'solicitudinscripcion/create', 1, '1', NULL, '1', '1'),
(8, 4, 8, 'Listar Pagos', 'S', '0', 'Listar Pagos', '', 'nuevo.png', 'registrarpago/listarpagosolicadm', 1, '1', NULL, '1', '1'),
(9, 4, 9, 'Control Pagos', 'S', '0', 'Control Pagos', '', 'nuevo.png', 'registrarpago/listarpagosolicitud', 2, '1', NULL, '1', '1'),
(10, 4, 10, 'Registrar Pagos por Colecturía', 'S', '0', 'Registrar Pagos por Colecturía', '', 'nuevo.png', 'registrarpago/listarpagosolregadm', 3, '1', NULL, '1', '1'),
(11, 5, 11, 'Asignar Agente', 'S', '0', 'AsignarEjecutivo', '', 'nuevo.png', 'asignacionejecutivo/listarasignacion', 1, '1', NULL, '1', '1'),
(12, 6, 12, 'Aspirantes', 'S', '0', 'ListarAspirantes', '', 'nuevo.png', 'aspirante/listaraspirantes', 1, '1', NULL, '1', '1'),
(13, 3, 13, 'Solicitudes Aprobadas', 'S', '0', 'Solicitudes Aprobadas', '', '', 'solicitudinscripcion/listarsolaprobada', 1, '1', NULL, '1', '1'),
(15, 2, 15, 'Pre-Interesados', 'S', '0', 'Pre-Interesados', '', '', 'interesado/listarpreinteresados', 1, '1', NULL, '1', '1'),
(16, 1, 16, 'Actualización Ficha Datos', 'S', '0', 'Actualización Ficha Datos', '', '', 'ficha/update', 2, '1', NULL, '1', '1'),
(17, 4, 17, 'Pagos Cargados por Estudiante', 'S', '0', 'Pagos Cargados por Estudiante', '', 'nuevo.png', 'registrarpago/listarpagoscargados', 3, '1', NULL, '1', '1'),
(19, 9, 19, 'Período/Curso', 'S', '0', 'Período/Curso', '', 'nuevo.png', 'adminmetodoingreso/creaperiodo', 1, '1', NULL, '1', '1'),
(20, 10, 20, 'Actualizar Perfil', 'S', '0', 'Actualizar Perfil', '', '', 'perfil/update', 1, '1', NULL, '1', '1'),
(21, 11, 21, 'Gestión Admisión', 'S', '0', 'Crear Gestión', '', '', 'gestion/create', 1, '1', NULL, '1', '1'),
(22, 11, 22, 'Gestiones', 'S', '0', 'Gestiones', '', '', 'gestion/listargestion', 2, '1', NULL, '1', '1'),
(23, 8, 23, 'Crear Expediente', 'S', '0', 'Crear Expediente', '', 'nuevo.png', 'expedienteprofesor/create', 1, '1', NULL, '1', '1'),
(24, 8, 24, 'Ver Expediente', 'S', '0', 'Ver Expediente', '', '', 'expedienteprofesor/view', 2, '1', NULL, '1', '1'),
(25, 8, 25, 'Expedientes Registrados', 'S', '0', 'Expedientes Registrados', '', '', 'administracionexpediente/listarexpediente', 3, '1', NULL, '1', '1'),
(26, 12, 26, 'Evaluación Profesor', 'S', '0', 'Evaluar Profesor', '', '', 'evaluacion/evaluar', 1, '1', NULL, '1', '1'),
(27, 12, 27, 'Evaluaciones', 'S', '0', 'Listar Profesor', '', '', 'evaluacion/listaevaluacion', 1, '1', NULL, '1', '1'),
(28, 13, 28, 'Ingreso Marcacion', 'S', '0', 'Ingreso Marcacion', '', '', 'marcacion/ingreso', 1, '1', NULL, '1', '1'),
(29, 14, 29, 'Listar Items', 'S', '0', 'Listar Items', '', '', 'facturacion/listarItem', 1, '1', NULL, '1', '1'),
(30, 9, 30, 'Listar Período CAN Online', 'S', '0', 'Listar Período CAN Online', '', '', 'adminmetodoingreso/listaperiodocan', 1, '1', NULL, '1', '1');
-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `OBMO_ACCI`
--
INSERT INTO `obmo_acci` (`oacc_id`, `omod_id`, `acc_id`, `oacc_tipo_boton`, `oacc_cont_accion`, `oacc_function`, `oacc_estado`, `oacc_estado_logico`) VALUES
(1, 1, 1, '5', NULL, 'guardarA()', '1', '1');

-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `GRUP_OBMO`
--
INSERT INTO `grup_obmo` (`gmod_id`, `gru_id`, `omod_id`, `gmod_estado` , `gmod_estado_logico`) VALUES
(1, 1, 1, '1', '1'),
(2, 1, 2, '1', '1'),
(3, 1, 3, '1', '1'),
(4, 1, 4, '1', '1'),
(5, 1, 5, '1', '1'),
(6, 1, 6, '1', '1'),
(7, 1, 7, '1', '1'),
(8, 1, 8, '1', '1'),
(9, 1, 9, '1', '1'),
(10, 1, 10, '1', '1'),
(11, 1, 11, '1', '1'),
(12, 1, 12, '1', '1'),
(13, 2, 1, '1', '1'),
(14, 3, 6, '1', '1'),
(15, 3, 7, '1', '1'),
(16, 3, 9, '1', '1'),
(17, 4, 6, '1', '1'),
(18, 4, 7, '1', '1'),
(19, 4, 9, '1', '1'),
(20, 8, 3, '1', '1'),
(21, 8, 4, '1', '1'),
(22, 8, 5, '1', '1'),
(23, 8, 11, '1', '1'),
(24, 8, 12, '1', '1'),
(25, 3, 2, '1', '1'),
(26, 4, 2, '1', '1'),
(27, 9, 8, '1', '1'),
(28, 9, 10, '1', '1'),
(29, 11, 1, '0', '1'),
(30, 8, 13, '1', '1'),
(31, 10, 3, '1', '1'),
(32, 10, 12, '1', '1'),
(33, 8, 15, '1', '1'),
(35, 1, 15, '1', '1'),
(36, 10, 12, '1', '1'), 
(37, 3, 16, '1', '1'),
(38, 9, 17, '1', '1'),
(39, 1, 17, '1', '1'),
(40, 1, 19, '1', '1'),
(41, 10, 19, '1', '1'),
(42, 10, 3, '1', '1'),   
(43, 1, 20, '1', '1'),
(44, 6, 20, '1', '1'),
(45, 8, 20, '1', '1'),
(46, 9, 20, '1', '1'),
(47, 10, 20, '1', '1'),
(48, 11, 20, '1', '1'),
(49, 8, 8, '1', '1'),
(50, 8, 10, '1', '1'),
(51, 8, 17, '1', '1'),
(52, 10, 4, '1', '1'),
(53, 10, 5, '1', '1'), 
(54, 10, 11, '1', '1'),
(55, 10, 13, '1', '1'),
(56, 10, 15, '1', '1'),
(57, 1, 21, '1', '1'),
(58, 1, 22, '1', '1'),

(59, 8, 21, '1', '1'), 
(60, 8, 22, '1', '1'),
(61, 10, 21, '1', '1'),
(62, 10, 22, '1', '1'),
(63, 12, 21, '1', '1'),
(64, 12, 22, '1', '1'),
(65, 6, 23, '1', '1'),
(66, 6, 24, '1', '1'),
(67, 13, 25, '1', '1'),
(68, 1, 23, '1', '1'),
(69, 1, 24, '1', '1'),
(70, 1, 25, '1', '1'),
(71, 1, 26, '1', '1'),
(72, 1, 27, '1', '1'),
(73, 12, 26, '1', '1'),
(74, 12, 27, '1', '1'),
(75, 1,  28, '1','1'),
(76, 1,  29, '1','1'),
(77, 6,  28, '1','1'),
(78, 1,  30, '1','1'),
(79, 10,  30, '1','1')
;


-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `GRUP_OBMO_GRUP_ROL`
--
INSERT INTO `grup_obmo_grup_rol` (`gogr_id`, `grol_id`, `gmod_id`, `gogr_estado`, `gogr_estado_logico`) VALUES
(1, 1, 1, '1', '1'),
(2, 1, 2, '1', '1'),
(3, 1, 3, '1', '1'),
(4, 1, 4, '1', '1'),
(5, 1, 5, '1', '1'),
(6, 1, 6, '1', '1'),
(7, 1, 7, '1', '1'),
(8, 1, 8, '1', '1'),
(9, 1, 9, '1', '1'),
(10, 1, 10, '1', '1'),
(11, 1, 11, '1', '1'),
(12, 1, 12, '1', '1'),
(13, 10, 13, '1', '1'),
(14, 11, 14, '1', '1'),
(15, 11, 15, '1', '1'),
(16, 11, 16, '1', '1'),
(17, 12, 17, '1', '1'),
(18, 12, 18, '1', '1'),
(19, 12, 19, '1', '1'),
(20, 5, 20, '1', '1'),
(21, 5, 21, '1', '1'),
(22, 5, 22, '1', '1'),
(23, 5, 23, '1', '1'),
(24, 5, 24, '1', '1'),
(25, 6, 20, '1', '1'),
(26, 6, 21, '1', '1'),
(27, 6, 22, '1', '1'),
(28, 6, 23, '1', '1'),
(29, 6, 24, '1', '1'),
(31, 7, 20, '1', '1'),
(32, 7, 22, '1', '1'),
(33, 7, 23, '1', '1'),
(34, 7, 24, '1', '1'),
(35, 8, 20, '1', '1'),
(36, 8, 22, '1', '1'),
(37, 8, 24, '1', '1'),
(38, 11, 25, '1', '1'),
(39, 12, 25, '1', '1'),
(40, 9, 27, '1', '1'),
(41, 9, 28, '1', '1'),
(42, 13, 29, '0', '1'),
(43, 5, 30, '1', '1'), 
(44, 1, 30, '1', '1'),
(45, 14, 31, '1', '1'),
(46, 14, 32, '1', '1'),
(47, 6, 30, '1', '1'),
(48, 5, 33, '1', '1'),
(49, 6, 33, '1', '1'),
(50, 7, 33, '1', '1'), 
(51, 8, 33, '1', '1'),
(52, 1, 33, '1', '1'),
(53, 15, 36, '1', '1'),
(54, 11, 37, '1', '1'),
(55, 9, 38, '1', '1'),
(56, 1, 39, '1', '1'),
(57, 1, 40, '1', '1'),
(58, 15, 42, '1', '1'),
(59, 1, 43, '1', '1'),
(60, 5, 43, '1', '1'),
(61, 6, 43, '1', '1'),
(62, 7, 43, '1', '1'),
(63, 8, 43, '1', '1'),
(64, 9, 43, '1', '1'),
(65, 13, 43, '1', '1'),
(66, 14, 43, '1', '1'),
(67, 15, 43, '1', '1'),

(68, 5, 49, '1', '1'),
(69, 5, 50, '1', '1'),
(70, 5, 51, '1', '1'),
(71, 15, 52, '1', '1'),
(72, 15, 53, '1', '1'),
(73, 15, 54, '1', '1'),
(74, 15, 55, '1', '1'),
(75, 15, 56, '1', '1'),
(76, 14, 55, '1', '1'),
(77, 14, 56, '1', '1'),
(78, 17, 36, '1', '1'),
(79, 17, 41, '1', '1'),
(80, 17, 52, '1', '1'),
(81, 17, 53, '1', '1'),
(82, 17, 54, '1', '1'),
(83, 17, 55, '1', '1'),
(84, 17, 56, '1', '1'),
(85, 17, 47, '1', '1'),
(86, 1, 57, '1', '1'),
(87, 1, 58, '1', '1'),

(88, 8, 59, '1', '1'),  
(89, 8, 60, '1', '1'),  
(90, 18, 59, '1', '1'),  
(91, 18, 60, '1', '1'),  
(92, 17, 59, '1', '1'),  
(93, 17, 60, '1', '1'),  
(94, 14, 59, '1', '1'),  
(95, 14, 60, '1', '1'),  
(96, 6, 59, '1', '1'),  
(97, 6, 60, '1', '1'),  
(98, 7, 59, '1', '1'),  
(99, 7, 60, '1', '1'),
(100, 19, 65, '1', '1'),
(101, 19, 66, '1', '1'),
(102, 20, 67, '1', '1'),
(103, 1, 65, '1', '1'),
(104, 1, 66, '1', '1'),
(105, 1, 67, '1', '1'),
(106, 1, 71, '1', '1'),
(107, 1, 72, '1', '1'),
(108, 18, 73, '1', '1'),
(109, 18, 74, '1', '1'),
(110, 1, 75, '1', '1'),
(111, 1, 76, '1', '1'),
(112, 1, 77, '1', '1'),
(113, 15, 41, '1', '1'),
(114, 1, 78, '1', '1'),
(115, 15, 79, '1', '1')
;


-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `GRUP_OBMO_GRUP_ROL_OBMO_ACCI`
--
INSERT INTO `grup_obmo_grup_rol_obmo_acci` (`ggoa_id`, `gogr_id`, `oacc_id`, `ggoa_estado`, `ggoa_estado_logico`) VALUES
(1, 1, 1, '1', '1');

-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `TIPO_DISCAPACIDAD`
--
INSERT INTO `tipo_discapacidad` (`tdis_id`,`tdis_nombre`, `tdis_descripcion`,`tdis_estado`,`tdis_estado_logico`) VALUES
(1,'Auditiva','Auditiva','1','1'),
(2,'Física Motora','Física Motora','1','1'),
(3,'Intelectual','Intelectual','1','1'),
(4,'Lenguaje','Lenguaje','1','1'),
(5,'Mental Psicosocial','Mental Psicosocial','1','1'),
(6,'Visual','Visual','1','1');
-- --------------------------------------------------------
--
-- Tabla `tipo_identificacion`
--
INSERT INTO `tipo_identificacion` (`tide_id`, `tide_nombre`, `tide_descripcion`, `tide_numero_caracteres`, `tide_estado`, `tide_estado_logico`) VALUES
(1, 'Cedula', 'Cedula', '10', '1', '1'),
(2, 'RUC', 'RUC', '13', '1','1'),
(3, 'Pasaporte','Pasaporte', NULL, '1', '1');

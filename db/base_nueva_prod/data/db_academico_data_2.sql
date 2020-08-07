--
-- Base de datos: `db_academico`
--
USE `db_academico`;

-- -- ------------------------ ------------------------------
--
-- Volcado de datos para la tabla `semestre`
-- 
INSERT INTO `semestre_academico` (`saca_id`, `saca_nombre`, `saca_descripcion`, `saca_anio`, `saca_fecha_registro`, `saca_usuario_ingreso`, `saca_usuario_modifica`, `saca_estado`, `saca_estado_logico`) VALUES 
(1, 'Abril - Agosto', 'Abril - Agosto', 2019, NULL, '1', '1', '1', '1'),
(2, 'Octubre - Febrero', 'Octubre - Febrero', 2019, NULL, '1', '1', '1', '1'),
(3, 'Abril - Agosto', 'Abril - Agosto', 2017, NULL, '1', '1', '1', '1'),
(4, 'Octubre - Febrero', 'Octubre - Febrero', 2018, NULL, '1', '1', '1', '1'),
(5, 'Abril - Agosto', 'Abril - Agosto', 2018, NULL, '1', '1', '1', '1'),
(6, 'Octubre - Febrero', 'Octubre - Febrero', 2020, NULL, '1', '1', '1', '1');

-- -- ------------------------ ------------------------------
--
-- Volcado de datos para la tabla `bloque`
--
INSERT INTO `bloque_academico` (`baca_id`,`baca_nombre`, `baca_descripcion`, `baca_anio`, `baca_usuario_ingreso`, `baca_estado`, `baca_estado_logico`) VALUES 
(1, 'B1', 'Abril - Junio', 2019, 1, '1', '1'),
(2, 'B2', 'Julio - Agosto', 2019, 1,  '1', '1'),
(3, 'B2', 'Enero - Febrero', 2019, 1, '1', '1'),
(4, 'B1', 'Octubre - Diciembre', 2019, 1, '1', '1');

INSERT INTO db_academico.`bloque_academico` (`baca_id`,`baca_nombre`, `baca_descripcion`, `baca_anio`, `baca_usuario_ingreso`, `baca_estado`, `baca_estado_logico`) VALUES 
(5, 'B1', 'Abril - Junio', 2017, 1, '1', '1'),
(6, 'B1', 'Octubre - Diciembre', 2017, 1, '1', '1'),
(7, 'B1', 'Abril - Junio', 2018, 1, '1', '1'),
(8, 'B1', 'Octubre - Diciembre', 2018, 1, '1', '1');

-- ------------------------ ------------------------------
--
-- Volcado de datos para la tabla `periodo_academico`
--
INSERT INTO `periodo_academico` (`paca_id`, `saca_id`, `baca_id`, `paca_activo`, `paca_fecha_inicio`, `paca_fecha_fin`, `paca_usuario_ingreso`, `paca_usuario_modifica`, `paca_estado`, `paca_fecha_creacion`, `paca_fecha_modificacion`, `paca_estado_logico`) VALUES
(1, 1, 1,  'I', '2019-04-13 04:00:00', '2019-06-30 03:59:59', 1, NULL, '1', '2019-04-11 20:03:41', NULL, '1'),
(2, 1, 2,  'A', '2019-07-08 05:00:00', '2019-09-22 04:59:59', 1, NULL, '1', '2019-07-08 16:00:26', NULL, '1');

INSERT INTO db_academico.`periodo_academico` (`paca_id`, `saca_id`, `baca_id`, `paca_activo`, `paca_fecha_inicio`, `paca_fecha_fin`, `paca_usuario_ingreso`, `paca_usuario_modifica`, `paca_estado`, `paca_fecha_creacion`, `paca_estado_logico`) VALUES
(4, 3, 5,  'I', '2017-04-01 00:00:00', '2017-08-31 23:59:59', 1, NULL, '1', '2019-07-01 08:00:26', '1'),
(5, 4, 6,  'I', '2017-10-01 00:00:00', '2018-02-28 23:59:59', 1, NULL, '1', '2019-07-01 08:00:26', '1'),
(6, 5, 7,  'I', '2018-04-01 00:00:00', '2018-08-31 23:59:59', 1, NULL, '1', '2019-07-01 08:00:26', '1');

-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `dedicacion_docente`
--
INSERT INTO `dedicacion_docente` (`ddoc_id`, `ddoc_nombre`, `ddoc_estado`, `ddoc_fecha_creacion`, `ddoc_fecha_modificacion`, `ddoc_estado_logico`) VALUES
(1, 'Tiempo Completo', '1', '2019-11-18 12:03:06',NULL, '1'),
(2, 'Tiempo Parcial', '1', '2019-11-18 12:036:06',NULL, '1'),
(3, 'Medio Tiempo', '1', '2019-11-18 12:036:06',NULL, '1');

-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `profesor`
--
INSERT INTO `profesor` (`pro_id`, `per_id`, `pro_usuario_ingreso`, `pro_usuario_modifica`, `pro_estado`, `pro_fecha_creacion`, `pro_fecha_modificacion`, `pro_estado_logico`) VALUES
(1, 30, 1, NULL, '1', '2019-04-11 19:51:06', NULL, '1'),
(2, 53, 1, NULL, '1', '2019-04-11 19:51:06', NULL, '1'),
(3, 48, 1, NULL, '1', '2019-04-11 19:51:06', NULL, '1'),
(4, 36, 1, NULL, '1', '2019-04-11 19:51:06', NULL, '1'),
(5, 51, 1, NULL, '1', '2019-04-11 19:51:06', NULL, '1'),
(6, 3, 1, NULL, '1', '2019-04-11 19:51:06', NULL, '1'),
(7, 50, 1, NULL, '1', '2019-04-11 19:51:06', NULL, '1'),
(8, 52, 1, NULL, '1', '2019-04-11 19:51:06', NULL, '1'),
(9, 33, 1, NULL, '1', '2019-04-11 19:51:06', NULL, '1'),
(10, 47, 1, NULL, '1', '2019-04-11 19:51:06', NULL, '1'),
(11, 49, 1, NULL, '1', '2019-04-11 19:51:06', NULL, '1'),
(12, 37, 1, NULL, '1', '2019-04-11 19:51:06', NULL, '1'),
(13, 54, 1, NULL, '1', '2019-04-12 22:15:55', NULL, '1'),
(14, 55, 1, NULL, '1', '2019-04-12 22:15:55', NULL, '1'),
(15, 56, 1, NULL, '1', '2019-04-12 22:15:55', NULL, '1'),
(16, 57, 1, NULL, '1', '2019-04-12 22:15:55', NULL, '1'),
(17, 58, 1, NULL, '1', '2019-04-12 22:15:55', NULL, '1'),
(18, 59, 1, NULL, '1', '2019-04-12 22:15:55', NULL, '1'),
(19, 60, 1, NULL, '1', '2019-04-12 22:15:55', NULL, '1'),
(20, 61, 1, NULL, '1', '2019-04-12 22:15:55', NULL, '1'),
(21, 62, 1, NULL, '1', '2019-04-12 22:15:55', NULL, '1'),
(22, 63, 1, NULL, '1', '2019-04-12 22:15:55', NULL, '1'),
(23, 64, 1, NULL, '1', '2019-04-12 22:15:55', NULL, '1'),
(24, 65, 1, NULL, '1', '2019-04-12 22:15:55', NULL, '1'),
(25, 66, 1, NULL, '1', '2019-04-12 22:15:55', NULL, '1'),
(26, 67, 1, NULL, '1', '2019-04-12 22:15:55', NULL, '1'),
(27, 68, 1, NULL, '1', '2019-04-12 22:15:55', NULL, '1'),
(28, 69, 1, NULL, '1', '2019-04-12 22:15:55', NULL, '1'),
(29, 70, 1, NULL, '1', '2019-04-12 22:15:55', NULL, '1'),
(30, 71, 1, NULL, '1', '2019-04-12 22:15:55', NULL, '1'),
(31, 72, 1, NULL, '1', '2019-04-12 22:15:55', NULL, '1'),
(32, 73, 1, NULL, '1', '2019-04-12 22:15:55', NULL, '1'),
(33, 74, 1, NULL, '1', '2019-04-12 22:15:55', NULL, '1'),
(34, 75, 1, NULL, '1', '2019-04-12 22:15:55', NULL, '1'),
(35, 76, 1, NULL, '1', '2019-04-12 22:15:55', NULL, '1'),
(36, 77, 1, NULL, '1', '2019-04-12 22:15:55', NULL, '1'),
(37, 78, 1, NULL, '1', '2019-04-12 22:15:55', NULL, '1'),
(38, 79, 1, NULL, '1', '2019-04-12 22:15:55', NULL, '1'),
(39, 80, 1, NULL, '1', '2019-04-12 22:15:55', NULL, '1'),
(40, 81, 1, NULL, '1', '2019-04-12 22:15:55', NULL, '1'),
(41, 82, 1, NULL, '1', '2019-04-12 22:15:55', NULL, '1'),
(42, 83, 1, NULL, '1', '2019-04-12 22:15:55', NULL, '1'),
(43, 84, 1, NULL, '1', '2019-04-12 22:15:55', NULL, '1'),
(44, 85, 1, NULL, '1', '2019-04-12 22:15:55', NULL, '1'),
(45, 86, 1, NULL, '1', '2019-04-12 22:15:55', NULL, '1'),
(46, 87, 1, NULL, '1', '2019-04-12 22:15:55', NULL, '1'),
(47, 2, 1, NULL, '1', '2019-04-12 22:15:55', NULL, '1'),
(48, 24, 1, NULL, '1', '2019-04-12 22:15:55', NULL, '1'),
(49, 26, 1, NULL, '1', '2019-04-12 22:15:55', NULL, '1'),
(50, 88, 1, NULL, '1', '2019-04-12 22:15:56', NULL, '1'),
(51, 28, 1, NULL, '1', '2019-04-12 22:15:56', NULL, '1'),
(52, 34, 1, NULL, '1', '2019-04-12 22:15:56', NULL, '1'),
(53, 89, 1, NULL, '1', '2019-04-13 03:10:16', NULL, '1'),
(54, 90, 1, NULL, '1', '2019-04-13 03:10:16', NULL, '1'),
(55, 91, 1, NULL, '1', '2019-04-13 03:10:16', NULL, '1'),
(56, 92, 1, NULL, '1', '2019-04-13 03:10:16', NULL, '1'),
(57, 93, 1, NULL, '1', '2019-04-13 03:10:16', NULL, '1'),
(58, 94, 1, NULL, '1', '2019-04-13 03:10:16', NULL, '1'),
(59, 95, 1, NULL, '1', '2019-04-13 03:10:16', NULL, '1'),
(60, 96, 1, NULL, '1', '2019-04-13 03:10:16', NULL, '1'),
(61, 97, 1, NULL, '1', '2019-04-13 03:10:16', NULL, '1'),
(62, 98, 1, NULL, '1', '2019-04-13 03:10:16', NULL, '1'),
(63, 99, 1, NULL, '1', '2019-04-13 03:10:16', NULL, '1'),
(64, 100, 1, NULL, '1', '2019-04-13 03:10:16', NULL, '1'),
(65, 101, 1, NULL, '1', '2019-04-17 20:15:00', NULL, '1'),
(66, 102, 1, NULL, '1', '2019-04-22 19:05:10', NULL, '1'),
(67, 103, 1, NULL, '1', '2019-04-22 19:05:10', NULL, '1'),
(68, 104, 1, NULL, '1', '2019-04-22 19:05:10', NULL, '1'),
(69, 5, 1, NULL, '1', '2019-04-22 19:05:10', NULL, '1'),
(70, 41, 1, NULL, '1', '2019-04-22 19:05:10', NULL, '1'),
(71, 105, 1, NULL, '1', '2019-04-26 22:05:24', NULL, '1'),
(72, 106, 1, NULL, '1', '2019-04-26 22:05:24', NULL, '1'),
(73, 107, 1, NULL, '1', '2019-04-26 22:05:24', NULL, '1'),
(74, 108, 1, NULL, '1', '2019-04-26 22:05:24', NULL, '1'),
(75, 109, 1, NULL, '1', '2019-04-26 22:05:24', NULL, '1'),
(76, 110, 1, NULL, '1', '2019-04-26 22:05:24', NULL, '1'),
(77, 111, 1, NULL, '1', '2019-05-02 19:08:11', NULL, '1'),
(78, 112, 1, NULL, '1', '2019-05-09 21:55:59', NULL, '1'),
(79, 113, 1, NULL, '1', '2019-05-13 20:04:31', NULL, '1'),
(80, 114, 1, NULL, '1', '2019-05-21 20:26:35', NULL, '1'),
(81, 115, 1, NULL, '1', '2019-07-11 18:04:38', NULL, '1'),
(82, 116, 1, NULL, '1', '2019-07-11 18:04:38', NULL, '1'),
(83, 117, 1, NULL, '1', '2019-07-11 18:04:38', NULL, '1'),
(84, 118, 1, NULL, '1', '2019-07-11 18:04:38', NULL, '1'),
(85, 119, 1, NULL, '1', '2019-07-11 18:04:38', NULL, '1'),
(86, 120, 1, NULL, '1', '2019-07-11 18:04:38', NULL, '1'),
(87, 121, 1, NULL, '1', '2019-07-11 18:04:38', NULL, '1'),
(88, 122, 1, NULL, '1', '2019-07-11 18:04:38', NULL, '1'),
(89, 123, 1, NULL, '1', '2019-07-11 18:04:38', NULL, '1'),
(90, 124, 1, NULL, '1', '2019-07-11 18:04:38', NULL, '1'),
(91, 125, 1, NULL, '1', '2019-07-11 18:04:38', NULL, '1'),
(92, 126, 1, NULL, '1', '2019-07-11 18:04:38', NULL, '1'),
(93, 127, 1, NULL, '1', '2019-07-11 18:04:38', NULL, '1'),
(94, 128, 1, NULL, '1', '2019-07-11 18:04:38', NULL, '1'),
(95, 129, 1, NULL, '1', '2019-07-11 18:04:38', NULL, '1'),
(96, 130, 1, NULL, '1', '2019-07-11 18:04:38', NULL, '1'),
(97, 131, 1, NULL, '1', '2019-07-11 18:04:38', NULL, '1'),
(98, 132, 1, NULL, '1', '2019-07-11 18:04:38', NULL, '1'),
(99, 133, 1, NULL, '1', '2019-07-11 18:04:38', NULL, '1'),
(100, 134, 1, NULL, '1', '2019-07-11 18:04:38', NULL, '1'),
(101, 135, 1, NULL, '1', '2019-07-11 18:04:38', NULL, '1'),
(102, 136, 1, NULL, '1', '2019-07-11 18:04:38', NULL, '1'),
(103, 137, 1, NULL, '1', '2019-07-11 20:32:03', NULL, '1');


INSERT INTO db_academico.malla_academica (`maca_id`,`maca_tipo`,`maca_codigo`,`maca_nombre`,`maca_fecha_vigencia_inicio`,`maca_fecha_vigencia_fin`,`maca_usuario_ingreso`,`maca_estado`,`maca_estado_logico`) VALUES (1,2,'GRA-0001','Ingeniería en Sistemas Computacionales Mención Redes de Comunicaciones - 2009',null,null,1,1,1);
INSERT INTO db_academico.malla_academica (`maca_id`,`maca_tipo`,`maca_codigo`,`maca_nombre`,`maca_fecha_vigencia_inicio`,`maca_fecha_vigencia_fin`,`maca_usuario_ingreso`,`maca_estado`,`maca_estado_logico`) VALUES (2,2,'GRA-0002','Ingeniería en Gestión de Telecomunicaciones Mención Redes de Acceso y Telefonía - 2009',null,null,1,1,1);
INSERT INTO db_academico.malla_academica (`maca_id`,`maca_tipo`,`maca_codigo`,`maca_nombre`,`maca_fecha_vigencia_inicio`,`maca_fecha_vigencia_fin`,`maca_usuario_ingreso`,`maca_estado`,`maca_estado_logico`) VALUES (3,2,'GRA-0003','Ingeniería en Gestión Hotelera y Turística - 2009',null,null,1,1,1);
INSERT INTO db_academico.malla_academica (`maca_id`,`maca_tipo`,`maca_codigo`,`maca_nombre`,`maca_fecha_vigencia_inicio`,`maca_fecha_vigencia_fin`,`maca_usuario_ingreso`,`maca_estado`,`maca_estado_logico`) VALUES (4,2,'GRA-0004','Licenciatura en Gestión Hotelera y Turística - 2009',null,null,1,1,1);
INSERT INTO db_academico.malla_academica (`maca_id`,`maca_tipo`,`maca_codigo`,`maca_nombre`,`maca_fecha_vigencia_inicio`,`maca_fecha_vigencia_fin`,`maca_usuario_ingreso`,`maca_estado`,`maca_estado_logico`) VALUES (5,2,'GRA-0005','Ingeniería en Gestión Empresarial Mención Marketing y Ventas - 2009',null,null,1,1,1);
INSERT INTO db_academico.malla_academica (`maca_id`,`maca_tipo`,`maca_codigo`,`maca_nombre`,`maca_fecha_vigencia_inicio`,`maca_fecha_vigencia_fin`,`maca_usuario_ingreso`,`maca_estado`,`maca_estado_logico`) VALUES (6,2,'GRA-0006','Licenciatura en Gestión Empresarial Mención Marketing y Ventas - 2009',null,null,1,1,1);
INSERT INTO db_academico.malla_academica (`maca_id`,`maca_tipo`,`maca_codigo`,`maca_nombre`,`maca_fecha_vigencia_inicio`,`maca_fecha_vigencia_fin`,`maca_usuario_ingreso`,`maca_estado`,`maca_estado_logico`) VALUES (7,2,'GRA-0007','Ingeniería en Gestión Empresarial Mención Finanzas y Auditoría - 2009',null,null,1,1,1);
INSERT INTO db_academico.malla_academica (`maca_id`,`maca_tipo`,`maca_codigo`,`maca_nombre`,`maca_fecha_vigencia_inicio`,`maca_fecha_vigencia_fin`,`maca_usuario_ingreso`,`maca_estado`,`maca_estado_logico`) VALUES (8,2,'GRA-0008','Licenciatura en Gestión Empresarial Mención Finanzas y Auditoría - 2009',null,null,1,1,1);
INSERT INTO db_academico.malla_academica (`maca_id`,`maca_tipo`,`maca_codigo`,`maca_nombre`,`maca_fecha_vigencia_inicio`,`maca_fecha_vigencia_fin`,`maca_usuario_ingreso`,`maca_estado`,`maca_estado_logico`) VALUES (9,2,'GRA-0009','Ingeniería en Contaduría Pública y Auditoría - 2009',null,null,1,1,1);
INSERT INTO db_academico.malla_academica (`maca_id`,`maca_tipo`,`maca_codigo`,`maca_nombre`,`maca_fecha_vigencia_inicio`,`maca_fecha_vigencia_fin`,`maca_usuario_ingreso`,`maca_estado`,`maca_estado_logico`) VALUES (10,2,'GRA-0010','Licenciatura en Contaduría Pública y Auditoría - 2009',null,null,1,1,1);
INSERT INTO db_academico.malla_academica (`maca_id`,`maca_tipo`,`maca_codigo`,`maca_nombre`,`maca_fecha_vigencia_inicio`,`maca_fecha_vigencia_fin`,`maca_usuario_ingreso`,`maca_estado`,`maca_estado_logico`) VALUES (11,2,'GRA-0011','Ingeniería en Comercio Exterior Mención Negocios Internacionales - 2009',null,null,1,1,1);
INSERT INTO db_academico.malla_academica (`maca_id`,`maca_tipo`,`maca_codigo`,`maca_nombre`,`maca_fecha_vigencia_inicio`,`maca_fecha_vigencia_fin`,`maca_usuario_ingreso`,`maca_estado`,`maca_estado_logico`) VALUES (12,2,'GRA-0012','Licenciatura en Comercio Exterior Mención Negocios Internacionales - 2009',null,null,1,1,1);
INSERT INTO db_academico.malla_academica (`maca_id`,`maca_tipo`,`maca_codigo`,`maca_nombre`,`maca_fecha_vigencia_inicio`,`maca_fecha_vigencia_fin`,`maca_usuario_ingreso`,`maca_estado`,`maca_estado_logico`) VALUES (13,2,'GRA-0013','Ingeniería Portuaria y Aduanera Mención Administración Portuaria - 2009',null,null,1,1,1);
INSERT INTO db_academico.malla_academica (`maca_id`,`maca_tipo`,`maca_codigo`,`maca_nombre`,`maca_fecha_vigencia_inicio`,`maca_fecha_vigencia_fin`,`maca_usuario_ingreso`,`maca_estado`,`maca_estado_logico`) VALUES (14,2,'GRA-0014','Psicología Laboral y Empresarial - 2009',null,null,1,1,1);
INSERT INTO db_academico.malla_academica (`maca_id`,`maca_tipo`,`maca_codigo`,`maca_nombre`,`maca_fecha_vigencia_inicio`,`maca_fecha_vigencia_fin`,`maca_usuario_ingreso`,`maca_estado`,`maca_estado_logico`) VALUES (15,2,'GRA-0015','Ingeniería en Sistemas Computacionales Mención Web y Multimedia - 2009',null,null,1,1,1);


-- INSERT INTO `malla_academica_detalle` (`made_id`,`maca_id`,`asi_id`,`made_semestre`,`uest_id`,`nest_id`,`fmac_id`,`made_codigo_asignatura`, `made_hora`, `made_credito`, `made_usuario_ingreso`,`made_estado`,`made_estado_logico`) VALUES 


INSERT INTO `observaciones_documento_aceptacion` (`odac_id`, `odac_descripcion`, `odac_usuario_ingreso`, `odac_usuario_modifica`, `odac_estado`, `odac_fecha_creacion`, `odac_fecha_modificacion`, `odac_estado_logico`) VALUES
(1, 'Mal formato del documento', 1, NULL, '1', '2019-05-20 02:20:17', NULL, '1'),
(2, 'Documento borroso', 1, NULL, '1', '2019-05-20 02:20:17', NULL, '1'),
(3, 'No es la carta correspondiente', 1, NULL, '1', '2019-05-20 02:20:17', NULL, '1');


INSERT INTO `otro_estudio_academico` (`oeac_id`, `oeac_nombre`, `oeac_descripcion`, `uaca_id`, `mod_id`, `oeac_estado`, `oeac_fecha_creacion`, `oeac_fecha_modificacion`, `oeac_estado_logico`) VALUES
(1, 'Comunicación Social', 'Comunicación Social', 1, 2, '1', '2019-06-05 19:43:11', NULL, '1'),
(2, 'Derecho', 'Derecho', 1, 2, '1', '2019-06-05 19:43:11', NULL, '1'),
(3, 'Párvulos', 'Párvulos', 1, 2, '1', '2019-06-05 19:43:11', NULL, '1'),
(4, 'Psicología Clínica', 'Psicología Clínica', 1, 2, '1', '2019-06-05 19:43:11', NULL, '1'),
(5, 'Ingeniería Civil', 'Ingeniería Civil', 1, 2, '1', '2019-06-05 19:43:11', NULL, '1'),
(6, 'Trabajo Social', 'Trabajo Social', 1, 2, '1', '2019-06-05 19:43:11', NULL, '1'),
(7, 'Ingeniería Automotriz', 'Ingeniería Automotriz', 1, 2, '1', '2019-06-05 19:43:11', NULL, '1'),
(8, 'Párvulos', 'Párvulos', 1, 4, '1', '2019-06-05 19:43:11', NULL, '1'),
(9, 'Puertos y Aduanas', 'Puertos y Aduanas', 1, 4, '1', '2019-06-05 19:43:11', NULL, '1'),
(10, 'Logística y Transporte', 'Logística y Transporte', 1, 4, '1', '2019-06-05 19:43:11', NULL, '1'),
(11, 'Software', 'Software', 1, 4, '1', '2019-06-05 19:43:11', NULL, '1'),
(12, 'Telecomunicaciones', 'Telecomunicaciones', 1, 4, '1', '2019-06-05 19:43:11', NULL, '1'),
(13, 'Gestión del Talento Humano', 'Gestión del Talento Humano', 1, 1, '1', '2019-06-05 19:43:11', NULL, '1'),
(14, 'Logística y Transporte', 'Logística y Transporte', 1, 1, '1', '2019-06-05 19:43:11', NULL, '1'),
(15, 'Software', 'Software', 1, 1, '1', '2019-06-05 19:43:11', NULL, '1'),
(16, 'Telecomunicaciones', 'Telecomunicaciones', 1, 1, '1', '2019-06-05 19:43:11', NULL, '1'),
(17, 'Maestría en Educación', 'Maestría en Educación', 2, 1, '1', '2019-06-05 19:43:11', NULL, '1'),
(18, 'Maestría en Abogacía', 'Maestría en Abogacía', 2, 1, '1', '2019-06-05 19:43:11', NULL, '1'),
(19, 'Maestría en Psicopedagogía', 'Maestría en Psicopedagogía', 2, 1, '1', '2019-06-05 19:43:11', NULL, '1'),
(20, 'Maestría en Dirección de Operaciones y Calidad', 'Maestría en Dirección de Operaciones y Calidad', 2, 1, '1', '2019-06-05 19:43:11', NULL, '1'),
(21, 'Maestría Psicología Clínica', 'Maestría Psicología Clínica', 2, 1, '1', '2019-06-05 19:43:11', NULL, '1'),
(22, 'Maestría en Dirección de Proyectos', 'Maestría en Dirección de Proyectos', 2, 1, '1', '2019-06-05 19:43:11', NULL, '1'),
(23, 'Maestría en Lenguas Extranjeras', 'Maestría en Lenguas Extranjeras', 2, 1, '1', '2019-06-05 19:43:11', NULL, '1'),
(24, 'Maestría de Medicina General', 'Maestría de Medicina General', 2, 1, '1', '2019-06-05 19:43:11', NULL, '1');


INSERT INTO db_academico.malla_unidad_modalidad (`mumo_id`,`maca_id`,`meun_id`,`mumo_estado`,`mumo_estado_logico`) VALUES (1,1,66,1,1);
INSERT INTO db_academico.malla_unidad_modalidad (`mumo_id`,`maca_id`,`meun_id`,`mumo_estado`,`mumo_estado_logico`) VALUES (2,2,67,1,1);
INSERT INTO db_academico.malla_unidad_modalidad (`mumo_id`,`maca_id`,`meun_id`,`mumo_estado`,`mumo_estado_logico`) VALUES (3,3,68,1,1);
INSERT INTO db_academico.malla_unidad_modalidad (`mumo_id`,`maca_id`,`meun_id`,`mumo_estado`,`mumo_estado_logico`) VALUES (4,4,69,1,1);
INSERT INTO db_academico.malla_unidad_modalidad (`mumo_id`,`maca_id`,`meun_id`,`mumo_estado`,`mumo_estado_logico`) VALUES (5,5,70,1,1);
INSERT INTO db_academico.malla_unidad_modalidad (`mumo_id`,`maca_id`,`meun_id`,`mumo_estado`,`mumo_estado_logico`) VALUES (6,5,44,1,1);
INSERT INTO db_academico.malla_unidad_modalidad (`mumo_id`,`maca_id`,`meun_id`,`mumo_estado`,`mumo_estado_logico`) VALUES (7,6,55,1,1);
INSERT INTO db_academico.malla_unidad_modalidad (`mumo_id`,`maca_id`,`meun_id`,`mumo_estado`,`mumo_estado_logico`) VALUES (8,6,49,1,1);
INSERT INTO db_academico.malla_unidad_modalidad (`mumo_id`,`maca_id`,`meun_id`,`mumo_estado`,`mumo_estado_logico`) VALUES (9,7,71,1,1);
INSERT INTO db_academico.malla_unidad_modalidad (`mumo_id`,`maca_id`,`meun_id`,`mumo_estado`,`mumo_estado_logico`) VALUES (10,7,43,1,1);
INSERT INTO db_academico.malla_unidad_modalidad (`mumo_id`,`maca_id`,`meun_id`,`mumo_estado`,`mumo_estado_logico`) VALUES (11,8,72,1,1);
INSERT INTO db_academico.malla_unidad_modalidad (`mumo_id`,`maca_id`,`meun_id`,`mumo_estado`,`mumo_estado_logico`) VALUES (12,8,50,1,1);
INSERT INTO db_academico.malla_unidad_modalidad (`mumo_id`,`maca_id`,`meun_id`,`mumo_estado`,`mumo_estado_logico`) VALUES (13,9,53,1,1);
INSERT INTO db_academico.malla_unidad_modalidad (`mumo_id`,`maca_id`,`meun_id`,`mumo_estado`,`mumo_estado_logico`) VALUES (14,9,42,1,1);
INSERT INTO db_academico.malla_unidad_modalidad (`mumo_id`,`maca_id`,`meun_id`,`mumo_estado`,`mumo_estado_logico`) VALUES (15,10,73,1,1);
INSERT INTO db_academico.malla_unidad_modalidad (`mumo_id`,`maca_id`,`meun_id`,`mumo_estado`,`mumo_estado_logico`) VALUES (16,10,48,1,1);
INSERT INTO db_academico.malla_unidad_modalidad (`mumo_id`,`maca_id`,`meun_id`,`mumo_estado`,`mumo_estado_logico`) VALUES (17,11,74,1,1);
INSERT INTO db_academico.malla_unidad_modalidad (`mumo_id`,`maca_id`,`meun_id`,`mumo_estado`,`mumo_estado_logico`) VALUES (18,11,41,1,1);
INSERT INTO db_academico.malla_unidad_modalidad (`mumo_id`,`maca_id`,`meun_id`,`mumo_estado`,`mumo_estado_logico`) VALUES (19,12,75,1,1);
INSERT INTO db_academico.malla_unidad_modalidad (`mumo_id`,`maca_id`,`meun_id`,`mumo_estado`,`mumo_estado_logico`) VALUES (20,12,47,1,1);
INSERT INTO db_academico.malla_unidad_modalidad (`mumo_id`,`maca_id`,`meun_id`,`mumo_estado`,`mumo_estado_logico`) VALUES (21,13,52,1,1);
INSERT INTO db_academico.malla_unidad_modalidad (`mumo_id`,`maca_id`,`meun_id`,`mumo_estado`,`mumo_estado_logico`) VALUES (22,14,51,1,1);
INSERT INTO db_academico.malla_unidad_modalidad (`mumo_id`,`maca_id`,`meun_id`,`mumo_estado`,`mumo_estado_logico`) VALUES (23,15,45,1,1);

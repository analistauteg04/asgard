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

-- ------------------------ ------------------------------
--
-- Volcado de datos para la tabla `periodo_academico`
--
INSERT INTO `periodo_academico` (`paca_id`, `saca_id`, `baca_id`, `paca_activo`, `paca_fecha_inicio`, `paca_fecha_fin`, `paca_usuario_ingreso`, `paca_usuario_modifica`, `paca_estado`, `paca_fecha_creacion`, `paca_fecha_modificacion`, `paca_estado_logico`) VALUES
(1, 1, 1,  'I', '2019-04-13 04:00:00', '2019-06-30 03:59:59', 1, NULL, '1', '2019-04-11 20:03:41', NULL, '1'),
(2, 1, 2,  'A', '2019-07-08 05:00:00', '2019-09-22 04:59:59', 1, NULL, '1', '2019-07-08 16:00:26', NULL, '1');

-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `dedicacion_docente`
--
INSERT INTO `dedicacion_docente` (`ddoc_id`, `ddoc_nombre`, `ddoc_estado`, `ddoc_fecha_creacion`, `ddoc_fecha_modificacion`, `ddoc_estado_logico`) VALUES
(1, 'Tiempo Completo', '1', '2019-11-18 12:03:06',NULL, '1'),
(2, 'Timepo Parcial', '1', '2019-11-18 12:036:06',NULL, '1');

-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `profesor`
--
INSERT INTO `profesor` (`pro_id`, `per_id`, `ddoc_id`, `pro_declarado`, `pro_usuario_ingreso`, `pro_usuario_modifica`, `pro_estado`, `pro_fecha_creacion`, `pro_fecha_modificacion`, `pro_estado_logico`) VALUES
(1, 30, 1, 'S', 1, NULL, '1', '2019-04-11 19:51:06', NULL, '1'),
(2, 53, 1, 'S', 1, NULL, '1', '2019-04-11 19:51:06', NULL, '1'),
(3, 48, 1, 'S', 1, NULL, '1', '2019-04-11 19:51:06', NULL, '1'),
(4, 36, 1, 'S', 1, NULL, '1', '2019-04-11 19:51:06', NULL, '1'),
(5, 51, 1, 'S', 1, NULL, '1', '2019-04-11 19:51:06', NULL, '1'),
(6, 3, 1, 'S', 1, NULL, '1', '2019-04-11 19:51:06', NULL, '1'),
(7, 50, 1, 'S', 1, NULL, '1', '2019-04-11 19:51:06', NULL, '1'),
(8, 52, 1, 'S', 1, NULL, '1', '2019-04-11 19:51:06', NULL, '1'),
(9, 33, 1, 'S', 1, NULL, '1', '2019-04-11 19:51:06', NULL, '1'),
(10, 47, 1, 'S', 1, NULL, '1', '2019-04-11 19:51:06', NULL, '1'),
(11, 49, 1, 'S', 1, NULL, '1', '2019-04-11 19:51:06', NULL, '1'),
(12, 37, 1, 'S', 1, NULL, '1', '2019-04-11 19:51:06', NULL, '1'),
(13, 54, 1, 'S', 1, NULL, '1', '2019-04-12 22:15:55', NULL, '1'),
(14, 55, 1, 'S', 1, NULL, '1', '2019-04-12 22:15:55', NULL, '1'),
(15, 56, 1, 'S', 1, NULL, '1', '2019-04-12 22:15:55', NULL, '1'),
(16, 57, 1, 'S', 1, NULL, '1', '2019-04-12 22:15:55', NULL, '1'),
(17, 58, 1, 'S', 1, NULL, '1', '2019-04-12 22:15:55', NULL, '1'),
(18, 59, 1, 'S', 1, NULL, '1', '2019-04-12 22:15:55', NULL, '1'),
(19, 60, 1, 'S', 1, NULL, '1', '2019-04-12 22:15:55', NULL, '1'),
(20, 61, 1, 'S', 1, NULL, '1', '2019-04-12 22:15:55', NULL, '1'),
(21, 62, 1, 'S', 1, NULL, '1', '2019-04-12 22:15:55', NULL, '1'),
(22, 63, 1, 'S', 1, NULL, '1', '2019-04-12 22:15:55', NULL, '1'),
(23, 64, 1, 'S', 1, NULL, '1', '2019-04-12 22:15:55', NULL, '1'),
(24, 65, 1, 'S', 1, NULL, '1', '2019-04-12 22:15:55', NULL, '1'),
(25, 66, 1, 'S', 1, NULL, '1', '2019-04-12 22:15:55', NULL, '1'),
(26, 67, 1, 'S', 1, NULL, '1', '2019-04-12 22:15:55', NULL, '1'),
(27, 68, 1, 'S', 1, NULL, '1', '2019-04-12 22:15:55', NULL, '1'),
(28, 69, 1, 'S', 1, NULL, '1', '2019-04-12 22:15:55', NULL, '1'),
(29, 70, 1, 'S', 1, NULL, '1', '2019-04-12 22:15:55', NULL, '1'),
(30, 71, 1, 'S', 1, NULL, '1', '2019-04-12 22:15:55', NULL, '1'),
(31, 72, 1, 'S', 1, NULL, '1', '2019-04-12 22:15:55', NULL, '1'),
(32, 73, 1, 'S', 1, NULL, '1', '2019-04-12 22:15:55', NULL, '1'),
(33, 74, 1, 'S', 1, NULL, '1', '2019-04-12 22:15:55', NULL, '1'),
(34, 75, 1, 'S', 1, NULL, '1', '2019-04-12 22:15:55', NULL, '1'),
(35, 76, 1, 'S', 1, NULL, '1', '2019-04-12 22:15:55', NULL, '1'),
(36, 77, 1, 'S', 1, NULL, '1', '2019-04-12 22:15:55', NULL, '1'),
(37, 78, 1, 'S', 1, NULL, '1', '2019-04-12 22:15:55', NULL, '1'),
(38, 79, 1, 'S', 1, NULL, '1', '2019-04-12 22:15:55', NULL, '1'),
(39, 80, 1, 'S', 1, NULL, '1', '2019-04-12 22:15:55', NULL, '1'),
(40, 81, 1, 'S', 1, NULL, '1', '2019-04-12 22:15:55', NULL, '1'),
(41, 82, 1, 'S', 1, NULL, '1', '2019-04-12 22:15:55', NULL, '1'),
(42, 83, 1, 'S', 1, NULL, '1', '2019-04-12 22:15:55', NULL, '1'),
(43, 84, 1, 'S', 1, NULL, '1', '2019-04-12 22:15:55', NULL, '1'),
(44, 85, 1, 'S', 1, NULL, '1', '2019-04-12 22:15:55', NULL, '1'),
(45, 86, 1, 'S', 1, NULL, '1', '2019-04-12 22:15:55', NULL, '1'),
(46, 87, 1, 'S', 1, NULL, '1', '2019-04-12 22:15:55', NULL, '1'),
(47, 2, 1, 'S', 1, NULL, '1', '2019-04-12 22:15:55', NULL, '1'),
(48, 24, 1, 'S', 1, NULL, '1', '2019-04-12 22:15:55', NULL, '1'),
(49, 26, 1, 'S', 1, NULL, '1', '2019-04-12 22:15:55', NULL, '1'),
(50, 88, 1, 'S', 1, NULL, '1', '2019-04-12 22:15:56', NULL, '1'),
(51, 28, 1, 'S', 1, NULL, '1', '2019-04-12 22:15:56', NULL, '1'),
(52, 34, 1, 'S', 1, NULL, '1', '2019-04-12 22:15:56', NULL, '1'),
(53, 89, 1, 'S', 1, NULL, '1', '2019-04-13 03:10:16', NULL, '1'),
(54, 90, 1, 'S', 1, NULL, '1', '2019-04-13 03:10:16', NULL, '1'),
(55, 91, 1, 'S', 1, NULL, '1', '2019-04-13 03:10:16', NULL, '1'),
(56, 92, 1, 'S', 1, NULL, '1', '2019-04-13 03:10:16', NULL, '1'),
(57, 93, 1, 'S', 1, NULL, '1', '2019-04-13 03:10:16', NULL, '1'),
(58, 94, 1, 'S', 1, NULL, '1', '2019-04-13 03:10:16', NULL, '1'),
(59, 95, 1, 'S', 1, NULL, '1', '2019-04-13 03:10:16', NULL, '1'),
(60, 96, 1, 'S', 1, NULL, '1', '2019-04-13 03:10:16', NULL, '1'),
(61, 97, 1, 'S', 1, NULL, '1', '2019-04-13 03:10:16', NULL, '1'),
(62, 98, 1, 'S', 1, NULL, '1', '2019-04-13 03:10:16', NULL, '1'),
(63, 99, 1, 'S', 1, NULL, '1', '2019-04-13 03:10:16', NULL, '1'),
(64, 100, 1, 'S', 1, NULL, '1', '2019-04-13 03:10:16', NULL, '1'),
(65, 101, 1, 'S', 1, NULL, '1', '2019-04-17 20:15:00', NULL, '1'),
(66, 102, 1, 'S', 1, NULL, '1', '2019-04-22 19:05:10', NULL, '1'),
(67, 103, 1, 'S', 1, NULL, '1', '2019-04-22 19:05:10', NULL, '1'),
(68, 104, 1, 'S', 1, NULL, '1', '2019-04-22 19:05:10', NULL, '1'),
(69, 5, 1, 'S', 1, NULL, '1', '2019-04-22 19:05:10', NULL, '1'),
(70, 41, 1, 'S', 1, NULL, '1', '2019-04-22 19:05:10', NULL, '1'),
(71, 105, 1, 'S', 1, NULL, '1', '2019-04-26 22:05:24', NULL, '1'),
(72, 106, 1, 'S', 1, NULL, '1', '2019-04-26 22:05:24', NULL, '1'),
(73, 107, 1, 'S', 1, NULL, '1', '2019-04-26 22:05:24', NULL, '1'),
(74, 108, 1, 'S', 1, NULL, '1', '2019-04-26 22:05:24', NULL, '1'),
(75, 109, 1, 'S', 1, NULL, '1', '2019-04-26 22:05:24', NULL, '1'),
(76, 110, 1, 'S', 1, NULL, '1', '2019-04-26 22:05:24', NULL, '1'),
(77, 111, 1, 'S', 1, NULL, '1', '2019-05-02 19:08:11', NULL, '1'),
(78, 112, 1, 'S', 1, NULL, '1', '2019-05-09 21:55:59', NULL, '1'),
(79, 113, 1, 'S', 1, NULL, '1', '2019-05-13 20:04:31', NULL, '1'),
(80, 114, 1, 'S', 1, NULL, '1', '2019-05-21 20:26:35', NULL, '1'),
(81, 115, 1, 'S', 1, NULL, '1', '2019-07-11 18:04:38', NULL, '1'),
(82, 116, 1, 'S', 1, NULL, '1', '2019-07-11 18:04:38', NULL, '1'),
(83, 117, 1, 'S', 1, NULL, '1', '2019-07-11 18:04:38', NULL, '1'),
(84, 118, 1, 'S', 1, NULL, '1', '2019-07-11 18:04:38', NULL, '1'),
(85, 119, 1, 'S', 1, NULL, '1', '2019-07-11 18:04:38', NULL, '1'),
(86, 120, 1, 'S', 1, NULL, '1', '2019-07-11 18:04:38', NULL, '1'),
(87, 121, 1, 'S', 1, NULL, '1', '2019-07-11 18:04:38', NULL, '1'),
(88, 122, 1, 'S', 1, NULL, '1', '2019-07-11 18:04:38', NULL, '1'),
(89, 123, 1, 'S', 1, NULL, '1', '2019-07-11 18:04:38', NULL, '1'),
(90, 124, 1, 'S', 1, NULL, '1', '2019-07-11 18:04:38', NULL, '1'),
(91, 125, 1, 'S',1, NULL, '1', '2019-07-11 18:04:38', NULL, '1'),
(92, 126, 1, 'S',1, NULL, '1', '2019-07-11 18:04:38', NULL, '1'),
(93, 127, 1, 'S',1, NULL, '1', '2019-07-11 18:04:38', NULL, '1'),
(94, 128, 1, 'S',1, NULL, '1', '2019-07-11 18:04:38', NULL, '1'),
(95, 129, 1, 'S',1, NULL, '1', '2019-07-11 18:04:38', NULL, '1'),
(96, 130, 1, 'S',1, NULL, '1', '2019-07-11 18:04:38', NULL, '1'),
(97, 131, 1, 'S',1, NULL, '1', '2019-07-11 18:04:38', NULL, '1'),
(98, 132, 1, 'S',1, NULL, '1', '2019-07-11 18:04:38', NULL, '1'),
(99, 133, 1, 'S',1, NULL, '1', '2019-07-11 18:04:38', NULL, '1'),
(100, 134, 1, 'S',1, NULL, '1', '2019-07-11 18:04:38', NULL, '1'),
(101, 135, 1, 'S',1, NULL, '1', '2019-07-11 18:04:38', NULL, '1'),
(102, 136, 1, 'S',1, NULL, '1', '2019-07-11 18:04:38', NULL, '1'),
(103, 137, 1, 'S',1, NULL, '1', '2019-07-11 20:32:03', NULL, '1');


INSERT INTO `malla_academica` (`maca_id`,`meun_id`, `maca_tipo`, `maca_nombre`,`maca_fecha_vigencia_inicio`,`maca_fecha_vigencia_fin`,`maca_usuario_ingreso`,`maca_estado`,`maca_estado_logico`) VALUES 
-- Online 
(1,1,'1','Curso de Admisión y Nivelación - Licenciatura en Comercio Exterior - Online','2018-07-01','2018-09-30',1,1,1),
(2,2,'1','Curso de Admisión y Nivelación - Economía - Online','2018-07-01','2018-09-30',1,1,1),
(3,3,'1','Curso de Admisión y Nivelación - Licenciatura en Finanzas - Online','2018-07-01','2018-09-30',1,1,1),
(4,4,'1','Curso de Admisión y Nivelación - Licenciatura en Mercadotecnia - Online','2018-07-01','2018-09-30',1,1,1),
(5,5,'1','Curso de Admisión y Nivelación - Licenciatura en Turismo - Online','2018-07-01','2018-09-30',1,1,1),
(6,6,'1','Curso de Admisión y Nivelación - Licenciatura en Administración de Empresas - Online','2018-07-01','2018-09-30',1,1,1),

-- Presencial
(7,7,'1','Curso de Admisión y Nivelación - Ingenieria en Logística y Transporte - Presencial','2018-07-01','2018-09-30',1,1,1),
(8,8,'1','Curso de Admisión y Nivelación - Ingenieria en Telecomunicaciones - Presencial' ,'2018-07-01','2018-09-30',1,1,1),
(9,9,'1','Curso de Admisión y Nivelación - Ingenieria en Software - Presencial','2018-07-01','2018-09-30',1,1,1),
(10,10,'1','Curso de Admisión y Nivelación - Ingenieria en Tecnologias de la Información - Presencial','2018-07-01','2018-09-30',1,1,1),
(11,11,'1','Curso de Admisión y Nivelación - Licenciatura en Comercio Exterior - Presencial','2018-07-01','2018-09-30',1,1,1),
(12,12,'1','Curso de Admisión y Nivelación - Licenciatura en Turismo - Presencial','2018-07-01','2018-09-30',1,1,1),
(13,13,'1','Curso de Admisión y Nivelación - Licenciatura en Finanzas - Presencials','2018-07-01','2018-09-30',1,1,1),
(14,14,'1','Curso de Admisión y Nivelación - Licenciatura en Contabilidad y Auditoria - Presencial','2018-07-01','2018-09-30',1,1,1),
(15,15,'1','Curso de Admisión y Nivelación - Licenciatura en Gestión y Talento Humano - Presencial','2018-07-01','2018-09-30',1,1,1),
(16,16,'1','Curso de Admisión y Nivelación - Licenciatura en Administracion de Empresas - Presencial','2018-07-01','2018-09-30',1,1,1),
(17,17,'1','Curso de Admisión y Nivelación - Licenciatura en Mercadotecnia - Presencial','2018-07-01','2018-09-30',1,1,1),
(18,18,'1','Curso de Admisión y Nivelación - Licenciatura en Administración Portuaria y Aduanera - Presencial','2018-07-01','2018-09-30',1,1,1),
(19,19,'1','Curso de Admisión y Nivelación - Economía - Presencial','2018-07-01','2018-09-30',1,1,1),

-- Semi-Presencial
(20,20,'1','Curso de Admisión y Nivelación - Licenciatura en Comunicación - Semi-Presencial','2018-07-01','2018-09-30',1,1,1),

-- Distancia
(21,21,'1','Curso de Admisión y Nivelación - Licenciatura en Comercio Exterior - Distancia','2018-07-01','2018-09-30',1,1,1),
(22,22,'1','Curso de Admisión y Nivelación - Licenciatura en Finanzas - Distancia','2018-07-01','2018-09-30',1,1,1),
(23,23,'1','Curso de Admisión y Nivelación - Licenciatura en Contabilidad y Auditoria - Ditancia','2018-07-01','2018-09-30',1,1,1),
(24,24,'1','Curso de Admisión y Nivelación - Licenciatura en Gestión y Talento Humano - Distancia','2018-07-01','2018-09-30',1,1,1),
(25,25,'1','Curso de Admisión y Nivelación - Licenciatura en Administración de Empresas - Distancia','2018-07-01','2018-09-30',1,1,1),
(26,26,'1','Curso de Admisión y Nivelación - Licenciatura en Mercadotecnia - DIstancia','2018-07-01','2018-09-30',1,1,1);



INSERT INTO `malla_academica_detalle` (`made_id`,`maca_id`,`asi_id`,`uest_id`,`nest_id`,`fmac_id`,`made_codigo_asignatura`, `made_hora`, `made_credito`, `made_usuario_ingreso`,`made_estado`,`made_estado_logico`) VALUES 
-- -----------------------
-- Comercio Exterior - online
-- -----------------------
(1,1,1,1,1,6,'',null,null,1,1,1),
(2,1,2,1,1,6,'',null,null,1,1,1),
(3,1,3,1,1,6,'',null,null,1,1,1),
(4,1,4,1,1,6,'',null,null,1,1,1),
(5,1,5,1,1,6,'',null,null,1,1,1),
-- -----------------------
-- Economía - online
-- -----------------------
(6,2,1,1,1,6,'',null,null,1,1,1),
(7,2,2,1,1,6,'',null,null,1,1,1),
(8,2,3,1,1,6,'',null,null,1,1,1),
(9,2,4,1,1,6,'',null,null,1,1,1),
(10,2,5,1,1,6,'',null,null,1,1,1),
-- -----------------------
-- Licenciatura en Finanzas - online
-- -----------------------
(11,3,1,1,1,6,'',null,null,1,1,1),
(12,3,2,1,1,6,'',null,null,1,1,1),
(13,3,3,1,1,6,'',null,null,1,1,1),
(14,3,4,1,1,6,'',null,null,1,1,1),
(15,3,5,1,1,6,'',null,null,1,1,1),
-- -----------------------
-- Licenciatura en Mercadotecnia - online
-- -----------------------
(16,4,1,1,1,6,'',null,null,1,1,1),
(17,4,2,1,1,6,'',null,null,1,1,1),
(18,4,3,1,1,6,'',null,null,1,1,1),
(19,4,4,1,1,6,'',null,null,1,1,1),
(20,4,5,1,1,6,'',null,null,1,1,1),
-- -----------------------
-- Licenciatura en Turismo - online
-- -----------------------
(21,5,1,1,1,6,'',null,null,1,1,1),
(22,5,2,1,1,6,'',null,null,1,1,1),
(23,5,3,1,1,6,'',null,null,1,1,1),
(24,5,4,1,1,6,'',null,null,1,1,1),
(25,5,5,1,1,6,'',null,null,1,1,1),
-- -----------------------
-- Licenciatura en Administración de Empresas - online
-- -----------------------
(26,6,1,1,1,6,'',null,null,1,1,1),
(27,6,2,1,1,6,'',null,null,1,1,1),
(28,6,3,1,1,6,'',null,null,1,1,1),
(29,6,4,1,1,6,'',null,null,1,1,1),
(30,6,5,1,1,6,'',null,null,1,1,1),
-- -----------------------
-- Ingenieria en Logística y Transporte - presencial
-- -----------------------
(31,7,1,1,1,6,'',null,null,1,1,1),
(32,7,6,1,1,6,'',null,null,1,1,1),
(33,7,3,1,1,6,'',null,null,1,1,1),
(34,7,4,1,1,6,'',null,null,1,1,1),
(35,7,5,1,1,6,'',null,null,1,1,1),
-- ----------------------
-- Ingenieria en Telecomunicaciones - presencial
-- -----------------------
(36,8,1,1,1,6,'',null,null,1,1,1),
(37,8,6,1,1,6,'',null,null,1,1,1),
(38,8,3,1,1,6,'',null,null,1,1,1),
(39,8,4,1,1,6,'',null,null,1,1,1),
(40,8,5,1,1,6,'',null,null,1,1,1),
-- ----------------------
-- Ingenieria en Software - presencial
-- -----------------------
(41,9,1,1,1,6,'',null,null,1,1,1),
(42,9,6,1,1,6,'',null,null,1,1,1),
(43,9,3,1,1,6,'',null,null,1,1,1),
(44,9,4,1,1,6,'',null,null,1,1,1),
(45,9,5,1,1,6,'',null,null,1,1,1),
-- ----------------------
-- Ingenieria en Tecnologias de la Información - presencial
-- -----------------------
(46,10,1,1,1,6,'',null,null,1,1,1),
(47,10,6,1,1,6,'',null,null,1,1,1),
(48,10,3,1,1,6,'',null,null,1,1,1),
(49,10,4,1,1,6,'',null,null,1,1,1),
(50,10,5,1,1,6,'',null,null,1,1,1),
-- ----------------------
-- Licenciatura en Comercio Exterior - presencial
-- -----------------------
(51,11,1,1,1,6,'',null,null,1,1,1),
(52,11,2,1,1,6,'',null,null,1,1,1),
(53,11,3,1,1,6,'',null,null,1,1,1),
(54,11,4,1,1,6,'',null,null,1,1,1),
(55,11,5,1,1,6,'',null,null,1,1,1),
-- ----------------------
-- Licenciatura en Turismo - presencial
-- -----------------------
(56,12,1,1,1,6,'',null,null,1,1,1),
(57,12,2,1,1,6,'',null,null,1,1,1),
(58,12,3,1,1,6,'',null,null,1,1,1),
(59,12,4,1,1,6,'',null,null,1,1,1),
(60,12,5,1,1,6,'',null,null,1,1,1),
-- ----------------------
-- Licenciatura en Finanzas - presencial
-- -----------------------
(61,13,1,1,1,6,'',null,null,1,1,1),
(62,13,2,1,1,6,'',null,null,1,1,1),
(63,13,3,1,1,6,'',null,null,1,1,1),
(64,13,4,1,1,6,'',null,null,1,1,1),
(65,13,5,1,1,6,'',null,null,1,1,1),
-- ----------------------
-- Licenciatura en Contabilidad y Auditoria - presencial
-- -----------------------
(66,14,1,1,1,6,'',null,null,1,1,1),
(67,14,2,1,1,6,'',null,null,1,1,1),
(68,14,3,1,1,6,'',null,null,1,1,1),
(69,14,4,1,1,6,'',null,null,1,1,1),
(70,14,5,1,1,6,'',null,null,1,1,1),
-- ----------------------
-- Licenciatura en Gestión y Talento Humano - presencial
-- -----------------------
(71,15,1,1,1,6,'',null,null,1,1,1),
(72,15,2,1,1,6,'',null,null,1,1,1),
(73,15,3,1,1,6,'',null,null,1,1,1),
(74,15,4,1,1,6,'',null,null,1,1,1),
(75,15,5,1,1,6,'',null,null,1,1,1),
-- ----------------------
-- Licenciatura en Administración de Empresas - presencial
-- -----------------------
(76,16,1,1,1,6,'',null,null,1,1,1),
(77,16,2,1,1,6,'',null,null,1,1,1),
(78,16,3,1,1,6,'',null,null,1,1,1),
(79,16,4,1,1,6,'',null,null,1,1,1),
(80,16,5,1,1,6,'',null,null,1,1,1),
-- ----------------------
-- Licenciatura en Mercadotecnia - presencial
-- -----------------------
(81,17,1,1,1,6,'',null,null,1,1,1),
(82,17,2,1,1,6,'',null,null,1,1,1),
(83,17,3,1,1,6,'',null,null,1,1,1),
(84,17,4,1,1,6,'',null,null,1,1,1),
(85,17,5,1,1,6,'',null,null,1,1,1),
-- ----------------------
-- Licenciatura en Administración Portuaria y Aduanera - presencial
-- -----------------------
(86,18,1,1,1,6,'',null,null,1,1,1),
(87,18,2,1,1,6,'',null,null,1,1,1),
(88,18,3,1,1,6,'',null,null,1,1,1),
(89,18,4,1,1,6,'',null,null,1,1,1),
(90,18,5,1,1,6,'',null,null,1,1,1),
-- ----------------------
-- Licenciatura en Administración Portuaria y Aduanera - presencial
-- -----------------------
(91,19,1,1,1,6,'',null,null,1,1,1),
(92,19,2,1,1,6,'',null,null,1,1,1),
(93,19,3,1,1,6,'',null,null,1,1,1),
(94,19,4,1,1,6,'',null,null,1,1,1),
(95,19,5,1,1,6,'',null,null,1,1,1),
-- ----------------------
-- Licenciatura en Comunicación - semipresencial
-- -----------------------
(96,20,1,1,1,6,'',null,null,1,1,1),
(97,20,2,1,1,6,'',null,null,1,1,1),
(98,20,3,1,1,6,'',null,null,1,1,1),
(99,20,4,1,1,6,'',null,null,1,1,1),
(100,20,5,1,1,6,'',null,null,1,1,1),
-- ----------------------
-- Licenciatura en Comercio Exterior - distancia
-- -----------------------
(101,21,1,1,1,6,'',null,null,1,1,1),
(102,21,2,1,1,6,'',null,null,1,1,1),
(103,21,3,1,1,6,'',null,null,1,1,1),
(104,21,4,1,1,6,'',null,null,1,1,1),
(105,21,5,1,1,6,'',null,null,1,1,1),
-- ----------------------
-- Licenciatura en Finanzas - distancia
-- -----------------------
(106,22,1,1,1,6,'',null,null,1,1,1),
(107,22,2,1,1,6,'',null,null,1,1,1),
(108,22,3,1,1,6,'',null,null,1,1,1),
(109,22,4,1,1,6,'',null,null,1,1,1),
(110,22,5,1,1,6,'',null,null,1,1,1),
-- ----------------------
-- Licenciatura en Contabilidad y Auditoria - distancia
-- -----------------------
(111,23,1,1,1,6,'',null,null,1,1,1),
(112,23,2,1,1,6,'',null,null,1,1,1),
(113,23,3,1,1,6,'',null,null,1,1,1),
(114,23,4,1,1,6,'',null,null,1,1,1),
(115,23,5,1,1,6,'',null,null,1,1,1),
-- ----------------------
-- Licenciatura en Gestión y Talento Humano - distancia
-- -----------------------
(116,24,1,1,1,6,'',null,null,1,1,1),
(117,24,2,1,1,6,'',null,null,1,1,1),
(118,24,3,1,1,6,'',null,null,1,1,1),
(119,24,4,1,1,6,'',null,null,1,1,1),
(120,24,5,1,1,6,'',null,null,1,1,1),
-- ----------------------
-- Licenciatura en Administración de Empresas - distancia
-- ----------------------
(121,25,1,1,1,6,'',null,null,1,1,1),
(122,25,2,1,1,6,'',null,null,1,1,1),
(123,25,3,1,1,6,'',null,null,1,1,1),
(124,25,4,1,1,6,'',null,null,1,1,1),
(125,25,5,1,1,6,'',null,null,1,1,1),
-- ----------------------
-- Licenciatura en Mercadotecnia - distancia
-- -----------------------
(126,26,1,1,1,6,'',null,null,1,1,1),
(127,26,2,1,1,6,'',null,null,1,1,1),
(128,26,3,1,1,6,'',null,null,1,1,1),
(129,26,4,1,1,6,'',null,null,1,1,1),
(130,26,5,1,1,6,'',null,null,1,1,1);


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

   



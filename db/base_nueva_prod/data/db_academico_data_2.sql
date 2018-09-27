--
-- Base de datos: `db_academico`
--
USE `db_academico`;

-- -- ------------------------ ------------------------------
--
-- Volcado de datos para la tabla `semestre`
-- 
INSERT INTO `semestre_academico` (`saca_id`, `saca_nombre`, `saca_descripcion`, `saca_fecha_registro`, `saca_usuario_ingreso`, `saca_usuario_modifica`, `saca_estado`, `saca_estado_logico`) VALUES 
(1, 'Abril - Agosto', 'Abril - Agosto', NULL, '1', '1', '1', '1'),
(2, 'Octubre - Febrero', 'Octubre - Febrero', NULL, '1', '1', '1', '1');

-- -- ------------------------ ------------------------------
--
-- Volcado de datos para la tabla `bloque`
--
INSERT INTO `bloque_academico` (`baca_id`,`baca_nombre`, `baca_descripcion`, `baca_usuario_ingreso`, `baca_usuario_modifica`, `baca_estado`, `baca_estado_logico`) VALUES 
(1, 'Abril - Junio', 'Abril - Junio', '1', '1', '1', '1'),
(2, 'Julio - Agosto', 'Julio - Agosto', '1', '1', '1', '1');

-- -- ------------------------ ------------------------------
--
-- Volcado de datos para la tabla `periodo_academico`
--

INSERT INTO `periodo_academico` (`paca_id`,`saca_id`, `baca_id`, `paca_anio_academico`, `paca_usuario_ingreso`, `paca_usuario_modifica`, `paca_estado`, `paca_estado_logico`) VALUES 
('1','1', '1', '2017-2018', '1', '1', '1', '1'),
('2','1', '2', '2017-2018', '1', '1', '1', '1'),
('3','2', '1', '2017-2018', '1', '1', '1', '1'),
('4','2', '2', '2017-2018', '1', '1', '1', '1'),
('5','1', '1', '2018-2019', '1', '1', '1', '1'),
('6','1', '2', '2018-2019', '1', '1', '1', '1'),
('7','2', '1', '2018-2019', '1', '1', '1', '1'),
('8','2', '2', '2018-2019', '1', '1', '1', '1');

-- -- ------------------------ ------------------------------
--
-- Volcado de datos para la tabla `periodo_academico_met_ingreso`
--

INSERT INTO `periodo_academico_met_ingreso` (`pami_id`, `mes_id_academico`, `pami_fecha_inicio`, `pami_fecha_fin`, `pami_codigo`, `pami_usuario_ingreso`, `pami_estado`, `pami_estado_logico`) VALUES
(1, 9, '2018-09-01', '2018-09-30', 'CAN092018', 1, '1', '1'),
(2, 10, '2018-10-01', '2018-10-31', 'CAN102018', 1, '1', '1');

-- -- ------------------------ ------------------------------
--
-- Volcado de datos para la tabla `paralelo`
--

INSERT INTO `paralelo` (`par_id`,`paca_id`, `pami_id`, `par_nombre`, `par_descripcion`, `par_usuario_ingreso`, `par_usuario_modifica`, `par_estado`, `par_estado_logico`) VALUES 
(1, NULL, 1, '0001', '0001', 1, 1, '1', '1'),
(2, NULL, 1, '0002', '0002', 1, 1, '1', '1');


INSERT INTO `profesor` (`pro_id`,`per_id`,`pro_usuario_ingreso`,`pro_usuario_modifica`,`pro_estado`,`pro_estado_logico`)VALUES
(1,500,1,null,1,1),
(2,501,1,null,1,1),
(3,502,1,null,1,1),
(4,503,1,null,1,1),
(5,504,1,null,1,1),
(6,505,1,null,1,1),
(7,506,1,null,1,1),
(8,507,1,null,1,1);


INSERT INTO `malla_academica` (`maca_id`,`eaca_id`,`uaca_id`,`mod_id`,`maca_nombre`,`maca_fecha_vigencia_inicio`,`maca_fecha_vigencia_fin`,`maca_usuario_ingreso`,`maca_estado`,`maca_estado_logico`) VALUES 
-- Online 
(1,1,1,1,'Curso de Admisión y Nivelación - Licenciatura en Comercio Exterior - Online','2018-07-01','2018-09-30',1,1,1),
(2,2,1,1,'Curso de Admisión y Nivelación - Economía - Online','2018-07-01','2018-09-30',1,1,1),
(3,3,1,1,'Curso de Admisión y Nivelación - Licenciatura en Finanzas - Online','2018-07-01','2018-09-30',1,1,1),
(4,4,1,1,'Curso de Admisión y Nivelación - Licenciatura en Mercadotecnia - Online','2018-07-01','2018-09-30',1,1,1),
(5,5,1,1,'Curso de Admisión y Nivelación - Licenciatura en Turismo - Online','2018-07-01','2018-09-30',1,1,1),
(6,6,1,1,'Curso de Admisión y Nivelación - Licenciatura en Administración de Empresas - Online','2018-07-01','2018-09-30',1,1,1),

-- Presencial

(7,11,1,2,'Curso de Admisión y Nivelación - Ingenieria en Logística y Transporte - Presencial','2018-07-01','2018-09-30',1,1,1),
(8,8,1,2,'Curso de Admisión y Nivelación - Ingenieria en Telecomunicaciones - Presencial' ,'2018-07-01','2018-09-30',1,1,1),
(9,7,1,2,'Curso de Admisión y Nivelación - Ingenieria en Software - Presencial','2018-07-01','2018-09-30',1,1,1),
(10,10,1,2,'Curso de Admisión y Nivelación - Ingenieria en Tecnologias de la Información - Presencial','2018-07-01','2018-09-30',1,1,1),
(11,1,1,2,'Curso de Admisión y Nivelación - Licenciatura en Comercio Exterior - Presencial','2018-07-01','2018-09-30',1,1,1),
(12,5,1,2,'Curso de Admisión y Nivelación - Licenciatura en Turismo - Presencial','2018-07-01','2018-09-30',1,1,1),
(13,3,1,2,'Curso de Admisión y Nivelación - Licenciatura en Finanza - Presencials','2018-07-01','2018-09-30',1,1,1),
(14,9,1,2,'Curso de Admisión y Nivelación - Licenciatura en Contabilidad y Auditoria - Presencial','2018-07-01','2018-09-30',1,1,1),
(15,13,1,2,'Curso de Admisión y Nivelación - Licenciatura en Gestión y Talento Humano - Presencial','2018-07-01','2018-09-30',1,1,1),
(16,6,1,2,'Curso de Admisión y Nivelación - Licenciatura en Administracion de Empresas - Presencial','2018-07-01','2018-09-30',1,1,1),
(17,4,1,2,'Curso de Admisión y Nivelación - Licenciatura en Mercadotecnia - Presencial','2018-07-01','2018-09-30',1,1,1),
(18,14,1,2,'Curso de Admisión y Nivelación - Licenciatura en Administración Portuaria y Aduanera - Presencial','2018-07-01','2018-09-30',1,1,1),

-- Semi-Presencial

(19,12,1,3,'Curso de Admisión y Nivelación - Licenciatura en Comunicación - Semi - Presencial','2018-07-01','2018-09-30',1,1,1),
(20,15,2,3,'Curso de Admisión y Nivelación - Administración de Empresas - Semi - Presencial','2018-07-01','2018-09-30',1,1,1),
(21,16,2,3,'Curso de Admisión y Nivelación - Finanzas - Semi - Presencial','2018-07-01','2018-09-30',1,1,1),
(22,17,2,3,'Curso de Admisión y Nivelación - Marketing - Semi - Presencial','2018-07-01','2018-09-30',1,1,1),
(23,18,2,3,'Curso de Admisión y Nivelación - Sistema de Información Gerencial - Semi - Presencial','2018-07-01','2018-09-30',1,1,1),
(24,19,2,3,'Curso de Admisión y Nivelación - Turismo - Semi - Presencial','2018-07-01','2018-09-30',1,1,1),
(25,20,2,3,'Curso de Admisión y Nivelación - Talento Humano - Semi - Presencial','2018-07-01','2018-09-30',1,1,1),
(26,21,2,3,'Curso de Admisión y Nivelación - Empresas Familiares - Semi - Presencial','2018-07-01','2018-09-30',1,1,1),
(27,22,2,3,'Curso de Admisión y Nivelación - Investigación - Semi - Presencial','2018-07-01','2018-09-30',1,1,1),
-- Distancia
(28,1,1,4,'Curso de Admisión y Nivelación - Licenciatura en Comercio Exterior - Distancia','2018-07-01','2018-09-30',1,1,1),
(29,3,1,4,'Curso de Admisión y Nivelación - Licenciatura en Finanzas - Distancia','2018-07-01','2018-09-30',1,1,1),
(30,4,1,4,'Curso de Admisión y Nivelación - Licenciatura en Mercadotecnia - DIstancia','2018-07-01','2018-09-30',1,1,1),
(31,6,1,4,'Curso de Admisión y Nivelación - Licenciatura en Administración de Empresas - Distancia','2018-07-01','2018-09-30',1,1,1),
(32,9,1,4,'Curso de Admisión y Nivelación - Licenciatura en Contabilidad y Auditoria - Ditancia','2018-07-01','2018-09-30',1,1,1),
(33,13,1,4,'Curso de Admisión y Nivelación - Licenciatura en Gestión y Talento Humano - Distancia','2018-07-01','2018-09-30',1,1,1);

INSERT INTO `malla_academica_detalle` (`made_id`,`maca_id`,`asi_id`,`uest_id`,`nest_id`,`fmac_id`,`made_codigo_asignatura`,`made_usuario_ingreso`,`made_estado`,`made_estado_logico`) VALUES 
-- -----------------------
-- Comercio Exterior - online
-- -----------------------
(1,1,1,1,1,6,'',1,1,1),
(2,1,2,1,1,6,'',1,1,1),
(3,1,3,1,1,6,'',1,1,1),
(4,1,4,1,1,6,'',1,1,1),
(5,1,5,1,1,6,'',1,1,1),
-- -----------------------
-- Economía - online
-- -----------------------
(6,2,1,1,1,6,'',1,1,1),
(7,2,2,1,1,6,'',1,1,1),
(8,2,3,1,1,6,'',1,1,1),
(9,2,4,1,1,6,'',1,1,1),
(10,2,5,1,1,6,'',1,1,1),
-- -----------------------
-- Licenciatura en Finanzas - online
-- -----------------------
(11,3,1,1,1,6,'',1,1,1),
(12,3,2,1,1,6,'',1,1,1),
(13,3,3,1,1,6,'',1,1,1),
(14,3,4,1,1,6,'',1,1,1),
(15,3,5,1,1,6,'',1,1,1),
-- -----------------------
-- Licenciatura en Mercadotecnia - online
-- -----------------------
(16,4,1,1,1,6,'',1,1,1),
(17,4,2,1,1,6,'',1,1,1),
(18,4,3,1,1,6,'',1,1,1),
(19,4,4,1,1,6,'',1,1,1),
(20,4,5,1,1,6,'',1,1,1),
-- -----------------------
-- Licenciatura en Turismo - online
-- -----------------------
(21,5,1,1,1,6,'',1,1,1),
(22,5,2,1,1,6,'',1,1,1),
(23,5,3,1,1,6,'',1,1,1),
(24,5,4,1,1,6,'',1,1,1),
(25,5,5,1,1,6,'',1,1,1),
-- -----------------------
-- Licenciatura en Administración de Empresas - online
-- -----------------------
(26,6,1,1,1,6,'',1,1,1),
(27,6,2,1,1,6,'',1,1,1),
(28,6,3,1,1,6,'',1,1,1),
(29,6,4,1,1,6,'',1,1,1),
(30,6,5,1,1,6,'',1,1,1),
-- -----------------------
-- Ingenieria en Logística y Transporte - presencial
-- -----------------------
(31,7,1,1,1,6,'',1,1,1),
(32,7,2,1,1,6,'',1,1,1),
(33,7,3,1,1,6,'',1,1,1),
(34,7,4,1,1,6,'',1,1,1),
(35,7,5,1,1,6,'',1,1,1),
-- ----------------------
-- Ingenieria en Telecomunicaciones - presencial
-- -----------------------
(36,8,1,1,1,6,'',1,1,1),
(37,8,2,1,1,6,'',1,1,1),
(38,8,3,1,1,6,'',1,1,1),
(39,8,4,1,1,6,'',1,1,1),
(40,8,5,1,1,6,'',1,1,1),
-- ----------------------
-- Ingenieria en Software - presencial
-- -----------------------
(41,9,1,1,1,6,'',1,1,1),
(42,9,2,1,1,6,'',1,1,1),
(43,9,3,1,1,6,'',1,1,1),
(44,9,4,1,1,6,'',1,1,1),
(45,9,5,1,1,6,'',1,1,1),
-- ----------------------
-- Ingenieria en Tecnologias de la Información - presencial
-- -----------------------
(46,10,1,1,1,6,'',1,1,1),
(47,10,2,1,1,6,'',1,1,1),
(48,10,3,1,1,6,'',1,1,1),
(49,10,4,1,1,6,'',1,1,1),
(50,10,5,1,1,6,'',1,1,1),
-- ----------------------
-- Licenciatura en Comercio Exterior - presencial
-- -----------------------
(51,11,1,1,1,6,'',1,1,1),
(52,11,2,1,1,6,'',1,1,1),
(53,11,3,1,1,6,'',1,1,1),
(54,11,4,1,1,6,'',1,1,1),
(55,11,5,1,1,6,'',1,1,1),
-- ----------------------
-- Licenciatura en Turismo - presencial
-- -----------------------
(56,12,1,1,1,6,'',1,1,1),
(57,12,2,1,1,6,'',1,1,1),
(58,12,3,1,1,6,'',1,1,1),
(59,12,4,1,1,6,'',1,1,1),
(60,12,5,1,1,6,'',1,1,1),
-- ----------------------
-- Licenciatura en Finanzas - presencial
-- -----------------------
(61,13,1,1,1,6,'',1,1,1),
(62,13,2,1,1,6,'',1,1,1),
(63,13,3,1,1,6,'',1,1,1),
(64,13,4,1,1,6,'',1,1,1),
(65,13,5,1,1,6,'',1,1,1),
-- ----------------------
-- Licenciatura en Contabilidad y Auditoria - presencial
-- -----------------------
(66,14,1,1,1,6,'',1,1,1),
(67,14,2,1,1,6,'',1,1,1),
(68,14,3,1,1,6,'',1,1,1),
(69,14,4,1,1,6,'',1,1,1),
(70,14,5,1,1,6,'',1,1,1),
-- ----------------------
-- Licenciatura en Gestión y Talento Humano - presencial
-- -----------------------
(71,15,1,1,1,6,'',1,1,1),
(72,15,2,1,1,6,'',1,1,1),
(73,15,3,1,1,6,'',1,1,1),
(74,15,4,1,1,6,'',1,1,1),
(75,15,5,1,1,6,'',1,1,1),
-- ----------------------
-- Licenciatura en Administración de Empresas - presencial
-- -----------------------
(76,16,1,1,1,6,'',1,1,1),
(77,16,2,1,1,6,'',1,1,1),
(78,16,3,1,1,6,'',1,1,1),
(79,16,4,1,1,6,'',1,1,1),
(80,16,5,1,1,6,'',1,1,1),
-- ----------------------
-- Licenciatura en Mercadotecnia - presencial
-- -----------------------
(81,17,1,1,1,6,'',1,1,1),
(82,17,2,1,1,6,'',1,1,1),
(83,17,3,1,1,6,'',1,1,1),
(84,17,4,1,1,6,'',1,1,1),
(85,17,5,1,1,6,'',1,1,1),
-- ----------------------
-- Licenciatura en Administración Portuaria y Aduanera - presencial
-- -----------------------
(86,18,1,1,1,6,'',1,1,1),
(87,18,2,1,1,6,'',1,1,1),
(88,18,3,1,1,6,'',1,1,1),
(89,18,4,1,1,6,'',1,1,1),
(90,18,5,1,1,6,'',1,1,1),
-- ----------------------
-- Licenciatura en Comunicación - semipresencial
-- -----------------------
(91,19,1,1,1,6,'',1,1,1),
(92,19,2,1,1,6,'',1,1,1),
(93,19,3,1,1,6,'',1,1,1),
(94,19,4,1,1,6,'',1,1,1),
(95,19,5,1,1,6,'',1,1,1),
-- ----------------------
-- Administración de Empresas - semipresencial
-- -----------------------
(96,20,1,1,1,6,'',1,1,1),
(97,20,2,1,1,6,'',1,1,1),
(98,20,3,1,1,6,'',1,1,1),
(99,20,4,1,1,6,'',1,1,1),
(100,20,5,1,1,6,'',1,1,1),
-- ----------------------
-- Finanzas - semipresencial
-- -----------------------
(101,21,1,1,1,6,'',1,1,1),
(102,21,2,1,1,6,'',1,1,1),
(103,21,3,1,1,6,'',1,1,1),
(104,21,4,1,1,6,'',1,1,1),
(105,21,5,1,1,6,'',1,1,1),
-- ----------------------
-- Marketing - semipresencial
-- -----------------------
(106,22,1,1,1,6,'',1,1,1),
(107,22,2,1,1,6,'',1,1,1),
(108,22,3,1,1,6,'',1,1,1),
(109,22,4,1,1,6,'',1,1,1),
(110,22,5,1,1,6,'',1,1,1),
-- ----------------------
-- Sistema de Información Gerencial - semipresencial
-- -----------------------
(111,23,1,1,1,6,'',1,1,1),
(112,23,2,1,1,6,'',1,1,1),
(113,23,3,1,1,6,'',1,1,1),
(114,23,4,1,1,6,'',1,1,1),
(115,23,5,1,1,6,'',1,1,1),
-- ----------------------
-- Turismo - semipresencial
-- -----------------------
(116,24,1,1,1,6,'',1,1,1),
(117,24,2,1,1,6,'',1,1,1),
(118,24,3,1,1,6,'',1,1,1),
(119,24,4,1,1,6,'',1,1,1),
(120,24,5,1,1,6,'',1,1,1),
-- ----------------------
-- Talento Humano - semipresencial
-- -----------------------
(121,25,1,1,1,6,'',1,1,1),
(122,25,2,1,1,6,'',1,1,1),
(123,25,3,1,1,6,'',1,1,1),
(124,25,4,1,1,6,'',1,1,1),
(125,25,5,1,1,6,'',1,1,1),
-- ----------------------
-- Empresas Familiares - semipresencial
-- -----------------------
(126,26,1,1,1,6,'',1,1,1),
(127,26,2,1,1,6,'',1,1,1),
(128,26,3,1,1,6,'',1,1,1),
(129,26,4,1,1,6,'',1,1,1),
(130,26,5,1,1,6,'',1,1,1),
-- ----------------------
-- Investigación - semipresencial
-- -----------------------
(131,27,1,1,1,6,'',1,1,1),
(132,27,2,1,1,6,'',1,1,1),
(133,27,3,1,1,6,'',1,1,1),
(134,27,4,1,1,6,'',1,1,1),
(135,27,5,1,1,6,'',1,1,1),
-- ----------------------
-- Licenciatura en Comercio Exterior - distancia
-- -----------------------
(136,28,1,1,1,6,'',1,1,1),
(137,28,2,1,1,6,'',1,1,1),
(138,28,3,1,1,6,'',1,1,1),
(139,28,4,1,1,6,'',1,1,1),
(140,28,5,1,1,6,'',1,1,1),
-- ----------------------
-- Licenciatura en Finanzas - distancia
-- -----------------------
(141,29,1,1,1,6,'',1,1,1),
(142,29,2,1,1,6,'',1,1,1),
(143,29,3,1,1,6,'',1,1,1),
(144,29,4,1,1,6,'',1,1,1),
(145,29,5,1,1,6,'',1,1,1),
-- ----------------------
-- Licenciatura en Mercadotecnia - distancia
-- -----------------------
(146,30,1,1,1,6,'',1,1,1),
(147,30,2,1,1,6,'',1,1,1),
(148,30,3,1,1,6,'',1,1,1),
(149,30,4,1,1,6,'',1,1,1),
(150,30,5,1,1,6,'',1,1,1),
-- ----------------------
-- Licenciatura en Administración de Empresas - distancia
-- -----------------------
(151,31,1,1,1,6,'',1,1,1),
(152,31,2,1,1,6,'',1,1,1),
(153,31,3,1,1,6,'',1,1,1),
(154,31,4,1,1,6,'',1,1,1),
(155,31,5,1,1,6,'',1,1,1),
-- ----------------------
-- Licenciatura en Contabilidad y Auditoria - distancia
-- ----------------------
(156,32,1,1,1,6,'',1,1,1),
(157,32,2,1,1,6,'',1,1,1),
(158,32,3,1,1,6,'',1,1,1),
(159,32,4,1,1,6,'',1,1,1),
(160,32,5,1,1,6,'',1,1,1),
-- ----------------------
-- Licenciatura en Gestión y Talento Humano - distancia
-- -----------------------
(161,33,1,1,1,6,'',1,1,1),
(162,33,2,1,1,6,'',1,1,1),
(163,33,3,1,1,6,'',1,1,1),
(164,33,4,1,1,6,'',1,1,1),
(165,33,5,1,1,6,'',1,1,1);


INSERT INTO `planificacion_estudio_academico` (`peac_id`,`uaca_id`,`pami_id`,`mod_id`,`paca_id`, `maca_id`, `peac_usuario_ingreso`,`peac_estado`,`peac_estado_logico`) VALUES 
-- Online
(1,1,1,1,null, 1 , 1,'1','1'),
(2,1,1,1,null, 2 , 1,'1','1'),
(3,1,1,1,null, 3 , 1,'1','1'),
(4,1,1,1,null, 4 , 1,'1','1'),
(5,1,1,1,null, 5 , 1,'1','1'),
(6,1,1,1,null, 6 , 1,'1','1'),
-- Presencial
(7,1,1,2,null, 7 , 1,'1','1'),
(8,1,1,2,null, 8 , 1,'1','1'),
(9,1,1,2,null, 9 , 1,'1','1'),
(10,1,1,2,null, 10 , 1,'1','1'),
(11,1,1,2,null, 11 , 1,'1','1'),
(12,1,1,2,null, 12 , 1,'1','1'),
(13,1,1,2,null, 13 , 1,'1','1'),
(14,1,1,2,null, 14 , 1,'1','1'),
(15,1,1,2,null, 15 , 1,'1','1'),
(16,1,1,2,null, 16 , 1,'1','1'),
(17,1,1,2,null, 17 , 1,'1','1'),
(18,1,1,2,null, 18 , 1,'1','1'),
-- Semi Presencial
(19,1,1,3,null, 19 , 1,'1','1'),
(20,1,1,3,null, 20 , 1,'1','1'),
(21,1,1,3,null, 21 , 1,'1','1'),
(22,1,1,3,null, 22 , 1,'1','1'),
(23,1,1,3,null, 23 , 1,'1','1'),
(24,1,1,3,null, 24 , 1,'1','1'),
(25,1,1,3,null, 25 , 1,'1','1'),
(26,1,1,3,null, 26 , 1,'1','1'),
(27,1,1,3,null, 27 , 1,'1','1'),
-- Distancia
(28,1,1,4,null, 28 , 1,'1','1'),
(29,1,1,4,null, 29 , 1,'1','1'),
(30,1,1,4,null, 30 , 1,'1','1'),
(31,1,1,4,null, 31 , 1,'1','1'),
(32,1,1,4,null, 32 , 1,'1','1'),
(33,1,1,4,null, 33 , 1,'1','1');

INSERT INTO `distributivo_horario` (`dhor_id`,`dia_id`,`dhor_hora_inicio`,`dhor_hora_fin`, `dhor_descripcion`, `dhor_usuario_ingreso`, `dhor_estado`,`dhor_estado_logico`) VALUES 
(1,1,'07:00','13:00','Matutino',1,1,1),
(2,1,'13:20','18:00','Vespertino',1,1,1),
(3,1,'18:20','22:20','Nocturno',1,1,1),
(4,1,'10:00','17:00','Intensivo',1,1,1);
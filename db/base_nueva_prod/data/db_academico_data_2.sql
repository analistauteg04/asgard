--
-- Base de datos: `db_academico`
--
USE `db_academico`;

-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `semestre`
--
INSERT INTO `semestre_academico` (`saca_id`, `saca_nombre`, `saca_descripcion`, `saca_fecha_registro`, `saca_usuario_ingreso`, `saca_usuario_modifica`, `saca_estado`, `saca_estado_logico`) VALUES 
(1, 'Abril - Agosto', 'Abril - Agosto', NULL, '1', '1', '1', '1'),
(2, 'Octubre - Febrero', 'Octubre - Febrero', NULL, '1', '1', '1', '1');

-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `bloque`
--
INSERT INTO `bloque_academico` (`baca_id`,`baca_nombre`, `baca_descripcion`, `baca_usuario_ingreso`, `baca_usuario_modifica`, `baca_estado`, `baca_estado_logico`) VALUES 
(1, 'Abril - Junio', 'Abril - Junio', '1', '1', '1', '1'),
(2, 'Julio - Agosto', 'Julio - Agosto', '1', '1', '1', '1');

-- --------------------------------------------------------
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

-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `paralelo`
--

INSERT INTO `paralelo` (`par_id`,`paca_id`, `pami_id`, `par_nombre`, `par_descripcion`, `par_usuario_ingreso`, `par_usuario_modifica`, `par_estado`, `par_estado_logico`) VALUES 
('1','1', null, '0001', '0001', '1', '1', '1', '1'),
('2','2', null, '0001', '0001', '1', '1', '1', '1'),
('3','3', null, '0001', '0001', '1', '1', '1', '1'),
('4','4', null, '0001', '0001', '1', '1', '1', '1'),
('5','5', null, '0001', '0001', '1', '1', '1', '1'),
('6','6', null, '0001', '0001', '1', '1', '1', '1'),
('7','7', null, '0001', '0001', '1', '1', '1', '1'),
('8','8', null, '0001', '0001', '1', '1', '1', '1');


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
(1,1,1,1,'Curso de Admisión y Niveación-Licenciatura','2018-07-01','2018-09-30',1,1,1),
(2,2,1,1,'Curso de Admisión y Niveación-Licenciatura','2018-07-01','2018-09-30',1,1,1),
(3,3,1,1,'Curso de Admisión y Niveación-Licenciatura','2018-07-01','2018-09-30',1,1,1),
(4,4,1,1,'Curso de Admisión y Niveación-Licenciatura','2018-07-01','2018-09-30',1,1,1),
(5,5,1,1,'Curso de Admisión y Niveación-Licenciatura','2018-07-01','2018-09-30',1,1,1),
(6,6,1,1,'Curso de Admisión y Niveación-Licenciatura','2018-07-01','2018-09-30',1,1,1),
(7,9,1,1,'Curso de Admisión y Niveación-Licenciatura','2018-07-01','2018-09-30',1,1,1),
(8,12,1,1,'Curso de Admisión y Niveación-Licenciatura','2018-07-01','2018-09-30',1,1,1),
(9,13,1,1,'Curso de Admisión y Niveación-Licenciatura','2018-07-01','2018-09-30',1,1,1),
(10,14,1,1,'Curso de Admisión y Niveación-Licenciatura','2018-07-01','2018-09-30',1,1,1),
(11,15,1,1,'Curso de Admisión y Niveación-Licenciatura','2018-07-01','2018-09-30',1,1,1),
(12,16,1,1,'Curso de Admisión y Niveación-Licenciatura','2018-07-01','2018-09-30',1,1,1),
(13,17,1,1,'Curso de Admisión y Niveación-Licenciatura','2018-07-01','2018-09-30',1,1,1),
(14,18,1,1,'Curso de Admisión y Niveación-Licenciatura','2018-07-01','2018-09-30',1,1,1),
(15,19,1,1,'Curso de Admisión y Niveación-Licenciatura','2018-07-01','2018-09-30',1,1,1),
(16,20,1,1,'Curso de Admisión y Niveación-Licenciatura','2018-07-01','2018-09-30',1,1,1),
(17,21,1,1,'Curso de Admisión y Niveación-Licenciatura','2018-07-01','2018-09-30',1,1,1),
(18,22,1,1,'Curso de Admisión y Niveación-Licenciatura','2018-07-01','2018-09-30',1,1,1),
(19,7,1,1,'Curso de Admisión y Niveación-Ingenieria','2018-07-01','2018-09-30',1,1,1),
(20,8,1,1,'Curso de Admisión y Niveación-Ingenieria','2018-07-01','2018-09-30',1,1,1),
(21,10,1,1,'Curso de Admisión y Niveación-Ingenieria','2018-07-01','2018-09-30',1,1,1),
(22,11,1,1,'Curso de Admisión y Niveación-Ingenieria','2018-07-01','2018-09-30',1,1,1),

-- presencial

(23,1,1,2,'Curso de Admisión y Niveación-Licenciatura','2018-07-01','2018-09-30',1,1,1),
(24,2,1,2,'Curso de Admisión y Niveación-Licenciatura','2018-07-01','2018-09-30',1,1,1),
(25,3,1,2,'Curso de Admisión y Niveación-Licenciatura','2018-07-01','2018-09-30',1,1,1),
(26,4,1,2,'Curso de Admisión y Niveación-Licenciatura','2018-07-01','2018-09-30',1,1,1),
(27,5,1,2,'Curso de Admisión y Niveación-Licenciatura','2018-07-01','2018-09-30',1,1,1),
(28,6,1,2,'Curso de Admisión y Niveación-Licenciatura','2018-07-01','2018-09-30',1,1,1),
(29,9,1,2,'Curso de Admisión y Niveación-Licenciatura','2018-07-01','2018-09-30',1,1,1),
(30,12,1,2,'Curso de Admisión y Niveación-Licenciatura','2018-07-01','2018-09-30',1,1,1),
(31,13,1,2,'Curso de Admisión y Niveación-Licenciatura','2018-07-01','2018-09-30',1,1,1),
(32,14,1,2,'Curso de Admisión y Niveación-Licenciatura','2018-07-01','2018-09-30',1,1,1),
(33,15,1,2,'Curso de Admisión y Niveación-Licenciatura','2018-07-01','2018-09-30',1,1,1),
(34,16,1,2,'Curso de Admisión y Niveación-Licenciatura','2018-07-01','2018-09-30',1,1,1),
(35,17,1,2,'Curso de Admisión y Niveación-Licenciatura','2018-07-01','2018-09-30',1,1,1),
(36,18,1,2,'Curso de Admisión y Niveación-Licenciatura','2018-07-01','2018-09-30',1,1,1),
(37,19,1,2,'Curso de Admisión y Niveación-Licenciatura','2018-07-01','2018-09-30',1,1,1),
(38,20,1,2,'Curso de Admisión y Niveación-Licenciatura','2018-07-01','2018-09-30',1,1,1),
(39,21,1,2,'Curso de Admisión y Niveación-Licenciatura','2018-07-01','2018-09-30',1,1,1),
(40,22,1,2,'Curso de Admisión y Niveación-Licenciatura','2018-07-01','2018-09-30',1,1,1),
(41,7,1,2,'Curso de Admisión y Niveación-Ingenieria','2018-07-01','2018-09-30',1,1,1),
(42,8,1,2,'Curso de Admisión y Niveación-Ingenieria','2018-07-01','2018-09-30',1,1,1),
(43,10,1,2,'Curso de Admisión y Niveación-Ingenieria','2018-07-01','2018-09-30',1,1,1),
(44,11,1,2,'Curso de Admisión y Niveación-Ingenieria','2018-07-01','2018-09-30',1,1,1),

-- Semipresencial

(45,1,1,3,'Curso de Admisión y Niveación-Licenciatura','2018-07-01','2018-09-30',1,1,1),
(46,2,1,3,'Curso de Admisión y Niveación-Licenciatura','2018-07-01','2018-09-30',1,1,1),
(47,3,1,3,'Curso de Admisión y Niveación-Licenciatura','2018-07-01','2018-09-30',1,1,1),
(48,4,1,3,'Curso de Admisión y Niveación-Licenciatura','2018-07-01','2018-09-30',1,1,1),
(49,5,1,3,'Curso de Admisión y Niveación-Licenciatura','2018-07-01','2018-09-30',1,1,1),
(50,6,1,3,'Curso de Admisión y Niveación-Licenciatura','2018-07-01','2018-09-30',1,1,1),
(51,9,1,3,'Curso de Admisión y Niveación-Licenciatura','2018-07-01','2018-09-30',1,1,1),
(52,12,1,3,'Curso de Admisión y Niveación-Licenciatura','2018-07-01','2018-09-30',1,1,1),
(53,13,1,3,'Curso de Admisión y Niveación-Licenciatura','2018-07-01','2018-09-30',1,1,1),
(54,14,1,3,'Curso de Admisión y Niveación-Licenciatura','2018-07-01','2018-09-30',1,1,1),
(55,15,1,3,'Curso de Admisión y Niveación-Licenciatura','2018-07-01','2018-09-30',1,1,1),
(56,16,1,3,'Curso de Admisión y Niveación-Licenciatura','2018-07-01','2018-09-30',1,1,1),
(57,17,1,3,'Curso de Admisión y Niveación-Licenciatura','2018-07-01','2018-09-30',1,1,1),
(58,18,1,3,'Curso de Admisión y Niveación-Licenciatura','2018-07-01','2018-09-30',1,1,1),
(59,19,1,3,'Curso de Admisión y Niveación-Licenciatura','2018-07-01','2018-09-30',1,1,1),
(60,20,1,3,'Curso de Admisión y Niveación-Licenciatura','2018-07-01','2018-09-30',1,1,1),
(61,21,1,3,'Curso de Admisión y Niveación-Licenciatura','2018-07-01','2018-09-30',1,1,1),
(62,22,1,3,'Curso de Admisión y Niveación-Licenciatura','2018-07-01','2018-09-30',1,1,1),
(63,7,1,3,'Curso de Admisión y Niveación-Ingenieria','2018-07-01','2018-09-30',1,1,1),
(64,8,1,3,'Curso de Admisión y Niveación-Ingenieria','2018-07-01','2018-09-30',1,1,1),
(65,10,1,3,'Curso de Admisión y Niveación-Ingenieria','2018-07-01','2018-09-30',1,1,1),
(66,11,1,3,'Curso de Admisión y Niveación-Ingenieria','2018-07-01','2018-09-30',1,1,1),

-- Distancia

(67,1,1,4,'Curso de Admisión y Niveación-Licenciatura','2018-07-01','2018-09-30',1,1,1),
(68,2,1,4,'Curso de Admisión y Niveación-Licenciatura','2018-07-01','2018-09-30',1,1,1),
(69,3,1,4,'Curso de Admisión y Niveación-Licenciatura','2018-07-01','2018-09-30',1,1,1),
(70,4,1,4,'Curso de Admisión y Niveación-Licenciatura','2018-07-01','2018-09-30',1,1,1),
(71,5,1,4,'Curso de Admisión y Niveación-Licenciatura','2018-07-01','2018-09-30',1,1,1),
(72,6,1,4,'Curso de Admisión y Niveación-Licenciatura','2018-07-01','2018-09-30',1,1,1),
(73,9,1,4,'Curso de Admisión y Niveación-Licenciatura','2018-07-01','2018-09-30',1,1,1),
(74,12,1,4,'Curso de Admisión y Niveación-Licenciatura','2018-07-01','2018-09-30',1,1,1),
(75,13,1,4,'Curso de Admisión y Niveación-Licenciatura','2018-07-01','2018-09-30',1,1,1),
(76,14,1,4,'Curso de Admisión y Niveación-Licenciatura','2018-07-01','2018-09-30',1,1,1),
(77,15,1,4,'Curso de Admisión y Niveación-Licenciatura','2018-07-01','2018-09-30',1,1,1),
(78,16,1,4,'Curso de Admisión y Niveación-Licenciatura','2018-07-01','2018-09-30',1,1,1),
(79,17,1,4,'Curso de Admisión y Niveación-Licenciatura','2018-07-01','2018-09-30',1,1,1),
(80,18,1,4,'Curso de Admisión y Niveación-Licenciatura','2018-07-01','2018-09-30',1,1,1),
(81,19,1,4,'Curso de Admisión y Niveación-Licenciatura','2018-07-01','2018-09-30',1,1,1),
(82,20,1,4,'Curso de Admisión y Niveación-Licenciatura','2018-07-01','2018-09-30',1,1,1),
(83,21,1,4,'Curso de Admisión y Niveación-Licenciatura','2018-07-01','2018-09-30',1,1,1),
(84,22,1,4,'Curso de Admisión y Niveación-Licenciatura','2018-07-01','2018-09-30',1,1,1),
(85,7,1,4,'Curso de Admisión y Niveación-Ingenieria','2018-07-01','2018-09-30',1,1,1),
(86,8,1,4,'Curso de Admisión y Niveación-Ingenieria','2018-07-01','2018-09-30',1,1,1),
(87,10,1,4,'Curso de Admisión y Niveación-Ingenieria','2018-07-01','2018-09-30',1,1,1),
(88,11,1,4,'Curso de Admisión y Niveación-Ingenieria','2018-07-01','2018-09-30',1,1,1);


INSERT INTO `malla_academica_detalle` (`made_id`,`maca_id`,`asi_id`,`uest_id`,`nest_id`,`fmac_id`,`made_codigo_asignatura`,`made_usuario_ingreso`,`made_estado`,`made_estado_logico`) VALUES 

-- licenciatura

(1,1,1,1,1,6,'',1,1,1),
(2,1,2,1,1,6,'',1,1,1),
(3,1,3,1,1,6,'',1,1,1),
(4,1,4,1,1,6,'',1,1,1),
(5,1,5,1,1,6,'',1,1,1);

-- (6,2,1,1,1,6,'',1,1,1),
-- (7,2,2,1,1,6,'',1,1,1),
-- (8,2,3,1,1,6,'',1,1,1),
-- (9,2,4,1,1,6,'',1,1,1),
-- (10,2,5,1,1,6,'',1,1,1),
-- 
-- (11,3,1,1,1,6,'',1,1,1),
-- (12,3,2,1,1,6,'',1,1,1),
-- (13,3,3,1,1,6,'',1,1,1),
-- (14,3,4,1,1,6,'',1,1,1),
-- (15,3,5,1,1,6,'',1,1,1),
-- 
-- (16,4,1,1,1,6,'',1,1,1),
-- (17,4,2,1,1,6,'',1,1,1),
-- (18,4,3,1,1,6,'',1,1,1),
-- (19,4,4,1,1,6,'',1,1,1),
-- (20,4,5,1,1,6,'',1,1,1),
-- 
-- (21,5,1,1,1,6,'',1,1,1),
-- (22,5,2,1,1,6,'',1,1,1),
-- (23,5,3,1,1,6,'',1,1,1),
-- (24,5,4,1,1,6,'',1,1,1),
-- (25,5,5,1,1,6,'',1,1,1),
-- 
-- (26,6,1,1,1,6,'',1,1,1),
-- (27,6,2,1,1,6,'',1,1,1),
-- (28,6,3,1,1,6,'',1,1,1),
-- (29,6,4,1,1,6,'',1,1,1),
-- (30,6,5,1,1,6,'',1,1,1),
-- 
-- (31,9,1,1,1,6,'',1,1,1),
-- (32,9,2,1,1,6,'',1,1,1),
-- (33,9,3,1,1,6,'',1,1,1),
-- (34,9,4,1,1,6,'',1,1,1),
-- (35,9,5,1,1,6,'',1,1,1),
-- 
-- (36,12,1,1,1,6,'',1,1,1),
-- (37,12,2,1,1,6,'',1,1,1),
-- (38,12,3,1,1,6,'',1,1,1),
-- (39,12,4,1,1,6,'',1,1,1),
-- (40,12,5,1,1,6,'',1,1,1),
-- 
-- (41,13,1,1,1,6,'',1,1,1),
-- (42,13,2,1,1,6,'',1,1,1),
-- (43,13,3,1,1,6,'',1,1,1),
-- (44,13,4,1,1,6,'',1,1,1),
-- (45,13,5,1,1,6,'',1,1,1),
-- 
-- (46,14,1,1,1,6,'',1,1,1),
-- (47,14,2,1,1,6,'',1,1,1),
-- (48,14,3,1,1,6,'',1,1,1),
-- (49,14,4,1,1,6,'',1,1,1),
-- (50,14,5,1,1,6,'',1,1,1),
-- 
-- (51,15,1,1,1,6,'',1,1,1),
-- (52,15,2,1,1,6,'',1,1,1),
-- (53,15,3,1,1,6,'',1,1,1),
-- (54,15,4,1,1,6,'',1,1,1),
-- (55,15,5,1,1,6,'',1,1,1),
-- 
-- (56,16,1,1,1,6,'',1,1,1),
-- (57,16,2,1,1,6,'',1,1,1),
-- (58,16,3,1,1,6,'',1,1,1),
-- (59,16,4,1,1,6,'',1,1,1),
-- (60,16,5,1,1,6,'',1,1,1),
-- 
-- (61,17,1,1,1,6,'',1,1,1),
-- (62,17,2,1,1,6,'',1,1,1),
-- (63,17,3,1,1,6,'',1,1,1),
-- (64,17,4,1,1,6,'',1,1,1),
-- (65,17,5,1,1,6,'',1,1,1),
-- 
-- (66,18,1,1,1,6,'',1,1,1),
-- (67,18,2,1,1,6,'',1,1,1),
-- (68,18,3,1,1,6,'',1,1,1),
-- (69,18,4,1,1,6,'',1,1,1),
-- (70,18,5,1,1,6,'',1,1,1),
-- 
-- (71,19,1,1,1,6,'',1,1,1),
-- (72,19,2,1,1,6,'',1,1,1),
-- (73,19,3,1,1,6,'',1,1,1),
-- (74,19,4,1,1,6,'',1,1,1),
-- (75,19,5,1,1,6,'',1,1,1),
-- 
-- (76,20,1,1,1,6,'',1,1,1),
-- (77,20,2,1,1,6,'',1,1,1),
-- (78,20,3,1,1,6,'',1,1,1),
-- (79,20,4,1,1,6,'',1,1,1),
-- (80,20,5,1,1,6,'',1,1,1),
-- 
-- (81,21,1,1,1,6,'',1,1,1),
-- (82,21,2,1,1,6,'',1,1,1),
-- (83,21,3,1,1,6,'',1,1,1),
-- (84,21,4,1,1,6,'',1,1,1),
-- (85,21,5,1,1,6,'',1,1,1),
-- 
-- (86,22,1,1,1,6,'',1,1,1),
-- (87,22,2,1,1,6,'',1,1,1),
-- (88,22,3,1,1,6,'',1,1,1),
-- (89,22,4,1,1,6,'',1,1,1),
-- (90,22,5,1,1,6,'',1,1,1),
-- 
-- -- ingenieria
-- 
-- 
-- (91,7,1,1,1,6,'',1,1,1),
-- (92,7,6,1,1,6,'',1,1,1),
-- (93,7,3,1,1,6,'',1,1,1),
-- (94,7,4,1,1,6,'',1,1,1),
-- (95,7,5,1,1,6,'',1,1,1),
-- 
-- (96,8,1,1,1,6,'',1,1,1),
-- (97,8,6,1,1,6,'',1,1,1),
-- (98,8,3,1,1,6,'',1,1,1),
-- (99,8,4,1,1,6,'',1,1,1),
-- (100,8,5,1,1,6,'',1,1,1),
-- 
-- (101,10,1,1,1,6,'',1,1,1),
-- (102,10,6,1,1,6,'',1,1,1),
-- (103,10,3,1,1,6,'',1,1,1),
-- (104,10,4,1,1,6,'',1,1,1),
-- (105,10,5,1,1,6,'',1,1,1),
-- 
-- (106,11,1,1,1,6,'',1,1,1),
-- (107,11,6,1,1,6,'',1,1,1),
-- (108,11,3,1,1,6,'',1,1,1),
-- (109,11,4,1,1,6,'',1,1,1),
-- (110,11,5,1,1,6,'',1,1,1);

INSERT INTO `planificacion_estudio_academico` (`peac_id`,`uaca_id`,`pami_id`,`mod_id`,`paca_id`, `maca_id`, `peac_usuario_ingreso`,`peac_estado`,`peac_estado_logico`) VALUES 
(1,1,null,1,1,1,1,1,1);

INSERT INTO `distributivo_horario` (`dhor_id`,`dia_id`,`dhor_hora_inicio`,`dhor_hora_fin`, `dhor_usuario_ingreso`,`dhor_estado`,`dhor_estado_logico`) VALUES 
(1,1,'07:00','13:00',1,1,1);


INSERT INTO `distributivo_academico` (`daca_id`,`peac_id`,`pro_id`,`dhor_id`, `daca_fecha_registro`, `daca_usuario_ingreso`,`daca_estado`,`daca_estado_logico`) VALUES 
(1,1,1,1,'2018-01-01',1,1,1);



INSERT INTO `matriculacion` (`mat_id`,`daca_id`,`adm_id`,`est_id`,`sins_id`, `mat_fecha_matriculacion`, `mat_usuario_ingreso`,`mat_estado`,`mat_estado_logico`) VALUES 
(1,1,1,null,1,'2018-01-01',1,1,1);











 


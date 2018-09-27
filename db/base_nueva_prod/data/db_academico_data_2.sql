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
-- Volcado de datos para la tabla `periodo_academico_met_ingreso`
--

INSERT INTO `periodo_academico_met_ingreso` (`pami_id`, `mes_id_academico`, `pami_fecha_inicio`, `pami_fecha_fin`, `pami_codigo`, `pami_usuario_ingreso`, `pami_estado`, `pami_estado_logico`) VALUES
(1, 1, '2018-01-01', '2018-01-31', 'CAN012018', 1, '1', '1'), 
(2, 2, '2018-02-01', '2018-02-28', 'CAN022018', 1, '1', '1'), 
(3, 3, '2018-03-01', '2018-03-31', 'CAN032018', 1, '1', '1'), 
(4, 4, '2018-04-01', '2018-04-30', 'CAN042018', 1, '1', '1'), 
(5, 5, '2018-05-01', '2018-05-31', 'CAN052018', 1, '1', '1'), 
(6, 6, '2018-06-01', '2018-06-30', 'CAN062018', 1, '1', '1'), 
(7, 7, '2018-07-01', '2018-07-31', 'CAN072018', 1, '1', '1'),
(8, 8, '2018-08-01', '2018-08-31', 'CAN082018', 1, '1', '1'),
(9, 9, '2018-09-01', '2018-09-30', 'CAN092018', 1, '1', '1'),
(10, 10, '2018-10-01', '2018-10-31', 'CAN102018', 1, '1', '1');

-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `paralelo`
--

INSERT INTO `paralelo` (`par_id`,`paca_id`, `pami_id`, `par_nombre`, `par_descripcion`, `par_usuario_ingreso`, `par_usuario_modifica`, `par_estado`, `par_estado_logico`) VALUES 
(1,'1', null, '0001', '0001', '1', '1', '1', '1'),
(2,'2', null, '0001', '0001', '1', '1', '1', '1'),
(3,'3', null, '0001', '0001', '1', '1', '1', '1'),
(4,'4', null, '0001', '0001', '1', '1', '1', '1'),
(5,'5', null, '0001', '0001', '1', '1', '1', '1'),
(6,'6', null, '0001', '0001', '1', '1', '1', '1'),
(7,'7', null, '0001', '0001', '1', '1', '1', '1'),
(8,'8', null, '0001', '0001', '1', '1', '1', '1'),

(9, NULL, 8, '0001', '0001', 1, 1, '1', '1'),
(10, NULL, 9, '0001', '0001', 1, 1, '1', '1'),
(11, NULL, 10, '0001', '0001', 1, 1, '1', '1');


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
-- online 
(1,1,1,1,'Curso de Admisión y Nivelación - Licenciatura en Comercio Exterior','2018-07-01','2018-09-30',1,1,1),
(2,2,1,1,'Curso de Admisión y Nivelación - Economía','2018-07-01','2018-09-30',1,1,1),
(3,3,1,1,'Curso de Admisión y Nivelación - Licenciatura en Finanzas','2018-07-01','2018-09-30',1,1,1),
(4,4,1,1,'Curso de Admisión y Nivelación - Licenciatura en Mercadotecnia','2018-07-01','2018-09-30',1,1,1),
(5,5,1,1,'Curso de Admisión y Nivelación - Licenciatura en Turismo','2018-07-01','2018-09-30',1,1,1),
(6,6,1,1,'Curso de Admisión y Nivelación - Licenciatura en Administración de Empresas','2018-07-01','2018-09-30',1,1,1),

-- presencial

(7,11,1,2,'Curso de Admisión y Nivelación - Ingenieria en Logística y Transporte','2018-07-01','2018-09-30',1,1,1),
(8,8,1,2,'Curso de Admisión y Nivelación - Ingenieria en Telecomunicaciones' ,'2018-07-01','2018-09-30',1,1,1),
(9,7,1,2,'Curso de Admisión y Nivelación - Ingenieria en Software','2018-07-01','2018-09-30',1,1,1),
(10,10,1,2,'Curso de Admisión y Nivelación - Ingenieria en Tecnologias de la Información','2018-07-01','2018-09-30',1,1,1),
(11,1,1,2,'Curso de Admisión y Nivelación - Licenciatura en Comercio Exterior','2018-07-01','2018-09-30',1,1,1),
(12,5,1,2,'Curso de Admisión y Nivelación - Licenciatura en Turismo','2018-07-01','2018-09-30',1,1,1),
(13,3,1,2,'Curso de Admisión y Nivelación - Licenciatura en Finanzas','2018-07-01','2018-09-30',1,1,1),
(14,9,1,2,'Curso de Admisión y Nivelación - Licenciatura en Contabilidad y Auditoria','2018-07-01','2018-09-30',1,1,1),
(15,13,1,2,'Curso de Admisión y Nivelación - Licenciatura en Gestión y Talento Humano','2018-07-01','2018-09-30',1,1,1),
(16,6,1,2,'Curso de Admisión y Nivelación - Licenciatura en Administracion de Empresas','2018-07-01','2018-09-30',1,1,1),
(17,4,1,2,'Curso de Admisión y Nivelación - Licenciatura en Mercadotecnia','2018-07-01','2018-09-30',1,1,1),
(18,14,1,2,'Curso de Admisión y Nivelación - Licenciatura en Administración Portuaria y Aduanera','2018-07-01','2018-09-30',1,1,1),

-- Semipresencial

(19,12,1,3,'Curso de Admisión y Nivelación - Licenciatura en Comunicación','2018-07-01','2018-09-30',1,1,1),
(20,15,2,3,'Curso de Admisión y Nivelación - Administración de Empresas','2018-07-01','2018-09-30',1,1,1),
(21,15,2,3,'Curso de Admisión y Nivelación - Administración de Empresas','2018-07-01','2018-09-30',1,1,1),
(22,16,2,3,'Curso de Admisión y Nivelación - Finanzas','2018-07-01','2018-09-30',1,1,1),
(23,17,2,3,'Curso de Admisión y Nivelación - Marketing','2018-07-01','2018-09-30',1,1,1),
(24,18,2,3,'Curso de Admisión y Nivelación - Sistema de Información Gerencial','2018-07-01','2018-09-30',1,1,1),
(25,19,2,3,'Curso de Admisión y Nivelación - Turismo','2018-07-01','2018-09-30',1,1,1),
(26,20,2,3,'Curso de Admisión y Nivelación -  sdfdsfd','2018-07-01','2018-09-30',1,1,1),
(27,21,2,3,'Curso de Admisión y Nivelación - Licenciatura','2018-07-01','2018-09-30',1,1,1),
(28,22,2,3,'Curso de Admisión y Nivelación - Licenciatura','2018-07-01','2018-09-30',1,1,1),

-- Distancia

(29,1,1,4,'Curso de Admisión y Niveación-Licenciatura','2018-07-01','2018-09-30',1,1,1),
(30,3,1,4,'Curso de Admisión y Niveación-Licenciatura','2018-07-01','2018-09-30',1,1,1),
(31,4,1,4,'Curso de Admisión y Niveación-Licenciatura','2018-07-01','2018-09-30',1,1,1),
(32,6,1,4,'Curso de Admisión y Niveación-Licenciatura','2018-07-01','2018-09-30',1,1,1),
(33,9,1,4,'Curso de Admisión y Niveación-Licenciatura','2018-07-01','2018-09-30',1,1,1),
(34,13,1,4,'Curso de Admisión y Niveación-Licenciatura','2018-07-01','2018-09-30',1,1,1);


INSERT INTO `malla_academica_detalle` (`made_id`,`maca_id`,`asi_id`,`uest_id`,`nest_id`,`fmac_id`,`made_codigo_asignatura`,`made_usuario_ingreso`,`made_estado`,`made_estado_logico`) VALUES 
-- -----------------------
-- licenciatura
-- -----------------------
(1,1,1,1,1,6,'',1,1,1),
(2,1,2,1,1,6,'',1,1,1),
(3,1,3,1,1,6,'',1,1,1),
(4,1,4,1,1,6,'',1,1,1),
(5,1,5,1,1,6,'',1,1,1);
-- (90,22,5,1,1,6,'',1,1,1),
-- -----------------------
-- -- ingenieria
-- -----------------------
-- (6,1,1,1,1,6,'',1,1,1),
-- (7,1,2,1,1,6,'',1,1,1),
-- (8,1,3,1,1,6,'',1,1,1),
-- (9,1,4,1,1,6,'',1,1,1),
-- (10,1,5,1,1,6,'',1,1,1);

INSERT INTO `planificacion_estudio_academico` (`peac_id`,`uaca_id`,`pami_id`,`mod_id`,`paca_id`, `maca_id`, `peac_usuario_ingreso`,`peac_estado`,`peac_estado_logico`) VALUES 
(1,1,null,1,1,1,1,1,1),

(2,1,9,1,null, 1,1,'1','1'),
(3,1,9,1,null, 2,1,'1','1'),
(4,1,9,1,null, 3,1,'1','1'),
(5,1,9,1,null, 4,1,'1','1'),
(6,1,9,1,null, 5,1,'1','1'),
(7,1,9,1,null, 6,1,'1','1'),
(8,1,9,1,null, 7,1,'1','1'),
(9,1,9,1,null, 8,1,'1','1'),
(10,1,9,1,null, 9,1,'1','1'),
(11,1,9,1,null, 10,1,'1','1'),
(12,1,9,1,null, 11,1,'1','1'),
(13,1,9,1,null, 12,1,'1','1'),
(14,1,9,1,null, 13,1,'1','1'),
(15,1,9,1,null, 14,1,'1','1'),
(16,1,9,1,null, 15,1,'1','1'),
(17,1,9,1,null, 16,1,'1','1'),
(18,1,9,1,null, 17,1,'1','1'),
(19,1,9,1,null, 18,1,'1','1'),
(20,1,9,1,null, 19,1,'1','1'),
(21,1,9,1,null, 20,1,'1','1'),
(22,1,9,1,null, 21,1,'1','1'),
(23,1,9,1,null, 22,1,'1','1'), 

(24,1,10,1,null, 1,1,'1','1'),
(25,1,10,1,null, 2,1,'1','1'),
(26,1,10,1,null, 3,1,'1','1'),
(27,1,10,1,null, 4,1,'1','1'),
(28,1,10,1,null, 5,1,'1','1'),
(29,1,10,1,null, 6,1,'1','1'),
(30,1,10,1,null, 7,1,'1','1'),
(31,1,10,1,null, 8,1,'1','1'),
(32,1,10,1,null, 9,1,'1','1'),
(33,1,10,1,null, 10,1,'1','1'),
(34,1,10,1,null, 11,1,'1','1'),
(35,1,10,1,null, 12,1,'1','1'),
(36,1,10,1,null, 13,1,'1','1'),
(37,1,10,1,null, 14,1,'1','1'),
(38,1,10,1,null, 15,1,'1','1'),
(39,1,10,1,null, 16,1,'1','1'),
(40,1,10,1,null, 17,1,'1','1'),
(41,1,10,1,null, 18,1,'1','1'),
(42,1,10,1,null, 19,1,'1','1'),
(43,1,10,1,null, 20,1,'1','1'),
(44,1,10,1,null, 21,1,'1','1'),
(45,1,10,1,null, 22,1,'1','1');


INSERT INTO `distributivo_horario` (`dhor_id`,`dia_id`,`dhor_hora_inicio`,`dhor_hora_fin`, `dhor_usuario_ingreso`,`dhor_estado`,`dhor_estado_logico`) VALUES 
(1,1,'07:00','13:00',1,1,1);


INSERT INTO `distributivo_academico` (`daca_id`,`peac_id`,`pro_id`,`dhor_id`, `daca_fecha_registro`, `daca_usuario_ingreso`,`daca_estado`,`daca_estado_logico`) VALUES 
(1,1,1,1,'2018-01-01',1,1,1);










 


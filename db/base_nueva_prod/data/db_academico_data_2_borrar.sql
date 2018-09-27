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
(1,2,1,1,1,6,'',1,1,1),
(2,2,2,1,1,6,'',1,1,1),
(3,2,3,1,1,6,'',1,1,1),
(4,2,4,1,1,6,'',1,1,1),
(5,2,5,1,1,6,'',1,1,1),
-- -----------------------
-- Licenciatura en Finanzas - online
-- -----------------------
(1,3,1,1,1,6,'',1,1,1),
(2,3,2,1,1,6,'',1,1,1),
(3,3,3,1,1,6,'',1,1,1),
(4,3,4,1,1,6,'',1,1,1),
(5,3,5,1,1,6,'',1,1,1),
-- -----------------------
-- Licenciatura en Mercadotecnia - online
-- -----------------------
(1,4,1,1,1,6,'',1,1,1),
(2,4,2,1,1,6,'',1,1,1),
(3,4,3,1,1,6,'',1,1,1),
(4,4,4,1,1,6,'',1,1,1),
(5,4,5,1,1,6,'',1,1,1),
-- -----------------------
-- Licenciatura en Turismo - online
-- -----------------------
(1,5,1,1,1,6,'',1,1,1),
(2,5,2,1,1,6,'',1,1,1),
(3,5,3,1,1,6,'',1,1,1),
(4,5,4,1,1,6,'',1,1,1),
(5,5,5,1,1,6,'',1,1,1),
-- -----------------------
-- Licenciatura en Administración de Empresas - online
-- -----------------------
(1,6,1,1,1,6,'',1,1,1),
(2,6,2,1,1,6,'',1,1,1),
(3,6,3,1,1,6,'',1,1,1),
(4,6,4,1,1,6,'',1,1,1),
(5,6,5,1,1,6,'',1,1,1),
-- -----------------------
-- Ingenieria en Logística y Transporte - presencial
-- -----------------------
(1,7,1,1,1,6,'',1,1,1),
(2,7,2,1,1,6,'',1,1,1),
(3,7,3,1,1,6,'',1,1,1),
(4,7,4,1,1,6,'',1,1,1),
(5,7,5,1,1,6,'',1,1,1),
- -----------------------
-- Ingenieria en Telecomunicaciones - presencial
-- -----------------------
(1,8,1,1,1,6,'',1,1,1),
(2,8,2,1,1,6,'',1,1,1),
(3,8,3,1,1,6,'',1,1,1),
(4,8,4,1,1,6,'',1,1,1),
(5,8,5,1,1,6,'',1,1,1),
- -----------------------
-- Ingenieria en Software - presencial
-- -----------------------
(1,9,1,1,1,6,'',1,1,1),
(2,9,2,1,1,6,'',1,1,1),
(3,9,3,1,1,6,'',1,1,1),
(4,9,4,1,1,6,'',1,1,1),
(5,9,5,1,1,6,'',1,1,1),
- -----------------------
-- Ingenieria en Tecnologias de la Información - presencial
-- -----------------------
(1,10,1,1,1,6,'',1,1,1),
(2,10,2,1,1,6,'',1,1,1),
(3,10,3,1,1,6,'',1,1,1),
(4,10,4,1,1,6,'',1,1,1),
(5,10,5,1,1,6,'',1,1,1),
- -----------------------
-- Licenciatura en Comercio Exterior - presencial
-- -----------------------
(1,11,1,1,1,6,'',1,1,1),
(2,11,2,1,1,6,'',1,1,1),
(3,11,3,1,1,6,'',1,1,1),
(4,11,4,1,1,6,'',1,1,1),
(5,11,5,1,1,6,'',1,1,1),
- -----------------------
-- Licenciatura en Turismo - presencial
-- -----------------------
(1,12,1,1,1,6,'',1,1,1),
(2,12,2,1,1,6,'',1,1,1),
(3,12,3,1,1,6,'',1,1,1),
(4,12,4,1,1,6,'',1,1,1),
(5,12,5,1,1,6,'',1,1,1),
- -----------------------
-- Licenciatura en Finanzas - presencial
-- -----------------------
(1,13,1,1,1,6,'',1,1,1),
(2,13,2,1,1,6,'',1,1,1),
(3,13,3,1,1,6,'',1,1,1),
(4,13,4,1,1,6,'',1,1,1),
(5,13,5,1,1,6,'',1,1,1),
- -----------------------
-- Licenciatura en Contabilidad y Auditoria - presencial
-- -----------------------
(1,14,1,1,1,6,'',1,1,1),
(2,14,2,1,1,6,'',1,1,1),
(3,14,3,1,1,6,'',1,1,1),
(4,14,4,1,1,6,'',1,1,1),
(5,14,5,1,1,6,'',1,1,1),
- -----------------------
-- Licenciatura en Gestión y Talento Humano - presencial
-- -----------------------
(1,15,1,1,1,6,'',1,1,1),
(2,15,2,1,1,6,'',1,1,1),
(3,15,3,1,1,6,'',1,1,1),
(4,15,4,1,1,6,'',1,1,1),
(5,15,5,1,1,6,'',1,1,1),
- -----------------------
-- Licenciatura en Administración de Empresas - presencial
-- -----------------------
(1,16,1,1,1,6,'',1,1,1),
(2,16,2,1,1,6,'',1,1,1),
(3,16,3,1,1,6,'',1,1,1),
(4,16,4,1,1,6,'',1,1,1),
(5,16,5,1,1,6,'',1,1,1),
- -----------------------
-- Licenciatura en Mercadotecnia - presencial
-- -----------------------
(1,17,1,1,1,6,'',1,1,1),
(2,17,2,1,1,6,'',1,1,1),
(3,17,3,1,1,6,'',1,1,1),
(4,17,4,1,1,6,'',1,1,1),
(5,17,5,1,1,6,'',1,1,1),
- -----------------------
-- Licenciatura en Administración Portuaria y Aduanera - presencial
-- -----------------------
(1,18,1,1,1,6,'',1,1,1),
(2,18,2,1,1,6,'',1,1,1),
(3,18,3,1,1,6,'',1,1,1),
(4,18,4,1,1,6,'',1,1,1),
(5,18,5,1,1,6,'',1,1,1),
- -----------------------
-- Licenciatura en Comunicación - semipresencial
-- -----------------------
(1,19,1,1,1,6,'',1,1,1),
(2,19,2,1,1,6,'',1,1,1),
(3,19,3,1,1,6,'',1,1,1),
(4,19,4,1,1,6,'',1,1,1),
(5,19,5,1,1,6,'',1,1,1),
- -----------------------
-- Administración de Empresas - semipresencial
-- -----------------------
(1,20,1,1,1,6,'',1,1,1),
(2,20,2,1,1,6,'',1,1,1),
(3,20,3,1,1,6,'',1,1,1),
(4,20,4,1,1,6,'',1,1,1),
(5,20,5,1,1,6,'',1,1,1),
- -----------------------
-- Finanzas - semipresencial
-- -----------------------
(1,21,1,1,1,6,'',1,1,1),
(2,21,2,1,1,6,'',1,1,1),
(3,21,3,1,1,6,'',1,1,1),
(4,21,4,1,1,6,'',1,1,1),
(5,21,5,1,1,6,'',1,1,1),
- -----------------------
-- Marketing - semipresencial
-- -----------------------
(1,22,1,1,1,6,'',1,1,1),
(2,22,2,1,1,6,'',1,1,1),
(3,22,3,1,1,6,'',1,1,1),
(4,22,4,1,1,6,'',1,1,1),
(5,22,5,1,1,6,'',1,1,1),
- -----------------------
-- Sistema de Información Gerencial - semipresencial
-- -----------------------
(1,23,1,1,1,6,'',1,1,1),
(2,23,2,1,1,6,'',1,1,1),
(3,23,3,1,1,6,'',1,1,1),
(4,23,4,1,1,6,'',1,1,1),
(5,23,5,1,1,6,'',1,1,1),
- -----------------------
-- Turismo - semipresencial
-- -----------------------
(1,24,1,1,1,6,'',1,1,1),
(2,24,2,1,1,6,'',1,1,1),
(3,24,3,1,1,6,'',1,1,1),
(4,24,4,1,1,6,'',1,1,1),
(5,24,5,1,1,6,'',1,1,1),
- -----------------------
-- Talento Humano - semipresencial
-- -----------------------
(1,25,1,1,1,6,'',1,1,1),
(2,25,2,1,1,6,'',1,1,1),
(3,25,3,1,1,6,'',1,1,1),
(4,25,4,1,1,6,'',1,1,1),
(5,25,5,1,1,6,'',1,1,1),
- -----------------------
-- Empresas Familiares - semipresencial
-- -----------------------
(1,26,1,1,1,6,'',1,1,1),
(2,26,2,1,1,6,'',1,1,1),
(3,26,3,1,1,6,'',1,1,1),
(4,26,4,1,1,6,'',1,1,1),
(5,26,5,1,1,6,'',1,1,1),
- -----------------------
-- Investigación - semipresencial
-- -----------------------
(1,27,1,1,1,6,'',1,1,1),
(2,27,2,1,1,6,'',1,1,1),
(3,27,3,1,1,6,'',1,1,1),
(4,27,4,1,1,6,'',1,1,1),
(5,27,5,1,1,6,'',1,1,1),
- -----------------------
-- Licenciatura en Comercio Exterior - distancia
-- -----------------------
(1,28,1,1,1,6,'',1,1,1),
(2,28,2,1,1,6,'',1,1,1),
(3,28,3,1,1,6,'',1,1,1),
(4,28,4,1,1,6,'',1,1,1),
(5,28,5,1,1,6,'',1,1,1),
- -----------------------
-- Licenciatura en Finanzas - distancia
-- -----------------------
(1,29,1,1,1,6,'',1,1,1),
(2,29,2,1,1,6,'',1,1,1),
(3,29,3,1,1,6,'',1,1,1),
(4,29,4,1,1,6,'',1,1,1),
(5,29,5,1,1,6,'',1,1,1),
- -----------------------
-- Licenciatura en Mercadotecnia - distancia
-- -----------------------
(1,30,1,1,1,6,'',1,1,1),
(2,30,2,1,1,6,'',1,1,1),
(3,30,3,1,1,6,'',1,1,1),
(4,30,4,1,1,6,'',1,1,1),
(5,30,5,1,1,6,'',1,1,1),
- -----------------------
-- Licenciatura en Administración de Empresas - distancia
-- -----------------------
(1,31,1,1,1,6,'',1,1,1),
(2,31,2,1,1,6,'',1,1,1),
(3,31,3,1,1,6,'',1,1,1),
(4,31,4,1,1,6,'',1,1,1),
(5,31,5,1,1,6,'',1,1,1),
- -----------------------
-- Licenciatura en Contabilidad y Auditoria - distancia
-- -----------------------
(1,32,1,1,1,6,'',1,1,1),
(2,32,2,1,1,6,'',1,1,1),
(3,32,3,1,1,6,'',1,1,1),
(4,32,4,1,1,6,'',1,1,1),
(5,32,5,1,1,6,'',1,1,1),
- -----------------------
-- Licenciatura en Gestión y Talento Humano - distancia
-- -----------------------
(1,33,1,1,1,6,'',1,1,1),
(2,33,2,1,1,6,'',1,1,1),
(3,33,3,1,1,6,'',1,1,1),
(4,33,4,1,1,6,'',1,1,1),
(5,33,5,1,1,6,'',1,1,1),
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










 


--
-- Base de datos: `db_repositorio`
--
USE `db_repositorio`;
-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `categoria_repositorio	`
--
INSERT INTO `categoria_repositorio` (`crep_id`,`crep_codificacion`,`crep_nombre`,`crep_descripcion`,`crep_usuario_ingreso`,`crep_usuario_modifica`,`crep_estado`,`crep_fecha_creacion`,`crep_fecha_modificacion`,`crep_estado_logico`) VALUES
(1,'doc-oooo','Docencia','Docencia',1,null,'1','2019-07-08 12:30:00',null,'1'),
(2,'inv-oooo','Investigación','Investigación',1,null,'1','2019-07-08 12:30:00',null,'1'),
(3,'vin-oooo','Vinculación con la Sociedad','Vinculación con la Sociedad',1,null,'1','2019-07-08 12:30:00',null,'1'),
(4,'con-oooo','Condiciones Institucionales','Condiciones Institucionales',1,null,'1','2019-07-08 12:30:00',null,'1'),
(5,'ele-oooo','Elementos Proyectivos','Elementos Proyectivos',1,null,'1','2019-07-08 12:30:00',null,'1');

-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `nivel_repositorio	`
--
INSERT INTO `nivel_repositorio` (`nrep_id`,`nrep_codificacion`,`nrep_nombre`,`nrep_descripcion`,`nrep_usuario_ingreso`,`nrep_usuario_modifica`,`nrep_estado`,`nrep_fecha_creacion`,`nrep_fecha_modificacion`,`nrep_estado_logico`) VALUES
(1,'com-oooo','Componente','Componente',1,null,'1','2019-07-08 12:30:00',null,'1'),
(2,'dim-oooo','Dimensión','Dimensión',1,null,'1','2019-07-08 12:30:00',null,'1'),
(3,'est-oooo','Estándar','Estándar',1,null,'1','2019-07-08 12:30:00',null,'1');

-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `categoria_nivel	`
--
INSERT INTO `categoria_nivel` (`cniv_id`,`crep_id`,`nrep_id`,`cniv_usuario_ingreso`,`cniv_usuario_modifica`,`cniv_estado`,`cniv_fecha_creacion`,`cniv_fecha_modificacion`,`cniv_estado_logico`
) VALUES
(1,1,1,1,null,'1','2019-07-08 12:30:00',null,'1'),
(2,1,2,1,null,'1','2019-07-08 12:30:00',null,'1'),
(3,1,3,1,null,'1','2019-07-08 12:30:00',null,'1'),
(4,2,2,1,null,'1','2019-07-08 12:30:00',null,'1'),
(5,2,3,1,null,'1','2019-07-08 12:30:00',null,'1'),
(6,3,2,1,null,'1','2019-07-08 12:30:00',null,'1'),
(7,3,3,1,null,'1','2019-07-08 12:30:00',null,'1'),
(8,4,1,1,null,'1','2019-07-08 12:30:00',null,'1'),
(9,4,3,1,null,'1','2019-07-08 12:30:00',null,'1'),
(10,5,1,1,null,'1','2019-07-08 12:30:00',null,'1'),
(11,5,3,1,null,'1','2019-07-08 12:30:00',null,'1');

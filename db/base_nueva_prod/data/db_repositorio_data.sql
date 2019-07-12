--
-- Base de datos: `db_repositorio`
--
USE `db_repositorio`;
-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `modelo`
--
INSERT INTO `modelo` (`mod_id`,`mod_codificacion`,`mod_nombre`,`mod_descripcion`, `mod_usuario_ingreso`,`mod_usuario_modifica`, `mod_estado`,`mod_fecha_creacion`,`mod_fecha_modificacion`,`mod_estado_logico`) VALUES
(1,null,'General','General',1,null,'1','2019-07-12 12:00:00',null,'1'),
(2,null,'Acreditacion','Acreditacion',1,null,'1','2019-07-12 12:00:00',null,'1');
-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `funcion`
--
INSERT INTO `funcion` (`fun_id`,`mod_id`,`fun_codificacion`,`fun_nombre`,`fun_descripcion`,`fun_usuario_ingreso`,`fun_usuario_modifica`,`fun_estado`,`fun_fecha_creacion`,`fun_fecha_modificacion`,`fun_estado_logico`) VALUES
(1,2,'doc-oooo','Docencia','Docencia',1,null,'1','2019-07-08 12:30:00',null,'1'),
(2,2,'inv-oooo','Investigacion','Investigacion',1,null,'1','2019-07-08 12:30:00',null,'1'),
(3,2,'vin-oooo','Vinculacion con la Sociedad','Vinculacion con la Sociedad',1,null,'1','2019-07-08 12:30:00',null,'1'),
(4,2,'con-oooo','Condiciones Institucionales','Condiciones Institucionales',1,null,'1','2019-07-08 12:30:00',null,'1'),
(5,2,'ele-oooo','Elementos Proyectivos','Elementos Proyectivos',1,null,'1','2019-07-08 12:30:00',null,'1');

-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `componente`
--
INSERT INTO `componente` (`com_id`,`com_codificacion`, `com_nombre`,`com_descripcion`,`com_usuario_ingreso`,`com_usuario_modifica`,`com_estado`,`com_fecha_creacion`,`com_fecha_modificacion`,`com_estado_logico`) VALUES
(1,'pro-oooo','Profesorado','Profesorado',1,null,'1','2019-07-08 12:30:00',null,'1'),
(2,'est-oooo','Estudiantado','Estudiantado',1,null,'1','2019-07-08 12:30:00',null,'1'),
(3,'plan-oooo','Planificacion Estrategica y Operativa','Planificacion Estrategica y Operativa',1,null,'1','2019-07-08 12:30:00',null,'1'),
(4,'inf-oooo','Infraestructura y Equipamiento','Infraestructura y Equipamiento',1,null,'1','2019-07-08 12:30:00',null,'1'),
(5,'bli-oooo','Bibliotecas','Bibliotecas',1,null,'1','2019-07-08 12:30:00',null,'1'),
(6,'ges-oooo','Gestion Interna y Calidad','Gestion Interna y Calidad',1,null,'1','2019-07-08 12:30:00',null,'1'),
(7,'bie-oooo','Bienestar Estudiantil y Universitario','Bienestar Estudiantil y Universitario',1,null,'1','2019-07-08 12:30:00',null,'1'),
(8,'igu-oooo','Igualdad de Oportunidades','Igualdad de Oportunidades',1,null,'1','2019-07-08 12:30:00',null,'1'),
(9,'art-oooo','Articulacion y sinergias entre funciones sustantivas y entre disciplinas','Articulacion y sinergias entre funciones sustantivas y entre disciplinas',1,null,'1','2019-07-08 12:30:00',null,'1'),
(10,'uso-oooo','Uso social del conocimiento','Uso social del conocimiento',1,null,'1','2019-07-08 12:30:00',null,'1'),
(11,'inn-oooo','Innovacion','Innovacion',1,null,'1','2019-07-08 12:30:00',null,'1'),
(12,'int-oooo','Internacionalizacion','Internacionalizacion',1,null,'1','2019-07-08 12:30:00',null,'1'),
(13,'bie-oooo','Bienestar universitario','Bienestar universitario',1,null,'1','2019-07-08 12:30:00',null,'1'),
(14,'inc-oooo','Inclusion y equidad','Inclusion y equidad',1,null,'1','2019-07-08 12:30:00',null,'1'),
(15,'ine-oooo','Interculturalidad, integracion de la diversidad y dialogo de saberes','Interculturalidad, integracion de la diversidad y dialogo de saberes',1,null,'1','2019-07-08 12:30:00',null,'1');

-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `estandar`
--
INSERT INTO `estandar` (`est_id`,`com_id`, `fun_id`,`est_codificacion`,`est_nombre`,`est_descripcion`,`est_usuario_ingreso`,`est_usuario_modifica`, `est_estado`,`est_fecha_creacion`,`est_fecha_modificacion`,`est_estado_logico`) VALUES
(1,1,1,null,'Estándar 1','Estándar 1',1,null,1,'2019-07-08 12:30:00',null,'1'),
(2,1,1,null,'Estándar 2','Estándar 2',1,null,1,'2019-07-08 12:30:00',null,'1'),
(3,1,1,null,'Estándar 3A','Estándar 3A',1,null,1,'2019-07-08 12:30:00',null,'1'),
(4,1,1,null,'Estándar 3B','Estándar 3B',1,null,1,'2019-07-08 12:30:00',null,'1'),
(5,1,1,null,'Estándar 4A','Estándar 4A',1,null,1,'2019-07-08 12:30:00',null,'1'),

(6,2,1,null,'Estándar 5','Estándar 5',1,null,1,'2019-07-08 12:30:00',null,'1'),
(7,2,1,null,'Estándar 6','Estándar 6',1,null,1,'2019-07-08 12:30:00',null,'1'),
(8,2,1,null,'Estándar 7','Estándar 7',1,null,1,'2019-07-08 12:30:00',null,'1'),

(9,null,2,null,'Estándar 8','Estándar 8',1,null,1,'2019-07-08 12:30:00',null,'1'),
(10,null,2,null,'Estándar 9','Estándar 9',1,null,1,'2019-07-08 12:30:00',null,'1'),
(11,null,2,null,'Estándar 10','Estándar 10',1,null,1,'2019-07-08 12:30:00',null,'1'),
(12,null,2,null,'Estándar 11','Estándar 11',1,null,1,'2019-07-08 12:30:00',null,'1'),

(13,null,3,null,'Estándar 12','Estándar 12',1,null,1,'2019-07-08 12:30:00',null,'1'),
(14,null,3,null,'Estándar 13','Estándar 13',1,null,1,'2019-07-08 12:30:00',null,'1'),
(15,null,3,null,'Estándar 14','Estándar 14',1,null,1,'2019-07-08 12:30:00',null,'1'),

(16,3,4,null,'Estándar 15','Estándar 15',1,null,1,'2019-07-08 12:30:00',null,'1'),
(17,4,4,null,'Estándar 16','Estándar 16',1,null,1,'2019-07-08 12:30:00',null,'1'),
(18,5,4,null,'Estándar 17','Estándar 17',1,null,1,'2019-07-08 12:30:00',null,'1'),
(19,6,4,null,'Estándar 18','Estándar 18',1,null,1,'2019-07-08 12:30:00',null,'1'),
(20,7,4,null,'Estándar 19','Estándar 19',1,null,1,'2019-07-08 12:30:00',null,'1'),
(21,8,4,null,'Estándar 20','Estándar 20',1,null,1,'2019-07-08 12:30:00',null,'1'),

(22,9,5,null,'Estándar A','Estándar A',1,null,1,'2019-07-08 12:30:00',null,'1'),
(23,10,5,null,'Estándar B','Estándar B',1,null,1,'2019-07-08 12:30:00',null,'1'),
(24,11,5,null,'Estándar C','Estándar C',1,null,1,'2019-07-08 12:30:00',null,'1'),
(25,12,5,null,'Estándar D','Estándar D',1,null,1,'2019-07-08 12:30:00',null,'1'),
(26,13,5,null,'Estándar E','Estándar E',1,null,1,'2019-07-08 12:30:00',null,'1'),
(27,14,5,null,'Estándar F','Estándar F',1,null,1,'2019-07-08 12:30:00',null,'1'),
(28,15,5,null,'Estándar F','Estándar F',1,null,1,'2019-07-08 12:30:00',null,'1');

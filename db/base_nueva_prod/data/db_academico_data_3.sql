--
-- Base de datos: `db_academico`
--
USE `db_academico`;

-- -- ------------------------ ------------------------------
--
-- Volcado de datos para la tabla `tipo_evaluacion`
-- 
INSERT INTO `tipo_evaluacion` (`teva_id`, `teva_nombre`,  `teva_estado`, `teva_estado_logico`) VALUES 
(1, 'Docencia', '1', '1'),
(2, 'Investigación', '1', '1'),
(3, 'Dirección y Gestión Académica', '1', '1');

-- -- ------------------------ ------------------------------
--
-- Volcado de datos para la tabla `tipo_distributivo`
-- 
INSERT INTO `tipo_distributivo` (`tdis_id`, `tdis_nombre`, `tdis_estado`, `tdis_estado_logico`) VALUES
(1, 'Docencia', '1', '1'),
(2, 'Tutorías', '1', '1'),
(3, 'Investigación', '1', '1'),
(4, 'Vinculación', '1', '1'),
(5, 'Administrativas', '1', '1'),
(6, 'Otras Actividades', '1', '1');

-- -- ------------------------ ------------------------------
--
-- Volcado de datos para la tabla `actividad_evaluacion`
-- -- ------------------------ ------------------------------
INSERT INTO `actividad_evaluacion` (`aeva_id`, `aeva_descripcion`, `aeva_nombre`, `aeva_estado`, `aeva_estado_logico`) VALUES
(1, 'Asistido por el docente', 'Asistido por el docente', '1', '1'),
(2, 'ABP', 'ABP', '1', '1'),
(3, 'ABI', 'ABI', '1', '1'),
(4, 'Trabajo colaborativo', 'Trabajo colaborativo', '1', '1'),
(5, 'Debates/Foros', 'Debates/Foros', '1', '1'),
(6, 'Análisis de casos', 'Análisis de casos', '1', '1'),
(7, 'Exposición de temas', 'Exposición de temas', '1', '1'),
(8, 'Talleres prácticos', 'Talleres prácticos', '1', '1'),
(9, 'Otros', 'Otros', '1', '1');

-- -- ------------------------ ------------------------------
--
-- Volcado de datos para la tabla `valor_desarrollo`
-- -- ------------------------ ------------------------------
INSERT INTO `valor_desarrollo` (`vdes_id`, `vdes_descripcion`, `vdes_nombre`, `vdes_estado`, `vdes_estado_logico`) VALUES
(1, 'Lealtad', 'Lealtad', '1', '1'),
(2, 'Compromiso', 'Compromiso', '1', '1'),
(3, 'Disciplina', 'Disciplina', '1', '1'),
(4, 'Solidaridad', 'Solidaridad', '1', '1'),
(5, 'Integridad', 'Integridad', '1', '1'),
(6, 'Puntualidad', 'Puntualidad', '1', '1'),
(7, 'Responsabilidad Social', 'Resp. Social', '1', '1'),
(8, 'Responsabilidad Ambiental', 'Resp. Ambiental', '1', '1'),
(9, 'Otros', 'Otros', '1', '1');


-- Especies Valoradas 
INSERT INTO `responsable_especie` (`resp_id`, `resp_nombre`, `resp_titulo`, `resp_cargo`, `uaca_id`, `mod_id`, `resp_usuario_ingreso`, `resp_estado`, `resp_estado_logico`) VALUES 
(1,'Diego Aguirre','Msc','',1,1,1,'1','1'),
(2,'Xavier Mosquera','Phd','',1,2,1,'1','1'),
(3,'Francisco Cedeño','Msc','',1,3,1,'1','1'),
(4,'Francisco Cedeño','Msc','',1,4,1,'1','1'),
(5,'Olmedo Farfán','Phd','',2,1,1,'1','1'),
(6,'Olmedo Farfán','Phd','',2,2,1,'1','1'),
(7,'Olmedo Farfán','Phd','',2,3,1,'1','1');


INSERT INTO `tramite` (`tra_id`, `uaca_id`, `tra_nombre`, `tra_nomenclatura`, `tra_descripcion`, `tra_usuario_ingreso`, `tra_estado`, `tra_estado_logico`) VALUES 
(1,1,'Académicos','ACA',null,1,'1','1'),
(2,1,'Graduación','GRA',null,1,'1','1'),
(3,1,'Secretaría General','SEC',null,1,'1','1'),
(4,1,'Financiero','FIN',null,1,'1','1'),
(5,2,'Académicos','ACA',null,1,'1','1'),
(6,2,'Graduación','GRA',null,1,'1','1'),
(7,2,'Examen Complexivo','EXA',null,1,'1','1'),
(8,2,'Secretaría General','SEC',null,1,'1','1'),
(9,2,'Financiero','FIN',null,1,'1','1');


INSERT INTO `especies` (`esp_id`,`tra_id`,`esp_codigo`,`esp_rubro`,`esp_valor`,`esp_emision_certificado`,`esp_departamento`,`esp_dia_vigencia`,`esp_numero`,`esp_usuario_ingreso`,`esp_usuario_modifica`,`esp_estado`,`esp_fecha_creacion`,`esp_fecha_modificacion`,`esp_estado_logico`) VALUES 
(1,1,1,'Exámenes supletorios',20.00,'NO','',30,'000000001',NULL,NULL,'1','2020-03-25 02:19:41',NULL,'1'),
(2,1,2,'Exámenes mejoramiento',20.00,'NO','',30,'000000001',NULL,NULL,'1','2020-03-25 02:24:10',NULL,'1'),
(3,1,3,'Exámenes atrasado',20.00,'NO','',30,'000000001',NULL,NULL,'1','2020-03-25 02:24:10',NULL,'1'),
(4,1,4,'Examen Adelantado',5.00,'NO','',30,'000000001',NULL,NULL,'1','2020-03-25 02:24:10',NULL,'1'),
(5,1,5,'Cambio de Carrera',20.00,'NO','',30,'000000001',NULL,NULL,'1','2020-03-25 02:24:10',NULL,'1'),
(6,1,6,'Cambio de Horario de materias',10.00,'NO','',30,'000000001',NULL,NULL,'1','2020-03-25 02:24:10',NULL,'1'),
(7,1,7,'Cambio de Paralelo',10.00,'NO','',30,'000000001',NULL,NULL,'1','2020-03-25 02:24:10',NULL,'1'),
(8,1,8,'Homologación por reingreso y cambio de malla antigua a vigente',120.00,'NO','',30,'000000001',NULL,NULL,'1','2020-03-25 02:24:10',NULL,'1'),
(9,1,9,'Cambio de Modalidad',20.00,'NO','',30,'000000001',NULL,NULL,'1','2020-03-25 02:24:10',NULL,'1'),
(10,1,10,'Certificado de asistencia/estudios simple',10.00,'SI','SECRETARIA GENERAL',30,'000000001',NULL,NULL,'1','2020-03-25 02:24:10',NULL,'1'),
(11,1,11,'Certificado de conducta',5.00,'SI','SECRETARIA GENERAL',30,'000000001',NULL,NULL,'1','2020-03-25 02:24:10',NULL,'1'),
(12,1,12,'Certificado de estudios para Consulados',20.00,'SI','SECRETARIA GENERAL',30,'000000001',NULL,NULL,'1','2020-03-25 02:24:10',NULL,'1'),
(13,1,13,'Certificado de materias aprobadas con notas/completo y/o IECE',50.00,'SI','SECRETARIA GENERAL/FACULTAD/FINANCIERO',30,'000000001',NULL,NULL,'1','2020-03-25 02:24:10',NULL,'1'),
(14,1,14,'Certificado de materias/módulos aprobados para IECE 2da vez',20.00,'SI','SECRETARIA GENERAL/FACULTAD/FINANCIERO',30,'000000001',NULL,NULL,'1','2020-03-25 02:24:10',NULL,'1'),
(15,1,15,'Certificado de matrícula',10.00,'SI','SECRETARIA GENERAL',30,'000000001',NULL,NULL,'1','2020-03-25 02:24:10',NULL,'1'),
(16,1,16,'Justificación de faltas',10.00,'NO','',30,'000000001',NULL,NULL,'1','2020-03-25 02:24:10',NULL,'1'),
(17,1,17,'Extensión del Trabajo de Titulación',20.00,'NO','',30,'000000001',NULL,NULL,'1','2020-03-25 02:24:10',NULL,'1'),
(18,1,18,'Promedio de Graduación',20.00,'SI','SECRETARIA GENERAL',30,'000000001',NULL,NULL,'1','2020-03-25 02:24:11',NULL,'1'),
(19,1,19,'Recalificación de examen',20.00,'NO','',30,'000000001',NULL,NULL,'1','2020-03-25 02:24:11',NULL,'1'),
(20,1,20,'Reingreso a colegiatura',20.00,'NO','',30,'000000001',NULL,NULL,'1','2020-03-25 02:24:11',NULL,'1'),
(21,1,21,'Resciliación de materias',10.00,'NO','',30,'000000001',NULL,NULL,'1','2020-03-25 02:24:11',NULL,'1'),
(22,1,22,'Cambio de materia',10.00,'NO','',30,'000000001',NULL,NULL,'1','2020-03-25 02:24:11',NULL,'1'),
(23,1,23,'Retiro de Universidad y Documentos',100.00,'SI','SECRETARIA GENERAL',30,'000000001',NULL,NULL,'1','2020-03-25 02:24:11',NULL,'1'),
(24,1,24,'Retiro de Universidad',10.00,'NO','',30,'000000001',NULL,NULL,'1','2020-03-25 02:24:11',NULL,'1'),
(25,1,25,'Solicitud de materia en Modular o Tutoría',10.00,'NO','',30,'000000001',NULL,NULL,'1','2020-03-25 02:24:11',NULL,'1'),
(26,1,26,'Solicitud de camibio de modalidad de Trabajo de Titulación',50.00,'NO','',30,'000000001',NULL,NULL,'1','2020-03-25 02:24:11',NULL,'1'),
(27,1,27,'Traducción de Documentos',30.00,'SI','SECRETARIA GENERAL',30,'000000001',NULL,NULL,'1','2020-03-25 02:24:11',NULL,'1'),
(28,1,28,'Extensión de Beca',10.00,'NO','BIENESTAR UNIVERSITARIO',30,'000000001',NULL,NULL,'1','2020-03-25 02:24:11',NULL,'1'),
(29,1,29,'Pensión Diferenciada',10.00,'NO','',30,'000000001',NULL,NULL,'1','2020-03-25 02:24:11',NULL,'1'),
(30,1,30,'Solicitud de Beca',10.00,'NO','',30,'000000001',NULL,NULL,'1','2020-03-25 02:24:11',NULL,'1'),
(31,1,31,'Solicitud de Inicio de Pasantías',5.00,'NO','',30,'000000001',NULL,NULL,'1','2020-03-25 02:24:11',NULL,'1'),
(32,1,32,'Solicitud de Finalización de Pasantías',5.00,'NO','',30,'000000001',NULL,NULL,'1','2020-03-25 02:24:11',NULL,'1'),
(33,1,33,'Solicitud de Inicio de Vinculación con la Sociedad',5.00,'NO','',30,'000000001',NULL,NULL,'1','2020-03-25 02:24:12',NULL,'1'),
(34,1,34,'Solicitud de Finalización de Vinculación con la Sociedad',5.00,'NO','',30,'000000001',NULL,NULL,'1','2020-03-25 02:24:12',NULL,'1'),
(35,1,35,'Emisión de carnets (segunda emisión)',5.00,'NO','BIENESTAR UNIVERSITARIO',30,'000000001',NULL,NULL,'1','2020-03-25 02:24:12',NULL,'1'),
(36,1,36,'Solicitud de cambio de Tema de Trabajo de Titulación',20.00,'NO','',30,'000000001',NULL,NULL,'1','2020-03-25 02:24:12',NULL,'1'),
(37,1,37,'Homologación',20.00,'NO','',30,'000000001',NULL,NULL,'1','2020-03-25 02:24:12',NULL,'1'),
(38,1,38,'Validación de Conocimientos',20.00,'NO','Materias aprobadas mayor a cinco años',30,'000000001',NULL,NULL,'1','2020-03-25 02:24:12',NULL,'1'),
(39,1,39,'Certificado de suficiencia de idioma extranjero',5.00,'SI','SECRETARIA GENERAL/RELACIONES INTERNACIONALES',30,'000000001',NULL,NULL,'1','2020-03-25 02:24:12',NULL,'1'),
(40,1,40,'Trámites Generales',10.00,'NO','',30,'000000001',NULL,NULL,'1','2020-03-25 02:24:12',NULL,'1'),
(41,2,1,'Certificado de haber culminado malla curricular',5.00,'SI','INTERNO',30,'000000001',NULL,NULL,'1','2020-03-25 02:24:12',NULL,'1'),
(42,2,2,'Solicitud para registrarse en Trabajo de Titulación',5.00,'SI','INTERNO',30,'000000001',NULL,NULL,'1','2020-03-25 02:24:12',NULL,'1'),
(43,2,3,'Solicitud para presentar Tema de Trabajo de Titulación',5.00,'SI','INTERNO',30,'000000001',NULL,NULL,'1','2020-03-25 02:24:12',NULL,'1'),
(44,2,4,'Solicitud de informe favorable del Trabajo de Titulación',5.00,'SI','INTERNO',30,'000000001',NULL,NULL,'1','2020-03-25 02:24:12',NULL,'1'),
(45,2,5,'Certificado de aprobación de segundo idioma',5.00,'SI','INTERNO',30,'000000001',NULL,NULL,'1','2020-03-25 02:24:12',NULL,'1'),
(46,2,6,'Certificado de no adeudar dinero a la UTEG',5.00,'SI','INTERNO',30,'000000001',NULL,NULL,'1','2020-03-25 02:24:12',NULL,'1'),
(47,2,7,'Certificado de no adeudar material bibliográfico de la UTEG',5.00,'SI','INTERNO',30,'000000001',NULL,NULL,'1','2020-03-25 02:24:12',NULL,'1'),
(48,2,8,'Certificado de haber cumplido las horas de vinculación',5.00,'SI','INTERNO',30,'000000001',NULL,NULL,'1','2020-03-25 02:24:12',NULL,'1'),
(49,2,9,'Certificado de haber cumplido con las prácticas  Pre-Profesionales',5.00,'SI','INTERNO',30,'000000001',NULL,NULL,'1','2020-03-25 02:24:12',NULL,'1'),
(50,2,10,'Constancia de haber entregado documentos actualizados',5.00,'SI','INTERNO',30,'000000001',NULL,NULL,'1','2020-03-25 02:24:12',NULL,'1'),
(51,2,11,'Certificado de Sistema de Similitud',30.00,'SI','INTERNO',30,'000000001',NULL,NULL,'1','2020-03-25 02:24:12',NULL,'1'),
(52,2,12,'Solicitud de entrega de ejemplares y conformación de tribunal',5.00,'SI','INTERNO',30,'000000001',NULL,NULL,'1','2020-03-25 02:24:12',NULL,'1'),
(53,2,13,'Constancia de haber entregado los ejemplares del trabajo de titulación empastados y CD',5.00,'SI','INTERNO',30,'000000001',NULL,NULL,'1','2020-03-25 02:24:12',NULL,'1'),
(54,2,14,'Constancia de haber cancelado alquiler de toga y birrete ',30.00,'SI','INTERNO',30,'000000001',NULL,NULL,'1','2020-03-25 02:24:12',NULL,'1'),
(55,2,15,'Constancia de haber entregado los formularios de Seguimiento de Graduados y Firma de Acta',5.00,'SI','INTERNO',30,'000000001',NULL,NULL,'1','2020-03-25 02:24:13',NULL,'1'),
(56,3,1,'Certificación de copia de Acta de Grado',30.00,'SI','SECRETARIA GENERAL',30,'000000001',NULL,NULL,'1','2020-03-25 02:24:13',NULL,'1'),
(57,3,2,'Certificación de copia de título',30.00,'SI','SECRETARIA GENERAL',30,'000000001',NULL,NULL,'1','2020-03-25 02:24:13',NULL,'1'),
(58,3,3,'Certificado de Graduado',30.00,'SI','SECRETARIA GENERAL',30,'000000001',NULL,NULL,'1','2020-03-25 02:24:13',NULL,'1'),
(59,3,4,'Certificado de notas y carga horaria Graduados',50.00,'SI','SECRETARIA GENERAL',30,'000000001',NULL,NULL,'1','2020-03-25 02:24:13',NULL,'1'),
(60,3,5,'Reposición de Título',210.00,'NO','',30,'000000001',NULL,NULL,'1','2020-03-25 02:24:13',NULL,'1'),
(61,3,6,'Certificado de Carrera válida para Maestría',30.00,'SI','SECRETARIA GENERAL',30,'000000001',NULL,NULL,'1','2020-03-25 02:24:13',NULL,'1'),
(62,3,7,'Reposición de Acta de Grado',100.00,'NO','',30,'000000001',NULL,NULL,'1','2020-03-25 02:24:13',NULL,'1'),
(63,3,8,'Certificado de Malla Curricular ',20.00,'SI','SECRETARIA GENERAL',30,'000000001',NULL,NULL,'1','2020-03-25 02:24:13',NULL,'1'),
(64,4,1,'Autorización para matricula extemporánea',10.00,'NO','INTERNO',30,'000000001',NULL,NULL,'1','2020-03-25 02:24:13',NULL,'1'),
(65,4,2,'Autorización de traspaso de saldo a favor',20.00,'NO','INTERNO',30,'000000001',NULL,NULL,'1','2020-03-25 02:24:13',NULL,'1'),
(66,4,3,'Condonación de Deuda',20.00,'NO','INTERNO',30,'000000001',NULL,NULL,'1','2020-03-25 02:24:13',NULL,'1'),
(67,4,4,'Devolución de valores',20.00,'NO','INTERNO',30,'000000001',NULL,NULL,'1','2020-03-25 02:24:13',NULL,'1'),
(68,4,5,'Prórroga de pagos',20.00,'NO','INTERNO',30,'000000001',NULL,NULL,'1','2020-03-25 02:24:13',NULL,'1'),
(69,5,1,'Cambio de cohorte',10.00,'NO','',30,'000000001',NULL,NULL,'1','2020-03-25 02:24:13',NULL,'1'),
(70,5,2,'Cambio de tema de tesis o investigación',5.00,'NO','',30,'000000001',NULL,NULL,'1','2020-03-25 02:24:13',NULL,'1'),
(71,5,3,'Cambio de tutor',20.00,'SI','FACULTAD',30,'000000001',NULL,NULL,'1','2020-03-25 02:24:13',NULL,'1'),
(72,5,4,'Certificado de culminación de malla curricular',10.00,'SI','SECRETARIA GENERAL',30,'000000001',NULL,NULL,'1','2020-03-25 02:24:13',NULL,'1'),
(73,5,5,'Certificado de estudios para Consulados',20.00,'SI','SECRETARIA GENERAL',30,'000000001',NULL,NULL,'1','2020-03-25 02:24:13',NULL,'1'),
(74,5,6,'Certificado de materias/módulos aprobados con notas completas y/o IECE',50.00,'SI','SECRETARIA GENERAL/FACULTAD/FINANCIER',30,'000000001',NULL,NULL,'1','2020-03-25 02:24:13',NULL,'1'),
(75,5,7,'Certificado de matrícula',5.00,'SI','SECRETARIA GENERAL',30,'000000001',NULL,NULL,'1','2020-03-25 02:24:13',NULL,'1'),
(76,5,8,'Certificado de Cronograma de estudios',5.00,'SI','SECRETARIA GENERAL',30,'000000001',NULL,NULL,'1','2020-03-25 02:24:13',NULL,'1'),
(77,5,9,'Entrega de anteproyecto de Tesis/ Investigación',10.00,'NO','',30,'000000001',NULL,NULL,'1','2020-03-25 02:24:13',NULL,'1'),
(78,5,10,'Entrega de Tesis/ Investigación',10.00,'NO','',30,'000000001',NULL,NULL,'1','2020-03-25 02:24:13',NULL,'1'),
(79,5,11,'Justificación de faltas',10.00,'NO','',30,'000000001',NULL,NULL,'1','2020-03-25 02:24:13',NULL,'1'),
(80,5,12,'Autorización de examen adelantado',10.00,'NO','',30,'000000001',NULL,NULL,'1','2020-03-25 02:24:14',NULL,'1'),
(81,5,13,'Pensum Académico - POSGRADO',20.00,'SI','SECRETARIA GENERAL',30,'000000001',NULL,NULL,'1','2020-03-25 02:24:14',NULL,'1'),
(82,5,14,'Defensa de Tesis/ Investigación',20.00,'NO','',30,'000000001',NULL,NULL,'1','2020-03-25 02:24:14',NULL,'1'),
(83,5,15,'Reingreso a maestría',20.00,'NO','',30,'000000001',NULL,NULL,'1','2020-03-25 02:24:14',NULL,'1'),
(84,5,16,'Renuncia de Tema de Tesis/ Investigación',5.00,'NO','',30,'000000001',NULL,NULL,'1','2020-03-25 02:24:14',NULL,'1'),
(85,5,17,'Retiro de Universidad',10.00,'NO','',30,'000000001',NULL,NULL,'1','2020-03-25 02:24:14',NULL,'1'),
(86,5,18,'Retiro de Universidad con documentación',100.00,'SI','SECRETARIA GENERAL',30,'000000001',NULL,NULL,'1','2020-03-25 02:24:14',NULL,'1'),
(87,5,19,'Solicitud de repetición de Módulo',5.00,'NO','',30,'000000001',NULL,NULL,'1','2020-03-25 02:24:14',NULL,'1'),
(88,5,20,'Traducción de Documentos',30.00,'SI','SECRETARIA GENERAL/RELACIONES INTERNACIONALES',30,'000000001',NULL,NULL,'1','2020-03-25 02:24:14',NULL,'1'),
(89,5,21,'Solicitud de Inicio de Vinculación con la Sociedad',5.00,'NO','',30,'000000001',NULL,NULL,'1','2020-03-25 02:24:14',NULL,'1'),
(90,5,22,'Solicitud de Fin de Vinculación con la Sociedad',5.00,'SI','INTERNO',30,'000000001',NULL,NULL,'1','2020-03-25 02:24:14',NULL,'1'),
(91,5,23,'Trámites Generales',20.00,'NO','',30,'000000001',NULL,NULL,'1','2020-03-25 02:24:14',NULL,'1'),
(92,5,24,'Certificado de suficiencia de idioma extranjero',5.00,'SI','SECRETARIA GENERAL/RELACIONES INTERNACIONALES',30,'000000001',NULL,NULL,'1','2020-03-25 02:24:14',NULL,'1'),
(93,5,25,'Homologación de módulos',20.00,'SI','INTERNO',30,'000000001',NULL,NULL,'1','2020-03-25 02:24:14',NULL,'1'),
(94,6,1,'Presentación de Anteproyecto de Tesis / Investigación',10.00,'SI','INTERNO',30,'000000001',NULL,NULL,'1','2020-03-25 02:24:14',NULL,'1'),
(95,6,2,'Certificado de aprobación Tema de tesis ',10.00,'SI','INTERNO',30,'000000001',NULL,NULL,'1','2020-03-25 02:24:14',NULL,'1'),
(96,6,3,'Solicitud de informe de tutores para tesis/investigación',20.00,'SI','INTERNO',30,'000000001',NULL,NULL,'1','2020-03-25 02:24:14',NULL,'1'),
(97,6,4,'Certificado de haber culminado su pensum de estudios',20.00,'SI','INTERNO',30,'000000001',NULL,NULL,'1','2020-03-25 02:24:14',NULL,'1'),
(98,6,5,'Certificado de no adeudar dinero en la UTEG',10.00,'SI','INTERNO',30,'000000001',NULL,NULL,'1','2020-03-25 02:24:14',NULL,'1'),
(99,6,6,'Certificado de no adeudar material bibliográfico en la UTEG',10.00,'SI','INTERNO',30,'000000001',NULL,NULL,'1','2020-03-25 02:24:14',NULL,'1'),
(100,6,7,'Constancia de haber entregado los documentos actualizados',20.00,'SI','INTERNO',30,'000000001',NULL,NULL,'1','2020-03-25 02:24:14',NULL,'1'),
(101,6,8,'Análisis de Sistema de Similitud',50.00,'SI','INTERNO',30,'000000001',NULL,NULL,'1','2020-03-25 02:24:14',NULL,'1'),
(102,6,9,'Asignación de tribunal y entrega de anillados para sustentación de Tesis/Investigación',20.00,'SI','INTERNO',30,'000000001',NULL,NULL,'1','2020-03-25 02:24:14',NULL,'1'),
(103,6,10,'Constancia de haber entregado las dos tesis empastadas y CD',20.00,'SI','INTERNO',30,'000000001',NULL,NULL,'1','2020-03-25 02:24:14',NULL,'1'),
(104,6,11,'Constancia de haber cancelado alquiler de toga y birrete',30.00,'SI','INTERNO',30,'000000001',NULL,NULL,'1','2020-03-25 02:24:14',NULL,'1'),
(105,6,12,'Constancia de haber entregado los formularios de seguimiento de graduados y firma del acta',30.00,'SI','INTERNO',30,'000000001',NULL,NULL,'1','2020-03-25 02:24:14',NULL,'1'),
(106,7,1,'Solicitud dirigida a Decanato para realizar el examen complexivo',10.00,'SI','INTERNO',30,'000000001',NULL,NULL,'1','2020-03-25 02:24:14',NULL,'1'),
(107,7,2,'Certificado de aprobación del examen complexivo',10.00,'SI','INTERNO',30,'000000001',NULL,NULL,'1','2020-03-25 02:24:14',NULL,'1'),
(108,7,3,'Certificado de haber cumplido con su pensum de estudios',20.00,'SI','INTERNO',30,'000000001',NULL,NULL,'1','2020-03-25 02:24:14',NULL,'1'),
(109,7,4,'Certificado de no adeudar dinero a la UTEG ',10.00,'SI','INTERNO',30,'000000001',NULL,NULL,'1','2020-03-25 02:24:15',NULL,'1'),
(110,7,5,'Constancia de no adeudar libros o material bibliográfico de la biblioteca UTEG',10.00,'SI','INTERNO',30,'000000001',NULL,NULL,'1','2020-03-25 02:24:15',NULL,'1'),
(111,7,6,'Constancia de haber entregado los documentos actualizados',20.00,'SI','INTERNO',30,'000000001',NULL,NULL,'1','2020-03-25 02:24:15',NULL,'1'),
(112,7,7,'Constancia de haber cancelado el alquiler de la toga y birrete',30.00,'SI','INTERNO',30,'000000001',NULL,NULL,'1','2020-03-25 02:24:15',NULL,'1'),
(113,7,8,'Constancia de haber entregado los formularios de seguimiento de graduados y firma de acta. ',30.00,'SI','INTERNO',30,'000000001',NULL,NULL,'1','2020-03-25 02:24:15',NULL,'1'),
(114,8,1,'Certificación de copia de Acta de Grado',30.00,'SI','SECRETARIA GENERAL',30,'000000001',NULL,NULL,'1','2020-03-25 02:24:15',NULL,'1'),
(115,8,2,'Certificación de copia de título',30.00,'SI','SECRETARIA GENERAL',30,'000000001',NULL,NULL,'1','2020-03-25 02:24:15',NULL,'1'),
(116,8,3,'Certificado de Graduado',30.00,'SI','SECRETARIA GENERAL',30,'000000001',NULL,NULL,'1','2020-03-25 02:24:15',NULL,'1'),
(117,8,4,'Certificado de notas y carga horaria Graduados',50.00,'SI','SECRETARIA GENERAL',30,'000000001',NULL,NULL,'1','2020-03-25 02:24:15',NULL,'1'),
(118,8,5,'Reposición de Título',210.00,'NO','',30,'000000001',NULL,NULL,'1','2020-03-25 02:24:15',NULL,'1'),
(119,8,6,'Certificado de Maestría válida para Doctorado',30.00,'SI','SECRETARIA GENERAL',30,'000000001',NULL,NULL,'1','2020-03-25 02:24:15',NULL,'1'),
(120,8,7,'Certificado de Malla Curricular ',20.00,'NO','',30,'000000001',NULL,NULL,'1','2020-03-25 02:24:15',NULL,'1'),
(121,8,8,'Trámites Varios',20.00,'SI','SECRETARIA GENERAL',30,'000000001',NULL,NULL,'1','2020-03-25 02:24:15',NULL,'1'),
(122,9,1,'Autorización para inscripción extemporánea',10.00,'NO','INTERNO',30,'000000001',NULL,NULL,'1','2020-03-25 02:24:15',NULL,'1'),
(123,9,2,'Traspaso de Saldo a favor',20.00,'NO','INTERNO',30,'000000001',NULL,NULL,'1','2020-03-25 02:24:15',NULL,'1'),
(124,9,3,'Condonación de Deuda',20.00,'NO','INTERNO',30,'000000001',NULL,NULL,'1','2020-03-25 02:24:15',NULL,'1'),
(125,9,4,'Devolución de valores',20.00,'NO','INTERNO',30,'000000001',NULL,NULL,'1','2020-03-25 02:24:15',NULL,'1'),
(126,9,5,'Prórroga de pagos',20.00,'NO','INTERNO',30,'000000001',NULL,NULL,'1','2020-03-25 02:24:15',NULL,'1'),
(127,9,6,'Cambio de Compromiso de Pago',10.00,'NO','INTERNO',30,'000000001',NULL,NULL,'1','2020-03-25 02:24:15',NULL,'1');



/*
-- Query: select * from db_academico.distributivo_academico_horario
LIMIT 0, 50000

-- Date: 2020-11-05 01:12
*/
INSERT INTO db_academico.distributivo_academico_horario (`daho_id`,`uaca_id`,`mod_id`,`daho_jornada`,`daho_descripcion`,`daho_horario`,`daho_estado`,`daho_fecha_creacion`,`daho_fecha_modificacion`,`daho_estado_logico`) VALUES (1,1,2,'1','L-M-J (09:00-11:00)','1H','1','2020-06-05 09:48:35',NULL,'1');
INSERT INTO db_academico.distributivo_academico_horario (`daho_id`,`uaca_id`,`mod_id`,`daho_jornada`,`daho_descripcion`,`daho_horario`,`daho_estado`,`daho_fecha_creacion`,`daho_fecha_modificacion`,`daho_estado_logico`) VALUES (2,1,2,'1','L-M-J (11:00-13:00)','2H','1','2020-06-05 09:48:35',NULL,'1');
INSERT INTO db_academico.distributivo_academico_horario (`daho_id`,`uaca_id`,`mod_id`,`daho_jornada`,`daho_descripcion`,`daho_horario`,`daho_estado`,`daho_fecha_creacion`,`daho_fecha_modificacion`,`daho_estado_logico`) VALUES (3,1,2,'1','L-M-J (13:30-15:30)','3H','1','2020-06-05 09:48:35',NULL,'1');
INSERT INTO db_academico.distributivo_academico_horario (`daho_id`,`uaca_id`,`mod_id`,`daho_jornada`,`daho_descripcion`,`daho_horario`,`daho_estado`,`daho_fecha_creacion`,`daho_fecha_modificacion`,`daho_estado_logico`) VALUES (4,1,2,'1','MIE (09:00-12:00)','4H','1','2020-06-05 09:48:35',NULL,'1');
INSERT INTO db_academico.distributivo_academico_horario (`daho_id`,`uaca_id`,`mod_id`,`daho_jornada`,`daho_descripcion`,`daho_horario`,`daho_estado`,`daho_fecha_creacion`,`daho_fecha_modificacion`,`daho_estado_logico`) VALUES (5,1,2,'1','VIE (09:00-12:00)','5H','1','2020-06-05 09:48:35',NULL,'1');
INSERT INTO db_academico.distributivo_academico_horario (`daho_id`,`uaca_id`,`mod_id`,`daho_jornada`,`daho_descripcion`,`daho_horario`,`daho_estado`,`daho_fecha_creacion`,`daho_fecha_modificacion`,`daho_estado_logico`) VALUES (6,1,2,'2','L-M-J (18:20-20:20)','1H','1','2020-06-05 09:48:35',NULL,'1');
INSERT INTO db_academico.distributivo_academico_horario (`daho_id`,`uaca_id`,`mod_id`,`daho_jornada`,`daho_descripcion`,`daho_horario`,`daho_estado`,`daho_fecha_creacion`,`daho_fecha_modificacion`,`daho_estado_logico`) VALUES (7,1,2,'2','L-M-J (20:20-22:20)','2H','1','2020-06-05 09:48:35',NULL,'1');
INSERT INTO db_academico.distributivo_academico_horario (`daho_id`,`uaca_id`,`mod_id`,`daho_jornada`,`daho_descripcion`,`daho_horario`,`daho_estado`,`daho_fecha_creacion`,`daho_fecha_modificacion`,`daho_estado_logico`) VALUES (8,1,2,'2','MIE-VIE (18:20-21:20)','3H','1','2020-06-05 09:48:35',NULL,'1');
INSERT INTO db_academico.distributivo_academico_horario (`daho_id`,`uaca_id`,`mod_id`,`daho_jornada`,`daho_descripcion`,`daho_horario`,`daho_estado`,`daho_fecha_creacion`,`daho_fecha_modificacion`,`daho_estado_logico`) VALUES (9,1,2,'2','MIE (18:20-21:20)','4H','1','2020-06-05 09:48:35',NULL,'1');
INSERT INTO db_academico.distributivo_academico_horario (`daho_id`,`uaca_id`,`mod_id`,`daho_jornada`,`daho_descripcion`,`daho_horario`,`daho_estado`,`daho_fecha_creacion`,`daho_fecha_modificacion`,`daho_estado_logico`) VALUES (10,1,2,'2','VIE (18:20-21:20)','5H','1','2020-06-05 09:48:35',NULL,'1');
INSERT INTO db_academico.distributivo_academico_horario (`daho_id`,`uaca_id`,`mod_id`,`daho_jornada`,`daho_descripcion`,`daho_horario`,`daho_estado`,`daho_fecha_creacion`,`daho_fecha_modificacion`,`daho_estado_logico`) VALUES (11,1,2,'2','SÁB (07:15-09:15)','6H','1','2020-06-05 09:48:35',NULL,'1');
INSERT INTO db_academico.distributivo_academico_horario (`daho_id`,`uaca_id`,`mod_id`,`daho_jornada`,`daho_descripcion`,`daho_horario`,`daho_estado`,`daho_fecha_creacion`,`daho_fecha_modificacion`,`daho_estado_logico`) VALUES (12,1,3,'3','SÁB (07:15-10:15)','1H','1','2020-06-05 09:48:35',NULL,'1');
INSERT INTO db_academico.distributivo_academico_horario (`daho_id`,`uaca_id`,`mod_id`,`daho_jornada`,`daho_descripcion`,`daho_horario`,`daho_estado`,`daho_fecha_creacion`,`daho_fecha_modificacion`,`daho_estado_logico`) VALUES (13,1,3,'3','SÁB (10:30-13:30)','2H','1','2020-06-05 09:48:35',NULL,'1');
INSERT INTO db_academico.distributivo_academico_horario (`daho_id`,`uaca_id`,`mod_id`,`daho_jornada`,`daho_descripcion`,`daho_horario`,`daho_estado`,`daho_fecha_creacion`,`daho_fecha_modificacion`,`daho_estado_logico`) VALUES (14,1,3,'3','SÁB (14:30-17:30)','3H','1','2020-06-05 09:48:35',NULL,'1');
INSERT INTO db_academico.distributivo_academico_horario (`daho_id`,`uaca_id`,`mod_id`,`daho_jornada`,`daho_descripcion`,`daho_horario`,`daho_estado`,`daho_fecha_creacion`,`daho_fecha_modificacion`,`daho_estado_logico`) VALUES (15,1,4,'4','SÁB (08:15-10:15)','1H','1','2020-06-05 09:48:35',NULL,'1');
INSERT INTO db_academico.distributivo_academico_horario (`daho_id`,`uaca_id`,`mod_id`,`daho_jornada`,`daho_descripcion`,`daho_horario`,`daho_estado`,`daho_fecha_creacion`,`daho_fecha_modificacion`,`daho_estado_logico`) VALUES (16,1,4,'4','SÁB (10:30-12:30)','2H','1','2020-06-05 09:48:35',NULL,'1');
INSERT INTO db_academico.distributivo_academico_horario (`daho_id`,`uaca_id`,`mod_id`,`daho_jornada`,`daho_descripcion`,`daho_horario`,`daho_estado`,`daho_fecha_creacion`,`daho_fecha_modificacion`,`daho_estado_logico`) VALUES (17,1,4,'4','SÁB (13:30-15:30)','3H','1','2020-06-05 09:48:35',NULL,'1');
INSERT INTO db_academico.distributivo_academico_horario (`daho_id`,`uaca_id`,`mod_id`,`daho_jornada`,`daho_descripcion`,`daho_horario`,`daho_estado`,`daho_fecha_creacion`,`daho_fecha_modificacion`,`daho_estado_logico`) VALUES (18,1,1,'2','LU1H (19:00-20:00)','LU1H','1','2020-06-05 09:48:35',NULL,'1');
INSERT INTO db_academico.distributivo_academico_horario (`daho_id`,`uaca_id`,`mod_id`,`daho_jornada`,`daho_descripcion`,`daho_horario`,`daho_estado`,`daho_fecha_creacion`,`daho_fecha_modificacion`,`daho_estado_logico`) VALUES (19,1,1,'2','LU2H (20:00-21:00)','LU2H','1','2020-06-05 09:48:35',NULL,'1');
INSERT INTO db_academico.distributivo_academico_horario (`daho_id`,`uaca_id`,`mod_id`,`daho_jornada`,`daho_descripcion`,`daho_horario`,`daho_estado`,`daho_fecha_creacion`,`daho_fecha_modificacion`,`daho_estado_logico`) VALUES (20,1,1,'2','LU3H (21:00-22:00)','LU3H','1','2020-06-05 09:48:35',NULL,'1');
INSERT INTO db_academico.distributivo_academico_horario (`daho_id`,`uaca_id`,`mod_id`,`daho_jornada`,`daho_descripcion`,`daho_horario`,`daho_estado`,`daho_fecha_creacion`,`daho_fecha_modificacion`,`daho_estado_logico`) VALUES (21,1,1,'2','LU4H (19:00-20:30)','LU4H','1','2020-06-05 09:48:35',NULL,'1');
INSERT INTO db_academico.distributivo_academico_horario (`daho_id`,`uaca_id`,`mod_id`,`daho_jornada`,`daho_descripcion`,`daho_horario`,`daho_estado`,`daho_fecha_creacion`,`daho_fecha_modificacion`,`daho_estado_logico`) VALUES (22,1,1,'2','LU5H (20:00-21:30)','LU5H','1','2020-06-05 09:48:35',NULL,'1');
INSERT INTO db_academico.distributivo_academico_horario (`daho_id`,`uaca_id`,`mod_id`,`daho_jornada`,`daho_descripcion`,`daho_horario`,`daho_estado`,`daho_fecha_creacion`,`daho_fecha_modificacion`,`daho_estado_logico`) VALUES (23,1,1,'2','MA1H (19:00-20:00)','MA1H','1','2020-06-05 09:48:35',NULL,'1');
INSERT INTO db_academico.distributivo_academico_horario (`daho_id`,`uaca_id`,`mod_id`,`daho_jornada`,`daho_descripcion`,`daho_horario`,`daho_estado`,`daho_fecha_creacion`,`daho_fecha_modificacion`,`daho_estado_logico`) VALUES (24,1,1,'2','MA2H (20:00-21:00)','MA2H','1','2020-06-05 09:48:35',NULL,'1');
INSERT INTO db_academico.distributivo_academico_horario (`daho_id`,`uaca_id`,`mod_id`,`daho_jornada`,`daho_descripcion`,`daho_horario`,`daho_estado`,`daho_fecha_creacion`,`daho_fecha_modificacion`,`daho_estado_logico`) VALUES (25,1,1,'2','MA3H (21:00-22:00)','MA3H','1','2020-06-05 09:48:35',NULL,'1');
INSERT INTO db_academico.distributivo_academico_horario (`daho_id`,`uaca_id`,`mod_id`,`daho_jornada`,`daho_descripcion`,`daho_horario`,`daho_estado`,`daho_fecha_creacion`,`daho_fecha_modificacion`,`daho_estado_logico`) VALUES (26,1,1,'2','MA4H (19:00-20:30)','MA4H','1','2020-06-05 09:48:35',NULL,'1');
INSERT INTO db_academico.distributivo_academico_horario (`daho_id`,`uaca_id`,`mod_id`,`daho_jornada`,`daho_descripcion`,`daho_horario`,`daho_estado`,`daho_fecha_creacion`,`daho_fecha_modificacion`,`daho_estado_logico`) VALUES (27,1,1,'2','MA5H (20:00-21:30)','MA5H','1','2020-06-05 09:48:35',NULL,'1');
INSERT INTO db_academico.distributivo_academico_horario (`daho_id`,`uaca_id`,`mod_id`,`daho_jornada`,`daho_descripcion`,`daho_horario`,`daho_estado`,`daho_fecha_creacion`,`daho_fecha_modificacion`,`daho_estado_logico`) VALUES (28,1,1,'2','MI1H (19:00-20:00)','MI1H','1','2020-06-05 09:48:35',NULL,'1');
INSERT INTO db_academico.distributivo_academico_horario (`daho_id`,`uaca_id`,`mod_id`,`daho_jornada`,`daho_descripcion`,`daho_horario`,`daho_estado`,`daho_fecha_creacion`,`daho_fecha_modificacion`,`daho_estado_logico`) VALUES (29,1,1,'2','MI2H (20:00-21:00)','MI2H','1','2020-06-05 09:48:35',NULL,'1');
INSERT INTO db_academico.distributivo_academico_horario (`daho_id`,`uaca_id`,`mod_id`,`daho_jornada`,`daho_descripcion`,`daho_horario`,`daho_estado`,`daho_fecha_creacion`,`daho_fecha_modificacion`,`daho_estado_logico`) VALUES (30,1,1,'2','MI3H (21:00-22:00)','MI3H','1','2020-06-05 09:48:35',NULL,'1');
INSERT INTO db_academico.distributivo_academico_horario (`daho_id`,`uaca_id`,`mod_id`,`daho_jornada`,`daho_descripcion`,`daho_horario`,`daho_estado`,`daho_fecha_creacion`,`daho_fecha_modificacion`,`daho_estado_logico`) VALUES (31,1,1,'2','MI4H (19:00-20:30)','MI4H','1','2020-06-05 09:48:35',NULL,'1');
INSERT INTO db_academico.distributivo_academico_horario (`daho_id`,`uaca_id`,`mod_id`,`daho_jornada`,`daho_descripcion`,`daho_horario`,`daho_estado`,`daho_fecha_creacion`,`daho_fecha_modificacion`,`daho_estado_logico`) VALUES (32,1,1,'2','MI5H (20:00-21:30)','MI5H','1','2020-06-05 09:48:35',NULL,'1');
INSERT INTO db_academico.distributivo_academico_horario (`daho_id`,`uaca_id`,`mod_id`,`daho_jornada`,`daho_descripcion`,`daho_horario`,`daho_estado`,`daho_fecha_creacion`,`daho_fecha_modificacion`,`daho_estado_logico`) VALUES (33,1,1,'2','JU1H (19:00-20:00)','JU1H','1','2020-06-05 09:48:35',NULL,'1');
INSERT INTO db_academico.distributivo_academico_horario (`daho_id`,`uaca_id`,`mod_id`,`daho_jornada`,`daho_descripcion`,`daho_horario`,`daho_estado`,`daho_fecha_creacion`,`daho_fecha_modificacion`,`daho_estado_logico`) VALUES (34,1,1,'2','JU2H (20:00-21:00)','JU2H','1','2020-06-05 09:48:35',NULL,'1');
INSERT INTO db_academico.distributivo_academico_horario (`daho_id`,`uaca_id`,`mod_id`,`daho_jornada`,`daho_descripcion`,`daho_horario`,`daho_estado`,`daho_fecha_creacion`,`daho_fecha_modificacion`,`daho_estado_logico`) VALUES (35,1,1,'2','JU3H (21:00-22:00)','JU3H','1','2020-06-05 09:48:35',NULL,'1');
INSERT INTO db_academico.distributivo_academico_horario (`daho_id`,`uaca_id`,`mod_id`,`daho_jornada`,`daho_descripcion`,`daho_horario`,`daho_estado`,`daho_fecha_creacion`,`daho_fecha_modificacion`,`daho_estado_logico`) VALUES (36,1,1,'2','JU4H (19:00-20:30)','JU4H','1','2020-06-05 09:48:35',NULL,'1');
INSERT INTO db_academico.distributivo_academico_horario (`daho_id`,`uaca_id`,`mod_id`,`daho_jornada`,`daho_descripcion`,`daho_horario`,`daho_estado`,`daho_fecha_creacion`,`daho_fecha_modificacion`,`daho_estado_logico`) VALUES (37,1,1,'2','JU5H (20:00-21:30)','JU5H','1','2020-06-05 09:48:35',NULL,'1');
INSERT INTO db_academico.distributivo_academico_horario (`daho_id`,`uaca_id`,`mod_id`,`daho_jornada`,`daho_descripcion`,`daho_horario`,`daho_estado`,`daho_fecha_creacion`,`daho_fecha_modificacion`,`daho_estado_logico`) VALUES (38,1,1,'2','VI1H (19:00-20:00)','VI1H','1','2020-06-05 09:48:35',NULL,'1');
INSERT INTO db_academico.distributivo_academico_horario (`daho_id`,`uaca_id`,`mod_id`,`daho_jornada`,`daho_descripcion`,`daho_horario`,`daho_estado`,`daho_fecha_creacion`,`daho_fecha_modificacion`,`daho_estado_logico`) VALUES (39,1,1,'2','VI2H (20:00-21:00)','VI2H','1','2020-06-05 09:48:35',NULL,'1');
INSERT INTO db_academico.distributivo_academico_horario (`daho_id`,`uaca_id`,`mod_id`,`daho_jornada`,`daho_descripcion`,`daho_horario`,`daho_estado`,`daho_fecha_creacion`,`daho_fecha_modificacion`,`daho_estado_logico`) VALUES (40,1,1,'2','VI3H (21:00-22:00)','VI3H','1','2020-06-05 09:48:35',NULL,'1');
INSERT INTO db_academico.distributivo_academico_horario (`daho_id`,`uaca_id`,`mod_id`,`daho_jornada`,`daho_descripcion`,`daho_horario`,`daho_estado`,`daho_fecha_creacion`,`daho_fecha_modificacion`,`daho_estado_logico`) VALUES (41,1,1,'2','VI4H (19:00-20:30)','VI4H','1','2020-06-05 09:48:35',NULL,'1');
INSERT INTO db_academico.distributivo_academico_horario (`daho_id`,`uaca_id`,`mod_id`,`daho_jornada`,`daho_descripcion`,`daho_horario`,`daho_estado`,`daho_fecha_creacion`,`daho_fecha_modificacion`,`daho_estado_logico`) VALUES (42,1,1,'2','VI5H (20:00-21:30)','VI5H','1','2020-06-05 09:48:35',NULL,'1');

insert into db_academico.`distributivo_horario_det` (dhde_id, daho_id, dia_id, dhde_hora_inicio, dhde_hora_fin, dhde_usuario_ingreso, dhde_estado, dhde_estado_logico) values
(1, 1, 1, '09:00:00', '11:00:00', 1, 1, 1),
(2, 1, 2, '09:00:00', '11:00:00', 1, 1, 1),
(3, 1, 4, '09:00:00', '11:00:00', 1, 1, 1),
(4, 2, 1, '11:00:00', '13:00:00', 1, 1, 1),
(5, 2, 2, '11:00:00', '13:00:00', 1, 1, 1),
(6, 2, 4, '11:00:00', '13:00:00', 1, 1, 1),
(7, 3, 1, '13:30:00', '15:30:00', 1, 1, 1),
(8, 3, 2, '13:30:00', '15:30:00', 1, 1, 1),
(9, 3, 4, '13:30:00', '15:30:00', 1, 1, 1),
(10, 4, 3, '09:00:00', '12:00:00', 1, 1, 1),
(11, 5, 5, '09:00:00', '12:00:00', 1, 1, 1),
(12, 6, 1, '18:20:00', '20:20:00', 1, 1, 1),
(13, 6, 2, '18:20:00', '20:20:00', 1, 1, 1),
(14, 6, 4, '18:20:00', '20:20:00', 1, 1, 1),
(15, 7, 1, '20:20:00', '22:20:00', 1, 1, 1),
(16, 7, 2, '20:20:00', '22:20:00', 1, 1, 1),
(17, 7, 4, '20:20:00', '22:20:00', 1, 1, 1),
(18, 8, 3, '18:20:00', '21:20:00', 1, 1, 1),
(19, 8, 5, '18:20:00', '21:20:00', 1, 1, 1),
(20, 9, 3, '18:20:00', '21:20:00', 1, 1, 1),
(21, 10, 5, '18:20:00', '21:20:00', 1, 1, 1),
(22, 11, 6, '07:15:00', '09:15:00', 1, 1, 1), --
(23, 12, 6, '07:15:00', '10:15:00', 1, 1, 1), 
(24, 13, 6, '10:30:00', '13:30:00', 1, 1, 1), 
(25, 14, 6, '14:30:00', '17:30:00', 1, 1, 1), 
(26, 15, 6, '08:15:00', '10:15:00', 1, 1, 1), 
(27, 16, 6, '10:30:00', '12:30:00', 1, 1, 1), 
(28, 17, 6, '13:30:00', '15:30:00', 1, 1, 1),
(29, 18, 1, '19:00:00', '20:00:00', 1, 1, 1),
(30, 19, 1, '20:00:00', '21:00:00', 1, 1, 1),
(31, 20, 1, '21:00:00', '22:00:00', 1, 1, 1),
(32, 21, 1, '19:00:00', '20:30:00', 1, 1, 1),
(33, 22, 1, '20:00:00', '21:30:00', 1, 1, 1),
(34, 23, 2, '19:00:00', '20:00:00', 1, 1, 1),
(35, 24, 2, '20:00:00', '21:00:00', 1, 1, 1),
(36, 25, 2, '21:00:00', '22:00:00', 1, 1, 1),
(37, 26, 2, '19:00:00', '20:30:00', 1, 1, 1),
(38, 27, 2, '20:00:00', '21:30:00', 1, 1, 1),
(39, 28, 3, '19:00:00', '20:00:00', 1, 1, 1),
(40, 29, 3, '20:00:00', '21:00:00', 1, 1, 1),
(41, 30, 3, '21:00:00', '22:00:00', 1, 1, 1),
(42, 31, 3, '19:00:00', '20:30:00', 1, 1, 1),
(43, 32, 3, '20:00:00', '21:30:00', 1, 1, 1),
(44, 33, 4, '19:00:00', '20:00:00', 1, 1, 1),
(45, 34, 4, '20:00:00', '21:00:00', 1, 1, 1),
(46, 35, 4, '21:00:00', '22:00:00', 1, 1, 1),
(47, 36, 4, '19:00:00', '20:30:00', 1, 1, 1),
(48, 37, 4, '20:00:00', '21:30:00', 1, 1, 1),
(49, 38, 5, '19:00:00', '20:00:00', 1, 1, 1),
(50, 39, 5, '20:00:00', '21:00:00', 1, 1, 1),
(51, 40, 5, '21:00:00', '22:00:00', 1, 1, 1),
(52, 41, 5, '19:00:00', '20:30:00', 1, 1, 1),
(53, 42, 5, '20:00:00', '21:30:00', 1, 1, 1);


INSERT INTO db_academico.`configuracion_tipo_distributivo` (`ctdi_id`, `tdis_id`, `uaca_id`, `mod_id`, `ctdi_horas_inicio`, `ctdi_horas_fin`, `ctdi_estado_vigencia`, `ctdi_horas_semanal`, `ctdi_estado`, `ctdi_estado_logico`) VALUES
(1, 2, null, null, null, null, '1', 2, '1', '1'),
(2, 3, null, null, null, null, '1', 2, '1', '1'),
(3, 4, null, null, null, null, '1', 2, '1', '1'),
(4, 1, 1, 1, 0, 10, '1', 2, '1', '1'),
(5, 1, 1, 1, 11, 20, '1', 3, '1', '1'),
(6, 1, 1, 1, 21, 30, '1', 4, '1', '1'),
(7, 1, 1, 1, 31, 50, '1', 5, '1', '1'),
(8, 1, 1, 1, 51, 100, '1', 7, '1', '1');
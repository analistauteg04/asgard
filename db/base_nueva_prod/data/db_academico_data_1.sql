--
-- Base de datos: `db_academico`
--
USE `db_academico`;
-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `nivel_instruccion`
--
INSERT INTO `nivel_instruccion` (`nins_id`,`nins_nombre`, `nins_descripcion`,`nins_estado`,`nins_estado_logico`) VALUES
(1,'Sin estudios ','Sin estudios ','1','1'),
(2,'Primarios','Primarios','1','1'),
(3,'Secundarios','Secundarios','1','1'),
(4,'Tercer Nivel','Tercer Nivel','1','1'),
(5,'Cuarto Nivel','Cuarto Nivel','1','1');

-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `nivel_estudio`
--
 INSERT INTO `nivel_estudio` (`nest_id`, `nest_nombre`, `nest_descripcion`, `nest_usuario_ingreso`, `nest_estado`, `nest_estado_logico`) VALUES
(1, 'Nivel 0', 'Nivel 0 PreAcadémico', '1', '1', '1'),
(2, '1', 'Nivel 1', '1', '1', '1'),
(3, '2', 'Nivel 2', '1', '1', '1'),
(4, '3', 'Nivel 3', '1', '1', '1'),
(5, '4', 'Nivel 4', '1', '1', '1'),
(6, '5', 'Nivel 5', '1', '1', '1'),
(7, '6', 'Nivel 6', '1', '1', '1'),
(8, '7', 'Nivel 7', '1', '1', '1'),
(9, '8', 'Nivel 8', '1', '1', '1'),
(10, '9', 'Nivel 9', '1', '1', '1');

-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `tipo_institucion_aca`
--
INSERT INTO `tipo_institucion_aca` (`tiac_id`,`tiac_nombre`, `tiac_descripcion`,`tiac_estado`,`tiac_estado_logico`) VALUES
(1,'Pública','Pública','1','1'),
(2,'Privada','Privada','1','1'),
(3,'Fiscomisional','Fiscomisional','1','1');

-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `tipo_estudio_academico`
--
INSERT INTO `tipo_estudio_academico` (`teac_id`, `teac_nombre`, `teac_descripcion`, `teac_usuario_ingreso`, `teac_estado`, `teac_estado_logico`) VALUES
(1,'Carrera','Carrera',1,'1','1'),
(2,'Programa','Programa',1,'1','1'),
(3,'Diplomado','Diplomado',1,'1','1');

    -- --------------------------------------------------------
--
-- Volcado de datos para la tabla `unidad_academica` 
-- 
INSERT INTO `unidad_academica` (`uaca_id`, `uaca_nombre`, `uaca_descripcion`, `uaca_usuario_ingreso`, `uaca_inscripcion`, `uaca_estado`, `uaca_estado_logico`) VALUES
(1, 'Grado', 'Grado', 1, '1', '1', '1'),
(2, 'Posgrado', 'Posgrado', 1, '1', '1', '1'),
(3, 'Educación Continua', 'Educación Continua', 1, '0', '0', '1'),
(4, 'Centro de Idiomas', 'Centro de Idiomas', 1, '0', '0', '1');

-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `modalidad`
-- 
INSERT INTO `modalidad` (`mod_id`, `mod_nombre`,`mod_descripcion`, `mod_usuario_ingreso`, `mod_estado`, `mod_estado_logico`) VALUES
(1, 'Online', 'Online', 1, '1', '1'),
(2, 'Presencial', 'Presencial', 1, '1', '1'),
(3, 'Semipresencial', 'Semipresencial', 1 , '1', '1'),
(4, 'Distancia', 'Distancia', 1, '1', '1');

-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `unidad_estudio`
--
INSERT INTO `unidad_estudio` (`uest_id`,`uest_nombre`,`uest_descripcion`,`uest_usuario_ingreso`,`uest_estado`,`uest_estado_logico`) VALUES
(1,'Ingreso', 'Ingreso', 1, '1', '1'),
(2,'Básica', 'Básica', 1, '1', '1'),
(3,'Profesional', 'Profesional', 1, '1', '1'),
(4,'Titulación', 'Titulación', '1', '1', '1');

-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `tipo_estudio_academico`
--
INSERT INTO `estudio_academico` (`eaca_id`, `teac_id`, `eaca_nombre`, `eaca_descripcion`, `eaca_alias`, `eaca_usuario_ingreso`, `eaca_usuario_modifica`, `eaca_estado`, `eaca_fecha_creacion`, `eaca_fecha_modificacion`,`eaca_estado_logico`) VALUES
(1,1,'Licenciatura en Comercio Exterior','Licenciatura en Comercio Exterior','licenciatura_en_comercio_exterior',1,null,'1','2018-08-24 11:25:00',null,'1'),
(2,1,'Economía','Economía','economia',1,null,'1','2018-08-24 11:25:00',null,'1'),
(3,1,'Licenciatura en Finanzas','Licenciatura en Finanzas','licenciatura_en_finanzas',1,null,'1','2018-08-24 11:25:00',null,'1'),
(4,1,'Licenciatura en Mercadotecnia','Licenciatura en Mercadotecnia','licenciatura_en_mercadotecnia',1,null,'1','2018-08-24 11:25:00',null,'1'),
(5,1,'Licenciatura en Turismo','Licenciatura en Turismo','licenciatura_en_turismo',1,null,'1','2018-08-24 11:25:00',null,'1'),
(6,1,'Licenciatura en Administracion de Empresas','Licenciatura en Administracion de Empresas','licenciatura_en_administracion_de_empresas',1,null,'1','2018-08-24 11:25:00',null,'1'),
(7,1,'Ingenieria en Software','Ingenieria en Software','ingenieria_en_software',1,null,'1','2018-08-24 11:25:00',null,'1'),
(8,1,'Ingenieria en Telecomunicaciones','Ingenieria en Telecomunicaciones','ingenieria_en_telecomunicaciones',1,null,'1','2018-08-24 11:25:00',null,'1'),
(9,1,'Licenciatura en Contabilidad y Auditoria','Licenciatura en Contabilidad y Auditoria','licenciatura_en_contabilidad_y_auditoria',1,null,'1','2018-08-24 11:25:00',null,'1'),
(10,1,'Ingenieria en Tecnologias de La Información','Ingenieria en Tecnologias de La Información','Ingenieria_en_tecnologias_de_la_información',1,null,'1','2018-08-24 11:25:00',null,'1'),
(11,1,'Ingenieria en Logística y Transporte','Ingenieria en Logística y Transporte','ingenieria_en_logística_y_transporte',1,null,'1','2018-08-24 11:25:00',null,'1'),
(12,1,'Licenciatura en Comunicación','Licenciatura en Comunicación','licenciatura_en_comunicación',1,null,'1','2018-08-24 11:25:00',null,'1'),
(13,1,'Licenciatura en Gestión y Talento Humano','Licenciatura en Gestión y Talento Humano','licenciatura_en_gestión_y_talento_humano',1,null,'1','2018-08-24 11:25:00',null,'1'),
(14,1,'Licenciatura en Administración Portuaria y Aduanera','Licenciatura en Administración Portuaria y Aduanera','licenciatura_en_administración_portuaria_y_aduanera',1,null,'1','2018-08-24 11:25:00',null,'1'),
(15,2,'Administración de Empresas','Administración de Empresas','administración_de_empresas',1,null,'1','2018-08-24 11:25:00',null,'1'),
(16,2,'Finanzas','Finanzas','finanzas',1,null,'1','2018-08-24 11:25:00',null,'1'),
(17,2,'Marketing','Marketing','marketing',1,null,'1','2018-08-24 11:25:00',null,'1'),
(18,2,'Sistema de Información Gerencial','Sistema de Información Gerencial','sistema_de_información_gerencial',1,null,'1','2018-08-24 11:25:00',null,'1'),
(19,2,'Turismo','Turismo','turismo',1,null,'1','2018-08-24 11:25:00',null,'1'),
(20,2,'Talento Humano','Talento Humano','talento_humano',1,null,'1','2018-08-24 11:25:00',null,'1'),
(21,2,'Empresas Familiares','Empresas Familiares','empresas_familiares',1,null,'1','2018-08-24 11:25:00',null,'1'),
(22,2,'Investigación','Investigación','investigación',1,null,'1','2018-08-24 11:25:00',null,'1');


-- ----------------------------------------------------
--
-- Volcado de datos para la tabla `modalidad_estudio_unidad`
INSERT INTO `modalidad_estudio_unidad` (`meun_id`, `uaca_id`, `mod_id`, `eaca_id`, `emp_id`, `meun_usuario_ingreso`, `meun_usuario_modifica`, `meun_estado`,  `meun_fecha_creacion`, `meun_fecha_modificacion`, `meun_estado_logico`) VALUES
(1,1,1,1,1,1,null,'1','2018-08-27 13:10:00',null,'1'),
(2,1,1,2,1,1,null,'1','2018-08-27 13:10:00',null,'1'),
(3,1,1,3,1,1,null,'1','2018-08-27 13:10:00',null,'1'),
(4,1,1,4,1,1,null,'1','2018-08-27 13:10:00',null,'1'),
(5,1,1,5,1,1,null,'1','2018-08-27 13:10:00',null,'1'),
(6,1,1,6,1,1,null,'1','2018-08-27 13:10:00',null,'1'),
(7,1,2,11,1,1,null,'1','2018-08-27 13:10:00',null,'1'),
(8,1,2,8,1,1,null,'1','2018-08-27 13:10:00',null,'1'),
(9,1,2,7,1,1,null,'1','2018-08-27 13:10:00',null,'1'),
(10,1,2,10,1,1,null,'1','2018-08-27 13:10:00',null,'1'),
(11,1,2,1,1,1,null,'1','2018-08-27 13:10:00',null,'1'),
(12,1,2,5,1,1,null,'1','2018-08-27 13:10:00',null,'1'),
(13,1,2,3,1,1,null,'1','2018-08-27 13:10:00',null,'1'),
(14,1,2,9,1,1,null,'1','2018-08-27 13:10:00',null,'1'),
(15,1,2,13,1,1,null,'1','2018-08-27 13:10:00',null,'1'),
(16,1,2,6,1,1,null,'1','2018-08-27 13:10:00',null,'1'),
(17,1,2,4,1,1,null,'1','2018-08-27 13:10:00',null,'1'),
(18,1,2,14,1,1,null,'1','2018-08-27 13:10:00',null,'1'),
(19,1,2,2,1,1,null,'1','2018-08-27 13:10:00',null,'1'),
(20,1,3,12,1,1,null,'1','2018-08-27 13:10:00',null,'1'),
(21,1,4,1,1,1,null,'1','2018-08-27 13:10:00',null,'1'),
(22,1,4,3,1,1,null,'1','2018-08-27 13:10:00',null,'1'),
(23,1,4,9,1,1,null,'1','2018-08-27 13:10:00',null,'1'),
(24,1,4,13,1,1,null,'1','2018-08-27 13:10:00',null,'1'),
(25,1,4,6,1,1,null,'1','2018-08-27 13:10:00',null,'1'),
(26,1,4,4,1,1,null,'1','2018-08-27 13:10:00',null,'1'),
(27,2,3,15,1,1,null,'1','2018-08-27 13:10:00',null,'1'),
(28,2,3,16,1,1,null,'1','2018-08-27 13:10:00',null,'1'),
(29,2,3,17,1,1,null,'1','2018-08-27 13:10:00',null,'1'),
(30,2,3,18,1,1,null,'1','2018-08-27 13:10:00',null,'1'),
(31,2,3,19,1,1,null,'1','2018-08-27 13:10:00',null,'1'),
(32,2,3,20,1,1,null,'1','2018-08-27 13:10:00',null,'1'),
(33,2,3,21,1,1,null,'1','2018-08-27 13:10:00',null,'1'),
(34,2,3,22,1,1,null,'1','2018-08-27 13:10:00',null,'1');

-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `modulo_estudio`
--
INSERT INTO `modulo_estudio` (`mest_id`, `uaca_id`, `mod_id`, `mest_codigo`, `mest_nombre`, `mest_descripcion`, `mest_usuario_ingreso`, `mest_usuario_modifica`, `mest_estado`, `mest_fecha_creacion`, `mest_fecha_modificacion`, `mest_estado_logico`) VALUES
(1, 3, 2, 'EMVE01', 'Emprendimiento y Ventas', 'Emprendimiento y Ventas', 1, null, '1', '2018-05-08 22:43:48', null, '1'),
(2, 3, 2, 'EXAV01', 'Excel Avanzado', 'Excel Avanzado', 1, null, '1', '2018-05-08 22:43:48', null, '1'),
(3, 3, 2, 'FOTO01', 'Fotografía', 'Fotografía', 1, null, '1', '2018-05-08 22:43:48', null, '1'),
(4, 3, 2, 'EVPL01', 'Event Planner', 'Event Planner', 1, null, '1', '2018-05-08 22:43:48', null, '1'),
(5, 3, 2, 'PGET01', 'Programa Gerencia Estratégica del TH (4 módulos)', 'Programa Gerencia Estratégica del TH (4 módulos)', 1, null, '1', '2018-05-08 22:43:48', null, '1'),
(6, 3, 2, 'PEDA01', 'Pedagogía', 'Pedagogía', 1, null, '1', '2018-05-08 22:43:48', null, '1'),
(7, 3, 2, 'RECI01', 'Redacción Científica', 'Redacción Científica', 1, null, '1', '2018-05-08 22:43:48', null, '1'),
(8, 3, 2, 'DHCR01', 'Desarrollo Habilidades Comerciales para Retail', 'Desarrollo Habilidades Comerciales para Retail', 1, null, '1', '2018-05-08 22:43:48', null, '1'),
(9, 3, 1, 'CUON01', 'Cursos Online', 'Cursos Online', 1, null, '1', '2018-05-08 22:43:48', null, '1'),
(10, 4, 2, 'IDIF01', 'Idioma Inglés, Francés', 'Idioma Inglés, Francés', 1, null, '1', '2018-05-08 22:43:48', null, '1');


-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `formacion_malla_academica`
--
INSERT INTO `formacion_malla_academica` (`fmac_id`,`fmac_codigo`,`fmac_nombre`,`fmac_descripcion`, `fmac_usuario_ingreso`,  `fmac_estado`,`fmac_estado_logico`) VALUES
(1,'FT', 'Fundamentos Teóricos','Fundamentos Teóricos', 1, '1', '1'),
(2,'PP', 'Praxis Profesional', 'Praxis Profesional', 1, '1', '1'),
(3,'EMI', 'Epistemología y Metodología de la Investigación', 'Epistemología y Metodología de la Investigación', 1, '1', '1'),
(4,'ISSC', 'Integración de Saberes, Contexto y Cultura', 'Integración de Saberes, Contexto y Cultura', 1, '1', '1'),
(5,'CL', 'Comunicación y Lenguaje', 'Comunicación y Lenguaje', '1', '1', '1'),
(6,'CN', 'Can', 'Can', '1', '1', '1'); 

-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `modulo_estudio_gestion`
--
INSERT INTO `modulo_estudio_empresa` (`meem_id`,`mest_id`,`emp_id`,`meem_fecha_inicio`,`meem_fecha_fin`, `meem_usuario_ingreso`,`meem_usuario_modifica`,`meem_estado_gestion`,`meem_estado`,`meem_fecha_creacion`,`meem_fecha_modificacion`,`meem_estado_logico`) VALUES
(1,1,1,'2018-09-01 00:00:00','2018-12-31 00:00:00',1,null,'1','1','2018-09-01 18:30:00',null,'1'),
(2,2,1,'2018-09-01 00:00:00','2018-12-31 00:00:00',1,null,'1','1','2018-09-01 18:30:00',null,'1'),
(3,3,1,'2018-09-01 00:00:00','2018-12-31 00:00:00',1,null,'1','1','2018-09-01 18:30:00',null,'1'),
(4,4,1,'2018-09-01 00:00:00','2018-12-31 00:00:00',1,null,'1','1','2018-09-01 18:30:00',null,'1'),
(5,5,1,'2018-09-01 00:00:00','2018-12-31 00:00:00',1,null,'1','1','2018-09-01 18:30:00',null,'1'),
(6,6,1,'2018-09-01 00:00:00','2018-12-31 00:00:00',1,null,'1','1','2018-09-01 18:30:00',null,'1'),
(7,7,1,'2018-09-01 00:00:00','2018-12-31 00:00:00',1,null,'1','1','2018-09-01 18:30:00',null,'1'),
(8,8,1,'2018-09-01 00:00:00','2018-12-31 00:00:00',1,null,'1','1','2018-09-01 18:30:00',null,'1'),
(9,9,1,'2018-09-01 00:00:00','2018-12-31 00:00:00',1,null,'1','1','2018-09-01 18:30:00',null,'1'),
(10,10,1,'2018-09-01 00:00:00','2018-12-31 00:00:00',1,null,'1','1','2018-09-01 18:30:00',null,'1'),
(11,1,2,'2018-09-01 00:00:00','2018-12-31 00:00:00',1,null,'1','1','2018-09-01 18:30:00',null,'1'),
(12,2,2,'2018-09-01 00:00:00','2018-12-31 00:00:00',1,null,'1','1','2018-09-01 18:30:00',null,'1'),
(13,3,2,'2018-09-01 00:00:00','2018-12-31 00:00:00',1,null,'1','1','2018-09-01 18:30:00',null,'1'),
(14,4,2,'2018-09-01 00:00:00','2018-12-31 00:00:00',1,null,'1','1','2018-09-01 18:30:00',null,'1'),
(15,5,2,'2018-09-01 00:00:00','2018-12-31 00:00:00',1,null,'1','1','2018-09-01 18:30:00',null,'1'),
(16,6,2,'2018-09-01 00:00:00','2018-12-31 00:00:00',1,null,'1','1','2018-09-01 18:30:00',null,'1'),
(17,7,2,'2018-09-01 00:00:00','2018-12-31 00:00:00',1,null,'1','1','2018-09-01 18:30:00',null,'1'),
(18,8,2,'2018-09-01 00:00:00','2018-12-31 00:00:00',1,null,'1','1','2018-09-01 18:30:00',null,'1'),
(19,9,2,'2018-09-01 00:00:00','2018-12-31 00:00:00',1,null,'1','1','2018-09-01 18:30:00',null,'1'),
(20,10,2,'2018-09-01 00:00:00','2018-12-31 00:00:00',1,null,'1','1','2018-09-01 18:30:00',null,'1'),
(21,1,3,'2018-09-01 00:00:00','2018-12-31 00:00:00',1,null,'1','1','2018-09-01 18:30:00',null,'1'),
(22,2,3,'2018-09-01 00:00:00','2018-12-31 00:00:00',1,null,'1','1','2018-09-01 18:30:00',null,'1'),
(23,3,3,'2018-09-01 00:00:00','2018-12-31 00:00:00',1,null,'1','1','2018-09-01 18:30:00',null,'1'),
(24,4,3,'2018-09-01 00:00:00','2018-12-31 00:00:00',1,null,'1','1','2018-09-01 18:30:00',null,'1'),
(25,5,3,'2018-09-01 00:00:00','2018-12-31 00:00:00',1,null,'1','1','2018-09-01 18:30:00',null,'1'),
(26,6,3,'2018-09-01 00:00:00','2018-12-31 00:00:00',1,null,'1','1','2018-09-01 18:30:00',null,'1'),
(27,7,3,'2018-09-01 00:00:00','2018-12-31 00:00:00',1,null,'1','1','2018-09-01 18:30:00',null,'1'),
(28,8,3,'2018-09-01 00:00:00','2018-12-31 00:00:00',1,null,'1','1','2018-09-01 18:30:00',null,'1'),
(29,9,3,'2018-09-01 00:00:00','2018-12-31 00:00:00',1,null,'1','1','2018-09-01 18:30:00',null,'1'),
(30,10,3,'2018-09-01 00:00:00','2018-12-31 00:00:00',1,null,'1','1','2018-09-01 18:30:00',null,'1');

-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `area_conocimiento`
--
INSERT INTO `area_conocimiento` (`acon_id`, `acon_nombre`, `acon_descripcion`, `acon_usuario_ingreso`, `acon_estado`, `acon_estado_logico`) VALUES
(1, 'Programas generales', 'Descripción de área de conocimiento', 1, '1', '1'),
(2, 'Educación', 'Descripción de área de conocimiento', 1, '1', '1'),
(3, 'Humanidades y artes', 'Descripción de área de conocimiento', 1, '1', '1'),
(4, 'Ciencias sociales, educación comercial y derecho', 'Descripción de área de conocimiento', 1, '1', '1'),
(5, 'Ciencias', 'Descripción de área de conocimiento', 1, '1', '1'),
(6, 'Ingeniería, industria y construcción', 'Descripción de área de conocimiento', 1, '1', '1'),
(7, 'Agricultura', 'Descripción de área de conocimiento', 1, '1', '1'),
(8, 'Salud y sociales servicios', 'Descripción de área de conocimiento', 1, '1', '1'),
(9, 'Servicios', 'Descripción de área de conocimiento', 1, '1', '1'),
(10, 'Sectores desconocidos no especificados', 'Descripción de área de conocimiento', 1, '1', '1');

-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `subarea_conocimiento`
--
INSERT INTO `subarea_conocimiento` (`scon_id`, `acon_id`, `scon_nombre`, `scon_descripcion`, `scon_usuario_ingreso`, `scon_estado`, `scon_estado_logico`) VALUES
(1, 1, 'Programas básicos', 'Descripción de subárea de conocimiento', 1, '1', '1'),
(2, 1, 'Programas de alfabetización y de aritmética', 'Descripción de subárea de conocimiento', 1, '1', '1'),
(3, 1, 'Desarrollo personal', 'Descripción de subárea de conocimiento', 1, '1', '1'),
(4, 2, 'Formación de personal docente y ciencias de la educación', 'Descripción de subárea de conocimiento', 1, '1', '1'),
(5, 3, 'Artes', 'Descripción de subárea de conocimiento', 1, '1', '1'),
(6, 3, 'Humanidades', 'Descripción de subárea de conocimiento', 1, '1', '1'),
(7, 4, 'Ciencias sociales y del comportamiento', 'Descripción de subárea de conocimiento', 1, '1', '1'),
(8, 4, 'Periodismo e información', 'Descripción de subárea de conocimiento', 1, '1', '1'),
(9, 4, 'Educación comercial y administración', 'Descripción de subárea de conocimiento', 1, '1', '1'),
(10, 4, 'Derecho', 'Descripción de subárea de conocimiento', 1, '1', '1'),
(11, 5, 'Ciencias de la vida', 'Descripción de subárea de conocimiento', 1, '1', '1'),
(12, 5, 'Ciencias físicas', 'Descripción de subárea de conocimiento', 1, '1', '1'),
(13, 5, 'Matemáticas y estadística', 'Descripción de subárea de conocimiento', 1, '1', '1'),
(14, 5, 'Informática', 'Descripción de subárea de conocimiento', 1, '1', '1'),
(15, 6, 'Ingeniería y profesiones afines', 'Descripción de subárea de conocimiento', 1, '1', '1'),
(16, 6, 'Industria y producción', 'Descripción de subárea de conocimiento', 1, '1', '1'),
(17, 6, 'Arquitectura y construcción', 'Descripción de subárea de conocimiento', 1, '1', '1'),
(18, 7, 'Agricultura, silvicultura y pesca', 'Descripción de subárea de conocimiento', 1, '1', '1'),
(19, 7, 'Veterinaria', 'Descripción de subárea de conocimiento', 1, '1', '1'),
(20, 8, 'Medicina', 'Descripción de subárea de conocimiento', 1, '1', '1'),
(21, 8, 'Servicios sociales', 'Descripción de subárea de conocimiento', 1, '1', '1'),
(22, 9, 'Servicios personales', 'Descripción de subárea de conocimiento', 1, '1', '1'),
(23, 9, 'Servicios de transporte', 'Descripción de subárea de conocimiento', 1, '1', '1'),
(24, 9, 'Protección del medio ambiente', 'Descripción de subárea de conocimiento', 1, '1', '1'),
(25, 9, 'Servicios de seguridad', 'Descripción de subárea de conocimiento', 1, '1', '1');

-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `asignatura` 

INSERT INTO `asignatura` (`asi_id`, `scon_id`, `asi_nombre`, `asi_descripcion`, `asi_usuario_ingreso`, `asi_estado`, `asi_fecha_creacion`, `asi_fecha_modificacion`, `asi_estado_logico`) VALUES
(1, 1, 'Matemáticas - CAN', 'Matemáticas - CAN', 1, '1', '2018-05-08 22:15:37', NULL, '1'),
(2, 1, 'Contabilidad - CAN', 'Contabilidad - CAN', 1, '1', '2018-05-08 22:15:37', NULL, '1'),
(3, 1, 'Técnicas de comunicación oral - CAN', 'Técnicas de comunicación oral - CAN', 1, '1', '2018-05-08 22:16:01', NULL, '1'),
(4, 1, 'Desarrollo del Pensamiento - CAN', 'Desarrollo del Pensamiento - CAN', 1, '1', '2018-05-08 22:16:52', NULL, '1'),
(5, 1, 'Emprendimiento - CAN', 'Emprendimiento - CAN', 1, '1', '2018-05-08 22:16:52', NULL, '1');



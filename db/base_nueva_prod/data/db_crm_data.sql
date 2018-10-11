--
-- Base de datos: `db_crm`
--
USE `db_crm`;

-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `conocimiento_canal`
--
INSERT INTO `conocimiento_canal` (`ccan_id`, `ccan_nombre`, `ccan_descripcion`, `ccan_conocimiento`, `ccan_canal`, `ccan_estado`, `ccan_estado_logico`) VALUES
(1, 'Formulario de página web', 'Formulario de página web','', '0', '1', '1'),
(2, 'Lead', 'Redes sociales (Facebook)','', '0', '1', '1'),
(3, 'Visita en sitio', 'Visita en sitio','', '1', '1', '1'),
(4, 'Llamada', 'Llamada','', '1', '1', '1'),
(5, 'Chat en línea', 'Chat en línea','', '0', '1', '1'),
(6, 'Whatsapp', 'Whatsapp','', '1', '1', '1'),
(7, 'Messenger facebook', 'Messenger facebook','', '1', '1', '1');

-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `estado_cliente`
--
INSERT INTO `estado_contacto` (`econ_id`, `econ_nombre`, `econ_descripcion`, `econ_estado`, `econ_fecha_creacion`, `econ_fecha_modificacion`, `econ_estado_logico`) VALUES
(1, 'En Contacto', 'En Contacto', '1', '2018-08-10 01:06:52', NULL, '1'),
(2, 'Calificado', 'Calificado', '1', '2018-08-10 01:06:52', NULL, '1'),
(3, 'Descalificado', 'Descalificado', '1', '2018-08-10 01:06:52', NULL, '1');



-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `estado_oportunidad`
--
INSERT INTO `estado_oportunidad` (`eopo_id`, `eopo_nombre`, `eopo_descripcion`, `eopo_tipo`, `eopo_estado`, `eopo_fecha_creacion`, `eopo_fecha_modificacion`, `eopo_estado_logico`) VALUES
(1, 'En Curso', 'En Curso', '1', '1', '2018-08-10 01:06:51', NULL, '1'),
(2, 'En Espera', 'En Espera', '1', '0', '2018-08-10 01:06:51', NULL, '1'),
(3, 'Generar Aspirante', 'Generar Aspirante', '1', '1', '2018-08-10 01:06:51', NULL, '1'),
(4, 'Ganada', 'Ganada', '1', '0', '2018-08-10 01:10:23', NULL, '1'),
(5, 'Perdida', 'Perdida', '1', '1', '2018-08-10 01:11:22', NULL, '1');


-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `oportunidad_perdida`
--
INSERT INTO `oportunidad_perdida` (`oper_id`, `oper_nombre`, `oper_descripcion`, `oper_estado`, `oper_estado_logico`) VALUES
(1, 'Precio', 'Precio', '1', '1'),
(2, 'Competencia', 'Competencia', '1', '1'),
(3, 'Malla académica', 'Malla académica', '1', '1'),
(4, 'Atención recibida', 'Atención recibida', '1', '1'),
(5, 'Ubicación', 'Ubicación', '1', '1'),
(6, 'Otra universidad', 'Otra universidad', '1', '1'),
(7, 'Modalidad de estudios', 'Modalidad de estudios', '1', '1'),
(8, 'Motivo personal', 'Motivo personal', '1', '1'),
(9, 'Viaje imprevisto', 'Viaje imprevisto', '1', '1'),
(10, 'Datos incorretos', 'Datos incorretos', '1', '1'),
(11, 'Documento no válidos', 'Documento no válidos', '1', '1');

-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `conocimiento_servicio`
--
INSERT INTO `conocimiento_servicio` (`cser_id`, `cser_nombre`, `cser_descripcion`, `cser_estado`, `cser_estado_logico`) VALUES
(1, 'Redes Sociales', 'Redes Sociales', '1', '1'),
(2, 'Radio', 'Radio', '1', '1'),
(3, 'Televisión', 'Televisión', '1', '1'),
(4, 'Sitio web', 'Sitio web', '1', '1'),
(5, 'Feria Colegio', 'Feria Colegio', '1', '1');

-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `tipo_oportunidad_venta`
--
INSERT INTO `tipo_oportunidad_venta` (`tove_id`, `uaca_id`, `tove_nombre`, `tove_descripcion`, `tove_estado`, `tove_estado_logico`) VALUES
(1, 1, 'Ingreso al CAN', 'Ingreso al CAN', '1', '1'),
(2, 1, 'Ingreso por Homologación', 'Ingreso por Homologación', '1', '1'),
(3, 1, 'Ingreso por Examen de Admisión', 'Ingreso por Examen de Admisión', '1', '1'),
(4, 1, 'Ingreso al primer semestre', 'Ingreso al primer semestre', '1', '1'),
(5, 2, 'Ingreso al Curso Propedéutico', 'Ingreso al Curso Propedéutico', '1', '1'),
(6, 2, 'Ingreso al primer módulo de maestría', 'Ingreso al primer módulo de maestría', '1', '1'),
(7, 2, 'Ingreso por Homologación', 'Ingreso por Homologación', '1', '1'),
(8, 3, 'Ingreso a curso de Educación Continua', 'Ingreso a curso de Educación Continua', '1', '1'),
(9, 4, 'Ingreso de Centro de Idiomas', 'Ingreso de Centro de Idiomas', '1', '1'),
(10, 5, 'Ingreso Diplomado', 'Ingreso a Diplomado', '1', '1'),
(11, 6, 'Ingreso a curso de Nivelación', 'Ingreso a curso de  Nivelación', '1', '1');

-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `tipo_carrera`
-- --------------------------------------------------------
INSERT INTO `tipo_carrera` (`tcar_id`, `tcar_nombre`, `tcar_descripcion`, `tcar_estado`, `tcar_estado_logico`) VALUES
(1,'Abastecimiento y Logística','Abastecimiento y Logística','1','1'),
(2,'Administración Contabilidad y Finanzas','Administración Contabilidad y Finanzas','1','1'),
(3,'Aduana y Comercio Exterior','Aduana y Comercio Exterior','1','1'),
(4,'Atención al Cliente, Call Center y Telemarketing','Atención al Cliente, Call Center y Telemarketing','1','1'),
(5,'Comercial, Ventas y Negocios','Comercial, Ventas y Negocios','1','1'),
(6,'Comunicación, Relaciones Institucionales y Publicas','Comunicación, Relaciones Institucionales y Publicas','1','1'),
(7,'Diseño','Diseño','1','1'),
(8,'Educación, Docencia e Investigación','Educación, Docencia e Investigación','1','1'),
(9,'Enfermería','Enfermería','1','1'),
(10,'Farmacia/Bioquímica','Farmacia/Bioquímica','1','1'),
(11,'Gastronomía y Turismo','Gastronomía y Turismo','1','1'),
(12,'Gerencia y Dirección General','Gerencia y Dirección General','1','1'),
(13,'Ingeniería Civil y Construcción','Ingeniería Civil y Construcción','1','1'),
(14,'Ingenierías','Ingenierías','1','1'),
(15,'Legales','Legales','1','1'),
(16,'Marketing y Publicidad','Marketing y Publicidad','1','1'),
(17,'Minería, Petroleo y Gas','Minería, Petroleo y Gas','1','1'),
(18,'Oficios y Otros','Oficios y Otros','1','1'),
(19,'Producción y Manufactura','Producción y Manufactura','1','1'),
(20,'Recursos Humanos y Capacitación','Recursos Humanos y Capacitación','1','1'),
(21,'Salud','Salud','1','1'),
(22,'Salud, Medicina y Farmacia','Salud, Medicina y Farmacia','1','1'),
(23,'Secretarias y Recepción','Secretarias y Recepción','1','1'),
(24,'Seguros','Seguros','1','1'),
(25,'Tecnología, Sistemas y Telecomunicaciones','Tecnología, Sistemas y Telecomunicaciones','1','1'),
(26,'Trabajo Social','Trabajo Social','1','1');

-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `tipo_sub_carrera`
-- --------------------------------------------------------
INSERT INTO `tipo_sub_carrera` (`tsca_id`, `tcar_id`, `tsca_nombre`, `tsca_descripcion`,`tsca_estado`, `tsca_estado_logico`) VALUES
(1,1,'Abastecimiento','Abastecimiento','1','1'),
(2,1,'Almacén/Depósito/Expedición','Almacén/Depósito/Expedición','1','1'),
(3,1,'Asistente De Trafico','Asistente De Trafico','1','1'),
(4,1,'Compras','Compras','1','1'),
(5,1,'Distribución','Distribución','1','1'),
(6,1,'Logística','Logística','1','1'),
(7,1,'Transporte','Transporte','1','1'),
(8,2,'Administración','Administración','1','1'),
(9,2,'Análisis De Riesgos','Análisis De Riesgos','1','1'),
(10,2,'Auditoria','Auditoria','1','1'),
(11,2,'Consultoría','Consultoría','1','1'),
(12,2,'Contabilidad','Contabilidad','1','1'),
(13,2,'Control De Gestión','Control De Gestión','1','1'),
(14,2,'Corporate Finance / Banca Inversión','Corporate Finance / Banca Inversión','1','1'),
(15,2,'Créditos y Cobranzas','Créditos y Cobranzas','1','1'),
(16,2,'Cuentas Corrientes','Cuentas Corrientes','1','1'),
(17,2,'Evaluación Económica','Evaluación Económica','1','1'),
(18,2,'Facturación','Facturación','1','1'),
(19,2,'Finanzas','Finanzas','1','1'),
(20,2,'Finanzas Internacionales','Finanzas Internacionales','1','1'),
(21,2,'Impuestos','Impuestos','1','1'),
(22,2,'Inversiones / Proyectos De Inversión','Inversiones / Proyectos De Inversión','1','1'),
(23,2,'Organización y Métodos','Organización y Métodos','1','1'),
(24,2,'Planeamiento Económico-Financiero','Planeamiento Económico-Financiero','1','1'),
(25,2,'Tesorería','Tesorería','1','1'),
(26,3,'Apoderado Aduanal','Apoderado Aduanal','1','1'),
(27,3,'Compras Internacionales/Importación','Compras Internacionales/Importación','1','1'),
(28,3,'Consultoría Comercio Exterior','Consultoría Comercio Exterior','1','1'),
(29,3,'Ventas Internacionales/Exportación','Ventas Internacionales/Exportación','1','1'),
(30,4,'Atención Al Cliente','Atención Al Cliente','1','1'),
(31,4,'Call Center','Call Center','1','1'),
(32,4,'Telemarketing','Telemarketing','1','1'),
(33,5,'Comercial','Comercial','1','1'),
(34,5,'Comercio Exterior','Comercio Exterior','1','1'),
(35,5,'Desarrollo De Negocios','Desarrollo De Negocios','1','1'),
(36,5,'Negocios Internacionales','Negocios Internacionales','1','1'),
(37,5,'Planeamiento Comercial','Planeamiento Comercial','1','1'),
(38,5,'Ventas','Ventas','1','1'),
(39,6,'Comunicación','Comunicación','1','1'),
(40,6,'Comunicaciones Externas','Comunicaciones Externas','1','1'),
(41,6,'Comunicaciones Internas','Comunicaciones Internas','1','1'),
(42,6,'Periodismo','Periodismo','1','1'),
(43,6,'Relaciones Institucionales/Publicas','Relaciones Institucionales/Publicas','1','1'),
(44,6,'Responsabilidad Social','Responsabilidad Social','1','1'),
(45,7,'Diseño','Diseño','1','1'),
(46,7,'Diseño 3D','Diseño 3D','1','1'),
(47,7,'Diseño Gráfico','Diseño Gráfico','1','1'),
(48,7,'Diseño Industrial','Diseño Industrial','1','1'),
(49,7,'Diseño Multimedia','Diseño Multimedia','1','1'),
(50,7,'Diseño Textil E Indumentaria','Diseño Textil E Indumentaria','1','1'),
(51,7,'Diseño Web','Diseño Web','1','1'),
(52,7,'Diseño De Interiores / Decoración','Diseño De Interiores / Decoración','1','1'),
(53,8,'Bienestar Estudiantil','Bienestar Estudiantil','1','1'),
(54,8,'Educación','Educación','1','1'),
(55,8,'Educación Especial','Educación Especial','1','1'),
(56,8,'Educación/ Docentes','Educación/ Docentes','1','1'),
(57,8,'Idiomas','Idiomas','1','1'),
(58,8,'Investigación y Desarrollo','Investigación y Desarrollo','1','1'),
(59,9,'Central De Emergencias Adultos','Central De Emergencias Adultos','1','1'),
(60,9,'Central De Emergencias Pediátricas','Central De Emergencias Pediátricas','1','1'),
(61,9,'Clínica Medica','Clínica Medica','1','1'),
(62,9,'Consultorios','Consultorios','1','1'),
(63,9,'Cuidados Intensivos Cardiologicos Adultos','Cuidados Intensivos Cardiologicos Adultos','1','1'),
(64,9,'Hemodinamia','Hemodinamia','1','1'),
(65,9,'Internacion General Pediátrica','Internacion General Pediátrica','1','1'),
(66,9,'Internacion Domiciliaria','Internacion Domiciliaria','1','1'),
(67,9,'Maternidad','Maternidad','1','1'),
(68,9,'Nefrología','Nefrología','1','1'),
(69,9,'Oncologia','Oncologia','1','1'),
(70,9,'Recién Nacido Sano','Recién Nacido Sano','1','1'),
(71,9,'Recuperación De Anestesia','Recuperación De Anestesia','1','1'),
(72,9,'Terapia Intensiva Adultos','Terapia Intensiva Adultos','1','1'),
(73,9,'Terapia Intensiva Pediátrica','Terapia Intensiva Pediátrica','1','1'),
(74,9,'Terapia Intermedia Adultos','Terapia Intermedia Adultos','1','1'),
(75,9,'Terapia Intermedia Pediátrica','Terapia Intermedia Pediátrica','1','1'),
(76,9,'Terapia Neonatal','Terapia Neonatal','1','1'),
(77,9,'Vacunatorio','Vacunatorio','1','1'),
(78,10,'Bioquímica','Bioquímica','1','1'),
(79,10,'Farmacia Comercial','Farmacia Comercial','1','1'),
(80,10,'Farmacia Hospitalaria','Farmacia Hospitalaria','1','1'),
(81,10,'Farmacia Industrial','Farmacia Industrial','1','1'),
(82,10,'Química','Química','1','1'),
(83,11,'Camareros','Camareros','1','1'),
(84,11,'Casinos','Casinos','1','1'),
(85,11,'Gastronomía','Gastronomía','1','1'),
(86,11,'Hoteleria','Hoteleria','1','1'),
(87,11,'Turismo','Turismo','1','1'),
(88,12,'Dirección','Dirección','1','1'),
(89,12,'Gerencia / Dirección General','Gerencia / Dirección General','1','1'),
(90,13,'Arquitectura','Arquitectura','1','1'),
(91,13,'Construcción','Construcción','1','1'),
(92,13,'Dirección De Obra','Dirección De Obra','1','1'),
(93,13,'Ingeniería Civil','Ingeniería Civil','1','1'),
(94,13,'Instrumentación','Instrumentación','1','1'),
(95,13,'Operaciones','Operaciones','1','1'),
(96,13,'Seguridad E Higiene','Seguridad E Higiene','1','1'),
(97,13,'Topografía','Topografía','1','1'),
(98,13,'Urbanismo','Urbanismo','1','1'),
(99,14,'Ingeniería Automotriz','Ingeniería Automotriz','1','1'),
(100,14,'Ingeniería Eléctrica y Electrónica','Ingeniería Eléctrica y Electrónica','1','1'),
(101,14,'Ingeniería Industrial','Ingeniería Industrial','1','1'),
(102,14,'Ingeniería Mecánica','Ingeniería Mecánica','1','1'),
(103,14,'Ingeniería Metalúrgica','Ingeniería Metalúrgica','1','1'),
(104,14,'Ingeniería Textil','Ingeniería Textil','1','1'),
(105,14,'Ingeniería Agrónoma','Ingeniería Agrónoma','1','1'),
(106,14,'Ingeniería Electromecánica','Ingeniería Electromecánica','1','1'),
(107,14,'Ingeniería Oficina Técnica / Proyecto','Ingeniería Oficina Técnica / Proyecto','1','1'),
(108,14,'Ingeniería Química','Ingeniería Química','1','1'),
(109,14,'Ingeniería De Procesos','Ingeniería De Procesos','1','1'),
(110,14,'Ingeniería De Producto','Ingeniería De Producto','1','1'),
(111,14,'Ingeniería De Ventas','Ingeniería De Ventas','1','1'),
(112,14,'Ingeniería En Alimentos','Ingeniería En Alimentos','1','1'),
(113,14,'Otras Ingenierías','Otras Ingenierías','1','1'),
(114,15,'Asesoría Legal Internacional','Asesoría Legal Internacional','1','1'),
(115,15,'Legal','Legal','1','1'),
(116,16,'Business Intelligence','Business Intelligence','1','1'),
(117,16,'Community Management','Community Management','1','1'),
(118,16,'Creatividad','Creatividad','1','1'),
(119,16,'E-Commerce','E-Commerce','1','1'),
(120,16,'Marketing','Marketing','1','1'),
(121,16,'Media Planning','Media Planning','1','1'),
(122,16,'Mercadotecnia Internacional','Mercadotecnia Internacional','1','1'),
(123,16,'Multimedia','Multimedia','1','1'),
(124,16,'Producto','Producto','1','1'),
(125,17,'Exploración Minera y Petroleoquímica','Exploración Minera y Petroleoquímica','1','1'),
(126,17,'Ingeniería Geológica','Ingeniera Geológica','1','1'),
(127,17,'Ingeniería En Minas','Ingeniería En Minas','1','1'),
(128,17,'Ingeniería En Petroleo y Petroleoquímica','Ingeniería En Petroleo y Petroleoquímica','1','1'),
(129,17,'Instrumentación Minera','Instrumentación Minera','1','1'),
(130,17,'Medio Ambiente','Medio Ambiente','1','1'),
(131,17,'Minería/Petroleo/Gas','Minería/Petroleo/Gas','1','1'),
(132,17,'Seguridad Industrial','Seguridad Industrial','1','1'),
(133,18,'Arte y Cultura','Arte y Cultura','1','1'),
(134,18,'Back Office','Back Office','1','1'),
(135,18,'Cadeteria','Cadeteria','1','1'),
(136,18,'Caja','Caja','1','1'),
(137,18,'Estética y Cuidado Personal','Estética y Cuidado Personal','1','1'),
(138,18,'Independientes','Independientes','1','1'),
(139,18,'Jóvenes Profesionales','Jóvenes Profesionales','1','1'),
(140,18,'Mantenimiento y Limpieza','Mantenimiento y Limpieza','1','1'),
(141,18,'Oficios y Profesiones','Oficios y Profesiones','1','1'),
(142,18,'Otros','Otros','1','1'),
(143,18,'Pasantía / Trainee','Pasantía / Trainee','1','1'),
(144,18,'Planeamiento','Planeamiento','1','1'),
(145,18,'Promotoras/Es','Promotoras/Es','1','1'),
(146,18,'Practicas Profesionales','Practicas Profesionales','1','1'),
(147,18,'Seguridad','Seguridad','1','1'),
(148,18,'Servicios','Servicios','1','1'),
(149,18,'Trabajo Social','Trabajo Social','1','1'),
(150,18,'Traducción','Traducción','1','1'),
(151,18,'Transporte','Transporte','1','1'),
(152,19,'Calidad','Calidad','1','1'),
(153,19,'Mantenimiento','Mantenimiento','1','1'),
(154,19,'Producción','Producción','1','1'),
(155,19,'Programación De Producción','Programación De Producción','1','1'),
(156,20,'Administración De Personal','Administración De Personal','1','1'),
(157,20,'Capacitación','Capacitación','1','1'),
(158,20,'Capacitación Comercio Exterior','Capacitación Comercio Exterior','1','1'),
(159,20,'Compensación y Planilla','Compensación y Planilla','1','1'),
(160,20,'Recursos Humanos','Recursos Humanos','1','1'),
(161,20,'Selección','Selección','1','1'),
(162,21,'Anatomía Patológica (técnicos)','Anatomía Patológica (técnicos)','1','1'),
(163,21,'Anestesia (técnicos)','Anestesia (técnicos)','1','1'),
(164,21,'Auditoria Medica','Auditoria Medica','1','1'),
(165,21,'Cosmiatra / Democratizaría','Cosmiatra / Democratizaría','1','1'),
(166,21,'Diagnostico Por Imágenes','Diagnostico Por Imágenes','1','1'),
(167,21,'Emergentología','Emergentología','1','1'),
(168,21,'Enfermería (ver Enfermería)','Enfermería (ver Enfermería)','1','1'),
(169,21,'Esterilización','Esterilización','1','1'),
(170,21,'Fonoaudiología','Fonoaudiología','1','1'),
(171,21,'Hoteleria','Hoteleria','1','1'),
(172,21,'Instrumentación Quirúrgica','Instrumentación Quirúrgica','1','1'),
(173,21,'Kinesiologia / Terapia Ocupacional','Kinesiologia / Terapia Ocupacional','1','1'),
(174,21,'Laboratorio','Laboratorio','1','1'),
(175,21,'Medicina Laboral','Medicina Laboral','1','1'),
(176,21,'Medicina Transfusional','Medicina Transfusional','1','1'),
(177,21,'Neurología (técnicos)','Neurología (técnicos)','1','1'),
(178,21,'Nutrición','Nutrición','1','1'),
(179,21,'Odontología','Odontología','1','1'),
(180,21,'Otras Especialidades Medicas','Otras Especialidades Medicas','1','1'),
(181,21,'Otras Áreas Técnicas En Salud','Otras Áreas Técnicas En Salud','1','1'),
(182,21,'Practicas Cardiológicas','Practicas Cardiológicas','1','1'),
(183,21,'Psicología','Psicología','1','1'),
(184,21,'Traslados (choferes - Camilleros)','Traslados (choferes - Camilleros)','1','1'),
(185,21,'Veterinaria','Veterinaria','1','1'),
(186,22,'Bioquímica','Bioquímica','1','1'),
(187,22,'Farmacéutica','Farmacéutica','1','1'),
(188,22,'Laboratorio','Laboratorio','1','1'),
(189,22,'Medicina','Medicina','1','1'),
(190,22,'Química','Química','1','1'),
(191,22,'Salud','Salud','1','1'),
(192,22,'Veterinaria','Veterinaria','1','1'),
(193,23,'Asistente','Asistente','1','1'),
(194,23,'Recepcionista','Recepcionista','1','1'),
(195,23,'Secretaria','Secretaria','1','1'),
(196,23,'Telefonista','Telefonista','1','1'),
(197,24,'Administración De Seguros','Administración De Seguros','1','1'),
(198,24,'Auditoria De Seguros','Auditoria De Seguros','1','1'),
(199,24,'Seguros','Seguros','1','1'),
(200,24,'Técnico De Seguros','Técnico De Seguros','1','1'),
(201,24,'Venta De Seguros','Venta De Seguros','1','1'),
(202,25,'Administración De Base De Datos','Administración De Base De Datos','1','1'),
(203,25,'Análisis Funcional','Análisis Funcional','1','1'),
(204,25,'Business Intelligence','Business Intelligence','1','1'),
(205,25,'Data Entry','Data Entry','1','1'),
(206,25,'Data Warehousing','Data Warehousing','1','1'),
(207,25,'Infraestructura','Infraestructura','1','1'),
(208,25,'Internet','Internet','1','1'),
(209,25,'Liderazgo De Proyecto','Liderazgo De Proyecto','1','1'),
(210,25,'Programación','Programación','1','1'),
(211,25,'Redes','Redes','1','1'),
(212,25,'Seguridad Informática','Seguridad Informática','1','1'),
(213,25,'Sistemas','Sistemas','1','1'),
(214,25,'Soporte Técnico','Soporte Técnico','1','1'),
(215,25,'Tecnología / Sistemas','Tecnología / Sistemas','1','1'),
(216,25,'Tecnologías de la Información','Tecnologías de la Información','1','1'),
(217,25,'Telecomunicaciones','Telecomunicaciones','1','1'),
(218,25,' Testing / QA / QC','Testing / QA / QC','1','1'),
(219,26,'Trabajo Social','Trabajo Social','1','1');

-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `personal_admision`
-- --------------------------------------------------------
INSERT INTO `personal_admision` (`padm_id`, `per_id`, `grol_id`, `padm_codigo`, `padm_tipo_asignacion`, `padm_estado`, `padm_estado_logico`) VALUES
(1, 13, 8, '001', '0', '1', '1'),  /*Admision01*/
(2, 14, 8, '002', '0', '1', '1'), /*Admision02*/
(3, 15, 8, '003', '0', '1', '1'), /*Admision03*/
(4, 16, 8, '004', '0', '1', '1'), /*Admision04*/
(5, 5, 6, 'SUP001', '0', '1', '1'), /*Andrea Bejarano*/
(6, 22, 14,  'JEF001', '0', '1', '1'), /*Ana María Alcívar*/
(7, 27, 18, 'SUP002', '0', '1', '1'),  /*Andrés Hernández*/
(8, 6, 7, '005', '0', '1', '1'),  /*Admision05*/
(9, 7, 7, '006', '0', '1', '1'),  /*Admision06*/
(10, 29, 19, 'JEF002', '0', '1', '1'),  /*Diana Pineda*/
(11, 28, 19, 'JEF003', '0', '1', '1'),  /*Xavier Mosquera*/
(12, 17, 8, '007', '0', '1', '1'),  /*Ventasposgrado02*/
(13, 9, 7, 'SUP003', '0', '1', '1'),  /*Supervisor Posgrado*/ 
(14, 11, 8, 'CONTACT01', '1','1', '1'), /****COLOMBIA****/
(15, 12, 8, 'CONTACT02', '1','1', '1'), /****COLOMBIA****/
(16, 18, 8, 'CONTACT03', '1','1', '1'), /****COLOMBIA****/
(17, 19, 8, 'CONTACT04', '1','1', '1'), /****COLOMBIA****/
(18, 20, 8, 'SUPEXT', '0','1', '1');   /****COLOMBIA****/

-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `personal_nivel_modalidad`
-- --------------------------------------------------------
INSERT INTO `personal_nivel_modalidad` (`pnmo_id`, `padm_id`, `uaca_id`, `mod_id`, `emp_id`, `pnmo_estado`, `pnmo_estado_logico`) VALUES
(1, 1, 1, 2, 1, '1', '1'),
(2, 1, 1, 3, 1, '1', '1'),
(3, 1, 1, 4, 1, '1', '1'),
(4, 2, 1, 2, 1, '1', '1'),
(5, 2, 1, 3, 1, '1', '1'),
(6, 2, 1, 4, 1, '1', '1'),
(7, 3, 1, 2, 1, '1', '1'),
(8, 3, 1, 3, 1, '1', '1'),
(9, 3, 1, 4, 1, '1', '1'),
(10, 4, 1, 2, 1, '1', '1'),
(11, 4, 1, 3, 1, '1', '1'),
(12, 4, 1, 4, 1, '1', '1'),
(13, 5, 1, 1, 1, '1', '1'),
(14, 5, 1, 2, 1, '1', '1'),
(15, 5, 1, 3, 1, '1', '1'),
(16, 5, 1, 4, 1, '1', '1'),
(17, 5, 2, 1, 1, '1', '1'),
(18, 5, 2, 2, 1, '1', '1'),
(19, 5, 2, 3, 1, '1', '1'),
(20, 5, 2, 4, 1, '1', '1'),
(21, 6, 1, 1, 1, '1', '1'),
(22, 7, 1, 1, 1, '1', '1'),
(23, 8, 1, 1, 1, '1', '1'),
(24, 9, 1, 1, 1, '1', '1'),
(25, 10, 1, 3, 1, '1', '1'),
(26, 10, 1, 4, 1, '1', '1'),
(27, 11, 1, 2, 1, '1', '1'),
(28, 12, 2, 3, 1, '1', '1'),
(29, 13, 2, 4, 1, '1', '1'),
(30, 14, 1, 1, 1, '1', '1'),
(31, 14, 1, 2, 1, '1', '1'),
(32, 14, 1, 3, 1, '1', '1'),
(33, 14, 1, 4, 1, '1', '1'),
(34, 14, 2, 1, 1, '1', '1'),
(35, 14, 2, 2, 1, '1', '1'),
(36, 14, 2, 3, 1, '1', '1'),
(37, 14, 2, 4, 1, '1', '1'),
(38, 15, 1, 1, 1, '1', '1'),
(39, 15, 1, 2, 1, '1', '1'),
(40, 15, 1, 3, 1, '1', '1'),
(41, 15, 1, 4, 1, '1', '1'),
(42, 15, 2, 1, 1, '1', '1'),
(43, 15, 2, 2, 1, '1', '1'),
(44, 15, 2, 3, 1, '1', '1'),
(45, 15, 2, 4, 1, '1', '1'),
(46, 16, 1, 1, 1, '1', '1'),
(47, 16, 1, 2, 1, '1', '1'),
(48, 16, 1, 3, 1, '1', '1'),
(49, 16, 1, 4, 1, '1', '1'),
(50, 16, 2, 1, 1, '1', '1'),
(51, 16, 2, 2, 1, '1', '1'),
(52, 16, 2, 3, 1, '1', '1'),
(53, 16, 2, 4, 1, '1', '1'),
(54, 17, 1, 1, 1, '1', '1'),
(55, 17, 1, 2, 1, '1', '1'),
(56, 17, 1, 3, 1, '1', '1'),
(57, 17, 1, 4, 1, '1', '1'),
(58, 17, 2, 1, 1, '1', '1'),
(59, 17, 2, 2, 1, '1', '1'),
(60, 17, 2, 3, 1, '1', '1'),
(61, 17, 2, 4, 1, '1', '1'),
(62, 18, 1, 1, 1, '1', '1'),
(63, 18, 1, 2, 1, '1', '1'),
(64, 18, 1, 3, 1, '1', '1'),
(65, 18, 1, 4, 1, '1', '1'),
(66, 18, 2, 1, 1, '1', '1'),
(67, 18, 2, 2, 1, '1', '1'),
(68, 18, 2, 3, 1, '1', '1'),
(69, 18, 2, 4, 1, '1', '1'),
(70, 14, 6, 1, 2, '1', '1'),
(71, 14, 5, 1, 2, '1', '1'),
(72, 14, 3, 1, 2, '1', '1'),
(73, 14, 2, 1, 2, '1', '1'),
(74, 15, 6, 1, 2, '1', '1'),
(75, 15, 5, 1, 2, '1', '1'),
(76, 15, 3, 1, 2, '1', '1'),
(77, 15, 2, 1, 2, '1', '1'),
(78, 16, 6, 1, 2, '1', '1'),
(79, 16, 5, 1, 2, '1', '1'),
(80, 16, 3, 1, 2, '1', '1'),
(81, 16, 2, 1, 2, '1', '1'),
(82, 17, 6, 1, 2, '1', '1'),
(83, 17, 5, 1, 2, '1', '1'),
(84, 17, 3, 1, 2, '1', '1'),
(85, 17, 2, 1, 2, '1', '1'),
(86, 14, 3, 2, 3, '1', '1'),
(87, 15, 3, 2, 3, '1', '1'),
(88, 16, 3, 2, 3, '1', '1'),
(89, 17, 3, 2, 3, '1', '1');

-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `observacion_actividades`
--
INSERT INTO `observacion_actividades` (`oact_id`, `oact_nombre`, `oact_descripcion`, `oact_estado`, `oact_usuario`, `oact_usuario_modif`, `oact_fecha_creacion`, `oact_fecha_modificacion`, `oact_estado_logico`) VALUES
(1, 'Interesado', 'Interesado', '1', 1, NULL, '2018-09-22 05:00:00', NULL, '1'),
(2, 'No contesta', 'No contesta', '1', 1, NULL, '2018-09-22 05:00:00', NULL, '1'),
(3, 'Volver a llamar', 'Volver a llamar', '1', 1, NULL, '2018-09-22 05:00:00', NULL, '1'),
(4, 'Online', 'Online', '1', 1, NULL, '2018-09-22 05:00:00', NULL, '1'),
(5, 'Distancia', 'Distancia', '1', 1, NULL, '2018-09-22 05:00:00', NULL, '1'),
(6, 'Mensaje a tercero', 'Mensaje a tercero', '1', 1, NULL, '2018-09-22 05:00:00', NULL, '1'),
(7, 'Matriculado', 'Matriculado', '1', 1, NULL, '2018-09-22 05:00:00', NULL, '1'),
(9, 'Estudiante antiguo', 'Estudiante antiguo', '1', 1, NULL, '2018-09-22 05:00:00', NULL, '1'),
(10, 'Graduado', 'Graduado', '1', 1, NULL, '2018-09-22 05:00:00', NULL, '1'),
(11, 'Visita la universidad', 'Visita la universidad', '1', 1, NULL, '2018-09-22 05:00:00', NULL, '1'),
(12, 'Aplazado', 'Aplazado', '1', 1, NULL, '2018-09-22 05:00:00', NULL, '1'),
(13, 'Enviar email', 'Enviar email', '1', 1, NULL, '2018-09-22 05:00:00', NULL, '1'),
(14, 'Descartado', 'Descartado', '1', 1, NULL, '2018-09-22 05:00:00', NULL, '1');
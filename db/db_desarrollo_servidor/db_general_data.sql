--
-- Base de datos: `db_general`
--
USE `db_general`;

-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `tipo_contacto_general`
-- --------------------------------------------------------
INSERT INTO `tipo_contacto_general` (`tcge_id`, `tcge_nombre`, `tcge_descripcion`, `tcge_estado`, `tcge_estado_logico`) VALUES
(1, 'Emergencia', 'Emergencia', '1', '1'),
(2, 'Experiencia Laboral', 'Privado', '1', '1'),
(3, 'Experiencia Docencia','Experiencia Docencia',  '1', '1');


-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `tipo_antecedente_familia`
-- --------------------------------------------------------
INSERT INTO `tipo_antecedente_familia` (`tafa_id`, `tafa_nombre`, `tafa_descripcion`, `tafa_estado`, `tafa_estado_logico`) VALUES
(1, 'Integrantes', 'Integrantes de familia que viven con profesor', '1', '1'),
(2, 'Familiares','Familiares en la institucion',  '1', '1');

-- ---------------------------------------------------
--
-- Volcado de datos para la tabla `institucion`
-- ---------------------------------------------------
INSERT INTO `institucion` (`ins_id`, `ins_categoria`, `pai_id`, `pro_id`, `can_id`, `ins_nombre`, `ins_abreviacion`, `ins_direccion_institucion`, `ins_telefono_institucion`, `ins_enlace`, `ins_estado`, `ins_estado_logico`) VALUES
(1, 'A',57, null, null, 'Escuela Politécnica Nacional', null, null, null, null, '1', '1'),
(2, 'A',57, null, null, 'Escuela Superior Politécnica del Litoral', null, null, null, null, '1', '1'),
(3, 'A',57, null, null, 'Universidad San Francisco de Quito', null, null, null, null, '1', '1'),
(4, 'A',57, null, null, 'Universidad de Cuenca', null, null, null, null, '1', '1'),
(5, 'A',57, null, null, 'Universidad de las Fuerzas Armadas (ESPE)', null, null, null, null, '1', '1'),
(6, 'A',57, null, null, 'Universidad de Especialidades Espíritu Santo', null, null, null, null, '1', '1'),
(7, 'A',57, null, null, 'Facultad Latinoamericana de Ciencias Sociales', null, null, null, null, '1', '1'),
(8, 'A',57, null, null, 'Universidad Andina Simón Bolívar', null, null, null, null, '1', '1'),
(9, 'B',57, null, null, 'Escuela Superior Politécnica de Chimborazo', null, null, null, null, '1', '1'),
(10, 'B',57, null, null, 'Pontificia Universidad Católica del Ecuador', null, null, null, null, '1', '1'),
(11, 'B',57, null, null, 'Universidad Casa Grande', null, null, null, null, '1', '1'),
(12, 'B',57, null, null, 'Universidad Católica de Santiago de Guayaquil', null, null, null, null, '1', '1'),
(13, 'B',57, null, null, 'Universidad Central del Ecuador', null, null, null, null, '1', '1'),
(14, 'B',57, null, null, 'Universidad del Azuay', null, null, null, null, '1', '1'),
(15, 'B',57, null, null, 'Universidad Estatal de Milagro', null, null, null, null, '1', '1'),
(16, 'B',57, null, null, 'Universidad Nacional de Loja', null, null, null, null, '1', '1'),
(17, 'B',57, null, null, 'Universidad Particular Internacional SEK', null, null, null, null, '1', '1'),
(18, 'B',57, null, null, 'Universidad Politécnica Salesiana', null, null, null, null, '1', '1'),
(19, 'B',57, null, null, 'Universidad Técnica de Ambato', null, null, null, null, '1', '1'),
(20, 'B',57, null, null, 'Universidad Técnica del Norte', null, null, null, null, '1', '1'),
(21, 'B',57, null, null, 'Universidad Técnica Estatal de Quevedo', null, null, null, null, '1', '1'),
(22, 'B',57, null, null, 'Universidad Técnica Particular de Loja', null, null, null, null, '1', '1'),
(23, 'B',57, null, null, 'Universidad Tecnológica Empresarial de Guayaquil', null, null, null, null, '1', '1'),
(24, 'B',57, null, null, 'Universidad Tecnológica Equinoccial', null, null, null, null, '1', '1'),
(25, 'B',57, null, null, 'Universidad Tecnológica Indoamérica', null, null, null, null, '1', '1'),
(26, 'B',57, null, null, 'Universidad de los Hemisferios', null, null, null, null, '1', '1'),
(27, 'B',57, null, null, 'Universidad Estatal Amazónica', null, null, null, null, '1', '1'),
(28, 'B',57, null, null, 'Universidad Politécnica del Carchi', null, null, null, null, '1', '1'),
(29, 'B',57, null, null, 'Universidad Iberoamericana', null, null, null, null, '1', '1'),
(30, 'B',57, null, null, 'Universidad Técnica de Manabí', null, null, null, null, '1', '1'),
(31, 'B',57, null, null, 'Universidad de las Américas', null, null, null, null, '1', '1'),
(32, 'B',57, null, null, 'Universidad Internacional del Ecuador', null, null, null, null, '1', '1'),
(33, 'B',57, null, null, 'Universidad de Guayaquil', null, null, null, null, '1', '1'),
(34, 'B',57, null, null, 'Universidad Técnica de Machala', null, null, null, null, '1', '1'),
(35, 'B',57, null, null, 'Universidad Católica de Cuenca', null, null, null, null, '1', '1'),
(36, 'B',57, null, null, 'Instituto de Altos Estudios Nacionales', null, null, null, null, '1', '1'),
(37, 'C',57, null, null, 'Escuela Superior Politécnica Agropecuaria de Manabí', null, null, null, null, '1', '1'),
(38, 'C',57, null, null, 'Universidad de Especialidades Turísticas', null, null, null, null, '1', '1'),
(39, 'C',57, null, null, 'Universidad del Pacífico Escuela de Negocios', null, null, null, null, '1', '1'),
(40, 'C',57, null, null,  'Universidad Estatal de Bolívar', null, null, null, null, '1', '1'),
(41, 'C',57, null, null, 'Universidad Laica Vicente Rocafuerte de Guayaquil', null, null, null, null, '1', '1'),
(42, 'C',57, null, null, 'Universidad Metropolitana', null, null, null, null, '1', '1'),
(43, 'C',57, null, null, 'Universidad Nacional del Chimborazo', null, null, null, null, '1', '1'),
(44, 'C',57, null, null, 'Universidad Regional Autónoma de los Andes', null, null, null, null, '1', '1'),
(45, 'C',57, null, null, 'Universidad Técnica de Babahoyo', null, null, null, null, '1', '1'),
(46, 'C',57, null, null, 'Universidad Tecnológica Israel', null, null, null, null, '1', '1'),
(47, 'C',57, null, null, 'Universidad Estatal Península de Santa Elena', null, null, null, null, '1', '1'),
(48, 'C',57, null, null, 'Universidad Particular San Gregorio de Portoviejo', null, null, null, null, '1', '1'),
(49, 'C',57, null, null, 'Universidad Tecnológica ECOTEC', null, null, null, null, '1', '1'),
(50, 'C',57, null, null, 'Universidad Técnica de Cotopaxi', null, null, null, null, '1', '1'),
(51, 'C',57, null, null, 'Universidad Estatal del Sur de Manabí', null, null, null, null, '1', '1'),
(52, 'C',57, null, null, 'Universidad de Otavalo', null, null, null, null, '1', '1'),
(53, 'C',57, null, null, 'Universidad Agraria del Ecuador', null, null, null, null, '1', '1'),
(54, 'C',57, null, null, 'Universidad Laica Eloy Alfaro de Manabí', null, null, null, null, '1', '1'),
(55, 'C',57, null, null, 'Universidad Técnica Luis Vargas Torres de Esmeraldas', null, null, null, null, '1', '1');

-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `tipo_curricular`
-- --------------------------------------------------------
INSERT INTO `tipo_curricular` (`tcur_id`, `tcur_nombre`, `tcur_descripcion`, `tcur_estado`, `tcur_estado_logico`) VALUES
(1, 'Educación Superior', 'Educación superior', '1', '1'),
(2, 'Estudios Actuales', 'Estudios Actuales', '1', '1'),
(3, 'Reconocimientos Académicos', 'Reconocimientos Académicos', '1', '1');

-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `idioma`
-- --------------------------------------------------------
INSERT INTO `idioma` (`idi_id`,  `idi_nombre`, `idi_descripcion`, `idi_estado`, `idi_estado_logico`) VALUES
(1, 'Inglés', 'Inglés', '1', '1'),
(2, 'Francés', 'Francés', '1', '1'),
(3, 'Otro', 'Otro', '1', '1');

-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `criterio_idioma`
-- --------------------------------------------------------
INSERT INTO `criterio_idioma` (`cidi_id`, `cidi_descripcion`, `cidi_estado`, `cidi_estado_logico`) VALUES
(1, 'Hablado', '1', '1'),
(2, 'Escrito', '1', '1'),
(3, 'Lectura', '1', '1'),
(4, 'Auitiva', '1', '1');

-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `criterio_idioma`
-- --------------------------------------------------------
INSERT INTO `nivel_idioma` (`nidi_id`, `nidi_descripcion`, `nidi_estado`, `nidi_estado_logico`) VALUES
(1, 'Básico','1', '1'),
(2, 'Intermedio', '1', '1'),
(3, 'Avanzado', '1', '1');
-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `tipo_publicacion`
--
INSERT INTO `tipo_publicacion` (`tpub_id`, `tpub_nombre`, `tpub_descripcion`, `tpub_estado`, `tpub_estado_logico`) VALUES
(1, 'Articulos Regionales', 'articulos Regionales', '1', '1'),
(2, 'Articulos Impacto', 'Articulos Impacto', '1', '1'),
(3, 'Libro', 'Libros', '1', '1');

-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `parametros`
--
INSERT INTO `parametros` (`par_id`,`par_valor`,`par_nombre`,`par_codigo`,`par_descriṕcion`,`par_estado`,`par_estado_logico`) VALUES
(1, 'pv_ninstruccion', 'Grado','1','Nivel de Instrucción Grado','1', '1'),
(2, 'pv_ninstruccion', 'Postgrado','2','Nivel de Instrucción Grado','1', '1'),
(3, 'pv_ninstruccion', 'PHD','3','Nivel de Instrucción Grado','1', '1'),
(4, 'pv_tdiploma', 'Asistencia','1','Tipo de Diploma','1', '1'),
(5, 'pv_tdiploma', 'Aprobación','2','Tipo de Diploma','1', '1'),
(6, 'pv_publicacion', 'Revista','1','Publicación','1', '1'),
(7, 'pv_publicacion', 'Editorial','2','Publicación','1', '1'),
(8, 'pv_tcapacitacion', 'Docencia','1','Publicación','1', '1'),
(9, 'pv_tcapacitacion', 'Profesional','2','Publicación','1', '1'),
(10, 'pv_tdedicado', 'Tiempo Completo','1','Tiempo Dedicación','1', '1'),
(11, 'pv_tdedicado', 'Medio tiempo','2','Tiempo Dedicación','1', '1'),
(12, 'pv_tdedicado', 'Tiempo Parcial','3','Tiempo Dedicación','1', '1'),
(13, 'pv_trelacion', 'Relación Dependencia','1','Tipo Relación Trabajo','1', '1'),
(14, 'pv_trelacion', 'Servicio Profesional','2','Tipo Relación Trabajo','1', '1'),
(15, 'pv_modalidad', 'A Distancia','1','Modalidad','1', '1'),
(16, 'pv_modalidad', 'Online','2','Modalidad','1', '1'),
(17, 'pv_modalidad', 'Presencial','3','Modalidad','1', '1'),
(18, 'pv_modalidad', 'Semipresencial','4','Modalidad','1', '1'),
(19, 'pv_coodireccion', 'Posgrado','1','Maestría','1', '1'),
(20, 'pv_coodireccion', 'Pregrado','2','Pregrado','1', '1'),
(21, 'pv_estadoexpediente', 'Registro Provisional','1','Estado de Expediente','1', '1'),
(22, 'pv_estadoexpediente', 'Expediente Validado','2','Estado de Expediente','1', '1'),
(23, 'pv_estadoexpediente', 'Expediente Invalidado','3','Estado de Expediente','1', '1'),
(24, 'pv_rolproyecto', 'Líder','1','Rol en proyecto de investigación.','1', '1'),
(25, 'pv_rolproyecto', 'Docente investigador','2','Rol en proyecto de investigación.','1', '1'),
(26, 'pv_rolproyecto', 'Técnico','3','Rol en proyecto de investigación.','1', '1'),
(27, 'pv_tipo_participacion', 'Ponente','1','Tipo de participación en Ponencias.','1', '1'),
(28, 'pv_tipo_participacion', 'Ponente con publicación','2','Tipo de participación en Ponencias.','1', '1');
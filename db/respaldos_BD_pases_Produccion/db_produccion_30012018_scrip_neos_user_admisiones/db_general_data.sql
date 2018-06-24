--
-- Base de datos: `db_general`
--
USE `db_general`;

-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `enfermedad`
--
INSERT INTO `enfermedad` (`enf_id`, `enf_cie`, `enf_descripcion`, `enf_estado`, `enf_estado_logico`) VALUES
(1, 'Q20', 'Todo tipo de malformaciones congénitas de corazón y todo tipo de  valvulopatías cardiacas.', '1', '1'),
(2, 'C00', 'Todo tipo de cáncer', '1', '1'),
(3, 'D320', 'Tumor cerebral en cualquier estado y de cualquier tipo.', '1', '1'),
(4, 'N18', 'Insuficiencia renal crónica.', '1', '1'),
(5, 'Z940', 'Trasplante de órganos: riñón, hígado, médula ósea.', '1', '1'),
(6, 'T29', 'Secuelas de quemaduras graves.', '1', '1'),
(7, 'Q282', 'Malformaciones arterio venosas cerebrales.', '1', '1'),
(8, 'Q872', 'Síndrome de Klippel Trenaunay.', '1', '1'),
(9, 'I71', 'Aneurisma tóraco-abdominal', '1', '1');

-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `tipo_antecedente_familia`
--
INSERT INTO `tipo_antecedente_familia` (`tafam_id`, `tafam_nombre`, `tafam_descripcion`, `tafam_estado`, `tafam_estado_logico`) VALUES
(1, 'Integrantes', 'Integrantes de familia que viven con profesor', '1', '1'),
(2, 'Hijos', 'Hijos  que no viven con profesor', '1', '1'),
(3, 'Familiares','Familiares en la institucion',  '1', '1');

-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `tipo_empresa`
--
INSERT INTO `tipo_empresa` (`temp_id`, `temp_nombre`, `temp_descripcion`, `temp_estado`, `temp_estado_logico`) VALUES
(1, 'Publico', 'Publico', '1', '1'),
(2, 'Privado', 'Privado', '1', '1'),
(3, 'Independiente','Independiente',  '1', '1');

-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `institucion`
--
INSERT INTO `institucion` (`ins_id`, `ins_categoria`, `ins_nombre`, `ins_abreviacion`, `ins_estado`, `ins_estado_logico`) VALUES
(1, 'A', 'Escuela Politécnica Nacional', '', '1', '1'),
(2, 'A', 'Escuela Superior Politécnica del Litoral', 'ESPOL', '1', '1'),
(3, 'A', 'Universidad San Francisco de Quito', '', '1', '1'),
(4, 'A', 'Universidad de Cuenca', '', '1', '1'),
(5, 'A', 'Universidad de las Fuerzas Armadas', 'ESPE', '1', '1'),
(6, 'A', 'Universidad de Especialidades Espíritu Santo', '', '1', '1'),
(7, 'A', 'Facultad Latinoamericana de Ciencias Sociales (Postgrado)', '', '1', '1'),
(8, 'A', 'Universidad Andina Simón Bolívar (Postgrado)', '', '1', '1'),
(9, 'B', 'Escuela Superior Politécnica de Chimborazo', '', '1', '1'),
(10, 'B', 'Pontificia Universidad Católica del Ecuador', '', '1', '1'),
(11, 'B', 'Universidad Casa Grande', '', '1', '1'),
(12, 'B', 'Universidad Católica de Santiago de Guayaquil', 'UCSG', '1', '1'),
(13, 'B', 'Universidad Central del Ecuador', '', '1', '1'),
(14, 'B', 'Universidad del Azuay', '', '1', '1'),
(15, 'B', 'Universidad Estatal de Milagro', '', '1', '1'),
(16, 'B', 'Universidad Nacional de Loja', '', '1', '1'),
(17, 'B', 'Universidad Particular Internacional SEK', 'SEK', '1', '1'),
(18, 'B', 'Universidad Politécnica Salesiana', '', '1', '1'),
(19, 'B', 'Universidad Técnica de Ambato', '', '1', '1'),
(20, 'B', 'Universidad Técnica del Norte', '', '1', '1'),
(21, 'B', 'Universidad Técnica Estatal de Quevedo', '', '1', '1'),
(22, 'B', 'Universidad Técnica Particular de Loja', '', '1', '1'),
(23, 'B', 'Universidad Tecnológica Empresarial de Guayaquil', 'UTEG', '1', '1'),
(24, 'B', 'Universidad Tecnológica Equinoccial', '', '1', '1'),
(25, 'B', 'Universidad Tecnológica Indoamérica', '', '1', '1'),
(26, 'B', 'Universidad de los Hemisferios', '', '1', '1'),
(27, 'B', 'Universidad Estatal Amazónica', '', '1', '1'),
(28, 'B', 'Universidad Politécnica del Carchi', '', '1', '1'),
(29, 'B', 'Universidad Iberoamericana', '', '1', '1'),
(30, 'B', 'Universidad Técnica de Manabí', '', '1', '1'),
(31, 'B', 'Universidad de las Américas', '', '1', '1'),
(32, 'B', 'Universidad Internacional del Ecuador', '', '1', '1'),
(33, 'B', 'Universidad de Guayaquil', '', '1', '1'),
(34, 'B', 'Universidad Técnica de Machala', '', '1', '1'),
(35, 'B', 'Universidad Católica de Cuenca', '', '1', '1'),
(36, 'B', 'Instituto de Altos Estudios Nacionales (Postgrados)', '', '1', '1'),
(37, 'B', 'Escuela Superior Politécnica Agropecuaria de Manabí', '','1', '1'),
(38, 'C', 'Universidad de Especialidades Turísticas', '', '1', '1'),
(39, 'C', 'Universidad del Pacífico Escuela de Negocios', '', '1', '1'),
(40, 'C', 'Universidad Estatal de Bolívar', '', '1', '1'),
(41, 'C', 'Universidad Laica Vicente Rocafuerte de Guayaquil', '', '1', '1'),
(42, 'C', 'Universidad Metropolitana', '', '1', '1'),
(43, 'C', 'Universidad Nacional del Chimborazo', '', '1', '1'),
(44, 'C', 'Universidad Regional Autónoma de los Andes', '', '1', '1'),
(45, 'C', 'Universidad Técnica de Babahoyo', '', '1', '1'),
(46, 'C', 'Universidad Tecnológica Israel', '', '1', '1'),
(47, 'C', 'Universidad Estatal Península de Santa Elena', '', '1', '1'),
(48, 'C', 'Universidad Particular San Gregorio de Portoviejo', '', '1', '1'),
(49, 'C', 'Universidad Tecnológica ECOTEC', 'ECOTEC', '1', '1'),
(50, 'C', 'Universidad Técnica de Cotopaxi (Institución en situación de irregularidad académica)', '', '1', '1'),
(51, 'C', 'Universidad Estatal del Sur de Manabí', '', '1', '1'),
(52, 'C', 'Universidad de Otavalo', '', '1', '1'),
(53, 'C', 'Universidad Agraria del Ecuador', '', '1', '1'),
(54, 'C', 'Universidad Laica Eloy Alfaro de Manabí', '', '1', '1'),
(55, 'C', 'Universidad Técnica Luis Vargas Torres de Esmeraldas', '', '1', '1');

-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `tipo_curricular`
--
INSERT INTO `tipo_curricular` (`tcur_id`, `tcur_nombre`, `tcur_descripcion`, `tcur_estado`, `tcur_estado_logico`) VALUES
(1, 'Educación Superior', 'Educación superior', '1', '1'),
(2, 'Reconocimientos Académicos', 'Reconocimientos Académicos', '1', '1'),
(3, 'Idiomas','Idiomas',  '1', '1');

-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `tiempo_dedicado`
--
INSERT INTO `tiempo_dedicado` (`tded_id`, `tded_nombre`, `tded_descripcion`, `tded_estado`, `tded_estado_logico`) VALUES
(1, 'Completo', 'Completo', '1', '1'),
(2, 'Medio', 'Medio', '1', '1'),
(3, 'Parcial','Parcial',  '1', '1');

-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `tipo_relacion`
--
INSERT INTO `tipo_relacion` (`trel_id`, `trel_nombre`, `trel_descripcion`, `trel_estado`, `trel_estado_logico`) VALUES
(1, 'Contrato', 'Contrato de relación de dependencia', '1', '1'),
(2, 'Servicio', 'Servicios prestados', '1', '1');

-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `tipo_capacitacion`
--
INSERT INTO `tipo_capacitacion` (`tcap_id`, `tcap_nombre`, `tcap_descripcion`, `tcap_estado`, `tcap_estado_logico`) VALUES
(1, 'Docencia', 'Docencia', '1', '1'),
(2, 'Profesional', 'Profesional', '1', '1');

-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `tipo_diploma`
--
INSERT INTO `tipo_diploma` (`tdip_id`, `tdip_nombre`, `tdip_descripcion`, `tdip_estado`, `tdip_estado_logico`) VALUES
(1, 'Asistencia', 'Asistencia', '1', '1'),
(2, 'Aprobación', 'Aprobación', '1', '1');

-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `tipo_publicacion`
--
INSERT INTO `tipo_publicacion` (`tpub_id`, `tpub_nombre`, `tpub_descripcion`, `tpub_estado`, `tpub_estado_logico`) VALUES
(1, 'Libro', 'Libro', '1', '1'),
(2, 'Capítulo Libro', 'Capítulo Libro', '1', '1'),
(3, 'Artículo', 'Artículo', '1', '1'),
(4, 'Ponencia', 'Ponencia', '1', '1');

-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `participación`
--
INSERT INTO `participación` (`par_id`, `par_nombre`, `par_descripcion`, `par_estado`, `par_estado_logico`) VALUES
(1, 'Autor', 'Autor', '1', '1'),
(2, 'Coautor', 'Coautor', '1', '1');

-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `estado_publicacion`
--
INSERT INTO `estado_publicacion` (`epub_id`, `epub_nombre`, `epub_descripcion`, `epub_estado`, `epub_estado_logico`) VALUES
(1, 'Publicado', 'Publicado', '1', '1'),
(2, 'Aceptado para publicar', 'Aceptado para publicar', '1', '1');

-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `rol_proyecto`
--
INSERT INTO `rol_proyecto` (`rpro_id`, `rpro_nombre`, `rpro_descripcion`, `rpro_estado`, `rpro_estado_logico`) VALUES
(1, 'Jefe', 'Jefe de Proyecto', '1', '1'),
(2, 'Investigador', 'Investigador Proyecto', '1', '1');


-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `idioma`
--
INSERT INTO `idioma` (`idi_id`,  `idi_nombre`, `idi_descripcion`, `idi_estado`, `idi_estado_logico`) VALUES
(1, 'Ingles', 'Ingles', '1', '1');

-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `criterio_idioma`
--
INSERT INTO `criterio_idioma` (`cidi_id`, `cidi_descripcion`, `cidi_estado`, `cidi_estado_logico`) VALUES
(1, 'Hablado', '1', '1'),
(2, 'Escrito', '1', '1');

-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `criterio_idioma`
--
INSERT INTO `nivel_idioma` (`nidi_id`, `nidi_descripcion`, `nidi_estado`, `nidi_estado_logico`) VALUES
(1, 'Básico','1', '1'),
(2, 'Intermedio', '1', '1'),
(3, 'Avanzado', '1', '1');

-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `tipo_contacto_general`
--
INSERT INTO `tipo_contacto_general` (`tcge_id`, `tcge_nombre`, `tcge_descripcion`, `tcge_estado`, `tcge_estado_logico`) VALUES
(1, 'Emergencia', 'Emergencia', '1', '1'),
(2, 'Experiencia Laboral', 'Privado', '1', '1'),
(3, 'Experiencia Docencia','Experiencia Docencia',  '1', '1');

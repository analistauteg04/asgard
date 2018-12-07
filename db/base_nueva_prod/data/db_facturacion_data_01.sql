--
-- Base de datos: `db_facturacion`
--
use `db_facturacion`;

-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `categoria` 
--
insert into `categoria` (`cat_id`, `cat_nombre`, `cat_descripcion`, `cat_usu_ingreso`, `cat_estado`, `cat_estado_logico`)
values(1, 'Solicitudes de Inscripción', 'Solicitudes de Inscripción', 1, '1', '1');

-- ---------------------------------------------git pull-----------
--
-- Volcado de datos para la tabla `sub_categoria` 
--
insert into `sub_categoria` (`scat_id`, `cat_id`, `scat_nombre`, `scat_descripcion`, `scat_usu_ingreso`, `scat_estado`, `scat_estado_logico`) values
(1, 1, 'Grado Online', 'Grado Online', 1, '1', '1'),
(2, 1, 'Grado Presencial', 'Grado Presencial', 1, '1', '1'),
(3, 1, 'Grado Semipresencial', 'Grado Semipresencial', 1, '1', '1'),
(4, 1, 'Grado A distancia', 'Grado A distancia', 1, '1', '1'),
(5, 1, 'Posgrado', 'Posgrado', 1, '1', '1'),
(6, 1, 'Smart', 'Smart', 1, '1', '1'),
(7, 1, 'Ulink', 'Ulink', 1, '1', '1');

-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `item` 
--
insert into `item` (`ite_id`, `scat_id`,  `ite_codigo`, `ite_nombre`, `ite_descripcion`, `ite_usu_ingreso`, `ite_estado`, `ite_estado_logico`) values 
-- Uteg -- 
(1, 1, '0001', 'Curso de admisión y nivelación Online', 'Curso de admisión y nivelación Online', 1, '1', '1'),
(2, 1, '0002', 'Examen de admisión Online', 'Examen de admisión Online', 1, '1', '1'),
(3, 2, '0003', 'Curso de admisión y nivelación Presencial', 'Curso de admisión y nivelación Presencial', 1, '1', '1'),
(4, 2, '0004', 'Examen de admisión Presencial', 'Examen de admisión Presencial', 1, '1', '1'),
(5, 3, '0005', 'Curso de admisión y nivelación Semipresencial', 'Curso de admisión y nivelación Semipresencial', 1, '1', '1'),
(6, 3, '0006', 'Examen de admisión Semipresencial', 'Examen de admisión Semipresencial', 1, '1', '1'),
(7, 4, '0007', 'Curso de admisión y nivelación a Distancia', 'Curso de admisión y nivelación a Distancia', 1, '1', '1'),
(8, 4, '0008', 'Examen de admisión a Distancia', 'Examen de admisión  a Distancia', 1, '1', '1'),
(9, 5, '0009', 'Pago total Matrícula+Derecho Posgrado', 'Pago total Matrícula+Derecho Posgrado', 1, '1', '1'),
(10, 5, '0010', 'Inscripción Posgrado', 'Inscripción Posgrado', 1, '1', '1'),
-- Smart --
(11, 6, '0011', 'Emprendimiento y Ventas', 'Emprendimiento y Ventas', 1, '1', '1'),
(12, 6, '0012', 'Excel Avanzado', 'Excel Avanzado', 1, '1', '1'),
(13, 6, '0013', 'Fotografía', 'Fotografía', 1, '1', '1'),
(14, 6, '0014', 'Event Planner', 'Event Planner', 1, '1', '1'),
(15, 6, '0015', 'Programa Gerencia Estratégica del TH (4 módulos)', 'Programa Gerencia Estratégica del TH (4 módulos)', 1, '1', '1'),
(16, 6, '0016', 'Pedagogía', 'Pedagogía', 1, '1', '1'),
(17, 6, '0017', 'Programa para docentes:  Redacción Científica', 'Programa para docentes:  Redacción Científica', 1, '1', '1'),
(18, 6, '0018', 'Desarrollo Habilidades Comerciales para Retail', 'Desarrollo Habilidades Comerciales para Retail', 1, '1', '1'),
(19, 6, '0019', 'Cursos Online', 'Cursos Online', 1, '1', '1'),
(20, 6, '0020', 'Programa de Talento Humano: Actualidad Laboral', 'Programa de Talento Humano: Actualidad Laboral', 1, '1', '1'),
(21, 6, '0021', 'Programa de habilidades Gerenciales: Estrategias directivas', 'Programa de habilidades Gerenciales: Estrategias directivas', 1, '1', '1'),
(22, 6, '0022', 'Illustrator y fotoshop: intermedio', 'Illustrator y fotoshop: intermedio', 1, '1', '1'),
(23, 6, '0023', 'Técnicas de negociación y cierre de ventas', 'Técnicas de negociación y cierre de ventas', 1, '1', '1'),
(24, 6, '0024', 'Neuromarketing', 'Neuromarketing', 1, '1', '1'),
(25, 6, '0025', 'Programa de Talento Humano: Descripción de cargos y selección por competencias (módulo 2)', 'Programa de Talento Humano: Descripción de cargos y selección por competencias (módulo 2)', 1, '1', '1'),
(26, 6, '0026', 'Técnicas de ventas:  Manejo de clientes difíciles', 'Técnicas de ventas:  Manejo de clientes difíciles', 1, '1', '1'),
(27, 6, '0027', 'Programa de habilidades Gerenciales: Negociación efectiva', 'Programa de habilidades Gerenciales: Negociación efectiva', 1, '1', '1'),
(28, 6, '0028', 'Dirección en Finanzas: Presupuesto y diferenciación de ingresos', 'Dirección en Finanzas: Presupuesto y diferenciación de ingresos', 1, '1', '1'),
(29, 6, '0029', 'Valoración aduanera para empresarios', 'Valoración aduanera para empresarios', 1, '1', '1'),
(30, 6, '0030', 'Programa de Talento Humano:  Plan estratégico del Talento Humano (módulo 3)', 'Programa de Talento Humano:  Plan estratégico del Talento Humano (módulo 3)', 1, '1', '1'),
(31, 6, '0031', 'Taller de liderazgo y manejo de conflictos', 'Taller de liderazgo y manejo de conflictos', 1, '1', '1'),
(32, 6, '0032', 'Programa para docentes: Habilidades pedagógicas', 'Programa para docentes: Habilidades pedagógicas', 1, '1', '1'),
(33, 6, '0033', 'Promoción programa talento humano', 'Promoción programa talento humano', 1, '1', '1'),
(34, 6, '0034', 'Promoción programa para docentes', 'Promoción programa para docentes', 1, '1', '1'),
-- Ulink --
(35, 7, '0035', 'Diplomado gestión del talento humano basado en competencias', 'Diplomado gestión del talento humano basado en competencias', 1, '1', '1'),
(36, 7, '0036', 'Diplomado en Alta Gerencia y Control de Gestión', 'Diplomado en Alta Gerencia y Control de Gestión', 1, '1', '1'),
(37, 7, '0037', 'Diplomado en Culture Management: nuevas formas de hacer negocio', 'Diplomado en Culture Management: nuevas formas de hacer negocio', 1, '1', '1'),
(38, 7, '0038', 'Diplomado en turismo inteligente y competitividad internacional', 'Diplomado en turismo inteligente y competitividad internacional', 1, '1', '1'),
(39, 7, '0039', 'Habilidades de comunicación para emprendedores', 'Habilidades de comunicación para emprendedores', 1, '1', '1'),
(40, 7, '0040', 'La Política de Personal: factor clave en la competitividad de las organizaciones', 'La Política de Personal: factor clave en la competitividad de las organizaciones', 1, '1', '1'),
(41, 7, '0041', 'Los modelos de Competencia para la gestión efectiva del Talento Humano', 'Los modelos de Competencia para la gestión efectiva del Talento Humano', 1, '1', '1'),
(42, 7, '0042', 'Como aumentar la competitividad de la organización mediante la Elección del Personal', 'Como aumentar la competitividad de la organización mediante la Elección del Personal', 1, '1', '1'),
(43, 7, '0043', 'La Innovación Tecnológica en la gestión del Talento Humano', 'La Innovación Tecnológica en la gestión del Talento Humano', 1, '1', '1'),
(44, 7, '0044', 'El uso de entornos virtuales en la formación y desarrollo del Talento Humano', 'El uso de entornos virtuales en la formación y desarrollo del Talento Humano', 1, '1', '1'),
(45, 7, '0045', 'Desarrollo de competencia enfocado a jóvenes líderes', 'Desarrollo de competencia enfocado a jóvenes líderes', 1, '1', '1'),
(46, 7, '0046', 'La Ética y la Responsabilidad Social Empresarial:  factores claves para el Gobierno Corporativo', 'La Ética y la Responsabilidad Social Empresarial:  factores claves para el Gobierno Corporativo', 1, '1', '1'),
(47, 7, '0047', 'Contabilidad para la toma de decisiones gerenciales', 'Contabilidad para la toma de decisiones gerenciales', 1, '1', '1'),
(48, 7, '0048', 'Análisis Financiero y Sistemas de Control para las organizaciones', 'Análisis Financiero y Sistemas de Control para las organizaciones', 1, '1', '1'),
(49, 7, '0049', 'La Valoración en los negocios y su importancia en la toma de decisiones', 'La Valoración en los negocios y su importancia en la toma de decisiones', 1, '1', '1'),
(50, 7, '0050', 'Emprendimiento global', 'Emprendimiento global', 1, '1', '1'),
(51, 7, '0051',	'El uso de la Inteligencia de Mercado como factor clave de competitividad', 'El uso de la Inteligencia de Mercado como factor clave de competitividad', 1, '1', '1'),
(52, 7, '0052', 'La Globalización y la Integración Económica', 'La Globalización y la Integración Económica', 1, '1', '1'),
(53, 7, '0053', 'La visión multicultural como factor de éxito en los negocios internacionales', 'La visión multicultural como factor de éxito en los negocios internacionales', 1, '1', '1'),
(54, 7, '0054', 'Estrategias de Marketing para un entorno globalizado', 'Estrategias de Marketing para un entorno globalizado', 1, '1', '1'),
(55, 7, '0055', 'Estrategias de Exportanción para el éxito en un entorno globalizado', 'Estrategias de Exportanción para el éxito en un entorno globalizado', 1, '1', '1'),
(56, 7, '0056', 'El uso de la información: factor clave en un entorno global', 'El uso de la información: factor clave en un entorno global', 1, '1', '1'),
(57, 7, '0057', 'Estrategias de Finanzas para el éxito en los negocios internacionales', 'Estrategias de Finanzas para el éxito en los negocios internacionales', 1, '1', '1'),
(58, 7, '0058', 'Turismo inteligente y sostenible para el desarrollo', 'Turismo inteligente y sostenible para el desarrollo', 1, '1', '1'),
(59, 7, '0059', 'Planificación y gestión de Destinos Turísticos Inteligentes', 'Planificación y gestión de Destinos Turísticos Inteligentes', 1, '1', '1'),
(60, 7, '0060', 'La innovación y calidad en la sostenibilidad de las empresas turísticas', 'La innovación y calidad en la sostenibilidad de las empresas turísticas', 1, '1', '1'),
(61, 7, '0061', 'Herramientas de información y comunicación para Productos Turísticos', 'Herramientas de información y comunicación para Productos Turísticos', 1, '1', '1'),
(62, 7, '0062', 'La Minería de Datos como herramienta de desarrollo en el Turismo', 'La Minería de Datos como herramienta de desarrollo en el Turismo', 1, '1', '1'),
(63, 7, '0063', 'Estrategias de Marketing Digital para empresas turísticas', 'Estrategias de Marketing Digital para empresas turísticas', 1, '1', '1'),
(64, 7, '0064', 'Web Building', 'Web Building', 1, '1', '1'),
(65, 7, '0065', 'Tu negocio en Google', 'Tu negocio en Google', 1, '1', '1'),
(66, 7, '0066', 'Cómo utilizar Goolge Business', 'Cómo utilizar Goolge Business', 1, '1', '1'),
(67, 7, '0067', 'No más SPAM… Estrategias para entrega efectivas de email', 'No más SPAM… Estrategias para entrega efectivas de email', 1, '1', '1'),
(68, 7, '0068', 'Community Manager', 'Community Manager', 1, '1', '1'),
(69, 7, '0069', 'Facebook Ads: domina el Marketing en Facebook', 'Facebook Ads: domina el Marketing en Facebook', 1, '1', '1'),
(70, 7, '0070', 'Redacción y ortografía para ejecutivos', 'Redacción y ortografía para ejecutivos', 1, '1', '1'),
(71, 7, '0071', 'Manejo de clientes dificiles', 'Manejo de clientes dificiles', 1, '1', '1'),
(72, 7, '0072', 'Matemáticas para todos', 'Matemáticas para todos', 1, '1', '1'),
(73, 7, '0073', 'Contabilidad para todos', 'Contabilidad para todos', 1, '1', '1'),
(74, 7, '0074', 'Excel para principiantes', 'Excel para principiantes', 1, '1', '1'),
(75, 7, '0075', 'Excel Intermedio', 'Excel Intermedio', 1, '1', '1'),
(76, 7, '0076', 'Excel Avanzado', 'Excel Avanzado', 1, '1', '1'),
(77, 7, '0077', 'Como aprovechar las tablas dinámicas de Excel', 'Como aprovechar las tablas dinámicas de Excel', 1, '1', '1'),
(78, 7, '0078', 'Estrategias de Marketing efectivas para Emprendedores', 'Estrategias de Marketing efectivas para Emprendedores', 1, '1', '1'),
(79, 7, '0079', 'Integración mundial: nuevas tendencias en tratados comerciales', 'Integración mundial: nuevas tendencias en tratados comerciales', 1, '1', '1'),
(80, 7, '0080', 'Herramientas TICs para desarrollo de recursos Online', 'Herramientas TICs para desarrollo de recursos Online', 1, '1', '1'),
(81, 7, '0081', 'Economía para Emprendedores', 'Economía para Emprendedores', 1, '1', '1'),
(82, 7, '0082', 'Motívate - Auto Motivación', 'Motívate - Auto Motivación', 1, '1', '1'),
(83, 7, '0083', 'Realización de videos con tu Smartphone', 'Realización de videos con tu Smartphone', 1, '1', '1'),
(84, 7, '0084', 'Correcta aplicación de las herramientas de control para la toma de decisiones', 'Correcta aplicación de las herramientas de control para la toma de decisiones', 1, '1', '1'),
(85, 7, '0085', 'Licenciatura en Comercio Exterior (UTEG Online)', 'Licenciatura en Comercio Exterior (UTEG Online)', 1, '1', '1'),
(86, 7, '0086', 'Licenciatura en Mercadotecnia (UTEG Online)', 'Licenciatura en Mercadotecnia (UTEG Online)', 1, '1', '1'),
(87, 7, '0087', 'Licenciatura en Finanzas (UTEG Online)', 'Licenciatura en Finanzas (UTEG Online)', 1, '1', '1'),
(88, 7, '0088', 'Licenciatura en Administración de Empresas (UTEG Online)', 'Licenciatura en Administración de Empresas (UTEG Online)', 1, '1', '1'),
(89, 7, '0089', 'Licenciatura en Turismo', 'Licenciatura en Turismo', 1, '1', '1'),
(90, 7, '0090', 'Economía', 'Economía', 1, '1', '1'),
(91, 7, '0091', 'MBA BORDEAUX', 'MBA BORDEAUX', 1, '1', '1'),

(92, 5, '0092', 'Matrícula Posgrado', 'Matrícula Posgrado', 1, '1', '1'),
(93, 5, '0093', 'Derechos Posgrado', 'Derechos Posgrado', 1, '1', '1');

-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `item_precio` 
--
insert into `item_precio` (`ipre_id`, `ite_id`, `ipre_precio`, `ipre_porcentaje_iva`, `ipre_estado_precio`, `ipre_valor_minimo`, `ipre_porcentaje_minimo`, `ipre_fecha_inicio`, `ipre_fecha_fin`, `ipre_usu_ingreso`, `ipre_estado`, `ipre_estado_logico`) values
-- Uteg --
(1, 1, 100, null, 'A', null, null, '2017/09/25 00:00:00', '2018/12/31 23:59:59', 1, '1', '1'),
(2, 2, 50, null, 'A', null, null, '2017/09/09 00:00:00', '2018/12/31 23:59:59', 1, '1', '1'),
(3, 3, 390, null, 'A', null, null, '2018/07/01 00:00:00', '2018/12/31 23:59:59', 1, '1', '1'),
(4, 5, 390, null, 'A', null, null, '2018/07/01 00:00:00', '2018/12/31 23:59:59', 1, '1', '1'),
(5, 7, 390, null, 'A', null, null, '2018/07/01 00:00:00', '2018/12/31 23:59:59', 1, '1', '1'),
(6, 10, 500, null, 'A', null, null, '2018/07/01 00:00:00', '2018/12/31 23:59:59', 1, '1', '1'),
-- Smart --
(7, 11, 80, null, 'A', null, null, '2018/10/01 00:00:00', '2018/12/31 23:59:59', 1, '1', '1'),
(8, 12, 80, null, 'A', null, null, '2018/10/01 00:00:00', '2018/12/31 23:59:59', 1, '1', '1'),
(9, 13, 60, null, 'A', null, null, '2018/10/01 00:00:00', '2018/12/31 23:59:59', 1, '1', '1'),
(10, 14, 100, null, 'A', null, null, '2018/10/01 00:00:00', '2018/12/31 23:59:59', 1, '1', '1'),
(11, 15, 150, null, 'A', null, null, '2018/10/01 00:00:00', '2018/12/31 23:59:59', 1, '1', '1'),
(12, 16, 180, null, 'A', null, null, '2018/10/01 00:00:00', '2018/12/31 23:59:59', 1, '1', '1'),
(13, 17, 150, null, 'A', null, null, '2018/10/01 00:00:00', '2018/12/31 23:59:59', 1, '1', '1'),
(14, 18, 100, null, 'A', null, null, '2018/10/01 00:00:00', '2018/12/31 23:59:59', 1, '1', '1'),
(15, 19, 99, null, 'A', null, null, '2018/10/01 00:00:00', '2018/12/31 23:59:59', 1, '1', '1'),
(16, 20, 145, null, 'A', null, null, '2018/10/01 00:00:00', '2018/12/31 23:59:59', 1, '1', '1'),
(17, 21, 150, null, 'A', null, null, '2018/10/01 00:00:00', '2018/12/31 23:59:59', 1, '1', '1'),
(18, 22, 80, null, 'A', null, null, '2018/10/01 00:00:00', '2018/12/31 23:59:59', 1, '1', '1'),
(19, 23, 120, null, 'A', null, null, '2018/10/01 00:00:00', '2018/12/31 23:59:59', 1, '1', '1'),
(20, 24, 120, null, 'A', null, null, '2018/10/01 00:00:00', '2018/12/31 23:59:59', 1, '1', '1'),
(21, 25, 100, null, 'A', null, null, '2018/10/01 00:00:00', '2018/12/31 23:59:59', 1, '1', '1'),
(22, 26, 120, null, 'A', null, null, '2018/10/01 00:00:00', '2018/12/31 23:59:59', 1, '1', '1'),
(23, 27, 150, null, 'A', null, null, '2018/10/01 00:00:00', '2018/12/31 23:59:59', 1, '1', '1'),
(24, 28, 120, null, 'A', null, null, '2018/10/01 00:00:00', '2018/12/31 23:59:59', 1, '1', '1'),
(25, 29, 120, null, 'A', null, null, '2018/10/01 00:00:00', '2018/12/31 23:59:59', 1, '1', '1'),
(26, 30, 100, null, 'A', null, null, '2018/10/01 00:00:00', '2018/12/31 23:59:59', 1, '1', '1'),
(27, 31, 100, null, 'A', null, null, '2018/10/01 00:00:00', '2018/12/31 23:59:59', 1, '1', '1'),
(28, 32, 180, null, 'A', null, null, '2018/10/01 00:00:00', '2018/12/31 23:59:59', 1, '1', '1'),
(29, 33, 380, null, 'A', null, null, '2018/10/01 00:00:00', '2018/12/31 23:59:59', 1, '1', '1'),
(30, 34, 300, null, 'A', null, null, '2018/10/01 00:00:00', '2018/12/31 23:59:59', 1, '1', '1'),
-- Ulink --
(31, 35, 1200, null, 'A', null, null, '2018/10/01 00:00:00', '2018/12/31 23:59:59', 1, '1', '1'),
(32, 36, 1200, null, 'A', null, null, '2018/10/01 00:00:00', '2018/12/31 23:59:59', 1, '1', '1'),
(33, 37, 1200, null, 'A', null, null, '2018/10/01 00:00:00', '2018/12/31 23:59:59', 1, '1', '1'),
(34, 38, 1200, null, 'A', null, null, '2018/10/01 00:00:00', '2018/12/31 23:59:59', 1, '1', '1'),
(35, 39, 250, null, 'A', null, null, '2018/10/01 00:00:00', '2018/12/31 23:59:59', 1, '1', '1'),
(36, 40, 250, null, 'A', null, null, '2018/10/01 00:00:00', '2018/12/31 23:59:59', 1, '1', '1'),
(37, 41, 250, null, 'A', null, null, '2018/10/01 00:00:00', '2018/12/31 23:59:59', 1, '1', '1'),
(38, 42, 250, null, 'A', null, null, '2018/10/01 00:00:00', '2018/12/31 23:59:59', 1, '1', '1'),
(39, 43, 250, null, 'A', null, null, '2018/10/01 00:00:00', '2018/12/31 23:59:59', 1, '1', '1'),
(40, 44, 250, null, 'A', null, null, '2018/10/01 00:00:00', '2018/12/31 23:59:59', 1, '1', '1'),
(41, 45, 250, null, 'A', null, null, '2018/10/01 00:00:00', '2018/12/31 23:59:59', 1, '1', '1'),
(42, 46, 250, null, 'A', null, null, '2018/10/01 00:00:00', '2018/12/31 23:59:59', 1, '1', '1'),
(43, 47, 250, null, 'A', null, null, '2018/10/01 00:00:00', '2018/12/31 23:59:59', 1, '1', '1'),
(44, 48, 250, null, 'A', null, null, '2018/10/01 00:00:00', '2018/12/31 23:59:59', 1, '1', '1'),
(45, 49, 250, null, 'A', null, null, '2018/10/01 00:00:00', '2018/12/31 23:59:59', 1, '1', '1'),
(46, 50, 250, null, 'A', null, null, '2018/10/01 00:00:00', '2018/12/31 23:59:59', 1, '1', '1'),
(47, 51, 250, null, 'A', null, null, '2018/10/01 00:00:00', '2018/12/31 23:59:59', 1, '1', '1'),
(48, 52, 250, null, 'A', null, null, '2018/10/01 00:00:00', '2018/12/31 23:59:59', 1, '1', '1'),
(49, 53, 250, null, 'A', null, null, '2018/10/01 00:00:00', '2018/12/31 23:59:59', 1, '1', '1'),
(50, 54, 250, null, 'A', null, null, '2018/10/01 00:00:00', '2018/12/31 23:59:59', 1, '1', '1'),
(51, 55, 250, null, 'A', null, null, '2018/10/01 00:00:00', '2018/12/31 23:59:59', 1, '1', '1'),
(52, 56, 250, null, 'A', null, null, '2018/10/01 00:00:00', '2018/12/31 23:59:59', 1, '1', '1'),
(53, 57, 250, null, 'A', null, null, '2018/10/01 00:00:00', '2018/12/31 23:59:59', 1, '1', '1'),
(54, 58, 250, null, 'A', null, null, '2018/10/01 00:00:00', '2018/12/31 23:59:59', 1, '1', '1'),
(55, 59, 250, null, 'A', null, null, '2018/10/01 00:00:00', '2018/12/31 23:59:59', 1, '1', '1'),
(56, 60, 250, null, 'A', null, null, '2018/10/01 00:00:00', '2018/12/31 23:59:59', 1, '1', '1'),
(57, 61, 250, null, 'A', null, null, '2018/10/01 00:00:00', '2018/12/31 23:59:59', 1, '1', '1'),
(58, 62, 250, null, 'A', null, null, '2018/10/01 00:00:00', '2018/12/31 23:59:59', 1, '1', '1'),
(59, 63, 250, null, 'A', null, null, '2018/10/01 00:00:00', '2018/12/31 23:59:59', 1, '1', '1'),
(60, 64, 100, null, 'A', null, null, '2018/10/01 00:00:00', '2018/12/31 23:59:59', 1, '1', '1'),
(61, 65, 100, null, 'A', null, null, '2018/10/01 00:00:00', '2018/12/31 23:59:59', 1, '1', '1'),
(62, 66, 100, null, 'A', null, null, '2018/10/01 00:00:00', '2018/12/31 23:59:59', 1, '1', '1'),
(63, 67, 100, null, 'A', null, null, '2018/10/01 00:00:00', '2018/12/31 23:59:59', 1, '1', '1'),
(64, 68, 100, null, 'A', null, null, '2018/10/01 00:00:00', '2018/12/31 23:59:59', 1, '1', '1'),
(65, 69, 100, null, 'A', null, null, '2018/10/01 00:00:00', '2018/12/31 23:59:59', 1, '1', '1'),
(66, 70, 100, null, 'A', null, null, '2018/10/01 00:00:00', '2018/12/31 23:59:59', 1, '1', '1'),
(67, 71, 100, null, 'A', null, null, '2018/10/01 00:00:00', '2018/12/31 23:59:59', 1, '1', '1'),
(68, 72, 100, null, 'A', null, null, '2018/10/01 00:00:00', '2018/12/31 23:59:59', 1, '1', '1'),
(69, 73, 100, null, 'A', null, null, '2018/10/01 00:00:00', '2018/12/31 23:59:59', 1, '1', '1'),
(70, 74, 100, null, 'A', null, null, '2018/10/01 00:00:00', '2018/12/31 23:59:59', 1, '1', '1'),
(71, 75, 100, null, 'A', null, null, '2018/10/01 00:00:00', '2018/12/31 23:59:59', 1, '1', '1'),
(72, 76, 100, null, 'A', null, null, '2018/10/01 00:00:00', '2018/12/31 23:59:59', 1, '1', '1'),
(73, 77, 100, null, 'A', null, null, '2018/10/01 00:00:00', '2018/12/31 23:59:59', 1, '1', '1'),
(74, 78, 100, null, 'A', null, null, '2018/10/01 00:00:00', '2018/12/31 23:59:59', 1, '1', '1'),
(75, 79, 100, null, 'A', null, null, '2018/10/01 00:00:00', '2018/12/31 23:59:59', 1, '1', '1'),
(76, 80, 100, null, 'A', null, null, '2018/10/01 00:00:00', '2018/12/31 23:59:59', 1, '1', '1'),
(77, 81, 100, null, 'A', null, null, '2018/10/01 00:00:00', '2018/12/31 23:59:59', 1, '1', '1'),
(78, 82, 100, null, 'A', null, null, '2018/10/01 00:00:00', '2018/12/31 23:59:59', 1, '1', '1'),
(79, 83, 100, null, 'A', null, null, '2018/10/01 00:00:00', '2018/12/31 23:59:59', 1, '1', '1'),
(80, 84, 100, null, 'A', null, null, '2018/10/01 00:00:00', '2018/12/31 23:59:59', 1, '1', '1'),
(81, 85, 100, null, 'A', null, null, '2018/10/01 00:00:00', '2018/12/31 23:59:59', 1, '1', '1'),
(82, 86, 100, null, 'A', null, null, '2018/10/01 00:00:00', '2018/12/31 23:59:59', 1, '1', '1'),
(83, 87, 100, null, 'A', null, null, '2018/10/01 00:00:00', '2018/12/31 23:59:59', 1, '1', '1'),
(84, 88, 100, null, 'A', null, null, '2018/10/01 00:00:00', '2018/12/31 23:59:59', 1, '1', '1'),
(85, 89, 100, null, 'A', null, null, '2018/10/01 00:00:00', '2018/12/31 23:59:59', 1, '1', '1'),
(86, 90, 100, null, 'A', null, null, '2018/10/01 00:00:00', '2018/12/31 23:59:59', 1, '1', '1'),
(87, 91, 6000, null, 'A', null, null, '2018/10/01 00:00:00', '2018/12/31 23:59:59', 1, '1', '1'),
(88, 4, 390, null, 'A', null, null, '2018/10/01 00:00:00', '2018/12/31 23:59:59', 1, '1', '1'),
(89, 6, 390, null, 'A', null, null, '2018/10/01 00:00:00', '2018/12/31 23:59:59', 1, '1', '1'),
(90, 8, 390, null, 'A', null, null, '2018/10/01 00:00:00', '2018/12/31 23:59:59', 1, '1', '1'),

(91, 9, 1800, null, 'A', null, null, '2018/10/01 00:00:00', '2018/12/31 23:59:59', 1, '1', '1'),
(92, 92, 950, null, 'A', null, null, '2018/10/01 00:00:00', '2018/12/31 23:59:59', 1, '1', '1'),
(93, 93, 850, null, 'A', null, null, '2018/10/01 00:00:00', '2018/12/31 23:59:59', 1, '1', '1');


-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `historial_item_precio` 
--
insert into `historial_item_precio` (`hipr_id`, `ite_id`, `hipr_precio`, `hipr_porcentaje_iva`, `hipr_fecha_inicio`, `hipr_fecha_fin`, `hipr_valor_minimo`, `hipr_porcentaje_minimo`, `hipr_usu_transaccion`, `hipr_estado`, `hipr_estado_logico`) values
-- Uteg --
(1, 1, 150, null, '2017/09/25 00:00:00', '2018/12/31 23:59:59', null, null, 1, '1', '1'),
(2, 2, 90, null, '2017/09/25 00:00:00', '2018/12/31 23:59:59', null, null, 1, '1', '1'),
(3, 3, 390, null, '2018/07/01 00:00:00', '2018/12/31 23:59:59', null, null, 1, '1', '1'),
(4, 5, 390, null, '2018/07/01 00:00:00', '2018/12/31 23:59:59', null, null, 1, '1', '1'),
(5, 7, 390, null, '2018/07/01 00:00:00', '2018/12/31 23:59:59', null, null, 1, '1', '1'),
(6, 10, 950, null, '2018/07/01 00:00:00', '2018/12/31 23:59:59', null, null, 1, '1', '1'),
-- Smart --
(7, 11, 80, null, '2018/10/01 00:00:00', '2018/12/31 23:59:59', null, null, 1, '1', '1'),
(8, 12, 80, null, '2018/10/01 00:00:00', '2018/12/31 23:59:59', null, null, 1, '1', '1'),
(9, 13, 60, null, '2018/10/01 00:00:00', '2018/12/31 23:59:59', null, null, 1, '1', '1'),
(10, 14, 100, null, '2018/10/01 00:00:00', '2018/12/31 23:59:59', null, null, 1, '1', '1'),
(11, 15, 150, null, '2018/10/01 00:00:00', '2018/12/31 23:59:59', null, null, 1, '1', '1'),
(12, 16, 180, null, '2018/10/01 00:00:00', '2018/12/31 23:59:59', null, null, 1, '1', '1'),
(13, 17, 150, null, '2018/10/01 00:00:00', '2018/12/31 23:59:59', null, null, 1, '1', '1'),
(14, 18, 100, null, '2018/10/01 00:00:00', '2018/12/31 23:59:59', null, null, 1, '1', '1'),
(15, 19, 99, null, '2018/10/01 00:00:00', '2018/12/31 23:59:59', null, null, 1, '1', '1'),
(16, 20, 145, null, '2018/10/01 00:00:00', '2018/12/31 23:59:59', null, null, 1, '1', '1'),
(17, 21, 150, null, '2018/10/01 00:00:00', '2018/12/31 23:59:59', null, null, 1, '1', '1'),
(18, 22, 80, null, '2018/10/01 00:00:00', '2018/12/31 23:59:59', null, null, 1, '1', '1'),
(19, 23, 120, null, '2018/10/01 00:00:00', '2018/12/31 23:59:59', null, null, 1, '1', '1'),
(20, 24, 120, null, '2018/10/01 00:00:00', '2018/12/31 23:59:59', null, null, 1, '1', '1'),
(21, 25, 100, null, '2018/10/01 00:00:00', '2018/12/31 23:59:59', null, null, 1, '1', '1'),
(22, 26, 120, null, '2018/10/01 00:00:00', '2018/12/31 23:59:59', null, null, 1, '1', '1'),
(23, 27, 150, null, '2018/10/01 00:00:00', '2018/12/31 23:59:59', null, null, 1, '1', '1'),
(24, 28, 120, null, '2018/10/01 00:00:00', '2018/12/31 23:59:59', null, null, 1, '1', '1'),
(25, 29, 120, null, '2018/10/01 00:00:00', '2018/12/31 23:59:59', null, null, 1, '1', '1'),
(26, 30, 100, null, '2018/10/01 00:00:00', '2018/12/31 23:59:59', null, null, 1, '1', '1'),
(27, 31, 100, null, '2018/10/01 00:00:00', '2018/12/31 23:59:59', null, null, 1, '1', '1'),
(28, 32, 180, null, '2018/10/01 00:00:00', '2018/12/31 23:59:59', null, null, 1, '1', '1'),
(29, 33, 380, null, '2018/10/01 00:00:00', '2018/12/31 23:59:59', null, null, 1, '1', '1'),
(30, 34, 300, null, '2018/10/01 00:00:00', '2018/12/31 23:59:59', null, null, 1, '1', '1'),
-- Ulink --
(31, 35, 1200, null, '2018/10/01 00:00:00', '2018/12/31 23:59:59', null, null, 1, '1', '1'),
(32, 36, 1200, null, '2018/10/01 00:00:00', '2018/12/31 23:59:59', null, null, 1, '1', '1'),
(33, 37, 1200, null, '2018/10/01 00:00:00', '2018/12/31 23:59:59', null, null, 1, '1', '1'),
(34, 38, 1200, null, '2018/10/01 00:00:00', '2018/12/31 23:59:59', null, null, 1, '1', '1'),
(35, 39, 250, null, '2018/10/01 00:00:00', '2018/12/31 23:59:59', null, null, 1, '1', '1'),
(36, 40, 250, null, '2018/10/01 00:00:00', '2018/12/31 23:59:59', null, null, 1, '1', '1'),
(37, 41, 250, null, '2018/10/01 00:00:00', '2018/12/31 23:59:59', null, null, 1, '1', '1'),
(38, 42, 250, null, '2018/10/01 00:00:00', '2018/12/31 23:59:59', null, null, 1, '1', '1'),
(39, 43, 250, null, '2018/10/01 00:00:00', '2018/12/31 23:59:59', null, null, 1, '1', '1'),
(40, 44, 250, null, '2018/10/01 00:00:00', '2018/12/31 23:59:59', null, null, 1, '1', '1'),
(41, 45, 250, null, '2018/10/01 00:00:00', '2018/12/31 23:59:59', null, null, 1, '1', '1'),
(42, 46, 250, null, '2018/10/01 00:00:00', '2018/12/31 23:59:59', null, null, 1, '1', '1'),
(43, 47, 250, null, '2018/10/01 00:00:00', '2018/12/31 23:59:59', null, null, 1, '1', '1'),
(44, 48, 250, null, '2018/10/01 00:00:00', '2018/12/31 23:59:59', null, null, 1, '1', '1'),
(45, 49, 250, null, '2018/10/01 00:00:00', '2018/12/31 23:59:59', null, null, 1, '1', '1'),
(46, 50, 250, null, '2018/10/01 00:00:00', '2018/12/31 23:59:59', null, null, 1, '1', '1'),
(47, 51, 250, null, '2018/10/01 00:00:00', '2018/12/31 23:59:59', null, null, 1, '1', '1'),
(48, 52, 250, null, '2018/10/01 00:00:00', '2018/12/31 23:59:59', null, null, 1, '1', '1'),
(49, 53, 250, null, '2018/10/01 00:00:00', '2018/12/31 23:59:59', null, null, 1, '1', '1'),
(50, 54, 250, null, '2018/10/01 00:00:00', '2018/12/31 23:59:59', null, null, 1, '1', '1'),
(51, 55, 250, null, '2018/10/01 00:00:00', '2018/12/31 23:59:59', null, null, 1, '1', '1'),
(52, 56, 250, null, '2018/10/01 00:00:00', '2018/12/31 23:59:59', null, null, 1, '1', '1'),
(53, 57, 250, null, '2018/10/01 00:00:00', '2018/12/31 23:59:59', null, null, 1, '1', '1'),
(54, 58, 250, null, '2018/10/01 00:00:00', '2018/12/31 23:59:59', null, null, 1, '1', '1'),
(55, 59, 250, null, '2018/10/01 00:00:00', '2018/12/31 23:59:59', null, null, 1, '1', '1'),
(56, 60, 250, null, '2018/10/01 00:00:00', '2018/12/31 23:59:59', null, null, 1, '1', '1'),
(57, 61, 250, null, '2018/10/01 00:00:00', '2018/12/31 23:59:59', null, null, 1, '1', '1'),
(58, 62, 250, null, '2018/10/01 00:00:00', '2018/12/31 23:59:59', null, null, 1, '1', '1'),
(59, 63, 250, null, '2018/10/01 00:00:00', '2018/12/31 23:59:59', null, null, 1, '1', '1'),
(60, 64, 100, null, '2018/10/01 00:00:00', '2018/12/31 23:59:59', null, null, 1, '1', '1'),
(61, 65, 100, null, '2018/10/01 00:00:00', '2018/12/31 23:59:59', null, null, 1, '1', '1'),
(62, 66, 100, null, '2018/10/01 00:00:00', '2018/12/31 23:59:59', null, null, 1, '1', '1'),
(63, 67, 100, null, '2018/10/01 00:00:00', '2018/12/31 23:59:59', null, null, 1, '1', '1'),
(64, 68, 100, null, '2018/10/01 00:00:00', '2018/12/31 23:59:59', null, null, 1, '1', '1'),
(65, 69, 100, null, '2018/10/01 00:00:00', '2018/12/31 23:59:59', null, null, 1, '1', '1'),
(66, 70, 100, null, '2018/10/01 00:00:00', '2018/12/31 23:59:59', null, null, 1, '1', '1'),
(67, 71, 100, null, '2018/10/01 00:00:00', '2018/12/31 23:59:59', null, null, 1, '1', '1'),
(68, 72, 100, null, '2018/10/01 00:00:00', '2018/12/31 23:59:59', null, null, 1, '1', '1'),
(69, 73, 100, null, '2018/10/01 00:00:00', '2018/12/31 23:59:59', null, null, 1, '1', '1'),
(70, 74, 100, null, '2018/10/01 00:00:00', '2018/12/31 23:59:59', null, null, 1, '1', '1'),
(71, 75, 100, null, '2018/10/01 00:00:00', '2018/12/31 23:59:59', null, null, 1, '1', '1'),
(72, 76, 100, null, '2018/10/01 00:00:00', '2018/12/31 23:59:59', null, null, 1, '1', '1'),
(73, 77, 100, null, '2018/10/01 00:00:00', '2018/12/31 23:59:59', null, null, 1, '1', '1'),
(74, 78, 100, null, '2018/10/01 00:00:00', '2018/12/31 23:59:59', null, null, 1, '1', '1'),
(75, 79, 100, null, '2018/10/01 00:00:00', '2018/12/31 23:59:59', null, null, 1, '1', '1'),
(76, 80, 100, null, '2018/10/01 00:00:00', '2018/12/31 23:59:59', null, null, 1, '1', '1'),
(77, 81, 100, null, '2018/10/01 00:00:00', '2018/12/31 23:59:59', null, null, 1, '1', '1'),
(78, 82, 100, null, '2018/10/01 00:00:00', '2018/12/31 23:59:59', null, null, 1, '1', '1'),
(79, 83, 100, null, '2018/10/01 00:00:00', '2018/12/31 23:59:59', null, null, 1, '1', '1'),
(80, 84, 100, null, '2018/10/01 00:00:00', '2018/12/31 23:59:59', null, null, 1, '1', '1'),
(81, 85, 100, null, '2018/10/01 00:00:00', '2018/12/31 23:59:59', null, null, 1, '1', '1'),
(82, 86, 100, null, '2018/10/01 00:00:00', '2018/12/31 23:59:59', null, null, 1, '1', '1'),
(83, 87, 100, null, '2018/10/01 00:00:00', '2018/12/31 23:59:59', null, null, 1, '1', '1'),
(84, 88, 100, null, '2018/10/01 00:00:00', '2018/12/31 23:59:59', null, null, 1, '1', '1'),
(85, 89, 100, null, '2018/10/01 00:00:00', '2018/12/31 23:59:59', null, null, 1, '1', '1'),
(86, 90, 100, null, '2018/10/01 00:00:00', '2018/12/31 23:59:59', null, null, 1, '1', '1'),
(87, 91, 6000, null,'2018/10/01 00:00:00', '2018/12/31 23:59:59', null, null, 1, '1', '1'),

(88, 9, 1800, null,'2018/10/01 00:00:00', '2018/12/31 23:59:59', null, null, 1, '1', '1'),
(89, 92, 950, null,'2018/10/01 00:00:00', '2018/12/31 23:59:59', null, null, 1, '1', '1'),
(90, 93, 850, null,'2018/10/01 00:00:00', '2018/12/31 23:59:59', null, null, 1, '1', '1');

-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `item_metodo_nivel` 
--
insert into `item_metodo_unidad` (`imni_id`, `ite_id`, `ming_id`, `uaca_id`, `mod_id`, `mest_id`, `imni_usu_ingreso`, `imni_estado`, `imni_estado_logico`) values
-- Uteg --
(1, 1, 1, 1, 1, null, 1, '1', '1'),
(2, 2, 2, 1, 1, null, 1, '1', '1'),
(3, 3, 1, 1, 2, null, 1, '1', '1'),
(4, 5, 1, 1, 3, null, 1, '1', '1'),
(5, 7, 1, 1, 4, null, 1, '1', '1'),
(6, 10, 4, 2, 3, null, 1, '1', '1'),
-- Smart --
(7, 11, null, 3, 2, 1, 1, '1', '1'),
(8, 12, null, 3, 2, 2, 1, '1', '1'),
(9, 13, null, 3, 2, 3, 1, '1', '1'),
(10, 14, null, 3, 2, 4, 1, '1', '1'),
(11, 15, null, 3, 2, 5, 1, '1', '1'),
(12, 16, null, 3, 2, 6, 1, '1', '1'),
(13, 17, null, 3, 2, 7, 1, '1', '1'),
(14, 18, null, 3, 2, 8, 1, '1', '1'),
(15, 19, null, 3, 2, 9, 1, '1', '1'),
(16, 20, null, 3, 2, 11, 1, '1', '1'),
(17, 21, null, 3, 2, 12, 1, '1', '1'),
(18, 22, null, 3, 2, 13, 1, '1', '1'),
(19, 23, null, 3, 2, 14, 1, '1', '1'),
(20, 24, null, 3, 2, 15, 1, '1', '1'),
(21, 25, null, 3, 2, 16, 1, '1', '1'),
(22, 26, null, 3, 2, 17, 1, '1', '1'),
(23, 27, null, 3, 2, 18, 1, '1', '1'),
(24, 28, null, 3, 2, 19, 1, '1', '1'),
(25, 29, null, 3, 2, 20, 1, '1', '1'),
(26, 30, null, 3, 2, 22, 1, '1', '1'),
(27, 31, null, 3, 2, 23, 1, '1', '1'),
(28, 32, null, 3, 2, 24, 1, '1', '1'),
(29, 33, null, 3, 2, 25, 1, '1', '1'),
(30, 34, null, 3, 2, 26, 1, '1', '1'),
-- Ulink --
(31, 35, null, 5, 1, 27, 1, '1', '1'),
(32, 36, null, 5, 1, 28, 1, '1', '1'),
(33, 37, null, 5, 1, 29, 1, '1', '1'),
(34, 38, null, 5, 1, 30, 1, '1', '1'),
(35, 39, null, 3, 1, 31, 1, '1', '1'),
(36, 40, null, 3, 1, 32, 1, '1', '1'),
(37, 41, null, 3, 1, 33, 1, '1', '1'),
(38, 42, null, 3, 1, 34, 1, '1', '1'),
(39, 43, null, 3, 1, 35, 1, '1', '1'),
(40, 44, null, 3, 1, 36, 1, '1', '1'),
(41, 45, null, 3, 1, 37, 1, '1', '1'),
(42, 46, null, 3, 1, 38, 1, '1', '1'),
(43, 47, null, 3, 1, 39, 1, '1', '1'),
(44, 48, null, 3, 1, 40, 1, '1', '1'),
(45, 49, null, 3, 1, 41, 1, '1', '1'),
(46, 50, null, 3, 1, 42, 1, '1', '1'),
(47, 51, null, 3, 1, 43, 1, '1', '1'),
(48, 52, null, 3, 1, 44, 1, '1', '1'),
(49, 53, null, 3, 1, 45, 1, '1', '1'),
(50, 54, null, 3, 1, 46, 1, '1', '1'),
(51, 55, null, 3, 1, 47, 1, '1', '1'),
(52, 56, null, 3, 1, 48, 1, '1', '1'),
(53, 57, null, 3, 1, 49, 1, '1', '1'),
(54, 58, null, 3, 1, 50, 1, '1', '1'),
(55, 59, null, 3, 1, 51, 1, '1', '1'),
(56, 60, null, 3, 1, 52, 1, '1', '1'),
(57, 61, null, 3, 1, 53, 1, '1', '1'),
(58, 62, null, 3, 1, 54, 1, '1', '1'),
(59, 63, null, 3, 1, 55, 1, '1', '1'),
(60, 64, null, 3, 1, 56, 1, '1', '1'),
(61, 65, null, 3, 1, 57, 1, '1', '1'),
(62, 66, null, 3, 1, 58, 1, '1', '1'),
(63, 67, null, 3, 1, 59, 1, '1', '1'),
(64, 68, null, 3, 1, 60, 1, '1', '1'),
(65, 69, null, 3, 1, 61, 1, '1', '1'),
(66, 70, null, 3, 1, 62, 1, '1', '1'),
(67, 71, null, 3, 1, 63, 1, '1', '1'),
(68, 72, null, 3, 1, 64, 1, '1', '1'),
(69, 73, null, 3, 1, 65, 1, '1', '1'),
(70, 74, null, 3, 1, 66, 1, '1', '1'),
(71, 75, null, 3, 1, 67, 1, '1', '1'),
(72, 76, null, 3, 1, 68, 1, '1', '1'),
(73, 77, null, 3, 1, 69, 1, '1', '1'),
(74, 78, null, 3, 1, 70, 1, '1', '1'),
(75, 79, null, 3, 1, 71, 1, '1', '1'),
(76, 80, null, 3, 1, 72, 1, '1', '1'),
(77, 81, null, 3, 1, 73, 1, '1', '1'),
(78, 82, null, 3, 1, 74, 1, '1', '1'),
(79, 83, null, 3, 1, 75, 1, '1', '1'),
(80, 84, null, 3, 1, 76, 1, '1', '1'),
(81, 85, null, 6, 1, 77, 1, '1', '1'),
(82, 86, null, 6, 1, 78, 1, '1', '1'),
(83, 87, null, 6, 1, 79, 1, '1', '1'),
(84, 88, null, 6, 1, 80, 1, '1', '1'),
(85, 89, null, 6, 1, 81, 1, '1', '1'),
(86, 90, null, 6, 1, 82, 1, '1', '1'),
(87, 91, null, 2, 1, 83, 1, '1', '1'),
(88, 4, 2, 1, 2, null, 1, '1', '1'),
(89, 6, 2, 1, 3, null, 1, '1', '1'),
(90, 8, 2, 1, 4, null, 1, '1', '1'),
(91, 10, 4, 2, 2, null, 1, '1', '1'),

(92, 9, 4, 2, 3, null, 1, '1', '1'),
(93, 9, 4, 2, 2, null,  1, '1', '1'),
(94, 92, 4, 2, 3, null,  1, '1', '1'),
(95, 92, 4, 2, 2, null,  1, '1', '1'),
(96, 93, 4, 2, 3, null,  1, '1', '1'),
(97, 93, 4, 2, 2, null,  1, '1', '1');

-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `forma_pago` 
--
insert into `forma_pago` (`fpag_id`,  `fpag_nombre`, `fpag_descripcion`, `fpag_distintivo`, `fpag_usu_ingreso`, `fpag_estado`, `fpag_estado_logico`) values
(1,'Tarjeta de Credito', 'Tarjeta de Credito', '1', 1, '1','1'),
(2,'Efectivo', 'Efectivo', '1', 1, '1','1'),
(3,'Cheque', 'Cheque', '1', 1, '1','1'),
(4,'Transferencia', 'Transferencia', '2', 1, '1','1'),
(5,'Depósito', 'Depósito', '2', 1, '1','1'),
(6,'Botón de Pagos', 'Botón de Pagos', '3', 1, '1','1'),
(7,'Pago en Línea', 'Pago en Línea', '1', 1, '1','1');

-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `tipo_comprobante` 
--
insert into `tipo_comprobante` (`tcom_id`, `tcom_nombre`, `tcom_usuario_ingreso`, `tcom_estado`, `tcom_estado_logico`) values
(1, 'Factura', 1, '1', '1'),
(2, 'Nota de Crédito', 1, '1', '1'),
(3, 'Nota de Débito', 1, '1', '1'),
(4, 'Comprobantes de Retención', 1, '1', '1'),
(5, 'Guía de Remisión', 1, '1', '1');

-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `descuento_item` 
-- --------------------------------------------------------
insert into `descuento_item` (`dite_id`, `ite_id`, `dite_usu_creacion`, `dite_estado`, `dite_estado_logico`) values
(1, 1, 1, '1', '1'), -- Online
(2, 3, 1, '1', '1'), -- Presencial
(3, 5, 1, '1', '1'), -- Semipresencial
(4, 7, 1, '1', '1'), -- A distancia
(5, 4, 1, '1', '1'), -- examen presencial
(6, 6, 1, '1', '1'), -- examen semipresencial
(7, 8, 1, '1', '1'), -- examen a distancia

(8, 11, 1, '1', '1'), -- Emprendimiento y Ventas
(9, 12, 1, '1', '1'), -- Excel Avanzado
(10, 13, 1, '1', '1'), -- Fotografía
(11, 14, 1, '1', '1'), -- Event Planner
(12, 15, 1, '1', '1'), -- Programa Gerencia Estratégica del TH (4 módulos)
(13, 16, 1, '1', '1'), -- Pedagogía
(14, 17, 1, '1', '1'), -- Programa para docentes:  Redacción Científica
(15, 18, 1, '1', '1'), -- Desarrollo Habilidades Comerciales para Retail
(16, 19, 1, '1', '1'), -- Cursos Online
(17, 20, 1, '1', '1'), -- Programa de Talento Humano: Actualidad Laboral
(18, 21, 1, '1', '1'), -- Programa de habilidades Gerenciales: Estrategias directivas
(19, 22, 1, '1', '1'), -- Illustrator y fotoshop: intermedio
(20, 23, 1, '1', '1'), -- Técnicas de negociación y cierre de ventas
(21, 24, 1, '1', '1'), -- Neuromarketing
(22, 25, 1, '1', '1'), -- Programa de Talento Humano: Descripción de cargos y selección por competencias (módulo 2)
(23, 26, 1, '1', '1'), -- Técnicas de ventas:  Manejo de clientes difíciles
(24, 27, 1, '1', '1'), -- Programa de habilidades Gerenciales: Negociación efectiva
(25, 28, 1, '1', '1'), -- Dirección en Finanzas: Presupuesto y diferenciación de ingresos
(26, 29, 1, '1', '1'), -- Valoración aduanera para empresarios
(27, 30, 1, '1', '1'), -- Programa de Talento Humano:  Plan estratégico del Talento Humano (módulo 3)
(28, 31, 1, '1', '1'), -- Taller de liderazgo y manejo de conflictos
(29, 32, 1, '1', '1'), -- Programa para docentes: Habilidades pedagógicas
(30, 33, 1, '1', '1'), -- Promoción programa talento humano
(31, 34, 1, '1', '1'); -- Promoción programa para docentes

-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `detalle_descuento_item` 
-- --------------------------------------------------------
insert into `detalle_descuento_item` (`ddit_id` , `dite_id`, `ddit_descripcion`, `ddit_tipo_beneficio`, `ddit_porcentaje`, `ddit_valor`, `ddit_finicio`, `ddit_ffin`, `ddit_estado_descuento`, `ddit_usu_creacion`, `ddit_estado`, `ddit_estado_logico`) values
(1, 1, 'Descuento CAN Campania 20%', 'P', 20, null, '2018/08/01 00:00:00', '2018/12/31 23:59:59', 'A', 1, '1', '1'), 
(2, 2, 'Descuento CAN Campania 25%', 'P', 25, null, '2018/08/01 00:00:00', '2018/12/31 23:59:59', 'A', 1, '1', '1'), 
(3, 3, 'Descuento CAN Campania 25%', 'P', 25, null, '2018/08/01 00:00:00', '2018/12/31 23:59:59', 'A', 1, '1', '1'), 
(4, 4, 'Descuento CAN Campania 25%', 'P', 25, null, '2018/08/01 00:00:00', '2018/12/31 23:59:59', 'A', 1, '1', '1'), 
(5, 2, 'Descuento CAN CNEL 10%', 'P', 10, null, '2018/08/01 00:00:00', '2018/12/31 23:59:59', 'A', 1, '1', '1'), 
(6, 3, 'Descuento CAN CNEL 10%', 'P', 10, null, '2018/08/01 00:00:00', '2018/12/31 23:59:59', 'A', 1, '1', '1'), 
(7, 4, 'Descuento CAN CNEL 10%', 'P', 10, null, '2018/08/01 00:00:00', '2018/12/31 23:59:59', 'A', 1, '1', '1'), 
(8, 2, 'Descuento CAN Cámara Turismo del Guayas 10%', 'P', 10, null, '2018/08/01 00:00:00', '2018/12/31 23:59:59', 'A', 1, '1', '1'), 
(9, 3, 'Descuento CAN Cámara Turismo del Guayas 10%', 'P', 10, null, '2018/08/01 00:00:00', '2018/12/31 23:59:59', 'A', 1, '1', '1'), 
(10, 4, 'Descuento CAN Cámara Turismo del Guayas 10%', 'P', 10, null, '2018/08/01 00:00:00', '2018/12/31 23:59:59', 'A', 1, '1', '1'), 
(11, 2, 'Descuento CAN Cámara Espanola de Comercio de Ecuador 10%', 'P', 10, null, '2018/08/01 00:00:00', '2018/12/31 23:59:59', 'A', 1, '1', '1'), 
(12, 3, 'Descuento CAN Cámara Espanola de Comercio de Ecuador 10%', 'P', 10, null, '2018/08/01 00:00:00', '2018/12/31 23:59:59', 'A', 1, '1', '1'), 
(13, 4, 'Descuento CAN Cámara Espanola de Comercio de Ecuador 10%', 'P', 10, null, '2018/08/01 00:00:00', '2018/12/31 23:59:59', 'A', 1, '1', '1'), 
(14, 2, 'Descuento CAN Banco Guayaquil 10%', 'P', 10, null, '2018/08/01 00:00:00', '2018/12/31 23:59:59', 'A', 1, '1', '1'), 
(15, 3, 'Descuento CAN Banco Guayaquil 10%', 'P', 10, null, '2018/08/01 00:00:00', '2018/12/31 23:59:59', 'A', 1, '1', '1'), 
(16, 4, 'Descuento CAN Banco Guayaquil 10%', 'P', 10, null, '2018/08/01 00:00:00', '2018/12/31 23:59:59', 'A', 1, '1', '1'), 
(17, 2, 'Descuento CAN Barcelona 10%', 'P', 10, null, '2018/08/01 00:00:00', '2018/12/31 23:59:59', 'A', 1, '1', '1'), 
(18, 3, 'Descuento CAN Barcelona 10%', 'P', 10, null, '2018/08/01 00:00:00', '2018/12/31 23:59:59', 'A', 1, '1', '1'), 
(19, 4, 'Descuento CAN Barcelona 10%', 'P', 10, null, '2018/08/01 00:00:00', '2018/12/31 23:59:59', 'A', 1, '1', '1'), 
(20, 2, 'Descuento CAN Hospital IESS de Machala 10%', 'P', 10, null, '2018/08/01 00:00:00', '2018/12/31 23:59:59', 'A', 1, '1', '1'), 
(21, 3, 'Descuento CAN Hospital IESS de Machala 10%', 'P', 10, null, '2018/08/01 00:00:00', '2018/12/31 23:59:59', 'A', 1, '1', '1'), 
(22, 4, 'Descuento CAN Hospital IESS de Machala 10%', 'P', 10, null, '2018/08/01 00:00:00', '2018/12/31 23:59:59', 'A', 1, '1', '1'),
(23, 2, 'Descuento CAN Reserva 25%', 'P', 25, null, '2018/08/01 00:00:00', '2018/12/31 23:59:59', 'A', 1, '1', '1'), 
(24, 3, 'Descuento CAN Reserva 25%', 'P', 25, null, '2018/08/01 00:00:00', '2018/12/31 23:59:59', 'A', 1, '1', '1'), 
(25, 4, 'Descuento CAN Reserva 25%', 'P', 25, null, '2018/08/01 00:00:00', '2018/12/31 23:59:59', 'A', 1, '1', '1'),
(26, 1, 'Descuento CAN Barcelona 40%', 'P', 40, null, '2018/08/01 00:00:00', '2018/12/31 23:59:59', 'A', 1, '1', '1'),
(27, 2, 'Descuento CAN Inscripción por Valor', 'V', null, 96, '2018/10/18 00:00:00', '2018/12/31 23:59:59', 'A', 1, '1', '1'),
(28, 3, 'Descuento CAN Inscripción por Valor', 'V', null, 96, '2018/10/18 00:00:00', '2018/12/31 23:59:59', 'A', 1, '1', '1'),
(29, 4, 'Descuento CAN Inscripción por Valor', 'V', null, 96, '2018/10/18 00:00:00', '2018/12/31 23:59:59', 'A', 1, '1', '1'),
(30, 5, 'Descuento CAN Inscripción por Valor', 'V', null, 96, '2018/10/18 00:00:00', '2018/12/31 23:59:59', 'A', 1, '1', '1'),
(31, 6, 'Descuento CAN Inscripción por Valor', 'V', null, 96, '2018/10/18 00:00:00', '2018/12/31 23:59:59', 'A', 1, '1', '1'),
(32, 7, 'Descuento CAN Inscripción por Valor', 'V', null, 96, '2018/10/18 00:00:00', '2018/12/31 23:59:59', 'A', 1, '1', '1'),

(33, 8, 'Descuento 20%', 'P', 20, null, '2018/12/06 00:00:00', null, 'A', 1, '1', '1'),
(34, 9, 'Descuento 20%', 'P', 20, null, '2018/12/06 00:00:00', null, 'A', 1, '1', '1'),
(35, 10, 'Descuento 20%', 'P', 20, null, '2018/12/06 00:00:00', null, 'A', 1, '1', '1'),
(36, 11, 'Descuento 20%', 'P', 20, null, '2018/12/06 00:00:00', null, 'A', 1, '1', '1'),
(37, 12, 'Descuento 20%', 'P', 20, null, '2018/12/06 00:00:00', null, 'A', 1, '1', '1'),
(38, 13, 'Descuento 20%', 'P', 20, null, '2018/12/06 00:00:00', null, 'A', 1, '1', '1'),
(39, 14, 'Descuento 20%', 'P', 20, null, '2018/12/06 00:00:00', null, 'A', 1, '1', '1'),
(40, 15, 'Descuento 20%', 'P', 20, null, '2018/12/06 00:00:00', null, 'A', 1, '1', '1'),
(41, 16, 'Descuento 20%', 'P', 20, null, '2018/12/06 00:00:00', null, 'A', 1, '1', '1'),
(42, 17, 'Descuento 20%', 'P', 20, null, '2018/12/06 00:00:00', null, 'A', 1, '1', '1'),
(43, 18, 'Descuento 20%', 'P', 20, null, '2018/12/06 00:00:00', null, 'A', 1, '1', '1'),
(44, 19, 'Descuento 20%', 'P', 20, null, '2018/12/06 00:00:00', null, 'A', 1, '1', '1'),
(45, 20, 'Descuento 20%', 'P', 20, null, '2018/12/06 00:00:00', null, 'A', 1, '1', '1'),
(46, 21, 'Descuento 20%', 'P', 20, null, '2018/12/06 00:00:00', null, 'A', 1, '1', '1'),
(47, 22, 'Descuento 20%', 'P', 20, null, '2018/12/06 00:00:00', null, 'A', 1, '1', '1'),
(48, 23, 'Descuento 20%', 'P', 20, null, '2018/12/06 00:00:00', null, 'A', 1, '1', '1'),
(49, 24, 'Descuento 20%', 'P', 20, null, '2018/12/06 00:00:00', null, 'A', 1, '1', '1'),
(50, 25, 'Descuento 20%', 'P', 20, null, '2018/12/06 00:00:00', null, 'A', 1, '1', '1'),
(51, 26, 'Descuento 20%', 'P', 20, null, '2018/12/06 00:00:00', null, 'A', 1, '1', '1'),
(52, 27, 'Descuento 20%', 'P', 20, null, '2018/12/06 00:00:00', null, 'A', 1, '1', '1'),
(53, 28, 'Descuento 20%', 'P', 20, null, '2018/12/06 00:00:00', null, 'A', 1, '1', '1'),
(54, 29, 'Descuento 20%', 'P', 20, null, '2018/12/06 00:00:00', null, 'A', 1, '1', '1'),
(55, 30, 'Descuento 20%', 'P', 20, null, '2018/12/06 00:00:00', null, 'A', 1, '1', '1'),
(56, 31, 'Descuento 20%', 'P', 20, null, '2018/12/06 00:00:00', null, 'A', 1, '1', '1'),

(57, 8, 'Descuento 30%', 'P', 30, null, '2018/12/06 00:00:00', null, 'A', 1, '1', '1'),
(58, 9, 'Descuento 30%', 'P', 30, null, '2018/12/06 00:00:00', null, 'A', 1, '1', '1'),
(59, 10, 'Descuento 30%', 'P', 30, null, '2018/12/06 00:00:00', null, 'A', 1, '1', '1'),
(60, 11, 'Descuento 30%', 'P', 30, null, '2018/12/06 00:00:00', null, 'A', 1, '1', '1'),
(61, 12, 'Descuento 30%', 'P', 30, null, '2018/12/06 00:00:00', null, 'A', 1, '1', '1'),
(62, 13, 'Descuento 30%', 'P', 30, null, '2018/12/06 00:00:00', null, 'A', 1, '1', '1'),
(63, 14, 'Descuento 30%', 'P', 30, null, '2018/12/06 00:00:00', null, 'A', 1, '1', '1'),
(64, 15, 'Descuento 30%', 'P', 30, null, '2018/12/06 00:00:00', null, 'A', 1, '1', '1'),
(65, 16, 'Descuento 30%', 'P', 30, null, '2018/12/06 00:00:00', null, 'A', 1, '1', '1'),
(66, 17, 'Descuento 30%', 'P', 30, null, '2018/12/06 00:00:00', null, 'A', 1, '1', '1'),
(67, 18, 'Descuento 30%', 'P', 30, null, '2018/12/06 00:00:00', null, 'A', 1, '1', '1'),
(68, 19, 'Descuento 30%', 'P', 30, null, '2018/12/06 00:00:00', null, 'A', 1, '1', '1'),
(69, 20, 'Descuento 30%', 'P', 30, null, '2018/12/06 00:00:00', null, 'A', 1, '1', '1'),
(70, 21, 'Descuento 30%', 'P', 30, null, '2018/12/06 00:00:00', null, 'A', 1, '1', '1'),
(71, 22, 'Descuento 30%', 'P', 30, null, '2018/12/06 00:00:00', null, 'A', 1, '1', '1'),
(72, 23, 'Descuento 30%', 'P', 30, null, '2018/12/06 00:00:00', null, 'A', 1, '1', '1'),
(73, 24, 'Descuento 30%', 'P', 30, null, '2018/12/06 00:00:00', null, 'A', 1, '1', '1'),
(74, 25, 'Descuento 30%', 'P', 30, null, '2018/12/06 00:00:00', null, 'A', 1, '1', '1'),
(75, 26, 'Descuento 30%', 'P', 30, null, '2018/12/06 00:00:00', null, 'A', 1, '1', '1'),
(76, 27, 'Descuento 30%', 'P', 30, null, '2018/12/06 00:00:00', null, 'A', 1, '1', '1'),
(77, 28, 'Descuento 30%', 'P', 30, null, '2018/12/06 00:00:00', null, 'A', 1, '1', '1'),
(78, 29, 'Descuento 30%', 'P', 30, null, '2018/12/06 00:00:00', null, 'A', 1, '1', '1'),
(79, 30, 'Descuento 30%', 'P', 30, null, '2018/12/06 00:00:00', null, 'A', 1, '1', '1'),
(80, 31, 'Descuento 30%', 'P', 30, null, '2018/12/06 00:00:00', null, 'A', 1, '1', '1');

-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `detalle_descuento_item` 
-- --------------------------------------------------------
insert into `historial_descuento_item` (`hdit_id` , `ddit_id`, `dite_id`, `hdit_descripcion`, `hdit_tipo_beneficio`, `hdit_porcentaje`, `hdit_valor`, `hdit_fecha_inicio`, `hdit_fecha_fin`, `hdit_estado_descuento`, `hdit_usu_transaccion` , `hdit_estado`, `hdit_estado_logico`) values
(1, 1, 1, 'Descuento CAN Online 20%', 'P', 20, null, '2018/08/01 00:00:00', '2018/12/31 23:59:59', 'A', 1, '1', '1'), 
(2, 2, 2, 'Descuento CAN Campania 25%', 'P', 25, null, '2018/08/01 00:00:00', '2018/12/31 23:59:59', 'A', 1, '1', '1'), 
(3, 3, 3, 'Descuento CAN Campania 25%', 'P', 25, null, '2018/08/01 00:00:00', '2018/12/31 23:59:59', 'A', 1, '1', '1'), 
(4, 4, 4, 'Descuento CAN Campania 25%', 'P', 25, null, '2018/08/01 00:00:00', '2018/12/31 23:59:59', 'A', 1, '1', '1'), 
(5, 5, 2, 'Descuento CAN CNEL 10%', 'P', 10, null, '2018/08/01 00:00:00', '2018/12/31 23:59:59', 'A', 1, '1', '1'), 
(6, 6, 3, 'Descuento CAN CNEL 10%', 'P', 10, null, '2018/08/01 00:00:00', '2018/12/31 23:59:59', 'A', 1, '1', '1'), 
(7, 7, 4, 'Descuento CAN CNEL 10%', 'P', 10, null, '2018/08/01 00:00:00', '2018/12/31 23:59:59', 'A', 1, '1', '1'), 
(8, 8, 2, 'Descuento CAN Cámara Turismo del Guayas 10%', 'P', 10, null, '2018/08/01 00:00:00', '2018/12/31 23:59:59', 'A', 1, '1', '1'), 
(9, 9, 3, 'Descuento CAN Cámara Turismo del Guayas 10%', 'P', 10, null, '2018/08/01 00:00:00', '2018/12/31 23:59:59', 'A', 1, '1', '1'), 
(10, 10, 4, 'Descuento CAN Cámara Turismo del Guayas 10%', 'P', 10, null, '2018/08/01 00:00:00', '2018/12/31 23:59:59', 'A', 1, '1', '1'), 
(11, 11, 2, 'Descuento CAN Cámara Espanola de Comercio de Ecuador 10%', 'P', 10, null, '2018/08/01 00:00:00', '2018/12/31 23:59:59', 'A', 1, '1', '1'), 
(12, 12, 3, 'Descuento CAN Cámara Espanola de Comercio de Ecuador 10%', 'P', 10, null, '2018/08/01 00:00:00', '2018/12/31 23:59:59', 'A', 1, '1', '1'), 
(13, 13, 4, 'Descuento CAN Cámara Espanola de Comercio de Ecuador 10%', 'P', 10, null, '2018/08/01 00:00:00', '2018/12/31 23:59:59', 'A', 1, '1', '1'), 
(14, 14, 2, 'Descuento CAN Banco Guayaquil 10%', 'P', 10, null, '2018/08/01 00:00:00', '2018/12/31 23:59:59', 'A', 1, '1', '1'), 
(15, 15, 3, 'Descuento CAN Banco Guayaquil 10%', 'P', 10, null, '2018/08/01 00:00:00', '2018/12/31 23:59:59', 'A', 1, '1', '1'), 
(16, 16, 4, 'Descuento CAN Banco Guayaquil 10%', 'P', 10, null, '2018/08/01 00:00:00', '2018/12/31 23:59:59', 'A', 1, '1', '1'), 
(17, 17, 2, 'Descuento CAN Barcelona 10%', 'P', 10, null, '2018/08/01 00:00:00', '2018/12/31 23:59:59', 'A', 1, '1', '1'), 
(18, 18, 3, 'Descuento CAN Barcelona 10%', 'P', 10, null, '2018/08/01 00:00:00', '2018/12/31 23:59:59', 'A', 1, '1', '1'), 
(19, 19, 4, 'Descuento CAN Barcelona 10%', 'P', 10, null, '2018/08/01 00:00:00', '2018/12/31 23:59:59', 'A', 1, '1', '1'), 
(20, 20, 2, 'Descuento CAN Hospital IESS de Machala 10%', 'P', 10, null, '2018/08/01 00:00:00', '2018/12/31 23:59:59', 'A', 1, '1', '1'), 
(21, 21, 3, 'Descuento CAN Hospital IESS de Machala 10%', 'P', 10, null, '2018/08/01 00:00:00', '2018/12/31 23:59:59', 'A', 1, '1', '1'), 
(22, 22, 4, 'Descuento CAN Hospital IESS de Machala 10%', 'P', 10, null, '2018/08/01 00:00:00', '2018/12/31 23:59:59', 'A', 1, '1', '1'),
(23, 23, 2, 'Descuento CAN Reserva 25%', 'P', 25, null, '2018/08/01 00:00:00', '2018/12/31 23:59:59', 'A', 1, '1', '1'),
(24, 24, 3, 'Descuento CAN Reserva 25%', 'P', 25, null, '2018/08/01 00:00:00', '2018/12/31 23:59:59', 'A', 1, '1', '1'),
(25, 25, 4, 'Descuento CAN Reserva 25%', 'P', 25, null, '2018/08/01 00:00:00', '2018/12/31 23:59:59', 'A', 1, '1', '1'),
(26, 26, 1, 'Descuento CAN Barcelona 40%', 'P', 40, null, '2018/08/01 00:00:00', '2018/12/31 23:59:59', 'A', 1, '1', '1'),
(27, 27, 1, 'Descuento CAN Inscripción', 'V', null, 96, '2018/10/18 00:00:00', '2018/12/31 23:59:59', 'A', 1, '1', '1'),
(28, 28, 1, 'Descuento CAN Inscripción', 'V', null, 96, '2018/10/18 00:00:00', '2018/12/31 23:59:59', 'A', 1, '1', '1'),
(29, 29, 1, 'Descuento CAN Inscripción', 'V', null, 96, '2018/10/18 00:00:00', '2018/12/31 23:59:59', 'A', 1, '1', '1'),
(30, 30, 1, 'Descuento CAN Inscripción', 'V', null, 96, '2018/10/18 00:00:00', '2018/12/31 23:59:59', 'A', 1, '1', '1'),
(31, 31, 1, 'Descuento CAN Inscripción', 'V', null, 96, '2018/10/18 00:00:00', '2018/12/31 23:59:59', 'A', 1, '1', '1'),
(32, 32, 1, 'Descuento CAN Inscripción', 'V', null, 96, '2018/10/18 00:00:00', '2018/12/31 23:59:59', 'A', 1, '1', '1'),

(33, 33, 8, 'Descuento 20%', 'P', 20, null, '2018/12/06 00:00:00', null, 'A', 1, '1', '1'),
(34, 34, 9, 'Descuento 20%', 'P', 20, null, '2018/12/06 00:00:00', null, 'A', 1, '1', '1'),
(35, 35, 10, 'Descuento 20%', 'P', 20, null, '2018/12/06 00:00:00', null, 'A', 1, '1', '1'),
(36, 36, 11, 'Descuento 20%', 'P', 20, null, '2018/12/06 00:00:00', null, 'A', 1, '1', '1'),
(37, 37, 12, 'Descuento 20%', 'P', 20, null, '2018/12/06 00:00:00', null, 'A', 1, '1', '1'),
(38, 38, 13, 'Descuento 20%', 'P', 20, null, '2018/12/06 00:00:00', null, 'A', 1, '1', '1'),
(39, 39, 14, 'Descuento 20%', 'P', 20, null, '2018/12/06 00:00:00', null, 'A', 1, '1', '1'),
(40, 40, 15, 'Descuento 20%', 'P', 20, null, '2018/12/06 00:00:00', null, 'A', 1, '1', '1'),
(41, 41, 16, 'Descuento 20%', 'P', 20, null, '2018/12/06 00:00:00', null, 'A', 1, '1', '1'),
(42, 42, 17, 'Descuento 20%', 'P', 20, null, '2018/12/06 00:00:00', null, 'A', 1, '1', '1'),
(43, 43, 18, 'Descuento 20%', 'P', 20, null, '2018/12/06 00:00:00', null, 'A', 1, '1', '1'),
(44, 44, 19, 'Descuento 20%', 'P', 20, null, '2018/12/06 00:00:00', null, 'A', 1, '1', '1'),
(45, 45, 20, 'Descuento 20%', 'P', 20, null, '2018/12/06 00:00:00', null, 'A', 1, '1', '1'),
(46, 46, 21, 'Descuento 20%', 'P', 20, null, '2018/12/06 00:00:00', null, 'A', 1, '1', '1'),
(47, 47, 22, 'Descuento 20%', 'P', 20, null, '2018/12/06 00:00:00', null, 'A', 1, '1', '1'),
(48, 48, 23, 'Descuento 20%', 'P', 20, null, '2018/12/06 00:00:00', null, 'A', 1, '1', '1'),
(49, 49, 24, 'Descuento 20%', 'P', 20, null, '2018/12/06 00:00:00', null, 'A', 1, '1', '1'),
(50, 50, 25, 'Descuento 20%', 'P', 20, null, '2018/12/06 00:00:00', null, 'A', 1, '1', '1'),
(51, 51, 26, 'Descuento 20%', 'P', 20, null, '2018/12/06 00:00:00', null, 'A', 1, '1', '1'),
(52, 52, 27, 'Descuento 20%', 'P', 20, null, '2018/12/06 00:00:00', null, 'A', 1, '1', '1'),
(53, 53, 28, 'Descuento 20%', 'P', 20, null, '2018/12/06 00:00:00', null, 'A', 1, '1', '1'),
(54, 54, 29, 'Descuento 20%', 'P', 20, null, '2018/12/06 00:00:00', null, 'A', 1, '1', '1'),
(55, 55, 30, 'Descuento 20%', 'P', 20, null, '2018/12/06 00:00:00', null, 'A', 1, '1', '1'),
(56, 56, 31, 'Descuento 20%', 'P', 20, null, '2018/12/06 00:00:00', null, 'A', 1, '1', '1'),

(57, 57, 8, 'Descuento 30%', 'P', 30, null, '2018/12/06 00:00:00', null, 'A', 1, '1', '1'),
(58, 58, 9, 'Descuento 30%', 'P', 30, null, '2018/12/06 00:00:00', null, 'A', 1, '1', '1'),
(59, 59, 10, 'Descuento 30%', 'P', 30, null, '2018/12/06 00:00:00', null, 'A', 1, '1', '1'),
(60, 60, 11, 'Descuento 30%', 'P', 30, null, '2018/12/06 00:00:00', null, 'A', 1, '1', '1'),
(61, 61, 12, 'Descuento 30%', 'P', 30, null, '2018/12/06 00:00:00', null, 'A', 1, '1', '1'),
(62, 62, 13, 'Descuento 30%', 'P', 30, null, '2018/12/06 00:00:00', null, 'A', 1, '1', '1'),
(63, 63, 14, 'Descuento 30%', 'P', 30, null, '2018/12/06 00:00:00', null, 'A', 1, '1', '1'),
(64, 64, 15, 'Descuento 30%', 'P', 30, null, '2018/12/06 00:00:00', null, 'A', 1, '1', '1'),
(65, 65, 16, 'Descuento 30%', 'P', 30, null, '2018/12/06 00:00:00', null, 'A', 1, '1', '1'),
(66, 66, 17, 'Descuento 30%', 'P', 30, null, '2018/12/06 00:00:00', null, 'A', 1, '1', '1'),
(67, 67, 18, 'Descuento 30%', 'P', 30, null, '2018/12/06 00:00:00', null, 'A', 1, '1', '1'),
(68, 68, 19, 'Descuento 30%', 'P', 30, null, '2018/12/06 00:00:00', null, 'A', 1, '1', '1'),
(69, 69, 20, 'Descuento 30%', 'P', 30, null, '2018/12/06 00:00:00', null, 'A', 1, '1', '1'),
(70, 70, 21, 'Descuento 30%', 'P', 30, null, '2018/12/06 00:00:00', null, 'A', 1, '1', '1'),
(71, 71, 22, 'Descuento 30%', 'P', 30, null, '2018/12/06 00:00:00', null, 'A', 1, '1', '1'),
(72, 72, 23, 'Descuento 30%', 'P', 30, null, '2018/12/06 00:00:00', null, 'A', 1, '1', '1'),
(73, 73, 24, 'Descuento 30%', 'P', 30, null, '2018/12/06 00:00:00', null, 'A', 1, '1', '1'),
(74, 74, 25, 'Descuento 30%', 'P', 30, null, '2018/12/06 00:00:00', null, 'A', 1, '1', '1'),
(75, 75, 26, 'Descuento 30%', 'P', 30, null, '2018/12/06 00:00:00', null, 'A', 1, '1', '1'),
(76, 76, 27, 'Descuento 30%', 'P', 30, null, '2018/12/06 00:00:00', null, 'A', 1, '1', '1'),
(77, 77, 28, 'Descuento 30%', 'P', 30, null, '2018/12/06 00:00:00', null, 'A', 1, '1', '1'),
(78, 78, 29, 'Descuento 30%', 'P', 30, null, '2018/12/06 00:00:00', null, 'A', 1, '1', '1'),
(79, 79, 30, 'Descuento 30%', 'P', 30, null, '2018/12/06 00:00:00', null, 'A', 1, '1', '1'),
(80, 80, 31, 'Descuento 30%', 'P', 30, null, '2018/12/06 00:00:00', null, 'A', 1, '1', '1');

-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `secuencias` 
-- --------------------------------------------------------
insert into `secuencias` (`emp_id`, `estab_id`, `pemis_id`, `secu_tipo_doc`, `secuencia`, `secu_nombre`, `secu_estado`, `secu_estado_logico`) VALUES
(1, 1, 1, 'SOL', '000000215', 'SOLICITUDES UTEG', '1', '1'),
(2, 1, 1, 'SOL', '000000000', 'SOLICITUDES SMART', '1', '1'),
(3, 1, 1, 'SOL', '000000000', 'SOLICITUDES ULINK', '1', '1');
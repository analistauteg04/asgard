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
(3, 'Educación Continua', 'Educación Continua', 1, '0', '1', '1'),
(4, 'Centro de Idiomas', 'Centro de Idiomas', 1, '0', '1', '1'),
(5, 'Diplomado', 'Diplomado', 1, '0', '1', '1'),
(6, 'Curso Nivelación', 'Curso Nivelación', 1, '0', '1', '1');

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
INSERT INTO `estudio_academico` (`eaca_id`, `teac_id`, `eaca_nombre`, `eaca_descripcion`, `eaca_alias`, `eaca_usuario_ingreso`, `eaca_usuario_modifica`, `eaca_estado`, `eaca_fecha_creacion`, `eaca_fecha_modificacion`, `eaca_estado_logico`) VALUES
(1, 1, 'Licenciatura en Comercio Exterior', 'Licenciatura en Comercio Exterior', 'licenciatura_en_comercio_exterior', 1, NULL, '1', '2017-02-01 16:25:00', NULL, '1'),
(2, 1, 'Economía', 'Economía', 'economia', 1, NULL, '1', '2017-02-01 16:25:00', NULL, '1'),
(3, 1, 'Licenciatura en Finanzas', 'Licenciatura en Finanzas', 'licenciatura_en_finanzas', 1, NULL, '1', '2017-02-01 16:25:00', NULL, '1'),
(4, 1, 'Licenciatura en Mercadotecnia', 'Licenciatura en Mercadotecnia', 'licenciatura_en_mercadotecnia', 1, NULL, '1', '2017-02-01 16:25:00', NULL, '1'),
(5, 1, 'Licenciatura en Turismo', 'Licenciatura en Turismo', 'licenciatura_en_turismo', 1, NULL, '1', '2017-02-01 16:25:00', NULL, '1'),
(6, 1, 'Licenciatura en Administracion de Empresas', 'Licenciatura en Administracion de Empresas', 'licenciatura_en_administracion_de_empresas', 1, NULL, '1', '2017-02-01 16:25:00', NULL, '1'),
(7, 1, 'Ingenieria en Software', 'Ingenieria en Software', 'ingenieria_en_software', 1, NULL, '1', '2017-02-01 16:25:00', NULL, '1'),
(8, 1, 'Ingenieria en Telecomunicaciones', 'Ingenieria en Telecomunicaciones', 'ingenieria_en_telecomunicaciones', 1, NULL, '1', '2017-02-01 16:25:00', NULL, '1'),
(9, 1, 'Licenciatura en Contabilidad y Auditoria', 'Licenciatura en Contabilidad y Auditoria', 'licenciatura_en_contabilidad_y_auditoria', 1, NULL, '1', '2017-02-01 16:25:00', NULL, '1'),
(10, 1, 'Ingenieria en Tecnologias de La Información', 'Ingenieria en Tecnologias de La Información', 'Ingenieria_en_tecnologias_de_la_información', 1, NULL, '1', '2017-02-01 16:25:00', NULL, '1'),
(11, 1, 'Ingenieria en Logística y Transporte', 'Ingenieria en Logística y Transporte', 'ingenieria_en_logística_y_transporte', 1, NULL, '1', '2017-02-01 16:25:00', NULL, '1'),
(12, 1, 'Licenciatura en Comunicación', 'Licenciatura en Comunicación', 'licenciatura_en_comunicación', 1, NULL, '1', '2017-02-01 16:25:00', NULL, '1'),
(13, 1, 'Licenciatura en Gestión y Talento Humano', 'Licenciatura en Gestión y Talento Humano', 'licenciatura_en_gestión_y_talento_humano', 1, NULL, '1', '2017-02-01 16:25:00', NULL, '1'),
(14, 1, 'Licenciatura en Administración Portuaria y Aduanera', 'Licenciatura en Administración Portuaria y Aduanera', 'licenciatura_en_administración_portuaria_y_aduanera', 1, NULL, '1', '2017-02-01 16:25:00', NULL, '1'),
(15, 2, 'Administración de Empresas', 'Administración de Empresas', 'administración_de_empresas', 1, NULL, '1', '2017-02-01 16:25:00', NULL, '1'),
(16, 2, 'Finanzas', 'Finanzas', 'finanzas', 1, NULL, '1', '2017-02-01 16:25:00', NULL, '1'),
(17, 2, 'Marketing', 'Marketing', 'marketing', 1, NULL, '1', '2017-02-01 16:25:00', NULL, '1'),
(18, 2, 'Sistema de Información Gerencial', 'Sistema de Información Gerencial', 'sistema_de_información_gerencial', 1, NULL, '1', '2017-02-01 16:25:00', NULL, '1'),
(19, 2, 'Turismo', 'Turismo', 'turismo', 1, NULL, '1', '2017-02-01 16:25:00', NULL, '1'),
(20, 2, 'Talento Humano', 'Talento Humano', 'talento_humano', 1, NULL, '1', '2017-02-01 16:25:00', NULL, '1'),
(21, 2, 'Empresas Familiares', 'Empresas Familiares', 'empresas_familiares', 1, NULL, '1', '2017-02-01 16:25:00', NULL, '1'),
(22, 2, 'Investigación', 'Investigación', 'investigación', 1, NULL, '1', '2017-02-01 16:25:00', NULL, '1');



-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `modalidad_estudio_unidad`
--
INSERT INTO `modalidad_estudio_unidad` (`meun_id`, `uaca_id`, `mod_id`, `eaca_id`, `emp_id`, `meun_usuario_ingreso`, `meun_usuario_modifica`, `meun_estado`, `meun_fecha_creacion`, `meun_fecha_modificacion`, `meun_estado_logico`) VALUES
(1, 1, 1, 1, 1, 1, NULL, '1', '2017-02-01 18:10:00', NULL, '1'),
(2, 1, 1, 2, 1, 1, NULL, '1', '2017-02-01 18:10:00', NULL, '1'),
(3, 1, 1, 3, 1, 1, NULL, '1', '2017-02-01 18:10:00', NULL, '1'),
(4, 1, 1, 4, 1, 1, NULL, '1', '2017-02-01 18:10:00', NULL, '1'),
(5, 1, 1, 5, 1, 1, NULL, '1', '2017-02-01 18:10:00', NULL, '1'),
(6, 1, 1, 6, 1, 1, NULL, '1', '2017-02-01 18:10:00', NULL, '1'),
(7, 1, 2, 11, 1, 1, NULL, '1', '2017-02-01 18:10:00', NULL, '1'),
(8, 1, 2, 8, 1, 1, NULL, '1', '2017-02-01 18:10:00', NULL, '1'),
(9, 1, 2, 7, 1, 1, NULL, '1', '2017-02-01 18:10:00', NULL, '1'),
(10, 1, 2, 10, 1, 1, NULL, '1', '2017-02-01 18:10:00', NULL, '1'),
(11, 1, 2, 1, 1, 1, NULL, '1', '2017-02-01 18:10:00', NULL, '1'),
(12, 1, 2, 5, 1, 1, NULL, '1', '2017-02-01 18:10:00', NULL, '1'),
(13, 1, 2, 3, 1, 1, NULL, '1', '2017-02-01 18:10:00', NULL, '1'),
(14, 1, 2, 9, 1, 1, NULL, '1', '2017-02-01 18:10:00', NULL, '1'),
(15, 1, 2, 13, 1, 1, NULL, '1', '2017-02-01 18:10:00', NULL, '1'),
(16, 1, 2, 6, 1, 1, NULL, '1', '2017-02-01 18:10:00', NULL, '1'),
(17, 1, 2, 4, 1, 1, NULL, '1', '2017-02-01 18:10:00', NULL, '1'),
(18, 1, 2, 14, 1, 1, NULL, '1', '2017-02-01 18:10:00', NULL, '1'),
(19, 1, 2, 2, 1, 1, NULL, '1', '2017-02-01 18:10:00', NULL, '1'),
(20, 1, 3, 12, 1, 1, NULL, '1', '2017-02-01 18:10:00', NULL, '1'),
(21, 1, 4, 1, 1, 1, NULL, '1', '2017-02-01 18:10:00', NULL, '1'),
(22, 1, 4, 3, 1, 1, NULL, '1', '2017-02-01 18:10:00', NULL, '1'),
(23, 1, 4, 9, 1, 1, NULL, '1', '2017-02-01 18:10:00', NULL, '1'),
(24, 1, 4, 13, 1, 1, NULL, '1', '2017-02-01 18:10:00', NULL, '1'),
(25, 1, 4, 6, 1, 1, NULL, '1', '2017-02-01 18:10:00', NULL, '1'),
(26, 1, 4, 4, 1, 1, NULL, '1', '2017-02-01 18:10:00', NULL, '1'),
(27, 2, 3, 15, 1, 1, NULL, '1', '2017-02-01 18:10:00', NULL, '1'),
(28, 2, 3, 16, 1, 1, NULL, '1', '2017-02-01 18:10:00', NULL, '1'),
(29, 2, 3, 17, 1, 1, NULL, '1', '2017-02-01 18:10:00', NULL, '1'),
(30, 2, 3, 18, 1, 1, NULL, '1', '2017-02-01 18:10:00', NULL, '1'),
(31, 2, 3, 19, 1, 1, NULL, '1', '2017-02-01 18:10:00', NULL, '1'),
(32, 2, 3, 20, 1, 1, NULL, '1', '2017-02-01 18:10:00', NULL, '1'),
(33, 2, 3, 21, 1, 1, NULL, '1', '2017-02-01 18:10:00', NULL, '1'),
(34, 2, 2, 22, 1, 1, NULL, '1', '2017-02-01 18:10:00', NULL, '1');



-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `modulo_estudio`
--
INSERT INTO `modulo_estudio` (`mest_id`, `uaca_id`, `mod_id`, `mest_codigo`, `mest_nombre`, `mest_descripcion`, `mest_alias`, `mest_usuario_ingreso`, `mest_usuario_modifica`, `mest_estado`, `mest_fecha_creacion`, `mest_fecha_modificacion`, `mest_estado_logico`) VALUES
(1, 3, 2, 'SM1-EMVE01', 'Emprendimiento y Ventas', 'Emprendimiento y Ventas', 'emprendimiento_y_ventas', 1, NULL, '1', '2017-02-01 03:43:48', NULL, '1'),
(2, 3, 2, 'SM2-EXAV01', 'Excel Avanzado', 'Excel Avanzado', 'excel_Avanzado', 1, NULL, '1', '2017-02-01 03:43:48', NULL, '1'),
(3, 3, 2, 'SM3-FOTO01', 'Fotografía', 'Fotografía', 'fotografia', 1, NULL, '1', '2017-02-01 03:43:48', NULL, '1'),
(4, 3, 2, 'SM4-EVPL01', 'Event Planner', 'Event Planner', 'event_planner', 1, NULL, '1', '2017-02-01 03:43:48', NULL, '1'),
(5, 3, 2, 'SM5-PGET01', 'Programa Gerencia Estratégica del TH (4 módulos)', 'Programa Gerencia Estratégica del TH (4 módulos)', 'programa_gerencia_estratégica_del_th_(4_módulos)', 1, NULL, '1', '2017-02-01 03:43:48', NULL, '1'),
(6, 3, 2, 'SM6-PEDA01', 'Pedagogía', 'Pedagogía', 'pedagogia', 1, NULL, '1', '2017-02-01 03:43:48', NULL, '1'),
(7, 3, 2, 'SM7-RECI01', 'Programa para docentes:  Redacción Científica', 'Programa para docentes:  Redacción Científica', 'programa_para_docentes:_redacción_científica', 1, NULL, '1', '2017-02-01 03:43:48', NULL, '1'),
(8, 3, 2, 'SM8-DHCR01', 'Desarrollo Habilidades Comerciales para Retail', 'Desarrollo Habilidades Comerciales para Retail', 'desarrollo_habilidades_comerciales_para_retail', 1, NULL, '1', '2017-02-01 03:43:48', NULL, '1'),
(9, 3, 1, 'SM9-CUON01', 'Cursos Online', 'Cursos Online', 'cursos_online', 1, NULL, '1', '2017-02-01 03:43:48', NULL, '1'),
(10, 4, 2, 'SM10-IDIF01', 'Idioma Inglés, Francés', 'Idioma Inglés, Francés', 'idioma_inglés,_francés', 1, NULL, '1', '2017-02-01 03:43:48', NULL, '1'),
(11, 3, 2, 'SM11-PTHA01', 'Programa de Talento Humano: Actualidad Laboral', 'Programa de Talento Humano: Actualidad Laboral', 'programa_de_talento_humano:_actualidad_laboral', 1, NULL, '1', '2017-02-01 15:15:00', NULL, '1'),
(12, 3, 2, 'SM12-ESDI01', 'Programa de habilidades Gerenciales: Estrategias directivas', 'Programa de habilidades Gerenciales: Estrategias directivas', 'programa_de_habilidades_gerenciales:_estrategias_directivas', 1, NULL, '1', '2017-02-01 15:15:00', NULL, '1'),
(13, 3, 2, 'SM13-IFIN01', 'Illustrator y fotoshop: intermedio', 'Illustrator y fotoshop: intermedio', 'illustrator_y_fotoshop:_intermedio', 1, NULL, '1', '2017-02-01 15:15:00', NULL, '1'),
(14, 3, 2, 'SM14-TNCV01', 'Técnicas de negociación y cierre de ventas', 'Técnicas de negociación y cierre de ventas', 'técnicas_de_negociación_y_cierre_de_ventas', 1, NULL, '1', '2017-02-01 15:15:00', NULL, '1'),
(15, 3, 2, 'SM15-NEMA01', 'Neuromarketing', 'Neuromarketing', 'neuromarketing', 1, NULL, '1', '2017-02-01 15:15:00', NULL, '1'),
(16, 3, 2, 'SM16-DCYC01', 'Programa de Talento Humano: Descripción de cargos y selección por competencias (módulo 2)', 'Programa de Talento Humano: Descripción de cargos y selección por competencias (módulo 2)', 'programa_de_talento_humano:_descripción_de_cargos_y_selección_por_competencias_(módulo_2)', 1, NULL, '1', '2017-02-01 15:15:00', NULL, '1'),
(17, 3, 2, 'SM17-MCDI01', 'Técnicas de ventas:  Manejo de clientes difíciles', 'Técnicas de ventas: Manejo de clientes difíciles', 'técnicas_de_ventas:_manejo_de_clientes_difíciles', 1, NULL, '1', '2017-02-01 15:15:00', NULL, '1'),
(18, 3, 2, 'SM18-NEEF01', 'Programa de habilidades Gerenciales: Negociación efectiva', 'Programa de habilidades Gerenciales: Negociación efectiva', 'programa_de_habilidades_gerenciales:_negociación_efectiva', 1, NULL, '1', '2017-02-01 15:15:00', NULL, '1'),
(19, 3, 2, 'SM19-PYDI01', 'Dirección en Finanzas: Presupuesto y diferenciación de ingresos', 'Dirección en Finanzas: Presupuesto y diferenciación de ingresos', 'dirección_en_finanzas:_presupuesto_y_diferenciación_de_ingresos', 1, NULL, '1', '2017-02-01 15:15:00', NULL, '1'),
(20, 3, 2, 'SM20-VAEM01', 'Valoración aduanera para empresarios', 'Valoración aduanera para empresarios', 'valoración_aduanera_para_empresarios', 1, NULL, '1', '2017-02-01 15:15:00', NULL, '1'),
(21, 3, 2, 'SM21-CUSE01', 'Curso de seguros', 'Curso de seguros', 'curso_de_seguros', 1, NULL, '1', '2017-02-01 15:15:00', NULL, '1'),
(22, 3, 2, 'SM22-PETH01', 'Programa de Talento Humano:  Plan estratégico del Talento Humano (módulo 3)', 'Programa de Talento Humano: Plan estratégico del Talento Humano (módulo 3)', 'programa_de_talento_humano:_plan_estratégico_del_talento_humano_(módulo_3)', 1, NULL, '1', '2017-02-01 15:15:00', NULL, '1'),
(23, 3, 2, 'SM23-TLMC01', 'Taller de liderazgo y manejo de conflictos', 'Taller de liderazgo y manejo de conflictos', 'taller_de_liderazgo_y_manejo_de_conflictos', 1, NULL, '1', '2017-02-01 15:15:00', NULL, '1'),
(24, 3, 2, 'SM24-HAPE01', 'Programa para docentes: Habilidades pedagógicas', 'Programa para docentes: Habilidades pedagógicas', 'programa_para_docentes:_habilidades _pedagógicas', 1, NULL, '1', '2017-02-01 15:15:00', NULL, '1'),
(25, 3, 2, 'SM25-PPTH01', 'Promoción programa talento humano', 'Promoción programa talento humano', 'promoción_programa_talento_humano', 1, NULL, '1', '2017-02-01 15:15:00', NULL, '1'),
(26, 3, 2, 'SM26-PPPD01', 'Promoción programa para docentes', 'Promoción programa para docentes', 'oromoción_programa para_docentes', 1, NULL, '1', '2017-02-01 15:15:00', NULL, '1'),
(27, 5, 1, 'UL1', 'Diplomado gestión del talento humano basado en competencias', 'Diplomado gestión del talento humano basado en competencias', 'diplomado_gestión_del_talento_humano_basado_en_competencias', 1, NULL, '1', '2017-02-01 03:43:48', NULL, '1'),
(28, 5, 1, 'UL2', 'Diplomado en Alta Gerencia y Control de Gestión', 'Diplomado en Alta Gerencia y Control de Gestión', 'diplomado_en_alta_gerencia_y_control_de_gestión', 1, NULL, '1', '2017-02-01 03:43:48', NULL, '1'),
(29, 5, 1, 'UL3', 'Diplomado en Culture Management: nuevas formas de hacer negocio', 'Diplomado en Culture Management: nuevas formas de hacer negocio', 'diplomado_en_culture_management:_nuevas_formas_de_hacer_negocio', 1, NULL, '1', '2017-02-01 03:43:48', NULL, '1'),
(30, 5, 1, 'UL4', 'Diplomado en turismo inteligente y competitividad internacional', 'Diplomado en turismo inteligente y competitividad internacional', 'diplomado_en_turismo_inteligente_y_competitividad_internacional', 1, NULL, '1', '2017-02-01 03:43:48', NULL, '1'),
(31, 3, 1, 'UL5', 'Habilidades de comunicación para emprendedores', 'Habilidades de comunicación para emprendedores', 'habilidades_de_comunicación_para_emprendedores', 1, NULL, '1', '2017-02-01 03:43:48', NULL, '1'),
(32, 3, 1, 'UL6', 'La Política de Personal: factor clave en la competitividad de las organizaciones', 'La Política de Personal: factor clave en la competitividad de las organizaciones', 'la_política_de_personal:_factor_clave_en_la_competitividad_de_las_organizaciones', 1, NULL, '1', '2017-02-01 03:43:48', NULL, '1'),
(33, 3, 1, 'UL7', 'Los modelos de Competencia para la gestión efectiva del Talento Humano', 'Los modelos de Competencia para la gestión efectiva del Talento Humano', 'los_modelos_de_competencia_para_la_gestión_efectiva_del_talento_humano', 1, NULL, '1', '2017-02-01 03:43:48', NULL, '1'),
(34, 3, 1, 'UL8', 'Como aumentar la competitividad de la organización mediante la Elección del Personal', 'Como aumentar la competitividad de la organización mediante la Elección del Personal', 'como_aumentar_la_competitividad_de_la_organización_mediante_la_elección_del_personal', 1, NULL, '1', '2017-02-01 03:43:48', NULL, '1'),
(35, 3, 1, 'UL9', 'La Innovación Tecnológica en la gestión del Talento Humano', 'La Innovación Tecnológica en la gestión del Talento Humano', 'la_innovación_tecnológica_en_la_gestión_del_talento_humano', 1, NULL, '1', '2017-02-01 03:43:48', NULL, '1'),
(36, 3, 1, 'UL10', 'El uso de entornos virtuales en la formación y desarrollo del Talento Humano', 'El uso de entornos virtuales en la formación y desarrollo del Talento Humano', 'el_uso_de_entornos_virtuales_en_la_formación_y_desarrollo_del_talento_humano', 1, NULL, '1', '2017-02-01 03:43:48', NULL, '1'),
(37, 3, 1, 'UL11', 'Desarrollo de competencia enfocado a jóvenes líderes', 'Desarrollo de competencia enfocado a jóvenes líderes', 'desarrollo_de_competencia_enfocado_a_jóvenes_líderes', 1, NULL, '1', '2017-02-01 15:15:00', NULL, '1'),
(38, 3, 1, 'UL12', 'La Ética y la Responsabilidad Social Empresarial:  factores claves para el Gobierno Corporativo', 'La Ética y la Responsabilidad Social Empresarial:  factores claves para el Gobierno Corporativo', 'la_etica_y_la_responsabilidad_social_empresarial:_factores_claves_para_el_gobierno_corporativo', 1, NULL, '1', '2017-02-01 15:15:00', NULL, '1'),
(39, 3, 1, 'UL13', 'Contabilidad para la toma de decisiones gerenciales', 'Contabilidad para la toma de decisiones gerenciales', 'contabilidad_para_la toma_de_decisiones_gerenciales', 1, NULL, '1', '2017-02-01 15:15:00', NULL, '1'),
(40, 3, 1, 'UL14', 'Análisis Financiero y Sistemas de Control para las organizaciones', 'Análisis Financiero y Sistemas de Control para las organizaciones', 'análisis_financiero_y_sistemas_de_control_para_las organizaciones', 1, NULL, '1', '2017-02-01 15:15:00', NULL, '1'),
(41, 3, 1, 'UL15', 'La Valoración en los negocios y su importancia en la toma de decisiones', 'La Valoración en los negocios y su importancia en la toma de decisiones', 'la_valoración_en_los_negocios_y_su_importancia_en_la_toma_de_decisiones', 1, NULL, '1', '2017-02-01 15:15:00', NULL, '1'),
(42, 3, 1, 'UL16', 'Emprendimiento global', 'Emprendimiento global', 'emprendimiento_global', 1, NULL, '1', '2017-02-01 15:15:00', NULL, '1'),
(43, 3, 1, 'UL17', 'El uso de la Inteligencia de Mercado como factor clave de competitividad', 'El uso de la Inteligencia de Mercado como factor clave de competitividad', 'el_uso_de_la_inteligencia_de_mercado_como_factor_clave_de_competitividad', 1, NULL, '1', '2017-02-01 15:15:00', NULL, '1'),
(44, 3, 1, 'UL18', 'La Globalización y la Integración Económica', 'La Globalización y la Integración Económica', 'la_globalización_y_la_integración_económica', 1, NULL, '1', '2017-02-01 15:15:00', NULL, '1'),
(45, 3, 1, 'UL19', 'La visión multicultural como factor de éxito en los negocios internacionales', 'La visión multicultural como factor de éxito en los negocios internacionales', 'la_visión_multicultural_como_factor_de_éxito_en_los_negocios_internacionales', 1, NULL, '1', '2017-02-01 15:15:00', NULL, '1'),
(46, 3, 1, 'UL20', 'Estrategias de Marketing para un entorno globalizado', 'Estrategias de Marketing para un entorno globalizado', 'estrategias_de_marketing_para_un_entorno_globalizado', 1, NULL, '1', '2017-02-01 15:15:00', NULL, '1'),
(47, 3, 1, 'UL21', 'Estrategias de Exportanción para el éxito en un entorno globalizado', 'Estrategias de Exportanción para el éxito en un entorno globalizado', 'estrategias_de_exportanción_para_el_éxito_en_un_entorno_globalizado', 1, NULL, '1', '2017-02-01 15:15:00', NULL, '1'),
(48, 3, 1, 'UL22', 'El uso de la información: factor clave en un entorno global', 'El uso de la información: factor clave en un entorno global', 'el_uso_de_la_información:_factor_clave_en_un_entorno_global', 1, NULL, '1', '2017-02-01 15:15:00', NULL, '1'),
(49, 3, 1, 'UL23', 'Estrategias de Finanzas para el éxito en los negocios internacionales', 'Estrategias de Finanzas para el éxito en los negocios internacionales', 'estrategias_de_finanzas_para_el_éxito_en_los_negocios_internacionales', 1, NULL, '1', '2017-02-01 15:15:00', NULL, '1'),
(50, 3, 1, 'UL24', 'Turismo inteligente y sostenible para el desarrollo', 'Turismo inteligente y sostenible para el desarrollo', 'turismo_inteligente_y_sostenible_para_el_desarrollo', 1, NULL, '1', '2017-02-01 15:15:00', NULL, '1'),
(51, 3, 1, 'UL25', 'Planificación y gestión de Destinos Turísticos Inteligentes', 'Planificación y gestión de Destinos Turísticos Inteligentes', 'planificación_y_gestión_de_destinos_turísticos_inteligentes', 1, NULL, '1', '2017-02-01 15:15:00', NULL, '1'),
(52, 3, 1, 'UL26', 'La innovación y calidad en la sostenibilidad de las empresas turísticas', 'La innovación y calidad en la sostenibilidad de las empresas turísticas', 'la_innovación_y_calidad_en_la_sostenibilidad_de_las_empresas_turísticas', 1, NULL, '1', '2017-02-01 15:15:00', NULL, '1'),
(53, 3, 1, 'UL27', 'Herramientas de información y comunicación para Productos Turísticos', 'Herramientas de información y comunicación para Productos Turísticos', 'herramientas_de_información_y_comunicación_para_productos_turísticos', 1, NULL, '1', '2017-02-01 15:15:00', NULL, '1'),
(54, 3, 1, 'UL28', 'La Minería de Datos como herramienta de desarrollo en el Turismo', 'La Minería de Datos como herramienta de desarrollo en el Turismo', 'la_minería_de_datos_como_herramienta_de_desarrollo_en_el_turismo', 1, NULL, '1', '2017-02-01 15:15:00', NULL, '1'),
(55, 3, 1, 'UL29', 'Estrategias de Marketing Digital para empresas turísticas', 'Estrategias de Marketing Digital para empresas turísticas', 'estrategias_de_marketing_digital_para_empresas_turísticas', 1, NULL, '1', '2017-02-01 15:15:00', NULL, '1'),
(56, 3, 1, 'UL30', 'Web Building', 'Web Building', 'web_building', 1, NULL, '1', '2017-02-01 15:15:00', NULL, '1'),
(57, 3, 1, 'UL31', 'Tu negocio en Google', 'Tu negocio en Google', 'tu_negocio_en_google', 1, NULL, '1', '2017-02-01 15:15:00', NULL, '1'),
(58, 3, 1, 'UL32', 'Cómo utilizar Goolge Business', 'Cómo utilizar Goolge Business', 'cómo_utilizar_goolge_business', 1, NULL, '1', '2017-02-01 15:15:00', NULL, '1'),
(59, 3, 1, 'UL33', 'No más SPAM… Estrategias para entrega efectivas de email', 'No más SPAM… Estrategias para entrega efectivas de email', 'no_más_spam…_estrategias_para_entrega_efectivas_de_email', 1, NULL, '1', '2017-02-01 15:15:00', NULL, '1'),
(60, 3, 1, 'UL34', 'Community Manager', 'Community Manager', 'community_manager', 1, NULL, '1', '2017-02-01 15:15:00', NULL, '1'),
(61, 3, 1, 'UL35', 'Facebook Ads: domina el Marketing en Facebook', 'Facebook Ads: domina el Marketing en Facebook', 'facebook_ads:_domina_el_marketing_en_facebook', 1, NULL, '1', '2017-02-01 15:15:00', NULL, '1'),
(62, 3, 1, 'UL36', 'Redacción y ortografía para ejecutivos', 'Redacción y ortografía para ejecutivos', 'redacción_y_ortografía_para_ejecutivos', 1, NULL, '1', '2017-02-01 15:15:00', NULL, '1'),
(63, 3, 1, 'UL37', 'Manejo de clientes dificiles', 'Manejo de clientes dificiles', 'manejo_de_clientes_dificiles', 1, NULL, '1', '2017-02-01 15:15:00', NULL, '1'),
(64, 3, 1, 'UL38', 'Matemáticas para todos', 'Matemáticas para todos', 'matemáticas_para_todos', 1, NULL, '1', '2017-02-01 15:15:00', NULL, '1'),
(65, 3, 1, 'UL39', 'Contabilidad para todos', 'Contabilidad para todos', 'contabilidad_para_todos', 1, NULL, '1', '2017-02-01 15:15:00', NULL, '1'),
(66, 3, 1, 'UL40', 'Excel para principiantes', 'Excel para principiantes', 'excel_para_principiantes', 1, NULL, '1', '2017-02-01 15:15:00', NULL, '1'),
(67, 3, 1, 'UL41', 'Excel Intermedio', 'Excel Intermedio', 'excel_intermedio', 1, NULL, '1', '2017-02-01 15:15:00', NULL, '1'),
(68, 3, 1, 'UL42', 'Excel Avanzado', 'Excel Avanzado', 'excel_avanzado',1, NULL, '1', '2017-02-01 15:15:00', NULL, '1'),
(69, 3, 1, 'UL43', 'Como aprovechar las tablas dinámicas de Excel', 'Como aprovechar las tablas dinámicas de Excel', 'como_aprovechar_las_tablas_dinámicas_de_excel', 1, NULL, '1', '2017-02-01 15:15:00', NULL, '1'),
(70, 3, 1, 'UL44', 'Estrategias de Marketing efectivas para Emprendedores', 'Estrategias de Marketing efectivas para Emprendedores', 'estrategias_de_marketing_efectivas_para_emprendedores', 1, NULL, '1', '2017-02-01 15:15:00', NULL, '1'),
(71, 3, 1, 'UL45', 'Integración mundial: nuevas tendencias en tratados comerciales', 'Integración mundial: nuevas tendencias en tratados comerciales', 'integración_mundial:_nuevas_tendencias_en_tratados_comerciales', 1, NULL, '1', '2017-02-01 15:15:00', NULL, '1'),
(72, 3, 1, 'UL46', 'Herramientas TICs para desarrollo de recursos Online', 'Herramientas TICs para desarrollo de recursos Online', 'herramientas_tics_para_desarrollo_de_recursos_online', 1, NULL, '1', '2017-02-01 15:15:00', NULL, '1'),
(73, 3, 1, 'UL47', 'Economía para Emprendedores', 'Economía para Emprendedores', 'economía_para_emprendedores', 1, NULL, '1', '2017-02-01 15:15:00', NULL, '1'),
(74, 3, 1, 'UL48', 'Motívate - Auto Motivación', 'Motívate - Auto Motivación', 'motívate_-_auto_motivación', 1, NULL, '1', '2017-02-01 15:15:00', NULL, '1'),
(75, 3, 1, 'UL49', 'Realización de videos con tu Smartphone', 'Realización de videos con tu Smartphone', 'realización_de_videos_con_tu_smartphone', 1, NULL, '1', '2017-02-01 15:15:00', NULL, '1'),
(76, 3, 1, 'UL50', 'Correcta aplicación de las herramientas de control para la toma de decisiones', 'Correcta aplicación de las herramientas de control para la toma de decisiones', 'correcta_aplicación_de_las_herramientas_de_control_para_la_toma_de_decisiones', 1, NULL, '1', '2017-02-01 15:15:00', NULL, '1'),
(77, 1, 1, 'UL51', 'Licenciatura en Comercio Exterior (UTEG Online)', 'Licenciatura en Comercio Exterior (UTEG Online)', 'licenciatura_en_comercio_exterior_(uteg_online)', 1, NULL, '1', '2017-02-01 15:15:00', NULL, '1'),
(78, 1, 1, 'UL52', 'Licenciatura en Mercadotecnia (UTEG Online)', 'Licenciatura en Mercadotecnia (UTEG Online)', 'licenciatura_en_mercadotecnia_(uteg_online)', 1, NULL, '1', '2017-02-01 15:15:00', NULL, '1'),
(79, 1, 1, 'UL53', 'Licenciatura en Finanzas (UTEG Online)', 'Licenciatura en Finanzas (UTEG Online)', 'licenciatura_en_finanzas_(uteg_online)', 1, NULL, '1', '2017-02-01 15:15:00', NULL, '1'),
(80, 1, 1, 'UL54', 'Licenciatura en Administración de Empresas (UTEG Online) ', 'Licenciatura en Administración de Empresas (UTEG Online) ', 'licenciatura_en_administración_de_empresas_(uteg_Online) ',1, NULL, '1', '2017-02-01 15:15:00', NULL, '1'),
(81, 1, 1, 'UL55', 'Licenciatura en Turismo', 'Licenciatura en Turismo', 'licenciatura_en_turismo', 1, NULL, '1', '2017-02-01 15:15:00', NULL, '1'),
(82, 1, 1, 'UL56', 'Economía', 'Economía', 'economía', 1, NULL, '1', '2017-02-01 15:15:00', NULL, '1'),
(83, 2, 1, 'UL57', 'MBA Bordeaux', 'MBA Bordeaux', 'mba_bordeaux', 1, NULL, '1', '2017-02-01 15:15:00', NULL, '1');



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
INSERT INTO `modulo_estudio_empresa` (`meem_id`, `mest_id`, `emp_id`, `meem_fecha_inicio`, `meem_fecha_fin`, `meem_usuario_ingreso`, `meem_usuario_modifica`, `meem_estado_gestion`, `meem_estado`, `meem_fecha_creacion`, `meem_fecha_modificacion`, `meem_estado_logico`) VALUES
(1, 1, 3, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-09-01 23:30:00', NULL, '1'),
(2, 2, 3, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-09-01 23:30:00', NULL, '1'),
(3, 3, 3, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-09-01 23:30:00', NULL, '1'),
(4, 4, 3, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-09-01 23:30:00', NULL, '1'),
(5, 5, 3, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-09-01 23:30:00', NULL, '1'),
(6, 6, 3, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-09-01 23:30:00', NULL, '1'),
(7, 7, 3, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-09-01 23:30:00', NULL, '1'),
(8, 8, 3, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-09-01 23:30:00', NULL, '1'),
(9, 9, 3, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-09-01 23:30:00', NULL, '1'),
(10, 10, 3, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-09-01 23:30:00', NULL, '1'),
(11, 11, 3, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-09-01 23:30:00', NULL, '1'),
(12, 12, 3, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-09-01 23:30:00', NULL, '1'),
(13, 13, 3, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-09-01 23:30:00', NULL, '1'),
(14, 14, 3, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-09-01 23:30:00', NULL, '1'),
(15, 15, 3, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-09-01 23:30:00', NULL, '1'),
(16, 16, 3, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-09-01 23:30:00', NULL, '1'),
(17, 17, 3, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-09-01 23:30:00', NULL, '1'),
(18, 18, 3, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-09-01 23:30:00', NULL, '1'),
(19, 19, 3, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-09-01 23:30:00', NULL, '1'),
(20, 20, 3, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-09-01 23:30:00', NULL, '1'),
(21, 21, 3, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-09-01 23:30:00', NULL, '1'),
(22, 22, 3, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-09-01 23:30:00', NULL, '1'),
(23, 23, 3, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-09-01 23:30:00', NULL, '1'),
(24, 24, 3, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-09-01 23:30:00', NULL, '1'),
(25, 25, 3, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-09-01 23:30:00', NULL, '1'),
(26, 26, 3, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-09-01 23:30:00', NULL, '1'),

(27, 27, 2, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-09-01 23:30:00', NULL, '1'),
(28, 28, 2, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-09-01 23:30:00', NULL, '1'),
(29, 29, 2, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-09-01 23:30:00', NULL, '1'),
(30, 30, 2, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-09-01 23:30:00', NULL, '1'),
(31, 31, 2, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-09-01 23:30:00', NULL, '1'),
(32, 32, 2, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-09-01 23:30:00', NULL, '1'),
(33, 33, 2, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-09-01 23:30:00', NULL, '1'),
(34, 34, 2, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-09-01 23:30:00', NULL, '1'),
(35, 35, 2, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-09-01 23:30:00', NULL, '1'),
(36, 36, 2, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-09-01 23:30:00', NULL, '1'),
(37, 37, 2, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-09-01 23:30:00', NULL, '1'),
(38, 38, 2, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-09-01 23:30:00', NULL, '1'),
(39, 39, 2, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-09-01 23:30:00', NULL, '1'),
(40, 40, 2, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-09-01 23:30:00', NULL, '1'),
(41, 41, 2, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-09-01 23:30:00', NULL, '1'),
(42, 42, 2, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-09-01 23:30:00', NULL, '1'),
(43, 43, 2, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-09-01 23:30:00', NULL, '1'),
(44, 44, 2, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-09-01 23:30:00', NULL, '1'),
(45, 45, 2, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-09-01 23:30:00', NULL, '1'),
(46, 46, 2, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-09-01 23:30:00', NULL, '1'),
(47, 47, 2, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-09-01 23:30:00', NULL, '1'),
(48, 48, 2, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-09-01 23:30:00', NULL, '1'),
(49, 49, 2, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-09-01 23:30:00', NULL, '1'),
(50, 50, 2, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-09-01 23:30:00', NULL, '1'),
(51, 51, 2, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-09-01 23:30:00', NULL, '1'),
(52, 52, 2, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-09-01 23:30:00', NULL, '1'),
(53, 53, 2, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-09-01 23:30:00', NULL, '1'),
(54, 54, 2, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-09-01 23:30:00', NULL, '1'),
(55, 55, 2, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-09-01 23:30:00', NULL, '1'),
(56, 56, 2, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-09-01 23:30:00', NULL, '1'),
(57, 57, 2, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-09-01 23:30:00', NULL, '1'),
(58, 58, 2, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-09-01 23:30:00', NULL, '1'),
(59, 59, 2, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-09-01 23:30:00', NULL, '1'),
(60, 60, 2, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-09-01 23:30:00', NULL, '1'),
(61, 61, 2, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-09-01 23:30:00', NULL, '1'),
(62, 62, 2, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-09-01 23:30:00', NULL, '1'),
(63, 63, 2, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-09-01 23:30:00', NULL, '1'),
(64, 64, 2, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-09-01 23:30:00', NULL, '1'),
(65, 65, 2, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-09-01 23:30:00', NULL, '1'),
(66, 66, 2, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-09-01 23:30:00', NULL, '1'),
(67, 67, 2, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-09-01 23:30:00', NULL, '1'),
(68, 68, 2, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-09-01 23:30:00', NULL, '1'),
(69, 69, 2, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-09-01 23:30:00', NULL, '1'),
(70, 70, 2, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-09-01 23:30:00', NULL, '1'),
(71, 71, 2, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-09-01 23:30:00', NULL, '1'),
(72, 72, 2, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-09-01 23:30:00', NULL, '1'),
(73, 73, 2, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-09-01 23:30:00', NULL, '1'),
(74, 74, 2, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-09-01 23:30:00', NULL, '1'),
(75, 75, 2, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-09-01 23:30:00', NULL, '1'),
(76, 76, 2, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-09-01 23:30:00', NULL, '1'),
(77, 77, 2, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-09-01 23:30:00', NULL, '1'),
(78, 78, 2, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-09-01 23:30:00', NULL, '1'),
(79, 79, 2, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-09-01 23:30:00', NULL, '1'),
(80, 80, 2, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-09-01 23:30:00', NULL, '1'),
(81, 81, 2, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-09-01 23:30:00', NULL, '1'),
(82, 82, 2, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-09-01 23:30:00', NULL, '1'),
(83, 83, 2, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-09-01 23:30:00', NULL, '1');


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

-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `modalidad_unidad_academico`
--
INSERT INTO `modalidad_unidad_academico` (`muac_id`,`uaca_id`,`mod_id`, `emp_id`,`muac_usuario_ingreso`,`muac_estado`, `muac_fecha_creacion`, `muac_estado_logico`) VALUES
(1,1,1,1,1,'1','2018-09-17 14:35:00','1'),
(2,1,2,1,1,'1','2018-09-17 14:35:00','1'),
(3,1,3,1,1,'1','2018-09-17 14:35:00','1'),
(4,1,4,1,1,'1','2018-09-17 14:35:00','1'),
(5,2,3,1,1,'1','2018-09-17 14:35:00','1'),
(6,3,1,1,1,'0','2017-02-01 14:35:00','0'),
(7,3,2,1,1,'0','2017-02-01 14:35:00','0'),
(8,3,1,3,1,'0','2018-09-29 14:35:00','0'),
(9,3,2,3,1,'1','2018-09-29 14:35:00','1'),
(10,3,1,2,1,'1','2017-02-01 14:35:00','1'),
(11,5,1,2,1,'1','2017-02-01 14:35:00','1'),
(12,1,1,2,1,'1','2017-02-01 14:35:00','1'),
(13,2,1,2,1,'1','2018-10-01 14:35:00','1'),
(14,2,2,1,1,'1','2018-10-19 16:30:00','1');

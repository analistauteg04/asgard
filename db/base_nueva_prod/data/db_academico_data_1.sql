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
(6, 'Curso Nivelación', 'Curso Nivelación', 1, '0', '1', '1'),
(7, 'Micromasters', 'Micromasters', 1, '0', '1', '1'),
(8, 'Ulive', 'Ulive', 1, '0', '1', '1'),
(9, 'Uwork', 'Uwork', 1, '0', '1', '1');

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
(1, 3, 2, 'SM1-EMVE01', 'Emprendimiento y Ventas', 'Emprendimiento y Ventas', 'emprendimiento_y_ventas', 1, NULL, '0', '2017-02-01 03:43:48', NULL, '1'),
(2, 3, 2, 'SM2-EXAV01', 'Excel Avanzado', 'Excel Avanzado', 'excel_Avanzado', 1, NULL, '1', '2017-02-01 03:43:48', NULL, '1'),
(3, 3, 2, 'SM3-FOTO01', 'Fotografía', 'Fotografía', 'fotografia', 1, NULL, '1', '2017-02-01 03:43:48', NULL, '1'),
(4, 3, 2, 'SM4-EVPL01', 'Event Planner', 'Event Planner', 'event_planner', 1, NULL, '1', '2017-02-01 03:43:48', NULL, '1'),
(5, 3, 2, 'SM5-PGET01', 'Programa Gerencia Estratégica del TH (4 módulos)', 'Programa Gerencia Estratégica del TH (4 módulos)', 'programa_gerencia_estratégica_del_th_(4_módulos)', 1, NULL, '0', '2017-02-01 03:43:48', NULL, '1'),
(6, 3, 2, 'SM6-PEDA01', 'Pedagogía', 'Pedagogía', 'pedagogia', 1, NULL, '0', '2017-02-01 03:43:48', NULL, '1'),
(7, 3, 2, 'SM7-RECI01', 'Programa para docentes:  Redacción Científica', 'Programa para docentes:  Redacción Científica', 'programa_para_docentes:_redacción_científica', 1, NULL, '0', '2017-02-01 03:43:48', NULL, '1'),
(8, 3, 2, 'SM8-DHCR01', 'Desarrollo Habilidades Comerciales para Retail', 'Desarrollo Habilidades Comerciales para Retail', 'desarrollo_habilidades_comerciales_para_retail', 1, NULL, '0', '2017-02-01 03:43:48', NULL, '1'),
(9, 3, 1, 'SM9-CUON01', 'Cursos Online', 'Cursos Online', 'cursos_online', 1, NULL, '0', '2017-02-01 03:43:48', NULL, '1'),
(10, 4, 2, 'SM10-IDIF01', 'Idioma Inglés, Francés', 'Idioma Inglés, Francés', 'idioma_inglés,_francés', 1, NULL, '0', '2017-02-01 03:43:48', NULL, '1'),
(11, 3, 2, 'SM11-PTHA01', 'Programa de Talento Humano: Actualidad Laboral', 'Programa de Talento Humano: Actualidad Laboral', 'programa_de_talento_humano:_actualidad_laboral', 1, NULL, '0', '2017-02-01 15:15:00', NULL, '1'),
(12, 3, 2, 'SM12-ESDI01', 'Programa de habilidades Gerenciales: Estrategias directivas', 'Programa de habilidades Gerenciales: Estrategias directivas', 'programa_de_habilidades_gerenciales:_estrategias_directivas', 1, NULL, '0', '2017-02-01 15:15:00', NULL, '1'),
(13, 3, 2, 'SM13-IFIN01', 'Illustrator y fotoshop: intermedio', 'Illustrator y fotoshop: intermedio', 'illustrator_y_fotoshop:_intermedio', 1, NULL, '1', '2017-02-01 15:15:00', NULL, '1'),
(14, 3, 2, 'SM14-TNCV01', 'Técnicas de negociación y cierre de ventas', 'Técnicas de negociación y cierre de ventas', 'técnicas_de_negociación_y_cierre_de_ventas', 1, NULL, '0', '2017-02-01 15:15:00', NULL, '1'),
(15, 3, 2, 'SM15-NEMA01', 'Neuromarketing', 'Neuromarketing', 'neuromarketing', 1, NULL, '0', '2017-02-01 15:15:00', NULL, '1'),
(16, 3, 2, 'SM16-DCYC01', 'Programa de Talento Humano: Descripción de cargos y selección por competencias (módulo 2)', 'Programa de Talento Humano: Descripción de cargos y selección por competencias (módulo 2)', 'programa_de_talento_humano:_descripción_de_cargos_y_selección_por_competencias_(módulo_2)', 1, NULL, '0', '2017-02-01 15:15:00', NULL, '1'),
(17, 3, 2, 'SM17-MCDI01', 'Técnicas de ventas:  Manejo de clientes difíciles', 'Técnicas de ventas: Manejo de clientes difíciles', 'técnicas_de_ventas:_manejo_de_clientes_difíciles', 1, NULL, '0', '2017-02-01 15:15:00', NULL, '1'),
(18, 3, 2, 'SM18-NEEF01', 'Programa de habilidades Gerenciales: Negociación efectiva', 'Programa de habilidades Gerenciales: Negociación efectiva', 'programa_de_habilidades_gerenciales:_negociación_efectiva', 1, NULL, '0', '2017-02-01 15:15:00', NULL, '1'),
(19, 3, 2, 'SM19-PYDI01', 'Dirección en Finanzas: Presupuesto y diferenciación de ingresos', 'Dirección en Finanzas: Presupuesto y diferenciación de ingresos', 'dirección_en_finanzas:_presupuesto_y_diferenciación_de_ingresos', 1, NULL, '0', '2017-02-01 15:15:00', NULL, '1'),
(20, 3, 2, 'SM20-VAEM01', 'Valoración aduanera para empresarios', 'Valoración aduanera para empresarios', 'valoración_aduanera_para_empresarios', 1, NULL, '0', '2017-02-01 15:15:00', NULL, '1'),
(21, 3, 2, 'SM21-CUSE01', 'Curso de seguros', 'Curso de seguros', 'curso_de_seguros', 1, NULL, '0', '2017-02-01 15:15:00', NULL, '1'),
(22, 3, 2, 'SM22-PETH01', 'Programa de Talento Humano:  Plan estratégico del Talento Humano (módulo 3)', 'Programa de Talento Humano: Plan estratégico del Talento Humano (módulo 3)', 'programa_de_talento_humano:_plan_estratégico_del_talento_humano_(módulo_3)', 1, NULL, '0', '2017-02-01 15:15:00', NULL, '1'),
(23, 3, 2, 'SM23-TLMC01', 'Taller de liderazgo y manejo de conflictos', 'Taller de liderazgo y manejo de conflictos', 'taller_de_liderazgo_y_manejo_de_conflictos', 1, NULL, '0', '2017-02-01 15:15:00', NULL, '1'),
(24, 3, 2, 'SM24-HAPE01', 'Programa para docentes: Habilidades pedagógicas', 'Programa para docentes: Habilidades pedagógicas', 'programa_para_docentes:_habilidades _pedagógicas', 1, NULL, '0', '2017-02-01 15:15:00', NULL, '1'),
(25, 3, 2, 'SM25-PPTH01', 'Promoción programa talento humano', 'Promoción programa talento humano', 'promoción_programa_talento_humano', 1, NULL, '0', '2017-02-01 15:15:00', NULL, '1'),
(26, 3, 2, 'SM26-PPPD01', 'Promoción programa para docentes', 'Promoción programa para docentes', 'promoción_programa para_docentes', 1, NULL, '0', '2017-02-01 15:15:00', NULL, '1'),
(27,7,1, 'UL58-AGCG01', 'Alta Gerencia y control de gestión', 'Alta Gerencia y control de gestión', 'alta_gerencia_y_control_de_gestion', 1, NULL, '1', '2018-12-10 12:15:48', NULL, '1'),
(28,7,1, 'UL59-CMNN01', 'Culture Management: nuevas formas de hacer negocios', 'Culture Management: nuevas formas de hacer negocios.', 'culture_management_nuevas_formas_de_hacer_negocios', 1, NULL, '1', '2018-12-10 12:15:48', NULL, '1'),
(29,7,1, 'UL60-TICI01', 'Turismo inteligente y competitividad internacional', 'Turismo inteligente y competitividad internacional', 'turismo_inteligente_y_competitividad_internacional', 1, NULL, '1', '2018-12-10 12:15:48', NULL, '1'),
(30,7,1, 'UL61-GTBCI01', 'Gestión del talento humano basado en competencias', 'Gestión del talento humano basado en competencias', 'gestion_del_talento_humano_basado_en_competencias', 1, NULL, '1', '2018-12-10 12:15:48', NULL, '1'),
(31, 8, 2, 'UL62-EINP01', 'Entorno internacional de los negocios (taller práctico)', 'Entorno internacional de los negocios (taller práctico)', 'entorno_internacional_de_los_negocios_(taller_practico)', 1, NULL, '1', '2018-12-10 12:15:48', NULL, '1'),
(32, 8, 2, 'UL63-CMNN01', 'Planificación de cursos en línea', 'Planificación de cursos en línea', 'planificacion_de_cursos_en_linea', 1, NULL, '1', '2018-12-10 12:15:48', NULL, '1'),
(33, 8, 2, 'UL64-WSIE01', 'Workshop sobre Inteligencia Emocional en el trabajo', 'Workshop sobre Inteligencia Emocional en el trabajo', 'workshop_sobre_inteligencia_emocional_en_el_trabajo', 1, NULL, '1', '2018-12-10 12:15:48', NULL, '1'),
(34, 8, 2, 'UL65-APCC01', 'Análisis de peligros y puntos críticos de control (HACCP)', 'Análisis de peligros y puntos críticos de control (HACCP)', 'analisis_de_peligros_y_puntos_criticos_de_control_(HACCP)', 1, NULL, '1', '2018-12-10 12:15:48', NULL, '1'),

(35, 9, 1, 'UL66-PEPP01', 'Planificación estratégica para PYMES', 'Planificación estratégica para PYMES', 'planificacion_estrategica_para_pymes', 1, NULL, '1', '2018-12-10 12:15:48', NULL, '1'),
(36, 9, 1, 'UL67-MPEP01', 'Marketing para emprendedores', 'Marketing para emprendedores', 'marketing_para_emprendedores', 1, NULL, '1', '2018-12-10 12:15:48', NULL, '1'),
(37, 9, 1, 'UL68-WEBU01', 'Web building', 'Web building', 'web_building', 1, NULL, '1', '2018-12-10 12:15:48', NULL, '1'),
(38, 9, 1, 'UL69-COMA01', 'Community Manager', 'Community Manager', 'community_manager', 1, NULL, '1', '2018-12-10 12:15:48', NULL, '1'),
(39, 9, 1, 'UL70-MEIL01', 'Método Estrella de Inserción laboral de personas con discapacidad', 'Método Estrella de Inserción laboral de personas con discapacidad', 'metodo_estrella_de_insercion_laboral_de_personas_con_discapacidad', 1, NULL, '1', '2018-12-10 12:15:48', NULL, '1'),
(40, 9, 1, 'UL71-EPNE01', 'Economía para no economistas', 'Economía para no economistas', 'economia_para_no_economistas', 1, NULL, '1', '2018-12-10 12:15:48', NULL, '1'),
(41, 9, 1, 'UL72-AGCP01', 'Aplicación de la gestión de calidad en PYMES', 'Aplicación de la gestión de calidad en PYMES', 'aplicacion_de_la_gestion_de_calidad_en_pymes', 1, NULL, '1', '2018-12-10 12:15:48', NULL, '1'),
(42, 9, 1, 'UL73-01', 'Correcta aplicación de las herramientas de control', 'Correcta aplicación de las herramientas de control', 'correcta_aplicacion_de_las_herramientas_de_control', 1, NULL, '1', '2018-12-10 12:15:48', NULL, '1'),
(43, 9, 1, 'UL74-CGVE01', 'Como generar valor a la empresa a través de la responsabilidad social corporativa', 'Como generar valor a la empresa a través de la responsabilidad social corporativa', 'Como generar valor a la empresa a través de la responsabilidad social corporativa', 1, NULL, '1', '2018-12-10 12:15:48', NULL, '1'),
(44, 9, 1, 'UL75-GPTM01', 'Guía práctica para las técnicas de muestreo en la investigación comercial', 'Guía práctica para las técnicas de muestreo en la investigación comercial', 'guia_practica_para_las_tecnicas_de_muestreo_en_la_investigación_comercial', 1, NULL, '1', '2018-12-10 12:15:48', NULL, '1'),
(45, 9, 1, 'UL76-DHPC01', 'Desarrollo de habilidades del pensamiento cognitivo', 'Desarrollo de habilidades del pensamiento cognitivo', 'desarrollo_de_habilidades_del_pensamiento_cognitivo', 1, NULL, '1', '2018-12-10 12:15:48', NULL, '1'),
(46, 9, 1, 'UL77-NAIR01', 'Normas APA para la investigación y redacción de artículos', 'Normas APA para la investigación y redacción de artículos', 'normas_apa_para_la_investigacion_y_redaccion_de_articulos', 1, NULL, '1', '2018-12-10 12:15:48', NULL, '1'),
(47, 9, 1, 'UL78-CSPD01', 'Construcción de saberes pedagógicos en la formación de docentes', 'Construcción de saberes pedagógicos en la formación de docentes', 'construccion_de_saberes_pedagogicos en la formación de docentes', 1, NULL, '1', '2018-12-10 12:15:48', NULL, '1'),
(48, 9, 1, 'UL79-01', '¿Cómo citar con normas APA?', '¿Cómo citar con normas APA?', 'como_citar_con_normas_apa?', 1, NULL, '1', '2018-12-10 12:15:48', NULL, '1'),
(49, 9, 1, 'UL80-MASE01', 'Marketing de servicios', 'Marketing de servicios', 'marketing_de_servicios', 1, NULL, '1', '2018-12-10 12:15:48', NULL, '1'),
(50, 9, 1, 'UL81-CIAM01', 'Comunicaciones integradas al marketing', 'Comunicaciones integradas al marketing', 'comunicaciones_integradas_al_marketing', 1, NULL, '1', '2018-12-10 12:15:48', NULL, '1'),
(51, 9, 1, 'UL82-MAWA01', 'Marketing Way', 'Marketing Way', 'marketing_way ', 1, NULL, '1', '2018-12-10 12:15:48', NULL, '1'),
(52, 9, 1, 'UL83-COMA01', 'Community Manager - Aprenda desde cero a experto', 'Community Manager - Aprenda desde cero a experto', 'community_manager_aprenda_desde_cero_a_experto', 1, NULL, '1', '2018-12-10 12:15:48', NULL, '1'),
(53, 9, 1, 'UL84-GAPE01', 'Google ads para emprendedores', 'Google ads para emprendedores', 'google_ads_para_emprendedores', 1, NULL, '1', '2018-12-10 12:15:48', NULL, '1'),
(54, 9, 1, 'UL85-FPME01', 'Fotografia para marcas emprendedoras', 'Fotografia para marcas emprendedoras', 'fotografia_para_marcas_emprendedoras', 1, NULL, '1', '2018-12-10 12:15:48', NULL, '1'),
(55, 9, 1, 'UL86-ELPN01', 'Elaboración de un plan de negocios', 'Elaboración de un plan de negocios', 'elaboracion_de_un_plan_de_negocios', 1, NULL, '1', '2018-12-10 12:15:48', NULL, '1'),
(56, 9, 1, 'UL87-GMPI01', 'Guía práctica para la redacción del marco teórico de un proyecto de investigación', ' .', 'guia_practica_para_la_redaccion_del_marco_teorico_de_un_proyecto_de_investigacion', 1, NULL, '1', '2018-12-10 12:15:48', NULL, '1'),
(57, 9, 1, 'UL88-AERP01', 'Aprende a establecer y redactar el esquema de un proyecto', 'Aprende a establecer y redactar el esquema de un proyecto', 'aprende_a_establecer_y_redactar_el_esquema_de_un_proyecto', 1, NULL, '1', '2018-12-10 12:15:48', NULL, '1'),
(58, 9, 1, 'UL89-CEPN01', '¿Como evaluar un proyecto de inversión y crear un negocio?', '¿Como evaluar un proyecto de inversión y crear un negocio?', 'como_evaluar_un_proyecto_de_inversión_y_crear_un_negocio', 1, NULL, '1', '2018-12-10 12:15:48', NULL, '1'),
(59, 9, 1, 'UL90-GPPB01', 'Gestión de proyectos usando MS Project básico', 'Gestión de proyectos usando MS Project básico', 'gestión_de_proyectos_usando_ms_project_básico', 1, NULL, '1', '2018-12-10 12:15:48', NULL, '1'),
(60, 9, 1, 'UL91-CFAC01', 'Curso de Formación de Assessment Center', 'Curso de Formación de Assessment Center', 'curso_de_formación_de_assessment_center', 1, NULL, '1', '2018-12-10 12:15:48', NULL, '1'),
(61, 9, 1, 'UL92-FRPS01', 'Factores de riesgo psicosociales', 'Factores de riesgo psicosociales', 'factores_de_riesgo_psicosociales', 1, NULL, '1', '2018-12-10 12:15:48', NULL, '1'),
(62, 9, 1, 'UL93-DCRR01', 'Diseño y desarrollo de base de datos en SQL server','Diseño y desarrollo de base de datos en SQL server', 'diseño_y_desarrollo_de_base_de_datos_en_sql_server', 1, NULL, '1', '2018-12-10 12:15:48', NULL, '1'),
(63, 9, 1, 'UL100-CUEC01', 'Cómo utilizar efectivamente la información contable en la toma de decisiones', 'Cómo utilizar efectivamente la información contable en la toma de decisiones', 'como_utilizar_efectivamente_la_información_contable_en_la_toma_de_decisiones', 1, NULL, '1', '2018-12-10 12:15:48', NULL, '1'),
(64, 9, 1, 'UL101-CICD01', 'La correcta interpretación de los costos para tomar decisiones gerenciales', 'La correcta interpretación de los costos para tomar decisiones gerenciales', 'la_correcta_interpretación_de_los_costos_para_tomar_decisiones_gerenciales', 1, NULL, '1', '2018-12-10 12:15:48', NULL, '1'),
(65, 9, 1, 'UL102-IMCU01', 'Importancia del Modelo Costo - Volumen - Utilidad en el diseño de estrategias', 'Importancia del Modelo Costo - Volumen - Utilidad en el diseño de estrategias', 'importancia_del_modelo_osto_volumen_utilidad en_el_diseño_de_estrategias', 1, NULL, '1', '2018-12-10 12:15:48', NULL, '1'),
(66, 9, 1, 'UL103-EPIC01', 'El Presupuesto y su importancia para el control de gestión', 'El Presupuesto y su importancia para el control de gestión', 'el_presupuesto_y_su_importancia_para_el_control_de_gestión', 1, NULL, '1', '2018-12-10 12:15:48', NULL, '1'),
(67, 9, 1, 'UL104-CCGC01', 'Cómo contribuye el Gobierno Corporativo a consolidar organizaciones saludables', 'Cómo contribuye el Gobierno Corporativo a consolidar organizaciones saludables', 'como_contribuye_el_gobierno_corporativo_a_consolidar_organizaciones_saludables', 1, NULL, '1', '2018-12-10 12:15:48', NULL, '1'),
(68, 9, 1, 'UL105-IETO01', 'La importancia de la Ética en la transparecia de las organizaciones', 'La importancia de la Ética en la transparecia de las organizaciones', 'la_importancia_de_la_etica_en_la_transparecia_de_las_organizaciones', 1, NULL, '1', '2018-12-10 12:15:48', NULL, '1'),
(69, 9, 1, 'UL106-RSEC01', 'Responsabilidad Social Empresarial y Conciencia Ecológica, herramientas para la imagen empresarial', 'Responsabilidad Social Empresarial y Conciencia Ecológica, herramientas para la imagen empresarial', 'responsabilidad_social_empresarial_y_conciencia_ecológica_herramientas_para_la_imagen_empresarial', 1, NULL, '1', '2018-12-10 12:15:48', NULL, '1'),
(70, 9, 1, 'UL107-CPOR01', 'Controles y políticas en la organización, claves para el éxito empresarial', 'Controles y políticas en la organización, claves para el éxito empresarial', 'controles_y_políticas_en_la_organización_claves_para_el_éxito_empresarial', 1, NULL, '1', '2018-12-10 12:15:48', NULL, '1'),
(71, 9, 1, 'UL108-AIER01', 'Análisis e interpretación de estados y ratios financieros', 'Análisis e interpretación de estados y ratios financieros', 'análisis_e_interpretación_de_estados_y_ratios_financieros', 1, NULL, '1', '2018-12-10 12:15:48', NULL, '1'),
(72, 9, 1, 'UL109-CARI01', 'Cálculo y análisis de la rentabilidad sobre la inversión', 'Cálculo y análisis de la rentabilidad sobre la inversión', 'cálculo_y_análisis_de_la_rentabilidad_sobre_la_inversión', 1, NULL, '1', '2018-12-10 12:15:48', NULL, '1'),
(73, 9, 1, 'UL110-01ACSC', 'Administración de costos y sistemas de costeo', 'Administración de costos y sistemas de costeo', 'administración_de_costos_y_sistemas_de_costeo', 1, NULL, '1', '2018-12-10 12:15:48', NULL, '1'),
(74, 9, 1, 'UL111-SCIE01', 'Sistemas de control e indicadores para el éxito de la empresa', 'Sistemas de control e indicadores para el éxito de la empresa', 'sistemas_de_control_e_indicadores_para_el_éxito_de_la_empresa', 1, NULL, '1', '2018-12-10 12:15:48', NULL, '1'),
(75, 9, 1, 'UL112-QVEM01', '¿Qué es la valoración de empresas? ¿Para qué sirve? ¿Cómo se hace?', '¿Qué es la valoración de empresas? ¿Para qué sirve? ¿Cómo se hace?', 'qué_es_la_valoración_de_empresas_para_qué_sirve_cómo_se_hace?', 1, NULL, '1', '2018-12-10 12:15:48', NULL, '1'),
(76, 9, 1, 'UL113-PEFV01', 'Proyección de Estados Financieros y Valoración por Metodologías de Flujos de Caja Descontados', 'Proyección de Estados Financieros y Valoración por Metodologías de Flujos de Caja Descontados', 'proyección_de_estados_financieros_y_valoración_por_metodologías_de_flujos_de_caja_descontados', 1, NULL, '1', '2018-12-10 12:15:48', NULL, '1'),
(77, 9, 1, 'UL114-MVAF01', 'Metodologías de Valoración Alternativas a la de flujo de caja descontados', 'Metodologías de Valoración Alternativas a la de flujo de caja descontados', 'metodologías_de_valoración_alternativas_a_la_de_flujo_de_caja_descontados', 1, NULL, '1', '2018-12-10 12:15:48', NULL, '1'),
(78, 9, 1, 'UL115-ASTD01', 'Análisis de Sensibilización y toma de decisiones financieras', 'Análisis de Sensibilización y toma de decisiones financieras', 'análisis_de_sensibilización_y_toma_de_decisiones_financieras', 1, NULL, '1', '2018-12-10 12:15:48', NULL, '1'),
(79, 9, 1, 'UL116-IMGH01', 'Inteligencia de mercados globales y herramientas básicas para recolectar información', 'Inteligencia de mercados globales y herramientas básicas para recolectar información', 'inteligencia_de_mercados_globales_y_herramientas_básicas_para_recolectar_información', 1, NULL, '1', '2018-12-10 12:15:48', NULL, '1'),
(80, 9, 1, 'UL117-ICEM01', 'Inteligencia Competitiva y estrategias de mercado', 'Inteligencia Competitiva y estrategias de mercado', 'inteligencia_competitiva_y_estrategias_de_mercado', 1, NULL, '1', '2018-12-10 12:15:48', NULL, '1'),
(81, 9, 1, 'UL118-BIBA01', 'Business Intelligence (BI) básico', 'Business Intelligence (BI) básico', 'business_intelligence_(bi)_básico', 1, NULL, '1', '2018-12-10 12:15:48', NULL, '1'),
(82, 9, 1, 'UL119-CRIM01', 'Cómo realizar una Investigación de Mercado', 'Cómo realizar una Investigación de Mercado', 'cómo_realizar_una_investigación_de_mercado', 1, NULL, '1', '2018-12-10 12:15:48', NULL, '1'),
(83, 9, 1, 'UL120-DAPE01', 'Desarrollando las Actitudes para Emprender', 'Desarrollando las Actitudes para Emprender', 'desarrollando_las_actitudes_para_emprender', 1, NULL, '1', '2018-12-10 12:15:48', NULL, '1'),
(84, 9, 1, 'UL121-COCI01', 'Capturar las Oportunidades para Crear e Innovar', 'Capturar las Oportunidades para Crear e Innovar', 'capturar_las_oportunidades_para_crear_e_innovar', 1, NULL, '1', '2018-12-10 12:15:48', NULL, '1'),
(85, 9, 1, 'UL122-CDSD01', 'Como desarrollar la Sinergia del Desarrollo Socioeconómico mediante el trabajo en redes', 'Como desarrollar la Sinergia del Desarrollo Socioeconómico mediante el trabajo en redes', 'como_desarrollar_la_sinergia_del_desarrollo_socioeconómico_mediante_el_trabajo_en_redes', 1, NULL, '1', '2018-12-10 12:15:48', NULL, '1'),
(86, 9, 1, 'UL123-PCTE01', 'Planificando la Creación de tu Empresa', 'Planificando la Creación de tu Empresa', 'planificando_la_creación_de_tu_empresa', 1, NULL, '1', '2018-12-10 12:15:48', NULL, '1'),
(87, 9, 1, 'UL124-ICDT01', 'Importancia y clasificación del turismo', 'Importancia y clasificación del turismo', 'importancia_y_clasificación_del_turismo', 1, NULL, '1', '2018-12-10 12:15:48', NULL, '1'),
(88, 9, 1, 'UL125-CTST01', 'Calidad en el turismo: Servucción Turística', 'Calidad en el turismo: Servucción Turística', 'calidad_en_el_turismo_servucción_turística', 1, NULL, '1', '2018-12-10 12:15:48', NULL, '1'),
(89, 9, 1, 'UL126-TICB01', 'Turismo Inteligente: conceptos básicos', 'Turismo Inteligente: conceptos básicos', 'turismo_inteligente_conceptos_básicos', 1, NULL, '1', '2018-12-10 12:15:48', NULL, '1'),
(90, 9, 1, 'UL127-TSGA01', 'Turismo Sostenible y gestión ambiental', 'Turismo Sostenible y gestión ambiental', 'turismo_sostenible_y_gestión_ambiental', 1, NULL, '1', '2018-12-10 12:15:48', NULL, '1'),
(91, 9, 1, 'UL128-CAVT01', 'Como aprovechar la vocación turística de un territorio', 'Como aprovechar la vocación turística de un territorio', 'como_aprovechar_la_vocación_turística_de_un_territorio', 1, NULL, '1', '2018-12-10 12:15:48', NULL, '1'),
(92, 9, 1, 'UL129-PTDI01', 'Planificación turística de destinos inteligentes', 'Planificación turística de destinos inteligentes', 'planificación_turística_de_destinos_inteligentes', 1, NULL, '1', '2018-12-10 12:15:48', NULL, '1'),
(93, 9, 1, 'UL130-EPDT01', 'Elaboración de un plan de desarrollo turístico en base a las potencialidades del destino' , 'Elaboración de un plan de desarrollo turístico en base a las potencialidades del destino' , 'elaboración_de_un_plan_de_desarrollo_turístico_en_base_a_las_potencialidades_del_destino', 1, NULL, '1', '2018-12-10 12:15:48', NULL, '1'),
(94, 9, 1, 'UL131-GPDT01', 'La Gobernanza y Planificación de Destinos Turísticos Inteligentes', 'La Gobernanza y Planificación de Destinos Turísticos Inteligentes', 'la_gobernanza_y_planificación_de_destinos_turísticos_inteligentes', 1, NULL, '1', '2018-12-10 12:15:48', NULL, '1'),
(95, 9, 1, 'UL132-PCCT01', 'Planificación y control de la calidad en turismo', 'Planificación y control de la calidad en turismo', 'planificación_y_control_de_la_calidad_en_turismo', 1, NULL, '1', '2018-12-10 12:15:48', NULL, '1'),
(96, 9, 1, 'UL133-CSVA01', 'Calidad, sostenibilidad y valor agregado en empresas turísticas', 'Calidad, sostenibilidad y valor agregado en empresas turísticas', 'calidad_sostenibilidad_y_valor_agregado_en_empresas_turísticas', 1, NULL, '1', '2018-12-10 12:15:48', NULL, '1'),
(97, 9, 1, 'UL134-HDMC01', 'Herramientas para el diagnóstico y la mejora de la calidad de empresas de turismo', 'Herramientas para el diagnóstico y la mejora de la calidad de empresas de turismo', 'herramientas_para_el_diagnóstico_y_la_mejora_de_la_calidad_de_empresas_de_turismo', 1, NULL, '1', '2018-12-10 12:15:48', NULL, '1'),
(98, 9, 1, 'UL135-ICST01', 'Introducción a la calidad en el sector turístico', 'Introducción a la calidad en el sector turístico', 'introducción_a_la_calidad_en_el_sector_turístico', 1, NULL, '1', '2018-12-10 12:15:48', NULL, '1'),
(99, 9, 1, 'UL136-MCIT01', 'Marketing  comunicacional inteligente para turismo sostenible', 'Marketing  comunicacional inteligente para turismo sostenible', 'marketing_comunicacional_inteligente_para_turismo_sostenible', 1, NULL, '1', '2018-12-10 12:15:48', NULL, '1'),
(100, 9, 1, 'UL137-EPDP01', 'Estrategias para promover destinos y productos turísticos con principios sostenibles', 'Estrategias para promover destinos y productos turísticos con principios sostenibles', 'estrategias_para_promover_destinos_y_productos_turísticos_con_principios_sostenibles', 1, NULL, '1', '2018-12-10 12:15:48', NULL, '1'),
(101, 9, 1, 'UL138-01IMDT', 'El inbound marketing de los destinos turísticos', 'El inbound marketing de los destinos turísticos', 'el_inbound_marketing_de_los_destinos_turísticos', 1, NULL, '1', '2018-12-10 12:15:48', NULL, '1'),
(102, 9, 1, 'UL139-01GSCM', 'Gestión sostenible, control y monitorización de un destino', 'Gestión sostenible, control y monitorización de un destino', 'gestión_sostenible_control_y_monitorización_de_un_destino', 1, NULL, '1', '2018-12-10 12:15:48', NULL, '1'),
(103, 9, 1, 'UL140-01IDMC', 'Introducción al Data Mining –conceptos básicos', 'Introducción al Data Mining –conceptos básicos', 'introducción_al_data_mining_conceptos_básicos', 1, NULL, '1', '2018-12-10 12:15:48', NULL, '1'),
(104, 9, 1, 'UL141-01MHDM', 'Métodos y herramientas del Data Mining', 'Métodos y herramientas del Data Mining', 'métodos_y_herramientas_del_data_mining', 1, NULL, '1', '2018-12-10 12:15:48', NULL, '1'),
(105, 9, 1, 'UL142-01ADMC', 'Aplicación del  Data Mining en el campo turístico', 'Aplicación del  Data Mining en el campo turístico', 'aplicación_del_data_mining_en_el_campo_turístico', 1, NULL, '1', '2018-12-10 12:15:48', NULL, '1'),
(106, 9, 1, 'UL143-01TISM', 'Turismo inteligente 4.0 y data mining', 'Turismo inteligente 4.0 y data mining', 'turismo_inteligente_4.0_y_data_mining', 1, NULL, '1', '2018-12-10 12:15:48', NULL, '1'),
(107, 9, 1, 'UL144-01TTCI', 'Términos y teorías del comercio internacional', 'Términos y teorías del comercio internacional', 'términos_y_teorías_del_comercio_internacional', 1, NULL, '1', '2018-12-10 12:15:48', NULL, '1'),
(108, 9, 1, 'UL145-01ROIE', 'Rol de los organismos internacionales en la economía de los países', 'Rol de los organismos internacionales en la economía de los países', 'rol_de_los_organismos_internacionales_en_la_economía_de_los_países', 1, NULL, '1', '2018-12-10 12:15:48', NULL, '1'),
(109, 9, 1, 'UL146-01PASE', 'Políticas y acciones de sectores empresariales para el logro de una mayor productividad y competitividad', 'Políticas y acciones de sectores empresariales para el logro de una mayor productividad y competitividad', 'políticas_y_acciones_de_sectores_empresariales_para_el_logro_de_una_mayor_productividad_y_competitividad', 1, NULL, '1', '2018-12-10 12:15:48', NULL, '1'),
(110, 9, 1, 'UL147-01CDCP', 'Conozca los desafíos culturales en los procesos de integración comercial', 'Conozca los desafíos culturales en los procesos de integración comercial', 'conozca_los_desafíos_culturales_en_los_procesos_de_integración_comercial', 1, NULL, '1', '2018-12-10 12:15:48', NULL, '1'),
(111, 9, 1, 'UL148-01CSMO', 'Como seleccionar un mercado objetivo y establecer un marketing mix acorde al mismo', 'Como seleccionar un mercado objetivo y establecer un marketing mix acorde al mismo', 'como_seleccionar_un_mercado_objetivo_y_establecer_un_marketing_mix_acorde_al_mismo', 1, NULL, '1', '2018-12-10 12:15:48', NULL, '1'),
(112, 9, 1, 'UL149-01SMIE', 'Selección de mercados para internacionalización  de la empresa', 'Selección de mercados para internacionalización  de la empresa', 'selección_de_mercados_para_internacionalización_de_la_empresa', 1, NULL, '1', '2018-12-10 12:15:48', NULL, '1'),
(113, 9, 1, 'UL150-01EMMG', 'Estrategias de marca para crear marcas globales', 'Estrategias de marca para crear marcas globales', 'estrategias_de_marca_para_crear_marcas_globales', 1, NULL, '1', '2018-12-10 12:15:48', NULL, '1'),
(114, 9, 1, 'UL151-01TDMC', 'Tomar decisiones de marketing en un contexto global', 'Tomar decisiones de marketing en un contexto global', 'tomar_decisiones_de_marketing_en_un_contexto_global', 1, NULL, '1', '2018-12-10 12:15:48', NULL, '1'),
(115, 9, 1, 'UL152-01HGEX', 'Herramientas para la gestión de exportación', 'Herramientas para la gestión de exportación', 'herramientas_para_la_gestión_de_exportación', 1, NULL, '1', '2018-12-10 12:15:48', NULL, '1'),
(116, 9, 1, 'UL153-01ESEX', 'Estrategias de exportación', 'Estrategias de exportación', 'estrategias_de_exportación', 1, NULL, '1', '2018-12-10 12:15:48', NULL, '1'),
(117, 9, 1, 'UL154-01CEME', 'Cómo escoger los mercados para exportación', 'Cómo escoger los mercados para exportación', 'cómo_escoger_los_mercados_para_exportación', 1, NULL, '1', '2018-12-10 12:15:48', NULL, '1'),
(118, 9, 1, 'UL155-01CIPE', 'Como internacionalizar un producto exportable', 'Como internacionalizar un producto exportable', 'como_internacionalizar_un_producto_exportable', 1, NULL, '1', '2018-12-10 12:15:48', NULL, '1'),
(119, 9, 1, 'UL156-01GCIE', 'La gestión por competencias y su importancia en la eficiencia', 'La gestión por competencias y su importancia en la eficiencia', 'la_gestión_por_competencias_y_su_importancia_en_la_eficiencia', 1, NULL, '1', '2018-12-10 12:15:48', NULL, '1'),
(120, 9, 1, 'UL157-01EMGC', 'Como escoger el modelo de gestión de competencias acorde a su empresa', 'Como escoger el modelo de gestión de competencias acorde a su empresa', 'como_escoger_el_modelo_de_gestión_de_competencias_acorde_a_su_empresa', 1, NULL, '1', '2018-12-10 12:15:48', NULL, '1'),
(121, 9, 1, 'UL158-01TDCE', 'Técnicas para determinar competencias en su empresa', 'Técnicas para determinar competencias en su empresa', 'técnicas_para_determinar_competencias_en_su_empresa', 1, NULL, '1', '2018-12-10 12:15:48', NULL, '1'),
(122, 9, 1, 'UL159-01ISCO', 'Cómo implementar un sistema por competencias', 'Cómo implementar un sistema por competencias', 'cómo_implementar_un_sistema_por_competencias', 1, NULL, '1', '2018-12-10 12:15:48', NULL, '1'),
(123, 9, 1, 'UL160-01RHTI', 'Recursos humanos y las tics, nuevos ambientes de trabajo', 'Recursos humanos y las tics, nuevos ambientes de trabajo', 'recursos_humanos_y_las_tics_nuevos_ambientes_de_trabajo', 1, NULL, '1', '2018-12-10 12:15:48', NULL, '1'),
(124, 9, 1, 'UL161-01FPIO', 'Los factores psicosociales 2.0 y su influencia en la organización', 'Los factores psicosociales 2.0 y su influencia en la organización', 'los_factores_psicosociales_2.0_y_su_influencia_en_la_organización', 1, NULL, '1', '2018-12-10 12:15:48', NULL, '1'),
(125, 9, 1, 'UL162-01COAW', 'El Comportamiento organizacional aplicado a la web 2.0', 'El Comportamiento organizacional aplicado a la web 2.0', 'el_comportamiento_organizacional_aplicado_a_la_web_2.0', 1, NULL, '1', '2018-12-10 12:15:48', NULL, '1'),
(126, 9, 1, 'UL163-01COEM', 'La Comunicación 2.0 en la empresa', 'La Comunicación 2.0 en la empresa', 'la_comunicación_2.0_en_la_empresa', 1, NULL, '1', '2018-12-10 12:15:48', NULL, '1'),
(127, 9, 1, 'UL164-01ERSC', 'Estrategias de Reclutamiento y Selección por competencias', 'Estrategias de Reclutamiento y Selección por competencias', 'estrategias_de_reclutamiento_y_selección_por_competencias', 1, NULL, '1', '2018-12-10 12:15:48', NULL, '1'),
(128, 9, 1, 'UL165-01VPCR', 'Valoración de perfiles de candidatos y su reclutamiento', 'Valoración de perfiles de candidatos y su reclutamiento', 'valoración_de_perfiles_de_candidatos_y_su_reclutamiento', 1, NULL, '1', '2018-12-10 12:15:48', NULL, '1'),
(129, 9, 1, 'UL166-01MTEP', 'Métodos y técnicas para la elección del personal', 'Métodos y técnicas para la elección del personal', 'métodos_y_técnicas_para_la_elección_del_personal', 1, NULL, '1', '2018-12-10 12:15:48', NULL, '1'),
(130, 9, 1, 'UL167-01ADSP', 'Análisis de datos de la selección del personal para gestionar el talento humano', 'Análisis de datos de la selección del personal para gestionar el talento humano', 'análisis_de_datos_de_la_selección_del_personal_para_gestionar_el_talento_humano', 1, NULL, '1', '2018-12-10 12:15:48', NULL, '1'),
(131, 9, 1, 'UL168-01HBDL', 'Habilidades blandas para el desarrollo de liderazgo ejecutivo', 'Habilidades blandas para el desarrollo de liderazgo ejecutivo', 'habilidades_blandas_para_el_desarrollo_de_liderazgo_ejecutivo', 1, NULL, '1', '2018-12-10 12:15:48', NULL, '1'),
(132, 9, 1, 'UL169-01CCEG', 'Clasificación de competencias y los estilos de gestión', 'Clasificación de competencias y los estilos de gestión', 'clasificación_de_competencias_y_los_estilos_de_gestión', 1, NULL, '1', '2018-12-10 12:15:48', NULL, '1'),
(133, 9, 1, 'UL170-01DCAP', 'Desarrollo de Competencias de Autogestión personal', 'Desarrollo de Competencias de Autogestión personal', 'desarrollo_de_competencias_de_autogestión_personal', 1, NULL, '1', '2018-12-10 12:15:48', NULL, '1'),
(134, 9, 1, 'UL171-DCIN01', 'Desarrollo de Competencias interpersonales', 'Desarrollo de Competencias interpersonales', 'desarrollo_de_competencias_interpersonales', 1, NULL, '1', '2018-12-10 12:15:48', NULL, '1'),
(135, 9, 1, 'UL172-MACO01', 'Métodos para el análisis del comportamiento organizacional', 'Métodos para el análisis del comportamiento organizacional', 'métodos_para_el_análisis_del_comportamiento_organizacional', 1, NULL, '1', '2018-12-10 12:15:48', NULL, '1'),
(136, 9, 1, 'UL173LLEG-01', 'Legislación laboral Ecuatoriana y gobierno corporativo', 'Legislación laboral Ecuatoriana y gobierno corporativo', 'legislación_laboral_ecuatoriana_y_gobierno_corporativo', 1, NULL, '1', '2018-12-10 12:15:48', NULL, '1'),
(137, 9, 1, 'UL174IFPE-01', 'El impacto de la filosofía y política empresarial en la organización', 'El impacto de la filosofía y política empresarial en la organización', 'el_impacto_de_la_filosofía_y_política_empresarial_en_la_organización', 1, NULL, '1', '2018-12-10 12:15:48', NULL, '1'),
(138, 9, 1, 'UL175DPPG-01', 'Diseño de políticas de personal en la gestión estratégica del talento humano basado en competencias', 'Diseño de políticas de personal en la gestión estratégica del talento humano basado en competencias', 'diseño_de_políticas_de_personal_en_la_gestión_estratégica_del_talento_humano_basado_en_competencias', 1, NULL, '1', '2018-12-10 12:15:48', NULL, '1'),

(139, 9, 1, 'UL176DCRR-01', 'Diseño y configuración de redes en router', 'Diseño y configuración de redes en router', 'diseño_y_configuración_de_redes_en_router', 1, NULL, '1', '2018-12-10 12:15:48', NULL, '1'),
(140, 9, 1, 'UL177UAMA-01', 'Uso y aplicaciones de mathcad', 'Uso y aplicaciones de mathcad', 'uso_y_aplicaciones_de_mathcad', 1, NULL, '1', '2018-12-10 12:15:48', NULL, '1'),
(141, 9, 1, 'UL178CSAL-01', 'Configuración e implementación de un servidor apache basado en distribuciones Linux', 'Configuración e implementación de un servidor apache basado en distribuciones Linux', 'configuración_e_implementación_de_un_servidor_apache_basado_en_distribuciones_linux', 1, NULL, '1', '2018-12-10 12:15:48', NULL, '1'),
(142, 9, 1, 'UL179DAWP-01', 'Desarrollo de Aplicaciones Web con Python', 'Desarrollo de Aplicaciones Web con Python', 'desarrollo_de_aplicaciones_web_con_python', 1, NULL, '1', '2018-12-10 12:15:48', NULL, '1'),
(143, 9, 1, 'UL180DPCB-01', 'Desarrollo de procesos con BIZAGI', 'Desarrollo de procesos con BIZAGI', 'desarrollo_de_procesos_con_bizagi', 1, NULL, '1', '2018-12-10 12:15:48', NULL, '1'),
(144, 9, 1, 'UL181BPPR-01', 'Bootstrap para principiantes', 'Bootstrap para principiantes', 'bootstrap_para_principiantes', 1, NULL, '1', '2018-12-10 12:15:48', NULL, '1');
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

(27, 27, 2, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-12-10 13:30:00', NULL, '1'),
(28, 28, 2, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-12-10 13:30:00', NULL, '1'),
(29, 29, 2, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-12-10 13:30:00', NULL, '1'),
(30, 30, 2, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-12-10 13:30:00', NULL, '1'),

(31, 31, 2, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-12-10 13:30:00', NULL, '1'),
(32, 32, 2, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-12-10 13:30:00', NULL, '1'),
(33, 33, 2, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-12-10 13:30:00', NULL, '1'),
(34, 34, 2, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-12-10 13:30:00', NULL, '1'),

(35, 35, 2, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-12-10 13:30:00', NULL, '1'),
(36, 36, 2, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-12-10 13:30:00', NULL, '1'),
(37, 37, 2, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-12-10 13:30:00', NULL, '1'),
(38, 38, 2, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-12-10 13:30:00', NULL, '1'),
(39, 39, 2, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-12-10 13:30:00', NULL, '1'),
(40, 40, 2, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-12-10 13:30:00', NULL, '1'),
(41, 41, 2, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-12-10 13:30:00', NULL, '1'),
(42, 42, 2, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-12-10 13:30:00', NULL, '1'),
(43, 43, 2, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-12-10 13:30:00', NULL, '1'),
(44, 44, 2, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-12-10 13:30:00', NULL, '1'),
(45, 45, 2, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-12-10 13:30:00', NULL, '1'),
(46, 46, 2, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-12-10 13:30:00', NULL, '1'),
(47, 47, 2, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-12-10 13:30:00', NULL, '1'),
(48, 48, 2, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-12-10 13:30:00', NULL, '1'),
(49, 49, 2, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-12-10 13:30:00', NULL, '1'),
(50, 50, 2, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-12-10 13:30:00', NULL, '1'),
(51, 51, 2, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-12-10 13:30:00', NULL, '1'),
(52, 52, 2, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-12-10 13:30:00', NULL, '1'),
(53, 53, 2, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-12-10 13:30:00', NULL, '1'),
(54, 54, 2, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-12-10 13:30:00', NULL, '1'),
(55, 55, 2, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-12-10 13:30:00', NULL, '1'),
(56, 56, 2, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-12-10 13:30:00', NULL, '1'),
(57, 57, 2, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-12-10 13:30:00', NULL, '1'),
(58, 58, 2, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-12-10 13:30:00', NULL, '1'),
(59, 59, 2, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-12-10 13:30:00', NULL, '1'),
(60, 60, 2, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-12-10 13:30:00', NULL, '1'),
(61, 61, 2, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-12-10 13:30:00', NULL, '1'),
(62, 62, 2, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-12-10 13:30:00', NULL, '1'),
(63, 63, 2, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-12-10 13:30:00', NULL, '1'),
(64, 64, 2, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-12-10 13:30:00', NULL, '1'),
(65, 65, 2, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-12-10 13:30:00', NULL, '1'),
(66, 66, 2, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-12-10 13:30:00', NULL, '1'),
(67, 67, 2, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-12-10 13:30:00', NULL, '1'),
(68, 68, 2, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-12-10 13:30:00', NULL, '1'),
(69, 69, 2, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-12-10 13:30:00', NULL, '1'),
(70, 70, 2, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-12-10 13:30:00', NULL, '1'),
(71, 71, 2, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-12-10 13:30:00', NULL, '1'),
(72, 72, 2, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-12-10 13:30:00', NULL, '1'),
(73, 73, 2, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-12-10 13:30:00', NULL, '1'),
(74, 74, 2, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-12-10 13:30:00', NULL, '1'),
(75, 75, 2, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-12-10 13:30:00', NULL, '1'),
(76, 76, 2, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-12-10 13:30:00', NULL, '1'),
(77, 77, 2, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-12-10 13:30:00', NULL, '1'),
(78, 78, 2, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-12-10 13:30:00', NULL, '1'),
(79, 79, 2, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-12-10 13:30:00', NULL, '1'),
(80, 80, 2, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-12-10 13:30:00', NULL, '1'),
(81, 81, 2, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-12-10 13:30:00', NULL, '1'),
(82, 82, 2, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-12-10 13:30:00', NULL, '1'),
(83, 83, 2, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-12-10 13:30:00', NULL, '1'),
(84, 84, 2, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-12-10 13:30:00', NULL, '1'),
(85, 85, 2, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-12-10 13:30:00', NULL, '1'),
(86, 86, 2, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-12-10 13:30:00', NULL, '1'),
(87, 87, 2, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-12-10 13:30:00', NULL, '1'),
(88, 88, 2, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-12-10 13:30:00', NULL, '1'),
(89, 89, 2, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-12-10 13:30:00', NULL, '1'),
(90, 90, 2, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-12-10 13:30:00', NULL, '1'),
(91, 91, 2, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-12-10 13:30:00', NULL, '1'),
(92, 92, 2, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-12-10 13:30:00', NULL, '1'),
(93, 93, 2, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-12-10 13:30:00', NULL, '1'),
(94, 94, 2, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-12-10 13:30:00', NULL, '1'),
(95, 95, 2, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-12-10 13:30:00', NULL, '1'),
(96, 96, 2, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-12-10 13:30:00', NULL, '1'),
(97, 97, 2, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-12-10 13:30:00', NULL, '1'),
(98, 98, 2, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-12-10 13:30:00', NULL, '1'),
(99, 99, 2, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-12-10 13:30:00', NULL, '1'),
(100, 100, 2, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-12-10 13:30:00', NULL, '1'),
(101, 101, 2, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-12-10 13:30:00', NULL, '1'),
(102, 102, 2, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-12-10 13:30:00', NULL, '1'),
(103, 103, 2, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-12-10 13:30:00', NULL, '1'),
(104, 104, 2, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-12-10 13:30:00', NULL, '1'),
(105, 105, 2, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-12-10 13:30:00', NULL, '1'),
(106, 106, 2, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-12-10 13:30:00', NULL, '1'),
(107, 107, 2, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-12-10 13:30:00', NULL, '1'),
(108, 108, 2, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-12-10 13:30:00', NULL, '1'),
(109, 109, 2, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-12-10 13:30:00', NULL, '1'),
(110, 110, 2, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-12-10 13:30:00', NULL, '1'),
(111, 111, 2, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-12-10 13:30:00', NULL, '1'),
(112, 112, 2, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-12-10 13:30:00', NULL, '1'),
(113, 113, 2, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-12-10 13:30:00', NULL, '1'),
(114, 114, 2, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-12-10 13:30:00', NULL, '1'),
(115, 115, 2, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-12-10 13:30:00', NULL, '1'),
(116, 116, 2, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-12-10 13:30:00', NULL, '1'),
(117, 117, 2, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-12-10 13:30:00', NULL, '1'),
(118, 118, 2, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-12-10 13:30:00', NULL, '1'),
(119, 119, 2, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-12-10 13:30:00', NULL, '1'),
(120, 120, 2, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-12-10 13:30:00', NULL, '1'),
(121, 121, 2, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-12-10 13:30:00', NULL, '1'),
(122, 122, 2, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-12-10 13:30:00', NULL, '1'),
(123, 123, 2, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-12-10 13:30:00', NULL, '1'),
(124, 124, 2, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-12-10 13:30:00', NULL, '1'),
(125, 125, 2, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-12-10 13:30:00', NULL, '1'),
(126, 126, 2, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-12-10 13:30:00', NULL, '1'),
(127, 127, 2, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-12-10 13:30:00', NULL, '1'),
(128, 128, 2, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-12-10 13:30:00', NULL, '1'),
(129, 129, 2, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-12-10 13:30:00', NULL, '1'),
(130, 130, 2, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-12-10 13:30:00', NULL, '1'),
(131, 131, 2, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-12-10 13:30:00', NULL, '1'),
(132, 132, 2, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-12-10 13:30:00', NULL, '1'),
(133, 133, 2, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-12-10 13:30:00', NULL, '1'),
(134, 134, 2, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-12-10 13:30:00', NULL, '1'),
(135, 135, 2, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-12-10 13:30:00', NULL, '1'),
(136, 136, 2, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-12-10 13:30:00', NULL, '1'),
(137, 137, 2, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-12-10 13:30:00', NULL, '1'),
(138, 138, 2, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-12-10 13:30:00', NULL, '1'),

(139, 139, 2, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-12-10 13:30:00', NULL, '1'),
(140, 140, 2, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-12-10 13:30:00', NULL, '1'),
(141, 141, 2, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-12-10 13:30:00', NULL, '1'),
(142, 142, 2, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-12-10 13:30:00', NULL, '1'),
(143, 143, 2, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-12-10 13:30:00', NULL, '1'),
(144, 144, 2, '2018-09-01 05:00:00', '2018-12-31 05:00:00', 1, NULL, '1', '1', '2018-12-10 13:30:00', NULL, '1');

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

INSERT INTO `asignatura` (`asi_id`, `scon_id`, `asi_nombre`, `asi_descripcion`, `asi_usuario_ingreso`, `asi_usuario_modifica`, `asi_estado`, `asi_fecha_creacion`, `asi_fecha_modificacion`, `asi_estado_logico`) VALUES
(1, 1, 'Matemáticas - CAN', 'Matemáticas - CAN', 1, NULL, '1', '2018-05-08 22:15:37', NULL, '1'),
(2, 1, 'Contabilidad - CAN', 'Contabilidad - CAN', 1, NULL, '1', '2018-05-08 22:15:37', NULL, '1'),
(3, 1, 'Técnicas de comunicación oral - CAN', 'Técnicas de comunicación oral - CAN', 1, NULL, '1', '2018-05-08 22:16:01', NULL, '1'),
(4, 1, 'Desarrollo del Pensamiento - CAN', 'Desarrollo del Pensamiento - CAN', 1, NULL, '1', '2018-05-08 22:16:52', NULL, '1'),
(5, 1, 'Emprendimiento - CAN', 'Emprendimiento - CAN', 1, NULL, '1', '2018-05-08 22:16:52', NULL, '1'),
(6, 1, 'Física - CAN', 'Física - CAN', 1, NULL, '1', '2018-05-08 22:16:52', NULL, '1'),
-- seguir modificando
(7, 13, 'Matematicas I', 'Matematicas II', '1', NULL, '1', '2018-05-08 22:15:37', NULL, '1'),
(8, 14, 'Fundamentos Para Softwares Especializados', 'Fundamentos para softwares especializados', '1', NULL, '1', '2018-05-08 22:15:37', NULL, '1'),
(9, 7, 'Fundamentos De Economia', 'Fundamentos de economia', '1', NULL, '1', '2018-05-08 22:15:37', NULL, '1'),
(10, 10, 'Derecho Constitucional', 'Derecho constitucional', '1', NULL, '1', '2018-05-08 22:15:37', NULL, '1'),
(11, 9, 'Fundamentos De Administracion', 'Fundamentos de administracion', '1', NULL, '1', '2018-05-08 22:15:37', NULL, '1'),
(12, 6, 'Tecnicas De Comunicacion Oral Y Escrita', 'Tecnicas de comunicacion oral y escrita', '1', NULL, '1', '2018-05-08 22:15:37', NULL, '1'),
(13, 13, 'Matematicas II', 'Matematicas II', '1', NULL, '1', '2018-05-08 22:15:37', NULL, '1'),
(14, 13, 'Matematicas Financieras', 'Matematicas financieras', '1', NULL, '1', '2018-05-08 22:15:37', NULL, '1'),
(15, 6, 'Microeconomia', 'Microeconomia', '1', NULL, '1', '2018-05-08 22:15:37', NULL, '1'),
(16, 9, 'Contabilidad General', 'Contabilidad general', '1', NULL, '1', '2018-05-08 22:15:37', NULL, '1'),
(17, 9, 'Fundamentos De Mercadotecnia', 'Fundamentos de mercadotecnia', '1', NULL, '1', '2018-05-08 22:15:37', NULL, '1'),
(18, 13, 'Estadisticas I', 'Estadisticas I', '1', NULL, '1', '2018-05-08 22:15:37', NULL, '1'),
(19, 7, 'Actualidad Economica', 'Actualidad economica', '1', NULL, '1', '2018-05-08 22:15:37', NULL, '1'),
(20, 6, 'Macroeconomia', 'Macroeconomia', '1', NULL, '1', '2018-05-08 22:15:37', NULL, '1'),
(21, 10, 'Legislacion Y Derecho Aduanero', 'Legislacion y derecho aduanero', '1', NULL, '1', '2018-05-08 22:15:37', NULL, '1'),
(22, 9, 'Contabilidad Gerencial', 'Contabilidad gerencial', '1', NULL, '1', '2018-05-08 22:15:37', NULL, '1'),
(23, 6, 'Etica Profesional', 'Etica profesional', '1', NULL, '1', '2018-05-08 22:15:37', NULL, '1'),
(24, 13, 'Estadisticas II', 'Estadisticas II', '1', NULL, '1', '2018-05-08 22:15:37', NULL, '1'),
(25, 9, 'Planeacion Y Direccion Estrategica', 'Planeacion y direccion estrategica', '1', NULL, '1', '2018-05-08 22:15:37', NULL, '1'),
(26, 6, 'Epistemologia Del Comercio Exterior', 'Epistemologia del comercio exterior', '1', NULL, '1', '2018-05-08 22:15:37', NULL, '1'),
(27, 10, 'Derecho Internacional', 'Derecho internacional', '1', NULL, '1', '2018-05-08 22:15:37', NULL, '1'),
(28, 9, 'Finanzas', 'Finanzas', '1', NULL, '1', '2018-05-08 22:15:37', NULL, '1'),
-- (29, '1', 'Practicas Pre Profesionales I', 'Practicas pre profesionales i', '1', NULL, '1', '2018-05-08 22:15:37', NULL, '1'), -- APARECE COMO Sectores desconocidos no especificados y esa no esta en la base
(30, 13, 'Investigacion De Operaciones', 'Investigacion de operaciones', '1', NULL, '1', '2018-05-08 22:15:37', NULL, '1'),
(31, 9, 'Negocios Internacionales', 'Negocios internacionales', '1', NULL, '1', '2018-05-08 22:15:37', NULL, '1'),
(32, 9, 'Nomenclatura Arancelaria', 'Nomenclatura arancelaria', '1', NULL, '1', '2018-05-08 22:15:37', NULL, '1'),
(33, 9, 'Presupuesto', 'Presupuesto', '1', NULL, '1', '2018-05-08 22:15:37', NULL, '1'),
(34, 9, 'Finanzas Internacionales', 'Finanzas internacionales', '1', NULL, '1', '2018-05-08 22:15:37', NULL, '1'),
-- (35, '1', 'Practicas Pre Profesionales II', 'Practicas pre profesionales II', '1', NULL, '1', '2018-05-08 22:15:37', NULL, '1'), -- APARECE COMO Sectores desconocidos no especificados y esa no esta en la base
(36, 9, 'Investigacion De Mercados Internacionales', 'Investigacion de mercados internacionales', '1', NULL, '1', '2018-05-08 22:15:37', NULL, '1'),
(37, 9, 'Emprendimiento e Innovacion', 'Emprendimiento e innovacion', '1', NULL, '1', '2018-05-08 22:15:37', NULL, '1'),
(38, 9, 'Gestion Ambiental', 'Gestion ambiental', '1', NULL, '1', '2018-05-08 22:15:37', NULL, '1'),
(39, 9, 'Valoracion Aduanera', 'Valoracion aduanera', '1', NULL, '1', '2018-05-08 22:15:37', NULL, '1'),
(40, 23, 'Logistica Y Transporte Internacional', 'Logistica y transporte internacional', '1', NULL, '1', '2018-05-08 22:15:37', NULL, '1'),
(41, 13, 'Metodologia De La Investigacion', 'Metodologia de la investigacion', '1', NULL, '1', '2018-05-08 22:15:37', NULL, '1'),
(42, 9, 'Oferta Exportable Del Ecuador', 'Oferta exportable del ecuador', '1', NULL, '1', '2018-05-08 22:15:37', NULL, '1'),
(43, 9, 'Formulacion Y Evaluacion De Proyectos', 'Formulacion y evaluacion de proyectos', '1', NULL, '1', '2018-05-08 22:15:37', NULL, '1'),
(44, 9, 'Responsabilidad Social Y Empresarial', 'Responsabilidad social y empresarial', '1', NULL, '1', '2018-05-08 22:15:37', NULL, '1'),
(45, 9, 'Merceologia', 'Merceologia', '1', NULL, '1', '2018-05-08 22:15:37', NULL, '1'),
(46, 23, 'Distribucion Fisica Internacional', 'Distribucion fisica internacional', '1', NULL, '1', '2018-05-08 22:15:37', NULL, '1'),
(47, 7, 'Gestion Del Talento Humano', 'Gestion del talento humano', '1', NULL, '1', '2018-05-08 22:15:37', NULL, '1'),
(48, 6, 'Interculturalidad: Culturas Ancestrales Y Generos', 'Interculturalidad: culturas ancestrales y generos', '1', NULL, '1', '2018-05-08 22:15:37', NULL, '1'),
(49, 9, 'Comercio Electronico', 'Comercio electronico', '1', NULL, '1', '2018-05-08 22:15:37', NULL, '1'),
(50, 9, 'Diplomacia Internacional', 'Diplomacia internacional', '1', NULL, '1', '2018-05-08 22:15:37', NULL, '1'),
-- (51, '1', 'Introduccion Al Trabajo De Titulacion', 'Introduccion al trabajo de titulacion', '1', NULL, '1', '2018-05-08 22:15:37', NULL, '1'), -- APARECE COMO Sectores desconocidos no especificados y esa no esta en la base
-- (52, '1', 'Trabajo De Titulacion I', 'Trabajo de titulacion I', '1', NULL, '1', '2018-05-08 22:15:37', NULL, '1'), -- APARECE COMO Sectores desconocidos no especificados y esa no esta en la base
-- (53, '1', 'Practicas Pre Profesionales III (vinculacion)', 'Practicas pre profesionales III (vinculacion)', '1', NULL, '1', '2018-05-08 22:15:37', NULL, '1'), -- APARECE COMO Sectores desconocidos no especificados y esa no esta en la base
(54, 9, 'Normas Internacionales De Calidad', 'Normas internacionales de calidad', '1', NULL, '1', '2018-05-08 22:15:37', NULL, '1'),
(55, 9, 'Negocios Internacionales', 'Negocios internacionales', '1', NULL, '1', '2018-05-08 22:15:37', NULL, '1'),
(56, 9, 'Sistemas Aduaneros', 'Sistemas aduaneros', '1', NULL, '1', '2018-05-08 22:15:37', NULL, '1'),
(57, 9, 'Economia Internacional', 'Economia internacional', '1', NULL, '1', '2018-05-08 22:15:37', NULL, '1'),
(58, 9, 'Liderazgo Y Habilidades Gerenciales', 'Liderazgo y habilidades gerenciales', '1', NULL, '1', '2018-05-08 22:15:37', NULL, '1'),
(59, 9, 'Marketing Internacional', 'Marketing internacional', '1', NULL, '1', '2018-05-08 22:15:37', NULL, '1'),
-- (60, '1', 'Trabajo De Titulacion II', 'Trabajo de titulacion II', '1', NULL, '1', '2018-05-08 22:15:37', NULL, '1'), -- APARECE COMO Sectores desconocidos no especificados y esa no esta en la base
-- (61, '1', 'Epistemologia De La Economia', 'Epistemologia de la economia', '1', NULL, '1', '2018-05-08 22:15:37', NULL, '1'),
(62, 13, 'Algebra Lineal', 'Algebra lineal', '1', NULL, '1', '2018-05-08 22:15:37', NULL, '1'),
(63, 6, 'Microeconomia II', 'Microeconomia II', '1', NULL, '1', '2018-05-08 22:15:37', NULL, '1'),
(64, 10, 'Derecho Laboral', 'Derecho laboral', '1', NULL, '1', '2018-05-08 22:15:37', NULL, '1'),
(65, 9, 'Administracion Financiera', 'Administracion financiera', '1', NULL, '1', '2018-05-08 22:15:37', NULL, '1'),
-- (66, '1', 'Econometria I', 'Econometria I', '1', NULL, '1', '2018-05-08 22:15:37', NULL, '1'), --Malla de economia
(67, 6, 'Macroeconomia II', 'Macroeconomia II', '1', NULL, '1', '2018-05-08 22:15:37', NULL, '1'),
-- (68, '1', 'Econometria II', 'Econometria II', '1', NULL, '1', '2018-05-08 22:15:37', NULL, '1'), --Malla de economia
-- (69, '1', 'Moneda e Instituciones Financieras', 'Moneda e instituciones financieras', '1', NULL, '1', '2018-05-08 22:15:37', NULL, '1'), -- Malla de economia
-- (70, '1', 'Historia Economica Y Politica Del Ecuador', 'Historia economica y politica del ecuador', '1', NULL, '1', '2018-05-08 22:15:37', NULL, '1'), -- Malla de economia
-- (71, '1', 'Teoria Del Desarrollo Economico', 'Teoria del desarrollo economico', '1', NULL, '1', '2018-05-08 22:15:37', NULL, '1'), -- Malla de economia
(72, 9, 'Gestion De Calidad', 'Gestion de calidad', '1', NULL, '1', '2018-05-08 22:15:37', NULL, '1'),
-- (73, '1', 'Economia Ambiental', 'Economia ambiental', '1', NULL, '1', '2018-05-08 22:15:37', NULL, '1'), -- Malla de economia
-- (74, '1', 'Derecho Economico', 'Derecho economico', '1', NULL, '1', '2018-05-08 22:15:37', NULL, '1'), -- Malla de economia
-- (75, '1', 'Teoria Monetaria Internacional', 'Teoria monetaria internacional', '1', NULL, '1', '2018-05-08 22:15:37', NULL, '1'), -- Malla de economia
(76, 9, 'Tributacion', 'Tributacion', '1', NULL, '1', '2018-05-08 22:15:37', NULL, '1'),
-- (77, '1', 'Finanzas Publicas', 'Finanzas publicas', '1', NULL, '1', '2018-05-08 22:15:37', NULL, '1'),
-- (78, '1', 'Politica Economica Y Fiscal', 'Politica economica y fiscal', '1', NULL, '1', '2018-05-08 22:15:37', NULL, '1'), -- Malla de economia
-- (79, '1', 'Modelos Econometricos', 'Modelos econometricos', '1', NULL, '1', '2018-05-08 22:15:37', NULL, '1'),
-- (80, '1', 'Public Choice', 'Public choice', '1', NULL, '1', '2018-05-08 22:15:37', NULL, '1'),
-- (81', '1', 'Epistemologia De Las Finanzas', 'Epistemologia de las finanzas', '1', NULL, '1', '2018-05-08 22:15:37', NULL, '1'),
-- (82, '1', 'Derecho Financiero Y Tributario', 'Derecho financiero y tributario', '1', NULL, '1', '2018-05-08 22:15:37', NULL, '1'),
-- (83, '1', 'Mercado De Valores', 'Mercado de valores', '1', NULL, '1', '2018-05-08 22:15:37', NULL, '1'), -- APARECE COMO Sectores desconocidos no especificados y esa no esta en la base
-- (84, '1', 'Finanzas Corporativas I', 'Finanzas corporativas i', '1', NULL, '1', '2018-05-08 22:15:37', NULL, '1'),
-- (85, '1', 'Derecho Mercantil', 'Derecho mercantil', '1', NULL, '1', '2018-05-08 22:15:37', NULL, '1'),
-- (86, '1', 'Finanzas Corporativas II', 'Finanzas corporativas II', '1', NULL, '1', '2018-05-08 22:15:37', NULL, '1'),
-- (87, '1', 'Auditoria', 'Auditoria', '1', NULL, '1', '2018-05-08 22:15:37', NULL, '1'),
-- (88, '1', 'Adm Del Riesgo', 'Adm del riesgo', '1', NULL, '1', '2018-05-08 22:15:37', NULL, '1'),
-- (89, '1', 'Auditoria Tributaria', 'Auditoria tributaria', '1', NULL, '1', '2018-05-08 22:15:37', NULL, '1'),
-- (90, '1', 'Auditoria Financiera', 'Auditoria financiera', '1', NULL, '1', '2018-05-08 22:15:37', NULL, '1'),
-- (91, '1', 'Gerencia Financiera', 'Gerencia financiera', '1', NULL, '1', '2018-05-08 22:15:37', NULL, '1'),
(92, 9, 'Simulacion De Negocios', 'Simulacion de negocios', '1', NULL, '1', '2018-05-08 22:15:37', NULL, '1'),
-- (93, '1', 'Fusiones Y Adquisiciones', 'Fusiones y adquisiciones', '1', NULL, '1', '2018-05-08 22:15:37', NULL, '1'),
-- (94, '1', 'Auditoria De Sistemas', 'Auditoria de sistemas', '1', NULL, '1', '2018-05-08 22:15:37', NULL, '1'),
-- (95, '1', 'Gestion Practica Y Tributaria', 'Gestion practica y tributaria', '1', NULL, '1', '2018-05-08 22:15:37', NULL, '1'),
(96, 6, 'Epistemologia', 'Epistemologia', '1', NULL, '1', '2018-05-08 22:15:37', NULL, '1'),
-- (97, '1', 'Marco Legal De La Mercadotecnia', 'Marco legal de la mercadotecnia', '1', NULL, '1', '2018-05-08 22:15:37', NULL, '1'),
-- (98, '1', 'Marketing Estrategico', 'Marketing estrategico', '1', NULL, '1', '2018-05-08 22:15:37', NULL, '1'),
-- (99, '1', 'Investigacion De Mercados', 'Investigacion de mercados', '1', NULL, '1', '2018-05-08 22:15:37', NULL, '1'),
-- (100, '1', 'Plan De Marketing', 'Plan de marketing', '1', NULL, '1', '2018-05-08 22:15:37', NULL, '1'),
-- (101, '1', 'Creatividad e Innovacion', 'Creatividad e innovacion', '1', NULL, '1', '2018-05-08 22:15:37', NULL, '1'),
-- (102, '1', 'Comportamiento Del Consumidor', 'Comportamiento del consumidor', '1', NULL, '1', '2018-05-08 22:15:37', NULL, '1'),
-- (103, '1', 'Marketing Digital', 'Marketing digital', '1', NULL, '1', '2018-05-08 22:15:37', NULL, '1'),
-- (104, '1', 'Diseño Grafico Publicitario', 'Diseño grafico publicitario', '1', NULL, '1', '2018-05-08 22:15:37', NULL, '1'),
-- (105, '1', 'Politicas De Precio Y Producto', 'Politicas de precio y producto', '1', NULL, '1', '2018-05-08 22:15:37', NULL, '1'),
-- (106, '1', 'Logistica Y Distribucion', 'Logistica y distribucion', '1', NULL, '1', '2018-05-08 22:15:37', NULL, '1'),
-- (107, '1', 'Publicidad Y Promocion', 'Publicidad y promocion', '1', NULL, '1', '2018-05-08 22:15:37', NULL, '1'),
-- (108, '1', 'Emprendimiento', 'Emprendimiento', '1', NULL, '1', '2018-05-08 22:15:37', NULL, '1'),
-- (109, '1', 'Marketing De Servicios', 'Marketing de servicios', '1', NULL, '1', '2018-05-08 22:15:37', NULL, '1'),
-- (110, '1', 'Retailing', 'Retailing', '1', NULL, '1', '2018-05-08 22:15:37', NULL, '1'),
(111, 9, 'Gerencia De Marketing', 'Gerencia de marketing', '1', NULL, '1', '2018-05-08 22:15:37', NULL, '1'),
(112, 9, 'Desarrollo Y Administracion De Nuevos Productos', 'Desarrollo y administracion de nuevos productos', '1', NULL, '1', '2018-05-08 22:15:37', NULL, '1'),
-- (113, '1', 'Relaciones Publicas Y Marketing Directo', 'Relaciones publicas y marketing directo', '1', NULL, '1', '2018-05-08 22:15:37', NULL, '1'),
(114, 9, 'Marketing Internacional', 'Marketing internacional', '1', NULL, '1', '2018-05-08 22:15:37', NULL, '1'),
-- (115, '1', 'Epistemologia Del Turismo', 'Epistemologia del turismo', '1', NULL, '1', '2018-05-08 22:15:37', NULL, '1'),
-- (116, '1', 'Historia Del Ecuador', 'Historia del ecuador', '1', NULL, '1', '2018-05-08 22:15:37', NULL, '1'),
-- (117, '1', 'Psicologia Del Turismo', 'Psicologia del turismo', '1', NULL, '1', '2018-05-08 22:15:37', NULL, '1'),
-- (118, '1', 'Derecho', 'Derecho', '1', NULL, '1', '2018-05-08 22:15:37', NULL, '1'),
-- (119, '1', 'Geografia Turistica', 'Geografia turistica', '1', NULL, '1', '2018-05-08 22:15:37', NULL, '1'),
-- (120, '1', 'Sociologia Del Turismo', 'Sociologia del turismo', '1', NULL, '1', '2018-05-08 22:15:37', NULL, '1'),
-- (121, '1', 'Patrimomio Natural Del Ecuador', 'Patrimomio natural del ecuador', '1', NULL, '1', '2018-05-08 22:15:37', NULL, '1'),
-- (122, '1', 'Asistencia De Grupos Turisticos', 'Asistencia de grupos turisticos', '1', NULL, '1', '2018-05-08 22:15:37', NULL, '1'),
-- (123, '1', 'Desarrollo De Infraestructura Turistica', 'Desarrollo de infraestructura turistica', '1', NULL, '1', '2018-05-08 22:15:37', NULL, '1'),
-- (124, '1', 'Patrimonio Universal', 'Patrimonio universal', '1', NULL, '1', '2018-05-08 22:15:37', NULL, '1'),
-- (125, '1', 'Tecnicas De Operaciones Turisticas', 'Tecnicas de operaciones turisticas', '1', NULL, '1', '2018-05-08 22:15:37', NULL, '1'), -- AUN NO LE PONEN LA SUBAREA MALLA TURISMO
-- (126, '1', 'Legislacion Turistica', 'Legislacion turistica', '1', NULL, '1', '2018-05-08 22:15:37', NULL, '1'), -- AUN NO LE PONEN LA SUBAREA MALLA TURISMO
-- (127, '1', 'Gestion Hotelera', 'Gestion hotelera', '1', NULL, '1', '2018-05-08 22:15:37', NULL, '1'), -- AUN NO LE PONEN LA SUBAREA MALLA TURISMO
-- (128, '1', 'Agencia De Viajes', 'Agencia de viajes', '1', NULL, '1', '2018-05-08 22:15:37', NULL, '1'), -- AUN NO LE PONEN LA SUBAREA MALLA TURISMO
-- (129, '1', 'Tecnicas Culinarias', 'Tecnicas culinarias', '1', NULL, '1', '2018-05-08 22:15:37', NULL, '1'), -- AUN NO LE PONEN LA SUBAREA MALLA TURISMO
-- (130, '1', 'Gestion De Restauracion', 'Gestion de restauracion', '1', NULL, '1', '2018-05-08 22:15:37', NULL, '1'), -- AUN NO LE PONEN LA SUBAREA MALLA TURISMO
-- (131, '1', 'Turismo Sostenible', 'Turismo sostenible', '1', NULL, '1', '2018-05-08 22:15:37', NULL, '1'), -- AUN NO LE PONEN LA SUBAREA MALLA TURISMO
-- (132, '1', 'Gestion De Seguridad', 'Gestion de seguridad', '1', NULL, '1', '2018-05-08 22:15:37', NULL, '1'), -- AUN NO LE PONEN LA SUBAREA MALLA TURISMO
-- (133, '1', 'Transporte Turistico', 'Transporte turistico', '1', NULL, '1', '2018-05-08 22:15:37', NULL, '1'), -- AUN NO LE PONEN LA SUBAREA MALLA TURISMO
-- (134, '1', 'Gastronomia', 'Gastronomia', '1', NULL, '1', '2018-05-08 22:15:37', NULL, '1'), -- AUN NO LE PONEN LA SUBAREA MALLA TURISMO
-- (135, '1', 'Planeacion Estrategica Sostenible', 'Planeacion estrategica sostenible', '1', NULL, '1', '2018-05-08 22:15:37', NULL, '1'), -- AUN NO LE PONEN LA SUBAREA MALLA TURISMO
(136, 9, 'Evaluacion De Proyectos', 'Evaluacion de proyectos', '1', NULL, '1', '2018-05-08 22:15:37', NULL, '1');
-- (137, '1', 'Tendencias Tecnologicas Del Turismo', 'Tendencias tecnologicas del turismo', '1', NULL, '1', '2018-05-08 22:15:37', NULL, '1'), -- AUN NO LE PONEN LA SUBAREA MALLA TURISMO
-- (138, '1', 'Trafico Aereo Gds De Reservas', 'Trafico aereo gds de reservas', '1', NULL, '1', '2018-05-08 22:15:37', NULL, '1'), -- AUN NO LE PONEN LA SUBAREA MALLA TURISMO
-- (139, '1', 'Eventos Y Convenciones', 'Eventos y convenciones', '1', NULL, '1', '2018-05-08 22:15:37', NULL, '1'),
-- (140, '1', 'Contabilidad De Costo', 'Contabilidad de costo', '1', NULL, '1', '2018-05-08 22:15:37', NULL, '1'),
-- (141, '1', 'Investigacion De Mercado', 'Investigacion de mercado', '1', NULL, '1', '2018-05-08 22:15:37', NULL, '1'),
-- (142, '1', 'Derecho Tributario Y Financiero', 'Derecho tributario y financiero', '1', NULL, '1', '2018-05-08 22:15:37', NULL, '1'),
-- (143, '1', 'Gestion De La Cadena De Suministros Scm', 'Gestion de la cadena de suministros scm', '1', NULL, '1', '2018-05-08 22:15:37', NULL, '1'),
-- (144, '1', 'Gerencia De Produccion', 'Gerencia de produccion', '1', NULL, '1', '2018-05-08 22:15:37', NULL, '1'),
-- (145, '1', 'Elaboracion Y Evaluacion De Proyectos', 'Elaboracion y evaluacion de proyectos', '1', NULL, '1', '2018-05-08 22:15:37', NULL, '1'),
-- (146, '1', 'Sistema De Informacion Gerencial', 'Sistema de informacion gerencial', '1', NULL, '1', '2018-05-08 22:15:37', NULL, '1'),
-- (148, '1', 'Gerencia Del Marketing', 'Gerencia del marketing', '1', NULL, '1', '2018-05-08 22:15:37', NULL, '1'),

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
(10,3,1,2,1,'0','2017-02-01 14:35:00','1'),
(11,5,1,2,1,'0','2017-02-01 14:35:00','1'),
(12,7,1,2,1,'0','2017-02-01 14:35:00','1'),
(13,8,1,2,1,'0','2018-10-01 14:35:00','1'),
(14,2,2,1,1,'1','2018-10-19 16:30:00','1'),
(15,7,1,2,1,'1','2018-12-10 10:55:00','1'),
(16,8,2,2,1,'1','2018-12-10 10:55:00','1'),
(17,9,1,2,1,'1','2018-12-10 10:55:00','1');

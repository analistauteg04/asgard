--
-- Base de datos: `db_gpr`
--
USE `db_gpr`;

-- --------------------------------------------------------
--
-- Tabla `umbral`
--
-- --------------------------------------------------------
INSERT INTO `umbral` (`umb_id`, `umb_nombre`, `umb_descripcion`, `umb_color`, `umb_per_inicio`, `umb_per_fin`,`umb_usuario_ingreso`, `umb_usuario_modifica`, `umb_estado`, `umb_fecha_creacion`, `umb_fecha_modificacion`, `umb_estado_logico`) VALUES
(1, 'Indicador de Satisfacción', 'Señal de cumplimiento Satisfactorio.', '#3d754c', '90', '100', 1, NULL, '1', '2020-09-14 15:00:00', NULL, '1'),
(2, 'Indicador de Alarma', 'Niveles preocupantes del indicador.', '#ffff00', '75', '89', 1, NULL, '1', '2020-09-14 15:00:00', NULL, '1'),
(3, 'Indicador Crítico', 'Niveles graves del indicador. Señal de aplicar correctivos urgentes.', '#ff0000', '0', '74', 1, NULL, '1', '2020-09-14 15:00:00', NULL, '1');

-- --------------------------------------------------------
--
-- Tabla `categoria_bsc`
--
-- --------------------------------------------------------
INSERT INTO `categoria_bsc` (`cbsc_id`, `cbsc_nombre`, `cbsc_descripcion`, `cbsc_usuario_ingreso`, `cbsc_usuario_modifica`, `cbsc_estado`, `cbsc_fecha_creacion`, `cbsc_fecha_modificacion`, `cbsc_estado_logico`) VALUES
(1, 'Ciudadanía', 'Ciudadanía', 1, NULL, '1', '2020-09-14 15:00:00', NULL, '1'),
(2, 'Procesos', 'Procesos', 1, NULL, '1', '2020-09-14 15:00:00', NULL, '1'),
(3, 'Recursos Humanos', 'Recursos Humanos', 1, NULL, '1', '2020-09-14 15:00:00', NULL, '1'),
(4, 'Finanzas', 'Finanzas', 1, NULL, '1', '2020-09-14 15:00:00', NULL, '1');

-- --------------------------------------------------------
--
-- Tabla `enfoque`
--
-- --------------------------------------------------------
INSERT INTO `enfoque` (`enf_id`, `enf_nombre`, `enf_descripcion`, `enf_usuario_ingreso`, `enf_usuario_modifica`, `enf_estado`, `enf_fecha_creacion`, `enf_fecha_modificacion`, `enf_estado_logico`) VALUES
(1, 'Mejora en servicio', 'Mejora en servicio', 1, NULL, '1', '2020-09-14 15:00:00', NULL, '1'),
(2, 'Reducción de costos', 'Reducción de costos', 1, NULL, '1', '2020-09-14 15:00:00', NULL, '1'),
(3, 'Ambos', 'Ambos', 1, NULL, '1', '2020-09-14 15:00:00', NULL, '1');

-- --------------------------------------------------------
--
-- Tabla `tipo_proyecto`
--
-- --------------------------------------------------------
INSERT INTO `tipo_proyecto` (`tpro_id`, `tpro_nombre`, `tpro_descripcion`, `tpro_usuario_ingreso`, `tpro_usuario_modifica`, `tpro_estado`, `tpro_fecha_creacion`, `tpro_fecha_modificacion`, `tpro_estado_logico`) VALUES
(1, 'Activos Fijos', 'Activos Fijos', 1, NULL, '1', '2020-09-14 15:00:00', NULL, '1'),
(2, 'Infraestructura', 'Infraestructura', 1, NULL, '1', '2020-09-14 15:00:00', NULL, '1'),
(3, 'Procesos', 'Procesos', 1, NULL, '1', '2020-09-14 15:00:00', NULL, '1'),
(4, 'Tecnología', 'Tecnología', 1, NULL, '1', '2020-09-14 15:00:00', NULL, '1');

-- --------------------------------------------------------
--
-- Tabla `tipo_configuracion`
--
-- --------------------------------------------------------
INSERT INTO `tipo_configuracion` (`tcon_id`, `tcon_nombre`, `tcon_descripcion`, `tcon_usuario_ingreso`, `tcon_usuario_modifica`, `tcon_estado`, `tcon_fecha_creacion`, `tcon_fecha_modificacion`, `tcon_estado_logico`) VALUES
(1, 'Incremento', 'Incremento', 1, NULL, '1', '2020-09-14 15:00:00', NULL, '1'),
(2, 'Reducción', 'Reducción', 1, NULL, '1', '2020-09-14 15:00:00', NULL, '1');

-- --------------------------------------------------------
--
-- Tabla `unidad_medida`
--
-- --------------------------------------------------------
INSERT INTO `unidad_medida` (`umed_id`, `umed_nombre`, `umed_descripcion`, `umed_usuario_ingreso`, `umed_usuario_modifica`, `umed_estado`, `umed_fecha_creacion`, `umed_fecha_modificacion`, `umed_estado_logico`) VALUES
(1, 'Número', 'Número', 1, NULL, '1', '2020-09-14 15:00:00', NULL, '1'),
(2, 'Porcentaje', 'Porcentaje', 1, NULL, '1', '2020-09-14 15:00:00', NULL, '1');

-- --------------------------------------------------------
--
-- Tabla `tipo_agrupacion`
--
-- --------------------------------------------------------
INSERT INTO `tipo_agrupacion` (`tagr_id`, `tagr_nombre`, `tagr_descripcion`, `tagr_usuario_ingreso`, `tagr_usuario_modifica`, `tagr_estado`, `tagr_fecha_creacion`, `tagr_fecha_modificacion`, `tagr_estado_logico`) VALUES
(1, 'Suma', 'Suma', 1, NULL, '1', '2020-09-14 15:00:00', NULL, '1'),
(2, 'Promedio', 'Promedio', 1, NULL, '1', '2020-09-14 15:00:00', NULL, '1');

-- --------------------------------------------------------
--
-- Tabla `tipo_meta`
--
-- --------------------------------------------------------
INSERT INTO `tipo_meta` (`tmet_id`, `tmet_nombre`, `tmet_descripcion`, `tmet_usuario_ingreso`, `tmet_usuario_modifica`, `tmet_estado`, `tmet_fecha_creacion`, `tmet_fecha_modificacion`, `tmet_estado_logico`) VALUES
(1, 'Por Período', 'Por Período', 1, NULL, '1', '2020-09-14 15:00:00', NULL, '1'),
(2, 'Acumulado', 'Acumulado', 1, NULL, '1', '2020-09-14 15:00:00', NULL, '1');
-- --------------------------------------------------------
--
-- Tabla `jerarquia_indicador`
--
-- --------------------------------------------------------
INSERT INTO `jerarquia_indicador` (`jind_id`, `jind_nombre`, `jind_descripcion`, `jind_usuario_ingreso`, `jind_usuario_modifica`, `jind_estado`, `jind_fecha_creacion`, `jind_fecha_modificacion`, `jind_estado_logico`) VALUES
(1, 'Impacto', 'Impacto', 1, NULL, '1', '2020-09-14 15:00:00', NULL, '1'),
(2, 'Resultado', 'Resultado', 1, NULL, '1', '2020-09-14 15:00:00', NULL, '1'),
(3, 'Procesamiento/Insumo', 'Procesamiento/Insumo', 1, NULL, '1', '2020-09-14 15:00:00', NULL, '1');

-- --------------------------------------------------------
--
-- Tabla `patron_indicador`
--
-- --------------------------------------------------------
INSERT INTO `patron_indicador` (`pind_id`, `pind_nombre`, `pind_descripcion`, `pind_usuario_ingreso`, `pind_usuario_modifica`, `pind_estado`, `pind_fecha_creacion`, `pind_fecha_modificacion`, `pind_estado_logico`) VALUES
(1, 'Contínuo', 'Contínuo', 1, NULL, '1', '2020-09-14 15:00:00', NULL, '1'),
(2, 'Discreto', 'Discreto', 1, NULL, '1', '2020-09-14 15:00:00', NULL, '1');

-- --------------------------------------------------------
--
-- Tabla `frecuencia_indicador`
--
-- --------------------------------------------------------
INSERT INTO `frecuencia_indicador` (`find_id`, `find_nombre`, `find_descripcion`, `find_usuario_ingreso`, `find_usuario_modifica`, `find_estado`, `find_fecha_creacion`, `find_fecha_modificacion`, `find_estado_logico`) VALUES
(1, 'Mensual', 'Mensual', 1, NULL, '1', '2020-09-14 15:00:00', NULL, '1'),
(2, 'Bimestral', 'Bimestral', 1, NULL, '1', '2020-09-14 15:00:00', NULL, '1'),
(3, 'Trimestral', 'Trimestral', 1, NULL, '1', '2020-09-14 15:00:00', NULL, '1'),
(4, 'Semestral', 'Semestral', 1, NULL, '1', '2020-09-14 15:00:00', NULL, '1'),
(5, 'Anual', 'Anual', 1, NULL, '1', '2020-09-14 15:00:00', NULL, '1');

-- --------------------------------------------------------
--
-- Tabla `periodo_indicador`
--
-- --------------------------------------------------------
INSERT INTO `periodo_indicador` (`pein_id`, `pein_nombre`, `pein_descripcion`, `pein_usuario_ingreso`, `pein_usuario_modifica`, `pein_estado`, `pein_fecha_creacion`, `pein_fecha_modificacion`, `pein_estado_logico`) VALUES
(1, 'Mensual', 'Mensual', 1, NULL, '1', '2020-09-14 15:00:00', NULL, '1'),
(2, 'Bimestral', 'Bimestral', 1, NULL, '1', '2020-09-14 15:00:00', NULL, '1'),
(3, 'Trimestral', 'Trimestral', 1, NULL, '1', '2020-09-14 15:00:00', NULL, '1');

-- --------------------------------------------------------
--
-- Tabla `categoria`
--
-- --------------------------------------------------------
INSERT INTO `categoria` (`cat_id`, `cat_nombre`, `cat_descripcion`, `cat_usuario_ingreso`, `cat_usuario_modifica`, `cat_estado`, `cat_fecha_creacion`, `cat_fecha_modificacion`, `cat_estado_logico`) VALUES
(1, 'Instituciones Académicas', 'Instituciones Académicas', 1, NULL, '1', '2020-09-14 15:00:00', NULL, '1');

-- --------------------------------------------------------
--
-- Tabla `entidad`
--
-- --------------------------------------------------------
INSERT INTO `entidad` (`ent_id`, `cat_id`, `emp_id`, `ent_nombre`, `ent_descripcion`, `ent_usuario_ingreso`, `ent_usuario_modifica`, `ent_estado`, `ent_fecha_creacion`, `ent_fecha_modificacion`, `ent_estado_logico`) VALUES
(1, 1, 1, 'UTEG', 'UTEG', 1, NULL, '1', '2020-09-14 15:00:00', NULL, '1');

-- --------------------------------------------------------
--
-- Tabla `unidad_gpr`
--
-- --------------------------------------------------------
INSERT INTO `unidad_gpr` (`ugpr_id`, `ent_id`, `ugpr_nombre`, `ugpr_descripcion`, `ugpr_usuario_ingreso`, `ugpr_usuario_modifica`, `ugpr_estado`, `ugpr_fecha_creacion`, `ugpr_fecha_modificacion`, `ugpr_estado_logico`) VALUES
(1, 1, 'Finanzas', 'Finanzas', 1, NULL, '1', '2020-09-14 15:00:00', NULL, '1'),
(2, 1, 'Colecturia', 'Colecturia', 1, NULL, '1', '2020-09-14 15:00:00', NULL, '1');

-- --------------------------------------------------------
--
-- Tabla `subunidad_gpr`
--
-- --------------------------------------------------------
INSERT INTO `subunidad_gpr` (`sgpr_id`, `ugpr_id`, `sgpr_nombre`, `sgpr_descripcion`, `sgpr_usuario_ingreso`, `sgpr_usuario_modifica`, `sgpr_estado`, `sgpr_fecha_creacion`, `sgpr_fecha_modificacion`, `sgpr_estado_logico`) VALUES
(1, 1, 'Dirección Financiera', 'Dirección Financiera', 1, NULL, '1', '2020-09-14 15:00:00', NULL, '1'),
(2, 1, 'DIS-Infraestructura', 'DIS-Infraestructura', 1, NULL, '1', '2020-09-14 15:00:00', NULL, '1'),
(3, 1, 'DIS-Gestión Documental', 'DIS-Gestión Documental', 1, NULL, '1', '2020-09-14 15:00:00', NULL, '1'),
(4, 1, 'Dirección Administrativa', 'Dirección Administrativa', 1, NULL, '1', '2020-09-14 15:00:00', NULL, '1'),
(5, 1, 'Dirección de Investigaciones', 'Dirección de Investigaciones', 1, NULL, '1', '2020-09-14 15:00:00', NULL, '1'),
(6, 1, 'Biblioteca', 'Biblioteca', 1, NULL, '1', '2020-09-14 15:00:00', NULL, '1'),
(7, 1, 'Secretaría General', 'Secretaría General', 1, NULL, '1', '2020-09-14 15:00:00', NULL, '1'),
(8, 1, 'Facultad de Grado Presencial', 'Facultad de Grado Presencial', 1, NULL, '1', '2020-09-14 15:00:00', NULL, '1'),
(9, 1, 'DIS-Admisiones', 'DIS-Admisiones', 1, NULL, '1', '2020-09-14 15:00:00', NULL, '1'),
(10, 1, 'Dirección de Talento Humano', 'Dirección de Talento Humano', 1, NULL, '1', '2020-09-14 15:00:00', NULL, '1'),
(11, 1, 'Facultad de Estudios Online', 'Facultad de Estudios Online', 1, NULL, '1', '2020-09-14 15:00:00', NULL, '1'),
(12, 1, 'Coordinación de Vinculación con la Sociedad', 'Coordinación de Vinculación con la Sociedad', 1, NULL, '1', '2020-09-14 15:00:00', NULL, '1'),
(13, 1, 'DIS-Procesos', 'DIS-Procesos', 1, NULL, '1', '2020-09-14 15:00:00', NULL, '1'),
(14, 1, 'Coordinación de Bienestar Universitario', 'Coordinación de Bienestar Universitario', 1, NULL, '1', '2020-09-14 15:00:00', NULL, '1'),
(15, 1, 'Facultad de Grado (Semipresencial - Distancia)', 'Facultad de Grado (Semipresencial - Distancia)', 1, NULL, '1', '2020-09-14 15:00:00', NULL, '1'),
(16, 1, 'DIS-Desarrollo', 'DIS-Desarrollo', 1, NULL, '1', '2020-09-14 15:00:00', NULL, '1'),
(17, 1, 'Operaciones', 'Operaciones', 1, NULL, '1', '2020-09-14 15:00:00', NULL, '1'),
(18, 1, 'Producción Audiovisual', 'Producción Audiovisual', 1, NULL, '1', '2020-09-14 15:00:00', NULL, '1'),
(19, 1, 'Centro de Idiomas', 'Centro de Idiomas', 1, NULL, '1', '2020-09-14 15:00:00', NULL, '1'),
(20, 1, 'Facultad de Posgrado e Investigación (Online)', 'Facultad de Posgrado e Investigación (Online)', 1, NULL, '1', '2020-09-14 15:00:00', NULL, '1'),
(21, 1, 'Auditoría de Calidad', 'Auditoría de Calidad', 1, NULL, '1', '2020-09-14 15:00:00', NULL, '1'),
(22, 1, 'Coordinación de Relaciones Internacionales', 'Coordinación de Relaciones Internacionales', 1, NULL, '1', '2020-09-14 15:00:00', NULL, '1'),
(23, 1, 'Facultad de Posgrado e Investigación (Presencial)', 'Facultad de Posgrado e Investigación (Presencial)', 1, NULL, '1', '2020-09-14 15:00:00', NULL, '1'),
(24, 1, 'Interculturalidad, diálogo de saberes y gestión ambiental', 'Interculturalidad, diálogo de saberes y gestión ambiental', 1, NULL, '1', '2020-09-14 15:00:00', NULL, '1');

-- --------------------------------------------------------
--
-- Tabla `unidad_administrativa`
--
-- --------------------------------------------------------
INSERT INTO `unidad_administrativa` (`uadm_id`, `ent_id`, `uadm_nombre`, `uadm_descripcion`, `uadm_usuario_ingreso`, `uadm_usuario_modifica`, `uadm_estado`, `uadm_fecha_creacion`, `uadm_fecha_modificacion`, `uadm_estado_logico`) VALUES
(1, 1, 'Dirección Ejecutiva', 'Dirección Ejecutiva', 1, NULL, '1', '2020-09-14 15:00:00', NULL, '1'),
(2, 1, 'Vicerrectorado Académico', 'Vicerrectorado Académico', 1, NULL, '1', '2020-09-14 15:00:00', NULL, '1');

-- --------------------------------------------------------
--
-- Tabla `responsable_subunidad`
--
-- --------------------------------------------------------
INSERT INTO `responsable_subunidad` (`rsub_id`, `sgpr_id`, `usu_id`, `emp_id`, `rsub_usuario_ingreso`, `rsub_usuario_modifica`, `rsub_estado`, `rsub_fecha_creacion`, `rsub_fecha_modificacion`, `rsub_estado_logico`) VALUES
(1, 1, 1, 1, 1, NULL, '1', '2020-09-14 15:00:00', NULL, '1');

-- --------------------------------------------------------
--
-- Tabla `responsable_administrativo`
--
-- --------------------------------------------------------
INSERT INTO `responsable_administrativo` (`radm_id`, `uadm_id`, `usu_id`, `emp_id`, `radm_usuario_ingreso`, `radm_usuario_modifica`, `radm_estado`, `radm_fecha_creacion`, `radm_fecha_modificacion`, `radm_estado_logico`) VALUES
(1, 1, 1, 1, 1, NULL, '1', '2020-09-14 15:00:00', NULL, '1');

-- --------------------------------------------------------
--
-- Tabla `planificacion_pedi`
--
-- --------------------------------------------------------
INSERT INTO `planificacion_pedi` (`pped_id`,`ent_id`, `pped_nombre`, `pped_descripcion`, `pped_fecha_inicio`, `pped_fecha_fin`, `pped_fecha_actualizacion`, `pped_estado_cierre`, `pped_usuario_ingreso`, `pped_usuario_modifica`, `pped_estado`, `pped_fecha_creacion`, `pped_fecha_modificacion`, `pped_estado_logico`) VALUES
(1, 1, 'Periodo Ene-2020 a Dic-2024', 'Periodo Ene-2020 a Dic-2024', '2020-01-01 00:00:00', '2020-12-31 00:00:00', '2020-01-01 00:00:00', '0', 1, NULL, '1', '2020-09-14 15:00:00', NULL, '1');

-- --------------------------------------------------------
--
-- Tabla `objetivo_estrategico`
--
-- --------------------------------------------------------
INSERT INTO `objetivo_estrategico` (`oest_id`, `pped_id`, `enf_id`, `cbsc_id`, `oest_nombre`, `oest_descripcion`, `oest_fecha_actualizacion`, `oest_usuario_ingreso`, `oest_usuario_modifica`, `oest_estado`, `oest_fecha_creacion`, `oest_fecha_modificacion`, `oest_estado_logico`) VALUES
(1, 1, 1, 3, 'Garantizar una oferta académica de calidad en el marco de la innovación y el emprendimiento con enfoque nacional, internacional e intercultural, sustentada en mecanismos de habilidades transferibles.', 'Garantizar una oferta académica de calidad en el marco de la innovación y el emprendimiento con enfoque nacional, internacional e intercultural, sustentada en mecanismos de habilidades transferibles.', '2020-09-14 15:00:00', 1, NULL, '1', '2020-09-14 15:00:00', NULL, '1'),
(2, 1, 1, 3, 'Generar conocimiento científico, tecnológico y humanístico a partir de la investigación, que conduzca a la difusión de soluciones prácticas e innovadoras del entorno nacional e internacional, en el marco de la interculturalidad y del diálogo de saberes.', 'Generar conocimiento científico, tecnológico y humanístico a partir de la investigación, que conduzca a la difusión de soluciones prácticas e innovadoras del entorno nacional e internacional, en el marco de la interculturalidad y del diálogo de saberes.', '2020-09-14 15:00:00', 1, NULL, '1', '2020-09-14 15:00:00', NULL, '1'),
(3, 1, 1, 3, 'Desarrollar programas y proyectos de vinculación con la sociedad, articulados a las líneas de docencia e investigación, para fomentar en los estudiantes responsabilidad y compromiso social.', 'Desarrollar programas y proyectos de vinculación con la sociedad, articulados a las líneas de docencia e investigación, para fomentar en los estudiantes responsabilidad y compromiso social.', '2020-09-14 15:00:00', 1, NULL, '1', '2020-09-14 15:00:00', NULL, '1'),
(4, 1, 1, 3, 'Potenciar la internacionalización y las alianzas de cooperación que permitan desarrollar movilidad docente y estudiantil, articulando las acciones con las funciones sustantivas.', 'Potenciar la internacionalización y las alianzas de cooperación que permitan desarrollar movilidad docente y estudiantil, articulando las acciones con las funciones sustantivas.', '2020-09-14 15:00:00', 1, NULL, '1', '2020-09-14 15:00:00', NULL, '1'),
(5, 1, 3, 4, 'Fortalecer la gestión integral de calidad con tecnología de vanguardia para garantizar servicios de excelencia a la comunidad universitaria.', 'Fortalecer la gestión integral de calidad con tecnología de vanguardia para garantizar servicios de excelencia a la comunidad universitaria.', '2020-09-14 15:00:00', 1, NULL, '1', '2020-09-14 15:00:00', NULL, '1');

-- --------------------------------------------------------
--
-- Tabla `planificacion_poa`
--
-- --------------------------------------------------------
INSERT INTO `planificacion_poa` (`ppoa_id`,`pped_id`, `ppoa_nombre`, `ppoa_descripcion`, `ppoa_fecha_inicio`, `ppoa_fecha_fin`, `ppoa_fecha_actualizacion`, `ppoa_estado_cierre`, `ppoa_usuario_ingreso`, `ppoa_usuario_modifica`, `ppoa_estado`, `ppoa_fecha_creacion`, `ppoa_fecha_modificacion`, `ppoa_estado_logico`) VALUES
(1, 1, 'Periodo Poa Ene-2020 a Dic-2020', 'Periodo Poa Ene-2020 a Dic-2020', '2020-01-01 00:00:00', '2020-12-31 00:00:00', '2020-01-01 00:00:00', '0', 1, NULL, '1', '2020-09-14 15:00:00', NULL, '1');

--
-- Base de datos: `db_academico`
--
USE `db_academico`;

-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `tipo_nivel_estudio`
--
INSERT INTO `tipo_nivel_estudio` (`tnes_id`, `tnes_nombre`, `tnes_descripcion`, `tnes_estado`, `tnes_estado_logico`) VALUES
(1, 'Medio', 'Medio', '1', '1'),
(2, 'Tercer', 'Tercer', '1', '1'),
(3, 'Cuarto', 'Cuarto', '1', '1');

-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `NIVEL_INSTRUCCION`
--
INSERT INTO `nivel_instruccion` (`nins_id`,`nins_nombre`, `nins_descripcion`,`nins_estado`,`nins_estado_logico`) VALUES
(1,'Sin estudios ','Sin estudios ','1','1'),
(2,'Primarios','Primarios','1','1'),
(3,'Secundarios','Secundarios','1','1'),
(4,'Tercer Nivel','Tercer Nivel','1','1'),
(5,'Cuarto Nivel','Cuarto Nivel','1','1');

-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `TIPO_INSTITUCION_ACA`
--
INSERT INTO `tipo_institucion_aca` (`tiac_id`,`tiac_nombre`, `tiac_descripcion`,`tiac_estado`,`tiac_estado_logico`) VALUES
(1,'Pública','Pública','1','1'),
(2,'Privada','Privada','1','1'),
(3,'Fiscomisional','Fiscomisional','1','1');


-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `FACULTAD`
--
INSERT INTO `facultad` (`fac_id`, `nint_id`, `fac_nombre`, `fac_descripcion`, `fac_estado`, `fac_estado_logico`) VALUES
(1, 1, 'Estudios Online', 'Estudios Online', '1', '1'),
(2, 1, 'Estudios Presencial', 'Estudios Presencial', '1', '1'),
(3, 1, 'Estudios Semi-Presencial a distancia', 'Estudios Semi-Presencial a distancia', '1', '1'),
(4, 2, 'Estudios Posgrado', 'Estudios Posgrado', '1', '1');

-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `CARRERA`
--
INSERT INTO `carrera` (`car_id`, `fac_id`, `car_codigo`, `car_nombre`, `car_descripcion`, `car_total_asignatura`, `car_estado_carrera`, `car_estado`, `car_estado_logico`) VALUES
(1,1,'1050-1-650311A01-1642','Economía','Economía',54,'A','1','1'),
(2,1,'1050-1-651015A01-1653','Licenciatura en Turismo','Licenciatura en Turismo',54,'A','1','1'),
(3,1,'1050-1-650414A01-1636','Licenciatura en Mercadotecnia ','Licenciatura en Mercadotecnia ',54,'A','1','1'),
(4,1,'1050-1-650412A01-1647','Licenciatura en Finanzas','Licenciatura en Finanzas',54,'A','1','1'),
(5,1,'1050-1-750413B02-4032','Licenciatura en Administración de Empresas','Licenciatura en Administración de Empresas',54,'A','1','1'),
(6,1,'1050-1-650416B01-1646','Licenciatura en Comercio Exterior','Licenciatura en Comercio Exterior',54,'A','1','1');

-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `nivel_academico`
--
 INSERT INTO `nivel_academico` (`naca_id`, `naca_nombre`, `naca_descripcion`, `naca_estado`, `naca_estado_logico`) VALUES
(1,'Nivel 0', 'Nivel 0 PreAcadémico', '1', '1');

-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `periodo_lectivo`
--
INSERT INTO `periodo_metodo_ingreso` (`pmin_id`, `pmin_anio`, `pmin_mes`, `nint_id`, `ming_id`, `pmin_codigo`, `pmin_descripcion`, `pmin_fecha_desde`, `pmin_fecha_hasta`, `pmin_usuario_ingreso`, `pmin_usuario_modifica`, `pmin_estado`, `pmin_estado_logico`) VALUES
(1, 2017, 10, 2, 1, 'CAN1017', 'Curso Admisión y Nivelación octubre 2017', '2017-10-16 00:00:00', '2017-12-08 00:00:00', 1, null, '1', '1'),
(2, 2017, 11, 2, 1, 'CAN1117', 'Curso Admisión y Nivelación noviembre 2017', '2017-12-13 00:00:00', '2018-01-05 00:00:00', 1, null, '1', '1'),
(3, 2018, 1, 2, 1, 'CAN0118', 'Curso Admisión y Nivelación enero 2018', '2018-01-15 00:00:00', '2018-03-09 00:00:00', 1, null, '1', '1'),
(4, 2018, 1, 2, 2, 'EXA0118', 'Examen de Admisión enero 2018', '2018-01-29 00:00:00', '2018-01-29 00:00:00', 1, null, '1', '1');

-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `curso`
--
INSERT INTO `curso` (`cur_id`, `pmin_id`, `cur_descripcion`, `cur_num_cupo`, `cur_num_inscritos`, `cur_usuario_ingreso`, `cur_estado`, `cur_estado_logico`) VALUES
(1, 1, '0001', 25, 8, 1, '1', '1'),
(2, 2, '0001', 25, 13, 1, '1', '1'),
(3, 3, '0001', 25, 5, 1, '1', '1'),
(4, 4, '0001', 25, 0, 1, '1', '1');

-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `area_conocimiento`
--
INSERT INTO `area_conocimiento` (`acon_id`, `acon_nombre`, `acon_descripcion`, `acon_estado`, `acon_estado_logico`) VALUES
(1, 'Programas generales', 'Descripción de área de conocimiento', '1', '1'),
(2, 'Educación', 'Descripción de área de conocimiento', '1', '1'),
(3, 'Humanidades y artes', 'Descripción de área de conocimiento', '1', '1'),
(4, 'Ciencias sociales, educación comercial y derecho', 'Descripción de área de conocimiento', '1', '1'),
(5, 'Ciencias', 'Descripción de área de conocimiento', '1', '1'),
(6, 'Ingeniería, industria y construcción', 'Descripción de área de conocimiento', '1', '1'),
(7, 'Agricultura', 'Descripción de área de conocimiento', '1', '1'),
(8, 'Salud y sociales servicios', 'Descripción de área de conocimiento', '1', '1'),
(9, 'Servicios', 'Descripción de área de conocimiento', '1', '1'),
(10, 'Sectores desconocidos no especificados', 'Descripción de área de conocimiento', '1', '1');


-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `subarea_conocimiento`
--
INSERT INTO `subarea_conocimiento` (`scon_id`, `acon_id`, `scon_nombre`, `scon_descripcion`, `scon_estado`, `scon_estado_logico`) VALUES
(1, 1, 'Programas básicos', 'Descripción de subárea de conocimiento', '1', '1'),
(2, 1, 'Programas de alfabetización y de aritmética', 'Descripción de subárea de conocimiento', '1', '1'),
(3, 1, 'Desarrollo personal', 'Descripción de subárea de conocimiento', '1', '1'),
(4, 2, 'Formación de personal docente y ciencias de la educación', 'Descripción de subárea de conocimiento', '1', '1'),
(5, 3, 'Artes', 'Descripción de subárea de conocimiento', '1', '1'),
(6, 3, 'Humanidades', 'Descripción de subárea de conocimiento', '1', '1'),
(7, 4, 'Ciencias sociales y del comportamiento', 'Descripción de subárea de conocimiento', '1', '1'),
(8, 4, 'Periodismo e información', 'Descripción de subárea de conocimiento', '1', '1'),
(9, 4, 'Educación comercial y administración', 'Descripción de subárea de conocimiento', '1', '1'),
(10, 4, 'Derecho', 'Descripción de subárea de conocimiento', '1', '1'),
(11, 5, 'Ciencias de la vida', 'Descripción de subárea de conocimiento', '1', '1'),
(12, 5, 'Ciencias físicas', 'Descripción de subárea de conocimiento', '1', '1'),
(13, 5, 'Matemáticas y estadística', 'Descripción de subárea de conocimiento', '1', '1'),
(14, 5, 'Informática', 'Descripción de subárea de conocimiento', '1', '1'),
(15, 6, 'Ingeniería y profesiones afines', 'Descripción de subárea de conocimiento', '1', '1'),
(16, 6, 'Industria y producción', 'Descripción de subárea de conocimiento', '1', '1'),
(17, 6, 'Arquitectura y construcción', 'Descripción de subárea de conocimiento', '1', '1'),
(18, 7, 'Agricultura, silvicultura y pesca', 'Descripción de subárea de conocimiento', '1', '1'),
(19, 7, 'Veterinaria', 'Descripción de subárea de conocimiento', '1', '1'),
(20, 8, 'Medicina', 'Descripción de subárea de conocimiento', '1', '1'),
(21, 8, 'Servicios sociales', 'Descripción de subárea de conocimiento', '1', '1'),
(22, 9, 'Servicios personales', 'Descripción de subárea de conocimiento', '1', '1'),
(23, 9, 'Servicios de transporte', 'Descripción de subárea de conocimiento', '1', '1'),
(24, 9, 'Protección del medio ambiente', 'Descripción de subárea de conocimiento', '1', '1'),
(25, 9, 'Servicios de seguridad', 'Descripción de subárea de conocimiento', '1', '1');












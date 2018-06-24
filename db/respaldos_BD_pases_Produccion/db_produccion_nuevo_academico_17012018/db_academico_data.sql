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
INSERT INTO `facultad` (`fac_id`, `fac_nombre`, `fac_descripcion`, `fac_estado`, `fac_estado_logico`) VALUES
(1, 'Online', 'Online', '1', '1');

-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `CARRERA`
--
INSERT INTO `carrera` (`car_id`, `fac_id`, `car_nombre`, `car_descripcion`, `car_estado`, `car_estado_logico`) VALUES
(1,1,'Economía','Economía','1','1'),
(2,1,'Licenciatura en Turismo','Licenciatura en Turismo','1','1'),
(3,1,'Licenciatura en Mercadotecnia ','Licenciatura en Mercadotecnia ','1','1'),
(4,1,'Licenciatura en Finanzas','Licenciatura en Finanzas','1','1'),
(5,1,'Licenciatura en Administración de Empresas','Licenciatura en Administración de Empresas','1','1'),
(6,1,'Licenciatura en Comercio Exterior','Licenciatura en Comercio Exterior','1','1');

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
(1, 2017, 10, 2, 1, 'CAN1017', 'Curso Admisión y Nivelación octubre 2017', '2017-10-17 00:00:00', '2017-12-08 00:00:00', 1, null, '1', '1'),
(2, 2017, 11, 2, 1, 'CAN1117', 'Curso Admisión y Nivelación noviembre 2017', '2017-12-13 00:00:00', '2018-01-05 00:00:00', 1, null, '1', '1'),
(3, 2018, 1, 2, 1, 'CAN0118', 'Curso Admisión y Nivelación enero 2018', '2018-01-15 00:00:00', '2018-03-09 00:00:00', 1, null, '1', '1'),
(4, 2018, 1, 2, 2, 'EXA0118', 'Examen de Admisión enero 2017}8', null, null, 1, null, '1', '1');

-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `curso`
--
INSERT INTO `curso` (`cur_id`, `pmin_id`, `cur_descripcion`, `cur_num_cupo`, `cur_num_inscritos`, `cur_usuario_ingreso`, `cur_estado`, `cur_estado_logico`) VALUES
(1, 1, '0001', 25, 8, 1, '1', '1'),
(2, 2, '0001', 25, 13, 1, '1', '1'),
(3, 3, '0001', 25, 5, 1, '1', '1');

-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `rol_proyecto`
--
INSERT INTO `area_conocimiento` (`acon_id`, `acon_nombre`, `acon_descripcion`, `acon_estado`, `acon_estado_logico`) VALUES
(1, 'Álgebra', 'Descripción de área de conocimiento', '1', '1'),
(2, 'Ciencias Ambientales', 'Descripción de área de conocimiento', '1', '1'),
(3, 'Ciencias de la Computación', 'Descripción de área de conocimiento', '1', '1'),
(4, 'Ciencias de la Economía', 'Descripción de área de conocimiento', '1', '1'),
(5, 'Ciencia de la Investigación', 'Descripción de área de conocimiento', '1', '1'),
(6, 'Ciencias Económicas', 'Descripción de área de conocimiento', '1', '1'),
(7, 'Ciencias Jurídicas y Derecho', 'Descripción de área de conocimiento', '1', '1'),
(8, 'Comunicación Social', 'Descripción de área de conocimiento', '1', '1'),
(9, 'Electromagnetismo', 'Descripción de área de conocimiento', '1', '1'),
(10, 'Electrónica', 'Descripción de área de conocimiento', '1', '1'),
(11, 'Ética', 'Descripción de área de conocimiento', '1', '1'),
(12, 'Filosofía - Episteme', 'Descripción de área de conocimiento', '1', '1'),
(13, 'Física', 'Descripción de área de conocimiento', '1', '1'),
(14, 'Geografía', 'Descripción de área de conocimiento', '1', '1'),
(15, 'Gestión y Administración', 'Descripción de área de conocimiento', '1', '1'),
(16, 'Historia', 'Descripción de área de conocimiento', '1', '1'),
(17, 'Historia Económica', 'Descripción de área de conocimiento', '1', '1'),
(18, 'Información y Comunicación', 'Descripción de área de conocimiento', '1', '1'),
(19, 'Lingüística', 'Descripción de área de conocimiento', '1', '1'),
(20, 'Logística y Transporte', 'Descripción de área de conocimiento', '1', '1'),
(21, 'Matemáticas', 'Descripción de área de conocimiento', '1', '1'),
(22, 'Mecatrónica', 'Descripción de área de conocimiento', '1', '1'),
(23, 'Negocios Internacionales', 'Descripción de área de conocimiento', '1', '1'),
(24, 'Prácticas Pre Profesionales', 'Descripción de área de conocimiento', '1', '1'),
(25, 'Psicología', 'Descripción de área de conocimiento', '1', '1'),
(26, 'Química', 'Descripción de área de conocimiento', '1', '1'),
(27, 'Sistemas de Comunicación', 'Descripción de área de conocimiento', '1', '1'),
(28, 'Sociología', 'Descripción de área de conocimiento', '1', '1'),
(29, 'Información y ComunicaciónTurismo', 'Descripción de área de conocimiento', '1', '1');













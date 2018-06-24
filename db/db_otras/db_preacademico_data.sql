--
-- Base de datos: `db_preacademico`
--
USE `db_preacademico`;

-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `asignatura` 
--
INSERT INTO `asignatura` (`asi_id`, `asi_codigo`, `asi_nombre`, `asi_descripcion`, `asi_estado`, `asi_estado_logico`) VALUES
(1,'001','Técnicas de Comunicación Oral','Técnicas de Comunicación Oral','1','1'),
(2,'002','Matemáticas','Matemáticas','1','1'),
(3,'003','Contabilidad','Contabilidad','1','1'),
(4,'004','Desarrollo del Pensamiento','Desarrollo del Pensamiento','1','1'),
(5,'005','Emprendimiento','Emprendimiento','1','1'),
(6,'006','Jisael','Jisael','1','1');

-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `carrera` 
--
INSERT INTO `carrera` (`car_id`, `car_nombre`, `car_descripcion`, `car_estado`, `car_estado_logico`) VALUES
(1,'Economía','Economía','1','1'),
(2,'Turismo','Turismo','1','1'),
(3,'Marketing','Marketing','1','1'),
(4,'Finanzas','Finanazas','1','1'),
(5,'Administración de Empresas','Administración de Empresas','1','1');

-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `nivel_preacademico` 
--
INSERT INTO `nivel_preacademico` (`npre_id`, `npre_nombre`, `npre_descripcion`, `npre_estado`, `npre_estado_logico`) VALUES
(1,'Nivel 0', 'Nivel 0 PreAcadémico', '1', '1');

-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `malla_preacademico` 
--
INSERT INTO `malla_preacademico` (`mpre_id`, `car_id`, `npre_id`, `mpre_codigo`, `mpre_nombre`, `mpre_descripcion`, `mpre_fechaInicio`, `mpre_fechaFin`, `mpre_estado_vigencia`, `mpre_estado`, `mpre_estado_logico`) VALUES
(1,1,1,'001','Malla Economía', 'Malla Economía', '2017-07-01', null, 'S', '1', '1'),
(2,2,1,'001','Malla Turismo', 'Malla Turismo', '2017-07-01', null, 'S', '1', '1'),
(3,3,1,'001','Malla Marketing', 'Malla Marketing', '2017-07-01', null, 'S', '1', '1'),
(4,4,1,'001','Malla Finanzas', 'Malla Finanzas', '2017-07-01', null, 'S', '1', '1'),
(5,5,1,'001','Malla Administración de Empresas', 'Malla Administración de Empresas', '2017-07-01', null, 'S', '1', '1');



-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `malla_nivel` 
--
INSERT INTO `malla_nivel` (`mniv_id`, `mpre_id`, `npre_id`, `mniv_estado`, `mniv_estado_logico`) VALUES
(1,1,1,'1','1'),
(2,2,1,'1','1'),
(3,3,1,'1','1'),
(4,4,1,'1','1'),
(5,5,1,'1','1');


-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `asignatura_malla` 
--
--
INSERT INTO `asignatura_malla` (`amal_id`, `asi_id`, `mniv_id`, `amal_estado`, `amal_estado_logico`) VALUES
(1,1,1,'1','1'),
(2,2,1,'1','1'),
(3,3,1,'1','1'),
(4,4,1,'1','1'),
(5,5,1,'1','1'),
(6,6,1,'1','1');


-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `curso` 
--
INSERT INTO `curso` (`cur_id`,`nint_id`,`cur_nombre`,`cur_descripcion`, `cur_estado_vigencia`, `cur_estado`,`cur_estado_logico`) VALUES
(1,2,'Curso On Line 1','Curso On Line 1','S','1','1'),
(2,2,'Curso On Line 2','Curso On Line 2','S','1','1'),
(3,2,'Curso On Line 3','Curso On Line 3','S','1','1');


-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `edificio` 
--
INSERT INTO `edificio` (`edi_id`, `edi_nombre`, `edi_descripcion`, `edi_estado`, `edi_estado_logico`) VALUES  
(1,'Edificio 399','Edificio 399', '1', '1'),
(2,'Edificio 501','Edificio 501', '1', '1'),
(3,'Edificio 520','Edificio 520', '1', '1'),
(4,'Edificio 610','Edificio 610', '1', '1');

-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `aula` 
--
INSERT INTO `aula` (`aul_id`, `edi_id`, `aul_nombre`, `aul_descripcion`, `aul_capacidad`, `aul_estado`, `aul_estado_logico`) VALUES
(1, 1, 'Aula 601', 'Aula 601', 30, '1', '1'),
(2, 2, 'Aula 702', 'Aula 702', 18, '1', '1'),
(3, 3, 'Aula 100', 'Aula 100', 28, '1', '1'),
(4, 4, 'Aula 508', 'Aula 508', 20, '1', '1'),
(5, 2, 'Aula 700', 'Aula 700', 24, '1', '1'),
(6, 2, 'Aula 701', 'Aula 701', 18, '1', '1'),
(7, 2, 'Aula 704', 'Aula 704', 30, '1', '1'),
(8, 1, 'Aula 602', 'Aula 602', 22, '1', '1'),
(9, 1, 'Aula 604', 'Aula 604', 30, '1', '1'),
(10, 1, 'Aula 606', 'Aula 606', 15, '1', '1'),
(11, 1, 'Aula 608', 'Aula 608', 15, '1', '1'),
(12, 4, 'Aula 500', 'Aula 500', 20, '1', '1'),
(13, 4, 'Aula 501', 'Aula 501', 24, '1', '1'),
(14, 4, 'Aula 502', 'Aula 502', 13, '1', '1'),
(15, 4, 'Aula 503', 'Aula 503', 16, '1', '1'),
(16, 4, 'Aula 504', 'Aula 504', 20, '1', '1'),
(17, 4, 'Aula 505', 'Aula 505', 16, '1', '1'),
(18, 4, 'Aula 506', 'Aula 506', 15, '1', '1'),
(19, 4, 'Aula 507', 'Aula 507', 16, '1', '1'),
(20, 4, 'Aula 509', 'Aula 509', 20, '1', '1'),
(21, 3, 'Aula 200', 'Aula 200', 24, '1', '1'),
(22, 3, 'Aula 302', 'Aula 302', 20, '1', '1'),
(23, 3, 'Aula 400', 'Aula 400', 28, '1', '1'),
(24, 3, 'Aula 401', 'Aula 401', 28, '1', '1'),
(25, 3, 'Aula 402', 'Aula 402', 42, '1', '1'),
(26, 3, 'Laboratorio 1', 'Laboratorio 1', 18, '1', '1'),
(27, 3, 'Laboratorio 2', 'Laboratorio 2', 14, '1', '1'),
(28, 3, 'Laboratorio 3', 'Laboratorio 3', 18, '1', '1'),
(29, 3, 'Telecom', 'Telecom', 12, '1', '1');

-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `docente` 
--
INSERT INTO `docente` (`doc_id`, `per_id`, `doc_estado`, `doc_estado_logico`) VALUES
(1, 11, '1','1');

-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `horario` 
--
INSERT INTO `horario` (`hor_id`, `hor_nombre`, `hor_descripcion`, `hor_estado`, `hor_estado_logico`) VALUES
(1, 'Lunes - Viernes', 'Lunes - Viernes', '1','1'),
(2, 'Sábados', 'Sábados', '1','1'),
(3, 'Online', 'Online', '1','1');

-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `curso_asignacion` 
--
INSERT INTO  `planificacion_preacademico` (`ppre_id`, `ming_id`, `car_id`, `aul_id`, `cur_id`, `doc_id`, `hor_id`, `ppre_cupo`, `ppre_hora_inicio`, `ppre_hora_fin`, `ppre_fecha_inicio`, `ppre_fecha_fin`, `ppre_estado`, `ppre_estado_logico`) VALUES
(1, 1, 1, 2, 1, 1, 3, 25, '00:00', '23:59', '2017/07/25', '2017/09/15', '1', '1'),
(2, 2, 1, 2, 1, 1, 3, 25, '17:00', '19:00', '2017/07/25', '2017/07/25', '1', '1');


-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `asignacion_preacademico` 
--
INSERT INTO `asignacion_preacademico` (`apre_id`, `ppre_id`,`asp_id`, `apre_estado`, `apre_estado_logico`) VALUES
(1, 1, 1, '1', '1'),
(2, 2, 2, '1', '1');
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
(5,1,'Licenciatura en Administración de Empresas','Licenciatura en Administración de Empresas','1','1');

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
INSERT INTO `periodo_lectivo` (`plec_id`, `plec_nombre`, `plec_descripcion`, `plec_fecha_desde`, `plec_fecha_hasta`, `plec_fecha_maxima_pago`, `plec_estado`, `plec_estado_logico`) VALUES
(1, 'Período 16-Oct-2017/08-12-2017', 'Período 16-Oct-2017/08-12-2017', '2017/10/16', '2017/12/08', '2017/10/02', '1', '1'),
(2, 'Período 10-Nov-2017', 'Período 10-Nov-2017', '2017/11/10', '2017/11/10', '2017/10/02', '1', '1');

-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `curso`
--
INSERT INTO `curso` (`cur_id`, `naca_id`, `nint_id`, `ming_id`,  `plec_id`, `cur_codigo`, `cur_nombre`, `cur_descripcion`, `cur_num_cupo`, `cur_estado_vigencia`, `cur_estado`, `cur_estado_logico`) VALUES
(1, 1, 2, 1, 1, '0001', 'Curso de Nivelación y Admisión', 'Curso de Nivelación y Admisión', 25, 'A', '1', '1'),
(2, 1, 2, 2, 2, '0002', 'Examen de Admisión', 'Examen de Admisión', 25, 'A', '1', '1');














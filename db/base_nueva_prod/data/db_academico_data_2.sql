--
-- Base de datos: `db_academico`
--
USE `db_academico`;

-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `semestre`
--
INSERT INTO `semestre` (`sem_id`, `sem_nombre`, `sem_descripcion`, `sem_fecha_registro`, `sem_usuario_ingreso`, `sem_usuario_modifica`, `sem_estado`, `sem_estado_logico`) VALUES 
(1, 'Abril - Agosto', 'Abril - Agosto', NULL, '1', '1', '1', '1'),
(2, 'Octubre - Febrero', 'Octubre - Febrero', NULL, '1', '1', '1', '1');

-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `bloque`
--
INSERT INTO `bloque` (`blo_id`,`blo_nombre`, `blo_descripcion`, `blo_usuario_ingreso`, `blo_usuario_modifica`, `blo_estado`, `blo_estado_logico`) VALUES 
(1, 'Abril - Junio', 'Abril - Junio', '1', '1', '1', '1'),
(2, 'Julio - Agosto', 'Julio - Agosto', '1', '1', '1', '1');

-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `periodo_academico`
--

INSERT INTO `periodo_academico` (`sem_id`, `blo_id`, `paca_anio_academico`, `paca_usuario_ingreso`, `paca_usuario_modifica`, `paca_estado`, `paca_estado_logico`) VALUES 
('1', '1', '2017-2018', '1', '1', '1', '1'),
('1', '2', '2017-2018', '1', '1', '1', '1'),
('2', '1', '2017-2018', '1', '1', '1', '1'),
('2', '2', '2017-2018', '1', '1', '1', '1'),
('1', '1', '2018-2019', '1', '1', '1', '1'),
('1', '2', '2018-2019', '1', '1', '1', '1'),
('2', '1', '2018-2019', '1', '1', '1', '1'),
('2', '2', '2018-2019', '1', '1', '1', '1');


-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `paralelo`
--

INSERT INTO `paralelo` (`paca_id`, `par_nombre`, `par_descripcion`, `par_usuario_ingreso`, `par_usuario_modifica`, `par_estado`, `par_estado_logico`) VALUES 
('1', '0001', '0001', '1', '1', '1', '1'),
('2', '0001', '0001', '1', '1', '1', '1'),
('3', '0001', '0001', '1', '1', '1', '1'),
('4', '0001', '0001', '1', '1', '1', '1'),
('5', '0001', '0001', '1', '1', '1', '1'),
('6', '0001', '0001', '1', '1', '1', '1'),
('7', '0001', '0001', '1', '1', '1', '1'),
('8', '0001', '0001', '1', '1', '1', '1');


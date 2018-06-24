--
-- Base de datos: `db_academico`
--
USE `db_academico` ;

GRANT ALL PRIVILEGES ON `db_academico`.* TO 'uteg'@'localhost' IDENTIFIED BY 'sistemas1707';

-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `tipo_horario`
--
INSERT INTO `tipo_horario` ( `thor_id`, `thor_nombre`, `thor_descripcion`, `thor_estado`, `thor_estado_logico`) VALUES
(1, 'Matutino', 'Matutino', '1', '1'),
(2, 'Nocturno', 'Nocturno', '1', '1'),
(3, 'Especial', 'Especial', '1', '1'),
(4, 'Clase en Vivo', 'Clase en Vivo', '1', '1');

-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `horario`
--

INSERT INTO `horario` ( `hor_id`, `thor_id`, `hor_descripcion`, `hor_inicio`, `hor_fin`, `hor_lunes`, `hor_martes`, `hor_miercoles`, `hor_jueves`, `hor_viernes`, `hor_sabado`, `hor_domingo`, `hor_rama`, `hor_usuario_ingreso`, `hor_usuario_modifica`, `hor_estado`, `hor_estado_logico` ) VALUES
(1, 1, null, '09h00 am', '11h00 am', '1', '1', null, '1', null, null, null, '1', 1, null, '1', '1'),
(2, 1, null, '11h00 am', '13h00 pm', '1', '1', null, '1', null, null, null, '1', 1, null, '1', '1'),
(3, 1, null, '09h00 am', '12h00 pm', null, null, '1', null, '1', null, null, '1', 1, null, '1', '1'),
(4, 2, null, '18h20 pm', '20h20 pm', '1', '1', null, '1', null, null, null, '1', 1, null, '1', '1'),
(5, 2, null, '20h20 pm', '22h20 pm', '1', '1', null, '1', null, null, null, '1', 1, null, '1', '1'),
(6, 2, null, '18h20 pm', '21h20 pm', null, null, '1', null, '1', null, null, '1', 1, null, '1', '1'),
(7, 1, null, '09h00 am', '15h00 pm', '1', '1', '1', '1', '1', null, null, '2', 1, null, '1', '1'),
(8, 3, null, '07h15 am', '10:15 am', null, null, null, null, null, '1', null, null, 1, null, '1', '1'),
(9, 3, null, '10h30 am', '13h30 pm', null, null, null, null, null, '1', null, null, 1, null, '1', '1'),
(10, 3, null, '14h30 pm', '17h30 pm', null, null, null, null, null, '1', null, null, 1, null, '1', '1'),
(11, 1, '2 veces al mes', '08h15 am', '10h15 am', '', '', '', '', '', '', '', '', 1, null, '1', '1'),
(12, 1, '2 veces al mes', '10h30 am', '12h30 pm', '', '', '', '', '', '', '', '', 1, null, '1', '1'),
(13, 1, '2 veces al mes', '13h30 pm', '15h30 pm', '', '', '', '', '', '', '', '', 1, null, '1', '1'),
(14, 4, '2 veces al mes', '19:00 pm', '21:00 pm', '', '', '', '', '', '', '', '', 1, null, '1', '1'),
(15, 3, '3 veces al mes, planificación de acuerdo a cada módulo, sujeto a variación', '18h00 pm', '22h00 pm', '', '', '', '', '1', '1', '', null, 1, null, '1', '1'),
(16, 1, '2 veces al mes, planificación de acuerdo a cada módulo, sujeto a variación', '08h30 am', '18h00 pm', '', '', '', '', '', '1', '1', '', 1, null, '1', '1');
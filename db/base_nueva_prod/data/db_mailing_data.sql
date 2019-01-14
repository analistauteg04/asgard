--
-- Base de datos: `db_crm`
--
USE `db_mailing`;


-- ---------------------------------------db_mailing---------------------------------------------------
--
-- Volcado de datos para la tabla `lista`
--
INSERT INTO `lista` (`lis_id`, `lis_codigo`, `eaca_id`, `mest_id`, `lis_nombre`, `lis_correo_principal`, `lis_nombre_principal`, `lis_nombre_empresa`, `lis_estado`, `lis_estado_logico`) VALUES
(1, '0056789am', 2, null, 'Economia',  'principal@yopmail.com', 'Grace Viteri', 'Cranea Prueba', '1', '1');

-- 
--
-- Volcado de datos para la tabla `suscriptor`
--
INSERT INTO `suscriptor` (`sus_id`, `per_id`, `pges_id`, `sus_estado`, `sus_estado_logico`) VALUES
(1, 1001, null, '1','1'),
(2, 1003, null, '1','1'),
(3, 1224, null, '1','1');

-- 
--
-- Volcado de datos para la tabla `lista_suscriptor`
--
INSERT INTO `lista_suscriptor` (`lsus_id`, `lis_id`, `sus_id`, `lsus_estado`, `lsus_estado_logico`) VALUES
(1, 1, 1, '1','1'),
(2, 1, 2, '1','1'),
(3, 1, 3, '0','1');


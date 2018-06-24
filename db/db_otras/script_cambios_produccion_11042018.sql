/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * Author:  giovanni
 * Created: 11/04/2018
 * OJOREVISAR LOS ID DE ESTAS TABLAS CORRESPONDIENTES A PRODUCCION QUE PUEDEN SER DEL AMBIENTE LOCAL
 */
USE db_asgard;

UPDATE `modulo` set mod_nombre = 'Académico', mod_tipo = 'Académico' WHERE mod_id = 9;

UPDATE `objeto_modulo` set omod_nombre = 'Período CAN Online', omod_accion = 'Período CAN Online' WHERE omod_id = 19

-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `objeto_modulo`
--
INSERT INTO `objeto_modulo` (`omod_id`, `mod_id`, `omod_padre_id`, `omod_nombre`, `omod_tipo`, `omod_tipo_boton`, `omod_accion`, `omod_function`, `omod_dir_imagen`, `omod_entidad`, `omod_orden`, `omod_estado_visible`, `omod_lang_file`, `omod_estado`,`omod_estado_logico`) VALUES
(37, 9, 37, 'Listar Período CAN Online', 'S', '0', 'Listar Período CAN Online', '', '', 'adminmetodoingreso/listaperiodocan', 1, '1', NULL, '1', '1');

-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `grup_obmo`
--
INSERT INTO `grup_obmo` (`gmod_id`, `gru_id`, `omod_id`,`gmod_estado` , `gmod_estado_logico`) VALUES
(74, 1, 37, '1', '1');


-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `grup_obmo_grup_rol`
--
INSERT INTO `grup_obmo_grup_rol` (`gogr_id`, `grol_id`, `gmod_id`, `gogr_estado`, `gogr_estado_logico`) VALUES
(108, 1, 74, '1', '1');
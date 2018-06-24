-- BD db_captacion en tabla pre_interesado

INSERT INTO `pre_interesado` (`pint_id`, `per_id`, `pint_estado_preinteresado`, `pint_estado`, `pint_fecha_creacion`, `pint_fecha_modificacion`, `pint_estado_logico`) VALUES
(1, 52, '1', '1', '2017-09-25 15:22:12', NULL, '1'),
(2, 53, '1', '1', '2017-09-25 20:36:14', NULL, '1'),
(3, 54, '1', '1', '2017-09-25 22:38:27', NULL, '1'),
(4, 55, '1', '1', '2017-09-26 00:23:48', NULL, '1'),
(5, 56, '0', '1', '2017-09-26 05:41:04', NULL, '1'),
(6, 57, '1', '1', '2017-09-26 19:45:21', NULL, '1');

--
-- BD db_captacion en tabla `interesado`
--

INSERT INTO `interesado` (`int_id`, `pint_id`, `int_estado_interesado`, `int_estado`, `int_fecha_creacion`, `int_fecha_modificacion`, `int_estado_logico`) VALUES
(1, 5, '1', '1', '2017-09-26 06:10:37', NULL, '1');

--
-- BD db_captacion en tabla `informacion_familia`
--

INSERT INTO `informacion_familia` (`ifam_id`, `int_id`, `nins_padre`, `nins_madre`, `ifam_miembro`, `ifam_salario`, `ifam_estado`, `ifam_fecha_creacion`, `ifam_fecha_modificacion`, `ifam_estado_logico`) VALUES
(1, 1, 3, 2, '2', '600', '1', '2017-09-26 06:10:37', NULL, '1');

--
-- BD db_captacion en tabla `info_academico`
--

INSERT INTO `info_academico` (`iaca_id`, `int_id`, `pai_id`, `pro_id`, `can_id`, `tiac_id`, `tnes_id`, `iaca_institucion`, `iaca_titulo`, `iaca_anio_grado`, `iaca_estado`, `iaca_fecha_creacion`, `iaca_fecha_modificacion`, `iaca_estado_logico`) VALUES
(1, 1, 57, 19, 189, 2, 1, 'Colegio Intisana', 'Informatica', '2011', '1', '2017-09-26 06:10:37', NULL, '1');

use db_asgard;
-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `PERSONA` revisar los ultimos ids de persona
-- este numero de cedula 0926597725 corresponde a jose guerra

INSERT INTO `persona` (`per_id`, `per_pri_nombre`, `per_seg_nombre`, `per_pri_apellido`, `per_seg_apellido`, `per_cedula`, `per_ruc`, `per_pasaporte`, `etn_id`, `eciv_id`, `per_genero`, `pai_id_nacimiento`, `pro_id_nacimiento`, `can_id_nacimiento`, `per_fecha_nacimiento`, `per_celular`, `per_correo`, `per_foto`, `tsan_id`, `per_domicilio_sector`, `per_domicilio_cpri`, `per_domicilio_csec`, `per_domicilio_num`, `per_domicilio_ref`, `per_domicilio_telefono`, `pai_id_domicilio`, `pro_id_domicilio`, `can_id_domicilio`, `per_trabajo_nombre`, `per_trabajo_direccion`, `per_trabajo_telefono`, `per_trabajo_ext`, `pai_id_trabajo`, `pro_id_trabajo`, `can_id_trabajo`, `per_estado`, `per_fecha_creacion`, `per_fecha_modificacion`, `per_estado_logico`) VALUES
(247, 'Angelyn', '', 'Sabado', '', '0912232519', NULL, NULL, 1, 1, 'M', 57, 10, 87, NULL, NULL, NULL, NULL, 7, NULL, NULL, NULL, NULL, NULL, NULL, 57, 10, 87, NULL, NULL, NULL, NULL, 57, 10, 87, '1', '2018-01-30 10:40:44', NULL, '1'),
(248, 'Miguel', '', 'Sánchez', '', '0930526694', NULL, NULL, 1, 1, 'M', 57, 10, 87, NULL, NULL, NULL, NULL, 7, NULL, NULL, NULL, NULL, NULL, NULL, 57, 10, 87, NULL, NULL, NULL, NULL, 57, 10, 87, '1', '2018-01-30 10:40:44', NULL, '1');

-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `USUARIO` revisar los ultimos ids de usuario 
--
INSERT INTO `usuario` (`usu_id`, `per_id`, `usu_user`, `usu_sha`, `usu_password`, `usu_time_pass`, `usu_session`, `usu_last_login`, `usu_link_activo`, `usu_estado`, `usu_estado_logico`) VALUES
(247, 247, 'contactcenter03@uteg.edu.ec', '60sU04pqQwiP0I5NLm0pbLFhU8x_eUJw', 'PMLFqAeA3TjsRNVHHkSrEzMwZDI4OTVlNjU1YzBjMTgxNzQ2NWM3YTQ3NTk1MjcwZWMzZjYxYThlMGFlZjgyZGQ3YzA5MjM1ZWFjMTY3MWXB0IJRlKOw/a2OCww0lEq+NsDMShqFj8ufvXsVXRlIqUwkv6yvkFcw0Y9+adGlvMMfTI/GXubd9+VqnfYSfdjl', NULL, NULL, NULL, NULL, '1', '1' ),
(248, 248, 'contactcenter02@uteg.edu.ec', '60sU04pqQwiP0I5NLm0pbLFhU8x_eUJw', 'PMLFqAeA3TjsRNVHHkSrEzMwZDI4OTVlNjU1YzBjMTgxNzQ2NWM3YTQ3NTk1MjcwZWMzZjYxYThlMGFlZjgyZGQ3YzA5MjM1ZWFjMTY3MWXB0IJRlKOw/a2OCww0lEq+NsDMShqFj8ufvXsVXRlIqUwkv6yvkFcw0Y9+adGlvMMfTI/GXubd9+VqnfYSfdjl', NULL, NULL, NULL, NULL, '1', '1' );


-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `usua_grol` revisar los ultimos ids de usuario_rol 
--

INSERT INTO `usua_grol` (`ugro_id`, `usu_id`, `grol_id`, `ugro_estado`, `ugro_estado_logico`) VALUES
(242, 247, 8, '1', '1'),
(243, 248, 8, '1', '1');

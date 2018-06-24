--
-- table `persona`
--
INSERT INTO `persona` (`per_id`, `per_pri_nombre`, `per_seg_nombre`, `per_pri_apellido`, `per_seg_apellido`, `per_cedula`, `per_ruc`, `per_pasaporte`, `etn_id`, `eciv_id`, `per_genero`, `per_nacionalidad`, `pai_id_nacimiento`, `pro_id_nacimiento`, `can_id_nacimiento`, `per_nac_ecuatoriano`, `per_fecha_nacimiento`, `per_celular`, `per_correo`, `per_foto`, `tsan_id`, `per_domicilio_sector`, `per_domicilio_cpri`, `per_domicilio_csec`, `per_domicilio_num`, `per_domicilio_ref`, `per_domicilio_telefono`, `pai_id_domicilio`, `pro_id_domicilio`, `can_id_domicilio`, `per_trabajo_nombre`, `per_trabajo_direccion`, `per_trabajo_telefono`, `per_trabajo_ext`, `pai_id_trabajo`, `pro_id_trabajo`, `can_id_trabajo`, `per_estado`, `per_fecha_creacion`, `per_fecha_modificacion`, `per_estado_logico`) VALUES
(52, 'Annie ', NULL, 'Valarezo', NULL, '0925784597', NULL, NULL, NULL, NULL, NULL, 'Ecuatoriano', 57, NULL, NULL, NULL, NULL, '0993744913', 'a.svalarezo@hotmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 57, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '2017-09-25 15:22:12', NULL, '1'),
(53, 'Gabriela', NULL, 'Espinoza', NULL, '1206600338', NULL, NULL, NULL, NULL, NULL, 'Ecuatoriano', 57, NULL, NULL, NULL, NULL, '0985778090', 'gabyestefi93@hotmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 57, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '2017-09-25 20:36:14', NULL, '1'),
(54, 'Kenya', NULL, 'Palacios', NULL, '0954598306', NULL, NULL, NULL, NULL, NULL, 'Ecuatoriano', 57, NULL, NULL, NULL, NULL, '0997869004', 'kenya.palacios@hotmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 57, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '2017-09-25 22:38:27', NULL, '1'),
(55, 'Karla', NULL, 'Armijos', NULL, '0706303534', NULL, NULL, NULL, NULL, NULL, 'Ecuatoriano', 57, NULL, NULL, NULL, NULL, '0998707068', 'carolina_hermosa24@outlook.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 57, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '2017-09-26 00:23:48', NULL, '1'),
(56, 'DarÍo', 'Javier ', 'Mendoza', 'CampaÑa', '1724456593', NULL, NULL, 4, 1, 'M', 'Ecuatoriano', 57, 17, 177, '1', '1993-07-31', '0978829052', 'dario.mendoza@outlook.com', NULL, 7, 'Cdla 21 De Abril', 'Galo Plaza Lasso', 'Av Antonio JosÉ De Sucre', '23', 'Casa De 4 Pisos Color Verde', '0300000', 57, 5, 45, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '2017-09-26 05:41:04', '2017-09-26 11:10:37', '1'),
(57, 'Lincy', NULL, 'CedeÑo', NULL, '1310378714', NULL, NULL, NULL, NULL, NULL, 'Ecuatoriano', 57, NULL, NULL, NULL, NULL, '0992924231', 'liamalarcon04@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 57, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '2017-09-26 19:45:21', NULL, '1');


--
-- table `persona_contacto`
--
INSERT INTO `persona_contacto` (`pcon_id`, `per_id`, `pcon_nombre`, `tpar_id`, `pcon_direccion`, `pcon_telefono`, `pcon_celular`, `pcon_estado`, `pcon_fecha_creacion`, `pcon_fecha_modificacion`, `pcon_estado_logico`) VALUES
(1, 56, 'SEGUNDO  MENDOZA', 5, 'SACHA 7', '', '0994812688', '1', '2017-09-26 06:10:37', NULL, '1');

--
-- table `usuario`
--
INSERT INTO `usuario` (`usu_id`, `per_id`, `usu_user`, `usu_sha`, `usu_password`, `usu_time_pass`, `usu_session`, `usu_last_login`, `usu_link_activo`, `usu_estado`, `usu_fecha_creacion`, `usu_fecha_modificacion`, `usu_estado_logico`) VALUES
(52, 52, 'a.svalarezo@hotmail.com', 'WwAF_9W0_Vo22EnQeghOSuAG5iHrCHD0', 'ne75Dt2CaImgrmNed4ePzTUzMjIyMzg3OTE3YmYwZWYxODRmOGNmNWQxM2UzYmEyMjVmNTU4ZGFkNDVhYTA0ZGI0NDhjYzIwYTdkNGJiZmIymIPw8E51c+BhnYJ5cRTl0lqbetAfuR1cfSsFa8JZ3x07EA50YvBfcpNupfNhAXYEeo4tiFbMjnSXfK5auOxT', NULL, NULL, NULL, 'https://www.uteg.edu.ec/asgard/site/activation?wg=UpixBOXRKytRXGDm67RZRR0FhSr4CsWC', '0', '2017-09-25 15:22:12', NULL, '1'),
(53, 53, 'gabyestefi93@hotmail.com', 'dFD38zgz1z3kC0h3k2MU1h6badoDAk_m', 'opvE//zYoV7tV7fy8gqlLTMwODZkYzkzZTNmYTE4ZGUzM2I3ZWMxNjIyNzQwYzRhOWJkYzM4NmM0NDljNjFhYzBlZjYyMWNlMDQzMTVjNjeJfG5npWSwCNxC8Umgg6q4HRFo+cPPgcPSmeaw5p+X0CNpzpifY9sS2FHHh8Zoqzlg7i3qUPBmNxnQmpNyVxdK', NULL, NULL, NULL, '', '1', '2017-09-25 20:48:18', NULL, '1'),
(54, 54, 'kenya.palacios@hotmail.com', 'Gsj0uLME8svufRwnTymcYQwTSMGN7LjV', 'JO9HaukqRHD6uGnoyw/QEDI1YjQ3N2E5YzAzMmZkN2UwMzZhOTdiY2MxZDUxZDZmZjVkZjdiYjFlMWVlYzBlNmMxOGRjNzA3MWI1N2RjOTbWCCARGizrGEpUWSPypFbuYYueELCZIe7UpCr6zwCpyyaU7j4X/9lhX68btQ+t/+hJh1GO8CgmByyn54L2Ot+q', NULL, NULL, NULL, '', '1', '2017-09-25 23:29:23', NULL, '1'),
(55, 55, 'Carolina_hermosa24@outlook.com', 'KwOhhNcMKZlBhmOQBiKP1973R-QzLFLj', 'Xiht4dNm87FUkpp1dZn1nGFlYWQ3OTljMjhlMTRkMTc3OGQ5M2Q2NTljZDM0Y2RjZjg1ZmFjYjIzY2VlY2FhY2YyNjQ0MjA4OWFlNWUyYzkJ5nZ1buDksRbTg6ZrFyLxjynLAnqmnId6b+1aaaUN9jAYPxfvNSEmgFHLLwdjXPgTAahL3+OiI3fQ6H7vEodx', NULL, NULL, NULL, 'https://www.uteg.edu.ec/asgard/site/activation?wg=G4lJk7tmib4ITe9oLo3jDDWZC8RuYK', '0', '2017-09-26 00:23:48', NULL, '1'),
(56, 56, 'dario.mendoza@outlook.com', 'WapDCxxZvNCJOEf_hF2Czx2tf-GA829w', 'hAvfwjKg0RgFjWhVu+EGS2FiYjNmMTI0MjY1YTUyZjdkZTAxZmM5YzU3ZDAzMWEwMWNjZmVjN2Y2Njc4M2E1MDI3NzcwZjE5MGJjMWNhOGQryQ9Jnluxf636U0P9L9tUWKWd07yTlKXtOc4qFvcK3TujJD+1HQPtxM4JiQwt7dkeGqUvsqCF+tiHvWbqL0go', NULL, NULL, NULL, '', '1', '2017-09-26 05:48:34', NULL, '1'),
(57, 57, 'Liamalarcon04@gmail.com', 'DM6u3fAsmyl5eKYa4d9AUznhXNY4ZJ0Y', 'BYp1SbLX/+VhbWitZC3Q8GI3MWU0MTMyNTliODg4N2NhYWZiMWEzZTYzNThiY2U4MzYwNGVlODMxNzY2ZmExNmQxNWVkMWExZTYyMTFiYjMutrcuGeZHhwYAGIe/Pf0B+MwnzIHHvhtCqH7tH9BaJVYInaYNAXkJ1AGwwzzwYejdZVkJEJtkovhZgfzvnf5X', NULL, NULL, NULL, '', '1', '2017-09-26 19:47:14', NULL, '1');
--
-- table `usua_grol`
--
INSERT INTO `usua_grol` (`ugro_id`, `usu_id`, `grol_id`, `ugro_estado`, `ugro_fecha_creacion`, `ugro_fecha_modificacion`, `ugro_estado_logico`) VALUES

(17, 52, 10, '1', '2017-09-25 15:22:12', NULL, '1'),
(18, 53, 10, '1', '2017-09-25 20:36:15', NULL, '1'),
(19, 54, 10, '1', '2017-09-25 22:38:27', NULL, '1'),
(20, 55, 10, '1', '2017-09-26 00:23:48', NULL, '1'),
(21, 56, 11, '1', '2017-09-26 06:10:37', NULL, '1'),
(22, 57, 10, '1', '2017-09-26 19:45:22', NULL, '1');
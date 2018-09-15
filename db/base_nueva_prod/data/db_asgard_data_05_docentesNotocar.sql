--
-- Base de datos: `db_asgard`
--
USE `db_asgard`;

INSERT INTO `persona` (`per_id`,
 `per_pri_nombre`, `per_seg_nombre`,
 `per_pri_apellido`, `per_seg_apellido`,
 `per_cedula`, `per_ruc`, `per_pasaporte`,
 `etn_id`, `eciv_id`,
 `per_genero`, `per_nacionalidad`,
 `pai_id_nacimiento`, `pro_id_nacimiento`, `can_id_nacimiento`, 
`per_nac_ecuatoriano`, `per_fecha_nacimiento`, `per_celular`, `per_correo`,
 `per_foto`, `tsan_id`, `per_domicilio_sector`, `per_domicilio_cpri`,
 `per_domicilio_csec`, `per_domicilio_num`, `per_domicilio_ref`, 
`per_domicilio_telefono`, `per_domicilio_celular2`, `pai_id_domicilio`,
 `pro_id_domicilio`, `can_id_domicilio`, `per_trabajo_nombre`, `per_trabajo_direccion`,
 `per_trabajo_telefono`, `per_trabajo_ext`, `pai_id_trabajo`,
 `pro_id_trabajo`, `can_id_trabajo`, `per_estado`,
 `per_fecha_creacion`, `per_fecha_modificacion`, `per_estado_logico`) VALUES
(500, 'Diego', 'Francisco','Aguirre', 'Gonzalez', '0703473454', NULL, NULL, 1, 1, 'M', NULL, 1, 10, 87, NULL, NULL, NULL, NULL, NULL, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 10, 87, NULL, NULL, NULL, NULL, 1, 10, 87, '1', '2024-03-17 11:50:00', NULL, '1'),
(501, 'Carlos', 'Xavier', 'Veléz', 'León', '0913898987', NULL, NULL, 1, 1, 'M', NULL, 1, 10, 87, NULL, NULL, NULL, NULL, NULL, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 10, 87, NULL, NULL, NULL, NULL, 1, 10, 87, '1', '2024-03-17 11:50:00', NULL, '1'),
(502, 'Carlos', NULL, 'Barros', 'Bastidas', '0916878150', NULL, NULL, 1, 1, 'M', NULL, 1, 10, 87, NULL, NULL, NULL, NULL, NULL, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 10, 87, NULL, NULL, NULL, NULL, 1, 10, 87, '1', '2024-03-17 11:50:00', NULL, '1'),
(503, 'Karina', NULL, 'Muñoz', 'Loor', '0924334618', NULL, NULL, 1, 1, 'F', NULL, 1, 10, 87, NULL, NULL, NULL, NULL, NULL, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 10, 87, NULL, NULL, NULL, NULL, 1, 10, 87, '1', '2024-03-17 11:50:00', NULL, '1'),
(504, 'Gustavo', NULL, 'Morán', 'Bastidas', '0914968565', NULL, NULL, 1, 1, 'M', NULL, 1, 10, 87, NULL, NULL, NULL, NULL, NULL, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 10, 87, NULL, NULL, NULL, NULL, 1, 10, 87, '1', '2024-03-17 11:50:00', NULL, '1'),
(505, 'Jorge', 'Roberto' , 'Hoyos', 'Zavala', '0910926443', NULL, NULL, 1, 1, 'M', NULL, 1, 10, 87, NULL, NULL, NULL, NULL, NULL, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 10, 87, NULL, NULL, NULL, NULL, 1, 10, 87, '1', '2024-03-17 11:50:00', NULL, '1'),
(506, 'María', 'Del Pilar' , 'Viteri', 'Vera', '0909646358', NULL, NULL, 1, 1, 'F', NULL, 1, 10, 87, NULL, NULL, NULL, NULL, NULL, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 10, 87, NULL, NULL, NULL, NULL, 1, 10, 87, '1', '2024-03-17 11:50:00', NULL, '1'),
(507, 'Sandra', NULL , 'García', 'Paredes', '0918745837', NULL, NULL, 1, 1, 'F', NULL, 1, 10, 87, NULL, NULL, NULL, NULL, NULL, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 10, 87, NULL, NULL, NULL, NULL, 1, 10, 87, '1', '2024-03-17 11:50:00', NULL, '1');

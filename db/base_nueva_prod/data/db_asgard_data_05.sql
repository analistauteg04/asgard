--
-- Base de datos: `db_asgard`
--
USE `db_asgard`;

INSERT INTO `persona` (`per_id`, `per_pri_nombre`, `per_seg_nombre`, `per_pri_apellido`, `per_seg_apellido`,
 `per_cedula`, `per_ruc`, `per_pasaporte`, `etn_id`, `eciv_id`, `per_genero`, `per_nacionalidad`,
 `pai_id_nacimiento`, `pro_id_nacimiento`, `can_id_nacimiento`, `per_nac_ecuatoriano`, `per_fecha_nacimiento`, `per_celular`, `per_correo`,
 `per_foto`, `tsan_id`, `per_domicilio_sector`, `per_domicilio_cpri`, `per_domicilio_csec`, `per_domicilio_num`, `per_domicilio_ref`, 
`per_domicilio_telefono`, `per_domicilio_celular2`, `pai_id_domicilio`, `pro_id_domicilio`, `can_id_domicilio`, `per_trabajo_nombre`, `per_trabajo_direccion`,
 `per_trabajo_telefono`, `per_trabajo_ext`, `pai_id_trabajo`, `pro_id_trabajo`, `can_id_trabajo`, `per_estado`,
 `per_fecha_creacion`, `per_fecha_modificacion`, `per_estado_logico`) VALUES
(1, 'Admin', NULL, 'UTEG', NULL, '01', NULL, NULL, 1, 1, 'M', NULL, 1, 10, 87, NULL, NULL, NULL, NULL, NULL, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 10, 87, NULL, NULL, NULL, NULL, 1, 10, 87, '1', '2024-03-17 11:50:00', NULL, '1'),
(2, 'Diana', 'Nathaly', 'López', 'Armendáriz', '0923531792', NULL, NULL, 1, 1, 'F', NULL, 1, 10, 87, NULL, NULL, NULL, NULL, NULL, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 10, 87, NULL, NULL, NULL, NULL, 1, 10, 87, '1', '2024-03-17 11:50:00', NULL, '1'),
(3, 'Grace', 'Katiuska', 'Viteri', 'Guzman', '0916704828', NULL, NULL, 1, 1, 'F', NULL, 1, 10, 87, NULL, NULL, NULL, NULL, NULL, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 10, 87, NULL, NULL, NULL, NULL, 1, 10, 87, '1', '2024-03-17 11:50:00', NULL, '1'),
(4, 'Giovanni', 'Antonio', 'Vergara', 'Zarate', '0917552564', NULL, NULL, 1, 1, 'M', NULL, 1, 10, 87, NULL, NULL, NULL, NULL, NULL, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 10, 87, NULL, NULL, NULL, NULL, 1, 10, 87, '1', '2024-03-17 11:50:00', NULL, '1'),
(5, 'Kleber', 'Andres', 'Loaiza', 'Castro', '0930628771', NULL, NULL, 1, 1, 'F', NULL, 1, 10, 87, NULL, NULL, NULL, NULL, NULL, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 10, 87, NULL, NULL, NULL, NULL, 1, 10, 87, '1', '2024-03-17 11:50:00', NULL, '1'),
(6, 'Andrea', 'Rebeca', 'Bejarano', 'Macias', '0924239494', NULL, NULL, 1, 1, 'F', 'Ecuatoriano', 57, 10, 87, '0', '1984-09-02', '992144238', 'andreita.rebe@gmail.com', '/uploads/ficha/12/doc_foto_per_12.png', 5, 'Santorini Dpto A2', 'Av Del Santuario', 'Juan Tanca Marengo', '2', 'Subiendo Hacia Jardines De La Esperanza', '6027452', NULL, 1, 10, 87, NULL, NULL, NULL, NULL, 1, 10, 87, '1', '2024-03-17 11:50:00', '2014-03-19 00:59:00', '1'),

(7, 'Admisiones', NULL, '01', NULL, '0901010101', NULL, NULL, 1, 1, 'M', NULL, 1, 10, 87, NULL, NULL, NULL, NULL, NULL, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 10, 87, NULL, NULL, NULL, NULL, 1, 10, 87, '1', '2017-05-18 23:15:00', NULL, '1'),
(8, 'Admisiones', NULL, '02', NULL, '0902020202', NULL, NULL, 1, 1, 'M', NULL, 1, 10, 87, NULL, NULL, NULL, NULL, NULL, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 10, 87, NULL, NULL, NULL, NULL, 1, 10, 87, '1', '2017-05-18 23:15:00', NULL, '1'),
(9, 'Admisiones', NULL, '03', NULL, '0903030303', NULL, NULL, 1, 1, 'M', NULL, 1, 10, 87, NULL, NULL, NULL, NULL, NULL, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 10, 87, NULL, NULL, NULL, NULL, 1, 10, 87, '1', '2017-05-18 23:15:00', NULL, '1'),
(10, 'Admisiones', NULL, '04', NULL, '0904040404', NULL, NULL, 1, 1, 'M', NULL, 1, 10, 87, NULL, NULL, NULL, NULL, NULL, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 10, 87, NULL, NULL, NULL, NULL, 1, 10, 87, '1', '2017-05-18 23:15:00', NULL, '1'),
(11, 'Admisiones', NULL, '05', NULL, '0905050505', NULL, NULL, 1, 1, 'M', NULL, 1, 10, 87, NULL, NULL, NULL, NULL, NULL, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 10, 87, NULL, NULL, NULL, NULL, 1, 10, 87, '1', '2017-05-18 23:15:00', NULL, '1'),
(12, 'Admisiones', NULL, '06', NULL, '0906060606', NULL, NULL, 1, 1, 'M', NULL, 1, 10, 87, NULL, NULL, NULL, NULL, NULL, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 10, 87, NULL, NULL, NULL, NULL, 1, 10, 87, '1', '2017-05-18 23:15:00', NULL, '1'),

(13, 'Posgrado', NULL, '01', NULL, '0907070707', NULL, NULL, 1, 1, 'M', NULL, 1, 10, 87, NULL, NULL, NULL, NULL, NULL, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 10, 87, NULL, NULL, NULL, NULL, 1, 10, 87, '1', '2017-05-18 23:15:00', NULL, '1'),
(14, 'Posgrado', NULL, '02', NULL, '0908080808', NULL, NULL, 1, 1, 'M', NULL, 1, 10, 87, NULL, NULL, NULL, NULL, NULL, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 10, 87, NULL, NULL, NULL, NULL, 1, 10, 87, '1', '2017-05-18 23:15:00', NULL, '1'),
(15, 'Posgrado', NULL, '02', NULL, '0909090909', NULL, NULL, 1, 1, 'M', NULL, 1, 10, 87, NULL, NULL, NULL, NULL, NULL, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 10, 87, NULL, NULL, NULL, NULL, 1, 10, 87, '1', '2017-05-18 23:15:00', NULL, '1'),

(16, 'Lider', 'Contact', 'Center 01', NULL, '00', NULL, NULL, 1, 1, 'M', NULL, 1, 10, 87, NULL, NULL, NULL, NULL, NULL, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 10, 87, NULL, NULL, NULL, NULL, 1, 10, 87, '1', '2024-03-17 11:50:00', NULL, '1'),
(17, 'Contact', NULL, 'Center 01', NULL, '011', NULL, NULL, 4, 1, 'M', 'Ecuatoriana', 57, 10, 87, '0', '1991-02-16', '992053611', 'contactcenter02@uteg.edu.ec', '/uploads/ficha/248/doc_foto_per_248.png', 7, 'Sur', 'Oconnor', 'Esmeraldas', '1804', 'Casa Crema', '3870735', NULL, 1, 10, 87, NULL, NULL, NULL, NULL, 1, 10, 87, '1', '2030-01-18 20:40:00', '2031-01-19 00:47:00', '1'),
(18, 'Contact', NULL, 'Center 02', NULL, '021', NULL, NULL, 1, 1, 'M', NULL, 1, 10, 87, NULL, NULL, NULL, NULL, NULL, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 10, 87, NULL, NULL, NULL, NULL, 1, 10, 87, '1', '2024-03-17 11:50:00', NULL, '1'),
(19, 'Contact', NULL, 'Center 03', NULL, '031', NULL, NULL, 4, 1, 'M', 'Ecuatoriana', 57, 10, 87, '0', '1991-02-16', '992053611', 'contactcenter02@uteg.edu.ec', '/uploads/ficha/248/doc_foto_per_248.png', 7, 'Sur', 'Oconnor', 'Esmeraldas', '1804', 'Casa Crema', '3870735', NULL, 1, 10, 87, NULL, NULL, NULL, NULL, 1, 10, 87, '1', '2030-01-18 20:40:00', '2031-01-19 00:47:00', '1'),
(20, 'Contact', NULL, 'Center 04', NULL, '041', NULL, NULL, 4, 1, 'M', 'Ecuatoriana', 57, 10, 87, '0', '1991-02-16', '992053611', 'contactcenter02@uteg.edu.ec', '/uploads/ficha/248/doc_foto_per_248.png', 7, 'Sur', 'Oconnor', 'Esmeraldas', '1804', 'Casa Crema', '3870735', NULL, 1, 10, 87, NULL, NULL, NULL, NULL, 1, 10, 87, '1', '2030-01-18 20:40:00', '2031-01-19 00:47:00', '1'),

(21, 'Supervisor', NULL, 'Colecturia', '', '051', NULL, NULL, 1, 1, 'M', NULL, 1, 10, 87, NULL, NULL, NULL, NULL, NULL, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 10, 87, NULL, NULL, NULL, NULL, 1, 10, 87, '1', '2029-01-19 03:25:00', NULL, '1'),
(22, 'Caja', NULL, '01', '', '061', NULL, NULL, 1, 1, 'M', NULL, 1, 10, 87, NULL, NULL, NULL, NULL, NULL, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 10, 87, NULL, NULL, NULL, NULL, 1, 10, 87, '1', '2029-01-19 03:25:00', NULL, '1'),

(23, 'Ana', 'María', 'Alcivar', 'Alcivar', '0923382717', NULL, NULL, 4, 2, 'F', 'Ecuatoriana', 1, 10, 87, '0', '1986-12-11', '993290038', 'aalcivar26@gmail.com', '/uploads/ficha/8/doc_foto_per_8.jpg', 7, 'Parroquia Pedro J Montero', 'Sn', 'Sn', '0', 'Sn', '2572124', NULL, 1, 10, 90, NULL, NULL, NULL, NULL, 1, 10, 87, '1', '2024-03-17 11:50:00', '2006-04-19 02:43:00', '1'),
(24, 'Xavier', 'Antonio', 'Mosquera', 'Rodríguez', '0909267338', NULL, NULL, 1, 1, 'M', NULL, 1, 10, 87, NULL, NULL, NULL, NULL, NULL, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 10, 87, NULL, NULL, NULL, NULL, 1, 10, 87, '1', '2017-05-18 23:15:00', NULL, '1'),
(25, 'Diana', 'Carolina', 'Pineda', 'Arenas', '073941725', NULL, NULL, 1, 1, 'M', NULL, 1, 10, 87, NULL, NULL, NULL, NULL, NULL, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 10, 87, NULL, NULL, NULL, NULL, 1, 10, 87, '1', '2017-05-18 23:15:00', NULL, '1'),
(26, 'Olmedo', '', 'Farfan', '', '090202020', NULL, NULL, 1, 1, 'M', NULL, 1, 10, 87, NULL, NULL, NULL, NULL, NULL, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 10, 87, NULL, NULL, NULL, NULL, 1, 10, 87, '1', '2027-03-18 20:20:00', NULL, '1'),

(27, 'Priscilla', NULL, 'Recalde', NULL, '0921156683', NULL, NULL, 1, 1, 'F', NULL, 1, 10, 87, NULL, NULL, NULL, NULL, NULL, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 10, 87, NULL, NULL, NULL, NULL, 1, 10, 87, '1', '2026-10-17 23:48:00', NULL, '1'),
(28, 'Andrés', 'Enrique', 'Hernández', 'Lavayen', '0914338793', NULL, NULL, 4, 1, 'M', 'Ecuatoriano', 1, 10, 87, '0', '1980-11-29', NULL, 'chalo_hernandez@yahoo.es', '/uploads/ficha/402/doc_foto_per_402.png', 7, 'Barrio Del Seguro', 'San Salvador', 'Chambers', '909', 'Casa Dos Pisos Verde Claro', '2449908', NULL, 1, 10, 87, NULL, NULL, NULL, NULL, 1, 10, 87, '1', '2005-04-19 00:00:00', '2009-04-18 19:34:00', '1'),
(29, 'David', 'Roberto', 'Castro', 'Rivera', '0922513619', NULL, NULL, 1, 1, 'M', NULL, 1, 10, 87, NULL, NULL, NULL, NULL, NULL, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 10, 87, NULL, NULL, NULL, NULL, 1, 10, 87, '1', '2027-03-18 20:20:00', NULL, '1'),


(30, 'Diego', 'Francisco','Aguirre', 'Gonzalez', '0703473454', NULL, NULL, 1, 1, 'M', NULL, 1, 10, 87, NULL, NULL, NULL, NULL, NULL, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 10, 87, NULL, NULL, NULL, NULL, 1, 10, 87, '1', '2024-03-17 11:50:00', NULL, '1'),
(31, 'Carlos', 'Xavier', 'Veléz', 'León', '0913898987', NULL, NULL, 1, 1, 'M', NULL, 1, 10, 87, NULL, NULL, NULL, NULL, NULL, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 10, 87, NULL, NULL, NULL, NULL, 1, 10, 87, '1', '2024-03-17 11:50:00', NULL, '1'),
(32, 'Carlos', NULL, 'Barros', 'Bastidas', '0916878150', NULL, NULL, 1, 1, 'M', NULL, 1, 10, 87, NULL, NULL, NULL, NULL, NULL, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 10, 87, NULL, NULL, NULL, NULL, 1, 10, 87, '1', '2024-03-17 11:50:00', NULL, '1'),
(33, 'Karina', NULL, 'Muñoz', 'Loor', '0924334618', NULL, NULL, 1, 1, 'F', NULL, 1, 10, 87, NULL, NULL, NULL, NULL, NULL, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 10, 87, NULL, NULL, NULL, NULL, 1, 10, 87, '1', '2024-03-17 11:50:00', NULL, '1'),
(34, 'Gustavo', NULL, 'Morán', 'Bastidas', '0914968565', NULL, NULL, 1, 1, 'M', NULL, 1, 10, 87, NULL, NULL, NULL, NULL, NULL, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 10, 87, NULL, NULL, NULL, NULL, 1, 10, 87, '1', '2024-03-17 11:50:00', NULL, '1'),
(35, 'Jorge', 'Roberto' , 'Hoyos', 'Zavala', '0910926443', NULL, NULL, 1, 1, 'M', NULL, 1, 10, 87, NULL, NULL, NULL, NULL, NULL, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 10, 87, NULL, NULL, NULL, NULL, 1, 10, 87, '1', '2024-03-17 11:50:00', NULL, '1'),
(36, 'María', 'Del Pilar' , 'Viteri', 'Vera', '0909646358', NULL, NULL, 1, 1, 'F', NULL, 1, 10, 87, NULL, NULL, NULL, NULL, NULL, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 10, 87, NULL, NULL, NULL, NULL, 1, 10, 87, '1', '2024-03-17 11:50:00', NULL, '1'),
(37, 'Sandra', NULL , 'García', 'Paredes', '0918745837', NULL, NULL, 1, 1, 'F', NULL, 1, 10, 87, NULL, NULL, NULL, NULL, NULL, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 10, 87, NULL, NULL, NULL, NULL, 1, 10, 87, '1', '2024-03-17 11:50:00', NULL, '1');

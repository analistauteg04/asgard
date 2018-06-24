USE `db_captacion`


--
-- Dumping data for table `pre_interesado`
--

INSERT INTO `pre_interesado` (`pint_id`, `per_id`, `pint_estado_preinteresado`, `pint_estado`, `pint_fecha_creacion`, `pint_fecha_modificacion`, `pint_estado_logico`) VALUES
(1, 23, '0', '1', '2017-09-26 10:41:04', NULL, '1'),
(2, 24, '0', '1', '2017-09-28 20:49:40', NULL, '1'),
(3, 25, '0', '1', '2017-09-28 23:16:44', NULL, '1'),
(4, 26, '0', '1', '2017-09-29 17:33:02', NULL, '1'),
(5, 27, '0', '1', '2017-09-30 22:32:22', NULL, '1'),
(6, 28, '0', '1', '2017-10-01 02:03:12', NULL, '1'),
(7, 29, '0', '1', '2017-10-02 16:52:40', NULL, '1'),
(8, 30, '0', '1', '2017-10-02 21:14:26', NULL, '1'),
(9, 31, '0', '1', '2017-10-03 02:01:28', NULL, '1'),
(10, 32, '0', '1', '2017-10-03 18:57:50', NULL, '1'),
(11, 33, '0', '1', '2017-10-07 11:39:20', NULL, '1'),
(12, 34, '0', '1', '2017-10-08 05:24:24', NULL, '1'),
(13, 35, '0', '1', '2017-10-08 22:05:28', NULL, '1'),
(14, 36, '0', '1', '2017-10-09 17:09:32', NULL, '1'),
(15, 37, '0', '1', '2017-10-10 03:56:04', NULL, '1'),
(16, 38, '0', '1', '2017-10-11 01:07:32', NULL, '1'),
(17, 39, '0', '1', '2017-10-11 19:54:49', NULL, '1'),
(18, 40, '0', '1', '2017-10-11 21:20:08', NULL, '1'),
(19, 41, '0', '1', '2017-10-12 01:41:35', NULL, '1'),
(20, 42, '0', '1', '2017-10-12 21:03:24', NULL, '1'),
(21, 43, '1', '1', '2017-10-13 00:52:21', NULL, '1'),
(22, 44, '1', '1', '2017-10-13 03:39:58', NULL, '1'),
(23, 45, '0', '1', '2017-10-13 04:13:19', NULL, '1'),
(24, 46, '0', '1', '2017-10-13 04:46:56', NULL, '1'),
(25, 47, '0', '1', '2017-10-13 05:04:20', NULL, '1'),
(26, 48, '1', '1', '2017-10-13 06:21:28', NULL, '1'),
(27, 49, '1', '1', '2017-10-13 15:24:44', NULL, '1'),
(28, 50, '1', '1', '2017-10-13 18:37:08', NULL, '1'),
(29, 51, '0', '1', '2017-10-13 20:35:04', NULL, '1'),
(30, 52, '1', '1', '2017-10-14 03:07:38', NULL, '1'),
(31, 53, '1', '1', '2017-10-14 13:38:12', NULL, '1'),
(32, 54, '1', '1', '2017-10-14 14:17:52', NULL, '1'),
(33, 55, '0', '1', '2017-10-14 15:42:57', NULL, '1'),
(34, 56, '1', '1', '2017-10-14 17:11:22', NULL, '1'),
(35, 57, '0', '1', '2017-10-14 19:46:10', NULL, '1'),
(36, 58, '1', '1', '2017-10-16 01:38:56', NULL, '1'),
(37, 59, '1', '1', '2017-10-16 15:13:42', NULL, '1'),
(38, 60, '0', '1', '2017-10-16 18:21:39', NULL, '1'),
(39, 61, '1', '1', '2017-10-16 18:26:12', NULL, '1'),
(40, 62, '0', '1', '2017-10-16 18:46:53', NULL, '1'),
(41, 63, '0', '1', '2017-10-16 19:21:36', NULL, '1'),
(42, 64, '1', '1', '2017-10-17 00:08:46', NULL, '1'),
(43, 65, '0', '1', '2017-10-17 02:02:02', NULL, '1'),
(44, 66, '1', '1', '2017-10-17 02:49:17', NULL, '1'),
(45, 67, '0', '1', '2017-10-17 14:56:01', NULL, '1'),
(46, 68, '0', '1', '2017-10-17 15:03:02', NULL, '1'),
(47, 69, '1', '1', '2017-10-17 20:12:53', NULL, '1');

--
-- Dumping data for table `interesado`
--

INSERT INTO `interesado` (`int_id`, `pint_id`, `int_estado_interesado`, `int_estado`, `int_fecha_creacion`, `int_fecha_modificacion`, `int_estado_logico`) VALUES
(1, 1, '1', '1', '2017-09-26 11:10:37', NULL, '1'),
(2, 2, '1', '1', '2017-09-28 20:58:39', NULL, '1'),
(3, 3, '1', '1', '2017-09-28 23:37:33', NULL, '1'),
(4, 4, '0', '1', '2017-09-30 22:14:36', '2017-10-11 01:22:45', '1'),
(5, 6, '1', '1', '2017-10-01 02:18:08', NULL, '1'),
(6, 7, '1', '1', '2017-10-03 02:26:55', NULL, '1'),
(7, 9, '0', '1', '2017-10-03 02:57:57', '2017-10-12 01:22:27', '1'),
(8, 8, '1', '1', '2017-10-03 15:28:07', NULL, '1'),
(9, 10, '1', '1', '2017-10-04 04:25:55', NULL, '1'),
(10, 11, '1', '1', '2017-10-07 11:56:15', NULL, '1'),
(11, 12, '1', '1', '2017-10-08 05:37:12', NULL, '1'),
(12, 13, '1', '1', '2017-10-09 02:58:07', NULL, '1'),
(13, 14, '1', '1', '2017-10-09 19:31:52', NULL, '1'),
(14, 15, '1', '1', '2017-10-10 04:27:46', NULL, '1'),
(15, 16, '1', '1', '2017-10-11 01:36:10', NULL, '1'),
(16, 18, '1', '1', '2017-10-11 21:34:26', NULL, '1'),
(17, 17, '1', '1', '2017-10-11 21:36:31', NULL, '1'),
(18, 19, '1', '1', '2017-10-12 01:56:41', NULL, '1'),
(19, 20, '1', '1', '2017-10-12 21:18:47', NULL, '1'),
(20, 5, '1', '1', '2017-10-12 22:26:29', NULL, '1'),
(21, 24, '1', '1', '2017-10-13 05:01:20', NULL, '1'),
(22, 25, '0', '1', '2017-10-13 05:19:49', '2017-10-13 21:14:02', '1'),
(23, 23, '1', '1', '2017-10-13 13:56:56', NULL, '1'),
(24, 29, '0', '1', '2017-10-14 01:34:34', '2017-10-14 21:23:17', '1'),
(25, 33, '0', '1', '2017-10-14 15:56:44', '2017-10-14 21:15:17', '1'),
(26, 35, '1', '1', '2017-10-14 20:31:25', NULL, '1'),
(27, 38, '1', '1', '2017-10-16 18:39:20', NULL, '1'),
(28, 40, '1', '1', '2017-10-16 19:08:20', NULL, '1'),
(29, 41, '1', '1', '2017-10-16 20:44:49', NULL, '1'),
(30, 43, '1', '1', '2017-10-17 02:15:30', NULL, '1'),
(31, 45, '1', '1', '2017-10-17 15:06:04', NULL, '1'),
(32, 46, '1', '1', '2017-10-17 15:26:41', NULL, '1');

--
-- Dumping data for table `aspirante`
--

INSERT INTO `aspirante` (`asp_id`, `int_id`, `asp_estado_aspirante`, `asp_estado`, `asp_fecha_creacion`, `asp_fecha_modificacion`, `asp_estado_logico`) VALUES
(1, 4, NULL, '1', '2017-10-10 20:22:45', NULL, '1'),
(2, 7, NULL, '1', '2017-10-11 20:22:27', NULL, '1'),
(3, 22, NULL, '1', '2017-10-13 16:14:02', NULL, '1'),
(4, 25, NULL, '1', '2017-10-14 16:15:17', NULL, '1'),
(5, 24, NULL, '1', '2017-10-14 16:23:17', NULL, '1'),
(6, 29, NULL, '1', '2017-10-16 22:03:17', NULL, '1'),
(7, 31, NULL, '1', '2017-10-17 20:53:23', NULL, '1');

--
-- Dumping data for table `nivel_interes`
--

INSERT INTO `nivel_interes` (`nint_id`, `nint_nombre`, `nint_descripcion`, `nint_estado`, `nint_fecha_creacion`, `nint_fecha_modificacion`, `nint_estado_logico`) VALUES
(1, 'Grado', 'Grado', '1', '2017-09-26 23:03:38', NULL, '1'),
(2, 'Grado Online', 'Grado Online', '1', '2017-09-26 23:03:38', NULL, '1'),
(3, 'Posgrado', 'Posgrado', '1', '2017-09-26 23:03:38', NULL, '1');

--
-- Dumping data for table `consideracion`
--

INSERT INTO `consideracion` (`con_id`, `con_nombre`, `con_descripcion`, `con_estado`, `con_fecha_creacion`, `con_fecha_modificacion`, `con_estado_logico`) VALUES
(1, 'Original escaneado a color (por ambos lados)', 'Original escaneado a color (por ambos lados)', '1', '2017-09-26 23:03:38', NULL, '1'),
(2, 'Refrendado en la parte posterior por el Ministerio de Educación del Ecuador', 'Refrendado en la parte posterior por el Ministerio de Educación del Ecuador', '1', '2017-09-26 23:03:38', NULL, '1'),
(3, 'Tamaño A4', 'Tamaño A4', '1', '2017-09-26 23:03:38', NULL, '1'),
(4, 'Legible', 'Legible', '1', '2017-09-26 23:03:38', NULL, '1'),
(5, 'Escaneado a color (por ambos lados)', 'Escaneado a color (por ambos lados)', '1', '2017-09-26 23:03:38', NULL, '1'),
(6, 'Vigente', 'Vigente', '1', '2017-09-26 23:03:38', NULL, '1'),
(7, 'Con fecha de último proceso electoral', 'Con fecha de último proceso electoral  ', '1', '2017-09-26 23:03:38', NULL, '1'),
(8, 'Tamaño carnet (283 x 378 pixeles)', 'Tamaño carnet (283 x 378 pixeles)', '1', '2017-09-26 23:03:38', NULL, '1'),
(9, 'Color', 'Color', '1', '2017-09-26 23:03:38', NULL, '1'),
(10, 'Actual', 'Actual', '1', '2017-09-26 23:03:38', NULL, '1'),
(11, 'Apostillado en la parte posterior', 'Apostillado en la parte posterior', '1', '2017-09-26 23:03:38', NULL, '1'),
(12, 'Escaneado a color (página de datos)', 'Escaneado a color (página de datos)', '1', '2017-09-26 23:03:38', NULL, '1'),
(13, 'Escaneado a color', 'Escaneado a color', '1', '2017-09-26 23:03:38', NULL, '1');

--
-- Dumping data for table `documento_adjuntar`
--

INSERT INTO `documento_adjuntar` (`dadj_id`, `dadj_nombre`, `dadj_descripcion`, `dadj_estado`, `dadj_fecha_creacion`, `dadj_fecha_modificacion`, `dadj_estado_logico`) VALUES
(1, 'Título', 'Título', '1', '2017-09-26 23:03:38', NULL, '1'),
(2, 'DNI', 'DNI', '1', '2017-09-26 23:03:38', NULL, '1'),
(3, 'Certificado de votación', 'Certificado de votación', '1', '2017-09-26 23:03:38', NULL, '1'),
(4, 'Foto', 'Foto', '1', '2017-09-26 23:03:38', NULL, '1');

--
-- Dumping data for table `consideracion_documento`
--

INSERT INTO `consideracion_documento` (`cdoc_id`, `con_id`, `dadj_id`, `cdoc_tiponacext`, `cdoc_estado`, `cdoc_fecha_creacion`, `cdoc_fecha_modificacion`, `cdoc_estado_logico`) VALUES
(1, 1, 1, 'N', '1', '2017-09-26 23:03:38', NULL, '1'),
(2, 2, 1, 'N', '1', '2017-09-26 23:03:38', NULL, '1'),
(3, 3, 1, 'N', '1', '2017-09-26 23:03:38', NULL, '1'),
(4, 4, 1, 'N', '1', '2017-09-26 23:03:38', NULL, '1'),
(5, 5, 2, 'N', '1', '2017-09-26 23:03:38', NULL, '1'),
(6, 6, 2, 'N', '1', '2017-09-26 23:03:38', NULL, '1'),
(7, 4, 2, 'N', '1', '2017-09-26 23:03:38', NULL, '1'),
(8, 13, 3, 'N', '1', '2017-09-26 23:03:38', NULL, '1'),
(9, 7, 3, 'N', '1', '2017-09-26 23:03:38', NULL, '1'),
(10, 4, 3, 'N', '1', '2017-09-26 23:03:38', NULL, '1'),
(11, 8, 4, 'N', '1', '2017-09-26 23:03:38', NULL, '1'),
(12, 9, 4, 'N', '1', '2017-09-26 23:03:38', NULL, '1'),
(13, 10, 4, 'N', '1', '2017-09-26 23:03:38', NULL, '1'),
(14, 1, 1, 'E', '1', '2017-09-26 23:03:38', NULL, '1'),
(15, 3, 1, 'E', '1', '2017-09-26 23:03:38', NULL, '1'),
(16, 11, 1, 'E', '1', '2017-09-26 23:03:38', NULL, '1'),
(17, 4, 1, 'E', '1', '2017-09-26 23:03:38', NULL, '1'),
(18, 12, 2, 'E', '1', '2017-09-26 23:03:38', NULL, '1'),
(19, 6, 2, 'E', '1', '2017-09-26 23:03:38', NULL, '1'),
(20, 4, 2, 'E', '1', '2017-09-26 23:03:38', NULL, '1'),
(21, 8, 4, 'E', '1', '2017-09-26 23:03:38', NULL, '1'),
(22, 9, 4, 'E', '1', '2017-09-26 23:03:38', NULL, '1'),
(23, 10, 4, 'E', '1', '2017-09-26 23:03:38', NULL, '1');
--
-- Dumping data for table `doc_nint_tciudadano`
--

INSERT INTO `doc_nint_tciudadano` (`dntc_id`, `tciu_id`, `nint_id`, `dadj_id`, `dntc_estado`, `dntc_fecha_creacion`, `dntc_fecha_modificacion`, `dntc_estado_logico`) VALUES
(1, 1, 1, 1, '1', '2017-09-26 23:03:38', NULL, '1'),
(2, 1, 1, 2, '1', '2017-09-26 23:03:38', NULL, '1'),
(3, 1, 1, 3, '1', '2017-09-26 23:03:38', NULL, '1'),
(4, 1, 1, 4, '1', '2017-09-26 23:03:38', NULL, '1'),
(5, 1, 2, 1, '1', '2017-09-26 23:03:38', NULL, '1'),
(6, 1, 2, 2, '1', '2017-09-26 23:03:38', NULL, '1'),
(7, 1, 2, 3, '1', '2017-09-26 23:03:38', NULL, '1'),
(8, 1, 2, 4, '1', '2017-09-26 23:03:38', NULL, '1'),
(9, 1, 3, 1, '1', '2017-09-26 23:03:38', NULL, '1'),
(10, 1, 3, 2, '1', '2017-09-26 23:03:38', NULL, '1'),
(11, 1, 3, 3, '1', '2017-09-26 23:03:38', NULL, '1'),
(12, 1, 3, 4, '1', '2017-09-26 23:03:38', NULL, '1'),
(13, 2, 1, 1, '1', '2017-09-26 23:03:38', NULL, '1'),
(14, 2, 1, 2, '1', '2017-09-26 23:03:38', NULL, '1'),
(15, 2, 1, 4, '1', '2017-09-26 23:03:38', NULL, '1'),
(16, 2, 2, 1, '1', '2017-09-26 23:03:38', NULL, '1'),
(17, 2, 2, 2, '1', '2017-09-26 23:03:38', NULL, '1'),
(18, 2, 2, 4, '1', '2017-09-26 23:03:38', NULL, '1'),
(19, 2, 3, 1, '1', '2017-09-26 23:03:38', NULL, '1'),
(20, 2, 3, 2, '1', '2017-09-26 23:03:38', NULL, '1'),
(21, 2, 3, 4, '1', '2017-09-26 23:03:38', NULL, '1');

--
-- Dumping data for table `informacion_familia`
--

INSERT INTO `informacion_familia` (`ifam_id`, `int_id`, `nins_padre`, `nins_madre`, `ifam_miembro`, `ifam_salario`, `ifam_estado`, `ifam_fecha_creacion`, `ifam_fecha_modificacion`, `ifam_estado_logico`) VALUES
(1, 1, 3, 2, '2', '600', '1', '2017-09-26 11:10:37', NULL, '1'),
(2, 3, 3, 3, '4', '400', '1', '2017-09-28 23:37:33', NULL, '1'),
(3, 4, 3, 3, '5', '2550', '1', '2017-09-30 22:14:36', NULL, '1'),
(4, 5, 3, 3, '5', '800', '1', '2017-10-01 02:18:08', NULL, '1'),
(5, 6, 4, 5, '2', '1400', '1', '2017-10-03 02:26:55', NULL, '1'),
(6, 7, 5, 5, '3', '1500', '1', '2017-10-03 02:57:57', NULL, '1'),
(7, 8, 3, 3, '2', '700', '1', '2017-10-03 15:28:07', NULL, '1'),
(8, 9, 3, 3, '5', '', '1', '2017-10-04 04:25:55', NULL, '1'),
(9, 10, 3, 3, '2', '500', '1', '2017-10-07 11:56:15', NULL, '1'),
(10, 12, 5, 5, '3', '700', '1', '2017-10-09 02:58:07', NULL, '1'),
(11, 13, 4, 4, '8', '1500', '1', '2017-10-09 19:31:52', NULL, '1'),
(12, 15, 4, 4, '5', '1000', '1', '2017-10-11 01:36:10', NULL, '1'),
(13, 16, 3, 3, '', '', '1', '2017-10-11 21:34:26', NULL, '1'),
(14, 17, 5, 4, '5', '2500', '1', '2017-10-11 21:36:31', NULL, '1'),
(15, 18, 5, 4, '5', '850', '1', '2017-10-12 01:56:42', NULL, '1'),
(16, 19, 4, 4, '5', '620', '1', '2017-10-12 21:18:47', NULL, '1'),
(17, 20, 2, 2, '04', '900', '1', '2017-10-12 22:26:29', NULL, '1'),
(18, 21, 1, 1, '8', '500', '1', '2017-10-13 05:01:20', NULL, '1'),
(19, 22, 1, 2, '3', '500', '1', '2017-10-13 05:19:49', NULL, '1'),
(20, 24, 3, 2, '4', '2000', '1', '2017-10-14 01:34:34', NULL, '1'),
(21, 25, 4, 3, '7', '1000', '1', '2017-10-14 15:56:44', NULL, '1'),
(22, 26, 4, 2, '', '', '1', '2017-10-14 20:31:25', NULL, '1'),
(23, 28, 1, 1, '4', '450', '1', '2017-10-16 19:08:20', NULL, '1'),
(24, 29, 4, 4, '7', '2500', '1', '2017-10-16 20:44:49', NULL, '1'),
(25, 30, 3, 3, '5', '1500', '1', '2017-10-17 02:15:30', NULL, '1'),
(26, 31, 3, 3, '3', '1500', '1', '2017-10-17 15:06:04', NULL, '1'),
(27, 32, 2, 2, '10', '700', '1', '2017-10-17 15:26:41', NULL, '1');
--
-- Dumping data for table `info_academico`
--

INSERT INTO `info_academico` (`iaca_id`, `int_id`, `pai_id`, `pro_id`, `can_id`, `tiac_id`, `tnes_id`, `iaca_institucion`, `iaca_titulo`, `iaca_anio_grado`, `iaca_estado`, `iaca_fecha_creacion`, `iaca_fecha_modificacion`, `iaca_estado_logico`) VALUES
(1, 1, 57, 19, 189, 2, 1, 'Colegio Intisana', 'Informatica', '2011', '1', '2017-09-26 11:10:37', NULL, '1'),
(2, 2, 57, 10, 87, 2, 1, 'Ces', 'Bachiller', '2010', '1', '2017-09-28 20:58:39', NULL, '1'),
(3, 3, 57, 10, 87, 1, 1, 'Unidad Educativa Jose Alfredo Llerena', 'Bachiller En Ciencias De Comercio Y Administracion', '2014', '1', '2017-09-28 23:37:33', NULL, '1'),
(4, 4, 57, 10, 87, 1, 1, 'Colegio Francisco De Orellana', 'Contador Bachiller', '1991', '1', '2017-09-30 22:14:36', NULL, '1'),
(5, 4, 57, 10, 87, 2, 2, 'Universidad De Guayaquil', 'No Terminado Economista', '', '1', '2017-09-30 22:14:36', NULL, '1'),
(6, 5, 57, 10, 87, 2, 1, 'Unidad Educativa Claretiana', 'Bachiller En Comercio Y Administracion', '2006', '1', '2017-10-01 02:18:08', NULL, '1'),
(7, 6, 57, 1, 1, 1, 1, 'Bachillerato', 'Bachiller', '2009', '1', '2017-10-03 02:26:55', NULL, '1'),
(8, 7, 57, 10, 87, 2, 1, 'Centro Educativo Bilingue Interamericano', 'Bachiller Ciencias Sociales', '2012', '1', '2017-10-03 02:57:57', NULL, '1'),
(9, 8, 57, 10, 87, 2, 1, 'Secundaria', 'Quibio', '2013', '1', '2017-10-03 15:28:07', NULL, '1'),
(10, 9, 57, 10, 96, 2, 1, 'Eugenio Espejo', 'Contabilidad', '2014', '1', '2017-10-04 04:25:55', NULL, '1'),
(11, 10, 57, 10, 87, 2, 1, 'Unidad Educativa Cte ', 'Bachiller En Comercio Y Administracion', '2007', '1', '2017-10-07 11:56:15', NULL, '1'),
(12, 11, 57, 10, 96, 2, 1, 'Comil 8', 'Comercio Y Administracion', '2004', '1', '2017-10-08 05:37:12', NULL, '1'),
(13, 12, 57, 8, 67, 3, 1, 'Sagrado Corazon', 'Ciencias Sociales', '2012', '1', '2017-10-09 02:58:07', NULL, '1'),
(14, 13, 57, 6, 49, 1, 1, 'Unidad Educativa Provincia De Cotopaxi', 'Bachiller En Ciencias Fisicas Y Matematicas', '2013', '1', '2017-10-09 19:31:52', NULL, '1'),
(15, 14, 57, 10, 87, 1, 1, 'Colegio Aguirre Abab', 'Bachiller Ciencia Sociales', '2010', '1', '2017-10-10 04:27:46', NULL, '1'),
(16, 14, 57, 10, 87, 1, 2, 'Facso', '', '', '1', '2017-10-10 04:27:46', NULL, '1'),
(17, 15, 57, 7, 62, 2, 1, 'Liceo Nagua', 'Sociales', '2004', '1', '2017-10-11 01:36:10', NULL, '1'),
(18, 15, 57, 7, 62, 3, 2, 'Juan Iii', 'Bioquimico', '2014', '1', '2017-10-11 01:36:10', NULL, '1'),
(19, 15, 57, 7, 62, 3, 3, 'Juan Xiii', 'Bioquimico', '2015', '1', '2017-10-11 01:36:10', NULL, '1'),
(20, 16, 57, 14, 137, 1, 1, 'Colegio Sucre', 'Bachiller ', '2014', '1', '2017-10-11 21:34:26', NULL, '1'),
(21, 17, 57, 10, 101, 1, 1, 'Colegio Mixto Fisco Misional Arsenio Lopez ', 'Bachiller En Ciencias Fisico Matematicas', '1994', '1', '2017-10-11 21:36:31', NULL, '1'),
(22, 17, 57, 10, 87, 2, 2, 'Instituto Tecnologico Liceo Cristiano', 'Tecnico En Analisis De Sistemas', '1998', '1', '2017-10-11 21:36:31', NULL, '1'),
(23, 18, 57, 10, 87, 2, 1, 'De La Providencia', 'Contador Bachiller En Ciencias De Comercio Y Administracion', '1996', '1', '2017-10-12 01:56:42', NULL, '1'),
(24, 19, 57, 14, 146, 2, 1, 'Unidad Educativa Stella Maris', 'Bachiller En Ciencias Fisicas Matematicas', '2017', '1', '2017-10-12 21:18:47', NULL, '1'),
(25, 20, 57, 10, 87, 1, 1, 'Escuela Leon Febres Cordero', 'Primaria', '1982', '1', '2017-10-12 22:26:29', NULL, '1'),
(26, 20, 57, 10, 79, 1, 2, 'Colegio 26 De Septiembre', 'Fisico Matematico', '1988', '1', '2017-10-12 22:26:29', NULL, '1'),
(27, 20, 57, 10, 87, 2, 3, 'Universidad Laica Vicente Rocafuerte', 'No', '1991', '1', '2017-10-12 22:26:29', NULL, '1'),
(28, 21, 57, 14, 152, 1, 1, 'Colegio Tecnico Uruguay', 'Contadora ', '2002', '1', '2017-10-13 05:01:20', NULL, '1'),
(29, 22, 57, 19, 189, 1, 1, 'Unidad Educativa Gran BretaÑa', 'Bachiller En Ciencias', '2014', '1', '2017-10-13 05:19:49', NULL, '1'),
(30, 23, 57, 7, 66, 1, 1, 'Colegio Nacional 26 De Noviembre', 'Quibio', '2012', '1', '2017-10-13 13:56:56', NULL, '1'),
(31, 24, 57, 19, 191, 3, 1, 'Tecnico Ecuador', 'Tecnico Mecanico Industrial', '1998', '1', '2017-10-14 01:34:34', NULL, '1'),
(32, 25, 57, 14, 152, 2, 1, 'Santa Mariana De Jesus ', 'Ciencies Generales', '2014', '1', '2017-10-14 15:56:44', NULL, '1'),
(33, 26, 57, 10, 87, 1, 1, 'Dr Carlos Cueva Tamariz ', 'Sociales', '2010', '1', '2017-10-14 20:31:25', NULL, '1'),
(34, 27, 57, 3, 28, 1, 1, 'Tomas Rendon Solano', 'Quibio', '2013', '1', '2017-10-16 18:39:20', NULL, '1'),
(35, 28, 57, 7, 62, 1, 1, 'Instituto Jose Ochoa Leon', 'Ciencias', '1999', '1', '2017-10-16 19:08:20', NULL, '1'),
(36, 29, 57, 14, 146, 3, 1, 'Unidad Educativa Salesiana San Jose', 'Bachiller En Ciencias', '2004', '1', '2017-10-16 20:44:49', NULL, '1'),
(37, 30, 57, 19, 189, 2, 1, 'San Pedro Pascual', 'Bachiller Fisico Matematico', '1993', '1', '2017-10-17 02:15:30', NULL, '1'),
(38, 31, 57, 10, 87, 1, 1, 'Colegio Dr Jorge Carrera Andrade', 'Contador Bachiller', '2011', '1', '2017-10-17 15:06:04', NULL, '1'),
(39, 32, 57, 10, 85, 1, 1, 'Colegio Fiscal Catalina Cadena Miranda', 'Comercio Y Administracion', '2010', '1', '2017-10-17 15:26:41', NULL, '1');

--
-- Dumping data for table `info_discapacidad`
--

INSERT INTO `info_discapacidad` (`idis_id`, `int_id`, `tdis_id`, `idis_discapacidad`, `idis_porcentaje`, `idis_archivo`, `idis_estado`, `idis_fecha_creacion`, `idis_fecha_modificacion`, `idis_estado_logico`) VALUES
(1, 25, 1, '1', '80', '', '1', '2017-10-14 15:56:44', NULL, '1');


INSERT INTO `info_familia_discapacidad` (`ifdis_id`, `int_id`, `tpar_id`, `tdis_id`, `ifdi_discapacidad`, `ifdi_porcentaje`, `ifdi_archivo`, `ifdi_estado`, `ifdi_fecha_creacion`, `ifdi_fecha_modificacion`, `ifdi_estado_logico`) VALUES
(1, 14, 6, 6, '1', '75', '', '1', '2017-10-10 04:27:46', NULL, '1'),
(2, 19, 9, 3, '1', '75', '', '1', '2017-10-12 21:18:47', NULL, '1'),
(3, 22, 6, 2, '1', '38', '', '1', '2017-10-13 05:19:49', NULL, '1'),
(4, 25, 8, 1, '1', '80', '', '1', '2017-10-14 15:56:44', NULL, '1');

--
-- Dumping data for table `info_familia_enfermedad`
--

INSERT INTO `info_familia_enfermedad` (`ifen_id`, `int_id`, `tpar_id`, `ifen_enfermedad`, `ifen_tipoenfermedad`, `ifen_archivo`, `ifen_estado`, `ifen_fecha_creacion`, `ifen_fecha_modificacion`, `ifen_estado_logico`) VALUES
(1, 25, 8, '1', '1', '', '1', '2017-10-14 15:56:44', NULL, '1');


--
-- Dumping data for table `interesado_ejecutivo`
--

INSERT INTO `interesado_ejecutivo` (`ieje_id`, `pint_id`, `int_id`, `asp_id`, `per_id`, `ieje_estado`, `ieje_fecha_creacion`, `ieje_fecha_modificacion`, `ieje_estado_logico`) VALUES
(1, 1, 1, NULL, 18, '1', '2017-09-26 18:28:33', NULL, '1'),
(2, 3, 3, NULL, 19, '1', '2017-09-29 00:40:48', NULL, '1'),
(3, 4, 4, NULL, 16, '1', '2017-09-29 17:41:46', NULL, '1'),
(4, 2, 2, NULL, 15, '1', '2017-09-29 17:42:11', NULL, '1'),
(5, 6, 5, NULL, 13, '1', '2017-10-02 14:58:54', NULL, '1'),
(6, 5, NULL, NULL, 18, '1', '2017-10-02 23:03:49', NULL, '1'),
(7, 8, NULL, NULL, 18, '1', '2017-10-02 23:32:58', NULL, '1'),
(8, 7, NULL, NULL, 18, '1', '2017-10-02 23:34:16', NULL, '1'),
(9, 9, 7, NULL, 13, '1', '2017-10-03 17:05:13', NULL, '1'),
(10, 10, NULL, NULL, 16, '1', '2017-10-03 22:29:29', NULL, '1'),
(11, 11, 10, NULL, 19, '1', '2017-10-08 14:51:35', NULL, '1'),
(12, 12, 11, NULL, 16, '1', '2017-10-10 13:45:20', NULL, '1'),
(13, 13, 12, NULL, 18, '1', '2017-10-10 14:44:20', NULL, '1'),
(14, 14, 13, NULL, 18, '1', '2017-10-10 14:48:09', NULL, '1'),
(15, 15, 14, NULL, 18, '1', '2017-10-10 14:48:30', NULL, '1'),
(16, 16, 15, NULL, 15, '1', '2017-10-11 13:55:42', NULL, '1'),
(17, 17, NULL, NULL, 16, '1', '2017-10-11 20:43:34', NULL, '1'),
(18, 18, 16, NULL, 16, '1', '2017-10-11 22:28:19', NULL, '1'),
(19, 19, 18, NULL, 19, '1', '2017-10-12 13:54:32', NULL, '1'),
(20, 20, NULL, NULL, 18, '1', '2017-10-12 21:10:16', NULL, '1'),
(21, 25, 22, NULL, 19, '1', '2017-10-13 15:52:02', NULL, '1'),
(22, 24, 21, NULL, 15, '1', '2017-10-13 15:52:33', NULL, '1'),
(23, 23, 23, NULL, 15, '1', '2017-10-13 15:52:50', NULL, '1'),
(24, 26, NULL, NULL, 13, '1', '2017-10-13 15:53:17', NULL, '1'),
(25, 22, NULL, NULL, 16, '1', '2017-10-13 16:00:58', NULL, '1'),
(26, 21, NULL, NULL, 18, '1', '2017-10-13 16:01:13', NULL, '1'),
(27, 27, NULL, NULL, 19, '1', '2017-10-13 21:19:03', NULL, '1'),
(28, 28, NULL, NULL, 19, '1', '2017-10-13 21:19:13', NULL, '1'),
(29, 29, NULL, NULL, 16, '1', '2017-10-13 21:19:28', NULL, '1'),
(30, 30, NULL, NULL, 18, '1', '2017-10-14 14:37:49', NULL, '1'),
(31, 31, NULL, NULL, 18, '1', '2017-10-14 14:38:17', NULL, '1'),
(32, 32, NULL, NULL, 19, '1', '2017-10-14 14:42:54', NULL, '1'),
(33, 33, NULL, NULL, 19, '1', '2017-10-14 15:44:01', NULL, '1'),
(34, 36, NULL, NULL, 19, '1', '2017-10-16 13:39:49', NULL, '1'),
(35, 35, 26, NULL, 19, '1', '2017-10-16 13:40:12', NULL, '1'),
(36, 34, NULL, NULL, 19, '1', '2017-10-16 13:40:26', NULL, '1'),
(37, 37, NULL, NULL, 18, '1', '2017-10-16 18:31:39', NULL, '1'),
(38, 38, 27, NULL, 16, '1', '2017-10-16 18:41:14', NULL, '1'),
(39, 39, NULL, NULL, 16, '1', '2017-10-16 18:50:06', NULL, '1'),
(40, 40, NULL, NULL, 18, '1', '2017-10-16 19:00:09', NULL, '1'),
(41, 41, 29, NULL, 16, '1', '2017-10-16 21:05:13', NULL, '1'),
(42, 43, 30, NULL, 15, '1', '2017-10-17 03:28:25', NULL, '1'),
(43, 42, NULL, NULL, 15, '1', '2017-10-17 03:28:39', NULL, '1'),
(44, 44, NULL, NULL, 15, '1', '2017-10-17 03:28:52', NULL, '1'),
(45, 45, 31, NULL, 15, '1', '2017-10-17 15:10:33', NULL, '1'),
(46, 46, NULL, NULL, 15, '1', '2017-10-17 15:18:53', NULL, '1');
--
-- Dumping data for table `medio_publicitario`
--

INSERT INTO `medio_publicitario` (`mpub_id`, `mpub_nombre`, `mpub_descripcion`, `mpub_estado`, `mpub_fecha_creacion`, `mpub_fecha_modificacion`, `mpub_estado_logico`) VALUES
(1, 'Redes sociales', 'Redes sociales', '1', '2017-09-26 23:03:38', NULL, '1'),
(2, 'Whatsapp', 'Whatsapp', '1', '2017-09-26 23:03:38', NULL, '1'),
(3, 'Charla', 'Charla', '1', '2017-09-26 23:03:38', NULL, '1'),
(4, 'Feria', 'Feria', '1', '2017-09-26 23:03:38', NULL, '1'),
(5, 'Eventos', 'Eventos', '1', '2017-09-26 23:03:38', NULL, '1'),
(6, 'Visita a empresa', 'Visita a empresa', '1', '2017-09-26 23:03:38', NULL, '1'),
(7, 'Valla', 'Valla', '1', '2017-09-26 23:03:38', NULL, '1'),
(8, 'Televisión', 'Televisión', '1', '2017-09-26 23:03:38', NULL, '1'),
(9, 'Radio', 'Radio', '1', '2017-09-26 23:03:38', NULL, '1'),
(10, 'Periódico', 'Periódico', '1', '2017-09-26 23:03:38', NULL, '1'),
(11, 'Revista', 'Revista', '1', '2017-09-26 23:03:38', NULL, '1'),
(12, 'Insertos en estados de cuenta', 'Insertos en estados de cuenta', '1', '2017-09-26 23:03:38', NULL, '1'),
(13, 'SMS', 'SMS', '1', '2017-09-26 23:03:38', NULL, '1'),
(14, 'Sitio web', 'Sitio web', '1', '2017-09-26 23:03:38', NULL, '1');

--
-- Dumping data for table `metodo_ingreso`
--

INSERT INTO `metodo_ingreso` (`ming_id`, `ming_nombre`, `ming_descripcion`, `ming_estado`, `ming_fecha_creacion`, `ming_fecha_modificacion`, `ming_estado_logico`) VALUES
(1, 'Curso de nivelación y admisión', 'Curso de admisión y nivelación', '1', '2017-09-26 23:03:38', NULL, '1'),
(2, 'Examen de admisión', 'Examen de admisión', '1', '2017-09-26 23:03:38', NULL, '1'),
(3, 'Homologación', 'Homologación', '0', '2017-09-26 23:03:38', NULL, '1'),
(4, 'Propedéutico', 'Propedéutico', '0', '2017-09-26 23:03:38', NULL, '1');

--
-- Dumping data for table `nivelint_metodo`
--

INSERT INTO `nivelint_metodo` (`nmet_id`, `nint_id`, `ming_id`, `nmet_estado`, `nmet_fecha_creacion`, `nmet_fecha_modificacion`, `nmet_estado_logico`) VALUES
(1, 1, 1, '1', '2017-09-26 23:03:38', NULL, '1'),
(2, 1, 2, '1', '2017-09-26 23:03:38', NULL, '1'),
(3, 1, 3, '1', '2017-09-26 23:03:38', NULL, '1'),
(4, 2, 1, '1', '2017-09-26 23:03:38', NULL, '1'),
(5, 2, 2, '1', '2017-09-26 23:03:38', NULL, '1'),
(6, 3, 3, '1', '2017-09-26 23:03:38', NULL, '1'),
(7, 3, 4, '1', '2017-09-26 23:03:38', NULL, '1');


--
-- Dumping data for table `res_sol_inscripcion`
--

INSERT INTO `res_sol_inscripcion` (`rsin_id`, `rsin_nombre`, `rsin_descripcion`, `rsin_estado`, `rsin_fecha_creacion`, `rsin_fecha_modificacion`, `rsin_estado_logico`) VALUES
(1, 'Pendiente', 'Pendiente', '1', '2017-09-26 23:03:38', NULL, '1'),
(2, 'Aprobado', 'Aprobado', '1', '2017-09-26 23:03:38', NULL, '1'),
(3, 'Pre Aprobado', 'Pre Aprobado', '1', '2017-09-26 23:03:38', NULL, '1'),
(4, 'No Aprobado', 'No Aprobado', '1', '2017-09-26 23:03:38', NULL, '1');

--
-- Dumping data for table `solicitud_inscripcion`
--

INSERT INTO `solicitud_inscripcion` (`sins_id`, `int_id`, `nint_id`, `ming_id`, `car_id`, `rsin_id`, `sins_fecha_solicitud`, `sins_fecha_preaprobacion`, `sins_fecha_aprobacion`, `sins_fecha_reprobacion`, `sins_fecha_prenoprobacion`, `sins_preobservacion`, `sins_observacion`, `sins_usuario_preaprueba`, `sins_usuario_aprueba`, `sins_estado`, `sins_fecha_creacion`, `sins_fecha_modificacion`, `sins_estado_logico`) VALUES
(1, 4, 2, 1, 1, 2, '2017-09-30 05:00:00', '2017-10-03 02:19:38', '2017-10-03 03:57:02', NULL, NULL, '', '', 16, 11, '1', '2017-09-30 22:33:10', '2017-10-03 03:57:02', '1'),
(2, 7, 2, 1, 5, 2, '2017-10-03 05:00:00', '2017-10-04 21:26:26', '2017-10-04 21:34:18', NULL, NULL, '', '', 13, 12, '1', '2017-10-03 03:20:33', '2017-10-04 21:34:18', '1'),
(3, 5, 2, 1, 5, 2, '2017-10-04 05:00:00', '2017-10-06 19:16:45', '2017-10-10 21:11:37', NULL, NULL, '', '', 13, NULL, '1', '2017-10-04 21:28:48', '2017-10-10 21:11:37', '1'),
(4, 13, 2, 1, 1, 4, '2017-10-10 23:23:38', NULL, NULL, '2017-10-11 02:32:31', '2017-10-11 00:51:51', 'No Cumple Condiciones De Aceptación En Título:<br/>no Cumple Condiciones De Aceptación En Documento De Identidad:', 'No Cumple Condiciones De Aceptación En Título:<br/>no Cumple Condiciones De Aceptación En Documento De Identidad:', 18, 11, '1', '2017-10-10 18:23:38', '2017-10-11 02:32:31', '1'),
(5, 17, 2, 1, 5, 4, '2017-10-12 02:50:06', '2017-10-12 02:55:15', NULL, '2017-10-12 03:12:53', NULL, '', 'No Cumple Condiciones De Aceptación En Título:<br/>no Cumple Condiciones De Aceptación En Documento De Identidad:', 16, 12, '1', '2017-10-11 21:50:06', '2017-10-12 03:12:53', '1'),
(6, 13, 2, 1, 1, 2, '2017-10-12 03:09:33', '2017-10-12 03:21:51', '2017-10-12 03:22:51', NULL, NULL, '', '', 18, 12, '1', '2017-10-11 22:09:33', '2017-10-12 03:22:51', '1'),
(7, 17, 2, 1, 5, 4, '2017-10-12 03:43:22', NULL, NULL, '2017-10-17 02:49:47', '2017-10-13 00:08:14', 'Undefined<br/>no Cumple Condiciones De Aceptación En Documento De Identidad:', 'No Cumple Condiciones De Aceptación En Título:<br/>no Cumple Condiciones De Aceptación En Documento De Identidad:', 16, 11, '1', '2017-10-11 22:43:22', '2017-10-17 02:49:47', '1'),
(8, 18, 2, 1, 1, 4, '2017-10-12 07:07:25', NULL, NULL, '2017-10-12 22:25:01', '2017-10-12 22:24:26', 'No Cumple Condiciones De Aceptación En Título:<br/>no Cumple Condiciones De Aceptación En Documento De Identidad:', 'No Cumple Condiciones De Aceptación En Título:<br/>no Cumple Condiciones De Aceptación En Documento De Identidad:', 19, 11, '1', '2017-10-12 02:07:25', '2017-10-12 22:25:01', '1'),
(9, 20, 2, 1, 4, 2, '2017-10-13 08:33:50', '2017-10-13 20:25:03', '2017-10-13 20:56:35', NULL, NULL, '', '', 18, 12, '1', '2017-10-13 03:33:50', '2017-10-13 20:56:35', '1'),
(10, 22, 2, 1, 1, 2, '2017-10-13 20:34:23', '2017-10-13 20:59:40', '2017-10-13 21:00:05', NULL, NULL, '', '', 19, 12, '1', '2017-10-13 15:34:23', '2017-10-13 21:00:05', '1'),
(11, 24, 2, 1, 5, 2, '2017-10-14 20:58:22', '2017-10-14 21:21:06', '2017-10-14 21:21:25', NULL, NULL, '', '', 13, 12, '1', '2017-10-14 15:58:22', '2017-10-14 21:21:25', '1'),
(12, 25, 2, 1, 1, 2, '2017-10-14 21:03:05', '2017-10-14 21:04:31', '2017-10-14 21:08:58', NULL, NULL, '', '', 19, 12, '1', '2017-10-14 16:03:05', '2017-10-14 21:08:58', '1'),
(13, 26, 2, 1, 5, 4, '2017-10-15 02:07:54', NULL, NULL, '2017-10-16 20:06:39', '2017-10-16 20:02:22', 'Undefined<br/>no Cumple Condiciones De Aceptación En Documento De Identidad:', 'Undefined<br/>no Cumple Condiciones De Aceptación En Documento De Identidad:', 19, 11, '1', '2017-10-14 21:07:54', '2017-10-16 20:06:39', '1'),
(14, 29, 2, 1, 5, 2, '2017-10-17 02:13:24', '2017-10-17 02:45:04', '2017-10-17 02:47:34', NULL, NULL, '', '', 16, 11, '1', '2017-10-16 21:13:24', '2017-10-17 02:47:34', '1'),
(15, 26, 2, 1, 5, 2, '2017-10-17 03:28:06', '2017-10-17 03:46:02', '2017-10-17 03:46:24', NULL, NULL, '', '', 19, 12, '1', '2017-10-16 22:28:06', '2017-10-17 03:46:24', '1'),
(16, 31, 2, 1, 4, 2, '2017-10-17 20:32:37', '2017-10-17 21:26:11', '2017-10-17 21:36:04', NULL, NULL, '', '', 15, 11, '1', '2017-10-17 15:32:37', '2017-10-17 21:36:04', '1'),
(17, 32, 2, 1, 1, 3, '2017-10-18 00:49:56', '2017-10-18 02:39:32', NULL, NULL, NULL, '', '', 13, NULL, '1', '2017-10-17 19:49:56', '2017-10-18 02:39:32', '1');

--
-- Dumping data for table `solicitudins_documento`
--

INSERT INTO `solicitudins_documento` (`sdoc_id`, `sins_id`, `int_id`, `dadj_id`, `sdoc_archivo`, `sdoc_estado`, `sdoc_fecha_creacion`, `sdoc_fecha_modificacion`, `sdoc_estado_logico`) VALUES
(1, 1, 4, 1, '/uploads/solicitudinscripcion/26/doc_dni_per_26.png', '1', '2017-09-30 22:33:10', NULL, '1'),
(2, 1, 4, 2, '/uploads/solicitudinscripcion/26/doc_foto_per_26.png', '1', '2017-09-30 22:33:10', NULL, '1'),
(3, 1, 4, 4, '/uploads/solicitudinscripcion/26/doc_certvota_per_26.png', '1', '2017-09-30 22:33:10', NULL, '1'),
(4, 1, 4, 3, '/uploads/solicitudinscripcion/31/doc_titulo_per_31.jpg', '1', '2017-09-30 22:33:10', NULL, '1'),
(5, 2, 7, 1, '/uploads/solicitudinscripcion/31/doc_dni_per_31.pdf', '1', '2017-10-03 03:20:33', NULL, '1'),
(6, 2, 7, 2, '/uploads/solicitudinscripcion/31/doc_foto_per_31.jpg', '1', '2017-10-03 03:20:33', NULL, '1'),
(7, 2, 7, 4, '/uploads/solicitudinscripcion/31/doc_certvota_per_31.pdf', '1', '2017-10-03 03:20:33', NULL, '1'),
(8, 2, 7, 3, '/uploads/solicitudinscripcion/28/doc_titulo_per_28.pdf', '1', '2017-10-03 03:20:33', NULL, '1'),
(9, 3, 5, 1, '/uploads/solicitudinscripcion/28/doc_dni_per_28.pdf', '1', '2017-10-04 21:28:48', NULL, '1'),
(10, 3, 5, 2, '/uploads/solicitudinscripcion/28/doc_foto_per_28.docx', '1', '2017-10-04 21:28:48', NULL, '1'),
(11, 3, 5, 4, '/uploads/solicitudinscripcion/28/doc_certvota_per_28.pdf', '1', '2017-10-04 21:28:48', NULL, '1'),
(12, 3, 5, 3, '/uploads/solicitudinscripcion/36/doc_titulo_per_36.pdf', '1', '2017-10-04 21:28:48', NULL, '1'),
(13, 4, 13, 1, '/uploads/solicitudinscripcion/36/doc_dni_per_36.docx', '1', '2017-10-10 18:23:38', NULL, '1'),
(14, 4, 13, 2, '/uploads/solicitudinscripcion/36/doc_foto_per_36.jpg', '1', '2017-10-10 18:23:38', NULL, '1'),
(15, 4, 13, 4, '/uploads/solicitudinscripcion/36/doc_certvota_per_36.jpg', '1', '2017-10-10 18:23:38', NULL, '1'),
(16, 4, 13, 3, '/uploads/solicitudinscripcion/39/doc_titulo_per_39.pdf', '1', '2017-10-10 18:23:38', NULL, '1'),
(17, 5, 17, 1, '/uploads/solicitudinscripcion/39/doc_dni_per_39.bmp', '1', '2017-10-11 21:50:06', NULL, '1'),
(18, 5, 17, 2, '/uploads/solicitudinscripcion/39/doc_foto_per_39.pdf', '1', '2017-10-11 21:50:06', NULL, '1'),
(19, 5, 17, 4, '/uploads/solicitudinscripcion/39/doc_certvota_per_39.pdf', '1', '2017-10-11 21:50:06', NULL, '1'),
(20, 5, 17, 3, '/uploads/solicitudinscripcion/36/doc_titulo_per_36.pdf', '1', '2017-10-11 21:50:06', NULL, '1'),
(21, 6, 13, 1, '/uploads/solicitudinscripcion/36/doc_dni_per_36.pdf', '1', '2017-10-11 22:09:33', NULL, '1'),
(22, 6, 13, 2, '/uploads/solicitudinscripcion/36/doc_foto_per_36.jpg', '1', '2017-10-11 22:09:33', NULL, '1'),
(23, 6, 13, 4, '/uploads/solicitudinscripcion/36/doc_certvota_per_36.jpg', '1', '2017-10-11 22:09:33', NULL, '1'),
(24, 6, 13, 3, '/uploads/solicitudinscripcion/39/doc_titulo_per_39.docx', '1', '2017-10-11 22:09:33', NULL, '1'),
(25, 7, 17, 1, '/uploads/solicitudinscripcion/39/doc_dni_per_39.docx', '1', '2017-10-11 22:43:23', NULL, '1'),
(26, 7, 17, 2, '/uploads/solicitudinscripcion/39/doc_foto_per_39.docx', '1', '2017-10-11 22:43:23', NULL, '1'),
(27, 7, 17, 4, '/uploads/solicitudinscripcion/39/doc_certvota_per_39.docx', '1', '2017-10-11 22:43:23', NULL, '1'),
(28, 7, 17, 3, '/uploads/solicitudinscripcion/41/doc_titulo_per_41.jpg', '1', '2017-10-11 22:43:23', NULL, '1'),
(29, 8, 18, 1, '/uploads/solicitudinscripcion/41/doc_dni_per_41.jpg', '1', '2017-10-12 02:07:25', NULL, '1'),
(30, 8, 18, 2, '/uploads/solicitudinscripcion/41/doc_foto_per_41.jpg', '1', '2017-10-12 02:07:25', NULL, '1'),
(31, 8, 18, 4, '/uploads/solicitudinscripcion/41/doc_certvota_per_41.jpg', '1', '2017-10-12 02:07:25', NULL, '1'),
(32, 8, 18, 3, '/uploads/solicitudinscripcion/27/doc_titulo_per_27.jpg', '1', '2017-10-12 02:07:25', NULL, '1'),
(33, 9, 20, 1, '/uploads/solicitudinscripcion/27/doc_dni_per_27.jpg', '1', '2017-10-13 03:33:50', NULL, '1'),
(34, 9, 20, 2, '/uploads/solicitudinscripcion/27/doc_foto_per_27.jpg', '1', '2017-10-13 03:33:50', NULL, '1'),
(35, 9, 20, 4, '/uploads/solicitudinscripcion/27/doc_certvota_per_27.jpg', '1', '2017-10-13 03:33:50', NULL, '1'),
(36, 9, 20, 3, '/uploads/solicitudinscripcion/47/doc_titulo_per_47.pdf', '1', '2017-10-13 03:33:50', NULL, '1'),
(37, 10, 22, 1, '/uploads/solicitudinscripcion/47/doc_dni_per_47.pdf', '1', '2017-10-13 15:34:23', NULL, '1'),
(38, 10, 22, 2, '/uploads/solicitudinscripcion/47/doc_foto_per_47.jpg', '1', '2017-10-13 15:34:23', NULL, '1'),
(39, 10, 22, 4, '/uploads/solicitudinscripcion/47/doc_certvota_per_47.jpg', '1', '2017-10-13 15:34:23', NULL, '1'),
(40, 10, 22, 3, '/uploads/solicitudinscripcion/51/doc_titulo_per_51.pdf', '1', '2017-10-13 15:34:23', NULL, '1'),
(41, 11, 24, 1, '/uploads/solicitudinscripcion/51/doc_dni_per_51.pdf', '1', '2017-10-14 15:58:22', NULL, '1'),
(42, 11, 24, 2, '/uploads/solicitudinscripcion/51/doc_foto_per_51.pdf', '1', '2017-10-14 15:58:22', NULL, '1'),
(43, 11, 24, 4, '/uploads/solicitudinscripcion/51/doc_certvota_per_51.pdf', '1', '2017-10-14 15:58:22', NULL, '1'),
(44, 11, 24, 3, '/uploads/solicitudinscripcion/55/doc_titulo_per_55.pdf', '1', '2017-10-14 15:58:22', NULL, '1'),
(45, 12, 25, 1, '/uploads/solicitudinscripcion/55/doc_dni_per_55.pdf', '1', '2017-10-14 16:03:05', NULL, '1'),
(46, 12, 25, 2, '/uploads/solicitudinscripcion/55/doc_foto_per_55.jpg', '1', '2017-10-14 16:03:05', NULL, '1'),
(47, 12, 25, 4, '/uploads/solicitudinscripcion/55/doc_certvota_per_55.pdf', '1', '2017-10-14 16:03:05', NULL, '1'),
(48, 12, 25, 3, '/uploads/solicitudinscripcion/57/doc_titulo_per_57.jpg', '1', '2017-10-14 16:03:05', NULL, '1'),
(49, 13, 26, 1, '/uploads/solicitudinscripcion/57/doc_dni_per_57.jpg', '1', '2017-10-14 21:07:54', NULL, '1'),
(50, 13, 26, 2, '/uploads/solicitudinscripcion/57/doc_foto_per_57.jpg', '1', '2017-10-14 21:07:54', NULL, '1'),
(51, 13, 26, 4, '/uploads/solicitudinscripcion/57/doc_certvota_per_57.jpg', '1', '2017-10-14 21:07:54', NULL, '1'),
(52, 13, 26, 3, '/uploads/solicitudinscripcion/57/doc_certvota_per_57.jpg', '1', '2017-10-14 21:07:54', NULL, '1'),
(53, 14, 29, 1, '/uploads/solicitudinscripcion/63/doc_titulo_per_63.pdf', '1', '2017-10-16 21:13:24', NULL, '1'),
(54, 14, 29, 2, '/uploads/solicitudinscripcion/63/doc_dni_per_63.pdf', '1', '2017-10-16 21:13:24', NULL, '1'),
(55, 14, 29, 4, '/uploads/solicitudinscripcion/63/doc_foto_per_63.jpg', '1', '2017-10-16 21:13:24', NULL, '1'),
(56, 14, 29, 3, '/uploads/solicitudinscripcion/63/doc_certvota_per_63.pdf', '1', '2017-10-16 21:13:24', NULL, '1'),
(57, 15, 26, 1, '/uploads/solicitudinscripcion/57/doc_titulo_per_57.pdf', '1', '2017-10-16 22:28:06', NULL, '1'),
(58, 15, 26, 2, '/uploads/solicitudinscripcion/57/doc_dni_per_57.pdf', '1', '2017-10-16 22:28:06', NULL, '1'),
(59, 15, 26, 4, '/uploads/solicitudinscripcion/57/doc_foto_per_57.jpg', '1', '2017-10-16 22:28:06', NULL, '1'),
(60, 15, 26, 3, '/uploads/solicitudinscripcion/57/doc_certvota_per_57.pdf', '1', '2017-10-16 22:28:06', NULL, '1'),
(61, 16, 31, 1, '/uploads/solicitudinscripcion/67/doc_titulo_per_67.pdf', '1', '2017-10-17 15:32:37', NULL, '1'),
(62, 16, 31, 2, '/uploads/solicitudinscripcion/67/doc_dni_per_67.pdf', '1', '2017-10-17 15:32:37', NULL, '1'),
(63, 16, 31, 4, '/uploads/solicitudinscripcion/67/doc_foto_per_67.png', '1', '2017-10-17 15:32:37', NULL, '1'),
(64, 16, 31, 3, '/uploads/solicitudinscripcion/67/doc_certvota_per_67.pdf', '1', '2017-10-17 15:32:37', NULL, '1'),
(65, 17, 32, 1, '/uploads/solicitudinscripcion/68/doc_titulo_per_68.pdf', '1', '2017-10-17 19:49:56', NULL, '1'),
(66, 17, 32, 2, '/uploads/solicitudinscripcion/68/doc_dni_per_68.pdf', '1', '2017-10-17 19:49:56', NULL, '1'),
(67, 17, 32, 4, '/uploads/solicitudinscripcion/68/doc_foto_per_68.pdf', '1', '2017-10-17 19:49:56', NULL, '1'),
(68, 17, 32, 3, '/uploads/solicitudinscripcion/68/doc_certvota_per_68.pdf', '1', '2017-10-17 19:49:56', NULL, '1');

--
-- Dumping data for table `solicitud_captacion`
--

INSERT INTO `solicitud_captacion` (`rcap_id`, `per_id`, `pint_id`, `nint_id`, `ming_id`, `car_id`, `mpub_id`, `rcap_fecha_ingreso`, `rcap_estado`, `rcap_fecha_creacion`, `rcap_fecha_modificacion`, `rcap_estado_logico`) VALUES
(1, 23, 1, NULL, NULL, NULL, NULL, '2017-09-26 15:41:04', '1', '2017-09-26 15:41:04', NULL, '1'),
(2, 23, 1, NULL, NULL, NULL, NULL, '2017-09-26 15:41:04', '1', '2017-09-26 15:41:04', NULL, '1'),
(3, 24, 1, NULL, NULL, NULL, NULL, '2017-09-29 01:49:40', '1', '2017-09-29 01:49:40', NULL, '1'),
(4, 25, 1, NULL, NULL, NULL, NULL, '2017-09-29 04:16:44', '1', '2017-09-29 04:16:44', NULL, '1'),
(5, 26, 1, NULL, NULL, NULL, NULL, '2017-09-29 22:33:02', '1', '2017-09-29 22:33:02', NULL, '1'),
(6, 27, 1, NULL, NULL, NULL, NULL, '2017-10-01 03:32:22', '1', '2017-10-01 03:32:22', NULL, '1'),
(7, 28, 1, NULL, NULL, NULL, NULL, '2017-10-01 07:03:12', '1', '2017-10-01 07:03:12', NULL, '1'),
(8, 29, 1, NULL, NULL, NULL, NULL, '2017-10-02 21:52:40', '1', '2017-10-02 21:52:40', NULL, '1'),
(9, 30, 1, NULL, NULL, NULL, NULL, '2017-10-03 02:14:26', '1', '2017-10-03 02:14:26', NULL, '1'),
(10, 31, 1, NULL, 1, NULL, NULL, '2017-10-03 07:01:28', '1', '2017-10-03 02:01:28', NULL, '1'),
(11, 32, 1, NULL, 1, NULL, NULL, '2017-10-03 23:57:50', '1', '2017-10-03 18:57:50', NULL, '1'),
(12, 33, 1, NULL, 1, NULL, NULL, '2017-10-07 16:39:20', '1', '2017-10-07 11:39:20', NULL, '1'),
(13, 34, 1, NULL, 1, NULL, NULL, '2017-10-08 10:24:25', '1', '2017-10-08 05:24:25', NULL, '1'),
(14, 35, 1, NULL, 1, NULL, NULL, '2017-10-09 03:05:28', '1', '2017-10-08 22:05:28', NULL, '1'),
(15, 36, 1, NULL, 1, NULL, NULL, '2017-10-09 22:09:32', '1', '2017-10-09 17:09:32', NULL, '1'),
(16, 37, 1, NULL, 1, NULL, NULL, '2017-10-10 08:56:04', '1', '2017-10-10 03:56:04', NULL, '1'),
(17, 38, 1, NULL, 1, NULL, NULL, '2017-10-11 06:07:32', '1', '2017-10-11 01:07:32', NULL, '1'),
(18, 39, 1, NULL, 1, NULL, NULL, '2017-10-12 00:54:49', '1', '2017-10-11 19:54:49', NULL, '1'),
(19, 40, 1, NULL, 1, NULL, NULL, '2017-10-12 02:20:08', '1', '2017-10-11 21:20:08', NULL, '1'),
(20, 41, 1, NULL, 1, NULL, NULL, '2017-10-12 06:41:35', '1', '2017-10-12 01:41:35', NULL, '1'),
(21, 42, 1, NULL, 1, NULL, NULL, '2017-10-13 02:03:24', '1', '2017-10-12 21:03:24', NULL, '1'),
(22, 43, 1, NULL, 1, NULL, NULL, '2017-10-13 05:52:22', '1', '2017-10-13 00:52:22', NULL, '1'),
(23, 44, 1, NULL, 1, NULL, NULL, '2017-10-13 08:39:58', '1', '2017-10-13 03:39:58', NULL, '1'),
(24, 45, 1, NULL, 1, NULL, NULL, '2017-10-13 09:13:19', '1', '2017-10-13 04:13:19', NULL, '1'),
(25, 46, 1, NULL, 1, NULL, NULL, '2017-10-13 09:46:56', '1', '2017-10-13 04:46:56', NULL, '1'),
(26, 47, 1, NULL, 1, NULL, NULL, '2017-10-13 10:04:20', '1', '2017-10-13 05:04:20', NULL, '1'),
(27, 48, 1, NULL, 1, NULL, NULL, '2017-10-13 11:21:29', '1', '2017-10-13 06:21:29', NULL, '1'),
(28, 49, 1, NULL, 1, NULL, NULL, '2017-10-13 20:24:44', '1', '2017-10-13 15:24:44', NULL, '1'),
(29, 50, 1, NULL, 1, NULL, NULL, '2017-10-13 23:37:08', '1', '2017-10-13 18:37:08', NULL, '1'),
(30, 51, 1, NULL, 1, NULL, NULL, '2017-10-14 01:35:04', '1', '2017-10-13 20:35:04', NULL, '1'),
(31, 52, 1, NULL, 1, NULL, NULL, '2017-10-14 08:07:38', '1', '2017-10-14 03:07:38', NULL, '1'),
(32, 53, 1, NULL, 1, NULL, NULL, '2017-10-14 18:38:12', '1', '2017-10-14 13:38:12', NULL, '1'),
(33, 54, 1, NULL, 1, NULL, NULL, '2017-10-14 19:17:52', '1', '2017-10-14 14:17:52', NULL, '1'),
(34, 55, 1, NULL, 1, NULL, NULL, '2017-10-14 20:42:57', '1', '2017-10-14 15:42:57', NULL, '1'),
(35, 56, 1, NULL, 1, NULL, NULL, '2017-10-14 22:11:22', '1', '2017-10-14 17:11:22', NULL, '1'),
(36, 57, 1, NULL, 1, NULL, NULL, '2017-10-15 00:46:11', '1', '2017-10-14 19:46:11', NULL, '1'),
(37, 58, 1, NULL, 1, NULL, NULL, '2017-10-16 06:38:56', '1', '2017-10-16 01:38:56', NULL, '1'),
(38, 59, 1, NULL, 1, NULL, NULL, '2017-10-16 20:13:42', '1', '2017-10-16 15:13:42', NULL, '1'),
(39, 60, 1, NULL, 1, NULL, NULL, '2017-10-16 23:21:39', '1', '2017-10-16 18:21:39', NULL, '1'),
(40, 61, 1, NULL, 1, NULL, NULL, '2017-10-16 23:26:12', '1', '2017-10-16 18:26:12', NULL, '1'),
(41, 62, 1, NULL, 1, NULL, NULL, '2017-10-16 23:46:53', '1', '2017-10-16 18:46:53', NULL, '1'),
(42, 63, 1, NULL, 1, NULL, NULL, '2017-10-17 00:21:36', '1', '2017-10-16 19:21:36', NULL, '1'),
(43, 64, 1, NULL, 1, NULL, NULL, '2017-10-17 00:08:46', '1', '2017-10-17 00:08:46', NULL, '1'),
(44, 65, 1, NULL, 1, NULL, NULL, '2017-10-17 06:59:20', '1', '2017-10-17 02:02:02', NULL, '1'),
(45, 66, 1, NULL, 1, NULL, NULL, '2017-10-17 07:45:15', '1', '2017-10-17 02:49:17', NULL, '1'),
(46, 67, 1, NULL, 1, NULL, NULL, '2017-10-17 19:43:48', '1', '2017-10-17 14:56:01', NULL, '1'),
(47, 68, 1, NULL, 1, NULL, NULL, '2017-10-17 20:01:47', '1', '2017-10-17 15:03:02', NULL, '1'),
(48, 69, 1, NULL, 1, NULL, NULL, '2017-10-18 00:03:11', '1', '2017-10-17 20:12:53', NULL, '1');

--
-- Dumping data for table `solicitud_rechazada`
--

INSERT INTO `solicitud_rechazada` (`srec_id`, `sins_id`, `dadj_id`, `con_id`, `srec_etapa`, `srec_observacion`, `usu_id`, `srec_estado`, `srec_fecha_creacion`, `srec_fecha_modificacion`, `srec_estado_logico`) VALUES
(1, 4, 1, 1, 'P', 'No cumple condiciones de aceptación en título.', 18, '1', '2017-10-10 19:51:51', NULL, '1'),
(2, 4, 2, 4, 'P', 'No cumple condiciones de aceptación en documento de identidad.', 18, '1', '2017-10-10 19:51:51', NULL, '1'),
(3, 4, 1, 1, 'A', 'No cumple condiciones de aceptación en título.', 11, '1', '2017-10-10 21:32:31', NULL, '1'),
(4, 4, 2, 5, 'A', 'No cumple condiciones de aceptación en documento de identidad.', 11, '1', '2017-10-10 21:32:31', NULL, '1'),
(5, 5, 1, 1, 'A', 'No cumple condiciones de aceptación en título.', 12, '1', '2017-10-11 22:12:53', NULL, '1'),
(6, 5, 2, 5, 'A', 'No cumple condiciones de aceptación en documento de identidad.', 12, '1', '2017-10-11 22:12:53', NULL, '1'),
(7, 8, 1, 1, 'P', 'No cumple condiciones de aceptación en título.', 19, '1', '2017-10-12 17:24:26', NULL, '1'),
(8, 8, 2, 5, 'P', 'No cumple condiciones de aceptación en documento de identidad.', 19, '1', '2017-10-12 17:24:26', NULL, '1'),
(9, 8, 1, 1, 'A', 'No cumple condiciones de aceptación en título.', 11, '1', '2017-10-12 17:25:01', NULL, '1'),
(10, 8, 2, 5, 'A', 'No cumple condiciones de aceptación en documento de identidad.', 11, '1', '2017-10-12 17:25:01', NULL, '1'),
(11, 7, 2, 5, 'P', 'No cumple condiciones de aceptación en documento de identidad.', 16, '1', '2017-10-12 19:08:14', NULL, '1'),
(12, 13, 2, 5, 'P', 'No cumple condiciones de aceptación en documento de identidad.', 19, '1', '2017-10-16 15:02:22', NULL, '1'),
(13, 13, 2, 5, 'A', 'No cumple condiciones de aceptación en documento de identidad.', 11, '1', '2017-10-16 15:06:39', NULL, '1'),
(14, 7, 1, 1, 'A', 'No cumple condiciones de aceptación en título.', 11, '1', '2017-10-16 21:49:47', NULL, '1'),
(15, 7, 2, 5, 'A', 'No cumple condiciones de aceptación en documento de identidad.', 11, '1', '2017-10-16 21:49:47', NULL, '1');


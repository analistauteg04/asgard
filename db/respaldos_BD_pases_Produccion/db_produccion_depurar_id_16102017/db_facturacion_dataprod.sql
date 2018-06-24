USE `db_facturacion`

--
-- Dumping data for table `categoria`
--

INSERT INTO `categoria` (`cat_id`, `cat_codigo`, `cat_nombre`, `cat_descripcion`, `cat_estado`, `cat_fecha_creacion`, `cat_fecha_modificacion`, `cat_estado_logico`) VALUES
(1, '001', 'Solicitudes de Inscripción', 'Solicitudes de Inscripción', '1', '2017-09-25 14:54:21', NULL, '1');

--
-- Dumping data for table `sub_categoria`
--

INSERT INTO `sub_categoria` (`scat_id`, `cat_id`, `scat_codigo`, `scat_nombre`, `scat_descripcion`, `scat_estado`, `scat_fecha_creacion`, `scat_fecha_modificacion`, `scat_estado_logico`) VALUES
(1, 1, '001', 'Grado Online', 'Grado Online', '1', '2017-09-25 14:54:21', NULL, '1'),
(2, 1, '002', 'Grado', 'Grado', '1', '2017-09-25 14:54:21', NULL, '1'),
(3, 1, '003', 'Posgrado', 'Posgrado', '1', '2017-09-25 14:54:21', NULL, '1');

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`ite_id`, `cat_id`, `scat_id`, `ite_codigo`, `ite_nombre`, `ite_descripcion`, `ite_ruta_imagen`, `ite_estado`, `ite_fecha_creacion`, `ite_fecha_modificacion`, `ite_estado_logico`) VALUES
(1, 1, 1, '0001', 'Curso de admisión y nivelación', 'Curso de admisión y nivelación', '', '1', '2017-09-25 14:54:21', NULL, '1'),
(2, 1, 1, '0002', 'Examen de admisión', 'Examen de admisión', '', '1', '2017-09-25 14:54:21', NULL, '1'),
(3, 1, 2, '0003', 'Curso de admisión y nivelación', 'Curso de admisión y nivelación', '', '1', '2017-09-25 14:54:21', NULL, '1'),
(4, 1, 2, '0004', 'Examen de admisión', 'Examen de admisión', '', '1', '2017-09-25 14:54:21', NULL, '1'),
(5, 1, 2, '0005', 'Homologación', 'Homologación', '', '1', '2017-09-25 14:54:21', NULL, '1'),
(6, 1, 3, '0006', 'Homologación', 'Homologación', '', '1', '2017-09-25 14:54:21', NULL, '1'),
(7, 1, 3, '0007', 'Propedéutico', 'Propedéutico', '', '1', '2017-09-25 14:54:21', NULL, '1');


--
-- Dumping data for table `item_precio`
--

INSERT INTO `item_precio` (`ipre_id`, `ite_id`, `ipre_precio_siva`, `ipre_precio_civa`, `ipre_fecha_inicio`, `ipre_fecha_fin`, `ipre_estado_precio`, `ipre_estado`, `ipre_fecha_creacion`, `ipre_fecha_modificacion`, `ipre_estado_logico`) VALUES
(1, 1, 150, NULL, '2017-08-04 05:00:00', '2017-12-31 05:00:00', 'A', '1', '2017-09-25 14:54:22', NULL, '1'),
(2, 2, 90, NULL, '2017-08-04 05:00:00', '2017-12-31 05:00:00', 'A', '1', '2017-09-25 14:54:22', NULL, '1');

--
-- Dumping data for table `categoria_pago`
--

INSERT INTO `categoria_pago` (`cpag_id`, `cpag_nombre`, `cpag_descripcion`, `cpag_estado`, `cpag_fecha_creacion`, `cpag_fecha_modificacion`, `cpag_estado_logico`) VALUES
(1, 'solicitud', 'solicitud', '1', '2017-09-25 14:54:22', NULL, '1'),
(2, 'servicio', 'servicio', '1', '2017-09-25 14:54:22', NULL, '1');

--
-- Dumping data for table `cliente`
--

INSERT INTO `cliente` (`cli_id`, `cli_estado`, `cli_fecha_creacion`, `cli_fecha_modificacion`, `cli_estado_logico`) VALUES
(1, '1', '2017-10-02 22:57:02', NULL, '1'),
(2, '1', '2017-10-04 16:34:19', NULL, '1'),
(3, '1', '2017-10-10 16:11:37', NULL, '1'),
(4, '1', '2017-10-11 22:22:51', NULL, '1'),
(5, '1', '2017-10-13 15:56:35', NULL, '1'),
(6, '1', '2017-10-13 16:00:05', NULL, '1'),
(7, '1', '2017-10-14 16:08:58', NULL, '1'),
(8, '1', '2017-10-14 16:21:25', NULL, '1'),
(9, '1', '2017-10-16 21:47:34', NULL, '1'),
(10, '1', '2017-10-16 22:46:24', NULL, '1'),
(11, '1', '2017-10-17 16:36:05', NULL, '1');
--
-- Dumping data for table `orden_pago`
--

INSERT INTO `orden_pago` (`opag_id`, `sser_id`, `cpag_id`, `ipre_id`, `amb_id`, `cli_id`, `opag_subtotal`, `opag_iva`, `opag_total`, `opag_estado_pago`, `opag_observacion`, `opag_estado`, `opag_fecha_creacion`, `opag_fecha_modificacion`, `opag_estado_logico`) VALUES
(1, 1, 1, 1, NULL, 1, 150, 0, 150, 'S', NULL, '1', '2017-10-02 22:57:02', '2017-10-11 01:22:45', '1'),
(2, 2, 1, 1, NULL, 2, 150, 0, 150, 'S', NULL, '1', '2017-10-04 16:34:19', '2017-10-12 01:22:27', '1'),
(3, 3, 1, 1, NULL, 3, 150, 0, 150, 'P', NULL, '1', '2017-10-10 16:11:37', NULL, '1'),
(4, 6, 1, 1, NULL, 4, 150, 0, 150, 'P', NULL, '1', '2017-10-11 22:22:51', NULL, '1'),
(5, 9, 1, 1, NULL, 5, 150, 0, 150, 'P', NULL, '1', '2017-10-13 15:56:35', NULL, '1'),
(6, 10, 1, 1, NULL, 6, 150, 0, 150, 'S', NULL, '1', '2017-10-13 16:00:05', '2017-10-13 21:14:02', '1'),
(7, 12, 1, 1, NULL, 7, 150, 0, 150, 'S', NULL, '1', '2017-10-14 16:08:58', '2017-10-14 21:15:17', '1'),
(8, 11, 1, 1, NULL, 8, 150, 0, 150, 'S', NULL, '1', '2017-10-14 16:21:25', '2017-10-14 21:23:17', '1'),
(9, 14, 1, 1, NULL, 9, 150, 0, 150, 'S', NULL, '1', '2017-10-16 21:47:34', '2017-10-17 03:03:17', '1'),
(10, 15, 1, 1, NULL, 10, 150, 0, 150, 'P', NULL, '1', '2017-10-16 22:46:24', NULL, '1'),
(11, 16, 1, 1, NULL, 11, 150, 0, 150, 'P', NULL, '1', '2017-10-17 16:36:05', NULL, '1');

--
-- Dumping data for table `cabecera_cargo`
--

INSERT INTO `cabecera_cargo` (`ccar_id`, `opag_id`, `ccar_estado_pago`, `ccar_fecha_pago_total`, `ccar_total`, `ccar_pagado`, `ccar_num_factura`, `ccar_num_bin`, `ccar_fecha_autorizacion`, `ccar_codautorizacion`, `ccar_num_transaccion`, `ccar_resultado`, `ccar_estado`, `ccar_fecha_creacion`, `ccar_fecha_modificacion`, `ccar_estado_logico`) VALUES
(1, 1, 'S', '2017-10-07 05:17:59', 150, 150, NULL, NULL, NULL, NULL, NULL, 'Ok', '1', '2017-10-07 00:17:59', '2017-10-11 01:22:45', '1'),
(2, 2, 'S', '2017-10-12 01:22:27', 150, 150, NULL, NULL, NULL, NULL, NULL, 'Ok', '1', '2017-10-11 20:22:27', '2017-10-12 01:22:27', '1'),
(3, 6, 'S', '2017-10-13 21:14:02', 150, 150, NULL, NULL, NULL, NULL, NULL, 'Ok', '1', '2017-10-13 16:14:02', '2017-10-13 21:14:02', '1'),
(4, 7, 'S', '2017-10-14 21:15:17', 150, 150, NULL, NULL, NULL, NULL, NULL, 'Ok', '1', '2017-10-14 16:15:17', '2017-10-14 21:15:17', '1'),
(5, 8, 'S', '2017-10-14 21:23:17', 150, 150, NULL, NULL, NULL, NULL, NULL, 'Ok', '1', '2017-10-14 16:23:17', '2017-10-14 21:23:17', '1'),
(6, 9, 'S', '2017-10-17 02:50:41', 150, 150, NULL, NULL, NULL, NULL, NULL, 'Ok', '1', '2017-10-16 21:50:41', '2017-10-17 03:03:17', '1'),
(7, 11, 'S', '2017-10-17 22:37:32', 150, 150, NULL, NULL, NULL, NULL, NULL, 'Ok', '1', '2017-10-17 17:37:32', '2017-10-18 01:53:23', '1');

-- --------------------------------------------------------

--
-- Dumping data for table `cabecera_registropago`
--

INSERT INTO `cabecera_registropago` (`creg_id`, `opag_id`, `creg_estado_pagado`, `creg_fecha_pago_total`, `creg_total`, `creg_pagado`, `creg_num_factura`, `creg_num_bin`, `creg_fecha_autorizacion`, `creg_codautorizacion`, `creg_num_transaccion`, `creg_resultado`, `creg_estado`, `creg_fecha_creacion`, `creg_fecha_modificacion`, `creg_estado_logico`) VALUES
(1, 1, 'SP', '2017-10-07 05:17:59', 150, 150, NULL, NULL, '2017-10-05 05:00:00', '', 1612507768, 'OK', '1', '2017-10-10 20:22:45', NULL, '1'),
(2, 2, 'SP', '2017-10-12 01:22:27', 150, 150, NULL, NULL, '2017-10-11 05:00:00', '', 139491, 'OK', '1', '2017-10-11 20:22:27', NULL, '1'),
(3, 6, 'SP', '2017-10-13 21:14:02', 150, 150, NULL, NULL, '2017-10-13 05:00:00', '', 1086223140, 'OK', '1', '2017-10-13 16:14:02', NULL, '1'),
(4, 7, 'SP', '2017-10-14 21:15:17', 150, 150, NULL, NULL, '2017-10-14 05:00:00', '', 139655, 'OK', '1', '2017-10-14 16:15:17', NULL, '1'),
(5, 8, 'SP', '2017-10-14 21:23:17', 150, 150, NULL, NULL, '2017-10-14 05:00:00', '', 1371940, 'OK', '1', '2017-10-14 16:23:17', NULL, '1'),
(6, 9, 'SP', '2017-10-17 02:50:41', 150, 150, NULL, NULL, '2017-10-16 05:00:00', '', 13753, 'OK', '1', '2017-10-16 22:03:17', NULL, '1'),
(7, 11, 'SP', '2017-10-17 22:37:32', 150, 150, NULL, NULL, '2017-10-17 05:00:00', '', 1, 'OK', '1', '2017-10-17 20:53:23', NULL, '1');

--
-- Dumping data for table `cliente_interesado`
--

INSERT INTO `cliente_interesado` (`cint_id`, `cli_id`, `int_id`, `cint_estado`, `cint_fecha_creacion`, `cint_fecha_modificacion`, `cint_estado_logico`) VALUES
(1, 1, 4, '1', '2017-10-02 22:57:02', NULL, '1'),
(2, 2, 7, '1', '2017-10-04 16:34:19', NULL, '1'),
(3, 3, 5, '1', '2017-10-10 16:11:37', NULL, '1'),
(4, 4, 13, '1', '2017-10-11 22:22:51', NULL, '1'),
(5, 5, 20, '1', '2017-10-13 15:56:35', NULL, '1'),
(6, 6, 22, '1', '2017-10-13 16:00:05', NULL, '1'),
(7, 7, 25, '1', '2017-10-14 16:08:58', NULL, '1'),
(8, 8, 24, '1', '2017-10-14 16:21:25', NULL, '1'),
(9, 9, 29, '1', '2017-10-16 21:47:34', NULL, '1'),
(10, 10, 26, '1', '2017-10-16 22:46:24', NULL, '1'),
(11, 11, 31, '1', '2017-10-17 16:36:05', NULL, '1');
--
-- Dumping data for table `detalle_cargo`
--

INSERT INTO `detalle_cargo` (`dcar_id`, `ccar_id`, `fpag_id`, `dcar_valor`, `dcar_fecha_pago`, `dcar_imagen`, `dcar_observacion`, `dcar_revisado`, `dcar_resultado`, `dcar_num_transaccion`, `dcar_fecha_transaccion`, `dcar_estado`, `dcar_fecha_creacion`, `dcar_fecha_modificacion`, `dcar_estado_logico`) VALUES
(1, 1, 4, 150, '2017-10-11 01:22:45', 'pago_26-2017-10-06 19:17:26.pdf', '', 'RE', 'AP', '1612507768', '2017-10-05 05:00:00', '1', '2017-10-07 00:17:59', '2017-10-11 01:22:45', '1'),
(2, 1, 4, 150, NULL, 'pago_26-2017-10-06 19:19:18.pdf', 'Pago Duplicado', 'RE', 'RE', '1612507768', '2017-10-05 05:00:00', '1', '2017-10-07 00:19:23', '2017-10-11 19:15:06', '1'),
(3, 2, 2, 150, '2017-10-12 01:22:27', NULL, '', 'RE', 'AP', '139491', '2017-10-11 05:00:00', '1', '2017-10-11 20:22:27', '2017-10-12 01:22:27', '1'),
(4, 3, 1, 150, '2017-10-13 21:14:02', NULL, '', 'RE', 'AP', '1086223140', '2017-10-13 05:00:00', '1', '2017-10-13 16:14:02', '2017-10-13 21:14:02', '1'),
(5, 4, 2, 150, '2017-10-14 21:15:17', NULL, '', 'RE', 'AP', '139655', '2017-10-14 05:00:00', '1', '2017-10-14 16:15:17', '2017-10-14 21:15:17', '1'),
(6, 5, 1, 150, '2017-10-14 21:23:17', NULL, '', 'RE', 'AP', '1371940', '2017-10-14 05:00:00', '1', '2017-10-14 16:23:17', '2017-10-14 21:23:17', '1'),
(7, 6, 5, 150, '2017-10-17 03:03:17', 'pago_63-2017-10-16 16:53:55.pdf', '', 'RE', 'AP', '013753', '2017-10-16 05:00:00', '1', '2017-10-16 21:50:41', '2017-10-17 03:03:17', '1'),
(8, 7, 4, 150, NULL, 'pago_67-2017-10-17 12:37:25.pdf', '', 'PE', '', '1', '2017-10-17 05:00:00', '1', '2017-10-17 17:37:32', NULL, '1');

--
-- Dumping data for table `forma_pago`
--

INSERT INTO `forma_pago` (`fpag_id`, `fpag_nombre`, `fpag_descripcion`, `fpag_estado`, `fpag_fecha_creacion`, `fpag_fecha_modificacion`, `fpag_estado_logico`) VALUES
(1, 'Tarjeta de Credito', 'Tarjeta de Credito', '1', '2017-09-25 14:54:22', NULL, '1'),
(2, 'Efectivo', 'Efectivo', '1', '2017-09-25 14:54:22', NULL, '1'),
(3, 'Cheque', 'Cheque', '1', '2017-09-25 14:54:22', NULL, '1'),
(4, 'Transferencia', 'Transferencia', '1', '2017-09-25 14:54:22', NULL, '1'),
(5, 'Déposito', 'Déposito', '1', '2017-09-25 14:54:22', NULL, '1'),
(6, 'Botón de Pagos', 'Botón de Pagos', '1', '2017-09-25 14:54:22', NULL, '1');

--
-- Dumping data for table `detalle_registropago`
--

INSERT INTO `detalle_registropago` (`dreg_id`, `creg_id`, `fpag_id`, `dreg_valor`, `dreg_fecha_pago`, `dreg_imagen`, `dreg_observacion`, `dreg_estado_final`, `dreg_num_transaccion`, `dreg_fecha_transaccion`, `dreg_estado`, `dreg_fecha_creacion`, `dreg_fecha_modificacion`, `dreg_estado_logico`) VALUES
(1, 1, 4, 150, NULL, 'pago_26-2017-10-06 19:17:26.pdf', '', 'AP', '1612507768', '2017-10-05 05:00:00', '1', '2017-10-10 20:22:45', NULL, '1'),
(2, 2, 2, 150, NULL, NULL, '', 'AP', '139491', '2017-10-11 05:00:00', '1', '2017-10-11 20:22:27', NULL, '1'),
(3, 3, 1, 150, NULL, NULL, '', 'AP', '1086223140', '2017-10-13 05:00:00', '1', '2017-10-13 16:14:02', NULL, '1'),
(4, 4, 2, 150, NULL, NULL, '', 'AP', '139655', '2017-10-14 05:00:00', '1', '2017-10-14 16:15:17', NULL, '1'),
(5, 5, 1, 150, NULL, NULL, '', 'AP', '1371940', '2017-10-14 05:00:00', '1', '2017-10-14 16:23:17', NULL, '1'),
(6, 6, 5, 150, NULL, 'pago_63-2017-10-16 16:53:55.pdf', '', 'AP', '013753', '2017-10-16 05:00:00', '1', '2017-10-16 22:03:17', NULL, '1'),
(7, 7, 4, 150, NULL, 'pago_67-2017-10-17 12:37:25.pdf', '', 'AP', '1', '2017-10-17 05:00:00', '1', '2017-10-17 20:53:23', NULL, '1');

--
-- Dumping data for table `forma_pago_carga`
--

INSERT INTO `forma_pago_carga` (`fpca_id`, `fpag_id`, `fpca_fecha_inicio`, `fpca_fecha_fin`, `fpca_activo_carga`, `fpca_estado`, `fpca_fecha_creacion`, `fpca_fecha_modificacion`, `fpca_estado_logico`) VALUES
(1, 1, NULL, NULL, 'N', '1', '2017-09-25 14:54:22', NULL, '1'),
(2, 2, NULL, NULL, 'N', '1', '2017-09-25 14:54:22', NULL, '1'),
(3, 3, NULL, NULL, 'N', '1', '2017-09-25 14:54:22', NULL, '1'),
(4, 4, NULL, NULL, 'S', '1', '2017-09-25 14:54:22', NULL, '1'),
(5, 5, NULL, NULL, 'S', '1', '2017-09-25 14:54:22', NULL, '1'),
(6, 6, NULL, NULL, 'B', '1', '2017-09-25 14:54:22', NULL, '1');

--
-- Dumping data for table `item_metodo_nivel`
--

INSERT INTO `item_metodo_nivel` (`imni_id`, `ipre_id`, `ite_id`, `ming_id`, `nint_id`, `imni_estado`, `imni_fecha_creacion`, `imni_fecha_modificacion`, `imni_estado_logico`) VALUES
(1, 1, 1, 1, 2, '1', '2017-09-25 14:54:22', NULL, '1'),
(2, 2, 2, 2, 2, '1', '2017-09-25 14:54:22', NULL, '1');

--
-- Base de datos: `db_facturacion`
--
use `db_facturacion`;

-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `categoria` 
--
insert into `categoria` (`cat_id`, `cat_nombre`, `cat_descripcion`, `cat_usu_ingreso`, `cat_estado`, `cat_estado_logico`)
values(1, 'Solicitudes de Inscripción', 'Solicitudes de Inscripción', 1, '1', '1');

-- ---------------------------------------------git pull-----------
--
-- Volcado de datos para la tabla `sub_categoria` 
--
insert into `sub_categoria` (`scat_id`, `cat_id`, `scat_nombre`, `scat_descripcion`, `scat_usu_ingreso`, `scat_estado`, `scat_estado_logico`) values
(1, 1, 'Grado Online', 'Grado Online', 1, '1', '1'),
(2, 1, 'Grado', 'Grado', 1, '1', '1'),
(3, 1, 'Posgrado', 'Posgrado', 1, '1', '1');

-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `item` 
--
insert into `item` (`ite_id`, `scat_id`,  `ite_codigo`, `ite_nombre`, `ite_descripcion`, `ite_usu_ingreso`, `ite_estado`, `ite_estado_logico`) values
(1, 1, '0001', 'Curso de admisión y nivelación', 'Curso de admisión y nivelación', 1, '1', '1'),
(2, 1, '0002', 'Examen de admisión', 'Examen de admisión', 1, '1', '1'),
(3, 2, '0003', 'Curso de admisión y nivelación', 'Curso de admisión y nivelación', 1, '1', '1'),
(4, 2, '0004', 'Examen de admisión', 'Examen de admisión', 1, '1', '1'),
(5, 2, '0005', 'Homologación', 'Homologación', 1, '1', '1'),
(6, 3, '0006', 'Homologación', 'Homologación', 1, '1', '1'),
(7, 3, '0007', 'Propedéutico', 'Propedéutico', 1, '1', '1');

-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `item_precio` 
--
insert into `item_precio` (`ipre_id`, `ite_id`, `ipre_precio`, `ipre_porcentaje_iva`, `ipre_estado_precio`, `ipre_usu_ingreso`, `ipre_estado`, `ipre_estado_logico`) values
(1, 1, 150, null, 'A', 1, '1', '1'),
(2, 2, 90, null, 'A', 1, '1', '1');

-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `historial_item_precio` 
--
insert into `historial_item_precio` (`hipr_id`, `ite_id`, `hipr_precio`, `hipr_porcentaje_iva`, `hipr_fecha_inicio`, `hipr_fecha_fin`, `hipr_usu_transaccion`, `hipr_estado`, `hipr_estado_logico`) values
(1, 1, 150, null, '2017/09/25', null, 1, '1', '1'),
(2, 2, 90, null, '2017/09/25', null, 1, '1', '1');

-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `item_metodo_nivel` 
--
insert into `item_metodo_nivel` (`imni_id`, `ite_id`, `ming_id`, `nint_id`, `imni_usu_ingreso`, `imni_estado`, `imni_estado_logico`) values
(1, 1, 1, 2, 1, '1', '1'),
(2, 2, 2, 2, 1, '1', '1');

-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `forma_pago` 
--
insert into `forma_pago` (`fpag_id`,  `fpag_nombre`, `fpag_descripcion`, `fpag_distintivo`, `fpag_usu_ingreso`, `fpag_estado`, `fpag_estado_logico`) values
(1,'Tarjeta de Credito', 'Tarjeta de Credito', '1', 1, '1','1'),
(2,'Efectivo', 'Efectivo', '1', 1, '1','1'),
(3,'Cheque', 'Cheque', '1', 1, '1','1'),
(4,'Transferencia', 'Transferencia', '2', 1, '1','1'),
(5,'Déposito', 'Déposito', '2', 1, '1','1'),
(6,'Botón de Pagos', 'Botón de Pagos', '3', 1, '1','1');

-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `tipo_comprobante` 
--
insert into `tipo_comprobante` (`tcom_id`, `tcom_nombre`, `tcom_usuario_ingreso`, `tcom_estado`, `tcom_estado_logico`) values
(1, 'Factura', 1, '1', '1'),
(2, 'Nota de Crédito', 1, '1', '1'),
(3, 'Nota de Débito', 1, '1', '1'),
(4, 'Comprobantes de Retención', 1, '1', '1'),
(5, 'Guía de Remisión', 1, '1', '1');

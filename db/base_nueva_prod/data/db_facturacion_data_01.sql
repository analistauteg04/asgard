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
(2, 1, 'Grado Presencial', 'Grado Presencial', 1, '1', '1'),
(3, 1, 'Grado Semipresencial', 'Grado Semipresencial', 1, '1', '1'),
(4, 1, 'Grado A distancia', 'Grado A distancia', 1, '1', '1'),
(5, 1, 'Posgrado', 'Posgrado', 1, '1', '1'),
(6, 1, 'Educación Continua', 'Educación Continua', 1, '1', '1'),
(7, 1, 'Ulink', 'Ulink', 1, '1', '1');

-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `item` 
--
insert into `item` (`ite_id`, `scat_id`,  `ite_codigo`, `ite_nombre`, `ite_descripcion`, `ite_usu_ingreso`, `ite_estado`, `ite_estado_logico`) values
(1, 1, '0001', 'Curso de admisión y nivelación Online', 'Curso de admisión y nivelación Online', 1, '1', '1'),
(2, 1, '0002', 'Examen de admisión Online', 'Examen de admisión Online', 1, '1', '1'),
(3, 2, '0003', 'Curso de admisión y nivelación Presencial', 'Curso de admisión y nivelación Presencial', 1, '1', '1'),
(4, 2, '0004', 'Examen de admisión Presencial', 'Examen de admisión Presencial', 1, '1', '1'),
(5, 3, '0005', 'Curso de admisión y nivelación Semipresencial', 'Curso de admisión y nivelación Semipresencial', 1, '1', '1'),
(6, 3, '0006', 'Examen de admisión Semipresencial', 'Examen de admisión Semipresencial', 1, '1', '1'),
(7, 4, '0007', 'Curso de admisión y nivelación a Distancia', 'Curso de admisión y nivelación a Distancia', 1, '1', '1'),
(8, 4, '0008', 'Examen de admisión a Distancia', 'Examen de admisión  a Distancia', 1, '1', '1'),
(9, 5, '0009', 'Homologación Posgrado', 'Homologación Posgrado', 1, '1', '1'),
(10, 5, '0010', 'Propedéutico Posgrado', 'Propedéutico Posgrado', 1, '1', '1'),
(11, 6, '0011', 'Emprendimiento y Ventas E-Continua', 'Emprendimiento y Ventas E-Continua', 1, '1', '1'),
(12, 6, '0012', 'Excel Avanzado E-Continua', 'Excel Avanzado E-Continua', 1, '1', '1'),
(13, 6, '0013', 'Fotografía E-Continua', 'Fotografía E-Continua', 1, '1', '1'),
(14, 6, '0014', 'Event Planner E-Continua', 'Event Planner E-Continua', 1, '1', '1'),
(15, 6, '0015', 'Programa Gerencia Estratégica del TH (4 módulos) E-Continua', 'Programa Gerencia Estratégica del TH (4 módulos) E-Continua', 1, '1', '1'),
(16, 6, '0016', 'Pedagogía E-Continua', 'Pedagogía E-Continua', 1, '1', '1'),
(17, 6, '0017', 'Redacción Científica E-Continua', 'Redacción Científica E-Continua', 1, '1', '1'),
(18, 6, '0018', 'Desarrollo Habilidades Comerciales para Retail E-Continua', 'Desarrollo Habilidades Comerciales para Retail E-Continua', 1, '1', '1'),
(19, 6, '0019', 'Idioma Inglés, Francés E-Continua', 'Idioma Inglés, Francés E-Continua', 1, '1', '1'),
(20, 6, '0020', 'Cursos Online E-Continua', 'Cursos Online E-Continua', 1, '1', '1'),
(21, 7, '0021', 'MBA Bordeaux ULINK', 'MBA Bordeaux ULINK', 1, '1', '1'),
(22, 7, '0022', 'Diplomados', 'Diplomados', 1, '1', '1');

-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `item_precio` 
--
insert into `item_precio` (`ipre_id`, `ite_id`, `ipre_precio`, `ipre_porcentaje_iva`, `ipre_estado_precio`, `ipre_valor_minimo`, `ipre_porcentaje_minimo`, `ipre_fecha_inicio`, `ipre_fecha_fin`, `ipre_usu_ingreso`, `ipre_estado`, `ipre_estado_logico`) values
(1, 1, 150, null, 'A', null, null, '2017/09/25 00:00:00', '2018/12/31 23:59:59', 1, '1', '1'),
(2, 2, 90, null, 'A', null, null, '2017/09/09 00:00:00', '2018/12/31 23:59:59', 1, '1', '1'),
(3, 3, 390, null, 'A', null, null, '2018/07/01 00:00:00', '2018/12/31 23:59:59', 1, '1', '1'),
(4, 5, 390, null, 'A', null, null, '2018/07/01 00:00:00', '2018/12/31 23:59:59', 1, '1', '1'),
(5, 7, 390, null, 'A', null, null, '2018/07/01 00:00:00', '2018/12/31 23:59:59', 1, '1', '1'),
(6, 10, 950, null, 'A', null, null, '2018/07/01 00:00:00', '2018/12/31 23:59:59', 1, '1', '1'),
(7, 11, 100, null, 'A', null, null, '2018/07/01 00:00:00', '2018/12/31 23:59:59', 1, '1', '1'),
(8, 12, 60, null, 'A', null, null, '2018/07/01 00:00:00', '2018/12/31 23:59:59', 1, '1', '1'),
(9, 13, 50, null, 'A', null, null, '2018/07/01 00:00:00', '2018/12/31 23:59:59', 1, '1', '1'),
(10, 14, 100, null, 'A', null, null, '2018/07/01 00:00:00', '2018/12/31 23:59:59', 1, '1', '1'),
(11, 16, 150, null, 'A', null, null, '2018/07/01 00:00:00', '2018/12/31 23:59:59', 1, '1', '1'),
(12, 17, 150, null, 'A', null, null, '2018/07/01 00:00:00', '2018/12/31 23:59:59', 1, '1', '1'),
(13, 20, 360, null, 'A', null, null, '2018/07/01 00:00:00', '2018/12/31 23:59:59', 1, '1', '1'),
(14, 21, 1000, null, 'A', null, null, '2018/07/01 00:00:00', '2018/12/31 23:59:59', 1, '1', '1'),
(15, 22, 55, null, 'A', null, null, '2018/07/01 00:00:00', '2018/12/31 23:59:59', 1, '1', '1');

-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `historial_item_precio` 
--
insert into `historial_item_precio` (`hipr_id`, `ite_id`, `hipr_precio`, `hipr_porcentaje_iva`, `hipr_fecha_inicio`, `hipr_fecha_fin`, `hipr_valor_minimo`, `hipr_porcentaje_minimo`, `hipr_usu_transaccion`, `hipr_estado`, `hipr_estado_logico`) values
(1, 1, 150, null, '2017/09/25 00:00:00', '2018/12/31 23:59:59', null, null, 1, '1', '1'),
(2, 2, 90, null, '2017/09/25 00:00:00', '2018/12/31 23:59:59', null, null, 1, '1', '1'),
(3, 3, 390, null, '2018/07/01 00:00:00', '2018/12/31 23:59:59', null, null, 1, '1', '1'),
(4, 5, 390, null, '2018/07/01 00:00:00', '2018/12/31 23:59:59', null, null, 1, '1', '1'),
(5, 7, 390, null, '2018/07/01 00:00:00', '2018/12/31 23:59:59', null, null, 1, '1', '1'),
(6, 10, 950, null, '2018/07/01 00:00:00', '2018/12/31 23:59:59', null, null, 1, '1', '1'),
(7, 11, 100, null, '2018/07/01 00:00:00', '2018/12/31 23:59:59', null, null, 1, '1', '1'),
(8, 12, 60, null, '2018/07/01 00:00:00', '2018/12/31 23:59:59', null, null, 1, '1', '1'),
(9, 13, 50, null, '2018/07/01 00:00:00', '2018/12/31 23:59:59', null, null, 1, '1', '1'),
(10, 14, 100, null, '2018/07/01 00:00:00', '2018/12/31 23:59:59', null, null, 1, '1', '1'),
(11, 16, 150, null, '2018/07/01 00:00:00', '2018/12/31 23:59:59', null, null, 1, '1', '1'),
(12, 17, 150, null, '2018/07/01 00:00:00', '2018/12/31 23:59:59', null, null, 1, '1', '1'),
(13, 20, 360, null, '2018/07/01 00:00:00', '2018/12/31 23:59:59', null, null, 1, '1', '1'),
(14, 21, 1000, null, '2018/07/01 00:00:00', '2018/12/31 23:59:59', null, null, 1, '1', '1'),
(15, 22, 55, null, '2018/07/01 00:00:00', '2018/12/31 23:59:59', null, null, 1, '1', '1');

-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `item_metodo_nivel` 
--
insert into `item_metodo_unidad` (`imni_id`, `ite_id`, `ming_id`, `uaca_id`, `mod_id`, `mest_id`, `imni_usu_ingreso`, `imni_estado`, `imni_estado_logico`) values
(1, 1, 1, 1, 1, null, 1, '1', '1'),
(2, 2, 2, 1, 1, null, 1, '1', '1'),
(3, 3, 1, 1, 2, null, 1, '1', '1'),
(4, 5, 1, 1, 3, null, 1, '1', '1'),
(5, 7, 1, 1, 4, null, 1, '1', '1'),
(6, 10, 4, 2, 3, null, 1, '1', '1'),
(7, 11, null, 3, 2, 24, 1, '1', '1'),
(8, 12, null, 3, 2, 25, 1, '1', '1'),
(9, 13, null, 3, 2, 26, 1, '1', '1'),
(10, 14, null, 3, 2, 27, 1, '1', '1'),
(11, 16, null, 3, 2, 29, 1, '1', '1'),
(12, 17, null, 3, 2, 30, 1, '1', '1'),
(13, 20, null, 3, 1, 33, 1, '1', '1'),
(14, 21, null, null, null, 1, 1, '1', '1'),
(15, 22, null, null, null, 2, 1, '1', '1');

-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `forma_pago` 
--
insert into `forma_pago` (`fpag_id`,  `fpag_nombre`, `fpag_descripcion`, `fpag_distintivo`, `fpag_usu_ingreso`, `fpag_estado`, `fpag_estado_logico`) values
(1,'Tarjeta de Credito', 'Tarjeta de Credito', '1', 1, '1','1'),
(2,'Efectivo', 'Efectivo', '1', 1, '1','1'),
(3,'Cheque', 'Cheque', '1', 1, '1','1'),
(4,'Transferencia', 'Transferencia', '2', 1, '1','1'),
(5,'Depósito', 'Depósito', '2', 1, '1','1'),
(6,'Botón de Pagos', 'Botón de Pagos', '3', 1, '1','1'),
(7,'Pago en Línea', 'Pago en Línea', '1', 1, '1','1');

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

-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `descuento_item` 
-- --------------------------------------------------------
insert into `descuento_item` (`dite_id`, `ite_id`, `dite_usu_creacion`, `dite_estado`, `dite_estado_logico`) values
(1, 1, 1, '1', '1'), -- Online
(2, 3, 1, '1', '1'), -- Presencial
(3, 5, 1, '1', '1'), -- Semipresencial
(4, 7, 1, '1', '1'); -- A distancia

-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `detalle_descuento_item` 
-- --------------------------------------------------------
insert into `detalle_descuento_item` (`ddit_id` , `dite_id`, `ddit_descripcion`, `ddit_tipo_beneficio`, `ddit_porcentaje`, `ddit_valor`, `ddit_finicio`, `ddit_ffin`, `ddit_estado_descuento`, `ddit_usu_creacion`, `ddit_estado`, `ddit_estado_logico`) values
(1, 1, 'Descuento CAN Campania 20%', 'P', 20, null, '2018/08/01 00:00:00', '2018/12/31 23:59:59', 'A', 1, '1', '1'), 
(2, 2, 'Descuento CAN Campania 25%', 'P', 25, null, '2018/08/01 00:00:00', '2018/12/31 23:59:59', 'A', 1, '1', '1'), 
(3, 3, 'Descuento CAN Campania 25%', 'P', 25, null, '2018/08/01 00:00:00', '2018/12/31 23:59:59', 'A', 1, '1', '1'), 
(4, 4, 'Descuento CAN Campania 25%', 'P', 25, null, '2018/08/01 00:00:00', '2018/12/31 23:59:59', 'A', 1, '1', '1'), 
(5, 2, 'Descuento CAN CNEL 10%', 'P', 10, null, '2018/08/01 00:00:00', '2018/12/31 23:59:59', 'A', 1, '1', '1'), 
(6, 3, 'Descuento CAN CNEL 10%', 'P', 10, null, '2018/08/01 00:00:00', '2018/12/31 23:59:59', 'A', 1, '1', '1'), 
(7, 4, 'Descuento CAN CNEL 10%', 'P', 10, null, '2018/08/01 00:00:00', '2018/12/31 23:59:59', 'A', 1, '1', '1'), 
(8, 2, 'Descuento CAN Cámara Turismo del Guayas 10%', 'P', 10, null, '2018/08/01 00:00:00', '2018/12/31 23:59:59', 'A', 1, '1', '1'), 
(9, 3, 'Descuento CAN Cámara Turismo del Guayas 10%', 'P', 10, null, '2018/08/01 00:00:00', '2018/12/31 23:59:59', 'A', 1, '1', '1'), 
(10, 4, 'Descuento CAN Cámara Turismo del Guayas 10%', 'P', 10, null, '2018/08/01 00:00:00', '2018/12/31 23:59:59', 'A', 1, '1', '1'), 
(11, 2, 'Descuento CAN Cámara Espanola de Comercio de Ecuador 10%', 'P', 10, null, '2018/08/01 00:00:00', '2018/12/31 23:59:59', 'A', 1, '1', '1'), 
(12, 3, 'Descuento CAN Cámara Espanola de Comercio de Ecuador 10%', 'P', 10, null, '2018/08/01 00:00:00', '2018/12/31 23:59:59', 'A', 1, '1', '1'), 
(13, 4, 'Descuento CAN Cámara Espanola de Comercio de Ecuador 10%', 'P', 10, null, '2018/08/01 00:00:00', '2018/12/31 23:59:59', 'A', 1, '1', '1'), 
(14, 2, 'Descuento CAN Banco Guayaquil 10%', 'P', 10, null, '2018/08/01 00:00:00', '2018/12/31 23:59:59', 'A', 1, '1', '1'), 
(15, 3, 'Descuento CAN Banco Guayaquil 10%', 'P', 10, null, '2018/08/01 00:00:00', '2018/12/31 23:59:59', 'A', 1, '1', '1'), 
(16, 4, 'Descuento CAN Banco Guayaquil 10%', 'P', 10, null, '2018/08/01 00:00:00', '2018/12/31 23:59:59', 'A', 1, '1', '1'), 
(17, 2, 'Descuento CAN Barcelona 10%', 'P', 10, null, '2018/08/01 00:00:00', '2018/12/31 23:59:59', 'A', 1, '1', '1'), 
(18, 3, 'Descuento CAN Barcelona 10%', 'P', 10, null, '2018/08/01 00:00:00', '2018/12/31 23:59:59', 'A', 1, '1', '1'), 
(19, 4, 'Descuento CAN Barcelona 10%', 'P', 10, null, '2018/08/01 00:00:00', '2018/12/31 23:59:59', 'A', 1, '1', '1'), 
(20, 2, 'Descuento CAN Hospital IESS de Machala 10%', 'P', 10, null, '2018/08/01 00:00:00', '2018/12/31 23:59:59', 'A', 1, '1', '1'), 
(21, 3, 'Descuento CAN Hospital IESS de Machala 10%', 'P', 10, null, '2018/08/01 00:00:00', '2018/12/31 23:59:59', 'A', 1, '1', '1'), 
(22, 4, 'Descuento CAN Hospital IESS de Machala 10%', 'P', 10, null, '2018/08/01 00:00:00', '2018/12/31 23:59:59', 'A', 1, '1', '1'),
(23, 2, 'Descuento CAN Reserva 25%', 'P', 25, null, '2018/08/01 00:00:00', '2018/12/31 23:59:59', 'A', 1, '1', '1'), 
(24, 3, 'Descuento CAN Reserva 25%', 'P', 25, null, '2018/08/01 00:00:00', '2018/12/31 23:59:59', 'A', 1, '1', '1'), 
(25, 4, 'Descuento CAN Reserva 25%', 'P', 25, null, '2018/08/01 00:00:00', '2018/12/31 23:59:59', 'A', 1, '1', '1'),
(26, 1, 'Descuento CAN Barcelona 40%', 'P', 40, null, '2018/08/01 00:00:00', '2018/12/31 23:59:59', 'A', 1, '1', '1');

-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `detalle_descuento_item` 
-- --------------------------------------------------------
insert into `historial_descuento_item` (`hdit_id` , `ddit_id`, `dite_id`, `hdit_descripcion`, `hdit_tipo_beneficio`, `hdit_porcentaje`, `hdit_valor`, `hdit_fecha_inicio`, `hdit_fecha_fin`, `hdit_estado_descuento`, `hdit_usu_transaccion` , `hdit_estado`, `hdit_estado_logico`) values
(1, 1, 1, 'Descuento CAN Online 20%', 'P', 20, null, '2018/08/01 00:00:00', '2018/12/31 23:59:59', 'A', 1, '1', '1'), 
(2, 2, 2, 'Descuento CAN Campania 25%', 'P', 25, null, '2018/08/01 00:00:00', '2018/12/31 23:59:59', 'A', 1, '1', '1'), 
(3, 3, 3, 'Descuento CAN Campania 25%', 'P', 25, null, '2018/08/01 00:00:00', '2018/12/31 23:59:59', 'A', 1, '1', '1'), 
(4, 4, 4, 'Descuento CAN Campania 25%', 'P', 25, null, '2018/08/01 00:00:00', '2018/12/31 23:59:59', 'A', 1, '1', '1'), 
(5, 5, 2, 'Descuento CAN CNEL 10%', 'P', 10, null, '2018/08/01 00:00:00', '2018/12/31 23:59:59', 'A', 1, '1', '1'), 
(6, 6, 3, 'Descuento CAN CNEL 10%', 'P', 10, null, '2018/08/01 00:00:00', '2018/12/31 23:59:59', 'A', 1, '1', '1'), 
(7, 7, 4, 'Descuento CAN CNEL 10%', 'P', 10, null, '2018/08/01 00:00:00', '2018/12/31 23:59:59', 'A', 1, '1', '1'), 
(8, 8, 2, 'Descuento CAN Cámara Turismo del Guayas 10%', 'P', 10, null, '2018/08/01 00:00:00', '2018/12/31 23:59:59', 'A', 1, '1', '1'), 
(9, 9, 3, 'Descuento CAN Cámara Turismo del Guayas 10%', 'P', 10, null, '2018/08/01 00:00:00', '2018/12/31 23:59:59', 'A', 1, '1', '1'), 
(10, 10, 4, 'Descuento CAN Cámara Turismo del Guayas 10%', 'P', 10, null, '2018/08/01 00:00:00', '2018/12/31 23:59:59', 'A', 1, '1', '1'), 
(11, 11, 2, 'Descuento CAN Cámara Espanola de Comercio de Ecuador 10%', 'P', 10, null, '2018/08/01 00:00:00', '2018/12/31 23:59:59', 'A', 1, '1', '1'), 
(12, 12, 3, 'Descuento CAN Cámara Espanola de Comercio de Ecuador 10%', 'P', 10, null, '2018/08/01 00:00:00', '2018/12/31 23:59:59', 'A', 1, '1', '1'), 
(13, 13, 4, 'Descuento CAN Cámara Espanola de Comercio de Ecuador 10%', 'P', 10, null, '2018/08/01 00:00:00', '2018/12/31 23:59:59', 'A', 1, '1', '1'), 
(14, 14, 2, 'Descuento CAN Banco Guayaquil 10%', 'P', 10, null, '2018/08/01 00:00:00', '2018/12/31 23:59:59', 'A', 1, '1', '1'), 
(15, 15, 3, 'Descuento CAN Banco Guayaquil 10%', 'P', 10, null, '2018/08/01 00:00:00', '2018/12/31 23:59:59', 'A', 1, '1', '1'), 
(16, 16, 4, 'Descuento CAN Banco Guayaquil 10%', 'P', 10, null, '2018/08/01 00:00:00', '2018/12/31 23:59:59', 'A', 1, '1', '1'), 
(17, 17, 2, 'Descuento CAN Barcelona 10%', 'P', 10, null, '2018/08/01 00:00:00', '2018/12/31 23:59:59', 'A', 1, '1', '1'), 
(18, 18, 3, 'Descuento CAN Barcelona 10%', 'P', 10, null, '2018/08/01 00:00:00', '2018/12/31 23:59:59', 'A', 1, '1', '1'), 
(19, 19, 4, 'Descuento CAN Barcelona 10%', 'P', 10, null, '2018/08/01 00:00:00', '2018/12/31 23:59:59', 'A', 1, '1', '1'), 
(20, 20, 2, 'Descuento CAN Hospital IESS de Machala 10%', 'P', 10, null, '2018/08/01 00:00:00', '2018/12/31 23:59:59', 'A', 1, '1', '1'), 
(21, 21, 3, 'Descuento CAN Hospital IESS de Machala 10%', 'P', 10, null, '2018/08/01 00:00:00', '2018/12/31 23:59:59', 'A', 1, '1', '1'), 
(22, 22, 4, 'Descuento CAN Hospital IESS de Machala 10%', 'P', 10, null, '2018/08/01 00:00:00', '2018/12/31 23:59:59', 'A', 1, '1', '1'),
(23, 23, 2, 'Descuento CAN Reserva 25%', 'P', 25, null, '2018/08/01 00:00:00', '2018/12/31 23:59:59', 'A', 1, '1', '1'),
(24, 24, 3, 'Descuento CAN Reserva 25%', 'P', 25, null, '2018/08/01 00:00:00', '2018/12/31 23:59:59', 'A', 1, '1', '1'),
(25, 25, 4, 'Descuento CAN Reserva 25%', 'P', 25, null, '2018/08/01 00:00:00', '2018/12/31 23:59:59', 'A', 1, '1', '1'),
(26, 26, 1, 'Descuento CAN Barcelona 40%', 'P', 40, null, '2018/08/01 00:00:00', '2018/12/31 23:59:59', 'A', 1, '1', '1');

-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `secuencias` 
-- --------------------------------------------------------
insert into `secuencias` (`emp_id`, `estab_id`, `pemis_id`, `secu_tipo_doc`, `secuencia`, `secu_nombre`, `secu_estado`, `secu_estado_logico`) VALUES
(1, 1, 1, 'SOL', '000000000', 'SOLICITUDES UTEG', '1', '1'),
(2, 1, 1, 'SOL', '000000000', 'SOLICITUDES', '1', '1'),
(3, 1, 1, 'SOL', '000000000', 'SOLICITUDES', '1', '1');
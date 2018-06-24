--
-- Base de datos: `db_facturacion`
--
use `db_facturacion`;

-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `categoria` 
--
insert into `categoria` (`cat_id`, `cat_codigo`, `cat_nombre`, `cat_descripcion`, `cat_estado`, `cat_estado_logico`)
values(1,'001', 'Solicitudes de Inscripción', 'Solicitudes de Inscripción', '1', '1');


-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `sub_categoria` 
--
insert into `sub_categoria` (`scat_id`, `cat_id`, `scat_codigo`, `scat_nombre`, `scat_descripcion`, `scat_estado`, `scat_estado_logico`) values
(1, 1, '001', 'Grado Online', 'Grado Online', '1', '1'),
(2, 1, '002', 'Grado', 'Grado', '1', '1'),
(3, 1, '003', 'Posgrado', 'Posgrado', '1', '1');


-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `item` 
--
insert into `item` (`ite_id`, `cat_id`, `scat_id`,  `ite_codigo`, `ite_nombre`, `ite_descripcion`, `ite_ruta_imagen`, `ite_estado`, `ite_estado_logico`) values
(1, 1, 1, '0001', 'Curso de admisión y nivelación', 'Curso de admisión y nivelación', '', '1', '1'),
(2, 1, 1, '0002', 'Examen de admisión', 'Examen de admisión', '', '1', '1'),
(3, 1, 2, '0003', 'Curso de admisión y nivelación', 'Curso de admisión y nivelación', '', '1', '1'),
(4, 1, 2, '0004', 'Examen de admisión', 'Examen de admisión', '', '1', '1'),
(5, 1, 2, '0005', 'Homologación', 'Homologación', '', '1', '1'),
(6, 1, 3, '0006', 'Homologación', 'Homologación', '', '1', '1'),
(7, 1, 3, '0007', 'Propedéutico', 'Propedéutico', '', '1', '1');


-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `item_precio` 
--
insert into `item_precio` (`ipre_id`, `ite_id`, `ipre_precio_siva`, `ipre_precio_civa`,`ipre_fecha_inicio`, `ipre_fecha_fin`, `ipre_estado_precio`, `ipre_estado`, `ipre_estado_logico`) values
(1, 1, 150, null, '2017/08/04', '2017/12/31', 'A', '1', '1'),
(2, 2, 90, null, '2017/08/04', '2017/12/31', 'A', '1', '1');

-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `item_metodo_nivel` 
--
insert into `item_metodo_nivel` (`imni_id`, `ipre_id`, `ite_id`, `ming_id`, `nint_id`, `imni_estado`, `imni_estado_logico`) values
(1, 1, 1, 1, 2, '1', '1'),
(2, 2, 2, 2, 2, '1', '1');

-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `forma_pago` 
--
insert into `forma_pago` (`fpag_id`,  `fpag_nombre`, `fpag_descripcion`, `fpag_estado`, `fpag_estado_logico`) values
(1,'Tarjeta de Credito', 'Tarjeta de Credito','1','1'),
(2,'Efectivo', 'Efectivo','1','1'),
(3,'Cheque', 'Cheque','1','1'),
(4,'Transferencia', 'Transferencia', '1','1'),
(5,'Déposito', 'Déposito', '1','1'),
(6,'Botón de Pagos', 'Botón de Pagos', '1','1');

-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `categoria_pago`
--
INSERT INTO `categoria_pago` (`cpag_id`, `cpag_nombre`,`cpag_descripcion`, `cpag_estado`, `cpag_estado_logico`) VALUES
(1,'solicitud', 'solicitud', '1', '1'),
(2,'servicio', 'servicio', '1', '1');

-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `forma_pago_carga` 
--
insert into `forma_pago_carga` (`fpca_id`,  `fpag_id`, `fpca_activo_carga`,`fpca_estado`,`fpca_estado_logico`) values
(1, 1, 'N', '1','1'),
(2, 2, 'N', '1','1'),
(3, 3, 'N', '1','1'),
(4, 4, 'S', '1','1'),
(5, 5, 'S', '1','1'),
(6, 6, 'B', '1','1');

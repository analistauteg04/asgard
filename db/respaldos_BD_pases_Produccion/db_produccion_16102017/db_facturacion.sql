-- Base de Datos 

DROP SCHEMA IF EXISTS `db_facturacion` ;
CREATE SCHEMA IF NOT EXISTS `db_facturacion` default CHARACTER SET utf8 ;
USE `db_facturacion` ;

GRANT ALL PRIVILEGES ON `db_facturacion`.* TO 'utegasgard'@'localhost' IDENTIFIED BY 'Ut3G4dmi1n-d364rr00@ll20167*Onl1n3W@';

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `categoria`
--
create table if not exists `categoria`(
`cat_id` bigint(20) not null auto_increment primary key,
`cat_codigo` varchar(03) not null,
`cat_nombre` varchar(200) not null,
`cat_descripcion` varchar(500) not null,
`cat_estado` varchar(1) not null,
`cat_fecha_creacion` timestamp not null default current_timestamp,
`cat_fecha_modificacion` timestamp null default null,
`cat_estado_logico` varchar(1) not null
);

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `sub_categoria`
--
create table if not exists `sub_categoria`(
`scat_id` bigint(20) not null auto_increment primary key,
`cat_id` bigint(20) not null,
`scat_codigo` varchar(03) not null,
`scat_nombre` varchar(200) not null,
`scat_descripcion` varchar(500) not null,
`scat_estado` varchar(1) not null,
`scat_fecha_creacion` timestamp not null default current_timestamp,
`scat_fecha_modificacion` timestamp null default null,
`scat_estado_logico` varchar(1) not null,
foreign key (cat_id) references `categoria`(cat_id)
);


-- --------------------------------------------------------
-- 
-- Estructura de tabla para la tabla `item`
--
create table if not exists `item` (
  `ite_id` bigint(20) not null auto_increment primary key,
  `cat_id` bigint(20) not null,
  `scat_id` bigint(20) not null,  
  `ite_codigo` varchar(05) not null,
  `ite_nombre` varchar(200) not null,
  `ite_descripcion` varchar(500) not null,  
  `ite_ruta_imagen` varchar(500) null,  
  `ite_estado` varchar(1) not null,
  `ite_fecha_creacion` timestamp not null default current_timestamp,
  `ite_fecha_modificacion` timestamp null default null,
  `ite_estado_logico` varchar(1) not null,  
  foreign key (scat_id) references `sub_categoria`(scat_id),
  foreign key (cat_id) references `categoria`(cat_id)
);

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `item_precio`
--
create table if not exists `item_precio` (
  `ipre_id` bigint(20) not null primary key,
  `ite_id` bigint(20) not null,  
  `ipre_precio_siva` double default null,    
  `ipre_precio_civa` double default null,    
  `ipre_fecha_inicio` timestamp null default null,
  `ipre_fecha_fin` timestamp  null default null,
  `ipre_estado_precio` varchar(1)  null default null,  
  `ipre_estado` varchar(1) not null,
  `ipre_fecha_creacion` timestamp not null default current_timestamp,
  `ipre_fecha_modificacion` timestamp null default null,
  `ipre_estado_logico` varchar(1) not null, 
  foreign key (ite_id) references `item`(ite_id) 
);


-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `item_metodo_nivel`
--
create table if not exists `item_metodo_nivel` (
  `imni_id` bigint(20) not null primary key,
  `ipre_id` bigint(20) not null,
  `ite_id`  bigint(20) not null,  
  `ming_id` bigint(20) not null,  
  `nint_id` bigint(20) not null,
  `imni_estado` varchar(1) not null,
  `imni_fecha_creacion` timestamp not null default current_timestamp,
  `imni_fecha_modificacion` timestamp null default null,
  `imni_estado_logico` varchar(1) not null, 
  foreign key (ite_id) references `item`(ite_id),
  foreign key (ipre_id) references `item_precio`(ipre_id)
);

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `persona_ext`
--
create table if not exists `persona_ext` (
 `pext_id` bigint(20) not null auto_increment primary key,
 `pext_pri_nombre` varchar(250) default null,
 `pext_seg_nombre` varchar(250) default null,
 `pext_pri_apellido` varchar(250) default null, 
 `pext_seg_apellido` varchar(250) default null,
 `pext_cedula` varchar(15) not null,
 `pext_ruc` varchar(15) default null,
 `pext_pasaporte` varchar(50) default null,
 `etn_id` bigint(20) default null,
 `eciv_id` bigint(20) default null,
 `pext_genero` varchar(1) default null, 
 `pai_id_nacimiento` bigint(20) default null,
 `pro_id_nacimiento` bigint(20) default null,
 `can_id_nacimiento` bigint(20) default null,
 `pext_fecha_nacimiento` date default null,
 `pext_celular` varchar(50) default null,
 `pext_correo` varchar(250) default null,
 `pext_foto` varchar(500) default null,
 `tsan_id` bigint(20) default null,
 `pext_domicilio_sector` varchar(250) default null,
 `pext_domicilio_cpri` varchar(500) default null,
 `pext_domicilio_csec` varchar(500) default null,
 `pext_domicilio_num` varchar(100) default null,
 `pext_domicilio_ref` varchar(500) default null,
 `pext_domicilio_telefono` varchar(50) default null,
 `pai_id_domicilio` bigint(20) default null, 
 `pro_id_domicilio` bigint(20) default null, 
 `can_id_domicilio` bigint(20) default null,  
 `pext_trabajo_nombre` varchar(250) default null,
 `pext_trabajo_direccion` varchar(500) default null,
 `pext_trabajo_telefono` varchar(50) default null, 
 `pext_trabajo_ext` varchar(50) default null,
 `pai_id_trabajo` bigint(20) default null, 
 `pro_id_trabajo` bigint(20) default null,
 `can_id_trabajo` bigint(20) default null,
 `pext_estado` varchar(1) not null,
 `pext_fecha_creacion` timestamp not null default current_timestamp,
 `pext_fecha_modificacion` timestamp null default null,
 `pext_estado_logico` varchar(1) not null 
);

-- --------------------------------------------------------
-- 
-- Estructura de tabla para la tabla `cliente`
--
create table if not exists `cliente` (
  `cli_id` bigint(20) not null auto_increment primary key,  
  `cli_estado` varchar(1) not null,
  `cli_fecha_creacion` timestamp not null default current_timestamp,
  `cli_fecha_modificacion` timestamp null default null,
  `cli_estado_logico` varchar(1) not null
);


-- --------------------------------------------------------
-- 
-- Estructura de tabla para la tabla `cliente_persona_ext`
--
create table if not exists `cliente_persona_ext` (
  `cpex_id` bigint(20) not null auto_increment primary key,
  `pext_id` bigint(20) not null, 
  `cli_id` bigint(20)  not null,
  `cpex_estado` varchar(1) not null,
  `cpex_fecha_creacion` timestamp not null default current_timestamp,
  `cpex_fecha_modificacion` timestamp null default null,
  `cpex_estado_logico` varchar(1) not null,
  foreign key (pext_id) references `persona_ext` (pext_id),
  foreign key (cli_id) references `cliente` (cli_id)
);

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `categoria_pago`
--
create table if not exists `categoria_pago` (
  `cpag_id` bigint(20) not null auto_increment primary key,
  `cpag_nombre` varchar(200) not null,
  `cpag_descripcion` varchar(500) not null,
  `cpag_estado` varchar(1) not null,
  `cpag_fecha_creacion` timestamp not null default current_timestamp,
  `cpag_fecha_modificacion` timestamp null default null,
  `cpag_estado_logico` varchar(1) null  
) ;

-- --------------------------------------------------------
-- 
-- Estructura de tabla para la tabla `orden_pago`
--
create table if not exists `orden_pago` (
  `opag_id` bigint(20) not null auto_increment primary key,  
  `sser_id` bigint(20) not null, 
  `cpag_id` bigint(20) not null, 
  `ipre_id` bigint(20) not null,  
  `amb_id` bigint(20)  null,   
  `cli_id` bigint(20) not null,
  `opag_subtotal` double not null,
  `opag_iva` double not null,  
  `opag_total` double not null,
  `opag_estado_pago` varchar(1) null,
  `opag_observacion` varchar(200) default null,
  `opag_estado` varchar(1) not null,
  `opag_fecha_creacion` timestamp not null default current_timestamp,
  `opag_fecha_modificacion` timestamp null default null, 
  `opag_estado_logico` varchar(1) not null,
  foreign key (ipre_id) references `item_precio` (ipre_id),  
  foreign key (cpag_id) references `categoria_pago` (cpag_id),
  foreign key (cli_id) references `cliente` (cli_id)

) ;

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `forma_pago`
--
create table if not exists `forma_pago` (
  `fpag_id` bigint(20) not null auto_increment primary key,
  `fpag_nombre` varchar(200) not null,
  `fpag_descripcion` varchar(500) not null,
  `fpag_estado` varchar(1) not null,
  `fpag_fecha_creacion` timestamp not null default current_timestamp,
  `fpag_fecha_modificacion` timestamp null default null,
  `fpag_estado_logico` varchar(1) null
) ;

-- --------------------------------------------------------
-- 
-- Estructura de tabla para la tabla `cabecera_registropago`
--
create table if not exists `cabecera_registropago` (
  `creg_id` bigint(20) not null auto_increment primary key,  
  `opag_id` bigint(20) not null,
  `creg_estado_pagado` varchar(2) not null,
  `creg_fecha_pago_total` timestamp null default null,
  `creg_total` double not null,
  `creg_pagado` double not null,
  `creg_num_factura` varchar(15) null default null,  
  `creg_num_bin` varchar(10) null,
  `creg_fecha_autorizacion` timestamp null,
  `creg_codautorizacion` varchar(25) null,
  `creg_num_transaccion` bigint(20) null,
  `creg_resultado` varchar(100) not null, 
  `creg_estado` varchar(1) not null,
  `creg_fecha_creacion` timestamp not null default current_timestamp,
  `creg_fecha_modificacion` timestamp null default null,
  `creg_estado_logico` varchar(1) not null,
  foreign key (opag_id) references `orden_pago` (opag_id)  
);



-- --------------------------------------------------------
-- 
-- Estructura de tabla para la tabla `detalle_registro_pago`
--
create table if not exists `detalle_registropago` (
  `dreg_id` bigint(20) not null auto_increment primary key,  
  `creg_id` bigint(20) not null,
  `fpag_id` bigint(20) not null, 
  `dreg_valor` double not null,
  `dreg_fecha_pago` timestamp null default null,
  `dreg_imagen` varchar(100) null,  
  `dreg_observacion` text null,  
  `dreg_estado_final` varchar(2) not null,
  `dreg_num_transaccion` varchar(50) not null,
  `dreg_fecha_transaccion` timestamp null, 
  `dreg_estado` varchar(1) not null,
  `dreg_fecha_creacion` timestamp not null default current_timestamp,
  `dreg_fecha_modificacion` timestamp null default null,
  `dreg_estado_logico` varchar(1) not null, 
  foreign key (creg_id) references `cabecera_registropago` (creg_id),
  foreign key (fpag_id) references `forma_pago` (fpag_id)
);

-- --------------------------------------------------------
-- 
-- Estructura de tabla para la tabla `cabecera_cargo`
--
create table if not exists `cabecera_cargo` (
  `ccar_id` bigint(20) not null auto_increment primary key,  
  `opag_id` bigint(20) not null,
  `ccar_estado_pago` varchar(1) not null,
  `ccar_fecha_pago_total` timestamp null default null,
  `ccar_total` double not null,
  `ccar_pagado` double not null,
  `ccar_num_factura` varchar(15) null default null,  
  `ccar_num_bin` varchar(10) null,
  `ccar_fecha_autorizacion` timestamp null,
  `ccar_codautorizacion` varchar(25) null,
  `ccar_num_transaccion` bigint(20) null,
  `ccar_resultado` varchar(100) not null, 
  `ccar_estado` varchar(1) not null,
  `ccar_fecha_creacion` timestamp not null default current_timestamp,
  `ccar_fecha_modificacion` timestamp null default null,
  `ccar_estado_logico` varchar(1) not null
);


-- --------------------------------------------------------
-- 
-- Estructura de tabla para la tabla `detalle_cargo`
--
create table if not exists `detalle_cargo` (
  `dcar_id` bigint(20) not null auto_increment primary key,  
  `ccar_id` bigint(20) not null,
  `fpag_id` bigint(20) not null, 
  `dcar_valor` double not null,
  `dcar_fecha_pago` timestamp null default null,
  `dcar_imagen` varchar(100) null,  
  `dcar_observacion` text null,
  `dcar_revisado` varchar(2) not null,
  `dcar_resultado` varchar(2) null,
  `dcar_num_transaccion` varchar(50) not null,    
  `dcar_fecha_transaccion` timestamp null, 
  `dcar_estado` varchar(1) not null,   
  `dcar_fecha_creacion` timestamp not null default current_timestamp,
  `dcar_fecha_modificacion` timestamp null default null,
  `dcar_estado_logico` varchar(1) not null
);
  


-- --------------------------------------------------------
-- 
-- Estructura de tabla para la tabla `cliente_interesado`
--
create table if not exists `cliente_interesado` (
  `cint_id` bigint(20) not null auto_increment primary key,
  `cli_id`  bigint(20) not null,
  `int_id` bigint(20) not null,
  `cint_estado` varchar(1) not null,
  `cint_fecha_creacion` timestamp not null default current_timestamp,
  `cint_fecha_modificacion` timestamp null default null, 
  `cint_estado_logico` varchar(1) not null,
  foreign key (cli_id) references `cliente` (cli_id)  
) ;
-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `forma_pago_carga`
--
create table if not exists `forma_pago_carga` (
  `fpca_id` bigint(20) not null auto_increment primary key,
  `fpag_id` bigint(20) not null,  
  `fpca_fecha_inicio` timestamp null default null,
  `fpca_fecha_fin` timestamp null default null,
  `fpca_activo_carga` varchar(1) null, 
  `fpca_estado` varchar(1) not null,
  `fpca_fecha_creacion` timestamp not null default current_timestamp,
  `fpca_fecha_modificacion` timestamp null default null,
  `fpca_estado_logico` varchar(1) null,
   foreign key (fpag_id) references `forma_pago` (fpag_id)  
) ;
-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `transacciones_boton_pago`
--
create table if not exists `transaccion_boton_pago` (
  `tbpa_id` bigint(20) not null auto_increment primary key,
  `opag_id` bigint(20) not null,
  `tbpa_num_tarjeta` varchar(25) null,   
  `tbpa_codigo_autorizacion` varchar(25) null,    
  `tbpa_resultado_autorizacion` varchar(45) null,
  `tbpa_codigo_error` varchar(25) null,   
  `tbpa_error_mensaje` varchar(100) null,   
  `tbpa_estado` varchar(1) default null,
  `tbpa_fecha_creacion` timestamp not null default current_timestamp,
  `tbpa_fecha_modificacion` timestamp null default null,
  `tbpa_estado_logico` varchar(1) default null,
  foreign key (opag_id) references `orden_pago` (opag_id)
) ;

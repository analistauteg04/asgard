--
-- Base de datos: `db_asgard`
--
DROP SCHEMA IF EXISTS `db_crm` ;
CREATE SCHEMA IF NOT EXISTS `db_crm` DEFAULT CHARACTER SET utf8 ;
USE `db_crm`;

GRANT ALL PRIVILEGES ON `db_crm`.* TO 'uteg'@'localhost' IDENTIFIED BY 'Utegadmin2016*';

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `conocimiento_canal`
--
create table if not exists `conocimiento_canal` (
 `ccan_id` bigint(20) not null auto_increment primary key,
 `ccan_nombre` varchar(300)  not null, 
 `ccan_descripcion` varchar(500) not null, 
 `ccan_conocimiento` varchar(2) default null, 
 `ccan_canal` varchar(2) default null, 
 `ccan_estado` varchar(1) not null,
 `ccan_fecha_creacion` timestamp not null default current_timestamp,
 `ccan_fecha_modificacion` timestamp null default null,
 `ccan_estado_logico` varchar(1) not null
);
-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `medio_conocimiento`
--
create table if not exists `medio_conocimiento` (
 `mcon_id` bigint(20) not null auto_increment primary key,
 `mcon_nombre` varchar(300)  not null, 
 `mcon_descripcion` varchar(500) not null, 
 `mcon_estado` varchar(1) not null,
 `mcon_fecha_creacion` timestamp not null default current_timestamp,
 `mcon_fecha_modificacion` timestamp null default null,
 `mcon_estado_logico` varchar(1) not null
);
-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `estado_gestion`
--
create table if not exists `estado_gestion` (
 `eges_id` bigint(20) not null auto_increment primary key,
 `eges_nombre` varchar(300)  not null, 
 `eges_descripcion` varchar(500) not null, 
 `eges_estado_sierre` varchar(1) not null, -- 1: Si, 2:No
 `eges_estado` varchar(1) not null,
 `eges_fecha_creacion` timestamp not null default current_timestamp,
 `eges_fecha_modificacion` timestamp null default null,
 `eges_estado_logico` varchar(1) not null
);

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `oportunidad_perdida`
--
create table if not exists `oportunidad_perdida` (
 `oper_id` bigint(20) not null auto_increment primary key,
 `oper_nombre` varchar(300)  not null, 
 `oper_descripcion` varchar(500) not null, 
 `oper_estado` varchar(1) not null,
 `oper_fecha_creacion` timestamp not null default current_timestamp,
 `oper_fecha_modificacion` timestamp null default null,
 `oper_estado_logico` varchar(1) not null );

-- --------------------------------------------------------
-- 
-- Estructura de tabla para la tabla `persona_gestion`
-- 

create table if not exists `persona_gestion`(
 `pges_id` bigint(20) not null auto_increment primary key,
 `pges_pri_nombre` varchar(250) default null, 
 `pges_seg_nombre` varchar(250) default null, 
 `pges_pri_apellido` varchar(250) default null,  
 `pges_seg_apellido` varchar(250) default null,
 `pges_cedula` varchar(15)  null, 
 `pges_ruc` varchar(15) default null,  
 `pges_pasaporte` varchar(50) default null, 
 `etn_id` bigint(20) default null, 
 `eciv_id` bigint(20) default null, 
 `pges_genero` varchar(1) default null,
 `pges_nacionalidad` varchar(250) default null,
 `pai_id_nacimiento` bigint(20) default null,
 `pro_id_nacimiento` bigint(20) default null,
 `can_id_nacimiento` bigint(20) default null,
 `pges_nac_ecuatoriano` varchar(1) default null,
 `pges_fecha_nacimiento` date default null,
 `pges_celular` varchar(50) default null,
 `pges_correo` varchar(250) default null,
 `pges_foto` varchar(500) default null,
 `tsan_id` bigint(20) default null,
 `pges_domicilio_sector` varchar(250) default null,
 `pges_domicilio_cpri` varchar(500) default null,
 `pges_domicilio_csec` varchar(500) default null,
 `pges_domicilio_num` varchar(100) default null,
 `pges_domicilio_ref` varchar(500) default null,
 `pges_domicilio_telefono` varchar(50) default null,
 `pges_domicilio_celular2` varchar(50) default null,
 `pai_id_domicilio` bigint(20) default null, 
 `pro_id_domicilio` bigint(20) default null, 
 `can_id_domicilio` bigint(20) default null,  
 `pges_trabajo_nombre` varchar(250) default null,
 `pges_trabajo_direccion` varchar(500) default null,
 `pges_trabajo_telefono` varchar(50) default null,
 `pges_trabajo_ext` varchar(50) default null,
 `pai_id_trabajo` bigint(20) default null,
 `pges_id_trabajo` bigint(20) default null,
 `pro_id_trabajo` bigint(20) default null,
 `can_id_trabajo` bigint(20) default null,
 `pges_estado` varchar(1) not null,
 `pges_fecha_creacion` timestamp not null default current_timestamp,
 `pges_fecha_modificacion` timestamp null default null,
 `pges_estado_logico` varchar(1) not null
  );

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `persona_contratante`
-- Información del contacto que no es interesado
-- --------------------------------------------------------
create table if not exists `persona_contratante` (
 `pcon_id` bigint(20) not null auto_increment primary key,
 `pges_id` bigint(20) not null,
 `pcon_observacion` varchar(500)  null,
 `pcon_estado` varchar(1) not null,
 `pcon_fecha_creacion` timestamp not null default current_timestamp,
 `pcon_fecha_modificacion` timestamp null default null,
 `pcon_estado_logico` varchar(1) not null);

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `persona_beneficiario`
-- 
create table if not exists `persona_beneficiario` (
 `pben_id` bigint(20) not null auto_increment primary key,
 `pges_id` bigint(20) not null,
 `pben_observacion` varchar(500)  null,
 `pben_estado` varchar(1) not null,
 `pben_fecha_creacion` timestamp not null default current_timestamp,
 `pben_fecha_modificacion` timestamp null default null,
 `pben_estado_logico` varchar(1) not null);


-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `gestion_crm`
--
create table if not exists `gestion_crm` (
 `gcrm_id` bigint(20) not null auto_increment primary key,
 `gcrm_codigo` varchar(250) default null, 
 `pcon_id` bigint(20) not null, 
 `pben_id` bigint(20) not null, 
 `gcrm_estado_sierre` varchar(1) not null, -- 1: Si, 0:Permite guardar en el historial
 `gcrm_fecha_estad_sierre` timestamp null default null,
 `gcrm_estado` varchar(1) not null,
 `gcrm_id_usuario` bigint(20),
 `gcrm_usuario_modif` bigint(20),
 `gcrm_fecha_creacion` timestamp not null default current_timestamp,
 `gcrm_fecha_modificacion` timestamp null default null,
 `gcrm_estado_logico` varchar(1) not null
);

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `tipo_carrera`
-- Información de la 2da carrera a consultar
create table if not exists `tipo_carrera` (
 `tcar_id` bigint(20) not null auto_increment primary key,
 `tcar_nombre` varchar(250) default null,
 `tcar_descripcion` varchar(500) default null,
 `tcar_estado` varchar(1) not null,
 `tcar_fecha_creacion` timestamp not null default current_timestamp,
 `tcar_fecha_modificacion` timestamp null default null,
 `tcar_estado_logico` varchar(1) not null
);
-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `tipo_sub_carrera`
-- Información de la 2da carrera a consultar
create table if not exists `tipo_sub_carrera` (
 `tsca_id` bigint(20) not null auto_increment primary key,
 `tcar_id` bigint(20) not null,
 `tsca_nombre` varchar(250) default null,
 `tsca_descripcion` varchar(500) default null,
 `tsca_estado` varchar(1) not null,
 `tsca_fecha_creacion` timestamp not null default current_timestamp,
 `tsca_fecha_modificacion` timestamp null default null,
 `tsca_estado_logico` varchar(1) not null
);



-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `personal_admision`
-- --------------------------------------------------------
create table if not exists `personal_admision` (
 `padm_id` bigint(20) not null auto_increment primary key,
 `per_id` bigint(20) not null, -- base de datos db_asgard 
 `padm_codigo` varchar(10) null,
 `padm_estado` varchar(1) not null,
 `padm_fecha_creacion` timestamp not null default current_timestamp,
 `padm_fecha_modificacion` timestamp null default null,
 `padm_estado_logico` varchar(1) not null
);
-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `cargo`
-- --------------------------------------------------------
create table if not exists `cargo` (
 `car_id` bigint(20) not null auto_increment primary key,
 `car_descripcion` varchar(100) not null,
 `car_estado` varchar(1) not null,
 `car_fecha_creacion` timestamp not null default current_timestamp,
 `car_fecha_modificacion` timestamp null default null,
 `car_estado_logico` varchar(1) not null
);
-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `personal_admision_cargo`
-- --------------------------------------------------------
create table if not exists `personal_admision_cargo` (
 `paca_id` bigint(20) not null auto_increment primary key,
 `padm_id` bigint(20) not null,
 `car_id` bigint(20) not null,
 `paca_estado` varchar(1) not null,
 `paca_fecha_creacion` timestamp not null default current_timestamp,
 `paca_fecha_modificacion` timestamp null default null,
 `paca_estado_logico` varchar(1) not null,
 foreign key (padm_id) references `personal_admision`(padm_id),
 foreign key (car_id) references `cargo`(car_id)
);
-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `personal_nivel_modalidad`
-- --------------------------------------------------------
create table if not exists `personal_nivel_modalidad` (
 `pnmo_id` bigint(20) not null auto_increment primary key,
 `paca_id` bigint(20) not null,
 `nint_id` bigint(20) not null,  -- Nivel de interés en base db_captacion.
 `mod_id` bigint(20) not null,  -- Modalidad en base db_academico.
 `pnmo_estado` varchar(1) not null,
 `pnmo_fecha_creacion` timestamp not null default current_timestamp,
 `pnmo_fecha_modificacion` timestamp null default null,
 `pnmo_estado_logico` varchar(1) not null,
 foreign key (paca_id) references `personal_admision_cargo`(paca_id)
);

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `info_curricular_crm`
-- --------------------------------------------------------
create table if not exists `info_curricular_crm` (
 `iccr_id` bigint(20) not null auto_increment primary key,
 `gcrm_id` bigint(20) not null,
 `car_id` bigint(20) not null, -- Id de la carrerar Uteg
 `nint_id` bigint(20) not null, -- id nivel interés de la base captacion  
 `mod_id` bigint(20) not null, 
 `iccr_estado` varchar(1) not null,
 `iccr_fecha_creacion` timestamp not null default current_timestamp,
 `iccr_fecha_modificacion` timestamp null default null,
 `iccr_estado_logico` varchar(1) not null 
);

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `oportunidad_perdida`
--
create table if not exists `hist_seguimiento_contac` (
 `hsco_id` bigint(20) not null auto_increment primary key,
 `gcrm_id` bigint(20) not null, -- 
 `padm_id` bigint(20) not null, 
 `iccr_id` bigint(20) not null,
 `tccr_id` bigint(20) not null, -- 1 visita, --2.- llamada - 3.-correro
 `hsco_fecha_recepcion` timestamp null, -- fecha de recepcion de interés
 `hsco_fecha_atenc` timestamp null, -- fecha de atención
 `eges_id` bigint(20), -- estatus de la tabla estatus
 `hsco_fecha_proxima` timestamp null,
 `oper_id` bigint(20), -- tipo de oportunidad perdida
 `hsco_observacion` varchar(300)  not null, -- nombre aspirante 
 `tsca_id` bigint(20), --  referencia de la tabla de carrera 2
 `ccan_id` bigint(20), -- información de canal de conocimiento 
 `mcon_id` bigint(20) ,
 `hsco_estado` varchar(1) not null,
 `hsco_fecha_creacion` timestamp not null default current_timestamp,
 `hsco_fecha_modificacion` timestamp null default null,
 `hsco_estado_logico` varchar(1) not null
);

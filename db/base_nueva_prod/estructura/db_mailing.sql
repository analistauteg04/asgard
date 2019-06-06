-- Base de Datos 

DROP SCHEMA IF EXISTS `db_mailing` ;
CREATE SCHEMA IF NOT EXISTS `db_mailing` default CHARACTER SET utf8 ;
USE `db_mailing`;
-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `lista`
--
create table if not exists `lista` (
 `lis_id` bigint(20) not null auto_increment primary key,
 `lis_codigo` varchar(50) null, 
 `eaca_id` bigint(20) null,
 `mest_id` bigint(20) null,
 `emp_id` bigint(20) not null,  
 `lis_nombre` varchar(200) not null,  
 `lis_asunto` varchar(200) null,  
 `ecor_id` bigint(20) not null, 
 `lis_nombre_principal` varchar(100) not null, 
 `lis_pais` varchar(100) not null, 
 `lis_provincia` varchar(100) not null,  
 `lis_ciudad` varchar(100) not null, 
 `lis_direccion1_empresa` varchar(100) not null,  
 `lis_direccion2_empresa` varchar(100) null,  
 `lis_telefono_empresa` varchar(20) null,  
 `lis_codigo_postal` varchar(10) not null, 
 `lis_estado` varchar(1) not null,
 `lis_fecha_creacion` timestamp not null default current_timestamp,
 `lis_fecha_modificacion` timestamp null default null,
 `lis_estado_logico` varchar(1) not null
 );

-- --------------------------------------------------------
-- Estructura de tabla para la tabla `suscriptor` 
-- --------------------------------------------------------
create table if not exists `suscriptor` (
 `sus_id` bigint(20) not null auto_increment primary key,
 `per_id` bigint(20) null,
 `pges_id` bigint(20) null,
 `sus_estado` varchar(1) not null, 
-- `sus_estado_mailchimp` varchar(1) null, 
 `sus_fecha_creacion` timestamp not null default current_timestamp,
 `sus_fecha_modificacion` timestamp null default null,
 `sus_estado_logico` varchar(1) not null
);

-- --------------------------------------------------------
-- Estructura de tabla para la tabla `lista_suscriptor` 
-- --------------------------------------------------------
create table if not exists `lista_suscriptor` (
 `lsus_id` bigint(20) not null auto_increment primary key,
 `lis_id` bigint(20) not null,
 `sus_id` bigint(20) not null,
 `lsus_estado_mailchimp` varchar(1) null, 
 `lsus_estado` varchar(1) not null, 
 `lsus_fecha_creacion` timestamp not null default current_timestamp,
 `lsus_fecha_modificacion` timestamp null default null,
 `lsus_estado_logico` varchar(1) not null,
 foreign key (lis_id) references `lista`(lis_id),
 foreign key (sus_id) references `suscriptor`(sus_id)
);

-- --------------------------------------------------------
-- Estructura de tabla para la tabla `plantilla` 
-- --------------------------------------------------------
create table if not exists `plantilla` (
 `pla_id` bigint(20) not null auto_increment primary key,
 `pla_nombre` varchar(50) not null,
 `pla_descripcion` varchar(500) null, 
 `pla_estado` varchar(1) not null,
 `pla_fecha_creacion` timestamp not null default current_timestamp,
 `pla_fecha_modificacion` timestamp null default null,
 `pla_estado_logico` varchar(1) not null
);

-- --------------------------------------------------------
-- Estructura de tabla para la tabla `lista_plantilla` 
-- --------------------------------------------------------
create table if not exists `lista_plantilla` (
 `lpla_id` bigint(20) not null auto_increment primary key,
 `lis_id` bigint(20) not null,
 `pla_id` bigint(20) not null,
 `lpla_estado` varchar(1) not null,
 `lpla_fecha_creacion` timestamp not null default current_timestamp,
 `lpla_fecha_modificacion` timestamp null default null,
 `lpla_estado_logico` varchar(1) not null,
  foreign key (lis_id) references `lista`(lis_id),
  foreign key (pla_id) references `plantilla`(pla_id)
);

-- --------------------------------------------------------
-- Estructura de tabla para la tabla `programacion`
-- --------------------------------------------------------
create table if not exists `programacion` (
  `pro_id` bigint(20) not null auto_increment primary key,    
  `lis_id` bigint(20) not null,
  `pla_id` bigint(20) not null,
  `pro_fecha_desde` timestamp null,
  `pro_fecha_hasta` timestamp null,
  `pro_hora_envio` varchar(5) not null,
  `pro_usuario_ingreso` bigint(20) not null,
  `pro_usuario_modifica` bigint(20)  null, 
  `pro_estado` varchar(1) not null,
  `pro_fecha_creacion` timestamp not null default current_timestamp,
  `pro_fecha_modificacion` timestamp null default null,
  `pro_estado_logico` varchar(1) not null,
  foreign key (lis_id) references `lista`(lis_id)
  -- foreign key (pla_id) references `plantilla`(pla_id)
);

-- --------------------------------------------------------
-- Estructura de tabla para la tabla `dia_programacion`
-- --------------------------------------------------------
create table if not exists `dia_programacion` (
  `dpro_id` bigint(20) not null auto_increment primary key,    
  `pro_id` bigint(20) not null,
  `dia_id` bigint(20) not null,  
  `dpro_estado` varchar(1) not null,
  `dpro_fecha_creacion` timestamp not null default current_timestamp,
  `dpro_fecha_modificacion` timestamp null default null,
  `dpro_estado_logico` varchar(1) not null,  
  foreign key (pro_id) references `programacion`(pro_id)
);

-- --------------------------------------------------------
-- Estructura de tabla para la tabla `bitacora_envio`
-- --------------------------------------------------------
create table if not exists `bitacora_envio` (
  `benv_id` bigint(20) not null auto_increment primary key,    
  `sus_id` bigint(20) not null,
  `pla_id` bigint(20) not null, 
  `benv_envio` varchar(1) not null,
  `fecha_envio` timestamp null,
  `benv_estado` varchar(1) not null,
  `benv_fecha_creacion` timestamp not null default current_timestamp,
  `benv_fecha_modificacion` timestamp null default null,
  `benv_estado_logico` varchar(1) not null,
  foreign key (sus_id) references `suscriptor`(sus_id),
  foreign key (pla_id) references `plantilla`(pla_id)
);


-- --------------------------------------------------------
-- Estructura de tabla para la tabla `campania_lista`
-- --------------------------------------------------------
create table if not exists `campania_lista` (
  `clis_id` bigint(20) not null auto_increment primary key,    
  `lis_id` bigint(20) not null, 
  `clis_codigo` varchar(20) not null,  
  `clis_nombre` varchar(200) not null,  
  `clis_fecha_registro` timestamp null,  
  `clis_estado` varchar(1) not null,
  `clis_fecha_creacion` timestamp not null default current_timestamp,
  `clis_fecha_modificacion` timestamp null default null,
  `clis_estado_logico` varchar(1) not null,
  foreign key (lis_id) references `lista`(lis_id)  
);


create table if not exists db_mailing.evento (
    `eve_id` bigint(20) not null auto_increment primary key,
    `eve_nombres` varchar(500) not null, 
    `eve_fecha_inicio` timestamp null,
    `eve_fecha_fin` timestamp  null,
    `eve_estado` varchar(1) not null,	 
    `eve_fecha_creacion` timestamp not null default current_timestamp,
    `eve_fecha_modificacion` timestamp null default null,
    `eve_estado_logico` varchar(1) not null
);

-- drop table db_mailing.persona_externa
create table if not exists db_mailing.persona_externa (
 `pext_id` bigint(20) not null auto_increment primary key,
 `pext_nombres` varchar(60) not null, 
 `pext_apellidos` varchar(60) not null, 
 `pext_correo` varchar(50) not null, 
 `pext_celular` varchar(20) not null,
 `pext_telefono` varchar(20) null,
 `pext_genero` varchar(1) not null,
 `pext_edad` int not null,  
 `nins_id` bigint(20) not null,  
 `pro_id` bigint(20) not null,  
 `can_id` bigint(20) not null,  
 `eve_id` bigint(20) not null,  
 `pext_estado` varchar(1) not null,
 `pext_fecha_registro` timestamp not null,
 `pext_ip_registro` varchar(50) not null,
 `pext_fecha_creacion` timestamp not null default current_timestamp,
 `pext_fecha_modificacion` timestamp null default null,
 `pext_estado_logico` varchar(1) not null,
 foreign key (eve_id) references `evento`(eve_id)
 );
 
 -- drop table db_mailing.intereses
  create table if not exists db_mailing.interes (
 `int_id` bigint(20) not null auto_increment primary key,
 `int_descripcion` varchar(100) not null, 
 `int_nombre` varchar(100) not null, 
 `int_estado` varchar(1) not null,
 `int_fecha_creacion` timestamp not null default current_timestamp,
 `int_fecha_modificacion` timestamp null default null,
 `int_estado_logico` varchar(1) not null
 );
 
 -- drop table db_mailing.persona_externa_intereses
 create table if not exists db_mailing.persona_externa_intereses (
 `pein_id` bigint(20) not null auto_increment primary key,
 `pext_id` bigint(20) not null,
 `int_id` bigint(20) not null,
 `pein_estado` varchar(1) not null,
 `pein_fecha_creacion` timestamp not null default current_timestamp,
 `pein_fecha_modificacion` timestamp null default null,
 `pein_estado_logico` varchar(1) not null,
 foreign key (pext_id) references `persona_externa`(pext_id),
 foreign key (int_id) references `interes`(int_id)
 );
 

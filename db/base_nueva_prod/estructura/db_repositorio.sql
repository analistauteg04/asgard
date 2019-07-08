-- 
-- Base de datos: `db_repositorio`
-- 

DROP SCHEMA IF EXISTS `db_repositorio`;
CREATE SCHEMA IF NOT EXISTS `db_repositorio` DEFAULT CHARACTER SET utf8 ;
USE `db_repositorio` ;

GRANT ALL PRIVILEGES ON `db_repositorio`.* TO 'uteg'@'localhost' IDENTIFIED BY 'Utegadmin2016*';

-- --------------------------------------------------------
-- 
-- Estructura de tabla para la tabla `categoria_repositorio`
-- 
create table if not exists `categoria_repositorio` (
  `crep_id` bigint(20) not null auto_increment primary key,  
  `crep_nombre` varchar(300) not null,
  `crep_descripcion` varchar(500) not null,
  -- `crep_ruta` varchar(2000) not null,
  `crep_usuario_ingreso` bigint(20) not null,
  `crep_usuario_modifica` bigint(20)  null,  
  `crep_estado` varchar(1) not null,
  `crep_fecha_creacion` timestamp not null default current_timestamp,
  `crep_fecha_modificacion` timestamp null default null,
  `crep_estado_logico` varchar(1) not null
);

-- --------------------------------------------------------
-- 
-- Estructura de tabla para la tabla `nivel_repositorio`
-- 
create table if not exists `nivel_repositorio` (
  `nrep_id` bigint(20) not null auto_increment primary key,  
  `nrep_nombre` varchar(300) not null,
  `nrep_descripcion` varchar(500) not null,
  `nrep_usuario_ingreso` bigint(20) not null,
  `nrep_usuario_modifica` bigint(20)  null,  
  `nrep_estado` varchar(1) not null,
  `nrep_fecha_creacion` timestamp not null default current_timestamp,
  `nrep_fecha_modificacion` timestamp null default null,
  `nrep_estado_logico` varchar(1) not null  
);

-- --------------------------------------------------------
-- 
-- Estructura de tabla para la tabla `categoria_nivel`
-- 
create table if not exists `categoria_nivel` (
  `cniv_id` bigint(20) not null auto_increment primary key,
  `crep_id` bigint(20) not null, 
  `nrep_id` bigint(20) not null, 
  `cniv_usuario_ingreso` bigint(20) not null,
  `cniv_usuario_modifica` bigint(20)  null,  
  `cniv_estado` varchar(1) not null,
  `cniv_fecha_creacion` timestamp not null default current_timestamp,
  `cniv_fecha_modificacion` timestamp null default null,
  `cniv_estado_logico` varchar(1) not null,

  foreign key (crep_id) references `categoria_repositorio`(crep_id),
  foreign key (nrep_id) references `nivel_repositorio`(nrep_id)
);
-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `documento_repositorio`
--
create table if not exists `documento_repositorio`(
`dre_id` bigint(20) not null auto_increment primary key,
`dre_usu_ingreso` bigint(20) not null,
`dre_usu_modifica` bigint(20) null,
`dre_estado` varchar(1) not null,
`dre_fecha_creacion` timestamp not null default current_timestamp,
`dre_fecha_modificacion` timestamp null default null,
`dre_estado_logico` varchar(1) not null
);

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `detalle_documento_repositorio`
--
create table if not exists `detalle_documento_repositorio`(
`ddre_id` bigint(20) not null auto_increment primary key,
`dre_id` bigint(20) not null,
`cniv_id` bigint(20) not null,
`ddre_tipo` bigint(20) null, -- 1 publico , 2 -- privado
`ddre_imagen` varchar(100) not null,
`ddre_tamaño` varchar(10) null,
`ddre_usu_modifica` bigint(20) null,
`ddre_estado` varchar(1) not null,
`ddre_fecha_creacion` timestamp not null default current_timestamp,
`ddre_fecha_modificacion` timestamp null default null,
`ddre_estado_logico` varchar(1) not null,

foreign key (dre_id) references `documento_repositorio`(dre_id),
foreign key (cniv_id) references `categoria_nivel`(cniv_id)
);
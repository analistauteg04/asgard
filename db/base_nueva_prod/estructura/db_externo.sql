-- 
-- Base de datos: `db_externo`
-- 
DROP SCHEMA IF EXISTS `db_externo`;
CREATE SCHEMA IF NOT EXISTS `db_externo` DEFAULT CHARACTER SET utf8 ;
USE `db_externo` ;

-- GRANT ALL PRIVILEGES ON `db_externo`.* TO 'uteg'@'localhost' IDENTIFIED BY 'Utegadmin2016*'; -- Ubuntu
-- GRANT ALL PRIVILEGES ON `db_externo`.* TO 'uteg'@'localhost';  -- centos

-- --------------------------------------------------------
-- 
-- Estructura de tabla para la tabla `evento`
-- --------------------------------------------------------
create table if not exists evento (
    `eve_id` bigint(20) not null auto_increment primary key,
    `eve_nombres` varchar(500) not null, 
    `eve_fecha_inicio` timestamp null,
    `eve_fecha_fin` timestamp  null,
    `eve_estado` varchar(1) not null,	 
    `eve_fecha_creacion` timestamp not null default current_timestamp,
    `eve_fecha_modificacion` timestamp null default null,
    `eve_estado_logico` varchar(1) not null
);

-- --------------------------------------------------------
-- 
-- Estructura de tabla para la tabla `persona_externa`
-- --------------------------------------------------------
create table if not exists persona_externa (
 `pext_id` bigint(20) not null auto_increment primary key,
 `pext_nombres` varchar(60) not null, 
 `pext_apellidos` varchar(60) not null, 
 `pext_identificacion` varchar(15) not null,
 `pext_tipo_dni` varchar(5) not null,
 `pext_correo` varchar(50) not null, 
 `pext_celular` varchar(20) not null,
 `pext_telefono` varchar(20) null,
 `pext_genero` varchar(1) not null,
 `pext_fecha_nacimiento` date default null,
 `pext_edad` int default null,  
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
 
-- --------------------------------------------------------
-- 
-- Estructura de tabla para la tabla `interes`
-- --------------------------------------------------------
  create table if not exists interes (
 `int_id` bigint(20) not null auto_increment primary key,
 `int_descripcion` varchar(100) not null, 
 `int_nombre` varchar(100) not null, 
 `int_estado` varchar(1) not null,
 `int_fecha_creacion` timestamp not null default current_timestamp,
 `int_fecha_modificacion` timestamp null default null,
 `int_estado_logico` varchar(1) not null
 );
 
-- --------------------------------------------------------
-- 
-- Estructura de tabla para la tabla `persona_externa_intereses`
-- --------------------------------------------------------
 create table if not exists persona_externa_intereses (
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


--
-- Base de datos: `db_inscripcion`
--
DROP SCHEMA IF EXISTS `db_inscripcion` ;
CREATE SCHEMA IF NOT EXISTS `db_inscripcion` DEFAULT CHARACTER SET utf8 ;
USE `db_inscripcion` ;

GRANT ALL PRIVILEGES ON `db_inscripcion`.* TO 'uteg'@'localhost' IDENTIFIED BY 'Utegadmin2016*';

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `interesado`
--
create table if not exists `interesado` (
  `int_id` bigint(20) not null auto_increment primary key,
  `per_id` bigint(20) not null, 
  `int_estado` varchar(1) not null,
  `int_fecha_creacion` timestamp not null default current_timestamp,
  `int_fecha_modificacion` timestamp null default null,
  `int_estado_logico` varchar(1) not null
);
-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `aspirante`
--
create table if not exists `aspirante` ( 
  `asp_id` bigint(20) not null auto_increment primary key,
  `per_id` bigint(20) not null, 
  `asp_estado` varchar(1) not null,
  `asp_fecha_creacion` timestamp not null default current_timestamp,
  `asp_fecha_modificacion` timestamp null default null,
  `asp_estado_logico` varchar(1) not null 
) ;

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `solicitud_inscripcion`
--
create table if not exists `solicitud_inscripcion` ( 
 `sins_id` bigint(20) not null auto_increment primary key, 
 `sins_numsolicitud` varchar(15) not null UNIQUE,
 `int_id` bigint(20) not null, 
 `fupcm_id` bigint(20) not null, 
 `sins_FechaInicio` date default null,
 `sins_FechaFin` date default null,
 `sins_estado_solicitud` varchar(1) default null,
 `sins_estado` varchar(1) not null,
 `sins_fecha_creacion` timestamp not null default current_timestamp,
 `sins_fecha_modificacion` timestamp null default null,
 `sins_estado_logico` varchar(1) not null  
) ;


-- Base de Datos 

DROP SCHEMA IF EXISTS `db_inventario` ;
CREATE SCHEMA IF NOT EXISTS `db_inventario` default CHARACTER SET utf8 ;
USE `db_inventario`;

GRANT ALL PRIVILEGES ON `db_inventario`.* TO 'uteg'@'localhost' IDENTIFIED BY 'Utegadmin2016*';


-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `edificio`
--
create table if not exists `edificio` (
 `edi_id` bigint(20) not null auto_increment primary key,    
 `edi_descripcion` varchar(200) not null, 
 `edi_estado` varchar(1) not null,
 `edi_fecha_creacion` timestamp not null default current_timestamp,
 `edi_fecha_modificacion` timestamp null default null,
 `edi_estado_logico` varchar(1) not null
 );


-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `area`
--
create table if not exists `area` (
 `are_id` bigint(20) not null auto_increment primary key,   
 `edi_id` bigint(20) not null, 
 `are_descripcion` varchar(200) not null, 
 `are_estado` varchar(1) not null,
 `are_fecha_creacion` timestamp not null default current_timestamp,
 `are_fecha_modificacion` timestamp null default null,
 `are_estado_logico` varchar(1) not null,
 foreign key (edi_id) references `edificio`(edi_id)
 );

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `seccion`
--
create table if not exists `seccion` (
 `sec_id` bigint(20) not null auto_increment primary key,  
 `are_id` bigint(20) not null,
 `sec_descripcion` varchar(200) not null, 
 `sec_estado` varchar(1) not null,
 `sec_fecha_creacion` timestamp not null default current_timestamp,
 `sec_fecha_modificacion` timestamp null default null,
 `sec_estado_logico` varchar(1) not null,
 foreign key (are_id) references `area`(are_id)
 );

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `activo`
--
create table if not exists `activo` (
 `act_id` bigint(20) not null auto_increment primary key,
 `sec_id` bigint(100) not null,
 `per_id` bigint(100) not null,
 `act_codigo` varchar(50) not null, 
 `act_descripcion` varchar(200) not null,
 `act_marca` varchar(100) null,
 `act_modelo` varchar(100) null,
 `act_num_serie` varchar(100) null, 
 `act_estado` varchar(1) not null,
 `act_fecha_creacion` timestamp not null default current_timestamp,
 `act_fecha_modificacion` timestamp null default null,
 `act_estado_logico` varchar(1) not null,
 foreign key (sec_id) references `seccion`(sec_id)
 );
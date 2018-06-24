--
-- Base de datos: `db_academico`
--
USE `db_academico` ;

GRANT ALL PRIVILEGES ON `db_academico`.* TO 'uteg'@'localhost' IDENTIFIED BY 'sistemas1707';

-- --------------------------------------------------------
--
-- Estructura de tabla para `asignatura`
--
create table if not exists `asignatura` (
  `asi_id` bigint(20) not null auto_increment primary key,
  `asi_nombre` varchar(200) not null,
  `asi_descripcion` varchar(500) not null,
  `asi_estado_asignatura` varchar(1) not null,
  `asi_estado` varchar(1) not null,
  `asi_fecha_creacion` timestamp not null default current_timestamp,
  `asi_fecha_modificacion` timestamp null default null,
  `asi_estado_logico` varchar(1) not null  
);
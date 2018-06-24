-- Base de Datos 

DROP SCHEMA IF EXISTS `db_claustro` ;
CREATE SCHEMA IF NOT EXISTS `db_claustro` default CHARACTER SET utf8 ;
USE `db_claustro` ;

GRANT ALL PRIVILEGES ON `db_claustro`.* TO 'asgarduteg'@'localhost' IDENTIFIED BY 'Ut3G4dmi1n-Pr0ducci0n@2017*Onl1n3W@';
-- --------------------------------------------------------
-- Estructura de tabla para la tabla `expediente_profesor`
--
create table if not exists `expediente_profesor` (
  `epro_id` bigint(20) not null auto_increment primary key,
  `per_id` bigint(20) not null,  
  `epro_estado` varchar(1) not null,
  `epro_fecha_creacion` timestamp not null default current_timestamp,
  `epro_fecha_modificacion` timestamp null default null,
  `epro_estado_logico` varchar(1) not null
);


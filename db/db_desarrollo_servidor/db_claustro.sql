-- Base de Datos 

DROP SCHEMA IF EXISTS `db_claustro` ;
CREATE SCHEMA IF NOT EXISTS `db_claustro` default CHARACTER SET utf8 ;
USE `db_claustro` ;

GRANT ALL PRIVILEGES ON `db_claustro`.* TO 'utegasgard'@'localhost' IDENTIFIED BY 'Ut3G4dmi1n-d364rr00@ll20167*Onl1n3W@';
-- --------------------------------------------------------
-- Estructura de tabla para la tabla `expediente_profesor`
--
create table if not exists `expediente_profesor` (
  `epro_id` bigint(20) not null auto_increment primary key,
  `per_id` bigint(20) not null,    
  `cgen_id` bigint(20) null default null, -- referencia de la base db_general 
  `epro_acepta` varchar(1) null,
  `epro_fecha_acepta` timestamp null default null,
  `epro_estado_expediente` bigint(20) null,  -- referencia tabla de parametros db_general
  `epro_observacion` varchar(500) null,  
  `usu_id` bigint(20) null,  -- referencia al usuario que revisa el expediente de la tabla usuario en db_asgard
  `epro_fecha_revision` timestamp null default null,
  `epro_estado` varchar(1) not null,
  `epro_fecha_creacion` timestamp not null default current_timestamp,
  `epro_fecha_modificacion` timestamp null default null,
  `epro_estado_logico` varchar(1) not null
);


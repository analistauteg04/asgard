--
-- Base de datos: `db_preacademico`
--
DROP SCHEMA IF EXISTS `db_preacademico` ;
CREATE SCHEMA IF NOT EXISTS `db_preacademico` DEFAULT CHARACTER SET utf8 ;
USE `db_preacademico` ;

GRANT ALL PRIVILEGES ON `db_preacademico`.* TO 'uteg'@'localhost' IDENTIFIED BY 'Utegadmin2016*';





-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `nivel_preacademico`
create table if not exists `nivel_preacademico` (
  `npre_id` bigint(20) not null auto_increment primary key,
  `npre_nombre` varchar(150) default null,
  `npre_descripcion` varchar(500) default null,
  `npre_estado` varchar(1) not null,
  `npre_fecha_creacion` timestamp not null default current_timestamp,
  `npre_fecha_modificacion` timestamp null default null,
  `npre_estado_logico` varchar(1) not null
);

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `malla_preacademico`
--
create table if not exists `malla_preacademico` (
  `mpre_id` bigint(20) not null auto_increment primary key,
  `car_id` bigint(20) not null,
  `npre_id` bigint(20) not null,
  `mpre_codigo` varchar(50) default null,
  `mpre_nombre` varchar(150) default null,
  `mpre_descripcion` varchar(500) default null,
  `mpre_fechaInicio` date default null,
  `mpre_fechaFin` date default null,
  `mpre_estado_vigencia` varchar(1) not null,
  `mpre_estado` varchar(1) not null,
  `mpre_fecha_creacion` timestamp not null default current_timestamp,
  `mpre_fecha_modificacion` timestamp null default null,
  `mpre_estado_logico` varchar(1) not null,
  foreign key (car_id) references `carrera`(car_id),
  foreign key (npre_id) references `nivel_preacademico`(npre_id)
);

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `malla_nivel`
create table if not exists `malla_nivel` (
  `mniv_id` bigint(20) not null auto_increment primary key,
  `mpre_id` bigint(20) not null,
  `npre_id` bigint(20) not null, 
  `mniv_estado` varchar(1) not null,
  `mniv_fecha_creacion` timestamp not null default current_timestamp,
  `mniv_fecha_modificacion` timestamp null default null,
  `mniv_estado_logico` varchar(1) not null,
  foreign key (mpre_id) references `malla_preacademico`(mpre_id),
  foreign key (npre_id) references `nivel_preacademico`(npre_id)
);

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `asignatura_malla`
--
create table if not exists `asignatura_malla` (
  `amal_id` bigint(20) not null auto_increment primary key,
  `asi_id` bigint(20) not null,
  `mniv_id` bigint(20) not null,
  `amal_estado` varchar(1) not null,
  `amal_fecha_creacion` timestamp not null default current_timestamp,
  `amal_fecha_modificacion` timestamp null default null,
  `amal_estado_logico` varchar(1) not null,
  foreign key (asi_id) references `asignatura`(asi_id),
  foreign key (mniv_id) references `malla_nivel`(mniv_id)
);

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `curso`
--
create table if not exists `curso` (
  `cur_id` bigint(20) not null auto_increment primary key,
  `nint_id` bigint(20) not null,
  `cur_nombre` varchar(200) not null,
  `cur_descripcion` varchar(500) not null,
  `cur_estado_vigencia` varchar(1) not null,
  `cur_estado` varchar(1) not null,
  `cur_fecha_creacion` timestamp not null default current_timestamp,
  `cur_fecha_modificacion` timestamp null default null,
  `cur_estado_logico` varchar(1) not null  
);

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `edificio`
--
create table if not exists `edificio` (
  `edi_id` bigint(20) not null auto_increment primary key,  
  `edi_nombre` varchar(100) not null,
  `edi_descripcion` varchar(500) not null,
  `edi_estado` varchar(1) not null,
  `edi_fecha_creacion` timestamp not null default current_timestamp,
  `edi_fecha_modificacion` timestamp null default null,
  `edi_estado_logico` varchar(1) not null  
);

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `aula`
--
create table if not exists `aula` (
  `aul_id` bigint(20) not null auto_increment primary key, 
  `edi_id` bigint(20) not null,
  `aul_nombre` varchar(100) not null,
  `aul_descripcion` varchar(500) not null,
  `aul_capacidad` int not null,
  `aul_estado` varchar(1) not null,
  `aul_fecha_creacion` timestamp not null default current_timestamp,
  `aul_fecha_modificacion` timestamp null default null,
  `aul_estado_logico` varchar(1) not null,
  foreign key (edi_id) references `edificio`(edi_id)  
);

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `docente`
--
create table if not exists `docente` (
  `doc_id` bigint(20) not null auto_increment primary key, 
  `per_id` bigint(20) not null, 
  `doc_estado` varchar(1) not null,
  `doc_fecha_creacion` timestamp not null default current_timestamp,
  `doc_fecha_modificacion` timestamp null default null,
  `doc_estado_logico` varchar(1) not null
);

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `horario`
create table if not exists `horario` (
  `hor_id` bigint(20) not null auto_increment primary key,
  `hor_nombre` varchar(150) default null,
  `hor_descripcion` varchar(500) default null,
  `hor_estado` varchar(1) not null,
  `hor_fecha_creacion` timestamp not null default current_timestamp,
  `hor_fecha_modificacion` timestamp null default null,
  `hor_estado_logico` varchar(1) not null
);

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `planificacion_preacademico`
--
create table if not exists `planificacion_preacademico` (
  `ppre_id` bigint(20) not null auto_increment primary key, 
  `ming_id` bigint(20) not null,
  `car_id` bigint(20) not null,
  `aul_id` bigint(20) null,
  `cur_id` bigint(20) not null,
  `doc_id` bigint(20) null,
  `hor_id` bigint(20) null,
  `ppre_cupo` int not null,
  `ppre_hora_inicio` varchar(5) not null,
  `ppre_hora_fin` varchar(5) not null,
  `ppre_fecha_inicio` timestamp null default null,
  `ppre_fecha_fin` timestamp null default null,  
  `ppre_estado` varchar(1) not null,
  `ppre_fecha_creacion` timestamp not null default current_timestamp,
  `ppre_fecha_modificacion` timestamp null default null,
  `ppre_estado_logico` varchar(1) not null,
  foreign key (car_id) references `carrera`(car_id),
  foreign key (aul_id) references `aula`(aul_id),
  foreign key (cur_id) references `curso`(cur_id),
  foreign key (doc_id) references `docente`(doc_id),
  foreign key (hor_id) references `horario`(hor_id)
);

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `asignacion_preacademico`
--
create table if not exists `asignacion_preacademico` (
  `apre_id` bigint(20) not null auto_increment primary key,
  `ppre_id` bigint(20) not null,  
  `asp_id` bigint(20) not null,
  `apre_estado` varchar(1) not null,
  `apre_fecha_creacion` timestamp not null default current_timestamp,
  `apre_fecha_modificacion` timestamp null default null,
  `apre_estado_logico` varchar(1) not null,
  foreign key (ppre_id) references `planificacion_preacademico`(ppre_id)
);


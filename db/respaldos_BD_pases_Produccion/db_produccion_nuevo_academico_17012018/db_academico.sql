--
-- Base de datos: `db_academico`
--
DROP SCHEMA IF EXISTS `db_academico` ;
CREATE SCHEMA IF NOT EXISTS `db_academico` DEFAULT CHARACTER SET utf8 ;
USE `db_academico` ;

GRANT ALL PRIVILEGES ON `db_academico`.* TO 'asgarduteg' IDENTIFIED BY 'Ut3G4dmi1n-Pr0ducci0n@2017*Onl1n3W@';
-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `tipo_nivel_estudio`
--
create table if not exists `tipo_nivel_estudio` (
  `tnes_id` bigint(20) not null auto_increment primary key,
  `tnes_nombre` varchar(300) not null,
  `tnes_descripcion` varchar(500) not null,    
  `tnes_estado` varchar(1) not null,
  `tnes_fecha_creacion` timestamp not null default current_timestamp,
  `tnes_fecha_modificacion` timestamp null default null,
  `tnes_estado_logico` varchar(1) not null
);


-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `nivel_instruccion`
--
create table if not exists `nivel_instruccion` (
 `nins_id` bigint(20) not null auto_increment primary key,
 `nins_nombre` varchar(250) default null,
 `nins_descripcion` varchar(500) default null,
 `nins_estado` varchar(1) not null,
 `nins_fecha_creacion` timestamp not null default current_timestamp,
 `nins_fecha_modificacion` timestamp null default null,
 `nins_estado_logico` varchar(1) not null
);

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `tipo_institucion_aca`
--
create table if not exists `tipo_institucion_aca` (
 `tiac_id` bigint(20) not null auto_increment primary key,
 `tiac_nombre` varchar(250) default null,
 `tiac_descripcion` varchar(500) default null,
 `tiac_estado` varchar(1) not null,
 `tiac_fecha_creacion` timestamp not null default current_timestamp,
 `tiac_fecha_modificacion` timestamp null default null,
 `tiac_estado_logico` varchar(1) not null
);




-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `facultad`
--
create table if not exists `facultad` (
  `fac_id` bigint(20) not null auto_increment primary key,  
  `fac_nombre` varchar(200) not null,
  `fac_descripcion` varchar(500) not null,
  `fac_estado` varchar(1) not null,
  `fac_fecha_creacion` timestamp not null default current_timestamp,
  `fac_fecha_modificacion` timestamp null default null,
  `fac_estado_logico` varchar(1) not null
);


-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `carrera`
--
create table if not exists `carrera` (
  `car_id` bigint(20) not null auto_increment primary key,  
  `fac_id` bigint(20) not null,
  `car_nombre` varchar(200) not null,
  `car_descripcion` varchar(500) not null,
  `car_estado` varchar(1) not null,
  `car_fecha_creacion` timestamp not null default current_timestamp,
  `car_fecha_modificacion` timestamp null default null,
  `car_estado_logico` varchar(1) not null,
  foreign key (fac_id) references `facultad`(fac_id)
);

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `nivel_academico`
create table if not exists `nivel_academico` (
  `naca_id` bigint(20) not null auto_increment primary key,
  `naca_nombre` varchar(150) default null,
  `naca_descripcion` varchar(500) default null,
  `naca_estado` varchar(1) not null,
  `naca_fecha_creacion` timestamp not null default current_timestamp,
  `naca_fecha_modificacion` timestamp null default null,
  `naca_estado_logico` varchar(1) not null
);

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `asignatura`
--
create table if not exists `asignatura` (
  `asi_id` bigint(20) not null auto_increment primary key,
  `asi_codigo` varchar(20) not null,
  `asi_nombre` varchar(200) not null,
  `asi_descripcion` varchar(500) not null,
  `asi_estado` varchar(1) not null,
  `asi_fecha_creacion` timestamp not null default current_timestamp,
  `asi_fecha_modificacion` timestamp null default null,
  `asi_estado_logico` varchar(1) not null
);

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `area_conocimiento`
--
create table if not exists `area_conocimiento` (
  `acon_id` bigint(20) not null auto_increment primary key,
  `acon_nombre` varchar(200) not null,
  `acon_descripcion` varchar(500) not null,
  `acon_estado` varchar(1) not null,
  `acon_fecha_creacion` timestamp not null default current_timestamp,
  `acon_fecha_modificacion` timestamp null default null,
  `acon_estado_logico` varchar(1) not null
);

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `conocimiento_asignatura`
--
create table if not exists `conocimiento_asignatura` (
  `casi_id` bigint(20) not null auto_increment primary key,
  `acon_id` bigint(20) not null,
  `asi_id` bigint(20) not null,
  `casi_estado` varchar(1) not null,
  `casi_fecha_creacion` timestamp not null default current_timestamp,
  `casi_fecha_modificacion` timestamp null default null,
  `casi_estado_logico` varchar(1) not null,
  foreign key (acon_id) references `area_conocimiento`(acon_id),
  foreign key (asi_id) references `asignatura`(asi_id)
);

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `periodo_metodo_ingreso`
--
create table if not exists `periodo_metodo_ingreso` (
  `pmin_id` bigint(20) not null auto_increment primary key,
  `pmin_anio` int not null,   
  `pmin_mes` int not null,   
  `nint_id` bigint(20) not null,
  `ming_id` bigint(20) not null,
  `pmin_codigo` varchar(10) not null,  
  `pmin_descripcion` varchar(100) not null,  
  `pmin_fecha_desde` timestamp null,
  `pmin_fecha_hasta` timestamp null,
  `pmin_usuario_ingreso` int not null,
  `pmin_usuario_modifica` int null,
  `pmin_estado` varchar(1) not null,
  `pmin_fecha_creacion` timestamp not null default current_timestamp,
  `pmin_fecha_modificacion` timestamp null default null,
  `pmin_estado_logico` varchar(1) not null
);

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `curso`
--
create table if not exists `curso` (
  `cur_id` bigint(20) not null auto_increment primary key,
  `pmin_id` bigint(20)  not null,    
  `cur_descripcion` varchar(500) not null,
  `cur_num_cupo` int null,
  `cur_num_inscritos` int null,  
  `cur_usuario_ingreso` int not null,
  `cur_usuario_modifica` int null,
  `cur_estado` varchar(1) not null,
  `cur_fecha_creacion` timestamp not null default current_timestamp,
  `cur_fecha_modificacion` timestamp null default null,
  `cur_estado_logico` varchar(1) not null,
  foreign key (pmin_id) references `periodo_metodo_ingreso`(pmin_id)
);

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `asignacion_curso`
--
create table if not exists `asignacion_curso` (
  `acur_id` bigint(20) not null auto_increment primary key,
  `cur_id` bigint(20) not null,  
  `asp_id` bigint(20) not null,
  `sins_id` bigint(20) not null,
  `acur_fecha_asignacion` timestamp not null,  
  `acur_usuario_asignacion` int not null,
  `acur_usuario_modificacion` int null,
  `acur_estado` varchar(1) not null,
  `acur_fecha_creacion` timestamp not null default current_timestamp,
  `acur_fecha_modificacion` timestamp null default null,
  `acur_estado_logico` varchar(1) not null,
  foreign key (cur_id) references `curso`(cur_id)
);
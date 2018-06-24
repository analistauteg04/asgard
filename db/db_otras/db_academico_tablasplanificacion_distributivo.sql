--
-- Base de datos: `db_academico`
--
USE `db_academico` ;

-- GRANT ALL PRIVILEGES ON `db_academico`.* TO 'uteg'@'localhost' IDENTIFIED BY 'sistemas1707';

-- --------------------------------------------------------
--
-- Estructura de tabla para `tipo_horario` (1 matutino, 2 nocturno, 3 especial, 4 clase en vivo)
--
create table if not exists `tipo_horario` (
  `thor_id` bigint(20) not null auto_increment primary key,
  `thor_nombre` varchar(200) not null,
  `thor_descripcion` varchar(500) not null,
  `thor_estado` varchar(1) not null,
  `thor_fecha_creacion` timestamp not null default current_timestamp,
  `thor_fecha_modificacion` timestamp null default null,
  `thor_estado_logico` varchar(1) not null  
);

-- --------------------------------------------------------
--
-- Estructura de tabla para `horario`
--
create table if not exists `horario` (
  `hor_id` bigint(20) not null auto_increment primary key,
  `thor_id` bigint(20) not null,
  `hor_descripcion` varchar(100) null,
  `hor_inicio` varchar(10) not null,
  `hor_fin` varchar(10) not null,
  `hor_lunes` varchar(1) null,
  `hor_martes` varchar(1) null,
  `hor_miercoles` varchar(1) null,
  `hor_jueves` varchar(1) null,
  `hor_viernes` varchar(1) null,
  `hor_sabado` varchar(1) null,
  `hor_domingo` varchar(1) null,
  `hor_rama` varchar(1) null, -- 1 licenciatura , 2 ingenieria
  `hor_usuario_ingreso` bigint(20) not null,
  `hor_usuario_modifica` bigint(20)  null,
  `hor_estado` varchar(1) not null,
  `hor_fecha_creacion` timestamp not null default current_timestamp,
  `hor_fecha_modificacion` timestamp null default null,
  `hor_estado_logico` varchar(1) not null,

  foreign key (thor_id) references `tipo_horario`(thor_id)

);

-- --------------------------------------------------------
--
-- Estructura de tabla para `bloque`
--

create table if not exists `bloque` (
  `blo_id` bigint(20) not null auto_increment primary key,
  `hor_id` bigint(20) not null,
  `nint_id` bigint(20) not null, -- para hacer la comparacion y traer filtro de bloque
  `blo_nombre` varchar(100) not null,
  `blo_descripcion`  varchar(100) not null,
  `blo_fecha_desde` timestamp null default null,
  `blo_fecha_hasta` timestamp null default null,
  `blo_usuario_ingreso` bigint(20) not null,
  `blo_usuario_modifica` bigint(20)  null,
  `blo_estado` varchar(1) not null,
  `blo_fecha_creacion` timestamp not null default current_timestamp,
  `blo_fecha_modificacion` timestamp null default null,
  `blo_estado_logico` varchar(1) not null,

  foreign key (hor_id) references `horario`(hor_id)

);

-- --------------------------------------------------------
--
-- Estructura de tabla para `semestre_academico`
--

create table if not exists `semestre_academico` (

  `saca_id` bigint(20) not null auto_increment primary key,
  `blo_id` bigint(20) not null, 
  `saca_nombre` varchar(100) not null,
  `saca_descripcion`  varchar(100) not null,
  `saca_fecha_desde` timestamp null default null,
  `saca_fecha_hasta` timestamp null default null,
  `saca_usuario_ingreso` bigint(20) not null,
  `saca_usuario_modifica` bigint(20)  null,
  `saca_estado` varchar(1) not null,
  `saca_fecha_creacion` timestamp not null default current_timestamp,
  `saca_fecha_modificacion` timestamp null default null,
  `saca_estado_logico` varchar(1) not null,

  foreign key (blo_id) references `bloque`(blo_id)

);

-- --------------------------------------------------------
--
-- Estructura de tabla para `anio_academico`
--
create table if not exists `anio_academico` (

  `aaca_id` bigint(20) not null auto_increment primary key,
  `saca_id` bigint(20) not null, 
  `aaca_nombre` varchar(100) not null,
  `aaca_descripcion` varchar(100) not null,
  `aaca_usuario_ingreso` bigint(20) not null,
  `aaca_usuario_modifica` bigint(20)  null,
  `aaca_estado` varchar(1) not null,
  `aaca_fecha_creacion` timestamp not null default current_timestamp,
  `aaca_fecha_modificacion` timestamp null default null,
  `aaca_estado_logico` varchar(1) not null,

  foreign key (saca_id) references `semestre_academico`(saca_id)
);

-- --------------------------------------------------------
--
-- Estructura de tabla para `periodo_academico`
--
create table if not exists `periodo_academico` (
  `paca_id` bigint(20) not null auto_increment primary key,  
  `nint_id` bigint(20) not null, -- pasa a bloque tambien para hacer la comparacion y traer filtro de bloque
  `aaca_id` bigint(20) not null, -- FK de anio_lectivo  
  `paca_nombre` varchar(100) not null,
  `paca_descripcion` varchar(100) not null,
  `paca_fecha_desde` timestamp null default null,
  `paca_fecha_hasta` timestamp null default null,
  `paca_usuario_ingreso` bigint(20) not null,
  `paca_usuario_modifica` bigint(20)  null,
  `paca_estado` varchar(1) not null,
  `paca_fecha_creacion` timestamp not null default current_timestamp,
  `paca_fecha_modificacion` timestamp null default null,
  `paca_estado_logico` varchar(1) not null,
  
  foreign key (aaca_id) references `anio_academico`(aaca_id)

);

-- --------------------------------------------------------
--
-- Estructura de tabla para `evaluacion_desempeno`
--
create table if not exists `evaluacion_desempeno` (
  `edes_id` bigint(20) not null auto_increment primary key,
  `epro_id` bigint(20) not null,  
  `paca_id` bigint(20) not null,
  `asi_id` bigint(20) not null,
  `nint_id` bigint(20) not null,
  `fac_id` bigint(20) not null,
  `hor_id` bigint(20) not null,
  `acon_id` bigint(20) not null,
  `car_id` bigint(20) not null,
  `edes_heteroevaluacion` double default null, 
  `edes_autoevaluacion` double default null, 
  `edes_coevaluacion` double default null, 
  `edes_directivo` double default null, 
  `edes_promedio` double default null, 
  `edes_usuario` bigint(20) null,
  `edes_usuario_modifica` bigint(20) null,
  `edes_estado` varchar(1) not null,
  `edes_fecha_creacion` timestamp not null default current_timestamp,
  `edes_fecha_modificacion` timestamp null default null,
  `edes_estado_logico` varchar(1) not null,
  foreign key (asi_id) references `asignatura`(asi_id),
  foreign key (paca_id) references `periodo_academico`(paca_id),
  foreign key (fac_id) references `facultad`(fac_id),
  foreign key (hor_id) references `horario`(hor_id),
  foreign key (acon_id) references `area_conocimiento`(acon_id),
  foreign key (car_id) references `carrera`(car_id)
);

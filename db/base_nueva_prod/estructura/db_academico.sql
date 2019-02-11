-- 
-- Base de datos: `db_academico`
-- 

DROP SCHEMA IF EXISTS `db_academico`;
CREATE SCHEMA IF NOT EXISTS `db_academico` DEFAULT CHARACTER SET utf8 ;
USE `db_academico` ;

-- GRANT ALL PRIVILEGES ON `db_academico`.* TO 'uteg'@'localhost' IDENTIFIED BY 'Utegadmin2016*';

-- --------------------------------------------------------
-- 
-- Estructura de tabla para la tabla `area_conocimiento`
-- 
create table if not exists `area_conocimiento` (
  `acon_id` bigint(20) not null auto_increment primary key,
  `acon_nombre` varchar(300) not null,
  `acon_descripcion` varchar(500) not null,
  `acon_usuario_ingreso` bigint(20) not null,
  `acon_usuario_modifica` bigint(20)  null,  
  `acon_estado` varchar(1) not null,
  `acon_fecha_creacion` timestamp not null default current_timestamp,
  `acon_fecha_modificacion` timestamp null default null,
  `acon_estado_logico` varchar(1) not null
);

-- --------------------------------------------------------
-- 
-- Estructura de tabla para la tabla `subarea_conocimiento`
-- 
create table if not exists `subarea_conocimiento` (
  `scon_id` bigint(20) not null auto_increment primary key,
  `acon_id` bigint(20) not null,
  `scon_nombre` varchar(300) not null,
  `scon_descripcion` varchar(500) not null,
  `scon_usuario_ingreso` bigint(20) not null,
  `scon_usuario_modifica` bigint(20)  null,  
  `scon_estado` varchar(1) not null,
  `scon_fecha_creacion` timestamp not null default current_timestamp,
  `scon_fecha_modificacion` timestamp null default null,
  `scon_estado_logico` varchar(1) not null,
  foreign key (acon_id) references `area_conocimiento`(acon_id)
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
-- Estructura de tabla para la tabla `tipo_estudio_academico`
-- 1.- Carrera, 2.- Programa, 3.- Diplomado
create table if not exists `tipo_estudio_academico` (
  `teac_id` bigint(20) not null auto_increment primary key, 
  `teac_nombre` varchar(300) not null,
  `teac_descripcion` varchar(500) not null,
  `teac_usuario_ingreso` bigint(20) not null,
  `teac_usuario_modifica` bigint(20)  null,    
  `teac_estado` varchar(1) not null,
  `teac_fecha_creacion` timestamp not null default current_timestamp,
  `teac_fecha_modificacion` timestamp null default null,
  `teac_estado_logico` varchar(1) not null
);


-- --------------------------------------------------------
-- 
-- Estructura de tabla para la tabla `unidad_academica`
-- 
create table if not exists `unidad_academica` (
 `uaca_id` bigint(20) not null auto_increment primary key,
 `uaca_nombre` varchar(300) not null,
 `uaca_descripcion` varchar(500) not null,
 `uaca_usuario_ingreso` bigint(20) not null,
 `uaca_usuario_modifica` bigint(20)  null,
 `uaca_estado` varchar(1) not null,
 `uaca_inscripcion` varchar(1) not null, -- 1 para formulario de inscripcion, 0 no muestra
 `uaca_fecha_creacion` timestamp not null default current_timestamp,
 `uaca_fecha_modificacion` timestamp null default null,
 `uaca_estado_logico` varchar(1) not null
);

-- --------------------------------------------------------
-- 
-- Estructura de tabla para la tabla `modalidad`
-- 1 distancia, 2 presencial, 3 semipresencial, 4 online

create table if not exists `modalidad` (
  `mod_id` bigint(20) not null auto_increment primary key, 
  `mod_nombre` varchar(300) not null,
  `mod_descripcion` varchar(500) not null,
  `mod_usuario_ingreso` bigint(20) not null,
  `mod_usuario_modifica` bigint(20)  null,
  `mod_estado` varchar(1) not null,
  `mod_fecha_creacion` timestamp not null default current_timestamp,
  `mod_fecha_modificacion` timestamp null default null,
  `mod_estado_logico` varchar(1) not null
);

-- --------------------------------------------------------
-- 
-- Estructura de tabla para la tabla `estudio_academico`
-- 
create table if not exists `estudio_academico` (
  `eaca_id` bigint(20) not null auto_increment primary key,
  `teac_id` bigint(20) not null,
  `eaca_nombre` varchar(300) not null,
  `eaca_descripcion` varchar(500) not null, 
  `eaca_alias` varchar(300) not null,
  `eaca_usuario_ingreso` bigint(20) not null,
  `eaca_usuario_modifica` bigint(20)  null,  
  `eaca_estado` varchar(1) not null,
  `eaca_fecha_creacion` timestamp not null default current_timestamp,
  `eaca_fecha_modificacion` timestamp null default null,
  `eaca_estado_logico` varchar(1) not null,
  foreign key (teac_id) references `tipo_estudio_academico`(teac_id)
);
-- --------------------------------------------------------
-- 
-- Estructura de tabla para la tabla `asignatura`
-- 
create table if not exists `asignatura` (
  `asi_id` bigint(20) not null auto_increment primary key, 
  `scon_id` bigint(20) not null,
  `asi_nombre` varchar(300) not null,
  `asi_descripcion` varchar(500) not null, 
  `asi_usuario_ingreso` bigint(20) not null,
  `asi_usuario_modifica` bigint(20)  null,   
  `asi_estado` varchar(1) not null,
  `asi_fecha_creacion` timestamp not null default current_timestamp,
  `asi_fecha_modificacion` timestamp null default null,
  `asi_estado_logico` varchar(1) not null,
  foreign key (scon_id) references `subarea_conocimiento`(scon_id)
);


-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `modalidad_estudio_unidad`
-- 
create table if not exists `modalidad_estudio_unidad` (
 `meun_id` bigint(20) not null auto_increment primary key,
 `uaca_id` bigint(20) not null, -- id de unidad academica
 `mod_id` bigint(20) not null, -- id modalidad 
 `eaca_id` bigint(20) not null, -- id de estudio academico
 `emp_id` bigint(20) not null, -- id de empresa
 `meun_usuario_ingreso` bigint(20) not null,
 `meun_usuario_modifica` bigint(20)  null,
 `meun_estado` varchar(1) not null,
 `meun_fecha_creacion` timestamp not null default current_timestamp,
 `meun_fecha_modificacion` timestamp null default null,
 `meun_estado_logico` varchar(1) not null,
 foreign key (uaca_id) references `unidad_academica`(uaca_id),
 foreign key (mod_id) references `modalidad`(mod_id),
 foreign key (eaca_id) references `estudio_academico`(eaca_id)
);

-- --------------------------------------------------------
-- 
-- Estructura de tabla para la tabla `unidad_estudio`
-- 
create table if not exists `unidad_estudio` (
 `uest_id` bigint(20) not null auto_increment primary key,
 `uest_nombre` varchar(300) not null,
 `uest_descripcion` varchar(500) not null,
 `uest_usuario_ingreso` bigint(20) not null,
 `uest_usuario_modifica` bigint(20)  null,
 `uest_estado` varchar(1) not null,
 `uest_fecha_creacion` timestamp not null default current_timestamp,
 `uest_fecha_modificacion` timestamp null default null,
 `uest_estado_logico` varchar(1) not null
);

-- --------------------------------------------------------
-- 
-- Estructura de tabla para la tabla `nivel_estudio`
-- 
create table if not exists `nivel_estudio` (
  `nest_id` bigint(20) not null auto_increment primary key, 
  `nest_nombre` varchar(150) default null,
  `nest_descripcion` varchar(500) default null,
  `nest_usuario_ingreso` bigint(20) not null,
  `nest_usuario_modifica` bigint(20)  null,
  `nest_estado` varchar(1) not null,
  `nest_fecha_creacion` timestamp not null default current_timestamp,
  `nest_fecha_modificacion` timestamp null default null,
  `nest_estado_logico` varchar(1) not null
);

-- --------------------------------------------------------
-- 
-- Estructura de tabla para la tabla `formacion_malla_academica`
-- 
create table if not exists `formacion_malla_academica` (
  `fmac_id` bigint(20) not null auto_increment primary key,
  `fmac_codigo` varchar(5) not null,
  `fmac_nombre` varchar(200) not null,
  `fmac_descripcion` varchar(500) not null,
  `fmac_usuario_ingreso` bigint(20) not null,
  `fmac_usuario_modifica` bigint(20)  null,
  `fmac_estado` varchar(1) not null,
  `fmac_fecha_creacion` timestamp not null default current_timestamp,
  `fmac_fecha_modificacion` timestamp null default null,
  `fmac_estado_logico` varchar(1) not null
);

-- --------------------------------------------------------
-- 
-- Estructura de tabla para la tabla `malla_academica`
-- 

create table if not exists `malla_academica` (
  `maca_id` bigint(20) not null auto_increment primary key, 
  `eaca_id` bigint(20) not null,
  `uaca_id` bigint(20) not null, 
  `mod_id` bigint(20) not null,
  `maca_tipo` varchar(1) null,  -- 1= método de ingreso, 2 = carrera. 
  `maca_nombre` varchar(300) not null,
  `maca_fecha_vigencia_inicio` timestamp null default null,
  `maca_fecha_vigencia_fin` timestamp null default null,  
  `maca_usuario_ingreso` bigint(20) not null,
  `maca_usuario_modifica` bigint(20)  null,
  `maca_estado` varchar(1) not null,
  `maca_fecha_creacion` timestamp not null default current_timestamp,
  `maca_fecha_modificacion` timestamp null default null,
  `maca_estado_logico` varchar(1) not null,
  foreign key (eaca_id) references `estudio_academico`(eaca_id),
  foreign key (uaca_id) references `unidad_academica`(uaca_id),
  foreign key (mod_id) references `modalidad`(mod_id)  
);

-- --------------------------------------------------------
-- 
-- Estructura de tabla para la tabla `malla_detalle`
-- 
create table if not exists `malla_academica_detalle` (
  `made_id` bigint(20) not null auto_increment primary key, 
  `maca_id` bigint(20) not null,
  `asi_id` bigint(20) not null,  
  `uest_id` bigint(20) not null,
  `nest_id` bigint(20) not null,
  `fmac_id` bigint(20) not null,
  `made_codigo_asignatura` varchar(300) not null,
  `made_usuario_ingreso` bigint(20) not null,
  `made_usuario_modifica` bigint(20)  null,
  `made_estado` varchar(1) not null,
  `made_fecha_creacion` timestamp not null default current_timestamp,
  `made_fecha_modificacion` timestamp null default null,
  `made_estado_logico` varchar(1) not null,
  foreign key (maca_id) references `malla_academica`(maca_id),
  foreign key (asi_id) references `asignatura`(asi_id),
  foreign key (uest_id) references `unidad_estudio`(uest_id),
  foreign key (nest_id) references `nivel_estudio`(nest_id),
  foreign key (fmac_id) references `formacion_malla_academica`(fmac_id)
  
);

-- --------------------------------------------------------
-- 
-- Estructura de tabla para la tabla `modulo_estudio`
-- 
create table if not exists `modulo_estudio` (
  `mest_id` bigint(20) not null auto_increment primary key, 
  `uaca_id` bigint(20) not null, 
  `mod_id` bigint(20) not null, -- id modalidad 
  `mest_codigo` varchar(20) not null, 
  `mest_nombre` varchar(300) not null, 
  `mest_descripcion` varchar(300) not null,
  `mest_alias` varchar(300) not null,
  `mest_usuario_ingreso` bigint(20) not null,
  `mest_usuario_modifica` bigint(20)  null,
  `mest_estado` varchar(1) not null,
  `mest_fecha_creacion` timestamp not null default current_timestamp,
  `mest_fecha_modificacion` timestamp null default null,
  `mest_estado_logico` varchar(1) not null, 
  foreign key (uaca_id) references `unidad_academica`(uaca_id),
  foreign key (mod_id) references `modalidad`(mod_id)
  
);

-- --------------------------------------------------------
-- 
-- Estructura de tabla para la tabla `semestre`
--
create table if not exists `semestre_academico` (
  `saca_id` bigint(20) not null auto_increment primary key, 
  `saca_nombre` varchar(300) not null, 
  `saca_descripcion` varchar(300) not null,
  `saca_fecha_registro` timestamp null default null, 
  `saca_usuario_ingreso` bigint(20) not null,
  `saca_usuario_modifica` bigint(20)  null,
  `saca_estado` varchar(1) not null,
  `saca_fecha_creacion` timestamp not null default current_timestamp,
  `saca_fecha_modificacion` timestamp null default null,
  `saca_estado_logico` varchar(1) not null  
);

-- --------------------------------------------------------
-- 
-- Estructura de tabla para la tabla `bloque`
-- 
create table if not exists `bloque_academico` (
  `baca_id` bigint(20) not null auto_increment primary key, 
  `baca_nombre` varchar(300) not null, 
  `baca_descripcion` varchar(300) not null,
  `baca_usuario_ingreso` bigint(20) not null,
  `baca_usuario_modifica` bigint(20)  null,
  `baca_estado` varchar(1) not null,
  `baca_fecha_creacion` timestamp not null default current_timestamp,
  `baca_fecha_modificacion` timestamp null default null,
  `baca_estado_logico` varchar(1) not null  
);


-- --------------------------------------------------------
-- 
-- Estructura de tabla para la tabla `periodo_academico`
-- Semestre
create table if not exists `periodo_academico` (
  `paca_id` bigint(20) not null auto_increment primary key, 
  `saca_id` bigint(20) not null,
  `baca_id` bigint(20) not null,
  `paca_anio_academico` varchar(10) not null,
  `paca_usuario_ingreso` bigint(20) not null,
  `paca_usuario_modifica` bigint(20)  null,
  `paca_estado` varchar(1) not null,
  `paca_fecha_creacion` timestamp not null default current_timestamp,
  `paca_fecha_modificacion` timestamp null default null,
  `paca_estado_logico` varchar(1) not null 
--  foreign key (sem_id) references `semestre`(sem_id),
--  foreign key (blo_id) references `bloque`(blo_id)
);

-- --------------------------------------------------------
-- 
-- Estructura de tabla para la tabla `periodo_academico_met_ingreso`
-- 
create table if not exists `periodo_academico_met_ingreso` (
  `pami_id` bigint(20) not null auto_increment primary key,
  `pami_anio` bigint(20) null,
  `pami_mes` bigint(20) null,
  `uaca_id` bigint(20) not null,
  `mod_id` bigint(20) not null,
  `ming_id` bigint(20) not null,
  `pami_fecha_inicio` timestamp null,
  `pami_fecha_fin` timestamp null,
  `pami_codigo` varchar(10) not null,
  `pami_usuario_ingreso` bigint(20) not null,
  `pami_usuario_modifica` bigint(20)  null,
  `pami_estado` varchar(1) not null,
  `pami_fecha_creacion` timestamp not null default current_timestamp,
  `pami_fecha_modificacion` timestamp null default null,
  `pami_estado_logico` varchar(1) not null
);

-- --------------------------------------------------------
-- Estructura de tabla para la tabla `estudiante`
-- 
create table if not exists `estudiante` (
  `est_id` bigint(20) not null auto_increment primary key,
  `per_id` bigint(20) not null,    
  `est_usuario_ingreso` bigint(20) not null,
  `est_usuario_modifica` bigint(20)  null,
  `est_estado` varchar(1) not null,
  `est_fecha_creacion` timestamp not null default current_timestamp,
  `est_fecha_modificacion` timestamp null default null,
  `est_estado_logico` varchar(1) not null
);

-- --------------------------------------------------------
-- Estructura de tabla para la tabla `profesor`
-- 
create table if not exists `profesor` (
  `pro_id` bigint(20) not null auto_increment primary key,
  `per_id` bigint(20) not null,    
  `pro_usuario_ingreso` bigint(20) not null,
  `pro_usuario_modifica` bigint(20)  null,
  `pro_estado` varchar(1) not null,
  `pro_fecha_creacion` timestamp not null default current_timestamp,
  `pro_fecha_modificacion` timestamp null default null,
  `pro_estado_logico` varchar(1) not null
);

-- --------------------------------------------------------
-- 
-- Estructura de tabla para la tabla `planificacion`
-- 
create table if not exists `planificacion_estudio_academico` (
  `peac_id` bigint(20) not null auto_increment primary key, 
  `uaca_id` bigint(20) not null,
  `mod_id` bigint(20) not null,
  `paca_id` bigint(20) null,
  `pami_id` bigint(20) null,
  `maca_id` bigint(20) not null,
  `peac_usuario_ingreso` bigint(20) not null,
  `peac_usuario_modifica` bigint(20)  null,
  `peac_estado` varchar(1) not null,
  `peac_fecha_creacion` timestamp not null default current_timestamp,
  `peac_fecha_modificacion` timestamp null default null,
  `peac_estado_logico` varchar(1) not null,
  foreign key (uaca_id) references `unidad_academica`(uaca_id),
  foreign key (mod_id) references `modalidad`(mod_id),
  foreign key (paca_id) references `periodo_academico`(paca_id),
  foreign key (maca_id) references `malla_academica`(maca_id),
  foreign key (pami_id) references `periodo_academico_met_ingreso`(pami_id)
);

-- --------------------------------------------------------
-- 
-- Estructura de tabla para la tabla `distributivo_horario`
-- 
create table if not exists `distributivo_horario` (
  `dhor_id` bigint(20) not null auto_increment primary key, 
  `dia_id` bigint(20) not null, 
  `dhor_hora_inicio` varchar(8) null default null,
  `dhor_hora_fin` varchar(8) null default null,
  `dhor_descripcion` varchar(200) null default null,
  `dhor_usuario_ingreso` bigint(20) not null,
  `dhor_usuario_modifica` bigint(20)  null,
  `dhor_fecha_registro` timestamp null default null,
  `dhor_estado` varchar(1) not null,
  `dhor_fecha_creacion` timestamp not null default current_timestamp,
  `dhor_fecha_modificacion` timestamp null default null,
  `dhor_estado_logico` varchar(1) not null 
);

-- --------------------------------------------------------
-- 
-- Estructura de tabla para la tabla `distributivo_academico`
-- 
create table if not exists `distributivo_academico` (
  `daca_id` bigint(20) not null auto_increment primary key, 
  `peac_id` bigint(20) not null,
  `pro_id` bigint(20) not null,
  `dhor_id` bigint(20) not null,
  `daca_fecha_registro` timestamp null default null,
  `daca_usuario_ingreso` bigint(20) not null,
  `daca_usuario_modifica` bigint(20)  null,
  `daca_estado` varchar(1) not null,
  `daca_fecha_creacion` timestamp not null default current_timestamp,
  `daca_fecha_modificacion` timestamp null default null,
  `daca_estado_logico` varchar(1) not null,  
  foreign key (peac_id) references `planificacion_estudio_academico`(peac_id),
  foreign key (pro_id) references `profesor`(pro_id),
  foreign key (dhor_id) references `distributivo_horario`(dhor_id)

);


-- --------------------------------------------------------
--  
-- Estructura de tabla para la tabla `paralelo`
-- 
create table if not exists `paralelo` (
  `par_id` bigint(20) not null auto_increment primary key, 
  `paca_id` bigint(20)  null,
  `pami_id` bigint(20)  null,
  `par_nombre` varchar(300) not null,
  `par_descripcion` varchar(500) not null,
  `par_num_cupo` int not null,
  `par_usuario_ingreso` bigint(20) not null,
  `par_usuario_modifica` bigint(20)  null,   
  `par_estado` varchar(1) not null,
  `par_fecha_creacion` timestamp not null default current_timestamp,
  `par_fecha_modificacion` timestamp null default null,
  `par_estado_logico` varchar(1) not null,
  foreign key (paca_id) references `periodo_academico`(paca_id),
  foreign key (pami_id) references `periodo_academico_met_ingreso`(pami_id)  
);

-- --------------------------------------------------------
-- 
-- Estructura de tabla para la tabla `matriculacion`
-- 
create table if not exists `matriculacion` (
  `mat_id` bigint(20) not null auto_increment primary key, 
  `peac_id` bigint(20) null, 
  `adm_id` bigint(20) null, 
  `est_id` bigint(20) null,    
  `sins_id` bigint(20) null,
  `mat_fecha_matriculacion` timestamp null default null,
  `mat_usuario_ingreso` bigint(20) not null,
  `mat_usuario_modifica` bigint(20)  null,  
  `mat_estado` varchar(1) not null,
  `mat_fecha_creacion` timestamp not null default current_timestamp,
  `mat_fecha_modificacion` timestamp null default null,
  `mat_estado_logico` varchar(1) not null,
  foreign key (peac_id) references `planificacion_estudio_academico`(peac_id),
  foreign key (est_id) references `estudiante`(est_id)
);

-- --------------------------------------------------------
-- 
-- Estructura de tabla para la tabla `asignacion_paralelo`
-- 
create table if not exists `asignacion_paralelo` (
  `apar_id` bigint(20) not null auto_increment primary key, 
  `par_id` bigint(20) null, 
  `mat_id` bigint(20) not null, 
  `mest_id` bigint(20) null, 
  `apar_descripcion` varchar(500) not null,   
  `apar_fecha_asignacion` timestamp null default null,
  `apar_usuario_asignacion` int not null,
  `apar_usuario_modificacion` int null,
  `apar_estado` varchar(1) not null,
  `apar_fecha_creacion` timestamp not null default current_timestamp,
  `apar_fecha_modificacion` timestamp null default null,
  `apar_estado_logico` varchar(1) not null,
  foreign key (par_id) references `paralelo`(par_id),
  foreign key (mat_id) references `matriculacion`(mat_id),
  foreign key (mest_id) references `modulo_estudio`(mest_id)
  
);

-- --------------------------------------------------------
-- 
-- Estructura de tabla para la tabla `modulo_estudio_empresa`
-- 
create table if not exists `modulo_estudio_empresa` (
  `meem_id` bigint(20) not null auto_increment primary key, 
  `mest_id` bigint(20) null,
  `emp_id` bigint(20) null,
  `meem_fecha_inicio` timestamp null default null,
  `meem_fecha_fin` timestamp null default null,
  `meem_usuario_ingreso` bigint(20) not null,
  `meem_usuario_modifica` bigint(20)  null,  
  `meem_estado_gestion` varchar(1) not null,  
  `meem_estado` varchar(1) not null,
  `meem_fecha_creacion` timestamp not null default current_timestamp,
  `meem_fecha_modificacion` timestamp null default null,
  `meem_estado_logico` varchar(1) not null,   
  foreign key (mest_id) references `modulo_estudio`(mest_id)
);

-- --------------------------------------------------------
-- 
-- Estructura de tabla para la tabla `modalidad_unidad_academico`

create table if not exists `modalidad_unidad_academico` (
  `muac_id` bigint(20) not null auto_increment primary key,
  `uaca_id` bigint(20) not null,
  `mod_id` bigint(20) not null,
  `emp_id` bigint(20) not null,
  `muac_usuario_ingreso` bigint(20) not null,
  `muac_usuario_modifica` bigint(20)  null,  
  `muac_estado` varchar(1) not null,
  `muac_fecha_creacion` timestamp not null default current_timestamp,
  `muac_fecha_modificacion` timestamp null default null,
  `muac_estado_logico` varchar(1) not null,
  foreign key (uaca_id) references `unidad_academica`(uaca_id),
  foreign key (mod_id) references `modalidad`(mod_id)
);


-- --------------------------------------------------------
-- 
-- Estructura de tabla para la tabla `estudio_academico_area_conocimiento`
-- --------------------------------------------------------
create table if not exists `estudio_academico_area_conocimiento` (
  `eaac_id` bigint(20) not null auto_increment primary key,   
  `eaca_id` bigint(20) null,
  `mest_id` bigint(20) null,
  `acon_id` bigint(20) not null,     
  `eaac_estado` varchar(1) not null,
  `eaac_fecha_creacion` timestamp not null default current_timestamp,
  `eaac_fecha_modificacion` timestamp null default null,
  `eaac_estado_logico` varchar(1) not null,
  foreign key (eaca_id) references `estudio_academico`(eaca_id),
  foreign key (mest_id) references `modulo_estudio`(mest_id),
  foreign key (acon_id) references `area_conocimiento`(acon_id)  
);


-- --------------------------------------------------------
-- 
-- Estructura de tabla para la tabla `horario_asignatura_periodo`
-- --------------------------------------------------------
create table if not exists `horario_asignatura_periodo` (
  `hape_id` bigint(20) not null auto_increment primary key,   
  `asi_id` bigint(20) not null,
  `paca_id` bigint(20) not null,
  `pro_id` bigint(20) not null,
  `uaca_id` bigint(20) not null,
  `mod_id` bigint(20) not null,
  `dia_id` bigint(20) not null,
  `hape_hora_entrada` varchar(10) not null,
  `hape_hora_salida` varchar(10) not null,
  `hape_estado` varchar(1) not null,
  `hape_fecha_creacion` timestamp not null default current_timestamp,
  `hape_fecha_modificacion` timestamp null default null,
  `hape_estado_logico` varchar(1) not null,
  foreign key (asi_id) references `asignatura`(asi_id),
  foreign key (paca_id) references `periodo_academico`(paca_id),
  foreign key (pro_id) references `profesor`(pro_id),
  foreign key (uaca_id) references `unidad_academica`(uaca_id),
  foreign key (mod_id) references `modalidad`(mod_id)
);

-- --------------------------------------------------------
-- 
-- Estructura de tabla para la tabla `registro_marcacion`
-- --------------------------------------------------------
create table if not exists `registro_marcacion` (
  `rmar_id` bigint(20) not null auto_increment primary key,   
  `rmar_tipo` varchar(1) not null, -- 'E' entrada clases 'S' salida de clases
  `pro_id` bigint(20) not null,
  `hape_id` bigint(20) not null,
  `rmar_fecha_hora_entrada` timestamp null,    
  `rmar_fecha_hora_salida` timestamp null,  
  `rmar_direccion_ip` varchar(20) not null,
  `usu_id` bigint(20) not null,
  `rmar_estado` varchar(1) not null,
  `rmar_fecha_creacion` timestamp not null default current_timestamp,
  `rmar_fecha_modificacion` timestamp null default null,
  `rmar_estado_logico` varchar(1) not null,
  foreign key (pro_id) references `profesor`(pro_id),
  foreign key (hape_id) references `horario_asignatura_periodo`(hape_id)
);
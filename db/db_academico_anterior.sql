--
-- Base de datos: `db_academico`
--
DROP SCHEMA IF EXISTS `db_academico` ;
CREATE SCHEMA IF NOT EXISTS `db_academico` DEFAULT CHARACTER SET utf8 ;
USE `db_academico` ;

GRANT ALL PRIVILEGES ON `db_academico`.* TO 'uteg'@'localhost' IDENTIFIED BY 'Utegadmin2016*';

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
-- Estructura de tabla para la tabla `nivel_interes`
--
create table if not exists `unidad_academica` (
 `uaca_id` bigint(20) not null auto_increment primary key,
 `uaca_nombre` varchar(300) not null,
 `uaca_descripcion` varchar(500) not null,
 `uaca_estado` varchar(1) not null,
 `uaca_fecha_creacion` timestamp not null default current_timestamp,
 `uaca_fecha_modificacion` timestamp null default null,
 `uaca_estado_logico` varchar(1) not null
);

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `facultad`
--
create table if not exists `facultad` (
  `fac_id` bigint(20) not null auto_increment primary key, 
  `nint_id` bigint(20) not null,
  `fac_nombre` varchar(500) not null,
  `fac_descripcion` varchar(500) not null,
  `fac_estado` varchar(1) not null,
  `fac_fecha_creacion` timestamp not null default current_timestamp,
  `fac_fecha_modificacion` timestamp null default null,
  `fac_estado_logico` varchar(1) not null
);


-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `modalidad`
-- 1 distancia, 2 presencial, 3 semipresencial, 4 online
create table if not exists `modalidad` (
  `mod_id` bigint(20) not null auto_increment primary key, 
  `mod_nombre` varchar(200) not null,
  `mod_descripcion` varchar(500) not null,
  `mod_nivel_grado` bigint(20) null,
  `mod_nivel_posgrado` bigint(20) null,
  `mod_nivel_educacion` bigint(20) null,
  `mod_estado` varchar(1) not null,
  `mod_fecha_creacion` timestamp not null default current_timestamp,
  `mod_fecha_modificacion` timestamp null default null,
  `mod_estado_logico` varchar(1) not null
);

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `tipo_carrera`
-- 1 carrera, 2 programa
create table if not exists `tipo_carrera` (
 `tica_id` bigint(20) not null auto_increment primary key,
 `tica_nombre` varchar(250) default null,
 `tica_descripcion` varchar(500) default null,
 `tica_estado` varchar(1) not null,
 `tica_fecha_creacion` timestamp not null default current_timestamp,
 `tica_fecha_modificacion` timestamp null default null,
 `tica_estado_logico` varchar(1) not null
);

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `carrera`
-- 
create table if not exists `carrera` (
  `car_id` bigint(20) not null auto_increment primary key,  
  `car_nombre` varchar(200) not null,
  `car_descripcion` varchar(500) not null,
  `car_alias` varchar(200) not null,
  `car_total_asignatura` int null, 
  `car_duracion_anio` int null, 
  `car_estado_carrera` varchar(2) not null,
  `car_estado` varchar(1) not null,
  `car_fecha_creacion` timestamp not null default current_timestamp,
  `car_fecha_aprobacion` timestamp null default null,  
  `car_fecha_modificacion` timestamp null default null,
  `car_estado_logico` varchar(1) not null 
);

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `carrera`
--
create table if not exists `carrera_malla` (
  `cmal_id` bigint(20) not null auto_increment primary key, 
  `car_id` bigint(20) not null,   
  `fac_id` bigint(20) not null,
  `tica_id` bigint(20) not null, 
  `mod_id` bigint(20) not null, 
  `car_codigo` varchar(100) not null,
  -- `car_nombre` varchar(200) not null,
  -- `car_descripcion` varchar(500) not null,
  `cmal_nivel` varchar(100) null,
  `cmal_grado_academico` varchar(100) null,
  `cmal_unidad_seguimiento` varchar(100) null,
  `cmal_centro_apoyo` varchar(100) null,
  `cmal_perspectiva` varchar(100) null,
  `cmal_total_asignatura` int null, 
  `cmal_duracion_anio` int null, 
  `cmal_costo_anual` double default null, 
  `cmal_titulo_academico` varchar(150) null, 
  `cmal_numero_colegiado` varchar(150) null,  
  `cmal_numero_conesup` varchar(150) null,  
  `cmal_valor_arancel` double default null, 
  `cmal_pra_preprofesion` varchar(150) null,
  `cmal_proyecto_titulacion` varchar(2) null,
  `cmal_estado_carrera` varchar(2) not null,
  `cmal_estado` varchar(1) not null,
  `cmal_fecha_creacion` timestamp not null default current_timestamp,
  `cmal_fecha_aprobacion` timestamp null default null,  
  `cmal_fecha_modificacion` timestamp null default null,
  `cmal_estado_logico` varchar(1) not null,

  foreign key (fac_id) references `facultad`(fac_id),
  foreign key (tica_id) references `tipo_carrera`(tica_id),
  foreign key (mod_id) references `modalidad`(mod_id)
);

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `tipo_sub_carrera`
-- Información de la 2da carrera a consultar 
create table if not exists `modalidad_carrera_nivel` (
 `mcni_id` bigint(20) not null auto_increment primary key,
 `nint_id` bigint(20) not null, -- nivel interes de la base de captation
 `mod_id` bigint(20) not null, -- id modalidad de la base académicos
 `car_id` bigint(20) not null, -- id de la carrera de la base académicos
 `mcni_estado` varchar(1) not null,
 `mcni_fecha_creacion` timestamp not null default current_timestamp,
 `mcni_fecha_modificacion` timestamp null default null,
 `mcni_estado_logico` varchar(1) not null
);

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `unidad`
--
create table if not exists `unidad` (
  `uni_id` bigint(20) not null auto_increment primary key,
  `uni_nombre` varchar(200) not null,
  `uni_descripcion` varchar(500) not null,
  `uni_estado` varchar(1) not null,
  `uni_fecha_creacion` timestamp not null default current_timestamp,
  `uni_fecha_modificacion` timestamp null default null,
  `uni_estado_logico` varchar(1) not null
  
);

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `nivel_academico`
create table if not exists `nivel_academico` (
  `naca_id` bigint(20) not null auto_increment primary key,
  `uni_id` bigint(20) not null,
  `naca_nombre` varchar(150) default null,
  `naca_descripcion` varchar(500) default null,
  `naca_semestre` varchar(100) default null,
  `naca_estado` varchar(1) not null,
  `naca_fecha_creacion` timestamp not null default current_timestamp,
  `naca_fecha_modificacion` timestamp null default null,
  `naca_estado_logico` varchar(1) not null,
  
  foreign key (uni_id) references `unidad`(uni_id)
);

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `campo_formacion`
--
create table if not exists `campo_formacion` (
  `cfor_id` bigint(20) not null auto_increment primary key,
  `cfor_codigo` varchar(5) not null,
  `cfor_nombre` varchar(200) not null,
  `cfor_descripcion` varchar(500) not null,
  `cfor_estado` varchar(1) not null,
  `cfor_fecha_creacion` timestamp not null default current_timestamp,
  `cfor_fecha_modificacion` timestamp null default null,
  `cfor_estado_logico` varchar(1) not null
);

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `asignatura`
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

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `carrera_asignatura`
-- 
create table if not exists `carrera_asignatura` (
  `casi_id` bigint(20) not null auto_increment primary key,
  `car_id` bigint(20) not null,
  `asi_id` bigint(20) not null,
  `naca_id` bigint(20) not null,
  `cfor_id` bigint(20) null,
  `casi_codigo_legal` varchar(200) null,
  `casi_hora_duracion` int not null,
  `casi_credito` int not null,
  `casi_estado` varchar(1) not null,
  `casi_fecha_creacion` timestamp not null default current_timestamp,
  `casi_fecha_modificacion` timestamp null default null,
  `casi_estado_logico` varchar(1) not null,  
 -- foreign key (car_id) references `carrera`(car_id),
  foreign key (asi_id) references `asignatura`(asi_id),
  foreign key (naca_id) references `nivel_academico`(naca_id),
  foreign key (cfor_id) references `campo_formacion`(cfor_id)
);

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `requisito`
--
create table if not exists `requisito` (
  `req_id` bigint(20) not null auto_increment primary key,
  `casi_id` bigint(20) not null,
  `asi_id` bigint(20) null,
  `req_comentario` varchar(200) null, -- texto por si necesita escribir algun comentario
  `req_estado` varchar(1) not null,
  `req_fecha_creacion` timestamp not null default current_timestamp,
  `req_fecha_modificacion` timestamp null default null,
  `req_estado_logico` varchar(1) not null,
  
  foreign key (casi_id) references `carrera_asignatura`(casi_id),
  foreign key (asi_id) references `asignatura`(asi_id)
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
-- Estructura de tabla para la tabla `subarea_conocimiento`
--
create table if not exists `subarea_conocimiento` (
  `scon_id` bigint(20) not null auto_increment primary key,
  `acon_id` bigint(20) not null,
  `scon_nombre` varchar(200) not null,
  `scon_descripcion` varchar(500) not null,
  `scon_estado` varchar(1) not null,
  `scon_fecha_creacion` timestamp not null default current_timestamp,
  `scon_fecha_modificacion` timestamp null default null,
  `scon_estado_logico` varchar(1) not null,
  foreign key (acon_id) references `area_conocimiento`(acon_id)
);

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `sub_conoc_asignatura`
--
create table if not exists `sub_conoc_asignatura` (
  `scas_id` bigint(20) not null auto_increment primary key,
  `scon_id` bigint(20) not null,
  `asi_id` bigint(20) not null,
  `scas_estado` varchar(1) not null,
  `scas_fecha_creacion` timestamp not null default current_timestamp,
  `scas_fecha_modificacion` timestamp null default null,
  `scas_estado_logico` varchar(1) not null,
  foreign key (scon_id) references `subarea_conocimiento`(scon_id),
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
  `mod_id` bigint(20) not null,
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
  `pmin_estado_logico` varchar(1) not null,
  foreign key (mod_id) references `modalidad`(mod_id)
  
);

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `curso`
--
create table if not exists `curso` (
  `cur_id` bigint(20) not null auto_increment primary key,
  `cur_nombre` varchar(500) not null,  
  `cur_descripcion` varchar(500) not null,   
  `cur_estado` varchar(1) not null,
  `cur_fecha_creacion` timestamp not null default current_timestamp,
  `cur_fecha_modificacion` timestamp null default null,
  `cur_estado_logico` varchar(1) not null
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
  `acur_fecha_asignacion` timestamp null,  
  `acur_usuario_asignacion` int not null,
  `acur_usuario_modificacion` int null,
  `acur_estado` varchar(1) not null,
  `acur_fecha_creacion` timestamp not null default current_timestamp,
  `acur_fecha_modificacion` timestamp null default null,
  `acur_estado_logico` varchar(1) not null,
  foreign key (cur_id) references `curso`(cur_id)
);

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `tipo_malla`
--
create table if not exists `tipo_malla` (
 `tmal_id` bigint(20) not null auto_increment primary key,
 `tmal_nombre` varchar(250) not null,
 `tmal_descripcion` varchar(500) not null,
 `tmal_estado` varchar(1) not null,
 `tmal_fecha_creacion` timestamp not null default current_timestamp,
 `tmal_fecha_modificacion` timestamp null default null,
 `tmal_estado_logico` varchar(1) not null  
);

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `cabecera_malla`
--
create table if not exists `cabecera_malla` (
  `cmal_id` bigint(20) not null auto_increment primary key,
  `tmal_id` bigint(20) not null,
  `cmal_nombre` varchar(250) not null,
  `cmal_descripcion` varchar(500) not null,   
  `cmal_fecha_vigencia_inicio` timestamp null default null,
  `cmal_fecha_vigencia_fin` timestamp null default null,
  `cmal_usuario_ingreso` int not null,
  `cmal_usuario_modifica` int null,  
  `cmal_estado` varchar(1) not null,
  `cmal_fecha_creacion` timestamp not null default current_timestamp,
  `cmal_fecha_modificacion` timestamp null default null,
  `cmal_estado_logico` varchar(1) not null,
  foreign key (tmal_id) references `tipo_malla`(tmal_id)
);

--
-- Estructura de tabla para la tabla `detalle_malla`
--
create table if not exists `detalle_malla` (
  `dmal_numero` bigint(20) not null auto_increment primary key,
  `cmal_id` bigint(20) not null,
  `casi_id` bigint(20) not null,
  `dmal_usuario_ingreso` int not null,
  `dmal_usuario_modifica` int null,   
  `dmal_estado` varchar(1) not null,
  `dmal_fecha_creacion` timestamp not null default current_timestamp,
  `dmal_fecha_modificacion` timestamp null default null,
  `dmal_estado_logico` varchar(1) not null,
  
  foreign key (cmal_id) references `cabecera_malla`(cmal_id),
  foreign key (casi_id) references `carrera_asignatura`(casi_id)
);

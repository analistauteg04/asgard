-- 
-- Base de datos: `db_academico`
-- 

DROP SCHEMA IF EXISTS `db_academico`;
CREATE SCHEMA IF NOT EXISTS `db_academico` DEFAULT CHARACTER SET utf8 ;
USE `db_academico` ;


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
-- 1.- Carrera, 2.- Programa
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
  `uaca_id` bigint(20) not null,
  `asi_nombre` varchar(300) not null,
  `asi_descripcion` varchar(500) not null, 
  `asi_usuario_ingreso` bigint(20) not null,
  `asi_usuario_modifica` bigint(20)  null,   
  `asi_estado` varchar(1) not null,
  `asi_fecha_creacion` timestamp not null default current_timestamp,
  `asi_fecha_modificacion` timestamp null default null,
  `asi_estado_logico` varchar(1) not null,
  foreign key (scon_id) references `subarea_conocimiento`(scon_id),
  foreign key (uaca_id) references `unidad_academica`(uaca_id)
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
  `meun_id` bigint(20) not null,  
  `maca_tipo` varchar(1) null,  -- 1= método de ingreso, 2 = carrera.
  `maca_codigo` varchar(50) null,  
  `maca_nombre` varchar(300) not null,
  `maca_fecha_vigencia_inicio` timestamp null default null,
  `maca_fecha_vigencia_fin` timestamp null default null,  
  `maca_usuario_ingreso` bigint(20) not null,
  `maca_usuario_modifica` bigint(20)  null,
  `maca_estado` varchar(1) not null,
  `maca_fecha_creacion` timestamp not null default current_timestamp,
  `maca_fecha_modificacion` timestamp null default null,
  `maca_estado_logico` varchar(1) not null,
  foreign key (meun_id) references `modalidad_estudio_unidad`(meun_id)  
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
  `made_hora` integer(04) null,
  `made_credito` integer(2) null,
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
  `saca_anio` integer(4) not null,
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
  `baca_anio` integer(4) not null,
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
-- 
create table if not exists `periodo_academico` (
  `paca_id` bigint(20) not null auto_increment primary key, 
  `saca_id` bigint(20) null,
  `baca_id` bigint(20) null,  
  `paca_activo` varchar(1) not null,
  `paca_fecha_inicio` timestamp null default null,
  `paca_fecha_fin` timestamp null default null,
  `paca_usuario_ingreso` bigint(20) not null,
  `paca_usuario_modifica` bigint(20)  null,  
  `paca_estado` varchar(1) not null,
  `paca_fecha_creacion` timestamp not null default current_timestamp,
  `paca_fecha_modificacion` timestamp null default null,
  `paca_estado_logico` varchar(1) not null,
  foreign key (saca_id) references `semestre_academico`(saca_id),
  foreign key (baca_id) references `bloque_academico`(baca_id)
);

-- --------------------------------------------------------
-- Estructura de tabla para la tabla `estudiante`
-- 
create table if not exists `estudiante` (
  `est_id` bigint(20) not null auto_increment primary key,
  `per_id` bigint(20) not null,    
  `est_matricula` varchar(20) not null,    
  `est_usuario_ingreso` bigint(20) not null,
  `est_usuario_modifica` bigint(20)  null,
  `est_estado` varchar(1) not null,
  `est_fecha_creacion` timestamp not null default current_timestamp,
  `est_fecha_modificacion` timestamp null default null,
  `est_estado_logico` varchar(1) not null
);

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `dedicacion_docente`
--
create table if not exists `dedicacion_docente` (
 `ddoc_id` bigint(20) not null auto_increment primary key,
 `ddoc_nombre` varchar(100) default null,
 `ddoc_estado` varchar(1) not null,
 `ddoc_fecha_creacion` timestamp not null default current_timestamp,
 `ddoc_fecha_modificacion` timestamp null default null,
 `ddoc_estado_logico` varchar(1) not null
);

-- --------------------------------------------------------
-- Estructura de tabla para la tabla `profesor`
-- 
create table if not exists `profesor` (
  `pro_id` bigint(20) not null auto_increment primary key,
  `per_id` bigint(20) not null,
  `pro_fecha_contratacion` timestamp null default null,
  `pro_fecha_terminacion` timestamp null default null,  
  `pro_cv` varchar(255) null,
  `pro_usuario_ingreso` bigint(20) not null,
  `pro_usuario_modifica` bigint(20)  null,
  `pro_estado` varchar(1) not null,
  `pro_fecha_creacion` timestamp not null default current_timestamp,
  `pro_fecha_modificacion` timestamp null default null,
  `pro_estado_logico` varchar(1) not null
);

-- --------------------------------------------------------
-- Estructura de tabla para la tabla `profesor_instruccion`
-- 
create table if not exists `profesor_instruccion` (
  `pins_id` bigint(20) not null auto_increment primary key,
  `pro_id` bigint(20) not null, 
  `nins_id` bigint(20) not null,
  `pins_institucion` varchar(150) null,
  `pins_especializacion` varchar(150) null,
  `pins_titulo` varchar(200) not null,
  `pins_senescyt` varchar(50) null,
  `pins_usuario_ingreso` bigint(20) not null,
  `pins_usuario_modifica` bigint(20)  null,
  `pins_estado` varchar(1) not null,
  `pins_fecha_creacion` timestamp not null default current_timestamp,
  `pins_fecha_modificacion` timestamp null default null,
  `pins_estado_logico` varchar(1) not null,
  foreign key (pro_id) references `profesor`(pro_id),
  foreign key (nins_id) references `nivel_instruccion`(nins_id)
);

-- --------------------------------------------------------
-- Estructura de tabla para la tabla `profesor_exp_doc`
-- 
create table if not exists `profesor_exp_doc` (
  `pedo_id` bigint(20) not null auto_increment primary key,
  `pro_id` bigint(20) not null,
  `ins_id` bigint(20) not null,
  `pedo_fecha_inicio` timestamp null default null,
  `pedo_fecha_fin` timestamp null default null,
  `pedo_denominacion` varchar(100) not null,
  `pedo_asignaturas` varchar(200) not null,
  `pedo_usuario_ingreso` bigint(20) not null,
  `pedo_usuario_modifica` bigint(20)  null,
  `pedo_estado` varchar(1) not null,
  `pedo_fecha_creacion` timestamp not null default current_timestamp,
  `pedo_fecha_modificacion` timestamp null default null,
  `pedo_estado_logico` varchar(1) not null,
  foreign key (pro_id) references `profesor`(pro_id)
);

-- --------------------------------------------------------
-- Estructura de tabla para la tabla `profesor_exp_prof`
-- 
create table if not exists `profesor_exp_prof` (
  `pepr_id` bigint(20) not null auto_increment primary key,
  `pro_id` bigint(20) not null,
  `pepr_fecha_inicio` timestamp null default null,
  `pepr_fecha_fin` timestamp null default null,
  `pepr_organizacion` varchar(200) not null,
  `pepr_denominacion` varchar(100) not null,
  `pepr_funciones` varchar(200) not null,
  `pepr_usuario_ingreso` bigint(20) not null,
  `pepr_usuario_modifica` bigint(20)  null,
  `pepr_estado` varchar(1) not null,
  `pepr_fecha_creacion` timestamp not null default current_timestamp,
  `pepr_fecha_modificacion` timestamp null default null,
  `pepr_estado_logico` varchar(1) not null,
  foreign key (pro_id) references `profesor`(pro_id)
);

-- --------------------------------------------------------
-- Estructura de tabla para la tabla `profesor_idiomas`
-- 
create table if not exists `profesor_idiomas` (
  `pidi_id` bigint(20) not null auto_increment primary key,
  `pro_id` bigint(20) not null,
  `idi_id` bigint(20) not null,
  `pidi_nivel_escrito` varchar(200) not null,
  `pidi_nivel_oral` varchar(100) not null,
  `pidi_certificado` varchar(200) not null,
  `pidi_institucion` varchar(200) not null,
  `pidi_usuario_ingreso` bigint(20) not null,
  `pidi_usuario_modifica` bigint(20)  null,
  `pidi_estado` varchar(1) not null,
  `pidi_fecha_creacion` timestamp not null default current_timestamp,
  `pidi_fecha_modificacion` timestamp null default null,
  `pidi_estado_logico` varchar(1) not null,
  foreign key (pro_id) references `profesor`(pro_id)
);

-- --------------------------------------------------------
-- Estructura de tabla para la tabla `profesor_investigacion`
-- 
create table if not exists `profesor_investigacion` (
  `pinv_id` bigint(20) not null auto_increment primary key,
  `pro_id` bigint(20) not null,
  `pinv_proyecto` varchar(200) not null,
  `pinv_ambito` varchar(100) not null,
  `pinv_responsabilidad` varchar(200) not null,
  `pinv_entidad` varchar(200) not null,
  `pinv_anio` varchar(4) not null,
  `pinv_duracion` varchar(20) not null,
  `pinv_usuario_ingreso` bigint(20) not null,
  `pinv_usuario_modifica` bigint(20)  null,
  `pinv_estado` varchar(1) not null,
  `pinv_fecha_creacion` timestamp not null default current_timestamp,
  `pinv_fecha_modificacion` timestamp null default null,
  `pinv_estado_logico` varchar(1) not null,
  foreign key (pro_id) references `profesor`(pro_id)
);

-- --------------------------------------------------------
-- Estructura de tabla para la tabla `profesor_capacitacion`
-- 
create table if not exists `profesor_capacitacion` (
  `pcap_id` bigint(20) not null auto_increment primary key,
  `pro_id` bigint(20) not null,
  `pcap_evento` varchar(200) not null,
  `pcap_institucion` varchar(200) not null,
  `pcap_anio` varchar(4) not null,
  `pcap_tipo` varchar(200) not null,
  `pcap_duracion` varchar(20) not null,
  `pcap_usuario_ingreso` bigint(20) not null,
  `pcap_usuario_modifica` bigint(20)  null,
  `pcap_estado` varchar(1) not null,
  `pcap_fecha_creacion` timestamp not null default current_timestamp,
  `pcap_fecha_modificacion` timestamp null default null,
  `pcap_estado_logico` varchar(1) not null,
  foreign key (pro_id) references `profesor`(pro_id)
);

-- --------------------------------------------------------
-- Estructura de tabla para la tabla `profesor_conferencia`
-- 
create table if not exists `profesor_conferencia` (
  `pcon_id` bigint(20) not null auto_increment primary key,
  `pro_id` bigint(20) not null,
  `pcon_evento` varchar(200) not null,
  `pcon_institucion` varchar(200) not null,
  `pcon_anio` varchar(4) not null,
  `pcon_ponencia` varchar(200) not null,
  `pcon_usuario_ingreso` bigint(20) not null,
  `pcon_usuario_modifica` bigint(20)  null,
  `pcon_estado` varchar(1) not null,
  `pcon_fecha_creacion` timestamp not null default current_timestamp,
  `pcon_fecha_modificacion` timestamp null default null,
  `pcon_estado_logico` varchar(1) not null,
  foreign key (pro_id) references `profesor`(pro_id)
);

-- --------------------------------------------------------
-- Estructura de tabla para la tabla `profesor_publicacion`
-- 
create table if not exists `profesor_publicacion` (
  `ppub_id` bigint(20) not null auto_increment primary key,
  `pro_id` bigint(20) not null,
  `ppub_produccion` varchar(100) not null,
  `ppub_titulo` varchar(200) not null,
  `ppub_editorial` varchar(50) not null,
  `ppub_isbn` varchar(50) not null,
  `ppub_autoria` varchar(200) not null,
  `ppub_usuario_ingreso` bigint(20) not null,
  `ppub_usuario_modifica` bigint(20)  null,
  `ppub_estado` varchar(1) not null,
  `ppub_fecha_creacion` timestamp not null default current_timestamp,
  `ppub_fecha_modificacion` timestamp null default null,
  `ppub_estado_logico` varchar(1) not null,
  foreign key (pro_id) references `profesor`(pro_id)
);

-- --------------------------------------------------------
-- Estructura de tabla para la tabla `profesor_coordinacion`
-- 
create table if not exists `profesor_coordinacion` (
  `pcoo_id` bigint(20) not null auto_increment primary key,
  `pro_id` bigint(20) not null,
  `pcoo_alumno` varchar(100) not null,
  `pcoo_programa` varchar(100) not null,
  `pcoo_academico` varchar(100) not null,
  `pcoo_institucion` varchar(200) not null,
  `pcoo_anio` varchar(4) not null,
  `pcoo_usuario_ingreso` bigint(20) not null,
  `pcoo_usuario_modifica` bigint(20)  null,
  `pcoo_estado` varchar(1) not null,
  `pcoo_fecha_creacion` timestamp not null default current_timestamp,
  `pcoo_fecha_modificacion` timestamp null default null,
  `pcoo_estado_logico` varchar(1) not null,
  foreign key (pro_id) references `profesor`(pro_id)
);

-- --------------------------------------------------------
-- Estructura de tabla para la tabla `profesor_evaluacion`
-- 
create table if not exists `profesor_evaluacion` (
  `peva_id` bigint(20) not null auto_increment primary key,
  `pro_id` bigint(20) not null,
  `peva_periodo` varchar(100) not null,
  `peva_institucion` varchar(100) not null,
  `peva_evaluacion` varchar(100) not null,
  `peva_usuario_ingreso` bigint(20) not null,
  `peva_usuario_modifica` bigint(20)  null,
  `peva_estado` varchar(1) not null,
  `peva_fecha_creacion` timestamp not null default current_timestamp,
  `peva_fecha_modificacion` timestamp null default null,
  `peva_estado_logico` varchar(1) not null,
  foreign key (pro_id) references `profesor`(pro_id)
);

-- --------------------------------------------------------
-- Estructura de tabla para la tabla `profesor_coordinacion`
-- 
create table if not exists `profesor_coordinacion` (
  `pcoo_id` bigint(20) not null auto_increment primary key,
  `pro_id` bigint(20) not null,
  `pcoo_alumno` varchar(100) not null,
  `pcoo_programa` varchar(100) not null,
  `pcoo_academico` varchar(100) not null,
  `pcoo_institucion` varchar(200) not null,
  `pcoo_anio` varchar(4) not null,
  `pcoo_usuario_ingreso` bigint(20) not null,
  `pcoo_usuario_modifica` bigint(20)  null,
  `pcoo_estado` varchar(1) not null,
  `pcoo_fecha_creacion` timestamp not null default current_timestamp,
  `pcoo_fecha_modificacion` timestamp null default null,
  `pcoo_estado_logico` varchar(1) not null,
  foreign key (pro_id) references `profesor`(pro_id)
);

-- --------------------------------------------------------
-- Estructura de tabla para la tabla `profesor_referencia`
-- 
create table if not exists `profesor_referencia` (
  `pref_id` bigint(20) not null auto_increment primary key,
  `pro_id` bigint(20) not null,
  `pref_contacto` varchar(100) not null,
  `pref_relacion_cargo` varchar(100) not null,
  `pref_organizacion` varchar(100) not null,
  `pref_numero` varchar(100) not null,
  `pref_usuario_ingreso` bigint(20) not null,
  `pref_usuario_modifica` bigint(20)  null,
  `pref_estado` varchar(1) not null,
  `pref_fecha_creacion` timestamp not null default current_timestamp,
  `pref_fecha_modificacion` timestamp null default null,
  `pref_estado_logico` varchar(1) not null,
  foreign key (pro_id) references `profesor`(pro_id)
);

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `docente_estudios`
--
create table if not exists `docente_estudios` (
 `dest_id` bigint(20) not null auto_increment primary key,
 `dest_observacion` text default null,
 `dest_estado` varchar(1) not null,
 `dest_fecha_creacion` timestamp not null default current_timestamp,
 `dest_fecha_modificacion` timestamp null default null,
 `dest_estado_logico` varchar(1) not null 
);


-- --------------------------------------------------------
-- 
-- Estructura de tabla para la tabla `promocion_programa`
-- --------------------------------------------------------
create table if not exists `promocion_programa` (
 `ppro_id` bigint(20) not null auto_increment primary key,
 `ppro_anio` varchar(4) not null, 
 `ppro_mes` varchar(02) not null, 
 `ppro_codigo` varchar(20) not null,
 `uaca_id` bigint(20) not null,
 `mod_id` bigint(20) not null,
 `eaca_id` bigint(20) not null,
 `ppro_num_paralelo` integer(2) not null,
 `ppro_cupo` integer(3) not null,
 `ppro_usuario_ingresa` bigint(20) null,
 `ppro_estado` varchar(1) not null, 
 `ppro_fecha_creacion` timestamp not null default current_timestamp,
 `ppro_usuario_modifica` bigint(20) null,
 `ppro_fecha_modificacion` timestamp null default null,
 `ppro_estado_logico` varchar(1) not null,
 foreign key (uaca_id) references `unidad_academica`(uaca_id),
 foreign key (mod_id) references `modalidad`(mod_id),
 foreign key (eaca_id) references `estudio_academico`(eaca_id)
);

-- --------------------------------------------------------
-- 
-- Estructura de tabla para la tabla `paralelo_promocion_programa`
-- --------------------------------------------------------
create table if not exists `paralelo_promocion_programa` (
 `pppr_id` bigint(20) not null auto_increment primary key,
 `ppro_id` bigint(20) not null, 
 `pppr_cupo` integer(3) not null, 
 `pppr_cupo_actual` integer(3) null,  
 `pppr_descripcion` varchar(100) null,  
 `pppr_usuario_ingresa` bigint(20) null,
 `pppr_estado` varchar(1) not null, 
 `pppr_fecha_creacion` timestamp not null default current_timestamp,
 `pppr_usuario_modifica` bigint(20) null,
 `pppr_fecha_modificacion` timestamp null default null,
 `pppr_estado_logico` varchar(1) not null,
 foreign key (ppro_id) references `promocion_programa`(ppro_id) 
);

-- --------------------------------------------------------
-- 
-- Estructura de tabla para la tabla `planificacion_academica_malla`
-- 
create table if not exists `planificacion_academica_malla` (
  `pama_id` bigint(20) not null auto_increment primary key,   
  `paca_id` bigint(20) null,  
  `ppro_id` bigint(20) null,  
  `maca_id` bigint(20) not null,  
  `pama_fecha_registro` timestamp null default null,
  `pama_usuario_ingreso` bigint(20) not null,
  `pama_usuario_modifica` bigint(20)  null,
  `pama_estado` varchar(1) not null,
  `pama_fecha_creacion` timestamp not null default current_timestamp,
  `pama_fecha_modificacion` timestamp null default null,
  `pama_estado_logico` varchar(1) not null,
  foreign key (paca_id) references `periodo_academico`(paca_id),
  foreign key (ppro_id) references `promocion_programa`(ppro_id),
  foreign key (maca_id) references `malla_academica`(maca_id)  
);

-- --------------------------------------------------------
-- 
-- Estructura de tabla para la tabla `planifica_academic_malla_det`
-- 
create table if not exists `planifica_academic_malla_det` (
  `pamd_id` bigint(20) not null auto_increment primary key,   
  `pama_id` bigint(20) null,    
  `made_id` bigint(20) not null,
  `pamd_usuario_ingreso` bigint(20) not null,
  `pamd_usuario_modifica` bigint(20) null,
  `pamd_estado` varchar(1) not null,
  `pamd_fecha_creacion` timestamp not null default current_timestamp,
  `pamd_fecha_modificacion` timestamp null default null,
  `pamd_estado_logico` varchar(1) not null,
  foreign key (pama_id) references `planificacion_academica_malla`(pama_id),
  foreign key (made_id) references `malla_academica_detalle`(made_id) 
);

-- --------------------------------------------------------
--  
-- Estructura de tabla para la tabla `paralelo_planificacion`
-- 
create table if not exists `paralelo_planificacion` (
  `ppla_id` bigint(20) not null auto_increment primary key,   
  `pamd_id` bigint(20) not null,
  `pppr_id` bigint(20) null, 
  `ppla_nombre` varchar(300) not null,
  `ppla_num_cupo` int not null,
  `ppla_usuario_ingreso` bigint(20) not null,
  `ppla_usuario_modifica` bigint(20)  null,   
  `ppla_estado` varchar(1) not null,
  `ppla_fecha_creacion` timestamp not null default current_timestamp,
  `ppla_fecha_modificacion` timestamp null default null,
  `ppla_estado_logico` varchar(1) not null,  
  foreign key (pamd_id) references `planifica_academic_malla_det`(pamd_id),
  foreign key (pppr_id) references `paralelo_promocion_programa`(pppr_id)
);

-- --------------------------------------------------------
-- 
-- Estructura de tabla para la tabla `distributivo_academico`
-- 
create table if not exists `distributivo_academico` (
  `daca_id` bigint(20) not null auto_increment primary key, 
  `pamd_id` bigint(20) not null,
  `pro_id` bigint(20) not null,  
  `ppla_id` bigint(20) not null,  
  `daca_fecha_registro` timestamp null default null,
  `daca_usuario_ingreso` bigint(20) not null,
  `daca_usuario_modifica` bigint(20)  null,
  `daca_estado` varchar(1) not null,
  `daca_fecha_creacion` timestamp not null default current_timestamp,
  `daca_fecha_modificacion` timestamp null default null,
  `daca_estado_logico` varchar(1) not null,  
  foreign key (pamd_id) references `planifica_academic_malla_det`(pamd_id),
  foreign key (pro_id) references `profesor`(pro_id),
  foreign key (ppla_id) references `paralelo_planificacion`(ppla_id)
);

-- --------------------------------------------------------
-- 
-- Estructura de tabla para la tabla `distributivo_horario`
-- 
create table if not exists `distributivo_horario` (
  `dhor_id` bigint(20) not null auto_increment primary key, 
  `ppla_id` bigint(20) null,  
  `dhor_usuario_ingreso` bigint(20) not null,
  `dhor_usuario_modifica` bigint(20)  null,  
  `dhor_estado` varchar(1) not null,
  `dhor_fecha_creacion` timestamp not null default current_timestamp,
  `dhor_fecha_modificacion` timestamp null default null,
  `dhor_estado_logico` varchar(1) not null,
  foreign key (ppla_id) references `paralelo_planificacion`(ppla_id)
);

-- --------------------------------------------------------
-- 
-- Estructura de tabla para la tabla `distributivo_horario_det`
-- 
create table if not exists `distributivo_horario_det` (
  `dhde_id` bigint(20) not null auto_increment primary key,   
  `dhor_id` bigint(20) not null,
  `dia_id` bigint(20) not null,  
  `dhde_fecha_clase` timestamp null default null,
  `dhde_hora_inicio` varchar(10) not null,
  `dhde_hora_fin` varchar(10) not null,  
  `dhde_usuario_ingreso` bigint(20) not null,
  `dhde_usuario_modifica` bigint(20) null,  
  `dhde_estado` varchar(1) not null,
  `dhde_fecha_creacion` timestamp not null default current_timestamp,
  `dhde_fecha_modificacion` timestamp null default null,
  `dhde_estado_logico` varchar(1) not null,
  foreign key (dhor_id) references `distributivo_horario`(dhor_id)
);

-- --------------------------------------------------------
-- 
-- Estructura de tabla para la tabla `marcacion_detalle_horario` 
-- --------------------------------------------------------
create table if not exists `marcacion_detalle_horario` (
  `mdho_id` bigint(20) not null auto_increment primary key,   
  `dhde_id` bigint(20) not null,  
  `mdho_fecha_hora_entrada` timestamp null,    
  `mdho_fecha_hora_salida` timestamp null,  
  `mdho_direccion_ip` varchar(20) not null,
  `mdho_usuario_ingreso` bigint(20) not null,
  `mdho_usuario_modifica` bigint(20) null,  
  `mdho_estado` varchar(1) not null,
  `mdho_fecha_creacion` timestamp not null default current_timestamp,
  `mdho_fecha_modificacion` timestamp null default null,
  `mdho_estado_logico` varchar(1) not null,  
  foreign key (dhde_id) references `distributivo_horario_det`(dhde_id)
);

-- --------------------------------------------------------
-- 
-- Estructura de tabla para la tabla `matriculacion`
-- 
create table if not exists `matriculacion` (
  `mat_id` bigint(20) not null auto_increment primary key,   
  `pama_id` bigint(20) not null,
  `adm_id` bigint(20) null, 
  `est_id` bigint(20) not null,      
  `mat_fecha_matriculacion` timestamp null default null,
  `mat_usuario_ingreso` bigint(20) not null,
  `mat_usuario_modifica` bigint(20)  null,  
  `mat_estado` varchar(1) not null,
  `mat_fecha_creacion` timestamp not null default current_timestamp,
  `mat_fecha_modificacion` timestamp null default null,
  `mat_estado_logico` varchar(1) not null,  
  foreign key (pama_id) references `planificacion_academica_malla`(pama_id),
  foreign key (est_id) references `estudiante`(est_id)
);

-- --------------------------------------------------------
-- 
-- Estructura de tabla para la tabla `detalle_matriculacion`
-- 
create table if not exists `detalle_matriculacion` (
  `dmat_id` bigint(20) not null auto_increment primary key, 
  `mat_id` bigint(20) not null,
  `ppla_id` bigint(20) not null,  
  `dmat_usuario_ingreso` bigint(20) not null,
  `dmat_usuario_modifica` bigint(20)  null,  
  `dmat_estado` varchar(1) not null,
  `dmat_fecha_creacion` timestamp not null default current_timestamp,
  `dmat_fecha_modificacion` timestamp null default null,
  `dmat_estado_logico` varchar(1) not null,
  foreign key (mat_id) references `matriculacion`(mat_id),
  foreign key (ppla_id) references `paralelo_planificacion`(ppla_id)
);

-- --------------------------------------------------------
-- 
-- Estructura de tabla para la tabla `estudio_acad_area_con`
-- --------------------------------------------------------
create table if not exists `estudio_acad_area_con` (
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
-- Estructura de tabla para la tabla `horario_asignatura_periodo`  ELIMINAR DESPUÉS DE IMPLEMENTAR LO NUEVO en detalle_horario
-- --------------------------------------------------------
create table if not exists `horario_asignatura_periodo` (
  `hape_id` bigint(20) not null auto_increment primary key,   
  `asi_id` bigint(20) not null,
  `paca_id` bigint(20) null,
  `ppro_id` bigint(20) null,  
  `daca_id` bigint(20) null,
  `pro_id` bigint(20) not null,
  `uaca_id` bigint(20) not null,
  `mod_id` bigint(20) not null,
  `dia_id` bigint(20) not null,
  `hape_fecha_clase` timestamp null default null,
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
  foreign key (mod_id) references `modalidad`(mod_id),
  foreign key (daca_id) REFERENCES `distributivo_academico`(daca_id),
  foreign key (ppro_id) REFERENCES `promocion_programa`(ppro_id)
);

-- --------------------------------------------------------
-- 
-- Estructura de tabla para la tabla `registro_marcacion` ELIMINAR DESPUÉS DE IMPLEMENTAR LO NUEVO en marcacion_detalle_horario
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
  `rmar_idingreso`  bigint(20) null,
  `rmar_estado` varchar(1) not null,
  `rmar_fecha_creacion` timestamp not null default current_timestamp,
  `rmar_fecha_modificacion` timestamp null default null,
  `rmar_estado_logico` varchar(1) not null,
  foreign key (pro_id) references `profesor`(pro_id),
  foreign key (hape_id) references `horario_asignatura_periodo`(hape_id)
);

-- --------------------------------------------------------
-- 
-- Estructura de tabla para la tabla `horario_asignatura_periodo_tmp`  ELIMINAR DESPUÉS DE IMPLEMENTAR LO NUEVO en detalle_horario
-- --------------------------------------------------------
create table if not exists `horario_asignatura_periodo_tmp` (
  `hapt_id` bigint(20) not null auto_increment primary key,   
  `asi_id` bigint(20) null,
  `paca_id` bigint(20) null,
  `pro_id` bigint(20) null,
  `uaca_id` bigint(20) null,
  `mod_id` bigint(20) null,
  `dia_id` bigint(20) null,
  `hapt_fecha_clase` varchar(10) null,
  `hapt_hora_entrada` varchar(10) null,
  `hapt_hora_salida` varchar(10) null,  
  `usu_id` bigint(20) null
);

-- --------------------------------------------------------
-- 
-- Estructura de tabla para la tabla `otro_estudio_academico`
-- --------------------------------------------------------
CREATE TABLE `otro_estudio_academico` (
  `oeac_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `oeac_nombre` varchar(300) NOT NULL,
  `oeac_descripcion` varchar(500) NOT NULL,
  `uaca_id` bigint(20) NOT NULL,
  `mod_id` bigint(20) NOT NULL,
  `oeac_estado` varchar(1) NOT NULL,
  `oeac_fecha_creacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `oeac_fecha_modificacion` timestamp NULL DEFAULT NULL,
  `oeac_estado_logico` varchar(1) NOT NULL,
  PRIMARY KEY (`oeac_id`),
  foreign key (uaca_id) references `unidad_academica`(uaca_id),
  foreign key (mod_id) references `modalidad`(mod_id)
);

-- --------------------------------------------------------
-- 
-- Estructura de tabla para la tabla `documento_aceptacion`
-- --------------------------------------------------------
create table if not exists `documento_aceptacion` (
 `dace_id` bigint(20) not null auto_increment primary key,
 `per_id` bigint(20) not null, 
 `dadj_id` bigint(20) not null, 
 `dace_archivo` varchar(500) not null, 
 `dace_observacion` varchar(500) null, 
 `dace_fecha_maxima_aprobacion` timestamp null, 
 `dace_estado_aprobacion` varchar(1) not null, 
 `dace_usuario_ingreso` bigint(20) null,
 `dace_usuario_modifica` bigint(20) null,
 `dace_estado` varchar(1) not null, 
 `dace_fecha_creacion` timestamp not null default current_timestamp,
 `dace_fecha_modificacion` timestamp null default null,
 `dace_estado_logico` varchar(1) not null
);

-- --------------------------------------------------------
-- 
-- Estructura de tabla para la tabla `observaciones_documento_aceptacion`
-- --------------------------------------------------------
create table if not exists `observaciones_documento_aceptacion` (
 `odac_id` bigint(20) not null auto_increment primary key,
 `odac_descripcion` varchar(500) not null, 
 `odac_usuario_ingreso` bigint(20) null,
 `odac_usuario_modifica` bigint(20) null,
 `odac_estado` varchar(1) not null, 
 `odac_fecha_creacion` timestamp not null default current_timestamp,
 `odac_fecha_modificacion` timestamp null default null,
 `odac_estado_logico` varchar(1) not null
);

-- --------------------------------------------------------
-- 
-- Estructura de tabla para la tabla `observaciones_documento_aceptacion`
-- --------------------------------------------------------
create table if not exists `observaciones_por_documento_aceptacion` (
 `opda_id` bigint(20) not null auto_increment primary key,
 `odac_id` bigint(20) not null, 
 `dace_id` bigint(20) not null, 
 `opda_usuario_ingreso` bigint(20) null,
 `opda_usuario_modifica` bigint(20) null,
 `opda_estado` varchar(1) not null, 
 `opda_fecha_creacion` timestamp not null default current_timestamp,
 `opda_fecha_modificacion` timestamp null default null,
 `opda_estado_logico` varchar(1) not null,
 foreign key (odac_id) references `observaciones_documento_aceptacion`(odac_id),
 foreign key (dace_id) references `documento_aceptacion`(dace_id)
);


-- --------------------------------------------------------
-- 
-- Estructura de tabla para la tabla `matriculacion_programa_inscrito`
-- --------------------------------------------------------
create table if not exists `matriculacion_programa_inscrito` (
 `mpin_id` bigint(20) not null auto_increment primary key,
 `ppro_id` bigint(20) not null, 
 `adm_id` bigint(20) not null, 
 `mpin_fecha_matriculacion` timestamp not null,
 `mpin_ficha` varchar(1) null, -- 'S', 'N'  
 `mpin_fecha_registro_ficha` timestamp null,
 `mpin_usuario_ingresa` bigint(20) null,
 `mpin_estado` varchar(1) not null, 
 `mpin_fecha_creacion` timestamp not null default current_timestamp,
 `mpin_usuario_modifica` bigint(20) null,
 `mpin_fecha_modificacion` timestamp null default null,
 `mpin_estado_logico` varchar(1) not null,
 foreign key (ppro_id) references `promocion_programa`(ppro_id)
);

-- --------------------------------------------------------
-- 
-- Estructura de tabla para la tabla `registro_marcacion_generada` 
-- --------------------------------------------------------
create table if not exists registro_marcacion_generada (
  `rmtm_id` bigint(20) not null auto_increment primary key,
  `hape_id` bigint(20) not null,
  `paca_id` bigint(20) not null,
  `uaca_id` bigint(20) not null,
  `mod_id` bigint(20)  null,    
  `rmtm_fecha_transaccion` timestamp null default null 
);

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `distributivo`
--
create table if not exists `distributivo` (
 `dis_id` bigint(20) not null auto_increment primary key,
 `pro_id` bigint(20) not null,
 `asi_id` bigint(20) not null, 
 `dis_descripcion` varchar(100) null,
 `saca_id` bigint(20) not null,
 `ddoc_id` bigint(20) not null,
 `dis_declarado` varchar(1) not null,
 `dis_estado` varchar(1) not null,
 `dis_fecha_creacion` timestamp not null default current_timestamp,
 `dis_fecha_modificacion` timestamp null default null,
 `dis_estado_logico` varchar(1) not null,
 foreign key (saca_id) references `semestre_academico`(saca_id),
 foreign key (pro_id) references `profesor`(pro_id),
 foreign key (asi_id) references `asignatura`(asi_id),
 foreign key (ddoc_id) references `dedicacion_docente`(ddoc_id)
);

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `tipo_evaluacion`
--
create table if not exists `tipo_evaluacion` (
 `teva_id` bigint(20) not null auto_increment primary key,
 `teva_nombre` varchar(250) default null,
 `teva_estado` varchar(1) not null,
 `teva_fecha_creacion` timestamp not null default current_timestamp,
 `teva_fecha_modificacion` timestamp null default null,
 `teva_estado_logico` varchar(1) not null
);

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `resumen_evaluacion_docente`
--
create table if not exists `resumen_evaluacion_docente` (
 `redo_id` bigint(20) not null auto_increment primary key,
 `pro_id` bigint(20) not null,
 `saca_id` bigint(20) not null,
 `teva_id` bigint(20) not null,
 `redo_cant_horas` double default null,
 `redo_puntaje_evaluacion` double default null,
 `redo_estado` varchar(1) not null,
 `redo_fecha_creacion` timestamp not null default current_timestamp,
 `redo_fecha_modificacion` timestamp null default null,
 `redo_estado_logico` varchar(1) not null,
 foreign key (saca_id) references `semestre_academico`(saca_id),
 foreign key (pro_id) references `profesor`(pro_id),
 foreign key (teva_id) references `tipo_evaluacion`(teva_id)
);


-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `resumen_resultado_evaluacion`
--
create table if not exists `resumen_resultado_evaluacion` (
 `rreva_id` bigint(20) not null auto_increment primary key,
 `pro_id` bigint(20) not null,
 `saca_id` bigint(20) not null,
 `rreva_evaluacion_completa` varchar(1) not null, -- 1 completa o 0 incompleta
 `rreva_total_hora` double default null,
 `rreva_total_evaluacion` double default null,
 `rreva_estado` varchar(1) not null,
 `rreva_fecha_creacion` timestamp not null default current_timestamp,
 `rreva_fecha_modificacion` timestamp null default null,
 `rreva_estado_logico` varchar(1) not null,
 foreign key (saca_id) references `semestre_academico`(saca_id),
 foreign key (pro_id) references `profesor`(pro_id)
);


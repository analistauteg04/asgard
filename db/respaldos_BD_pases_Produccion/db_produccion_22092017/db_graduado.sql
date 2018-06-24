--
-- Base de datos: `db_graduado`
--
DROP SCHEMA IF EXISTS `db_graduado` ;
CREATE SCHEMA IF NOT EXISTS `db_graduado` DEFAULT CHARACTER SET utf8 ;
USE `db_graduado` ;

GRANT ALL PRIVILEGES ON `db_graduado`.* TO 'uteg'@'localhost' IDENTIFIED BY 'Utegadmin2016*';
-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `idioma_graduado`
--
create table if not exists `idioma_graduado` (
 `igra_id` bigint(20) not null auto_increment primary key,
 `igra_nombre` varchar(250) default null,
 `igra_tipo` varchar(250) default null,
 `igra_estado` varchar(1) not null,
 `igra_fecha_creacion` timestamp not null default current_timestamp,
 `igra_fecha_actualizacion` timestamp null default null,
 `igra_estado_logico` varchar(1) not null
);
-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `tipo_estudio` 
--
create table if not exists `tipo_estudio` (
 `test_id` bigint(20) not null auto_increment primary key,
 `test_nombre` varchar(200) not null, 
 `test_descripcion` varchar(200) not null,
 `test_estado` varchar(1) not null,
 `test_fecha_creacion` timestamp not null default current_timestamp,
 `test_fecha_actualizacion` timestamp null default null,
 `test_estado_logico` varchar(1) not null
);
-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `carrera_graduado` 
--
create table if not exists `carrera_graduado` (
 `cgra_id` bigint(20) not null auto_increment primary key,
 `cgra_nombre` varchar(200) not null, 
 `cgra_descripcion` varchar(200) not null,
 `cgra_estado` varchar(1) not null,
 `cgra_fecha_creacion` timestamp not null default current_timestamp,
 `cgra_fecha_actualizacion` timestamp null default null,
 `cgra_estado_logico` varchar(1) not null
);
-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `colegio` 
--
create table if not exists `colegio` (
 `col_id` bigint(20) not null auto_increment primary key,
 `col_nombre` varchar(200) not null, 
 `col_descripcion` varchar(200) not null,
 `col_estado` varchar(1) not null,
 `col_fecha_creacion` timestamp not null default current_timestamp,
 `col_fecha_actualizacion` timestamp null default null,
 `col_estado_logico` varchar(1) not null
);
-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `rango_sueldo` 
--
create table if not exists `rango_sueldo` (
 `rsue_id` bigint(20) not null auto_increment primary key,
 `rsue_nombre` varchar(200) not null, 
 `rsue_descripcion` varchar(200) not null,
 `rsue_estado` varchar(1) not null,
 `rsue_fecha_creacion` timestamp not null default current_timestamp,
 `rsue_fecha_actualizacion` timestamp null default null,
 `rsue_estado_logico` varchar(1) not null
);
-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `pregunta` 
--
create table if not exists `pregunta` (
 `pre_id` bigint(20) not null auto_increment primary key,
 `pre_nombre` varchar(500) not null, 
 `pre_grupo` varchar(1) not null, 
 `pre_estado` varchar(1) not null,
 `pre_fecha_creacion` timestamp not null default current_timestamp,
 `pre_fecha_actualizacion` timestamp null default null,
 `pre_estado_logico` varchar(1) not null
);
-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `criterio` 
--
create table if not exists `criterio` (
 `cri_id` bigint(20) not null auto_increment primary key,
 `cri_nombre` varchar(500) not null, 
 `cri_estado` varchar(1) not null,
 `cri_fecha_creacion` timestamp not null default current_timestamp,
 `cri_fecha_actualizacion` timestamp null default null,
 `cri_estado_logico` varchar(1) not null
);
-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `criterio_pregunta` 
--
create table if not exists `criterio_pregunta` (
 `cpre_id` bigint(20) not null auto_increment primary key,
 `cri_id` bigint(20) not null,
 `pre_id` bigint(20) not null, 
 `tipo_control` varchar(1) null, 
 `cpre_estado` varchar(1) not null,
 `cpre_fecha_creacion` timestamp not null default current_timestamp,
 `cpre_fecha_actualizacion` timestamp null default null,
 `cpre_estado_logico` varchar(1) not null
);
-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `persona_graduado`
--
create table if not exists `persona_graduado` (
 `pgra_id` bigint(20) not null auto_increment primary key,
 `pgra_pri_nombre` varchar(250) default null,
 `pgra_seg_nombre` varchar(250) default null,
 `pgra_pri_apellido` varchar(250) default null, 
 `pgra_seg_apellido` varchar(250) default null,
 `pgra_cedula` varchar(15) not null,
 `pgra_ruc` varchar(15) default null,
 `pgra_pasaporte` varchar(50) default null,
 `etn_id` bigint(20) default null,
 `eciv_id` bigint(20) default null,
 `pgra_genero` varchar(1) default null,
 `pgra_nacionalidad` varchar(250) default null,
 `pai_id_nacimiento` bigint(20) default null,
 `pro_id_nacimiento` bigint(20) default null,
 `can_id_nacimiento` bigint(20) default null,
 `pgra_nac_ecuatoriano` varchar(1) default null,
 `pgra_fecha_nacimiento` date default null,
 `pgra_celular` varchar(50) default null,
 `pgra_correo` varchar(250) default null,
 `pgra_foto` varchar(500) default null,
 `tsan_id` bigint(20) default null,

 `pgra_domicilio_sector` varchar(250) default null,
 `pgra_domicilio_cpri` varchar(500) default null,
 `pgra_domicilio_csec` varchar(500) default null,
 `pgra_domicilio_num` varchar(100) default null,
 `pgra_domicilio_ref` varchar(500) default null,
 `pgra_domicilio_telefono` varchar(50) default null,
 `pai_id_domicilio` bigint(20) default null, 
 `pro_id_domicilio` bigint(20) default null, 
 `can_id_domicilio` bigint(20) default null,
  
 `pgra_trabajo_nombre` varchar(250) default null,
 `pgra_trabajo_direccion` varchar(500) default null,
 `pgra_trabajo_telefono` varchar(50) default null, 
 `pgra_trabajo_ext` varchar(50) default null,
 `pai_id_trabajo` bigint(20) default null, 
 `pro_id_trabajo` bigint(20) default null,
 `can_id_trabajo` bigint(20) default null,

 `pgra_estado` varchar(1) not null,
 `pgra_fecha_creacion` timestamp not null default current_timestamp,
 `pgra_fecha_modificacion` timestamp null default null,
 `pgra_estado_logico` varchar(1) not null
);
-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `persona_contacto_graduado`
--
create table if not exists `persona_contacto_graduado` (
 `pcgr_id` bigint(20) not null auto_increment primary key,
 `pgra_id` bigint(20) default null, 
 `pcgr_nombre` varchar(250) default null,
 `tpar_id` bigint(20) default null,
 `pcgr_direccion` varchar(500) default null,
 `pcgr_telefono` varchar(50) default null,
 `pcgr_celular` varchar(50) default null,
 `pcgr_estado` varchar(1) not null,
 `pcgr_fecha_creacion` timestamp not null default current_timestamp,
 `pcgr_fecha_modificacion` timestamp null default null,
 `pcgr_estado_logico` varchar(1) not null, 
 foreign key (pgra_id) references `persona_graduado`(pgra_id)
);
-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `otra_etnia_graduado`
--
create table if not exists `otra_etnia_graduado` (
 `oegr_id` bigint(20) not null auto_increment primary key,
 `pgra_id` bigint(20) not null,
 `oegr_nombre` varchar(250) default null,
 `oegr_estado` varchar(1) not null,
 `oegr_fecha_creacion` timestamp not null default current_timestamp on update current_timestamp,
 `oegr_fecha_modificacion` timestamp null default null,
 `oegr_estado_logico` varchar(1) not null,
 foreign key (pgra_id) references `persona_graduado`(pgra_id) 
) ;

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `info_familia_graduado` 
--
create table if not exists `info_familia_graduado` (
 `ifgr_id` bigint(20) not null auto_increment primary key,
 `pgra_id` bigint(20) not null,
 `nins_padre` bigint(20) not null,
 `nins_madre` bigint(20) not null,
 `ifgr_miembro` varchar(2) not null, 
 `rsue_id` bigint(20)  null, 
 `ifgr_estado` varchar(1)  null, 
 `ifgr_fecha_creacion` timestamp not null default current_timestamp,
 `ifgr_fecha_modificacion` timestamp null default null,
 `ifgr_estado_logico` varchar(1) not null,
 foreign key (pgra_id) references `persona_graduado`(pgra_id),
 foreign key (rsue_id) references `rango_sueldo`(rsue_id)
);

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `info_enfermedad_graduado` 
--
create table if not exists `info_enfermedad_graduado` (
 `iegr_id` bigint(20) not null auto_increment primary key,
 `pgra_id` bigint(20) not null,
 `iegr_enfermedad` varchar(1) not null,
 `iegr_tipoenfermedad` varchar(100) null,
 `iegr_archivo` varchar(500) null, 
 `iegr_estado` varchar(1) not null, 
 `iegr_fecha_creacion` timestamp not null default current_timestamp,
 `iegr_fecha_modificacion` timestamp null default null,
 `iegr_estado_logico` varchar(1) not null,
 foreign key (pgra_id) references `persona_graduado`(pgra_id) 
);
-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `info_discapacidad_graduado` 
--
create table if not exists `info_discapacidad_graduado` (
 `idgr_id` bigint(20) not null auto_increment primary key,
 `pgra_id` bigint(20) not null,
 `tdis_id` bigint(20) not null,
 `idgr_discapacidad` varchar(1) not null,
 `idgr_porcentaje` varchar(3) null,
 `idgr_archivo` varchar(500) null,
 `idgr_estado` varchar(1) not null, 
 `idgr_fecha_creacion` timestamp not null default current_timestamp,
 `idgr_fecha_modificacion` timestamp null default null,
 `idgr_estado_logico` varchar(1) not null, 
 foreign key (pgra_id) references `persona_graduado`(pgra_id) 
);
-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `info_academico_graduado` 
--
create table if not exists `info_academico_graduado` (
 `iagr_id` bigint(20) not null auto_increment primary key,
 `pgra_id` bigint(20) not null,
 `pai_id` bigint(20) default null,
 `pro_id` bigint(20) default null,
 `can_id` bigint(20) default null,
 `tiac_id` bigint(20) null,
 `tnes_id` bigint(20) null,
 `iagr_institucion` varchar(200) null,
 `col_id` bigint(20) null,
 `iagr_titulo` varchar(500) null,
 `iagr_anio_grado` varchar(4) null, 
 `iagr_estado` varchar(1) not null, 
 `iagr_fecha_creacion` timestamp not null default current_timestamp,
 `iagr_fecha_modificacion` timestamp null default null,
 `iagr_estado_logico` varchar(1) not null, 
 foreign key (pgra_id) references `persona_graduado`(pgra_id),
 foreign key (col_id) references `colegio`(col_id)
);
-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `dominio_idioma` 
--
create table if not exists `dominio_idioma` (
 `didi_id` bigint(20) not null auto_increment primary key,
 `pgra_id` bigint(20) not null,
 `igra_id` bigint(20) not null, 
 `didi_estado` varchar(1) not null,
 `didi_fecha_creacion` timestamp not null default current_timestamp,
 `didi_fecha_actualizacion` timestamp null default null,
 `didi_estado_logico` varchar(1) not null,
 foreign key (pgra_id) references `persona_graduado`(pgra_id),
 foreign key (igra_id) references `idioma_graduado`(igra_id)
);
-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `estudio_postsecundario` 
--
create table if not exists `estudio_postsecundario` (
 `epos_id` bigint(20) not null auto_increment primary key,
 `pgra_id` bigint(20) not null,
 `test_id` bigint(20) not null,
 `epos_nombre_estudio` varchar(200) not null,
 `epos_anio_termino` int not null,
 `epos_estado` varchar(1) not null,
 `epos_fecha_creacion` timestamp not null default current_timestamp,
 `epos_fecha_actualizacion` timestamp null default null,
 `epos_estado_logico` varchar(1) not null,
 foreign key (pgra_id) references `persona_graduado`(pgra_id),
 foreign key (test_id) references `tipo_estudio`(test_id)
);
-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `info_antecedente` 
--
create table if not exists `info_antecedente` (
 `iant_id` bigint(20) not null auto_increment primary key,
 `pgra_id` bigint(20) not null,
 `pre_id` bigint(20) not null,
 `cri_id` bigint(20) null,
 `iant_valor` varchar(500) null, 
 `iant_estado` varchar(1) not null, 
 `iant_fecha_creacion` timestamp not null default current_timestamp,
 `iant_fecha_modificacion` timestamp null default null,
 `iant_estado_logico` varchar(1) not null, 
 foreign key (pgra_id) references `persona_graduado`(pgra_id),
 foreign key (pre_id) references `pregunta`(pre_id),
 foreign key (cri_id) references `criterio`(cri_id)
);
-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `info_estudio` 
--
create table if not exists `info_estudio` (
 `iest_id` bigint(20) not null auto_increment primary key,
 `pgra_id` bigint(20) not null,
 `pre_id` bigint(20) not null,
 `cri_id` bigint(20) null,
 `iest_valor` varchar(500) null, 
 `iest_estado` varchar(1) not null, 
 `iest_fecha_creacion` timestamp not null default current_timestamp,
 `iest_fecha_modificacion` timestamp null default null,
 `iest_estado_logico` varchar(1) not null, 
 foreign key (pgra_id) references `persona_graduado`(pgra_id),
 foreign key (pre_id) references `pregunta`(pre_id),
 foreign key (cri_id) references `criterio`(cri_id)
);
-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `estudio_superior` 
--
create table if not exists `estudio_superior` (
 `esup_id` bigint(20) not null auto_increment primary key,
 `iest_id` bigint(20) not null,
 `esup_institucion` varchar(200) not null, 
 `esup_anios_estudio` int not null,
 `esup_grado_academico` varchar(200) not null,
 `esup_estado` varchar(1) not null,
 `esup_fecha_creacion` timestamp not null default current_timestamp,
 `esup_fecha_actualizacion` timestamp null default null,
 `esup_estado_logico` varchar(1) not null,
 foreign key (iest_id) references `info_estudio`(iest_id)
);
-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `info_educacion_continua` 
--
create table if not exists `info_educacion_continua` (
 `ieco_id` bigint(20) not null auto_increment primary key,
 `pgra_id` bigint(20) not null,
 `pre_id` bigint(20) not null,
 `cri_id` bigint(20) null,
 `ieco_valor` varchar(500) null, 
 `ieco_estado` varchar(1) not null, 
 `ieco_fecha_creacion` timestamp not null default current_timestamp,
 `ieco_fecha_modificacion` timestamp null default null,
 `ieco_estado_logico` varchar(1) not null, 
 foreign key (pgra_id) references `persona_graduado`(pgra_id),
 foreign key (pre_id) references `pregunta`(pre_id),
 foreign key (cri_id) references `criterio`(cri_id)
);
-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `info_situacion_laboral` 
--
create table if not exists `info_situacion_laboral` (
 `isla_id` bigint(20) not null auto_increment primary key,
 `pgra_id` bigint(20) not null,
 `pre_id` bigint(20) not null,
 `cri_id` bigint(20) null,
 `isla_valor` varchar(500) null, 
 `isla_estado` varchar(1) not null, 
 `isla_fecha_creacion` timestamp not null default current_timestamp,
 `isla_fecha_modificacion` timestamp null default null,
 `isla_estado_logico` varchar(1) not null, 
 foreign key (pgra_id) references `persona_graduado`(pgra_id),
 foreign key (pre_id) references `pregunta`(pre_id),
 foreign key (cri_id) references `criterio`(cri_id)
);
-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `info_habilidad` 
--
create table if not exists `info_habilidad` (
 `ihab_id` bigint(20) not null auto_increment primary key,
 `pgra_id` bigint(20) not null,
 `pre_id` bigint(20) not null,
 `cri_id` bigint(20) null,
 `ihab_valor` varchar(500) null, 
 `ihab_estado` varchar(1) not null, 
 `ihab_fecha_creacion` timestamp not null default current_timestamp,
 `ihab_fecha_modificacion` timestamp null default null,
 `ihab_estado_logico` varchar(1) not null, 
 foreign key (pgra_id) references `persona_graduado`(pgra_id),
 foreign key (pre_id) references `pregunta`(pre_id),
 foreign key (cri_id) references `criterio`(cri_id)
);
-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `info_academico_otro` 
--
create table if not exists `info_academico_otro` (
 `iaot_id` bigint(20) not null auto_increment primary key,
 `pgra_id` bigint(20) not null,
 `pre_id` bigint(20) not null,
 `cri_id` bigint(20) null,
 `iaot_valor` varchar(500) null, 
 `iaot_estado` varchar(1) not null, 
 `iaot_fecha_creacion` timestamp not null default current_timestamp,
 `iaot_fecha_modificacion` timestamp null default null,
 `iaot_estado_logico` varchar(1) not null, 
 foreign key (pgra_id) references `persona_graduado`(pgra_id),
 foreign key (pre_id) references `pregunta`(pre_id),
 foreign key (cri_id) references `criterio`(cri_id)
);


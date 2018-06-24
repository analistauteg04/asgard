--
-- Base de datos: `db_captacion`
--
DROP SCHEMA IF EXISTS `db_captacion` ;
CREATE SCHEMA IF NOT EXISTS `db_captacion` DEFAULT CHARACTER SET utf8 ;
USE `db_captacion` ;

GRANT ALL PRIVILEGES ON `db_captacion`.* TO 'uteg'@'localhost' IDENTIFIED BY 'Utegadmin2016*';
-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `pre_interesado` 
--
create table if not exists `pre_interesado` (
 `pint_id` bigint(20) not null auto_increment primary key,
 `per_id` bigint(20) not null, 
 `pint_estado_preinteresado` varchar(1) null,  
 `pint_estado` varchar(1) not null,
 `pint_fecha_creacion` timestamp not null default current_timestamp,
 `pint_fecha_modificacion` timestamp null default null,
 `pint_estado_logico` varchar(1) not null
);
-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `interesado` 
--
create table if not exists `interesado` (
 `int_id` bigint(20) not null auto_increment primary key,
 `pint_id` bigint(20) not null, 
 `int_estado_interesado` varchar(1) null,  
 `int_usuario_ingreso` bigint(20) not null,
 `int_usuario_modifica` bigint(20) null,
 `int_estado` varchar(1) not null,
 `int_fecha_creacion` timestamp not null default current_timestamp,
 `int_fecha_modificacion` timestamp null default null,
 `int_estado_logico` varchar(1) not null,
 foreign key (pint_id) references `pre_interesado`(pint_id)
);

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `nivel_interes`
--
create table if not exists `nivel_interes` (
 `nint_id` bigint(20) not null auto_increment primary key,
 `nint_nombre` varchar(300) not null,
 `nint_descripcion` varchar(500) not null,
 `nint_estado` varchar(1) not null,
 `nint_fecha_creacion` timestamp not null default current_timestamp,
 `nint_fecha_modificacion` timestamp null default null,
 `nint_estado_logico` varchar(1) not null
);

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `metodo_ingreso`
--
create table if not exists `metodo_ingreso` (
 `ming_id` bigint(20) not null auto_increment primary key,
 `ming_nombre` varchar(300) not null,
 `ming_descripcion` varchar(500) not null,
 `ming_estado` varchar(1) not null,
 `ming_fecha_creacion` timestamp not null default current_timestamp,
 `ming_fecha_modificacion` timestamp null default null,
 `ming_estado_logico` varchar(1) not null
);

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `nivelint_metodo`
--
create table if not exists `nivelint_metodo` (
 `nmet_id` bigint(20) not null auto_increment primary key,
 `nint_id` bigint(20) not null,
 `ming_id` bigint(20) not null,
 `nmet_estado` varchar(1) not null,
 `nmet_fecha_creacion` timestamp not null default current_timestamp,
 `nmet_fecha_modificacion` timestamp null default null,
 `nmet_estado_logico` varchar(1) not null,
 foreign key (nint_id) references `nivel_interes`(nint_id),
 foreign key (ming_id) references `metodo_ingreso`(ming_id)
);

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `documento_adjuntar`
-- 
create table if not exists `documento_adjuntar` (
 `dadj_id` bigint(20) not null auto_increment primary key, 
 `dadj_nombre` varchar(300) not null, 
 `dadj_descripcion` varchar(500) not null, 
 `dadj_estado` varchar(1) not null,
 `dadj_fecha_creacion` timestamp not null default current_timestamp,
 `dadj_fecha_modificacion` timestamp null default null,
 `dadj_estado_logico` varchar(1) not null
);

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `doc_nint_tciudadano`
-- 
create table if not exists `doc_nint_tciudadano` (
 `dntc_id` bigint(20) not null auto_increment primary key, 
 `tciu_id` bigint(20) not null, 
 `nint_id` bigint(20) not null, 
 `dadj_id` bigint(20) not null,
 `dntc_estado` varchar(1) not null,
 `dntc_fecha_creacion` timestamp not null default current_timestamp,
 `dntc_fecha_modificacion` timestamp null default null,
 `dntc_estado_logico` varchar(1) not null,
 foreign key (nint_id) references `nivel_interes`(nint_id),
 foreign key (dadj_id) references `documento_adjuntar`(dadj_id)
);


-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `res_sol_inscripcion`
-- 
create table if not exists `res_sol_inscripcion` (
 `rsin_id` bigint(20) not null auto_increment primary key,
 `rsin_nombre` varchar(300) not null,
 `rsin_descripcion` varchar(500) not null,
 `rsin_estado` varchar(1) not null, 
 `rsin_fecha_creacion` timestamp not null default current_timestamp,
 `rsin_fecha_modificacion` timestamp null default null,
 `rsin_estado_logico` varchar(1) not null
);

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `solicitud_inscripcion`
-- 
create table if not exists `solicitud_inscripcion` (
 `sins_id` bigint(20) not null auto_increment primary key,
 `int_id` bigint(20) not null,
 `nint_id` bigint(20) not null, -- guarda la unidad academica de la bd_academico
 `mod_id` bigint(20) not null,
 `ming_id` bigint(20) not null,
 `car_id` bigint(20) not null,
 `rsin_id` bigint(20) not null,
 `sins_fecha_solicitud` timestamp null default null,
 `sins_fecha_preaprobacion` timestamp null default null,
 `sins_fecha_aprobacion` timestamp null default null,
 `sins_fecha_reprobacion` timestamp null default null,
 `sins_fecha_prenoprobacion` timestamp null default null,
 `sins_preobservacion` varchar(1000) null,
 `sins_observacion` varchar(1000) null,
 `sins_beca` varchar(1) null,
 `sins_usuario_preaprueba` bigint(20) null, 
 `sins_usuario_aprueba` bigint(20) null, 
 `sins_estado` varchar(1) not null, 
 `sins_fecha_creacion` timestamp not null default current_timestamp,
 `sins_fecha_modificacion` timestamp null default null,
 `sins_estado_logico` varchar(1) not null,
 foreign key (int_id) references `interesado`(int_id),
 -- foreign key (nint_id) references `nivel_interes`(nint_id),
 foreign key (ming_id) references `metodo_ingreso`(ming_id),
 foreign key (rsin_id) references `res_sol_inscripcion`(rsin_id)
);


-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `solicitudins_documento`
-- 
create table if not exists `solicitudins_documento` (
 `sdoc_id` bigint(20) not null auto_increment primary key,
 `sins_id` bigint(20) not null,
 `int_id` bigint(20) not null,
 `dadj_id` bigint(20) not null, 
 `sdoc_archivo` varchar(500) not null, 
 `sdoc_estado` varchar(1) not null, 
 `sdoc_fecha_creacion` timestamp not null default current_timestamp,
 `sdoc_fecha_modificacion` timestamp null default null,
 `sdoc_estado_logico` varchar(1) not null,
 foreign key (sins_id) references `solicitud_inscripcion`(sins_id),
 foreign key (int_id) references `interesado`(int_id),
 foreign key (dadj_id) references `documento_adjuntar`(dadj_id)
);



-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `aspirante` 
--
create table if not exists `aspirante` (
 `asp_id` bigint(20) not null auto_increment primary key,
 `int_id` bigint(20) not null,
 `asp_estado_aspirante` varchar(1) null,
 `asp_estado` varchar(1) not null,
 `asp_fecha_creacion` timestamp not null default current_timestamp,
 `asp_fecha_modificacion` timestamp null default null,
 `asp_estado_logico` varchar(1) not null, 
 foreign key (int_id) references `interesado`(int_id) 
);

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `info_familia` 
--
create table if not exists `informacion_familia` (
 `ifam_id` bigint(20) not null auto_increment primary key,
 `int_id` bigint(20) not null,
 `nins_padre` bigint(20) not null,
 `nins_madre` bigint(20) not null,
 `ifam_miembro` varchar(2) not null, 
 `ifam_salario` varchar(15)  null, 
 `ifam_estado` varchar(1)  null, 
 `ifam_fecha_creacion` timestamp not null default current_timestamp,
 `ifam_fecha_modificacion` timestamp null default null,
 `ifam_estado_logico` varchar(1) not null,
 foreign key (int_id) references `interesado`(int_id) 
);

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `info_enfermedad` 
--
create table if not exists `info_enfermedad` (
 `ienf_id` bigint(20) not null auto_increment primary key,
 `int_id` bigint(20) not null,
 `ienf_enfermedad` varchar(1) not null,
 `ienf_tipoenfermedad` varchar(100) null,
 `ienf_archivo` varchar(500) null, 
 `ienf_estado` varchar(1) not null, 
 `ienf_fecha_creacion` timestamp not null default current_timestamp,
 `ienf_fecha_modificacion` timestamp null default null,
 `ienf_estado_logico` varchar(1) not null,
 foreign key (int_id) references `interesado`(int_id) 
);

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `info_familia_enfermedad` 
--
create table if not exists `info_familia_enfermedad` (
 `ifen_id` bigint(20) not null auto_increment primary key,
 `int_id` bigint(20) not null,
 `tpar_id` bigint(20) not null,
 `ifen_enfermedad` varchar(1) not null,
 `ifen_tipoenfermedad` varchar(100) null,
 `ifen_archivo` varchar(500) null, 
 `ifen_estado` varchar(1) not null, 
 `ifen_fecha_creacion` timestamp not null default current_timestamp,
 `ifen_fecha_modificacion` timestamp null default null,
 `ifen_estado_logico` varchar(1) not null,
 foreign key (int_id) references `interesado`(int_id) 
);
-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `info_discapacidad` 
--
create table if not exists `info_discapacidad` (
 `idis_id` bigint(20) not null auto_increment primary key,
 `int_id` bigint(20) not null,
 `tdis_id` bigint(20) not null,
 `idis_discapacidad` varchar(1) not null,
 `idis_porcentaje` varchar(3) null,
 `idis_archivo` varchar(500) null,
 `idis_estado` varchar(1) not null, 
 `idis_fecha_creacion` timestamp not null default current_timestamp,
 `idis_fecha_modificacion` timestamp null default null,
 `idis_estado_logico` varchar(1) not null, 
 foreign key (int_id) references `interesado`(int_id) 
);
-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `info_familia_discapacidad` 
--
create table if not exists `info_familia_discapacidad` (
 `ifdis_id` bigint(20) not null auto_increment primary key,
 `int_id` bigint(20) not null,
 `tpar_id` bigint(20) not null,
 `tdis_id` bigint(20) not null,
 `ifdi_discapacidad` varchar(1) not null,
 `ifdi_porcentaje` varchar(3) null,
 `ifdi_archivo` varchar(500) null,
 `ifdi_estado` varchar(1) not null, 
 `ifdi_fecha_creacion` timestamp not null default current_timestamp,
 `ifdi_fecha_modificacion` timestamp null default null,
 `ifdi_estado_logico` varchar(1) not null, 
 foreign key (int_id) references `interesado`(int_id) 
);
-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `info_academico` 
--
create table if not exists `info_academico` (
 `iaca_id` bigint(20) not null auto_increment primary key,
 `int_id` bigint(20) not null,
 `pai_id` bigint(20) default null,
 `pro_id` bigint(20) default null,
 `can_id` bigint(20) default null,
 `tiac_id` bigint(20) null,
 `tnes_id` bigint(20) null,
 `iaca_institucion` varchar(500) null,
 `iaca_titulo` varchar(500) null,
 `iaca_anio_grado` varchar(4) null, 
 `iaca_estado` varchar(1) not null, 
 `iaca_fecha_creacion` timestamp not null default current_timestamp,
 `iaca_fecha_modificacion` timestamp null default null,
 `iaca_estado_logico` varchar(1) not null, 
 foreign key (int_id) references `interesado`(int_id)
);

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `interesado_ejecutivo` 
--
create table if not exists `interesado_ejecutivo` (
 `ieje_id` bigint(20) not null auto_increment primary key,
 `pint_id` bigint(20) null,
 `int_id` bigint(20)  null,
 `asp_id` bigint(20)  null,
 `per_id` bigint(20) not null,
 `ieje_usuario` bigint(20) null,
 `ieje_estado_asignacion` varchar(1) null,
 `ieje_estado` varchar(1) not null, 
 `ieje_fecha_creacion` timestamp not null default current_timestamp,
 `ieje_fecha_modificacion` timestamp null default null,
 `ieje_estado_logico` varchar(1) not null, 
 foreign key (int_id) references `interesado`(int_id),
 foreign key (pint_id) references `pre_interesado`(pint_id),
 foreign key (asp_id) references `aspirante`(asp_id)
);

-- Estructura de tabla para la tabla `medio_publicitario`
--
create table if not exists `medio_publicitario` (
 `mpub_id` bigint(20) not null auto_increment primary key,
 `mpub_nombre` varchar(300) not null,
 `mpub_descripcion` varchar(500)not null,
 `mpub_estado` varchar(1) not null,
 `mpub_fecha_creacion` timestamp not null default current_timestamp,
 `mpub_fecha_modificacion` timestamp null default null,
 `mpub_estado_logico` varchar(1) not null
);

-- Estructura de tabla para la tabla `solicitud_captacion`
--
create table if not exists `solicitud_captacion` (
 `rcap_id` bigint(20) not null auto_increment primary key,
 `per_id` bigint(20) not null,
 `pint_id` bigint(20) not null,
 `nint_id` bigint(20)  null,
 `ming_id` bigint(20)  null,
 `car_id` bigint(20) null,
 `mpub_id` bigint(20) null,
 `rcap_fecha_ingreso` timestamp null,
 `rcap_estado` varchar(1) not null,
 `rcap_fecha_creacion` timestamp not null default current_timestamp,
 `rcap_fecha_modificacion` timestamp null default null,
 `rcap_estado_logico` varchar(1) not null
);

-- Estructura de tabla para la tabla `consideracion`
--
create table if not exists `consideracion` (
 `con_id` bigint(20) not null auto_increment primary key,
 `con_nombre` varchar(200) not null,
 `con_descripcion` varchar(200) not null, 
 `con_estado` varchar(1) not null,
 `con_fecha_creacion` timestamp not null default current_timestamp,
 `con_fecha_modificacion` timestamp null default null,
 `con_estado_logico` varchar(1) not null
);


-- Estructura de tabla para la tabla `consideracion_documento`
--
create table if not exists `consideracion_documento` (
 `cdoc_id` bigint(20) not null auto_increment primary key,
 `con_id` bigint(20) not null,
 `dadj_id` bigint(20) not null,
 `cdoc_tiponacext` varchar(1) not null,
 `cdoc_estado` varchar(1) not null,
 `cdoc_fecha_creacion` timestamp not null default current_timestamp,
 `cdoc_fecha_modificacion` timestamp null default null,
 `cdoc_estado_logico` varchar(1) not null,
 foreign key (dadj_id) references `documento_adjuntar`(dadj_id),
 foreign key (con_id) references `consideracion`(con_id)
);

-- Estructura de tabla para la tabla `solicitud_rechazada`
--
create table if not exists `solicitud_rechazada` (
 `srec_id` bigint(20) not null auto_increment primary key,
 `sins_id` bigint(20) not null,
 `dadj_id` bigint(20) not null,
 `con_id` bigint(20) not null,
 `srec_etapa` varchar(1) not null,
 `srec_observacion` varchar(300) not null,
 `usu_id` bigint(20) not null,
 `srec_estado` varchar(1) not null,
 `srec_fecha_creacion` timestamp not null default current_timestamp,
 `srec_fecha_modificacion` timestamp null default null,
 `srec_estado_logico` varchar(1) not null,
 foreign key (sins_id) references `solicitud_inscripcion`(sins_id), 
 foreign key (dadj_id) references `documento_adjuntar`(dadj_id),
 foreign key (con_id) references `consideracion`(con_id)
);
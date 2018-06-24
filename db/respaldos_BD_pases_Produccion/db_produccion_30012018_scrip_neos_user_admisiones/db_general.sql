-- Base de Datos 

DROP SCHEMA IF EXISTS `db_general` ;
CREATE SCHEMA IF NOT EXISTS `db_general` default CHARACTER SET utf8 ;
USE `db_general`;

GRANT ALL PRIVILEGES ON `db_general`.* TO 'asgarduteg'@'localhost' IDENTIFIED BY 'Ut3G4dmi1n-Pr0ducci0n@2017*Onl1n3W@';
-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `info_per_discapacidad` 
--
create table if not exists `info_per_discapacidad` (
 `ipdi_id` bigint(20) not null auto_increment primary key,
 `ext_id` bigint(20) not null, -- id de la tabla externa que se debe extraer la persona
 `ext_base` varchar(50) default null, -- nombre de la base que se debe extraer la data
 `tdis_id` bigint(20) default null, -- tipo de discapacidad de asgard, determinar si estan todas las de la lista y las que no AUMNETAR
 `ipdi_carnet_conadis` varchar(20) default null,
 `ipdi_discapacidad` varchar(1) default null, 
 `ipdi_porcentaje` varchar(3) default null,
 `ipdi_archivo` varchar(500) default null,
 `ipdi_ruta` varchar(500) default null,
 `ipdi_estado` varchar(1) not null, 
 `ipdi_fecha_creacion` timestamp not null default current_timestamp,
 `ipdi_fecha_modificacion` timestamp null default null,
 `ipdi_estado_logico` varchar(1) not null
);

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `persona_correo_institucional`
--
create table if not exists `persona_correo_institucional` (
 `pcin_id` bigint(20) not null auto_increment primary key,
 `per_id` bigint(20) not null,
 `pcin_correo` varchar(250) default null,
 `pcin_estado` varchar(1) not null,
 `pcin_fecha_creacion` timestamp not null default current_timestamp on update current_timestamp,
 `pcin_fecha_modificacion` timestamp null default null,
 `pcin_estado_logico` varchar(1) not null
) ;

-- --------------------------------------------------------
-- /*(1 => integrantes de familia que viven con profesor, 2 => hijos  que no viven con profesor, 3 => familiares en la institucion)*/
-- Estructura de tabla para la tabla `tipo_antecedente_familia`
--
create table if not exists `tipo_antecedente_familia` (
  `tafam_id` bigint(20) not null auto_increment primary key,    
  `tafam_nombre` varchar(100) not null,
  `tafam_descripcion` varchar(100) not null,
  `tafam_estado` varchar(1) not null,
  `tafam_fecha_creacion` timestamp not null default current_timestamp,
  `tafam_fecha_modificacion` timestamp null default null,
  `tafam_estado_logico` varchar(1) not null  
);

--
-- Estructura de tabla para la tabla `institucion`
--
create table if not exists `institucion` (
  `ins_id` bigint(20) not null auto_increment primary key,
  `ins_categoria` varchar(1) null,
  `ins_nombre` varchar(100) not null,
  `ins_abreviacion` varchar(10) default null,
  `ins_direccion_institucion` varchar(50) default null,
  `ins_telefono_institucion` varchar(50) default null,
  `ins_estado` varchar(1) not null,
  `ins_fecha_creacion` timestamp not null default current_timestamp,
  `ins_fecha_modificacion` timestamp null default null,
  `ins_estado_logico` varchar(1) not null
);

--
-- Estructura de tabla para la tabla `tipo_institucion`
--

create table if not exists `tipo_institucion` (
  `tins_id` bigint(20) not null auto_increment primary key,    
  `tins_nombre` varchar(100) not null,
  `tins_descripcion` varchar(100) not null,
  `tins_estado` varchar(1) not null,
  `tins_fecha_creacion` timestamp not null default current_timestamp,
  `tins_fecha_modificacion` timestamp null default null,
  `tins_estado_logico` varchar(1) not null  
);

--
-- Estructura de tabla para la tabla `institucion_x_tipo`
--

create table if not exists `institucion_x_tipo` (
  `ixti_id` bigint(20) not null auto_increment primary key, 
  `ins_id` bigint(20) not null,  
  `tins_id` bigint(20) not null,   
  `ixti_servicio_ofrece` varchar(150) not null,
  `ixti_estado` varchar(1) not null,
  `ixti_fecha_creacion` timestamp not null default current_timestamp,
  `ixti_fecha_modificacion` timestamp null default null,
  `ixti_estado_logico` varchar(1) not null,
  
  foreign key (ins_id) references `institucion`(ins_id),
  foreign key (tins_id) references `tipo_institucion`(tins_id)
);

-- --------------------------------------------------------
-- /* (1 => completo, 2 => medio, 3 => parcial) */
-- Estructura de tabla para la tabla `tiempo_dedicado`
--
create table if not exists `tiempo_dedicado` (
  `tded_id` bigint(20) not null auto_increment primary key,    
  `tded_nombre` varchar(100) not null,
  `tded_descripcion` varchar(100) not null,
  `tded_estado` varchar(1) not null,
  `tded_fecha_creacion` timestamp not null default current_timestamp,
  `tded_fecha_modificacion` timestamp null default null,
  `tded_estado_logico` varchar(1) not null  
);

-- --------------------------------------------------------
-- /* (1 => contrato de relacion de dependencia, 2 => servicios prestados) */
-- Estructura de tabla para la tabla `tipo_relacion`
--
create table if not exists `tipo_relacion` (
  `trel_id` bigint(20) not null auto_increment primary key,    
  `trel_nombre` varchar(100) not null,
  `trel_descripcion` varchar(100) not null,
  `trel_estado` varchar(1) not null,
  `trel_fecha_creacion` timestamp not null default current_timestamp,
  `trel_fecha_modificacion` timestamp null default null,
  `trel_estado_logico` varchar(1) not null  
);

-- --------------------------------------------------------
-- 
-- Estructura de tabla para la tabla `cabecera_experiencia_docencia`
--
 create table if not exists `cabecera_experiencia_docencia` (
  `cedo_id` bigint(20) not null auto_increment primary key,  
  `ext_id` bigint(20) not null, -- id de la tabla externa que se debe extraer la persona
  `ext_base` varchar(50) default null, -- nombre de la base que se debe extraer la data    
  `cedo_estado` varchar(1) not null,
  `cedo_fecha_creacion` timestamp not null default current_timestamp,
  `cedo_fecha_modificacion` timestamp null default null,
  `cedo_estado_logico` varchar(1) not null  
);

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `detalle_experiencia_docencia` 
--
 create table if not exists `detalle_experiencia_docencia` (
 `dedo_id` bigint(20) not null auto_increment primary key,
 `cedo_id` bigint(20) not null,
 `ixti_id` bigint(20) not null,
 `asi_id` bigint(20) not null, -- asignaturas se toma de db_academico
 `tded_id` bigint(20) not null,
 `trel_id` bigint(20) not null,
 `dedo_otra_institución` varchar(100) default null, 
 `dedo_fecha_inicio` timestamp null default null,
 `dedo_fecha_fin` timestamp null default null, 
 `dedo_hasta_actualidad` varchar(1) default null, /* ( 1=> si, vacio => No) */
 `dedo_anios_docencia` varchar(4) default null,
 `dedo_estado` varchar(1) not null, 
 `dedo_fecha_creacion` timestamp not null default current_timestamp,
 `dedo_fecha_modificacion` timestamp null default null,
 `dedo_estado_logico` varchar(1) not null,

 foreign key (cedo_id) references `cabecera_experiencia_docencia`(cedo_id),
 foreign key (tded_id) references `tiempo_dedicado`(tded_id),
 foreign key (trel_id) references `tipo_relacion`(trel_id),
 foreign key (ixti_id) references `institucion_x_tipo`(ixti_id) 

); 
-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `enfermedad` 
--
create table if not exists `enfermedad` (
 `enf_id` bigint(20) not null auto_increment primary key, 
 `enf_cie` varchar(10) not null, 
 `enf_descripcion` varchar(100) not null, 
 `enf_estado` varchar(1) not null, 
 `enf_fecha_creacion` timestamp not null default current_timestamp,
 `enf_fecha_modificacion` timestamp null default null,
 `enf_estado_logico` varchar(1) not null
);

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `info_enfermedad` 
--
create table if not exists `info_enfermedad` (
 `ienf_id` bigint(20) not null auto_increment primary key,
 `ext_id` bigint(20) not null, -- id de la tabla externa que se debe extraer la persona
 `ext_base` varchar(50) default null, -- nombre de la base que se debe extraer la data
 `enf_id` bigint(20) not null, 
 `ienf_archivo` varchar(500) default null,
 `ienf_ruta` varchar(500) default null, 
 `ienf_estado` varchar(1) not null, 
 `ienf_fecha_creacion` timestamp not null default current_timestamp,
 `ienf_fecha_modificacion` timestamp null default null,
 `ienf_estado_logico` varchar(1) not null,
 foreign key (enf_id) references `enfermedad`(enf_id)
);

-- --------------------------------------------------------
-- 
-- Estructura de tabla para la tabla `cabecera_antecedentes_fam`
--
create table if not exists `cabecera_antecedentes_fam` (
  `cafa_id` bigint(20) not null auto_increment primary key,  
  `ext_id` bigint(20) not null, -- id de la tabla externa que se debe extraer la persona
  `ext_base` varchar(50) default null, -- nombre de la base que se debe extraer la data 
  `cafa_estado` varchar(1) not null,
  `cafa_fecha_creacion` timestamp not null default current_timestamp,
  `cafa_fecha_modificacion` timestamp null default null,
  `cafa_estado_logico` varchar(1) not null
);

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `detalle_antecedentes_fam` 
--
create table if not exists `detalle_antecedentes_fam` (
 `dafa_id` bigint(20) not null auto_increment primary key,
 `cafa_id` bigint(20) not null,
 `tpar_id` bigint(20) not null,  /*tipo parentesco de asgard ver si estan todos sino aumentar*/
 `tafam_id` bigint(20) not null,
 `dafa_nombres` varchar(100) default null,
 `dafa_apellidos` varchar(100) default null,
 `dafa_fecha_nacimiento` timestamp null default null,
 `dafa_ocupacion` varchar(50) default null,
 `dafa_genero` varchar(1) default null,
 `dafa_edad` bigint(20) default null,
 `dafa_carga_actual` varchar(100) default null, 
 `dafa_estado` varchar(1) not null, 
 `dafa_fecha_creacion` timestamp not null default current_timestamp,
 `dafa_fecha_modificacion` timestamp null default null,
 `dafa_estado_logico` varchar(1) not null,
 foreign key (cafa_id) references `cabecera_antecedentes_fam`(cafa_id)
);

-- --------------------------------------------------------
-- 
-- Estructura de tabla para la tabla `cabecera_experiencia_laboral`
--
create table if not exists `cabecera_experiencia_laboral` (
  `cela_id` bigint(20) not null auto_increment primary key,  
  `ext_id` bigint(20) not null, -- id de la tabla externa que se debe extraer la persona
  `ext_base` varchar(50) default null, -- nombre de la base que se debe extraer la data  
  `cela_estado` varchar(1) not null,
  `cela_fecha_creacion` timestamp not null default current_timestamp,
  `cela_fecha_modificacion` timestamp null default null,
  `cela_estado_logico` varchar(1) not null 
);

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `detalle_experiencia_laboral` 
--
create table if not exists `detalle_experiencia_laboral` (
 `dela_id` bigint(20) not null auto_increment primary key,
 `cela_id` bigint(20) not null,
 `temp_id` bigint(20) not null,  
 `dela_empresa` varchar(100) default null,
 `dela_direccion_empresa` varchar(100) default null,
 `dela_telefono_empresa` varchar(50) default null,
 `dala_inicio_labores` timestamp null default null,
 `dala_fin_labores` timestamp null default null,
 `dala_hasta_actualidad` varchar(1) default null,
 `dala_estado` varchar(1) not null, 
 `dala_fecha_creacion` timestamp not null default current_timestamp,
 `dala_fecha_modificacion` timestamp null default null,
 `dala_estado_logico` varchar(1) not null,
 foreign key (cela_id) references `cabecera_experiencia_laboral`(cela_id) 
);

-- --------------------------------------------------------
-- /* (1 => educacion superior, 2 => reconocimientos academicos, 3 => idiomas) */
-- Estructura de tabla para la tabla `tipo_curricular`
--
create table if not exists `tipo_curricular` (
  `tcur_id` bigint(20) not null auto_increment primary key,    
  `tcur_nombre` varchar(100) not null,
  `tcur_descripcion` varchar(100) not null,
  `tcur_estado` varchar(1) not null,
  `tcur_fecha_creacion` timestamp not null default current_timestamp,
  `tcur_fecha_modificacion` timestamp null default null,
  `tcur_estado_logico` varchar(1) not null  
);

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `idioma`
-- Ingles, Frances ,etc. 
create table if not exists `idioma` (
 `idi_id` bigint(20) not null auto_increment primary key,
 `idi_nombre` varchar(250) default null,
 `idi_descripcion` varchar(500) default null,
 `idi_estado` varchar(1) not null,
 `idi_fecha_creacion` timestamp not null default current_timestamp,
 `idi_fecha_modificacion` timestamp null default null,
 `idi_estado_logico` varchar(1) not null
) ;

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `criterio_idioma`
-- Hablado, Escrito
create table if not exists `criterio_idioma` (
 `cidi_id` bigint(20) not null auto_increment primary key,
 `cidi_nombre` varchar(500) default null,
 `cidi_descripcion` varchar(500) default null,
 `cidi_estado` varchar(1) not null,
 `cidi_fecha_creacion` timestamp not null default current_timestamp,
 `cidi_fecha_modificacion` timestamp null default null,
 `cidi_estado_logico` varchar(1) not null
) ;

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `nivel_idioma`
-- basico, intermedio, avanzado
create table if not exists `nivel_idioma` (
 `nidi_id` bigint(20) not null auto_increment primary key,
 `nidi_descripcion` varchar(500) default null,
 `nidi_estado` varchar(1) not null,
 `nidi_fecha_creacion` timestamp not null default current_timestamp,
 `nidi_fecha_modificacion` timestamp null default null,
 `nidi_estado_logico` varchar(1) not null
) ;

--
-- Estructura de tabla para la tabla `relacion_x_idioma`
-- 

create table if not exists `resultado_x_idioma` (
  `rxid_id` bigint(20) not null auto_increment primary key, 
  `idi_id` bigint(20) not null,  
  `cidi_id` bigint(20) not null,   
  `nidi_id` bigint(20) not null,
  `rxid_porcentaje` varchar(5) not null,
  `rxid_estado` varchar(1) not null,
  `rxid_fecha_creacion` timestamp not null default current_timestamp,
  `rxid_fecha_modificacion` timestamp null default null,
  `rxid_estado_logico` varchar(1) not null,
  
  foreign key (idi_id) references `idioma`(idi_id),
  foreign key (cidi_id) references `criterio_idioma`(cidi_id),
  foreign key (nidi_id) references `nivel_idioma`(nidi_id)

);

-- --------------------------------------------------------
-- 
-- Estructura de tabla para la tabla `cabecera_informacion_curricular`
--
create table if not exists `cabecera_informacion_curricular` (
  `cicu_id` bigint(20) not null auto_increment primary key,  
  `ext_id` bigint(20) not null, -- id de la tabla externa que se debe extraer la persona
  `ext_base` varchar(50) default null, -- nombre de la base que se debe extraer la data
  `cicu_estado` varchar(1) not null,
  `cicu_fecha_creacion` timestamp not null default current_timestamp,
  `cicu_fecha_modificacion` timestamp null default null,
  `cicu_estado_logico` varchar(1) not null
);

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `detalle_informacion_curricular` 
--
create table if not exists `detalle_informacion_curricular` (
 `dicu_id` bigint(20) not null auto_increment primary key,
 `cicu_id` bigint(20) not null,
 `nins_id` bigint(20) not null,  /* de la tabla nivel_instruccion bd_academico */
 `ixti_id` bigint(20) not null,
 `tcur_id` bigint(20) not null, 
 `rxid_id` bigint(20) null, 
 `dicu_otra_institución` varchar(100) default null,
 `dicu_titulo_obtenido` varchar(50) default null,
 `dicu_titulo_obtener` varchar(50) default null, 
 `dicu_fecha registro` timestamp null default null,
 `dicu_fecha_ingreso` timestamp null default null,
 `dicu_numero_registro` varchar(50) default null,
 `dicu_reconocimiento_otorgado` varchar(50) default null,
 `dicu_año_logro` varchar(4) default null, 
 `dicu_institucion_certifica` varchar(100) default null,  
 `pai_id` bigint(20) default null, /* tabla pais bd_asgard*/
 `can_id` bigint(20) default null, /* tabla canton bd_asgard */ 
 `dicu_documento_superior` varchar(100) default null, 
 `dicu_archivo_certificado` varchar(500) default null, 
 `dicu_ruta_certificado` varchar(500) default null,
 `dicu_estado` varchar(1) not null, 
 `dicu_fecha_creacion` timestamp not null default current_timestamp,
 `dicu_fecha_modificacion` timestamp null default null,
 `dicu_estado_logico` varchar(1) not null,
 foreign key (cicu_id) references `cabecera_informacion_curricular`(cicu_id), 
 foreign key (tcur_id) references `tipo_curricular`(tcur_id),
 foreign key (ixti_id) references `institucion_x_tipo`(ixti_id),
 foreign key (rxid_id) references `resultado_x_idioma`(rxid_id)
);

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `tipo_capacitacion` 
--
create table if not exists `tipo_capacitacion` (
 `tcap_id` bigint(20) not null auto_increment primary key,
 `tcap_nombre` varchar(100) default null, 
 `tcap_descripcion` varchar(100) default null, 
 `tcap_estado` varchar(1) not null, 
 `tcap_fecha_creacion` timestamp not null default current_timestamp,
 `tcap_fecha_modificacion` timestamp null default null,
 `tcap_estado_logico` varchar(1) not null
);
-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `tipo_diploma` 
--
create table if not exists `tipo_diploma` (
 `tdip_id` bigint(20) not null auto_increment primary key,
 `tdip_nombre` varchar(100) default null, 
 `tdip_descripcion` varchar(100) default null, 
 `tdip_estado` varchar(1) not null, 
 `tdip_fecha_creacion` timestamp not null default current_timestamp,
 `tdip_fecha_modificacion` timestamp null default null,
 `tdip_estado_logico` varchar(1) not null 
);
-- --------------------------------------------------------
-- 
-- Estructura de tabla para la tabla `cabecera_capacitacion`
--
create table if not exists `cabecera_capacitacion` (
  `ccap_id` bigint(20) not null auto_increment primary key,  
  `ext_id` bigint(20) not null, -- id de la tabla externa que se debe extraer la persona
  `ext_base` varchar(50) default null, -- nombre de la base que se debe extraer la data  
  `ccap_estado` varchar(1) not null,
  `ccap_fecha_creacion` timestamp not null default current_timestamp,
  `ccap_fecha_modificacion` timestamp null default null,
  `ccap_estado_logico` varchar(1) not null 
);

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `detalle_capacitacion` 
--
create table if not exists `detalle_capacitacion` (
 `dcap_id` bigint(20) not null auto_increment primary key,
 `ccap_id` bigint(20) not null,
 `tcap_id` bigint(20) not null, 
 `tdip_id` bigint(20) not null,
 `ixti_id` bigint(20) not null,
 `dcap_nombre_curso` varchar(100) null,
 `dcap_tipo_capacitacion` varchar(1) null,
 `nint_id` bigint(20) not null,
 `dcap_institucion_organiza` varchar(50) null,
 `dcap_fecha_inicio` timestamp null default null,
 `dcap_fecha_fin` timestamp null default null,
 `dcap_documento_capacitacion` varchar(100) null,
 `dcap_estado` varchar(1) not null, 
 `dcap_fecha_creacion` timestamp not null default current_timestamp,
 `dcap_fecha_modificacion` timestamp null default null,
 `dcap_estado_logico` varchar(1) not null,
 foreign key (ccap_id) references `cabecera_capacitacion`(ccap_id),
 foreign key (ixti_id) references `institucion_x_tipo`(ixti_id)
);
-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `info_discapacidad` 
--
create table if not exists `info_discapacidad` (
 `idis_id` bigint(20) not null auto_increment primary key,
 `ext_id` bigint(20) not null, -- id de la tabla externa que se debe extraer la persona
 `ext_base` varchar(50) default null, -- nombre de la base que se debe extraer la data
 `tdis_id` bigint(20) null, -- tipo de discapacidad de asgard, determinar si estan todas las de la lista y las que no AUMNETAR
 `idis_carnet_conadis` varchar(20) null,
 `idis_discapacidad` varchar(1) null, 
 `idis_porcentaje` varchar(3) null,
 `idis_archivo` varchar(500) null,
 `idis_estado` varchar(1) not null, 
 `idis_fecha_creacion` timestamp not null default current_timestamp,
 `idis_fecha_modificacion` timestamp null default null,
 `idis_estado_logico` varchar(1) not null
);

-- --------------------------------------------------------
-- 
-- Estructura de tabla para la tabla `cabecera_antecedentes_fam`
--
create table if not exists `cabecera_antecedentes_fam` (
  `cafa_id` bigint(20) not null auto_increment primary key,  
  `ext_id` bigint(20) not null, -- id de la tabla externa que se debe extraer la persona
  `ext_base` varchar(50) default null, -- nombre de la base que se debe extraer la data  
  `cafa_estado` varchar(1) not null,
  `cafa_fecha_creacion` timestamp not null default current_timestamp,
  `cafa_fecha_modificacion` timestamp null default null,
  `cafa_estado_logico` varchar(1) not null
);

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `detalle_antecedentes_fam` 
--
create table if not exists `detalle_antecedentes_fam` (
 `dafa_id` bigint(20) not null auto_increment primary key,
 `cafa_id` bigint(20) not null,
 `tpar_id` bigint(20) not null, -- tipo parentesco de asgar ver si estan todos sino aumentar
 `dafa_nombres` varchar(100) null,
 `dafa_apellidos` varchar(100) null,
 `dafa_fecha_nacimiento` timestamp null default null,
 `dafa_ocupacion` varchar(50) null,
 `dafa_genero` varchar(1) default null,
 `dafa_edad` bigint(20) null,
 `dafa_carga_actual` varchar(100) null,
 `dafa_tipo_antecedente` varchar(1) null, /*(1 => integrantes de familia que viven con profesor, 2 => hijos  que no viven con profesor, 3 => familiares en la institucion) */
 `dafa_estado` varchar(1) not null, 
 `dafa_fecha_creacion` timestamp not null default current_timestamp,
 `dafa_fecha_modificacion` timestamp null default null,
 `dafa_estado_logico` varchar(1) not null,
 foreign key (cafa_id) references `cabecera_antecedentes_fam`(cafa_id)
);

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `participación` 
--
create table if not exists `participación` (
 `par_id` bigint(20) not null auto_increment primary key,
 `par_nombre` varchar(100) default null, 
 `par_descripcion` varchar(100) default null, 
 `par_estado` varchar(1) not null, 
 `par_fecha_creacion` timestamp not null default current_timestamp,
 `par_fecha_modificacion` timestamp null default null,
 `par_estado_logico` varchar(1) not null
);

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `estado_publicacion` 
--
create table if not exists `estado_publicacion` (
 `epub_id` bigint(20) not null auto_increment primary key,
 `epub_nombre` varchar(100) default null, 
 `epub_descripcion` varchar(100) default null, 
 `epub_estado` varchar(1) not null, 
 `epub_fecha_creacion` timestamp not null default current_timestamp,
 `epub_fecha_modificacion` timestamp null default null,
 `epub_estado_logico` varchar(1) not null
);

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `tipo_publicacion` 
--
create table if not exists `tipo_publicacion` (
 `tpub_id` bigint(20) not null auto_increment primary key,
 `tpub_nombre` varchar(100) default null, 
 `tpub_descripcion` varchar(100) default null, 
 `tpub_estado` varchar(1) not null, 
 `tpub_fecha_creacion` timestamp not null default current_timestamp,
 `tpub_fecha_modificacion` timestamp null default null,
 `tpub_estado_logico` varchar(1) not null
);

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `tipo_empresa` 
--
create table if not exists `tipo_empresa` (
 `temp_id` bigint(20) not null auto_increment primary key,
 `temp_nombre` varchar(100) default null, 
 `temp_descripcion` varchar(100) default null, 
 `temp_estado` varchar(1) not null, 
 `temp_fecha_creacion` timestamp not null default current_timestamp,
 `temp_fecha_modificacion` timestamp null default null,
 `temp_estado_logico` varchar(1) not null
);

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `rol_proyecto` 
--
create table if not exists `rol_proyecto` (
 `rpro_id` bigint(20) not null auto_increment primary key,
 `rpro_nombre` varchar(100) default null, 
 `rpro_descripcion` varchar(100) default null, 
 `rpro_estado` varchar(1) not null, 
 `rpro_fecha_creacion` timestamp not null default current_timestamp,
 `rpro_fecha_modificacion` timestamp null default null,
 `rpro_estado_logico` varchar(1) not null
);

-- --------------------------------------------------------
-- 
-- Estructura de tabla para la tabla `cabecera_investigacion`
--
 create table if not exists `cabecera_investigacion` (
  `cinv_id` bigint(20) not null auto_increment primary key,  
  `ext_id` bigint(20) not null, -- id de la tabla externa que se debe extraer la persona
  `ext_base` varchar(50) default null, -- nombre de la base que se debe extraer la data  
  `cinv_estado` varchar(1) not null,
  `cinv_fecha_creacion` timestamp not null default current_timestamp,
  `cinv_fecha_modificacion` timestamp null default null,
  `cinv_estado_logico` varchar(1) not null  
);

-- --------------------------------------------------------
-- 
-- Estructura de tabla para la tabla `detalle_investigacion`
--
 create table if not exists `detalle_investigacion` (
  `dinv_id` bigint(20) not null auto_increment primary key,  
  `cinv_id` bigint(20) not null,  
  `rpro_id` bigint(20) not null,
  `ixti_id` bigint(20) not null,
  `dinv_otra_institución` varchar(100)  null,  
  `dinv_linea_investigacion` varchar(100) null, 
  `dinv_nombre_proyecto` varchar(100) null, 
  `dinv_anio_investigacion` varchar(4) null, 
  `dinv_duracion` varchar(10) null, 
  `dinv_estado` varchar(1) not null,
  `dinv_fecha_creacion` timestamp not null default current_timestamp,
  `dinv_fecha_modificacion` timestamp null default null,
  `dinv_estado_logico` varchar(1) not null,
  foreign key (cinv_id) references `cabecera_investigacion`(cinv_id),
  foreign key (rpro_id) references `rol_proyecto`(rpro_id),
  foreign key (ixti_id) references `institucion_x_tipo`(ixti_id)  
);

-- --------------------------------------------------------
-- 
-- Estructura de tabla para la tabla `cabecera_publicacion`
--
 create table if not exists `cabecera_publicacion` (
  `cpub_id` bigint(20) not null auto_increment primary key,  
  `ext_id` bigint(20) not null, -- id de la tabla externa que se debe extraer la persona
  `ext_base` varchar(50) default null, -- nombre de la base que se debe extraer la data    
  `cpub_estado` varchar(1) not null,
  `cpub_fecha_creacion` timestamp not null default current_timestamp,
  `cpub_fecha_modificacion` timestamp null default null,
  `cpub_estado_logico` varchar(1) not null  
);

-- --------------------------------------------------------
-- 
-- Estructura de tabla para la tabla `detalle_publicacion`
--
 create table if not exists `detalle_publicacion` (
  `dpub_id` bigint(20) not null auto_increment primary key,  
  `cpub_id` bigint(20) not null, 
  `tpub_id` bigint(20) not null,
  `par_id` bigint(20) not null,
  `epub_id` bigint(20) not null,
  `dpub_nombre_publicacion` varchar(100)  null, 
  `dpub_fecha_publicacion` timestamp null default null, 
  `dpub_revision_par` varchar(1) null, 
  `dpub_numero_isbn` varchar(50) null, 
  `dpub_numero_issn` varchar(50) null, 
  `dpub_nombre_revista` varchar(100) null, 
  `dpub_link_publicacion` varchar(100) null,  
  `dpub_editorial_publica` varchar(100) null,  
  `dpub_estado` varchar(1) not null,
  `dpub_fecha_creacion` timestamp not null default current_timestamp,
  `dpub_fecha_modificacion` timestamp null default null,
  `dpub_estado_logico` varchar(1) not null,
  foreign key (cpub_id) references `cabecera_publicacion`(cpub_id),
  foreign key (tpub_id) references `tipo_publicacion`(tpub_id),
  foreign key (par_id) references `participación`(par_id),
  foreign key (epub_id) references `estado_publicacion`(epub_id)
);

--
-- Estructura de tabla para la tabla `tipo_contacto_general` 
--
create table if not exists `tipo_contacto_general` (
 `tcge_id` bigint(20) not null auto_increment primary key,
 `tcge_nombre` varchar(100) default null, 
 `tcge_descripcion` varchar(100) default null, 
 `tcge_estado` varchar(1) not null, 
 `tcge_fecha_creacion` timestamp not null default current_timestamp,
 `tcge_fecha_modificacion` timestamp null default null,
 `tcge_estado_logico` varchar(1) not null
);

/***********************************************************************/
--
-- Estructura de tabla para la tabla `contacto_general` 
--
create table if not exists `contacto_general` (
 `cgen_id` bigint(20) not null auto_increment primary key,
 `tcge_id` bigint(20) default null, -- tipo de contacto, 1.- emergencia, 2.- experiencia laboral, 3.- experiencia docencia
 `ext_id` bigint(20) not null, -- id de la tabla externa que se debe extraer la persona 
 `ext_base` varchar(100) default null, -- nombre de la base que se debe extraer la data  
 `cgen_nombre` varchar(50) default null,
 `cgen_apellido` varchar(50) default null,
 `tpar_id` bigint(20) default null, -- Aqui se guarda el id de tipo de parentesco de db_asgard
 `cgen_direccion` varchar(500) default null,
 `cgen_telefono` varchar(50) default null,
 `cgen_celular` varchar(50) default null,
 `cgen_estado` varchar(1) not null,
 `cgen_fecha_creacion` timestamp not null default current_timestamp,
 `cgen_fecha_modificacion` timestamp null default null,
 `cgen_estado_logico` varchar(1) not null,

 foreign key (tcge_id) references `tipo_contacto_general`(tcge_id) 
);


--
-- Estructura de tabla para la tabla `institucion_temporal` 
-- tambien preguntar si hay institucion_temporal_tipo y institucion_temporal_x_tipo
create table if not exists `institucion_temporal` (
  `item_id` bigint(20) not null auto_increment primary key,
  `ext_id` bigint(20) not null, -- id de la tabla externa que se debe extraer la persona
  `item_tabla` varchar(100) not null,
  `item_categoria` varchar(1) null,
  `item_nombre` varchar(100) not null,
  `item_abreviacion` varchar(10) default null,
  `item_direccion_institucion` varchar(50) default null,
  `item_telefono_institucion` varchar(50) default null,
  `item_estado` varchar(1) not null,
  `item_fecha_creacion` timestamp not null default current_timestamp,
  `item_fecha_modificacion` timestamp null default null,
  `item_estado_logico` varchar(1) not null
);

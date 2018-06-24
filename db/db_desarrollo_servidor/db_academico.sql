--
-- Base de datos: `db_academico`
--
DROP SCHEMA IF EXISTS `db_academico` ;
CREATE SCHEMA IF NOT EXISTS `db_academico` DEFAULT CHARACTER SET utf8 ;
USE `db_academico` ;

GRANT ALL PRIVILEGES ON `db_academico`.* TO 'utegasgard'@'localhost' IDENTIFIED BY 'Ut3G4dmi1n-d364rr00@ll20167*Onl1n3W@';
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
  -- `fac_id` bigint(20) not null,
  -- `tica_id` bigint(20) not null, 
  -- `mod_id` bigint(20) not null, 
-- `car_codigo` varchar(100) not null,
  `car_nombre` varchar(200) not null,
  `car_descripcion` varchar(500) not null,
 -- `car_nivel` varchar(100) null,
 -- `car_grado_academico` varchar(100) null,
 -- `car_unidad_seguimiento` varchar(100) null,
 -- `car_centro_apoyo` varchar(100) null,
 -- `car_perspectiva` varchar(100) null,
  `car_total_asignatura` int null, 
  `car_duracion_anio` int null, 
--  `car_costo_anual` double default null, 
 -- `car_titulo_academico` varchar(150) null, 
 -- `car_numero_colegiado` varchar(150) null,  
 -- `car_numero_conesup` varchar(150) null,  
 -- `car_valor_arancel` double default null, 
 -- `car_pra_preprofesion` varchar(150) null,
 -- `car_proyecto_titulacion` varchar(2) null,
  `car_estado_carrera` varchar(2) not null,
  `car_estado` varchar(1) not null,
  `car_fecha_creacion` timestamp not null default current_timestamp,
  `car_fecha_aprobacion` timestamp null default null,  
  `car_fecha_modificacion` timestamp null default null,
  `car_estado_logico` varchar(1) not null -- ,
--  foreign key (fac_id) references `facultad`(fac_id),
-- foreign key (tica_id) references `tipo_carrera`(tica_id),
--  foreign key (mod_id) references `modalidad`(mod_id)
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
-- Estructura de tabla para la tabla `area_conocimiento`
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

-- --------------------------------------------------------
--
-- Estructura de tabla para `tipo_horario` (1 matutino, 2 nocturno, 3 especial, 4 clase en vivo)
--
/*create table if not exists `tipo_horario` (
  `thor_id` bigint(20) not null auto_increment primary key,
  `thor_nombre` varchar(200) not null,
  `thor_descripcion` varchar(500) not null,
  `thor_estado` varchar(1) not null,
  `thor_fecha_creacion` timestamp not null default current_timestamp,
  `thor_fecha_modificacion` timestamp null default null,
  `thor_estado_logico` varchar(1) not null  
); */

-- --------------------------------------------------------
--
-- Estructura de tabla para `bloque`
--

create table if not exists `bloque` (
  `blo_id` bigint(20) not null auto_increment primary key,
  -- `hor_id` bigint(20) not null,
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
  `blo_estado_logico` varchar(1) not null

  -- foreign key (hor_id) references `horario`(hor_id)

);

-- --------------------------------------------------------
--
-- Estructura de tabla para `semestre_academico`
--

/*create table if not exists `semestre_academico` (

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

);*/

-- --------------------------------------------------------
--
-- Estructura de tabla para `anio_academico`
--
create table if not exists `anio_academico` (

  `aaca_id` bigint(20) not null auto_increment primary key,
  -- `saca_id` bigint(20) not null, 
  `blo_id` bigint(20) not null, 
  `aaca_nombre` varchar(100) not null,
  `aaca_descripcion` varchar(100) not null,
  `aaca_usuario_ingreso` bigint(20) not null,
  `aaca_usuario_modifica` bigint(20)  null,
  `aaca_estado` varchar(1) not null,
  `aaca_fecha_creacion` timestamp not null default current_timestamp,
  `aaca_fecha_modificacion` timestamp null default null,
  `aaca_estado_logico` varchar(1) not null,
  foreign key (blo_id) references `bloque`(blo_id)
  -- foreign key (saca_id) references `semestre_academico`(saca_id)
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
  `pro_id` bigint(20) not null,  
  `paca_id` bigint(20) null, -- este ahora nulo
  `asi_id` bigint(20) not null,
  `nint_id` bigint(20) not null,
  -- `fac_id` bigint(20) not null,
  `mod_id` bigint(20) not null,
  -- `hor_id` bigint(20) not null,
  `acon_id` bigint(20) not null,
  `blo_id` bigint(20) null, -- este ahora nulo
  `scon_id` bigint(20) not null,
  `edes_paralelo` bigint(20) not null,
  `car_id` varchar(200) null, 
  `gru_id` bigint(20) null, 
  `edes_mes` bigint(20) null, 
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
  foreign key (mod_id) references `modalidad`(mod_id),
  -- foreign key (hor_id) references `horario`(hor_id),
  foreign key (acon_id) references `area_conocimiento`(acon_id), 
  foreign key (scon_id) references `subarea_conocimiento`(scon_id)
);

-- --------------------------------------------------------
--
-- Estructura de tabla para `horario`
--
create table if not exists `horario` (
  `hor_id` bigint(20) not null auto_increment primary key,
  -- `thor_id` bigint(20) not null,
   `edes_id` bigint(20) not null,
  `hor_descripcion` varchar(100) null,
  `hor_inicio` varchar(10) not null,
  `hor_fin` varchar(10) not null,
  `hor_dia` varchar(20) null,
  /*`hor_lunes` varchar(1) null,
  `hor_martes` varchar(1) null,
  `hor_miercoles` varchar(1) null,
  `hor_jueves` varchar(1) null,
  `hor_viernes` varchar(1) null,
  `hor_sabado` varchar(1) null,
  `hor_domingo` varchar(1) null,*/
  `hor_rama` varchar(1) null, -- 1 licenciatura , 2 ingenieria
  `hor_usuario_ingreso` bigint(20) not null,
  `hor_usuario_modifica` bigint(20)  null,
  `hor_estado` varchar(1) not null,
  `hor_fecha_creacion` timestamp not null default current_timestamp,
  `hor_fecha_modificacion` timestamp null default null,
  `hor_estado_logico` varchar(1) not null,
  foreign key (edes_id) references `evaluacion_desempeno`(edes_id)

  -- foreign key (thor_id) references `tipo_horario`(thor_id)

);

-- --------------------------------------------------------
-- Estructura de tabla para la tabla `profesor`
--
create table if not exists `profesor` (
  `pro_id` bigint(20) not null auto_increment primary key,
  `per_id` bigint(20) not null,    
  `pro_estado` varchar(1) not null,
  `pro_fecha_creacion` timestamp not null default current_timestamp,
  `pro_fecha_modificacion` timestamp null default null,
  `pro_estado_logico` varchar(1) not null
);

-- --------------------------------------------------------
-- Estructura de tabla para la tabla `estudiante`
--
create table if not exists `estudiante` (
  `est_id` bigint(20) not null auto_increment primary key,
  `per_id` bigint(20) not null,    
  `est_estado` varchar(1) not null,
  `est_fecha_creacion` timestamp not null default current_timestamp,
  `est_fecha_modificacion` timestamp null default null,
  `est_estado_logico` varchar(1) not null
);

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `grupo`
--
create table if not exists `grupo` (
 `gru_id` bigint(20) not null auto_increment primary key,
 `gru_nombre` varchar(300) not null,
 `gru_descripcion` varchar(500) not null,
 `gru_estado` varchar(1) not null,
 `gru_fecha_creacion` timestamp not null default current_timestamp,
 `gru_fecha_modificacion` timestamp null default null,
 `gru_estado_logico` varchar(1) not null
);

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `asignatura`
--
create table if not exists `asignatura_planificacion_acad` (
  `apac_id` bigint(20) not null auto_increment primary key,
  `fac_id` bigint(20) not null,  
  `apac_nombre` varchar(200) not null,
  `apac_descripcion` varchar(500) not null,
  `apac_estado_asignatura` varchar(1) not null,
  `apac_estado` varchar(1) not null,
  `apac_fecha_creacion` timestamp not null default current_timestamp,
  `apac_fecha_modificacion` timestamp null default null,
  `apac_estado_logico` varchar(1) not null
  
);
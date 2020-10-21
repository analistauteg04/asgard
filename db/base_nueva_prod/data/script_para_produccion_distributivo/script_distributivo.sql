update db_academico.distributivo_academico 
set daca_jornada = 3
where paca_id = 10 and mod_id = 3;

create table if not exists db_academico.`configuracion_tipo_distributivo` (
 `ctdi_id` bigint(20) not null auto_increment primary key,
 `tdis_id` varchar(250) not null,
 `ctdi_estado_vigencia` varchar(1) not null,
 `ctdi_horas_semanal` integer(3) not null,
 `ctdi_estado` varchar(1) not null,
 `ctdi_fecha_creacion` timestamp not null default current_timestamp,
 `ctdi_fecha_modificacion` timestamp null default null,
 `ctdi_estado_logico` varchar(1) not null
);

INSERT INTO db_academico.`configuracion_tipo_distributivo` (`ctdi_id`, `tdis_id`, `ctdi_estado_vigencia`, `ctdi_horas_semanal`, `ctdi_estado`, `ctdi_estado_logico`)
VALUES (1, 2, '1', 2, '1', '1'),
(2, 3, '1', 2, '1', '1'),
(3, 4, '1', 2, '1', '1');

alter table db_academico.distributivo_academico add daho_id bigint(20) after mod_id;
alter table db_academico.distributivo_academico add tdis_id bigint(20) after paca_id;  
alter table db_academico.distributivo_academico add daca_paralelo bigint(20) after daho_id;  
alter table db_academico.distributivo_academico add pppr_id bigint(20) after daca_paralelo;  
Alter table db_academico.distributivo_academico add foreign key (pppr_id) references paralelo_promocion_programa (pppr_id);
Alter table db_academico.distributivo_academico drop foreign key distributivo_academico_ibfk_6;
alter table db_academico.distributivo_academico drop ppro_id;  
Alter table db_academico.distributivo_academico add foreign key (tdis_id) references tipo_distributivo (tdis_id);

update db_academico.distributivo_academico a
set a.daho_id = (select daho_id from db_academico.distributivo_academico_horario where uaca_id = a.uaca_id and mod_id = a.mod_id and daho_jornada = a.daca_jornada and daho_horario = a.daca_horario)
where a.daho_id is null

-- Colocar daca_horario y daca_jornada que permitan nulos y eliminarlos despuès.
-- Colocar asi_id, uaca_id, mod_id que permitan valores nulos.

create table if not exists `distributivo_cabecera` (
  `dcab_id` bigint(20) not null auto_increment primary key, 
  `paca_id` bigint(20) null,
  `pro_id` bigint(20) not null,
  `dcab_estado_revision` varchar(1) null,
  `dcab_observacion_revision` varchar(1000) null,
  `dcab_fecha_revision` timestamp null default null,
  `dcab_usuario_revision` bigint(20) null,
  `dcab_fecha_registro` timestamp null default null,
  `dcab_usuario_ingreso` bigint(20) not null,
  `dcab_usuario_modifica` bigint(20) null,
  `dcab_estado` varchar(1) not null,
  `dcab_fecha_creacion` timestamp not null default current_timestamp,
  `dcab_fecha_modificacion` timestamp null default null,
  `dcab_estado_logico` varchar(1) not null,
  foreign key (pro_id) references `profesor`(pro_id),
  foreign key (paca_id) references `periodo_academico`(paca_id)
);
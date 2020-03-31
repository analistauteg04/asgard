alter table db_asgard.usuario add column usu_upreg varchar(1) null after usu_link_activo;

alter table db_academico.estudiante add `est_matricula` varchar(20) null after per_id;
alter table db_academico.estudiante add `est_categoria` varchar(2) null after est_matricula;
alter table db_academico.estudiante add `est_fecha_ingreso` timestamp null default null after est_categoria;

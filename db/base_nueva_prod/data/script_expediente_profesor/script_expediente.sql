insert into db_general.nivel_idioma (nidi_id, nidi_descripcion, nidi_estado, nidi_estado_logico) values (4, 'Nativo', 1, 1);
alter table db_academico.profesor_coordinacion add ins_id bigint after pcoo_academico;
alter table db_academico.profesor_coordinacion drop pcoo_institucion; 
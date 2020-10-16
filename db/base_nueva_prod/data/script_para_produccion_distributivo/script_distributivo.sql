update db_academico.distributivo_academico 
set daca_jornada = 3
where paca_id = 10 and mod_id = 3;

alter table db_academico.distributivo_academico add daho_id bigint(20) after mod_id;
alter table db_academico.distributivo_academico add daca_tipo bigint(20) after ppro_id;  
alter table db_academico.distributivo_academico add daca_paralelo bigint(20) after daho_id;  
alter table db_academico.distributivo_academico add pppr_id bigint(20) after daca_paralelo;  
Alter table db_academico.distributivo_academico add foreign key (pppr_id) references paralelo_promocion_programa (pppr_id);
Alter table db_academico.distributivo_academico drop foreign key distributivo_academico_ibfk_6;
alter table db_academico.distributivo_academico drop ppro_id;  

update db_academico.distributivo_academico a
set a.daho_id = (select daho_id from db_academico.distributivo_academico_horario where uaca_id = a.uaca_id and mod_id = a.mod_id and daho_jornada = a.daca_jornada and daho_horario = a.daca_horario)
where a.daho_id is null

-- Colocar daca_horario y daca_jornada que permitan nulos o eliminarlos despuès.
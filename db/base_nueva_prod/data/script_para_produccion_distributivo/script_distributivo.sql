update db_academico.distributivo_academico 
set daca_jornada = 3
where paca_id = 10 and mod_id = 3;

alter table db_academico.distributivo_academico add daho_id bigint(20) after mod_id;

update db_academico.distributivo_academico a
set a.daho_id = (select daho_id from db_academico.distributivo_academico_horario where uaca_id = a.uaca_id and mod_id = a.mod_id and daho_jornada = a.daca_jornada and daho_horario = a.daca_horario)
where a.daho_id is null

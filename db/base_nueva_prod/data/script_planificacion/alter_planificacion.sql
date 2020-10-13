ALTER TABLE `db_academico`.`planificacion` 
CHANGE COLUMN `pla_fecha_inicio` `pla_fecha_inicio` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP ,
CHANGE COLUMN `pla_fecha_fin` `pla_fecha_fin` TIMESTAMP NULL DEFAULT '0000-00-00 00:00:00';


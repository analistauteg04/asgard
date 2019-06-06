--
-- Base de datos: `db_crm`
--
USE `db_mailing`;
INSERT INTO db_mailing.`interes` (`int_id`,`int_descripcion`, `int_nombre`,`int_estado`,`int_estado_logico`) VALUES
(1,'Tecnología','Tecnología','1','1'),
(2,'Negocios','Negocios','1','1'),
(3,'Educación','Educación','1','1'),
(4,'Banca','Banca','1','1'),
(5,'Seguridad Laboral','Seguridad Laboral','1','1'),
(6,'Viajar','Viajar','1','1');

 INSERT INTO db_mailing.`evento` (`eve_id`,`eve_nombres`, `eve_fecha_inicio`,`eve_fecha_fin`,`eve_estado`,`eve_estado_logico`) VALUES
 ('1','Evento Marketing Maestría Educación','2019-06-08 00:00:00','2019-06-08 23:59:59','1','1');



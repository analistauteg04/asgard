-- para aumentar campo de quien asigna ejecutivo

ALTER TABLE interesado_ejecutivo add ieje_usuario bigint(20) NULL AFTER `per_id`;

-- para crear usuario secretaria online


-- POA en etapa de indicadores se debe aumentar el % de avance

INSERT INTO `persona` (`per_id`, `per_pri_nombre`, `per_seg_nombre`, `per_pri_apellido`, `per_seg_apellido`, `per_cedula`, `per_ruc`, `per_pasaporte`, `etn_id`, `eciv_id`, `per_genero`, `pai_id_nacimiento`, `pro_id_nacimiento`, `can_id_nacimiento`, `per_fecha_nacimiento`, `per_celular`, `per_correo`, `per_foto`, `tsan_id`, `per_domicilio_sector`, `per_domicilio_cpri`, `per_domicilio_csec`, `per_domicilio_num`, `per_domicilio_ref`, `per_domicilio_telefono`, `pai_id_domicilio`, `pro_id_domicilio`, `can_id_domicilio`, `per_trabajo_nombre`, `per_trabajo_direccion`, `per_trabajo_telefono`, `per_trabajo_ext`, `pai_id_trabajo`, `pro_id_trabajo`, `can_id_trabajo`, `per_estado`, `per_fecha_creacion`, `per_fecha_modificacion`, `per_estado_logico`) VALUES
(124, 'Priscilla', '', 'Recalde', '', '0921156683', NULL, NULL, 1, 1, 'F', 57, 10, 87, NULL, NULL, NULL, NULL, 7, NULL, NULL, NULL, NULL, NULL, NULL, 57, 10, 87, NULL, NULL, NULL, NULL, 57, 10, 87, '1', '2017-10-26 13:48:00', NULL, '1');


INSERT INTO `usuario` (`usu_id`, `per_id`, `usu_user`, `usu_sha`, `usu_password`, `usu_time_pass`, `usu_session`, `usu_last_login`, `usu_link_activo`, `usu_estado`, `usu_estado_logico`) VALUES
(124, 124, 'secretariaonline@uteg.edu.ec', 'fJtY3oWcSp2UsOqNEThAWN1HnlivjysQ', 'p9v10e9x7N54PyKTdRiOOzlmZmRjNGMyMjU4MTgwMzk3NzA1NTMyMTE4YjUyMTIxNzZjNmIzN2RkYWJiN2IyZmI2OTY0NjUzMTY0ZTYyOWaiP8hoC6K8n8bfbs3yh7Oj7fgQ/Rkjx92HOCuogY1nyZUBCQzrKaxob2ugVLZ/U3J6F5KTSxpNFIp3UkxH2UrE', NULL, NULL, NULL, NULL, '1', '1' );


INSERT INTO `rol` (`rol_id`,`rol_nombre`, `rol_descripcion`, `rol_estado`,`rol_estado_logico`) VALUES
(20,'Secretaria','Secretaria','1','1');


INSERT INTO `grup_rol` (`grol_id`, `gru_id`, `rol_id`, `grol_estado`,`grol_estado_logico`) VALUES
(15, 10, 20, '1','1');


INSERT INTO `usua_grol` (`ugro_id`, `usu_id`, `grol_id`, `ugro_estado`, `ugro_estado_logico`) VALUES
(119, 124, 15, '1', '1');


INSERT INTO `grup_obmo` (`gmod_id`, `gru_id`, `omod_id`,`gmod_estado` , `gmod_estado_logico`) VALUES
(35, 10, 12, '1', '1'); 


INSERT INTO `grup_obmo_grup_rol` (`gogr_id`, `grol_id`, `gmod_id`, `gogr_estado`, `gogr_estado_logico`) VALUES
(53, 15, 35, '1', '1');


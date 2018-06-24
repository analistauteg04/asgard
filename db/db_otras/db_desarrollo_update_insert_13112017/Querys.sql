/*1 */
update db_asgard.modulo set mod_orden=7 where mod_id=5;

/* 2 */ 
INSERT INTO db_asgard.modulo (mod_id, apl_id, mod_nombre, mod_tipo,mod_dir_imagen,mod_url,mod_orden,mod_lang_file,mod_estado_visible, mod_estado, mod_fecha_creacion, mod_fecha_actualizacion, mod_estado_logico) VALUES (NULL, 1, 'Expediente Profesor', 'Expediente Profesor', 'glyphicon glyphicon-list-alt', 'expedienteprofesor/create', 6, NULL, '1', '1', CURRENT_TIMESTAMP, NULL, '1');


/*3*/
INSERT INTO db_asgard.objeto_modulo (omod_id, mod_id, omod_padre_id, omod_nombre, omod_tipo,omod_tipo_boton, omod_accion, omod_function, omod_dir_imagen, omod_entidad, omod_orden, omod_estado_visible, omod_lang_file, omod_estado, omod_fecha_creacion, omod_fecha_actualizacion, omod_estado_logico) VALUES (NULL, '8', '16', 'Crear Expediente Profesor', 'S', '0', 'Crear Expediente Profesor', NULL, NULL, 'expedienteprofesor/create', '1', '1', NULL, '1', CURRENT_TIMESTAMP, NULL, '1');


/*4*/
INSERT INTO db_asgard.grup_obmo (gmod_id, gru_id, omod_id,gmod_estado, gmod_fecha_creacion, gmod_fecha_modificacion, gmod_estado_logico) VALUES (NULL, '6', '16', '1', CURRENT_TIMESTAMP, NULL, '1');


/*5*/
INSERT INTO db_asgard.grup_rol (grol_id, gru_id, rol_id, grol_estado, grol_fecha_creacion, grol_fecha_modificacion, grol_estado_logico) VALUES (NULL, '6', '6', '1', CURRENT_TIMESTAMP, NULL, '1');


/*6 */

INSERT INTO db_asgard.grup_obmo_grup_rol (gogr_id, grol_id, gmod_id, gogr_estado, gogr_fecha_creacion, gogr_fecha_modificacion, gogr_estado_logico) VALUES (NULL, '16', '37', '1', CURRENT_TIMESTAMP, NULL, '1')
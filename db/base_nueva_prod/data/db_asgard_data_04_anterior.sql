--
-- Base de datos: `db_asgard`
--
USE `db_asgard`;
-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `ACCION`
--
INSERT INTO `accion` (`acc_id`, `acc_nombre`, `acc_url_accion`, `acc_tipo`, `acc_descripcion`, `acc_lang_file`, `acc_dir_imagen`, `acc_estado`, `acc_estado_logico`) VALUES
(1, 'Create', 'Create', 'General', 'Create', 'accion', 'glyphicon glyphicon-file', '1', '1'),
(2, 'Update', 'Update', 'General', 'Update', 'accion', 'glyphicon glyphicon-edit', '1', '1'),
(3, 'Delete', 'Delete', 'General', 'Delete', 'accion', 'glyphicon glyphicon-trash', '1', '1'),
(4, 'Save', 'Save', 'General', 'Save', 'accion', 'glyphicon glyphicon-floppy-disk', '1', '1'),
(5, 'Search', 'Search', 'General', 'Search', 'accion', 'glyphicon glyphicon-search', '1', '1'),
(6, 'Print', 'Print', 'General', 'Print', 'accion', 'glyphicon glyphicon-print', '1', '1'),
(7, 'Import', 'Import', 'General', 'Import', 'accion', 'glyphicon glyphicon-import', '1', '1'),
(8, 'Export', 'Export', 'General', 'Export', 'accion', 'glyphicon glyphicon-export', '1', '1'),
(9, 'Back', 'Back', 'General', 'Back', 'accion', 'glyphicon glyphicon-triangle-right', '1', '1'),
(10, 'Next', 'Next', 'General', 'Next', 'accion', 'glyphicon glyphicon-triangle-left', '1', '1'),
(11, 'Clear', 'Clear', 'General', 'Clear', 'accion', 'glyphicon glyphicon-leaf', '1', '1'),
(12, 'Edit', 'Edit', 'General', 'Edit', 'accion', 'glyphicon glyphicon-pencil', '1', '1');
-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `tipo_empresa`
--
INSERT INTO `tipo_empresa` (`temp_id`, `temp_nombre`, `temp_descripcion`, `temp_estado`, `temp_estado_logico`) VALUES
(1, 'Empresa Pública', 'Empresa Pública', '1', '1'),
(2, 'Empresa Privada', 'Empresa Privada', '1', '1');

-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `EMPRESA`
--
INSERT INTO `empresa` (`emp_id`, `temp_id`, `emp_razon_social`, `emp_nombre_comercial`, `emp_alias`, `emp_ruc`, `emp_dominio`, `emp_imap_domain`, `emp_imap_port`, `emp_imap_user`, `emp_imap_pass`, `emp_direccion`, `emp_telefono`, `emp_descripcion`, `emp_estado`, `emp_fecha_creacion`, `emp_fecha_modificacion`, `emp_estado_logico`) VALUES
(1, 2, 'UTEG', 'UTEG', 'UTEG', '', 'www.uteg.edu.ec', 'www.uteg.edu.ec', '587', '', '', NULL, NULL, NULL, '1', CURRENT_TIMESTAMP, NULL, '1'),
(2, 2, 'ulink', 'ulink', 'ulink', '', 'www.ccc.com', 'www.ccc.com', '587', '', '', NULL, NULL, NULL, '1', CURRENT_TIMESTAMP, NULL, '1'),
(3, 2, 'smart', 'smart', 'smart', '', 'www.ccc.com', 'www.ccc.com', '587', '', '', NULL, NULL, NULL, '1', CURRENT_TIMESTAMP, NULL, '1');


-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `ETNIA`
--
INSERT INTO `etnia` (`etn_id`, `etn_nombre`, `etn_descripcion`, `etn_estado`, `etn_estado_logico`) VALUES
(1, 'Afroecuatoriano/a', 'Afroecuatoriano/a', '1', '1'),
(2, 'Blanco/a', 'Blanco/a', '1', '1'),
(3, 'Indígena', 'Indígena', '1', '1'),
(4, 'Mestizo/a', 'Mestizo/a', '1', '1'),
(5, 'Montubio/a', 'Montubio/a', '1', '1'),
(6, 'Otro', 'Otro', '1', '1'),
(7, 'Negro/a', 'Negro/a', '1', '1'),
(8, 'Mulato/a', 'Mulato/a', '1', '1');

-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `ESTADO_CIVIL`
--
INSERT INTO `estado_civil` (`eciv_id`, `eciv_nombre`, `eciv_descripcion`, `eciv_estado`, `eciv_estado_logico`) VALUES
(1, 'Soltero', 'Soltero', '1', '1'),
(2, 'Casado', 'Casado', '1', '1'),
(3, 'Viudo', 'Viudo', '1', '1'),
(4, 'Divorciado', 'Divorciado', '1', '1'),
(5, 'Unión de hecho', 'Unión de hecho', '1', '1');

-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `TIPO_PARENTESCO`
--
INSERT INTO `tipo_parentesco` (`tpar_id`, `tpar_nombre`, `tpar_descripcion`, `tpar_grado`, `tpar_estado`, `tpar_estado_logico`) VALUES
(1, 'Esposo', 'descripción de parentesco', '1', '1', '1'),
(2, 'Esposa', 'descripción de parentesco', '1', '1', '1'),
(3, 'Hijo', 'descripción de parentesco', '1', '1', '1'),
(4, 'Hija', 'descripción de parentesco', '1', '1', '1'),
(5, 'Padre', 'descripción de parentesco', '1', '1', '1'),
(6, 'Madre', 'descripción de parentesco', '1', '1', '1'),
(7, 'Abuelo', 'descripción de parentesco', '0', '1', '1'),
(8, 'Abuela', 'descripción de parentesco', '0', '1', '1'),
(9, 'Hermano', 'descripción de parentesco', '0', '1', '1'),
(10, 'Hermana', 'descripción de parentesco', '0', '1', '1'),
(11, 'Tío', 'descripción de parentesco', '0', '1', '1'),
(12, 'Tía', 'descripción de parentesco', '0', '1', '1');

-- --------------------------------------------------------
--
-- Tabla `tipo_identificacion`
--
INSERT INTO `tipo_identificacion` (`tide_id`, `tide_nombre`, `tide_descripcion`, `tide_numero_caracteres`, `tide_estado`, `tide_estado_logico`) VALUES
(1, 'Cedula', 'Cedula', '10', '1', '1'),
(2, 'RUC', 'RUC', '13', '1','1'),
(3, 'Pasaporte','Pasaporte', NULL, '1', '1');

-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `TIPO_PASSWORD`
--
INSERT INTO `tipo_password` (`tpas_id`, `tpas_descripcion`, `tpas_validacion`, `tpas_observacion`, `tpas_estado`, `tpas_estado_logico`) VALUES
(1, 'Simples', '/^(?=.*[a-z])(?=.*[A-Z]).{VAR,}$/', 'Las claves simples deben cumplir con lo mínimo: Caracteres alfabéticos (Mayúsculas y minúsculas).', '1', '1'),
(2, 'Semicomplejas', '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\\d).{VAR,}$/', 'Las claves semicomplejas deben cumplir con lo mínimo: Caracteres alfabéticos (Mayúsculas y minúsculas). ', '1', '1'),
(3, 'Complejas', '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\\d)(?=.*[@\\,\\;#¿\\?\\}\\{\\]\\[\\-_¡!\\=&\\^:<>\\.\\+\\*\\/\\$\\(\\)]).{VAR,}$/', 'Las claves complejas deben cumplir con lo mínimo: Caracteres alfabéticos (Mayúsculas y minúsculas).\nSímbolos: @ , ; # ¿ ? } { ] [ - _ ¡ ! = & ^ : < > . + * / ( )', '1', '1');
-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `TIPO_PERSONA`
--
INSERT INTO `tipo_persona` (`tper_id`, `tper_nombre`, `tper_estado`,`tper_estado_logico`) VALUES
(1, 'Natural', '1', '1'),
(2, 'Jurídica', '1', '1');
-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `TIPO_SANGRE`
--
INSERT INTO `tipo_sangre` (`tsan_id`, `tsan_nombre`, `tsan_descripcion`, `tsan_estado`, `tsan_estado_logico`) VALUES
(1, 'AB +', 'descripción de tipo de sangre', '1', '1'),
(2, 'AB -', 'descripción de tipo de sangre', '1', '1'),
(3, 'A +', 'descripción de tipo de sangre', '1', '1'),
(4, 'A -', 'descripción de tipo de sangre', '1', '1'),
(5, 'B +', 'descripción de tipo de sangre', '1', '1'),
(6, 'B -', 'descripción de tipo de sangre', '1', '1'),
(7, 'O+', 'descripción de tipo de sangre', '1', '1'),
(8, 'O -', 'descripción de tipo de sangre', '1', '1');

-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `TIPO_DISCAPACIDAD`
--
INSERT INTO `tipo_discapacidad` (`tdis_id`,`tdis_nombre`, `tdis_descripcion`,`tdis_estado`,`tdis_estado_logico`) VALUES
(1,'Auditiva','Auditiva','1','1'),
(2,'Física Motora','Física Motora','1','1'),
(3,'Intelectual','Intelectual','1','1'),
(4,'Lenguaje','Lenguaje','1','1'),
(5,'Mental Psicosocial','Mental Psicosocial','1','1'),
(6,'Visual','Visual','1','1');
-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `APLICACION`
--
INSERT INTO `aplicacion` (`apl_id`, `apl_nombre`, `apl_tipo`,`apl_estado`, `apl_estado_logico`) VALUES
(1, 'Framework', 'General', '1', '1');

--
-- Volcado de datos para la tabla `IDIOMA`
--
INSERT INTO `idioma` (`idi_id`, `idi_nombre`, `idi_tipo`,`idi_estado`, `idi_estado_logico`) VALUES
(1, 'Español', 'General', '1','1'),
(2, 'Ingles', 'General', '1','1');
-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `PLANTILLA`
--
INSERT INTO `plantilla` (`pla_id`, `pla_nombre`, `pla_tipo`, `pla_estado`, `pla_estado_logico`) VALUES
(1, 'Asgard', 'General', '1', '1');
-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `CONFIGURACION_SEGURIDAD`
--
INSERT INTO `configuracion_seguridad` (`cseg_id`, `tpas_id`, `cseg_long_pass`, `cseg_expiracion`, `cseg_descripcion`, `cseg_observacion`, `cseg_estado`, `cseg_estado_logico`) VALUES
(1, 1, '5', 0, 'Claves Simples min 5 caracteres. No tiene caducidad.', 'observación seguridad', '1','1'),
(2, 2, '6', 30, 'Claves SemiComplejas min 6 caracteres. Caducidad 30 dias.', 'observación seguridad','1', '1'),
(3, 3, '7', 60, 'Claves Complejas min 7 caracteres. Caducidad 60 dias.', 'observación seguirdad','1', '1');
-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `GRUPO`
--
INSERT INTO `grupo` (`gru_id`, `cseg_id`, `gru_nombre`, `gru_descripcion`, `gru_observacion`, `gru_estado`, `gru_estado_logico`) VALUES
(1, 3, 'Super Admin',  'Super Admin', NULL, '1', '1'),
(2, 1, 'Pre Interesado', 'Pre Interesado', NULL, '1', '1'),
(3, 1, 'Interesado', 'Interesado', NULL, '1', '1'),
(4, 1, 'Aspirante', 'Aspirante', NULL, '1', '1'),
(5, 1, 'Estudiante', 'Estudiante', NULL, '1', '1'),
(6, 2, 'Docente', 'Docente', NULL, '1', '1'),
(7, 3, 'Sistemas', 'Sistemas', NULL, '1', '1'),
(8, 2, 'Admisiones', 'Admisiones', NULL, '1', '1'),
(9, 2, 'Colecturia', 'Colecturia', NULL, '1', '1'),
(10, 2, 'Online', 'Online', NULL, '1', '1'),
(11, 2, 'Financiero', 'Financiero', NULL, '1', '1'),
(12, 2, 'Grado', 'Grado', NULL, '1', '1'),
(13, 2, 'Posgrado', 'Grado', NULL, '1', '1');
-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `ROL`
--
INSERT INTO `rol` (`rol_id`, `rol_nombre`, `rol_descripcion`, `rol_estado`, `rol_estado_logico`) VALUES
(1, 'Super Administrador', 'Super Administrador', '1', '1'),
(2, 'Pre Interesado', 'Pre Interesado', '1', '1'),
(3, 'Interesado', 'Interesado', '1', '1'),
(4, 'Aspirante', 'Aspirante', '1', '1'),
(5, 'Estudiante', 'Estudiante', '1', '1'),
(6, 'Docente', 'Docente', '1', '1'),
(7, 'Admin Sistemas', 'Admin Sistemas', '1', '1'),
(8, 'Admin Administrativo', 'Admin Administrativo', '1', '1'),
(9, 'Director', 'Director', '1', '1'),
(10, 'Jefe', 'Jefe', '1', '1'),
(11, 'Coordinador Senior', 'Coordinador Senior', '1', '1'),
(12, 'Coordinador Junior', 'Coordinador Junior', '1', '1'),
(13, 'Supervisor Senior', 'Supervisor Senior', '1', '1'),
(14, 'Supervisor Junior', 'Supervisor Junior', '1', '1'),
(15, 'Analista Senior', 'Analista Senior', '1', '1'),
(16, 'Analista Junior', 'Analista Junior', '1', '1'),
(17, 'Asistente Senior', 'Asistente Senior', '1', '1'),
(18, 'Asistente Junior', 'Asistente Junior', '1', '1'),
(19, 'Ejecutivo Comercial', 'Ejecutivo Comercial', '1', '1'),
(20, 'Secretaria', 'Secretaria', '1', '1'),
(21, 'Administrador Plataforma', 'Administrador Plataforma', '1', '1');
-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `GRUP_ROL`
--
INSERT INTO `grup_rol` (`grol_id`, `gru_id`, `rol_id`, `grol_estado`, `grol_estado_logico`) VALUES
(1, 1, 1, '1', '1'),
(2, 7, 10, '1', '1'),
(3, 7, 15, '1', '1'),
(4, 7, 16, '1', '1'),
(5, 8, 10, '1', '1'),
(6, 8, 11, '1', '1'),
(7, 8, 13, '1', '1'),
(8, 8, 19, '1', '1'),
(9, 9, 10, '1', '1'),
(10, 2, 2, '1', '1'),
(11, 3, 3, '1', '1'),
(12, 4, 4, '1', '1'),
(13, 11, 11, '1', '1'),
(14, 10, 10, '1', '1'),
(15, 10, 20, '1', '1'),
(16, 9, 16, '1', '1'),
(17, 10, 21, '1', '1'),
(18, 10, 11, '1', '1'),
(19, 12, 10, '1', '1');



-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `MODULO`
--
INSERT INTO `modulo` (`mod_id`, `apl_id`, `mod_nombre`, `mod_tipo`, `mod_dir_imagen`, `mod_url`, `mod_orden`, `mod_lang_file`, `mod_estado_visible`, `mod_estado`, `mod_estado_logico`) VALUES
(1, 1, 'Ficha Datos', 'Ficha Datos', 'glyphicon glyphicon-list-alt', 'ficha/createins', 1, NULL, '1', '1', '1'),
(2, 1, 'Interesados', 'Interesados', 'glyphicon glyphicon-user', 'interesado/listarinteresados', 2, NULL, '1', '1', '1'),
(3, 1, 'Solicitudes', 'Solicitudes', 'glyphicon glyphicon-file', 'solicitudinscripcion/listarsolpendiente', 3, NULL, '1', '1', '1'),
(4, 1, 'Pagos', 'Pagos', ' glyphicon glyphicon-usd', 'registrarpago/listarpagosolicitudadm', 4, NULL, '1', '1', '1'),
(5, 1, 'Configuraciones', 'Configuraciones', 'glyphicon glyphicon-cog', 'asignacionejecutivo/listarasignacion', 6, NULL, '1', '1', '1'),
(6, 1, 'Aspirantes', 'Aspirantes', 'glyphicon glyphicon-education', 'aspirante/listaraspirantes', 5, NULL, '1', '1', '1'),
(7, 1, 'Académico', 'Académico', 'glyphicon glyphicon-user', 'administracioncurso/crea_periodocurso', 7, NULL, '1', '1', '1'),
(8, 1, 'Perfil', 'Perfil', 'glyphicon glyphicon-user', 'perfil/update', 8, NULL, '1', '1','1'),
(9, 1, 'Admisiones', 'Admisiones', 'glyphicon glyphicon-folder-open', 'admisiones/crearcontacto', 9, NULL,'1', '1','1');

-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `OBJETO_MODULO`
--
INSERT INTO `objeto_modulo` (`omod_id`, `mod_id`, `omod_padre_id`, `omod_nombre`, `omod_tipo`, `omod_tipo_boton`, `omod_accion`, `omod_function`, `omod_dir_imagen`, `omod_entidad`, `omod_orden`, `omod_estado_visible`, `omod_lang_file`, `omod_estado`, `omod_estado_logico`) VALUES
(1, 1, 1, 'Crear Ficha Datos', 'S', '0', 'Crear Ficha Datos', '', '', 'ficha/createins', 1, '1', NULL, '1', '1'),
(2, 1, 2, 'Ver Ficha Datos', 'S', '0', 'Ver Ficha Datos', '', '', 'ficha/view', 1, '1', NULL, '1', '1'),
(3, 2, 3, 'Interesados', 'S', '0', 'Interesados', '', '', 'interesado/listarinteresados', 1, '1', NULL, '1', '1'),
(4, 3, 4, 'Solicitudes Pre-aprobadas', 'S', '0', 'Solicitudes', '', '', 'solicitudinscripcion/listarsolprepapro', 1, '1', NULL, '1', '1'),
(5, 3, 5, 'Solicitudes Pendientes', 'S', '0', 'Solicitudes', '', '', 'solicitudinscripcion/listarsolpendiente', 1, '1', NULL, '1', '1'),
(6, 3, 6, 'Solicitudes', 'S', '0', 'Consulta Solicitudes', '', '', 'solicitudinscripcion/listarsolicitudxinteresado', 1, '1', NULL, '1', '1'),
(7, 3, 7, 'Crear Solicitud Inscripción', 'S', '0', 'Solicitud', '', 'nuevo.png', 'solicitudinscripcion/create', 1, '1', NULL, '1', '1'),
(8, 4, 8, 'Listar Pagos', 'S', '0', 'Listar Pagos', '', 'nuevo.png', 'registrarpago/listarpagosolicitudadm', 1, '1', NULL, '1', '1'),
(9, 4, 9, 'Control Pagos', 'S', '0', 'Control Pagos', '', 'nuevo.png', 'registrarpago/listarpagosolicitud', 2, '1', NULL, '1', '1'),
(10, 4, 10, 'Registrar Pagos por Colecturía', 'S', '0', 'Registrar Pagos por Colecturía', '', 'nuevo.png', 'registrarpago/listarpagosolicitudregistroadm', 3, '1', NULL, '1', '1'),
(11, 5, 11, 'Asignar Agente', 'S', '0', 'AsignarEjecutivo', '', 'nuevo.png', 'asignacionejecutivo/listarasignacion', 1, '1', NULL, '1', '1'),
(12, 6, 12, 'Aspirantes', 'S', '0', 'ListarAspirantes', '', 'nuevo.png', 'aspirante/listaraspirantes', 1, '1', NULL, '1', '1'),
(13, 3, 13, 'Solicitudes Aprobadas', 'S', '0', 'Solicitudes Aprobadas', '', '', 'solicitudinscripcion/listarsolaprobada', 1, '1', NULL, '1', '1'),
(14, 2, 14, 'Pre-Interesados', 'S', '0', 'Pre-Interesados', '', '', 'interesado/listarpreinteresados', 1, '1', NULL, '0', '1'),
(15, 4, 15, 'Pagos Cargados por Estudiante', 'S', '0', 'Pagos Cargados por Estudiante', '', 'nuevo.png', 'registrarpago/listarpagoscargados', 3, '1', NULL, '1', '1'),
(16, 1, 16, 'Actualizar Ficha Datos', 'S', '0', 'Actualizar Ficha Datos', '', '', 'ficha/update', 2, '1', NULL, '1', '1'),
(17, 7, 17, 'Período Método Ingreso', 'S', '0', 'Período Método Ingreso', '', 'nuevo.png', 'administracioncurso/crea_periodocurso', 1, '1', NULL, '1', '1'),
(18, 8, 18, 'Actualizar Perfil', 'S', '0', 'Actualizar Perfil', '', '', 'perfil/update', 1, '1', NULL, '1',  '1'),
(19, 7, 19, 'Listar Período Método Ingreso', 'S', '0', 'Listar Período Método Ingreso', '', '', 'administracioncurso/listarperiodoscan', 1, '1', NULL, '1',  '1'),
(20, 9, 20, 'Crear Contacto', 'S', '0', 'Crear Contacto', '', '', 'admisiones/crearcontacto', 1, '1', NULL, '1', '1'),
(21, 9, 21, 'Listar Contactos', 'S', '0', 'Listar Contactos', '', '', 'admisiones/listarcontactos', 2, '1', NULL, '1', '1'),
(22, 9, 22, 'Listar Oportunidades', 'S', '0', 'Listar Oportunidad Venta', '', '', 'admisiones/listaroportunidades', 3, '1', NULL, '1', '1'),
(23, 9, 23, 'Listar Contactos Pendientes', 'S', '0', 'Listar Contactos Pendientes','', '',  'admisiones/listarcontactospendientes', 4, '1', Null,'0', '1'),
(24, 3, 24, 'Solicitudes ULINK', 'S', '0', 'Solicitudes ULINK','', '',  'solicitudinscripcion/create1', 4, '1', Null,'0', '1'),
(25, 3, 25, 'Ver Contacto', 'S', '0', 'Ver Contact','', '',  'admisiones/view', 5, '1', Null,'1', '1'),
(26, 5, 26, 'Grupos y Permisos', 'P', '0', '', '', '', '', 1, '1', 'grupo', '1', '1'),
(27, 5, 26, 'Grupo', 'S', '0', '', '', '', 'grupo/index', 1, '1', 'grupo', '1', '1'),
(28, 5, 27, 'Crear Grupo', 'S', '0', '', '', '', 'grupo/new', 1, '0', 'grupo', '1', '1'),
(29, 5, 27, 'Crear Grupo', 'A', '0', '', '', '', '', 1, '1', 'grupo', '1', '1'),
(30, 5, 28, 'Guardar Grupo', 'A', '0', '', '', '', '', 1, '1', 'grupo', '1', '1'),
(31, 5, 27, 'Ver Grupo', 'S', '0', '', '', '', 'grupo/view', 1, '0', 'grupo', '1', '1'),
(32, 5, 31, 'Editar Grupo', 'A', '0', '', '', '', '', 1, '1', 'grupo', '1', '1'),
(33, 5, 27, 'Editar Grupo', 'S', '0', '', '', '', 'grupo/edit', 1, '0', 'grupo', '1', '1'),
(34, 5, 33, 'Update Grupo', 'A', '0', '', '', '', '', 1, '1', 'grupo', '1', '1'),
(35, 5, 26, 'Rol', 'S', '0', '', '', '', 'rol/index', 2, '1', 'rol', '1', '1'),
(36, 5, 35, 'Crear Rol', 'S', '0', '', '', '', 'rol/new', 1, '0', 'rol', '1', '1'),
(37, 5, 35, 'Crear Rol', 'A', '0', '', '', '', '', 1, '1', 'rol', '1', '1'),
(38, 5, 36, 'Guardar Rol', 'A', '0', '', '', '', '', 1, '1', 'rol', '1', '1'),
(39, 5, 35, 'Ver Rol', 'S', '0', '', '', '', 'rol/view', 1, '0', 'rol', '1', '1'),
(40, 5, 35, 'Editar Rol', 'S', '0', '', '', '', 'rol/edit', 1, '0', 'rol', '1', '1'),
(41, 5, 39, 'Editar Rol', 'A', '0', '', '', '', 'rol/edit', 1, '1', 'rol', '1', '1'),
(42, 5, 40, 'Update Rol', 'A', '0', '', '', '', '', 1, '1', 'rol', '1', '1'),
(43, 5, 26, 'Permisos', 'S', '0', '', '', '', 'permisos/index', 3, '1', 'grupo', '1', '1'),
(44, 5, 43, 'Crear Permiso', 'S', '0', '', '', '', 'permisos/new', 1, '0', 'grupo', '1', '1'),
(45, 5, 43, 'Crear Permiso', 'A', '0', '', '', '', '', 1, '1', 'grupo', '1', '1'),
(46, 5, 44, 'Guardar Permiso', 'A', '0', '', '', '', '', 1, '1', 'grupo', '1', '1'),
(47, 5, 43, 'Ver Permiso', 'S', '0', '', '', '', 'permisos/view', 1, '0', 'grupo', '1', '1'),
(48, 5, 43, 'Editar Permiso', 'S', '0', '', '', '', 'permisos/edit', 1, '0', 'grupo', '1', '1'),
(49, 5, 47, 'Editar Permiso', 'A', '0', '', '', '', '', 1, '1', 'grupo', '1', '1'),
(50, 5, 48, 'Update Permiso', 'A', '0', '', '', '', '', 1, '1', 'grupo', '1', '1'),
(51, 5, 26, 'Acciones', 'S', '0', '', '', '', 'acciones/index', 4, '1', 'accion', '1', '1'),
(52, 5, 51, 'Crear Accion', 'S', '0', '', '', '', 'acciones/new', 1, '0', 'accion', '1', '1'),
(53, 5, 51, 'Crear Accion', 'A', '0', '', '', '', '', 1, '1', 'accion', '1', '1'),
(54, 5, 52, 'Guardar Accion', 'A', '0', '', '', '', '', 1, '1', 'accion', '1', '1'),
(55, 5, 51, 'Ver Accion', 'S', '0', '', '', '', 'acciones/view', 1, '0', 'accion', '1', '1'),
(56, 5, 51, 'Editar Accion', 'S', '0', '', '', '', 'acciones/edit', 1, '0', 'accion', '1', '1'),
(57, 5, 55, 'Editar Accion', 'A', '0', '', '', '', '', 1, '1', 'accion', '1', '1'),
(58, 5, 56, 'Update Accion', 'A', '0', '', '', '', '', 1, '1', 'accion', '1', '1'),
(59, 5, 59, 'Modulos y SubModulos', 'P', '0', '', '', '', '', 3, '1', 'modulo', '1', '1'),
(60, 5, 59, 'Modulos', 'S', '0', '', '', '', 'modulos/index', 1, '1', 'modulo', '1', '1'),
(61, 5, 60, 'Crear Modulo', 'S', '0', '', '', '', 'modulos/new', 1, '0', 'modulo', '1', '1'),
(62, 5, 60, 'Crear Modulo', 'A', '0', '', '', '', '', 1, '1', 'modulo', '1', '1'),
(63, 5, 61, 'Guardar Modulo', 'A', '0', '', '', '', '', 1, '1', 'modulo', '1', '1'),
(64, 5, 60, 'Ver Modulo', 'S', '0', '', '', '', 'modulos/view', 1, '0', 'modulo', '1', '1'),
(65, 5, 60, 'Editar Modulo', 'S', '0', '', '', '', 'modulos/edit', 1, '0', 'modulo', '1', '1'),
(66, 5, 64, 'Editar Modulo', 'A', '0', '', '', '', '', 1, '1', 'modulo', '1', '1'),
(67, 5, 65, 'Update Modulo', 'A', '0', '', '', '', '', 1, '1', 'modulo', '1', '1'),
(68, 5, 59, 'SubModulos', 'S', '0', '', '', '', 'objetomodulos/index', 2, '1', 'objetomodulo', '1', '1'),
(69, 5, 68, 'Crear SubModulo', 'S', '0', '', '', '', 'objetomodulos/new', 1, '0', 'objetomodulo', '1', '1'),
(70, 5, 68, 'Crear SubModulo', 'A', '0', '', '', '', '', 1, '1', 'objetomodulo', '1', '1'),
(71, 5, 69, 'Guardar SubModulo', 'A', '0', '', '', '', '', 1, '1', 'objetomodulo', '1', '1'),
(72, 5, 68, 'Ver SubModulo', 'S', '0', '', '', '', 'objetomodulos/view', 1, '0', 'objetomodulo', '1', '1'),
(73, 5, 68, 'Editar Submodulo', 'S', '0', '', '', '', 'objetomodulos/edit', 1, '0', 'objetomodulo', '1', '1'),
(74, 5, 72, 'Editar SubModulo', 'A', '0', '', '', '', '', 1, '1', 'objetomodulo', '1', '1'),
(75, 5, 73, 'Update SubModulo', 'A', '0', '', '', '', '', 1, '1', 'objetomodulo', '1', '1'),
(76, 5, 27, 'Eliminar Grupo', 'S', '0', '', '', '', 'grupo/delete', 1, '0', 'grupo', '1', '1'),
(77, 5, 35, 'Eliminar Rol', 'S', '0', '', '', '', 'rol/delete', 1, '0', 'rol', '1', '1'),
(78, 5, 51, 'Eliminar Accion', 'S', '0', '', '', '', 'acciones/delete', 1, '0', 'accion', '1', '1'),
(79, 5, 43, 'Eliminar Permiso', 'S', '0', '', '', '', 'permisos/delete', 1, '0', 'grupo', '1', '1'),
(80, 5, 60, 'Eliminar Modulo', 'S', '0', '', '', '', 'modulos/delete', 1, '0', 'modulo', '1', '1'),
(81, 5, 68, 'Eliminar SubModulo', 'S', '0', '', '', '', 'objetomodulos/delete', 1, '0', 'objetomodulo', '1', '1');

-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `OBMO_ACCI`
--
INSERT INTO `obmo_acci` (`oacc_id`, `omod_id`, `acc_id`, `oacc_tipo_boton`, `oacc_cont_accion`, `oacc_function`, `oacc_estado`, `oacc_estado_logico`) VALUES
(1, 1, 1, '5', NULL, 'guardarA()', '1', '1'),
(2, 29, 1, '0', 'grupo/new', '', '1', '1'),
(3, 30, 4, '1', '', 'save', '1', '1'),
(4, 32, 12, '1', '', 'edit', '1', '1'),
(5, 34, 2, '1', '', 'update', '1', '1'),
(6, 37, 1, '0', 'rol/new', '', '1', '1'),
(7, 38, 4, '1', '', 'save', '1', '1'),
(8, 41, 12, '1', '', 'edit', '1', '1'),
(9, 42, 4, '1', '', 'update', '1', '1'),
(10, 45, 1, '0', 'permisos/new', '', '1', '1'),
(11, 46, 4, '1', '', 'save', '1', '1'),
(12, 49, 12, '1', '', 'edit', '1', '1'),
(13, 50, 4, '1', '', 'update', '1', '1'),
(14, 53, 1, '0', 'acciones/new', '', '1', '1'),
(15, 54, 4, '1', '', 'save', '1', '1'),
(16, 57, 12, '1', '', 'edit', '1', '1'),
(17, 58, 4, '1', '', 'update', '1', '1'),
(18, 62, 1, '0', 'modulos/new', '', '1', '1'),
(19, 63, 4, '1', '', 'save', '1', '1'),
(20, 66, 12, '1', '', 'edit', '1', '1'),
(21, 67, 4, '1', '', 'update', '1', '1'),
(22, 70, 1, '0', 'objetomodulos/new', '', '1', '1'),
(23, 71, 4, '1', '', 'save', '1', '1'),
(24, 74, 12, '1', '', 'edit', '1', '1'),
(25, 75, 4, '1', '', 'update', '1', '1');
-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `grup_obmo`
--
INSERT INTO `grup_obmo` (`gmod_id`, `gru_id`, `omod_id`, `gmod_estado`,  `gmod_estado_logico`) VALUES
(1, 1, 1, '1', '1'),
(2, 1, 2, '1', '1'),
(3, 1, 3, '1', '1'),
(4, 1, 4, '1', '1'),
(5, 1, 5, '1', '1'),
(6, 1, 6, '1', '1'),
(7, 1, 7, '1', '1'),
(8, 1, 8, '1', '1'),
(9, 1, 9, '1', '1'),
(10, 1, 10, '1', '1'),
(11, 1, 11, '1', '1'),
(12, 1, 12, '1', '1'),
(13, 2, 1, '1', '1'),
(14, 3, 6, '1', '1'),
(15, 3, 7, '1', '1'),
(16, 3, 9, '1', '1'),
(17, 4, 6, '1', '1'),
(18, 4, 7, '1', '1'),
(19, 4, 9, '1', '1'),
(20, 8, 3, '1', '1'),
(21, 8, 4, '1', '1'),
(22, 8, 5, '1', '1'),
(23, 8, 11, '1', '1'),
(24, 8, 12, '1', '1'),
(25, 3, 2, '1', '1'),
(26, 4, 2, '1', '1'),
(27, 9, 8, '1', '1'),
(28, 9, 10, '1', '1'),
(29, 11, 1, '1', '1'),
(30, 10, 3, '1',  '1'),
(31, 10, 12, '1', '1'),
(32, 8, 13, '1',  '1'),
(33, 8, 14, '0',  '1'),
(34, 1, 14, '0', '1'),
(35, 10, 12, '1',  '1'),
(36, 9, 15, '1',  '1'),
(37, 1, 15, '1', '1'),
(38, 3, 16, '1',  '1'),
(39, 1, 16, '1', '1'),
(40, 1, 17, '1',  '1'),
(41, 10, 17, '1',  '1'),
(42, 10, 3, '1', '1'),
(43, 1, 18, '1',  '1'),
(44, 8, 18, '1', '1'),
(45, 9, 18, '1', '1'),
(46, 10, 18, '1',  '1'),
(47, 8, 8, '1', '1'),
(48, 8, 10, '1', '1'),
(49, 8, 15, '1', '1'),
(50, 10, 8, '1',  '1'),
(51, 10, 10, '1', '1'),
(52, 10, 15, '1',  '1'),
(53, 10, 4, '1',  '1'),
(54, 10, 5, '1',  '1'),
(55, 10, 11, '1',  '1'),
(56, 10, 13, '1',  '1'),
(57, 10, 14, '1',  '1'),
(58, 1, 19, '1',  '1'),
(59, 10, 19, '1', '1'),
(60, 1, 20, '1', '1'),
(61, 1, 21, '1', '1'),
(62, 1, 22, '1', '1'),
(63, 1, 23, '1', '1'),
(64, 1, 13, '1', '1'),
(65, 1, 25, '1', '1'),
(66, 1, 26, '1', '1'),
(67, 1, 27, '1', '1'),
(68, 1, 28, '1', '1'),
(69, 1, 29, '1', '1'),
(70, 1, 30, '1', '1'),
(71, 1, 31, '1', '1'),
(72, 1, 32, '1', '1'),
(73, 1, 33, '1', '1'),
(74, 1, 34, '1', '1'),
(75, 1, 35, '1', '1'),
(76, 1, 36, '1', '1'),
(77, 1, 37, '1', '1'),
(78, 1, 38, '1', '1'),
(79, 1, 39, '1', '1'),
(80, 1, 40, '1', '1'),
(81, 1, 41, '1', '1'),
(82, 1, 42, '1', '1'),
(83, 1, 43, '1', '1'),
(84, 1, 44, '1', '1'),
(85, 1, 45, '1', '1'),
(86, 1, 46, '1', '1'),
(87, 1, 47, '1', '1'),
(88, 1, 48, '1', '1'),
(89, 1, 49, '1', '1'),
(90, 1, 50, '1', '1'),
(91, 1, 51, '1', '1'),
(92, 1, 52, '1', '1'),
(93, 1, 53, '1', '1'),
(94, 1, 54, '1', '1'),
(95, 1, 55, '1', '1'),
(96, 1, 56, '1', '1'),
(97, 1, 57, '1', '1'),
(98, 1, 58, '1', '1'),
(99, 1, 59, '1', '1'),
(100, 1, 60, '1', '1'),
(101, 1, 61, '1', '1'),
(102, 1, 62, '1', '1'),
(103, 1, 63, '1', '1'),
(104, 1, 64, '1', '1'),
(105, 1, 65, '1', '1'),
(106, 1, 66, '1', '1'),
(107, 1, 67, '1', '1'),
(108, 1, 68, '1', '1'),
(109, 1, 69, '1', '1'),
(110, 1, 70, '1', '1'),
(111, 1, 71, '1', '1'),
(112, 1, 72, '1', '1'),
(113, 1, 73, '1', '1'),
(114, 1, 74, '1', '1'),
(115, 1, 75, '1', '1'),
(116, 1, 76, '1', '1'),
(117, 1, 77, '1', '1'),
(118, 1, 78, '1', '1'),
(119, 1, 79, '1', '1'),
(120, 1, 80, '1', '1'),
(121, 1, 81, '1', '1'),
/* Agregado */
(122, 8, 20, '1', '1'), 
(123, 8, 21, '1', '1'), 
(124, 8, 22, '1', '1'), 
(125, 10, 20, '1', '1'), 
(126, 10, 21, '1', '1'), 
(127, 10, 22, '1', '1'), 
(128, 12, 20, '1', '1'), 
(129, 12, 21, '1', '1'), 
(130, 12, 22, '1', '1');
-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `GRUP_OBMO_GRUP_ROL`
--
INSERT INTO `grup_obmo_grup_rol` (`gogr_id`, `grol_id`, `gmod_id`, `gogr_estado`, `gogr_estado_logico`) VALUES
(1, 1, 1, '1', '1'),
(2, 1, 2, '1', '1'),
(3, 1, 3, '1', '1'),
(4, 1, 4, '1', '1'),
(5, 1, 5, '1', '1'),
(6, 1, 6, '1', '1'),
(7, 1, 7, '1', '1'),
(8, 1, 8, '1', '1'),
(9, 1, 9, '1', '1'),
(10, 1, 10, '1', '1'),
(11, 1, 11, '1', '1'),
(12, 1, 12, '1', '1'),
(13, 10, 13, '1', '1'),
(14, 11, 14, '1', '1'),
(15, 11, 15, '1', '1'),
(16, 11, 16, '1', '1'),
(17, 12, 17, '1', '1'),
(18, 12, 18, '1', '1'),
(19, 12, 19, '1', '1'),
(20, 5, 20, '1', '1'),
(21, 5, 21, '1', '1'),
(22, 5, 22, '1', '1'),
(23, 5, 23, '1', '1'),
(24, 5, 24, '1', '1'),
(25, 6, 20, '1', '1'),
(26, 6, 21, '1', '1'),
(27, 6, 22, '0', '1'),
(28, 6, 23, '1', '1'),
(29, 6, 24, '1', '1'),
(31, 7, 20, '1', '1'),
(32, 7, 22, '1', '1'),
(33, 7, 23, '1', '1'),
(34, 7, 24, '1', '1'),
(35, 8, 20, '1', '1'),
(36, 8, 22, '1', '1'),
(37, 8, 24, '1', '1'),
(38, 11, 25, '1', '1'),
(39, 12, 25, '1', '1'),
(40, 9, 27, '1', '1'),
(41, 9, 28, '1', '1'),
(42, 13, 29, '1', '1'),
(43, 14, 30, '1', '1'),
(44, 14, 31, '1', '1'),
(45, 5, 32, '1', '1'),
(46, 1, 32, '1', '1'),
(47, 6, 32, '1', '1'),
(48, 5, 33, '1',  '1'),
(49, 6, 33, '1',  '1'),
(50, 7, 33, '1',  '1'),
(51, 8, 33, '1',  '1'),
(52, 1, 33, '1',  '1'),
(53, 15, 35, '1', '1'),
(54, 9, 36, '1',  '1'),
(55, 1, 37, '1', '1'),
(56, 11, 38, '1',  '1'),
(57, 1, 39, '1',  '1'),
(58, 1, 40, '1',  '1'),
(59, 15, 41, '1',  '1'),
(60, 15, 42, '1',  '1'),
(61, 16, 27, '1',  '1'),
(62, 16, 28, '1',  '1'),
(63, 16, 36, '1',  '1'),
(64, 1, 43, '1',  '1'),
(65, 5, 44, '1',  '1'),
(66, 6, 44, '1',  '1'),
(67, 7, 44, '1',  '1'),
(68, 8, 44, '1',  '1'),
(69, 9, 45, '1',  '1'),
(70, 16, 45, '1',  '1'),
(71, 14, 46, '1',  '1'),
(72, 15, 46, '1',  '1'),
(73, 5, 47, '1', '1'),
(74, 5, 48, '1', '1'),
(75, 5, 49, '1', '1'),
(76, 6, 47, '1', '1'),
(77, 6, 48, '1', '1'),
(78, 6, 49, '1', '1'),
(79, 7, 47, '1', '1'),
(80, 7, 48, '1', '1'),
(81, 7, 49, '1', '1'),
(82, 8, 47, '1', '1'),
(83, 8, 48, '1', '1'),
(84, 8, 49, '1', '1'),
(85, 15, 50, '1', '1'),
(86, 15, 51, '1', '1'),
(87, 15, 52, '1', '1'),
(88, 17, 12, '1',  '1'),
(89, 14, 53, '1',  '1'),
(90, 15, 56, '1',  '1'),
(91, 14, 57, '1',  '1'),
(92, 14, 56, '1',  '1'),
(93, 18, 35, '1', '1'),
(94, 18, 42, '1',  '1'),
(95, 18, 46, '1', '1'),
(96, 18, 57, '1', '1'),
(97, 18, 53, '1',  '1'),
(98, 18, 54, '1',  '1'),
(99, 18, 55, '1', '1'),
(100, 18, 56, '1',  '1'),
(101, 15, 57, '1',  '1'),
(102, 15, 54, '1', '1'),
(103, 15, 55, '1',  '1'),
(104, 1, 58, '1',  '1'),
(105, 15, 59, '1', '1'),
(106, 14, 55, '1', '1'),
(107, 1, 60, '1',  '1'),
(108, 1, 61, '1', '1'),
(109, 1, 62, '1', '1'),
(110, 1, 63, '1', '1'),
(111, 1, 64, '1', '1'),
(112, 1, 34, '1', '1'),
(113, 1, 65, '1', '1'),
(114, 1, 66, '1', '1'),
(115, 1, 67, '1', '1'),
(116, 1, 68, '1', '1'),
(117, 1, 69, '1', '1'),
(118, 1, 70, '1', '1'),
(119, 1, 71, '1', '1'),
(120, 1, 72, '1', '1'),
(121, 1, 73, '1', '1'),
(122, 1, 74, '1', '1'),
(123, 1, 75, '1', '1'),
(124, 1, 76, '1', '1'),
(125, 1, 77, '1', '1'),
(126, 1, 78, '1', '1'),
(127, 1, 79, '1', '1'),
(128, 1, 80, '1', '1'),
(129, 1, 81, '1', '1'),
(130, 1, 82, '1', '1'),
(131, 1, 83, '1', '1'),
(132, 1, 84, '1', '1'),
(133, 1, 85, '1', '1'),
(134, 1, 86, '1', '1'),
(135, 1, 87, '1', '1'),
(136, 1, 88, '1', '1'),
(137, 1, 89, '1', '1'),
(138, 1, 90, '1', '1'),
(139, 1, 91, '1', '1'),
(140, 1, 92, '1', '1'),
(141, 1, 93, '1', '1'),
(142, 1, 94, '1', '1'),
(143, 1, 95, '1', '1'),
(144, 1, 96, '1', '1'),
(145, 1, 97, '1', '1'),
(146, 1, 98, '1', '1'),
(147, 1, 99, '1', '1'),
(148, 1, 100, '1', '1'),
(149, 1, 101, '1', '1'),
(150, 1, 102, '1', '1'),
(151, 1, 103, '1', '1'),
(152, 1, 104, '1', '1'),
(153, 1, 105, '1', '1'),
(154, 1, 106, '1', '1'),
(155, 1, 107, '1', '1'),
(156, 1, 108, '1', '1'),
(157, 1, 109, '1', '1'),
(158, 1, 110, '1', '1'),
(159, 1, 111, '1', '1'),
(160, 1, 112, '1', '1'),
(161, 1, 113, '1', '1'),
(162, 1, 114, '1', '1'),
(163, 1, 115, '1', '1'),
(164, 1, 116, '1', '1'),
(165, 1, 117, '1', '1'),
(166, 1, 118, '1', '1'),
(167, 1, 119, '1', '1'),
(168, 1, 120, '1', '1'),
(169, 1, 121, '1', '1'),
/* Agregado */
(170, 6, 122, '1', '1'),
(171, 6, 123, '1', '1'),
(172, 6, 124, '1', '1'),
(173, 7, 122, '1', '1'),
(174, 7, 123, '1', '1'),
(175, 7, 124, '1', '1'),
(176, 14, 125, '1', '1'),
(177, 14, 126, '1', '1'),
(178, 14, 127, '1', '1'),
(179, 18, 125, '1', '1'),
(180, 18, 126, '1', '1'),
(181, 18, 127, '1', '1'),
(182, 19, 128, '1', '1'),
(183, 19, 129, '1', '1'),
(184, 19, 130, '1', '1'),
(185, 8, 122, '1', '1'),
(186, 8, 123, '1', '1'),
(187, 8, 124, '1', '1');

-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `GRUP_OBMO_GRUP_ROL_OBMO_ACCI`
--
INSERT INTO `grup_obmo_grup_rol_obmo_acci` (`ggoa_id`, `gogr_id`, `oacc_id`, `ggoa_estado`, `ggoa_estado_logico`) VALUES
(1, 1, 1, '1', '1');


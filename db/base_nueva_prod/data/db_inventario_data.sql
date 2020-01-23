--
-- Base de datos: `db_inventario`
--
USE `db_inventario`;

INSERT INTO db_inventario.`edificio` (`edi_id`, `edi_descripcion`, `edi_estado`, `edi_estado_logico`) VALUES
(1, 'Edificio 610', '1', '1'),
(2, 'Edificio 520', '1', '1'),
(3, 'Edificio 501', '1', '1'),
(4, 'Edificio Posgrado', '1', '1'),
(5, 'Bloque Rectoral', '1', '1'),
(6, 'Casa Corporativa', '1', '1');

INSERT INTO db_inventario.`departamento` (`dep_id`, `dep_nombre`, `dep_estado`, `dep_usuario_ingreso`, `dep_estado_logico`) VALUES
(1, 'Administrativo', '1', 1, '1'),
(2, 'Biblioteca', '1', 1, '1'),
(3, 'Bienestar Universitario', '1', 1, '1'),
(4, 'Financiero', '1', 1, '1'),
(5, 'Grado', '1', 1, '1'),
(6, 'Innovación y Servicios', '1', 1, '1'),
(7, 'Investigaciones', '1', 1, '1'),
(8, 'Online', '1', 1, '1'),
(9, 'Planificación', '1', 1, '1'),
(10, 'Posgrado', '1', 1, '1'),
(11, 'Producción', '1', 1, '1'),
(12, 'Rectorado', '1', 1, '1'),
(13, 'Relaciones Internacionales', '1', 1, '1'),
(14, 'Secretaría General', '1', 1, '1'),
(15, 'Talento Humano', '1', 1, '1'),
(16, 'Vicerrectorado', '1', 1, '1'),
(17, 'Vinculación', '1', 1, '1'),
(18, 'Centro de Idiomas', '1', 1, '1'),
(19, 'Dirección Ejecutiva', '1', 1, '1'),
(20, 'Canciller', '1', 1, '1'),
(21, 'Compras', '1', 1, '1');


INSERT INTO db_inventario.`area` (`are_id`, `dep_id`, `edi_id`, `are_descripcion`, `are_estado`, `are_estado_logico`) VALUES 
(1, 1,1,	'Administrativo',
(2, 1	2	Recepción
(3, 1	2	Seguridad
(4, 2	1	Biblioteca
(5, 3	1	Departamento Médico
(6, 3	1	Bienestar Universitario
(7, 4	1	Lactancia
(8, 4	3	Tesorería
(9, 4	3	Contabilidad
(10, 4	2	Colecturía
(11, 5	2	Grado Presencial
(12, 5	2	Grado Semipresencial
(13, 6	2	Admisiones Grado
(14, 6	4	Admisiones 4
(15, 6	2	Desarrollo
(16, 6	2	Sistemas - Infraestructura Tecnológica
(17, 6	5	Procesos
(18, 6	3	Gestión Documental
(19, 7	4	Investigaciones
(20, 8	3	Online
(21, 9	5	Planificación
(22, 10	4	Posgrado
(23, 11	3	Producción
(24, 12	5	Rectorado
(25, 13	2	Relaciones Internacionales
(26, 14	3	Secretarìa General
(27, 15	6	Talento Humano
(28, 16	5	Vicerrectorado
(29, 17	2	Vinculación
(30, 5	2	Lab. 1
(31, 5	2	Lab. 2
(32, 5	2	Lab. 3
(33, 5	2	Lab. 4
(34, 5	2	Lab.Telcom
(35, 5	1	Lab. Electrónica
(36, 5	1	Lab. Física
(37, 5	2	Aula 100
(38, 5	2	Aula 302
(39, 5	2	Aula 400
(40, 5	2	Aula 401
(41, 5	2	Aula 402
(42, 5	2	Aula 500
(43, 5	2	Aula 3
(44, 5	2	Aula 502
(45, 5	2	Aula 503
(46, 5	2	Aula 505
(47, 5	2	Aula 506
(48, 5	2	Aula 507
(49, 5	2	Aula 508
(50, 5	2	Aula 509
(51, 5	2	Aula 700
(52, 5	2	Aula 703
(53, 5	2	Aula 704
(54, 5	1	Auditorio
(55, 10	4	Aula 001
(56, 10	4	Aula 003
(57, 10	4	Aula 004
(58, 5	2	Bar Uteg
(59, 5	2	Coordinación Grado
(60, 3	2	Cuidado infantil
(61, 5	2	Sala de Profesores
(62, 18	2	Centro de Idiomas
(63, 5	1	Area recreativa
(64, 10	4	Aula 002
(65, 10	4	Aula 005
(66,	10	4	Aula 006
(67,	10	4	Aula 007
(68,	10	4	Aula 008
(69,	10	4	Aula 009
(70,	10	4	Aula 010
(71,	10	4	Aula 011
(72,	10	4	Aula 012
(73,	10	4	Aula 013
(74,	10	4	Aula 014
(75,	10	4	Aula 015
(76,	6	3	Archivo
(77,	4	3	Bodega Financiero
(78,	10	4	Comedor
(79,	10	4	Coordinación 4
(80,	19	5	Dirección Ejecutiva
(81,	20	5	Canciller
(82,	12	5	Sala de reunión Rectorado
(83,	12	5	Sala de sesiones
(84,	12	5	Recepción Rectorado
(85,	21	5	Compras
(86,	10	4	Sala de reunión 4
(87,	10	4	Recepción 4
(88,	8	3	Recepción Online
(89	3	1	Centro de Copiado

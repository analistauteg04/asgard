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



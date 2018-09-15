--
-- Base de datos: `db_asgard`
--
USE `db_asgard`;

-- --------------------------------------------------------
--
-- Tabla `dash`
--
INSERT INTO `dash` (`dash_id`, `dash_title`, `dash_detail`, `dash_link`, `dash_target`, `dash_estado`, `dash_estado_logico`) VALUES
(1, 'Biblioteca Virtual', 'Permite a nuestros estudiantes acceder a los libros digitales desde cualquier lugar y en cualquier momento.', 'https://www.biblionline.pearson.com', '_blank', '1', '1'),
(2, 'Campus Virtual', 'Los programas que se ofertan bajo la modalidad Online para los distintos niveles de educación, son impartidos a través de la plataforma en internet “Campus Virtual UTEG”.', 'https://campusvirtual.uteg.edu.ec',  '_blank', '1','1'),
(3, 'Videos','Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.', '[[BASE_VIDEO]]', '', '1', '1'),
(4, 'Asgard System','Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.', '[[FIRST_MODULE]]', '', '1', '1');

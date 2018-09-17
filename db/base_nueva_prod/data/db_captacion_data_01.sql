--
-- Base de datos: `db_captacion_prueba`
--
USE `db_captacion`;

-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `nivel_interes`
-- 18/04/2018 grado online no exite se debe tomar grado y facultad va ser onxºline
-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `metodo_ingreso`
--
INSERT INTO `metodo_ingreso` (`ming_id`, `ming_nombre`, `ming_descripcion`, `ming_alias`, `ming_estado`, `ming_estado_logico`) VALUES
(1, 'Curso de admisión y nivelación', 'Curso de admisión y nivelación', 'CAN', '1', '1'),
(2, 'Examen de admisión', 'Examen de admisión', 'Examen', '1', '1'),
(3, 'Homologación', 'Homologación', 'Homologación', '1', '1'),
(4, 'Propedéutico', 'Propedéutico', 'Propedéutico', '1', '1');

-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `nivelint_metodo`
--
INSERT INTO `nivelint_metodo` (`nmet_id`, `uaca_id`, `ming_id`, `nmet_estado`, `nmet_estado_logico`) VALUES
(1, 1, 1, '1', '1'),
(2, 1, 2, '1', '1'),
(3, 2, 3, '1', '1'),
(4, 2, 4, '1', '1');

-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `documento_adjuntar`
--
INSERT INTO `documento_adjuntar` (`dadj_id`, `dadj_nombre`, `dadj_descripcion`, `dadj_estado`, `dadj_estado_logico`) VALUES
(1, 'Título', 'Título', '1', '1'),
(2, 'DNI', 'DNI', '1', '1'),
(3, 'Certificado de votación', 'Certificado de votación', '1', '1'),
(4, 'Foto', 'Foto', '1', '1'),
(5, 'Documento Beca', 'Documento Beca', '1', '1');

-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `dadj_nint_tciudadano`
--
INSERT INTO `doc_nint_tciudadano` (`dntc_id`, `tciu_id`, `uaca_id`, `dadj_id`, `dntc_estado`, `dntc_estado_logico`) VALUES
(1, 1, 1, 1, '1', '1'),
(2, 1, 1, 2, '1', '1'),
(3, 1, 1, 3, '1', '1'),
(4, 1, 1, 4, '1', '1'), 
(5, 1, 2, 1, '1', '1'),
(6, 1, 2, 2, '1', '1'),
(7, 1, 2, 3, '1', '1'),
(8, 1, 2, 4, '1', '1'), 
(9, 2, 1, 1, '1', '1'),
(10, 2, 1, 2, '1', '1'),
(11, 2, 1, 4, '1', '1'), 
(12, 2, 2, 1, '1', '1'),
(13, 2, 2, 2, '1', '1'),
(14, 2, 2, 4, '1', '1'),
(15, 1, 1, 5, '1', '1'),
(16, 1, 2, 5, '1', '1'),
(17, 2, 1, 5, '1', '1'),
(18, 2, 2, 5, '1', '1');

-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `res_sol_inscripcion`
-- 

INSERT INTO `res_sol_inscripcion` (`rsin_id`, `rsin_nombre`, `rsin_descripcion`,  `rsin_estado`, `rsin_estado_logico`) VALUES
(1, 'Pendiente', 'Pendiente', '1', '1'),
(2, 'Aprobado', 'Aprobado', '1', '1'),
(3, 'Pre Aprobado', 'Pre Aprobado', '1', '1'),
(4, 'No Aprobado', 'No Aprobado', '1', '1');

-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `medio_publicitario` 
--

INSERT INTO `medio_publicitario` (`mpub_id`, `mpub_nombre`, `mpub_descripcion`, `mpub_estado`,  `mpub_estado_logico`) VALUES
(1, 'Sitio web', 'Sitio web','1', '1'),
(2, 'Whatsapp', 'Whatsapp', '1', '1'),
(3, 'Charla','Charla', '1', '1'),
(4, 'Feria','Feria', '1', '1'),
(5, 'Eventos', 'Eventos','1', '1'),
(6, 'Visita a empresa', 'Visita a empresa','1', '1'),
(7, 'Valla', 'Valla', '1', '1'),
(8, 'Televisión', 'Televisión','1', '1'),
(9, 'Radio', 'Radio','1', '1'),
(10, 'Periódico', 'Periódico', '1', '1'),
(11, 'Revista','Revista', '1', '1'),
(12, 'Insertos en estados de cuenta', 'Insertos en estados de cuenta','1', '1'),
(13, 'SMS', 'SMS','1', '1'),
(14, 'Redes sociales', 'Redes sociales','1', '1');

-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `consideracion` 
--
INSERT INTO `consideracion` (`con_id`, `con_nombre`, `con_descripcion`, `con_estado`, `con_estado_logico`) VALUES
(1, 'Original escaneado a color (por ambos lados)', 'Original escaneado a color (por ambos lados)', '1', '1'),
(2, 'Refrendado en la parte posterior por el Ministerio de Educación del Ecuador', 'Refrendado en la parte posterior por el Ministerio de Educación del Ecuador', '1', '1'),
(3, 'Tamaño A4', 'Tamaño A4', '1', '1'),
(4, 'Legible', 'Legible', '1', '1'),
(5, 'Escaneado a color (por ambos lados)', 'Escaneado a color (por ambos lados)', '1', '1'),
(6, 'Vigente', 'Vigente', '1', '1'),
(7, 'Con fecha de último proceso electoral', 'Con fecha de último proceso electoral  ', '1', '1'),
(8, 'Tamaño carnet (283 x 378 pixeles)', 'Tamaño carnet (283 x 378 pixeles)', '1', '1'),
(9, 'Color', 'Color', '1', '1'),
(10, 'Actual', 'Actual', '1', '1'),
(11, 'Apostillado en la parte posterior', 'Apostillado en la parte posterior', '1', '1'),
(12, 'Escaneado a color (página de datos)', 'Escaneado a color (página de datos)', '1', '1'),
(13, 'Escaneado a color', 'Escaneado a color', '1', '1');

-- --------------------------------------------------------
--
-- Volcado de datos para la tabla `consideracion_documento` 
--
INSERT INTO `consideracion_documento` (`cdoc_id`, `con_id`, `dadj_id`, `cdoc_tiponacext`, `cdoc_estado`, `cdoc_estado_logico`) VALUES
(1, 1, 1, 'N', '1', '1'),
(2, 2, 1, 'N', '1', '1'),
(3, 3, 1, 'N', '1', '1'),
(4, 4, 1, 'N', '1', '1'),
(5, 5, 2, 'N', '1', '1'),
(6, 6, 2, 'N', '1', '1'),
(7, 4, 2, 'N', '1', '1'),
(8, 13, 3, 'N', '1', '1'),
(9, 7, 3, 'N', '1', '1'),
(10, 4, 3, 'N', '1', '1'),
(11, 8, 4, 'N', '1', '1'),
(12, 9, 4, 'N', '1', '1'),
(13, 10, 4, 'N', '1', '1'),
(14, 1, 1, 'E', '1', '1'),
(15, 3, 1, 'E', '1', '1'),
(16, 11, 1, 'E', '1', '1'),
(17, 4, 1, 'E', '1', '1'),
(18, 12, 2, 'E', '1', '1'),
(19, 6, 2, 'E', '1', '1'),
(20, 4, 2, 'E', '1', '1'),
(21, 8, 4, 'E', '1', '1'),
(22, 9, 4, 'E', '1', '1'),
(23, 10, 4, 'E', '1', '1');


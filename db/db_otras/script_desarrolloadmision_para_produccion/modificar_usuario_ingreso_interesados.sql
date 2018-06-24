/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * Author:  giovanni
 * Created: 06/04/2018
 */

--
-- Base de datos: `db_captacion`
--
USE `db_captacion` ;

UPDATE  `interesado` 
INNER JOIN  `pre_interesado`  ON pre_interesado.pint_id = interesado.pint_id
SET interesado.int_usuario_ingreso = pre_interesado.per_id
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * Author:  giovanni
 * Created: 05/04/2018
 */

--
-- Base de datos: `db_captacion`
--
USE `db_captacion` ;

alter table `interesado` 
add `int_usuario_ingreso` bigint(20) not null after `int_estado_interesado`,
add `int_usuario_modifica` bigint(20) null after `int_usuario_ingreso`;
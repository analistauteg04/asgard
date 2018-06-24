/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * Author:  giovanni
 * Created: 02/05/2018
 */

--
-- Base de datos: `db_asgard`
--
USE `db_asgard`;

alter table `persona_preins` 
add `ppre_tipo_formulario`  varchar(2) null after `can_id_trabajo`;
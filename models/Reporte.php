<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\models;

use yii;

/**
 * Description of Reporte
 *
 * @author root
 */
class Reporte extends \yii\db\ActiveRecord {

    //put your code here

    public function consultarActividadporOportunidad($data) {
        $con = \Yii::$app->db_crm;  //A.bact_id,B.opo_id,      
        $sql = "SELECT LPAD(B.opo_id,9,'0') opo_id,DATE(A.bact_fecha_registro) Fecha,G.emp_razon_social,
            CONCAT(C.pges_pri_nombre, ' ', ifnull(C.pges_seg_nombre,' ')) Nombres,
            CONCAT(C.pges_pri_apellido, ' ', ifnull(C.pges_seg_apellido,' ')) Apellidos, 
            H.uaca_nombre,F.eopo_nombre,E.oact_nombre,A.bact_descripcion 
                        FROM " . $con->dbname . ".bitacora_actividades A
                                INNER JOIN (" . $con->dbname . ".oportunidad B
                                                INNER JOIN " . $con->dbname . ".persona_gestion C
                                                        ON B.pges_id=C.pges_id
                                                INNER JOIN " . yii::$app->db_asgard->dbname . ".empresa G
							ON G.emp_id=B.emp_id
                                                INNER JOIN " . yii::$app->db_academico->dbname . ".unidad_academica H
                                                        ON H.uaca_id=B.uaca_id)
                                        ON A.opo_id=B.opo_id
                                INNER JOIN " . $con->dbname . ".observacion_actividades E						
                                                        ON E.oact_id=A.oact_id
                                INNER JOIN " . $con->dbname . ".estado_oportunidad F
                                                        ON F.eopo_id=A.eopo_id
                WHERE A.bact_estado=1  ";
        $sql .= ($data['f_ini'] <> '' && $data['f_fin'] <> '' ) ? "AND DATE(A.bact_fecha_registro) BETWEEN :f_ini AND :f_fin " : " ";
        $sql .= " ORDER BY A.bact_fecha_registro; "; //#AND B.opo_id=52;
        $comando = $con->createCommand($sql);
        //Utilities::putMessageLogFile($sql);
        if ($data['f_ini'] <> '' && $data['f_fin'] <> '') {
            $comando->bindParam(":f_ini", date("Y-m-d", strtotime($data['f_ini'])), \PDO::PARAM_STR);
            $comando->bindParam(":f_fin", date("Y-m-d", strtotime($data['f_fin'])), \PDO::PARAM_STR);
        }
        return $comando->queryAll();
    }

    public function consultarOportunidadProximaAten($data) {
        $con = \Yii::$app->db_crm;
        /* $sql = "SELECT LPAD(B.opo_id,9,'0') opo_id,DATE(A.bact_fecha_proxima_atencion) F_Prox_At,CONCAT(C.pges_pri_nombre) Nombres,F.eopo_nombre,E.oact_nombre,A.bact_descripcion 
          FROM " . $con->dbname . ".bitacora_actividades A
          INNER JOIN (" . $con->dbname . ".oportunidad B
          INNER JOIN " . $con->dbname . ".persona_gestion C
          ON B.pges_id=C.pges_id)
          ON A.opo_id=B.opo_id
          INNER JOIN " . $con->dbname . ".observacion_actividades E
          ON E.oact_id=A.oact_id
          INNER JOIN " . $con->dbname . ".estado_oportunidad F
          ON F.eopo_id=A.eopo_id
          WHERE A.bact_estado=1  "; */

        $sql = "SELECT LPAD(B.opo_id,9,'0') opo_id,DATE(A.bact_fecha_proxima_atencion) F_Prox_At,G.emp_razon_social,
            CONCAT(C.pges_pri_nombre, ' ', ifnull(C.pges_seg_nombre,' ')) Nombres,
            CONCAT(C.pges_pri_apellido, ' ', ifnull(C.pges_seg_apellido,' ')) Apellidos, 
            H.uaca_nombre,F.eopo_nombre,E.oact_nombre,A.bact_descripcion 
                        FROM " . $con->dbname . ".bitacora_actividades A
                                INNER JOIN (" . $con->dbname . ".oportunidad B
                                                INNER JOIN " . $con->dbname . ".persona_gestion C
                                                        ON B.pges_id=C.pges_id
                                                INNER JOIN " . yii::$app->db_asgard->dbname . ".empresa G
							ON G.emp_id=B.emp_id
                                                INNER JOIN " . yii::$app->db_academico->dbname . ".unidad_academica H
                                                        ON H.uaca_id=B.uaca_id)
                                        ON A.opo_id=B.opo_id
                                INNER JOIN " . $con->dbname . ".observacion_actividades E						
                                                        ON E.oact_id=A.oact_id
                                INNER JOIN " . $con->dbname . ".estado_oportunidad F
                                                        ON F.eopo_id=A.eopo_id
                WHERE A.bact_estado=1  ";

        $sql .= " AND DATE(A.bact_fecha_proxima_atencion) >= CURDATE() ";
        $sql .= " ORDER BY A.bact_fecha_proxima_atencion; ";
        $comando = $con->createCommand($sql);

        return $comando->queryAll();
    }

    public function consultarAspirantesPendientes($data) {
        $con = \Yii::$app->db_captacion;
        $con1 = \Yii::$app->db_asgard;
        $con2 = \Yii::$app->db_academico;
        $estado = 1;
        $sql = "
                    select 
                        ifnull(per.per_cedula,per.per_pasaporte) as DNI,                    
                        DATE(inte.int_fecha_creacion) as fecha_interes,
                        concat(ifnull(per.per_pri_nombre,''),' ',ifnull(per.per_seg_nombre,'')) as nombres,                    
                        concat(ifnull(per.per_pri_apellido,''),' ',ifnull(per.per_seg_apellido,'')) as apellidos,                    
                        emp.emp_nombre_comercial as empresa,                 
                        (
                            select count(sins.sins_id) as num_solicitudes
                            from db_captacion.interesado as inter
                            join db_captacion.solicitud_inscripcion as sins on sins.int_id=inter.int_id
                            where inter.int_id=inte.int_id
                            group by inter.int_id 
                        ) as num_solicitudes,
                        (
                            select count(sins.sins_id) as num_solicitudes
                            from db_captacion.interesado as inter
                            join db_captacion.solicitud_inscripcion as sins on sins.int_id=inter.int_id
                            join db_captacion.solicitudins_documento as sdoc on sdoc.sins_id=sins.sins_id
                            where inter.int_id=inte.int_id
                            group by inter.int_id 
                        ) as num_solicitudes,
                        (
                            select count(sdoc.sdoc_id) as num_documentos
                            from db_captacion.interesado as inter
                            join db_captacion.solicitud_inscripcion as sins on sins.int_id=inter.int_id
                            join db_captacion.solicitudins_documento as sdoc on sdoc.sins_id=sins.sins_id
                            where inter.int_id=inte.int_id 
                            group by inter.int_id 
                        ) as no_document                        
                    from 
                        " . $con->dbname . ".interesado inte
                        join " . $con1->dbname . ".persona as per on inte.per_id=per.per_id
                        join " . $con->dbname . ".interesado_empresa as iemp on iemp.int_id=inte.int_id
                        join " . $con1->dbname . ".empresa as emp on emp.emp_id=iemp.emp_id
                    where
                        inte.int_estado_logico=:estado AND
                        inte.int_estado=:estado AND                    
                        per.per_estado_logico=:estado AND						
                        per.per_estado=:estado AND
                        iemp.iemp_estado_logico=:estado AND						
                        iemp.iemp_estado=:estado AND
                        emp.emp_estado_logico=:estado AND						
                        emp.emp_estado=:estado
                        order by inte.int_fecha_creacion desc
                ";
        $comando = $con->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        $resultData = $comando->queryAll();
        return $resultData;
    }
}

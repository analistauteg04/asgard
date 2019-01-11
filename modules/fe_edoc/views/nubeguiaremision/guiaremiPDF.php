<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <style>
            html, body, div, span,
            h1, h2, h3, h4, h5, h6
            {
                width:100%;
                font-family:Arial;
                font-size:7pt;
                margin: 0;
                padding: 0;
                border: 0;
                vertical-align: baseline;
                line-height: 1;
            }
            html, body, table, tbody, td, tr, .t-content {
                background-color: #FFFFFF;
            }
            #main{
                font-family: Arial, sans-serif;
                margin: 0px auto auto 0px;
                padding: 0;
                /*width: 763px;*/
                /*height: 1122px;*/
            }
            #container{
                height: 100%;
                position: relative;
            }
            .marcoDiv{
                border: 1px solid #165480;
                padding: 2mm;
            }
            .marcoCel{
                border: 1px solid #165480;
                padding: 1mm;

            }
            .dataNumber{
                text-align: right;

            }
            .titleDetalle{
                text-align: center;

            }
            .tabDetalle{
                border-spacing:0;
                border-collapse: collapse;
            }
            .titleLabel{
                font-size:7pt;
                /*color:#000;*/
                font-weight: bold ;
            }
            .titleRazon{
                font-size:10pt;
                /*color:#000;*/
                font-weight: bold ;
            }
            .titleDocumento{
                font-size:10pt;
                letter-spacing: 5px; 
            }
            .titleNum_Ruc{
                font-size:9pt;
            }

        </style>
    </head>
    <body>
        <div id="main" class="t-content">
            <div id="container">
        <?php
        $contador = count($cabDoc);
        if ($cabDoc !== null) {
            ?>
            <?php echo $this->renderPartial('_barcode', array('ClaveAcceso' => $cabDoc['ClaveAcceso'],'Identificacion' => $cabDoc['IdentificacionSujetoRetenido'])); ?>
            <table style="width:100%;">
                <tbody>
                    <tr>
                        <td style="width:50%;vertical-align: central">
                            <?php //echo CHtml::image(Yii::$app->theme->baseUrl . '/images/plantilla/logo.png', 'Utimpor', array('width' => '300px', 'height' => '50px')); ?>
                            <?php echo CHtml::image(Yii::$app->theme->baseUrl . '/images/plantilla/logoPDF.png', 'Utimpor', array('width' => '340px', 'height' => '110px')); ?>
                        </td>
                        <td rowspan="2" style="width:50%">
                            <?php echo $this->renderPartial('_frm_CabDoc', array('cabDoc' => $cabDoc)); ?>
                        </td>
                    </tr>
                    <tr>
                        <td style="width:50%;vertical-align: bottom">
                            <?php echo $this->renderPartial('_frm_DataEmpresa'); ?>
                        </td>
                    </tr>
                </tbody>
            </table>
            <table style="width:100%;">
                <tbody>
                    <tr>
                        <td>
                            <?php echo $this->renderPartial('_frm_DataTransporte', array('cabDoc' => $cabDoc)); ?>
                        </td>
                    </tr>
                </tbody>
            </table>           

        <table style="width:100%;" class="marcoCel">
                <tbody>
                    <tr>
                        <td>
                            <?php echo $this->renderPartial('_frm_DataCliente', array('destDoc' => $destDoc)); ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php echo $this->renderPartial('_frm_DetDoc', array('destDoc' => $destDoc[0]['GuiaDet'])); ?>
                        </td>
                    </tr>
                </tbody>
            </table>
            <table style="width:100%">
                <tbody>
                    <tr>
                        <td style="width:70%;vertical-align: top">
                            <?php echo $this->renderPartial('_frm_DataAuxDoc', array('adiDoc' => $adiDoc)); ?>
                        </td>
                        
                    </tr>
                </tbody>
            </table>
        <?php } ?>
        </div></div>
    </body>
</html>
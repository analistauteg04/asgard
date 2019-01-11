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
                $contador = count($cabFact);
                if ($cabFact !== null) {
                    ?>
                    <?php //$this->render('_barcode', array('cabFact' => $cabFact)); ?>
                    <table style="width:100%;">
                        <tbody>
                            <tr>
                                <!--<td style="width:50%;vertical-align: central">-->
                                <td style="width:50%;vertical-align: central" align="center">
                                    <?php echo yii\helpers\Html::img(Yii::$app->basePath."/themes/".Yii::$app->view->theme->themeName."/assets/img/logos/logo_".Yii::$app->session->get('PB_idempresa').".png", array('width' => '250px', 'height' => '110px', "alt" => Yii::$app->params["copyright"])); ?>
                                </td>
                                <td rowspan="2" style="width:50%">
                                    <?php echo $this->render('_frm_CabFact', array('cabFact' => $cabFact)); ?>
                                </td>
                            </tr>
                            <tr>
                                <td style="width:50%;vertical-align: bottom">
                                    <?php echo $this->render('_frm_DataEmpresa'); ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <br />
                    <table style="width:100%;">
                        <tbody>
                            <tr>
                                <td>
                                    <?php echo $this->render('_frm_DataCliente', array('cabFact' => $cabFact)); ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <br />
                    <table style="width:100%;">
                        <tbody>
                            <tr>
                                <td style="/*width:50%*/">
                                    <?php echo $this->render('_frm_DetFact', array('detFact' => $detFact)); ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <br />
                    <table style="width:100%;">
                        <tbody>
                            <tr>
                                <td style="width:70%;vertical-align: top">
                                    <?php echo $this->render('_frm_DataAuxFact', array('adiFact' => $adiFact,'pagFact' => $pagFact)); ?>
                                </td>
                                <td style="width:30%">
                                    <div>
                                        <?php echo $this->render('_frm_TotFact', array('impFact' => $impFact, 'cabFact' => $cabFact)); ?>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                <?php } ?>
            </div>
        </div>
    </body>
</html>
<?php
$IRBPNR=0;
$ICE=0;
//TABLA 18 FICHA TECNICA
for ($i = 0; $i < sizeof($impFact); $i++) {
    if ($impFact[$i]['Codigo'] == '2') {//Valores de IVA
        switch ($impFact[$i]['CodigoPorcentaje']) {
            case 0:
                $BASEIVA0=$impFact[$i]['BaseImponible'];
                break;
            case 2:
                $BASEIVA12=$impFact[$i]['BaseImponible'];
                $VALORIVA12=$impFact[$i]['Valor'];
                break;
            case 3:
                $BASEIVA12=$impFact[$i]['BaseImponible'];
                $VALORIVA12=$impFact[$i]['Valor'];
                //VSValidador::putMessageLogFile($VALORIVA12);
                break;
            case 6://No objeto Iva
                $NOOBJIVA=$impFact[$i]['BaseImponible'];
                break;
            case 7://Excento de Iva
                $EXENTOIVA=$impFact[$i]['BaseImponible'];
                break;
            default:
        }
    }
}
?>
<table class="tabDetalle" style="width:100mm" >
    <tbody>
        <tr>
            <td class="marcoCel">
                <span><?php echo Yii::t('DOCUMENTOS', 'SUBTOTAL ').Yii::$app->params['IVAdefault'].'%' ?></span>
            </td>
            <td class="marcoCel dataNumber">
                <span><?php echo Yii::$app->formatter->format($BASEIVA12, ["decimal", 2])  ?></span>
            </td>
        </tr>
        <tr>
            <td class="marcoCel">
                <span><?php echo Yii::t('DOCUMENTOS', 'SUBTOTAL 0%') ?></span>
            </td>
            <td class="marcoCel dataNumber">
                <span><?php echo Yii::$app->formatter->format($BASEIVA0, ["decimal", 2])   ?></span>
            </td>
        </tr>
        <tr>
            <td class="marcoCel">
                <span><?php echo Yii::t('DOCUMENTOS', 'SUBTOTAL IVA no object') ?></span>
            </td>
            <td class="marcoCel dataNumber">
                <span><?php echo Yii::$app->formatter->format($NOOBJIVA, ["decimal", 2])  ?></span>
            </td>
        </tr>
        <!--<tr>
            <td class="marcoCel">
                <span><?php //echo Yii::t('DOCUMENTOS', 'SUBTOTAL TAX FREE') ?></span>
            </td>
            <td class="marcoCel">
                <span><?php //echo $EXENTOIVA  ?></span>
            </td>
        </tr>-->
        <tr>
            <td class="marcoCel">
                <span><?php echo Yii::t('DOCUMENTOS', 'SUBTOTAL IVA EXEMPT') ?></span>
            </td>
            <td class="marcoCel dataNumber">
                <span><?php echo Yii::$app->formatter->format($EXENTOIVA, ["decimal", 2])  ?></span>
            </td>
        </tr>
        <tr>
            <td class="marcoCel">
                <span><?php echo strtoupper(Yii::t('DOCUMENTOS', 'Discount')) ?></span>
            </td>
            <td class="marcoCel dataNumber">
                <span><?php echo Yii::$app->formatter->format($cabFact['TotalDescuento'], ["decimal", 2])  ?></span>
            </td>
        </tr>
        <tr>
            <td class="marcoCel">
                <span><?php echo Yii::t('DOCUMENTOS', 'ICE') ?></span>
            </td>
            <td class="marcoCel dataNumber">
                <span><?php Yii::$app->formatter->format($ICE, ["decimal", 2])  ?></span>
            </td>
        </tr>
        <tr>
            <td class="marcoCel">
                <span><?php echo Yii::t('DOCUMENTOS', 'IVA ').Yii::$app->params['IVAdefault'].'%' ?></span>
            </td>
            <td class="marcoCel dataNumber">
                <span><?php Yii::$app->formatter->format($VALORIVA12, ["decimal", 2])  ?></span>
                <!--<span><?php //echo number_format($VALORIVA12, Yii::$app->params['decimalPDF'], Yii::$app->params['SepdecimalPDF'], '')  ?></span>-->
                <!--<span><?php //echo VSValidador::truncateFloat($VALORIVA12, 2)  ?></span>-->
            </td>
        </tr>
        <tr>
            <td class="marcoCel">
                <span><?php echo Yii::t('DOCUMENTOS', 'IRBPNR') ?></span>
            </td>
            <td class="marcoCel dataNumber">
                <span><?php echo Yii::$app->formatter->format($IRBPNR, ["decimal", 2])  ?></span>
            </td>
        </tr>
        <tr>
            <td class="marcoCel">
                <span><?php echo Yii::t('DOCUMENTOS', 'GRATUITIES') ?></span>
            </td>
            <td class="marcoCel dataNumber">
                <span><?php echo Yii::$app->formatter->format($cabFact['Propina'], ["decimal", 2]) ?></span>
            </td>
        </tr>
        <tr>
            <td class="marcoCel">
                <span><?php echo Yii::t('DOCUMENTOS', 'TOTAL VALUE') ?></span>
            </td>
            <td class="marcoCel dataNumber">
                <span><?php echo Yii::$app->formatter->format($cabFact['ImporteTotal'], ["decimal", 2])  ?></span>
            </td>
        </tr>

    </tbody>
</table>
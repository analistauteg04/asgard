<div>
    <table style="width:200mm;" class="marcoDiv">
        <tbody>
            <tr>
                <td>
                    <span class="titleLabel"><?php echo Yii::t('DOCUMENTOS', 'Social reason and last name') ?></span>
                    <span><?php echo $cabFact['RazonSocialComprador'] ?></span>
                </td>
                <td>
                    <span class="titleLabel"><?php echo Yii::t('DOCUMENTOS', 'Identification') ?></span>
                    <span><?php echo $cabFact['IdentificacionComprador'] ?></span>
                </td>
            </tr>
            <tr>
                <td>
                    <span class="titleLabel"><?php echo Yii::t('DOCUMENTOS', 'Date of issue') ?></span>
                    <span><?php echo date(Yii::$app->params["dateByDefault"],strtotime($cabFact['FechaEmision'])) ?></span>
                </td>
                <td>
                    <span class="titleLabel"><?php echo Yii::t('DOCUMENTOS', 'Remission guide') ?></span>
                    <span><?php echo $cabFact['GuiaRemision'] ?></span>
                </td>
            </tr>
        </tbody>
    </table>
</div>
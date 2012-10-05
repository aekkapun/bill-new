<fieldset>
    <div>Наименование услуги: <strong><?php echo $params['name'] ?></strong></div>
    <div>Стоимость: <strong><?php echo Yii::app()->numberFormatter->formatCurrency($params['cost'], 'RUB'); ?></strong></div>
</fieldset>
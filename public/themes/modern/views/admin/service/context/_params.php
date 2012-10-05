<?php if(isset($params['advPlatforms'])) : ?>
<?php foreach ($params['advPlatforms'] as $advPlatform): ?>

<fieldset>
    <legend><?php echo $advPlatform['name'] ?></legend>
    <div>Бюджет:
        <strong><?php echo Yii::app()->numberFormatter->formatCurrency($advPlatform['budget'], 'RUB'); ?></strong></div>
    <div>Стоимость работ:
        <strong><?php echo Yii::app()->numberFormatter->formatCurrency($advPlatform['budget'] * $advPlatform['work_percent'], 'RUB') ?></strong>
    </div>
</fieldset>

<?php endforeach; ?>
<?php endif; ?>
<?php $form = $this->beginWidget('CActiveForm', array(
    'id' => 'bankclient-import-form',
    'enableAjaxValidation' => false,
    'action' => array('/import/default/commit/', 'src' => $src),
));?>

<h2>Предпросмотр результатов импорта</h2>

<?php $this->widget('zii.widgets.grid.CGridView',
    array(
        'id' => 'bankclient-import-preview-grid',
        'dataProvider' => $dataProvider,
        'rowCssClassExpression' => 'empty($data["699c5c56b1a659c9a7d6725e43d02d9b"]) ? "ambiguous" : ""',
        'columns' => array(
            array(
                'name' => md5('Номер'),
                'header' => 'Номер'
            ),
            array(
                'name' => md5('ДатаПоступило'),
                'header' => 'Дата поступления'
            ),
            array(
                'name' => md5('ПолучательРасчСчет'),
                'header' => 'Счет получателя'
            ),
            array(
                'name' => md5('ПлательщикИНН'),
                'header' => 'ИНН Контрагента'
            ),
            array(
                'name' => md5('ПлательщикКПП'),
                'header' => 'КПП Контрагента',
            ),
            array(
                'name' => md5('Сумма'),
                'header' => 'Сумма'
            ),
        )
    ));?>
<?php if ($dataProvider->totalItemCount > 0) : ?>
<div class="row buttons">
    <?php echo CHtml::submitButton('Сохранить в базу данных'); ?>
</div>
<?php endif; ?>

<?php $this->endWidget(); ?>
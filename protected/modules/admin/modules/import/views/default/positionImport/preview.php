<?php $form = $this->beginWidget('CActiveForm', array(
    'id' => 'position-import-form',
    'enableAjaxValidation' => false,
    'action' => array('/admin/import/default/commit/', 'src' => $src),
));?>

<h2>Предпросмотр результатов импорта</h2>

<?php $this->widget('zii.widgets.grid.CGridView',
    array(
        'id' => 'position-import-preview-grid',
        'dataProvider' => $dataProvider,
        'columns' => array(
            'phrase:Поисковая фраза',
            'price:Цена'
        )
    ));?>
<?php if ($dataProvider->totalItemCount > 0) : ?>
<div class="row buttons">
    <?php echo CHtml::submitButton('Сохранить в базу данных'); ?>
</div>
<?php endif; ?>

<?php $this->endWidget(); ?>
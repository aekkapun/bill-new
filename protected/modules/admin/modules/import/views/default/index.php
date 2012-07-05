<?php
$this->breadcrumbs = array(
    $this->module->id,
);
?>

<h2>Вы можете импортировать данные из следующих источников:</h2>

<?php $this->widget('zii.widgets.CMenu', array(
    'items' => Yii::app()->getModule('admin')->getModule('import')->availableDriversForCMenu,
)); ?>


<?php if (isset($form)) : ?>
<div class="form">
    <?php echo CHtml::errorSummary($model) ?>
    <?php echo $form; ?>
</div>
<?php endif; ?>
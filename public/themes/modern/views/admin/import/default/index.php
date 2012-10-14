<?php
$this->breadcrumbs = array(
    'Импорт',
);
?>

<div style="padding-top:40px;"></div>

<h2>Вы можете импортировать данные из следующих источников:</h2>

<?php $this->widget('bootstrap.widgets.TbMenu', array(
    'items' => Yii::app()->getModule('admin')->getModule('import')->availableDriversForCMenu,
)); ?>

<?php if(Yii::app()->user->hasFlash('error')):?>
    <div class="alert alert-error">
        <?php echo Yii::app()->user->getFlash('error'); ?>
    </div>
<?php endif; ?>

<?php if (isset($form)) : ?>
    <?php echo CHtml::errorSummary($model) ?>
    <?php echo $form; ?>
<?php endif; ?>
<?php
$this->menu=array(
	array('label'=>'Список', 'url'=>array('index')),
);
?>

<h1>Создать название диапазона</h1>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>
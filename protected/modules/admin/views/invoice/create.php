<?php
$this->breadcrumbs=array(
	'Счет-фактура'=>array('index'),
	'Создать',
);

$this->menu=array(
	array('label'=>'Список', 'url'=>array('index')),
);
?>

<h1>Создать счет-фактуру</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
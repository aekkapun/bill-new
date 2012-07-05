<?php
$this->breadcrumbs=array(
	'Платежи'=>array('index'),
	'Создать',
);

$this->menu=array(
	array('label'=>'Список', 'url'=>array('index')),
);
?>

<h1>Создать платеж</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
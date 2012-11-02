<?php
$this->breadcrumbs=array(
	'Статические показатели'=>array('index'),
	'Создать',
);

$this->menu=array(
	array('label'=>'Список', 'url'=>array('index')),
);
?>

<h1>Статические показатели</h1>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>
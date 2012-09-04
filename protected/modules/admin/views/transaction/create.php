<?php
$this->breadcrumbs=array(
	'Транзакции'=>array('index'),
	'Создать',
);

$this->menu=array(
	array('label'=>'Список', 'url'=>array('index')),
);
?>

<h1>Создать транзакцию</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
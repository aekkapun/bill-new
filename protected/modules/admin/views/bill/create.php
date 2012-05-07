<?php
$this->breadcrumbs=array(
	'Счета'=>array('index'),
	'Создать',
);

$this->menu=array(
	array('label'=>'Список', 'url'=>array('index')),
);
?>

<h1>Создать счет</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
<?php
$this->breadcrumbs=array(
	'Reports'=>array('index'),
	'Создать',
);

$this->menu=array(
array('label'=>'Список', 'url'=>array('index')),
);
?>

<h1>Создать Report</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
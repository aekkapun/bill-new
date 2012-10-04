<?php
$this->breadcrumbs=array(
	'Factors'=>array('index'),
	'Создать',
);

$this->menu=array(
	array('label'=>'Список', 'url'=>array('index')),
);
?>

<h1>Создать коэффициент</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
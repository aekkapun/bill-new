<?php
$this->breadcrumbs=array(
	'Сайты'=>array('index'),
	'Создать',
);

$this->menu=array(
	array('label'=>'Список', 'url'=>array('index')),
);
?>

<h1>Создать сайт</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
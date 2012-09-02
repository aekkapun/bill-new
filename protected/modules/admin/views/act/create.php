<?php
$this->breadcrumbs=array(
	'Акты'=>array('index'),
	'Создать',
);

$this->menu=array(
	array('label'=>'Список', 'url'=>array('index')),
);
?>

<h1>Добавить акт</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
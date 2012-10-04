<?php
$this->breadcrumbs=array(
	'Subscriptions'=>array('index'),
	'Создать',
);

$this->menu=array(
	array('label'=>'Список', 'url'=>array('index')),
);
?>

<h1>Создать Subscription</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
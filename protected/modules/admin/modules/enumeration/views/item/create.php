<?php
$this->breadcrumbs=array(
	'Enumeration Items'=>array('index'),
	'Создать',
);

$this->menu=array(
array('label'=>'Список', 'url'=>array('index')),
);
?>

<h1>Создать EnumerationItem</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
<?php
$this->breadcrumbs=array(
	'Enumerations'=>array('index'),
	'Создать',
);

$this->menu=array(
array('label'=>'Список', 'url'=>array('index')),
);
?>

<h1>Создать Enumeration</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
<?php
$this->breadcrumbs=array(
	'Договоры'=>array('index'),
	'Создать',
);

$this->menu=array(
	array('label'=>'Список', 'url'=>array('index')),
);
?>

<h1>Создать договор</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
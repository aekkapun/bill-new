<?php
$this->breadcrumbs=array(
	'Adv Platforms'=>array('index'),
	'Создать',
);

$this->menu=array(
	array('label'=>'Список', 'url'=>array('index')),
);
?>

<h1>Создать AdvPlatform</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
<?php
$this->breadcrumbs=array(
	'Site Ranges'=>array('index'),
	'Создать',
);

$this->menu=array(
	array('label'=>'Список', 'url'=>array('index')),
);
?>

<h1>Создать SiteRange</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
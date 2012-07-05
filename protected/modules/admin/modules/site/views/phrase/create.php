<?php
$this->breadcrumbs=array(
	'Site Phrases'=>array('index'),
	'Создать',
);

$this->menu=array(
	array('label'=>'Список', 'url'=>array('index')),
);
?>

<h1>Создать SitePhrase</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
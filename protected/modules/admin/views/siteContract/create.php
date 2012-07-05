<?php
$this->breadcrumbs=array(
	'Site Contracts'=>array('index'),
	'Создать',
);

$this->menu=array(
	array('label'=>'Список', 'url'=>array('index')),
);
?>

<h1>Создать SiteContract</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model, 'sites' => $sites, 'contracts' => $contracts)); ?>
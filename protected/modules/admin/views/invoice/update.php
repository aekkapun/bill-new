<?php
$this->breadcrumbs = array(
    'Счет-фактура' => array('index'),
    $model->id => array('view', 'id' => $model->id),
    'Обновление',
);

$this->menu = array(
    array('label' => 'Создать', 'url' => array('create')),
    array('label' => 'Просмотр', 'url' => array('view', 'id' => $model->id)),
    array('label' => 'Список', 'url' => array('index')),
);
?>

<h1>Обновить счет-фактуру <?php echo $model->number; ?></h1>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>
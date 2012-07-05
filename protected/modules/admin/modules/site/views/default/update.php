<?php
$this->breadcrumbs = array(
    'Сайты' => array('index'),
    $model->domain => array('view', 'id' => $model->id),
    'Обновление',
);

$this->menu = array(
    array('label' => 'Создать', 'url' => array('create')),
    array('label' => 'Просмотр', 'url' => array('view', 'id' => $model->id)),
    array('label' => 'Список', 'url' => array('index')),
);
?>

<h1>Обновить сайт <?php echo $model->domain; ?></h1>

<?php echo $this->renderPartial('_form', array(
    'model' => $model,
)); ?>
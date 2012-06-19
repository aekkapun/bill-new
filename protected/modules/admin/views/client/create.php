<?php
$this->breadcrumbs = array(
    'Клиенты' => array('index'),
    'Создать',
);

$this->menu = array(
    array('label' => 'Список', 'url' => array('index')),
);
?>

<h1>Создать клиента</h1>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>
<?php
$this->breadcrumbs = array(
    'Пользователи' => array('index'),
    'Список',
);

$this->menu = array(
    array('label' => 'Создать', 'url' => array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('user-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Список пользователей</h1>

<p>
    <?php $this->widget('bootstrap.widgets.TbButton', array(
    'buttonType' => 'button',
    'type' => 'info',
    'label' => 'Расширенный поиск',
    'toggle' => true,
    'htmlOptions' => array('class' => 'search-button'),
)); ?>
</p>

<div class="search-form" style="display:none">
    <?php $this->renderPartial('_search', array(
    'model' => $model,
)); ?>
</div><!-- search-form -->

<?php
$users = $model->search();
$users->pagination->pageSize = 20;

$this->widget('bootstrap.widgets.TbGridView', array(
    'type' => 'striped bordered',
    'id' => 'user-grid',
    'dataProvider' => $users,
    'columns' => array(
		'id',
        array(
            'name' => 'name',
            'type' => 'raw',
            'value' => 'CHtml::link($data->name, array("/admin/user/view", "id" => $data->id))'
        ),
		array(
			'header' => 'Уровень доступа',
			'name' => 'role',
			'value' => '$data->roleLabel'
		),
		'name' => 'email',
		array(
            'class' => 'bootstrap.widgets.TbButtonColumn',
        ),
    ),
));
?>

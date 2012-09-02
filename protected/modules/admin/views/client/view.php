<?php
$this->breadcrumbs = array(
    'Клиенты' => array('index'),
    $model->name,
);

$this->menu = array(
    array('label' => 'Создать', 'url' => array('create'), 'visible' => Yii::app()->user->checkAccess('accountant')),
    array('label' => 'Обновить', 'url' => array('update', 'id' => $model->id), 'visible' => Yii::app()->user->checkAccess('accountant')),
    array('label' => 'Список', 'url' => array('index')),
    array('label' => 'Удалить', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Вы действительно хотите удалить эту запись?'), 'visible' => Yii::app()->user->checkAccess('accountant')),
);
?>

<h1><?php echo CHtml::encode($model->name) ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        'id',
        'manager.name:html:Менеджер',
        'address',
        'is_corporate:boolean',
        'post_code',
        'code_1c',
        'phone',
        'statusLabel',
        'created_at',
        'updated_at',
    ),
)); ?>

<br />
<h2>Договоры</h2>

<?php
if (!empty($model->contracts)) {

    $this->widget('zii.widgets.grid.CGridView', array(
        'id' => 'contract-grid',
        'dataProvider' => $clients,
        'filter' => null,
        'template' => '{items}',
        'columns' => array(
            array(
				'header' => 'Номер',
                'name' => 'number',
                'type' => 'raw',
                'value' => 'CHtml::link($data["number"], array("/admin/contract/view", "id" => $data["id"]))'
            ),
            'statusLabel:text:Статус',
            array(
                'header' => 'Дата создания',
                'type' => 'date',
				'name' => 'created_at',
                'value' => 'strtotime($data->created_at)',
            ),
            array(
                'class' => 'CButtonColumn',
                'template' => '{view}',
                'buttons' => array(
                    'view' => array(
                        'url' => 'Yii::app()->createUrl("admin/contract/view", array("id" => $data->id))',
                    ),
                ),
            ),
        ),
    ));

}
?>



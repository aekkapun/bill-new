<?php $this->widget('bootstrap.widgets.TbGridView', array(
    'type' => 'striped bordered',
    'id' => 'report-grid',
    'template' => '{items}',
    'dataProvider' => $dataProvider,
    'filter' => null,
    'htmlOptions' => array('class' => 'report-files-table'),
    'emptyText' => 'Файлов нет',
    'columns' => array(
        array(
            'type' => 'raw',
            'header' => 'Сущность',
            'name' => 'class_name',
            'value' => '$data["class_name"]::model()->tableName("ru")',
        ),
        array(
            'header' => 'Номер',
            'name' => 'class_name_id',
        ),
        array(
            'type' => 'raw',
            'header' => 'Имя файла',
            'name' => 'file',
        ),
        array(
            'type' => 'raw',
            'header' => 'Прикрепить?',
            'value' => 'CHtml::checkBox("Report[files][$data[class_name]][$data[class_name_id]]")',
        ),
    ),
)); ?>

<?php

?>

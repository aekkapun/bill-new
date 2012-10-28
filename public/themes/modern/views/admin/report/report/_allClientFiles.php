<?php $this->widget('bootstrap.widgets.TbGridView', array(
    'type' => 'striped bordered',
    'id' => 'report-grid',
    'template' => '{items}',
    'dataProvider' => new CArrayDataProvider( $files ),
    'filter' => null,
    'htmlOptions' => array('class' => 'report-files-table'),
    'emptyText' => 'Файлов нет',
    'columns' => array(
        array(
            'header' => 'Сущность',
            'name' => 'className',
        ),
        array(
            'header' => 'Номер',
            'name' => 'id',
        ),
        array(
            'type' => 'raw',
            'header' => 'Имя файла',
            'name' => 'file',
        ),
        array(
            'type' => 'raw',
            'header' => 'Прикрепить?',
            'value' => 'CHtml::checkBox("Report[files][$data[className]][$data[id]]")',
        ),
    ),
)); ?>

<?php

?>

<h4 class="report-section-header">По услуге "Оплата по позициям"</h4>
<?php  $this->widget('bootstrap.widgets.TbGridView', array(
    'type' => 'striped bordered',
    'template' => '{items}',
    'htmlOptions' => array('class' => 'report-section-grid'),
    'dataProvider' => new CArrayDataProvider($reports['position']),
    'filter' => null,
    'columns' => array(
        array(
            'header' => 'Сайт',
            'value' => '$data->site->domain',
            'footer' => '<strong>Итого</strong>'
        ),
        array(
            'header' => 'Yandex',
            'name' => 'yandex',
            'class'  => 'TotalColumn',
        ),
        array(
            'header' => 'Google',
            'name' => 'google',
            'class'  => 'TotalColumn',
        ),
        array(
            'header' => 'Всего',
            'name' => 'sum',
            'class'  => 'TotalColumn',
        ),
    ),
));  ?>


<h4 class="report-section-header">По услуге "Абонентская плата"</h4>
<?php $this->widget('bootstrap.widgets.TbGridView', array(
    'type' => 'striped bordered',
    'template' => '{items}',
    'htmlOptions' => array('class' => 'report-section-grid'),
    'dataProvider' => new CArrayDataProvider($reports['subscription']),
    'filter' => null,
    'columns' => array(
        array(
            'header' => 'Сайт',
            'value' => '$data->site->domain',
            'footer' => '<strong>Итого</strong>'
        ),
        array(
            'header' => 'Сумма',
            'name' => 'sum',
            'class'  => 'TotalColumn',
        ),
        array(
            'header' => 'Количество ссылок',
            'name' => 'link_count',
        ),
        array(
            'header' => 'Средняя стоимость ссылки',
            'value' => 'Yii::app()->numberFormatter->format("#,##0.00", $data->sum / $data->link_count)',
        ),
        array(
            'header' => 'Количество переходов',
            'name' => 'transitions_count',
        ),
        array(
            'header' => 'Ср. стоимость перехода',
            'name' => 'avg_transition_price',
        ),

    ),
)); ?>


<h4 class="report-section-header">По услуге "Контекстная реклама"</h4>
<?php $this->widget('TbGroupedGridView', array(
    'type' => 'striped bordered',
    'template' => '{items}',
    'htmlOptions' => array('class' => 'report-section-grid'),
    'dataProvider' => new CArrayDataProvider($reports['context']),
    'filter' => null,
    'groupField' => 'site_id',
    'sectionList' => ReportContext::getSectionData(),
    'columns' => array(
        array(
            'header' => 'Площадка',
            'name' => 'platform_id',
            'value' => 'AdvPlatform::$labels[$data["platform_id"]]',
            'footer' => '<strong>Итого</strong>',
        ),
        array(
            'header' => 'Бюджет',
            'name' => 'budget',
            'class'  => 'TotalColumn',
        ),
        array(
            'header' => 'Средняя стоимость перехода',
            'name' => 'avg_transition_price',
        ),
        array(
            'header' => 'Сумма',
            'name' => 'transition_sum',
            'class'  => 'TotalColumn',
        ),

    ),
)); ?>


<h4 class="report-section-header">По услуге "Баннерная реклама"</h4>
<?php $this->widget('bootstrap.widgets.TbGridView', array(
    'type' => 'striped bordered',
    'template' => '{items}',
    'htmlOptions' => array('class' => 'report-section-grid'),
    'dataProvider' => new CArrayDataProvider($reports['banner']),
    'filter' => null,
    'columns' => array(
        array(
            'header' => 'Сайт',
            'value' => '$data->site->domain',
            'footer' => '<strong>Итого</strong>'
        ),
        array(
            'header' => 'Сумма',
            'name' => 'sum',
            'class'  => 'TotalColumn',
        ),
        array(
            'header' => 'Кол-во кликов',
            'name' => 'transition_sum',
        ),
        array(
            'header' => 'Средняя цена клика',
            'value'  => 'Yii::app()->numberFormatter->format("#,##0.00", $data->sum / $data->transition_sum)',
        ),
    ),
)); ?>


<h4 class="report-section-header">По прочим услугам</h4>
<?php $this->widget('bootstrap.widgets.TbGroupedGridView', array(
    'type' => 'striped bordered',
    'template' => '{items}',
    'htmlOptions' => array('class' => 'report-section-grid'),
    'dataProvider' => new CArrayDataProvider($reports['custom']),
    'filter' => null,
    'groupField' => 'site_id',
    'sectionList' => ReportCustom::getSectionData(),
    'columns' => array(
        array(
            'name' => 'name',
            'value' => '$data->name',
            'footer' => '<strong>Итого</strong>',
        ),
        array(
            'header' => 'Сумма',
            'name' => 'price',
            'class'  => 'TotalColumn',
        ),
    ),
)); ?>
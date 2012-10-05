<h1>Статистика обработки</h1>

<p>
    Всего транзакций: <?php echo $countAll ?> <br/>
    Обработано новых: <?php echo $countSaved ?> <br/>
    Обработано с ошибками: <?php echo $countError ?> <br/>
    Кол-во ранее обработанных: <?php echo $countWorked ?> <br/>
</p>


<?php
$sharedColumns = array(
    'partner_inn::ИНН Контрагента',
    'partner_kpp::КПП Контрагента',
    'sum::Сумма',
    'statusLabel::Статус',
);
?>
<?php if ($countError > 0) : ?>
<h2>Транзакции с ошибками (<?php echo $countError ?>)</h2>
<?php $this->widget('zii.widgets.grid.CGridView',
        array(
            'id' => 'error-transaction-grid',
            'dataProvider' => $errorDataProvider,
            'columns' => CMap::mergeArray(array(
                'id::Код',
            ), $sharedColumns),
            'template' => '{items}{pager}',
        ));?>
<?php endif; ?>

<h2>Новые транзакции (<?php echo $countSaved ?>)</h2>
<?php $this->widget('zii.widgets.grid.CGridView',
    array(
        'id' => 'saved-transaction-grid',
        'dataProvider' => $savedDataProvider,
        'columns' => CMap::mergeArray(array(
            'id::Код',
        ), $sharedColumns),
        'template' => '{items}{pager}',
    ));?>

<h2>Ранее обработанные транзакции (<?php echo $countWorked ?>)</h2>
<?php $this->widget('zii.widgets.grid.CGridView',
    array(
        'id' => 'worked-transaction-grid',
        'dataProvider' => $workedDataProvider,
        'columns' => CMap::mergeArray(array(
        ), $sharedColumns),
        'template' => '{items}{pager}',
    ));?>
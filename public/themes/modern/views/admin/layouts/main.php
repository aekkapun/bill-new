<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div class="container-fluid">
    <?php $this->widget('bootstrap.widgets.TbNavbar', array(
    'type' => 'inverse',
    'brand' => CHtml::encode(Yii::app()->name),
    'brandUrl' => array('/admin'),
    'items' => array(
        array(
            'class' => 'bootstrap.widgets.TbMenu',
            'items' => array(
                array('label' => 'Справочники', 'url' => array('/admin/client'), 'visible' => !Yii::app()->user->isGuest, 'items' => array(
                    array('label' => 'Пользователи', 'url' => array('/admin/user'), 'visible' => Yii::app()->user->checkAccess('admin')),
                    array('label' => 'Коэффициенты', 'url' => array('/admin/factor'), 'visible' => Yii::app()->user->checkAccess('admin')),
                    array('label' => 'Рекламные площадки', 'url' => array('/admin/advPlatform'), 'visible' => Yii::app()->user->checkAccess('admin')),
                )),
                array('label' => 'Клиенты', 'url' => array('#'), 'visible' => !Yii::app()->user->isGuest, 'items' => array(
                    array('label' => 'Список клиентов', 'url' => array('/admin/client'), 'visible' => !Yii::app()->user->isGuest),
                    array('label' => 'Договоры', 'url' => array('/admin/contract'), 'visible' => !Yii::app()->user->isGuest),
                    array('label' => 'Счета', 'url' => array('/admin/bill'), 'visible' => !Yii::app()->user->isGuest),
                    array('label' => 'Счета-фактуры', 'url' => array('/admin/invoice'), 'visible' => !Yii::app()->user->isGuest),
                    array('label' => 'Акты', 'url' => array('/admin/act'), 'visible' => !Yii::app()->user->isGuest),
                    array('label' => 'Транзакции', 'url' => array('/admin/transaction'), 'visible' => !Yii::app()->user->isGuest),
                )),

                array('label' => 'Сайты', 'url' => array('/admin/site'), 'visible' => Yii::app()->user->checkAccess('manager')),
                array('label' => 'Отчеты', 'url' => array('/admin/report/report/index'), 'visible' => Yii::app()->user->checkAccess('manager')),
            )
        ),
        array(
            'class'=>'bootstrap.widgets.TbMenu',
            'htmlOptions'=>array('class'=>'pull-right'),
            'items'=>array(
                array('label' => 'Вход', 'url' => array('/admin/default/login'), 'visible' => Yii::app()->user->isGuest),
                array('label' => 'Выход (' . Yii::app()->user->name . ')', 'url' => array('/admin/default/logout'), 'visible' => !Yii::app()->user->isGuest, 'itemOptions' => array('class' => 'pull-left'))
            ),
        ),
    ),
)); ?>
</div>

<?php echo $content ?>

</div>

<script type="text/javascript">
    $(function () {
        $('.dropdown-toggle').dropdown();
    });
</script>
<!-- page -->
</body>
</html>

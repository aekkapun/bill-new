<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="language" content="en"/>

    <!-- blueprint CSS framework -->
    <link rel="stylesheet" type="text/css" href="<?php echo $this->assetsUrl; ?>/css/screen.css"
          media="screen, projection"/>
    <link rel="stylesheet" type="text/css" href="<?php echo $this->assetsUrl; ?>/css/print.css"
          media="print"/>
    <!--[if lt IE 8]>
    <link rel="stylesheet" type="text/css" href="<?php echo $this->assetsUrl; ?>/css/ie.css"
          media="screen, projection"/>
    <![endif]-->

    <link rel="stylesheet" type="text/css" href="<?php echo $this->assetsUrl; ?>/css/main.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo $this->assetsUrl; ?>/css/form.css"/>

    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div class="container" id="page">

    <div id="header">
        <div id="logo"><?php echo CHtml::encode(Yii::app()->name); ?></div>
    </div>
    <!-- header -->

    <div id="mainmenu">
        <?php $this->widget('zii.widgets.CMenu', array(
        'items' => array(
            array('label' => 'Пользователи', 'url' => array('/admin/user'), 'visible' => !Yii::app()->user->isGuest),
            array('label' => 'Клиенты', 'url' => array('/admin/client'), 'visible' => !Yii::app()->user->isGuest, 'items' => array(
                array('label' => 'Договоры', 'url' => array('/admin/contract'), 'visible' => !Yii::app()->user->isGuest),
                array('label' => 'Счета', 'url' => array('/admin/bill'), 'visible' => !Yii::app()->user->isGuest),
                array('label' => 'Счета-фактуры', 'url' => array('/admin/invoice'), 'visible' => !Yii::app()->user->isGuest),
                array('label' => 'Акты', 'url' => array('/admin/act'), 'visible' => !Yii::app()->user->isGuest),
                array('label' => 'Платежи', 'url' => array('/admin/payment'), 'visible' => !Yii::app()->user->isGuest),
            )),
            array('label' => 'Коэффициенты', 'url' => array('/admin/factor'), 'visible' => !Yii::app()->user->isGuest),
            array('label' => 'Рекламные площадки', 'url' => array('/admin/advPlatform'), 'visible' => !Yii::app()->user->isGuest),
            array('label' => 'Сайты', 'url' => array('/admin/site'), 'visible' => !Yii::app()->user->isGuest),
            array('label' => 'Вход', 'url' => array('/admin/default/login'), 'visible' => Yii::app()->user->isGuest),
            array('label' => 'Выход (' . Yii::app()->user->name . ')', 'url' => array('/admin/default/logout'), 'visible' => !Yii::app()->user->isGuest)
        ),
    )); ?>
    </div>
    <!-- mainmenu -->
    <?php if (isset($this->breadcrumbs)): ?>
        <?php $this->widget('zii.widgets.CBreadcrumbs', array(
        'links' => $this->breadcrumbs,
        'homeLink' => CHtml::link('Главная', array('/admin')),
    )); ?><!-- breadcrumbs -->
    <?php endif?>

    <?php
    foreach (Yii::app()->user->getFlashes() as $key => $message) {
        if ($key == 'error' || $key == 'success' || $key == 'notice') {
            echo "<div class='flash-{$key}'>{$message}</div>";
        }
    }
    ?>

    <?php echo $content; ?>

    <div class="clear"></div>

    <div id="footer">
        Copyright &copy; <?php echo date('Y'); ?> by My Company.<br/>
        All Rights Reserved.<br/>
        <?php echo Yii::powered(); ?>
    </div>
    <!-- footer -->

</div>
<!-- page -->
<script type="text/javascript" src="<?php echo $this->assetsUrl; ?>/js/admin.js"></script>
</body>
</html>

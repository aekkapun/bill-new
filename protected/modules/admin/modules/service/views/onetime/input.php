<div class="form">

    <h1>Разовая услуга
        подключена <?php echo Yii::app()->dateFormatter->format('d MMMM y', $siteService->created_at) ?></h1>
    <div class="params-block box">
        <?php $this->renderPartial('_params', array('params' => $params)) ?>
    </div>


</div>
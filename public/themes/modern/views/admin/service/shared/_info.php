<div class="alert alert-info">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <?php if(!$siteService->isNewRecord) : ?>
    <strong>Услуга подключена <?php echo Yii::app()->dateFormatter->format('d MMMM y', $siteService->created_at) ?></strong>
    <ul class="unstyled">
        <li><strong>Название:</strong> <?php echo CHtml::encode($siteService->service->name) ?></li>
        <li><strong>Сайт:</strong> <?php echo CHtml::encode($site->domain) ?></li>
    </ul>

    <button type="button" class="btn" data-toggle="modal" data-target="#myModal">Показать параметры</button>

    <?php else : ?>
    <ul class="unstyled">
        <li><strong>Название:</strong> <?php echo CHtml::encode($service->name) ?></li>
        <li><strong>Сайт:</strong> <?php echo CHtml::encode($site->domain) ?></li>
    </ul>
    <?php endif; ?>
</div>

<div style="display: none;" class="modal" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel">Параметры услуги</h3>
    </div>
    <div class="modal-body">
        <?php $this->renderPartial('_params', array('params' => $params)) ?>
    </div>
    <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">Закрыть</button>
    </div>
</div>
<ul class="unstyled">
    <?php if(isset($params['sum'])) : ?><li>Ссылочный бюджет: <?php echo $params['sum'] ?></li> <?php endif; ?>
    <?php if (isset($params['work_cost']) && $params['work_cost'] ) : ?><li>Стоимость работ: <?php echo $params['work_cost'] ?></li> <?php endif; ?>
</ul>
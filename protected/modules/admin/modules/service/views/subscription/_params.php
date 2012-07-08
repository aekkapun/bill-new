<ul>
    <li>Ссылочный бюджет: <?php echo $params['sum'] ?></li>
    <?php if (isset($params['work_cost']) && $params['work_cost'] ) : ?><li>Стоимость работ: <?php echo $params['work_cost'] ?></li><? endif; ?>
</ul>
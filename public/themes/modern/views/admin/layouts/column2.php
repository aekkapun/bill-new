<?php $this->beginContent('webroot.themes.modern.views.admin.layouts.main'); ?>
<div class="span3">
    <div id="leftbar">
        <?php
        $this->widget('bootstrap.widgets.TbMenu', array(
            'type' => 'list',
            'items' => $this->menu,
        ));
        ?>
    </div>
</div>
<div class="span9">
    <div id="content">
        <?php echo $content; ?>
    </div>
</div>
<?php $this->endContent(); ?>
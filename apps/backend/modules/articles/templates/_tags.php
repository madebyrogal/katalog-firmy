<?php

// much of this I copied and adapted from a cached admin generator template.
$name = 'Tags';
$label = '';
$help = '';
$class = 'sf_admin_form_row sf_admin_text sf_admin_form_field_tags';

?>

<div class="<?php echo $class ?><?php $form[$name]->hasError() and print ' errors' ?>">
    <?php echo $form[$name]->renderError() ?>
    <div>
        <label><?php echo __('Dodaj tagi') ?></label>

        <div class="content">
            <?php echo $form[$name]->render($attributes instanceof sfOutputEscaper ? $attributes->getRawValue() : $attributes) ?>
        </div>

        <?php if ($help): ?>
        <div class="help"><?php echo __($help, array(), 'messages') ?></div>
        <?php elseif($help = $form[$name]->renderHelp()): ?>
        <div class="help"><?php echo $help ?></div>
        <?php endif; ?>
    </div>
</div>
<?php $tags = $form->getObject()->getTags(); ?>

<?php if(count($tags) > 0): ?>
<div class="sf_admin_form_row sf_admin_text sf_admin_form_field_tags">
    <div>
        <label><?php echo __('Obecne tagi') ?></label>
        <div class="content">
            <div class="taglist">
                    <?php foreach($tags as $t):   ?>
                        <span class="tagbox">
                            <a href="#" class="remove" title="<?php echo __('Usuń tag: '. $t) ?>"></a>
                            <span class="tag"><?php echo $t  ?></span>
                        </span>
                    <?php endforeach;  ?>
            </div>
            <div class="content clear">
                <div id="remove_tag_help" style="display:none;"><?php echo __('Do usunięcia: <span id="remove_list"></span>. Pamiętaj o zapisie!')?></div>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>
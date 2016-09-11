<span class="breadcrumb_root_prefix"><?php echo __($root_prefix); ?></span>

<?php foreach($breadcrumbs as $key => $breadcrumb): ?>
  <?php if (!is_null($breadcrumb) && !$breadcrumb['name'] == '') : ?>

    <?php //prefix ?>
    <?php echo isset($breadcrumb['prefix']) ? __($breadcrumb['prefix']) : ''; ?>

    <?php if($breadcrumb['url'] != null): ?>
      <?php //url ?>
      <?php echo link_to(__($breadcrumb['name']), $breadcrumb['url']) ?>
    <?php else: ?>
      <?php //bez url ?>
      <span class="breadcrumb_no_url"><?php echo sfOutputEscaper::unescape(__($breadcrumb['name'])) ?></span>
    <?php endif ?>

    <?php //separator?>
    <?php if($key < count($breadcrumbs)-1): ?> <?php echo $sf_data->getRaw('separator') ?> <?php endif ?>

  <?php endif ?>
<?php endforeach ?>
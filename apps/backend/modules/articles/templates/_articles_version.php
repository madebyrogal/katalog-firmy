<?php    
    $versions = $articles->getArticlesVersion();
    $i = 0;
?>

<div class="article_versions_box">
  <?php if($versions->count() > 1): ?>
    <h3>Dostępne wersje:
        <a id="showArticleVersion" style="display: none" href="#">Rozwiń</a>
        <a id="hideArticleVersion" style="display: none" href="#">Zwiń</a>
    </h3>
  <form action="<?php echo url_for('@delete_article_versions') ?>" method="post">
  <table class="table_version">
      <tr>
          <th style="width: 10px;"><input type="checkbox" name="all_version" id="all_version" /></th>
          <th>Lp.</th>
          <th>Nazwa / tytuł</th>
          <th>Treść</th>
          <th>Data dodania</th>
          <th>Data modyfikacji</th>
          <th>Aktywny</th>
          <th>Akcje</th>
      </tr>
      <?php foreach($versions as $version): ?>
      <tr class="<?php echo ($version->getIsActive()) ? 'active' : 'unactive'; ?> <?php echo ($version->getPrimaryKey() == $version_edit) ? 'version_edit' : ''; ?>">
          <td><input type="checkbox" class="one_version" name="version[<?php echo $version->getPrimaryKey() ?>]" /></td>
          <td class="td_center">
              <?php echo ++$i; ?>.
          </td>
          <td>
              <?php echo $version->getTitle(); ?>
          </td>
          <td>
              <?php echo substr(strip_tags($version->getContent(ESC_RAW)), 0, 100).'...'; ?>
          </td>
          <td class="td_center">
              <?php echo $version->getCreatedAt(); ?>
          </td>
          <td class="td_center">
              <?php echo $version->getUpdatedAt(); ?>
          </td>
          <td class="td_center">
              <?php if($version->getIsActive()): ?>
                  <img src="/backend/images/tick.png" />
              <?php endif; ?>
          </td>
          <td>
              <ul class="sf_admin_td_actions">
                  <li class="sf_admin_action_edit"><a href="<?php echo url_for('articles_edit', $articles).'?version='.$version->getPrimaryKey(); ?>">Edytuj</a></li>

                  <?php
                      $uid = md5($version->getPrimaryKey().'article_show_version');
                  ?>
                  <li class="sf_admin_action_edit"><a class="show_version" target="_blank" href="/index.php/article_version/<?php echo $version->getPrimaryKey(); ?>?uid=<?php echo $uid; ?>">Podgląd</a></li>
                  <?php if($version->getIsActive() == false): ?>
                      <li class="sf_admin_action_settings"><a href="<?php echo url_for('article_set_active_version', $version) ?>">Publikuj</a></li>
                      <li class="sf_admin_action_delete"><a href="<?php echo url_for('article_delete_version', $version) ?>">Usuń</a></li>
                  <?php endif; ?>
              </ul>
          </td>
      </tr>
      <?php endforeach; ?>
  </table>
  <input type="hidden" name="module" value="<?php echo $this->getModuleName() ?>" />
  <input type="hidden" name="id" value="<?php echo $articles->getPrimaryKey(); ?>" />
  <input type="submit" value="Usuń zaznaczone" />
  </form>
  <?php endif; ?>
</div>

<script>
jQuery(document).ready(function()
{
//    var is_open = readCookie("article_version_show_cookie");
//    if(is_open == 'true')
//    {
        hideArticleVersion();
//    }
//    else
//    {
//        showArticleVersion();
//    }

    jQuery('#all_version').click(function() {
        showArticleVersion();
        
        if(jQuery('#all_version').is(':checked'))
        {
            jQuery('.one_version').attr('checked', true);
        }
        else
        {
            jQuery('.one_version').attr('checked', false);
        }
    });

    jQuery('#hideArticleVersion').click(function() {
        hideArticleVersion();
        return false;
    });

    jQuery('#showArticleVersion').click(function() {
        showArticleVersion();
        return false;
    });

    function showArticleVersion()
    {
        jQuery('#hideArticleVersion').css('display', 'inline');
        jQuery('#showArticleVersion').css('display', 'none');
        jQuery('.table_version tr.unactive').show();
//        createCookie("article_version_show_cookie",false);
    }

    function hideArticleVersion()
    {
        jQuery('#hideArticleVersion').css('display', 'none');
        jQuery('#showArticleVersion').css('display', 'inline');
        jQuery('.table_version tr.unactive').hide();
//        createCookie("article_version_show_cookie",true);
    }

});
</script>

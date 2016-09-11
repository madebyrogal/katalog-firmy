<?php

function render_pager($pager, $object, $route, $get_url_string = '', $show_always = true) {
//  sfContext::getInstance()->getConfiguration()->loadHelpers(array('Url'));
  $get_url_string = $get_url_string ? '&'.$get_url_string : '';
  if ($show_always || $pager->haveToPaginate()) {
    echo '<div class="pagination">';

      echo '<div class="pagination_desc">';
        echo __('Ilość pozycji').': &nbsp<strong>'.count($pager).'</strong>';
      echo '</div>';

      if ($pager->haveToPaginate()) {
      echo '<div class="pagination_page">';
        echo __('Strona').': &nbsp<strong>'.$pager->getPage().'/'.$pager->getLastPage().'</strong>';
      echo '</div>';
      }

      $url = $object ? url_for($route, $object) : url_for($route);

      if ($pager->haveToPaginate()) {
      echo '<div class="pagination_pages_links">';
        echo link_to('<span><<</span>', $url . '?page=' . $pager->getFirstPage() . $get_url_string, array('class' => 'pagination_first'));
        echo link_to('<span><</span>', $url . '?page=' . $pager->getPreviousPage() . $get_url_string, array('class' => 'pagination_prev'));
        foreach ($pager->getLinks() as $page) {
          if ($page == $pager->getPage()) {
            echo '<span class="pager_active">'.$page.'</span>';
          }
          else {
            echo link_to($page, $url . '?page=' . $page . $get_url_string, array('class' => 'pagination_not_active'));
          }
        }
        echo link_to('<span>></span>', $url . '?page=' . $pager->getNextPage() . $get_url_string, array('class' => 'pagination_next'));
        echo link_to('<span>>></span>', $url . '?page=' . $pager->getLastPage() . $get_url_string, array('class' => 'pagination_last'));
      echo '</div>';
      }

    echo '</div>';
  }
}
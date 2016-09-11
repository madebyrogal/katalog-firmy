<?php

class Sitemap {

  public static function generateXML() {
    
//    T::cc('frontend');
    
    $xml = '';
    $xml .= '<?xml version="1.0" encoding="utf-8" ?>';
    $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">';

    $xml .= "\n";
    foreach (self::getAllUrls() as $url) {
      $xml .= '<url><loc>' .  $url . '</loc></url>';
      $xml .= "\n";
    }

    $xml .= '</urlset>';

    return $xml;
  }

  public static function getAllUrls() {
      $urls = array();

      // Strona główna
      $urls = array_merge($urls, self::getHomepageUrls());
	  
      // Articles
      $urls = array_merge($urls, self::getArticlesUrls());
	  
      // ArtCategories
      //$urls = array_merge($urls, self::getArtCategoriesUrls());
      // Produkty z katalogu
      //$urls = array_merge($urls, self::getCatalogProductsUrls());
      // Kategorie produktów z katalogu
      //$urls = array_merge($urls, self::getCatalogCategoriesUrls());
      // Product
      //$urls = array_merge($urls, self::getProductsUrls());
      // ProductCategory
      //$urls = array_merge($urls, self::getProductCategoriesUrls());
      // Producer
      //$urls = array_merge($urls, self::getProducersUrls());
      // Menu
	  $urls = array_merge($urls, self::getMenuUrls());
      
      $urls = array_merge($urls, self::getCategoriesUrls());
      
      $urls = array_merge($urls, self::getCompanyUrls());
		
      foreach ($urls as $key => $url) {
        if (substr($url, 0, 7) != 'http://') {
          unset($urls[$key]);
        }
      }

      return array_unique($urls);
  }

  // Strona główna
  public static function getHomepageUrls() {
      $urls = array();

      $urls[] = T::abs_url_for('homepage');

      return $urls;
  }
  
  public static function getCategoriesUrls() {
      $urls = array();

      $objects = Doctrine::getTable('Category')->findAll();
      foreach ($objects as $object) {       
        $urls[] = T::abs_url_for('category', $object);      
      }

      return $urls;
  }
  
  public static function getCompanyUrls() {
      $urls = array();

      $objects = Doctrine::getTable('Company')->findAll();
      foreach ($objects as $object) {       
        $urls[] = T::abs_url_for('company', $object);      
      }

      return $urls;
  }

  // Articles
  public static function getArticlesUrls() {
      $urls = array();

      $articles = Doctrine::getTable('Articles')->queryActiveRealArticles()->execute();
      foreach ($articles as $article) {
        foreach (Lang::getAllActiveObjects() as $lang) {
          if ($article->Translation[$lang->getLanguage()]['is_lang_active']) {
            $urls[] = T::abs_url_for('articles_show', $article, $lang->getLanguage());
          }
        }
      }

      return $urls;
  }

  // ArtCategories
  public static function getArtCategoriesUrls() {
      $urls = array();

      $artCategories = Doctrine::getTable('ArtCategories')->queryActiveRealArtCategories()->execute();
      foreach ($artCategories as $artCategory) {
        if ($artCategory->getLevel() > 0) {
          foreach (Lang::getAllActiveObjects() as $lang) {
            if ($artCategory->Translation[$lang->getLanguage()]['is_lang_active']) {
              $urls[] = T::abs_url_for('artcategory_show', $artCategory, $lang->getLanguage());
            }
          }
        }
      }

      return $urls;
  }

  // Produkty z katalogu
  public static function getCatalogProductsUrls() {
      $urls = array();

      $articles = Doctrine::getTable('Articles')->queryActiveCatalogProducts()->execute();
      foreach ($articles as $article) {
        foreach (Lang::getAllActiveObjects() as $lang) {
          if ($article->Translation[$lang->getLanguage()]['is_lang_active']) {
            $urls[] = T::abs_url_for('catalog_product_show', $article, $lang->getLanguage());
          }
        }
      }

      return $urls;
  }

  // Kategorie produktów z katalogu
  public static function getCatalogCategoriesUrls() {
      $urls = array();

      $artCategories = Doctrine::getTable('ArtCategories')->queryActiveCatalogArtCategories()->execute();
      foreach ($artCategories as $artCategory) {
        if ($artCategory->getLevel() > 0) {
          foreach (Lang::getAllActiveObjects() as $lang) {
            if ($artCategory->Translation[$lang->getLanguage()]['is_lang_active']) {
              $urls[] = T::abs_url_for('artcategory_show', $artCategory, $lang->getLanguage());
            }
          }
        }
      }

      return $urls;
  }

  // Product
  public static function getProductsUrls() {
      $urls = array();

      if (stgConfig::get('sell_enabled')) {
        $products = Doctrine::getTable('Product')->createQuery()->execute();
        foreach ($products as $product) {
          $urls[] = T::abs_url_for('product_show', $product);
        }
      }

      return $urls;
  }

  // ProductCategory
  public static function getProductCategoriesUrls() {
      $urls = array();

      if (stgConfig::get('sell_enabled')) {
        $productCategories = Doctrine::getTable('ProductCategory')->createQuery()->execute();
        foreach ($productCategories as $productCategory) {
          $urls[] = T::abs_url_for('product_category_show', $productCategory);
        }
      }

      return $urls;
  }

  // Producer
  public static function getProducersUrls() {
      $urls = array();

      if (stgConfig::get('sell_enabled')) {
        $producers = Doctrine::getTable('Producer')->createQuery()->execute();
        foreach ($producers as $producer) {
          $urls[] = T::abs_url_for('producer_show', $producer);
        }
      }

      return $urls;
  }

  // Menu
  public static function getMenuUrls() {
      $urls = array();

      $menu_links = Doctrine::getTable('Menus')->fetchByCultureNotDeleted();
      foreach ($menu_links as $menu_link) {
        if ($menu_link->getLevel() > 0) {
          $urls[] = Tools::prepareLink($menu_link, false, false);
        }
      }

      return $urls;
  }

}

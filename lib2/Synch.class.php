<?php

class Synch {

  static public function getProductFieldsMap() {
    return array(
      'pr_id' => 'erp_pr_id',
      'quantity' => 'quantity', //własny getter
//      'pr_aktywny' => '',
      'pr_symbol' => 'symbol',
      'pr_nazwa' => 'name',
      'pr_opis' => 'short_description',
      'vat' => 'vat', //własny getter
      'pr_jm' => 'unit',
      'pr_pkwiu' => 'code_pkwiu',
      'pr_sww' => 'code_sww',
      'pr_plu' => 'code_plu',
      'pr_kodkreskowy' => 'code_bar',
      'product_group_id' => 'product_group_id', //własny getter
      'producer_id' => 'producer_id', //własny getter
      'type' => 'type', //własny getter
//      'pr_rodzajid' => 'type',
      'pr_www' => 'www',
//      'pr_uwagi' => '',
      'pr_objetosc' => 'size',
      'pr_masa' => 'weight',
      'pr_charakterystyka' => 'description',
      'pr_kodcn' => 'code_cn',
      'pr_krajpochodzenia' => 'code_country',
      'pr_vatid' => 'erp_vat_id',
//      'prs_datamodyfikacji' => '',
    );
  }

  static public function getOrderFieldsMap() {
    return array(
//      'za_status' => 'order_status_id',
      'order_status_id' => 'order_status_id', //własny getter
    );
  }

  static public function getProductQuantityFieldsMap() {
    return array(
      'prs_stan' => 'quantity',
    );
  }

  static public function getTariffFieldsMap() {
    return array(
      'cn_id' => 'erp_cn_id',
      'cn_nazwa' => 'name',
    );
  }

  static public function getProductPriceFieldsMap() {
    return array(
      'price_netto' => 'price_netto', //własny getter
      'price_brutto' => 'price_brutto', //własny getter
    );
  }

  static public function getProductGroupFieldsMap() {
    return array(
      'slg_id' => 'erp_slg_id',
      'slg_nazwa' => 'name',
    );
  }

  static public function getProductFlagFieldsMap() {
    return array(
      'chp_id' => 'erp_chp_id',
      'chp_nazwa' => 'name',
    );
  }

  static public function getProductCustomFieldFieldsMap() {
    return array(
      'spr_id' => 'erp_spr_id',
      'spr_nazwa' => 'name',
      'spr_typ' => 'type',
    );
  }

  static public function getProfileCustomFieldFieldsMap() {
    return array(
      'spk_id' => 'erp_spk_id',
      'spk_nazwa' => 'name',
      'spk_typ' => 'type',
    );
  }

  static public function getProductCustomFieldValueFieldsMap() {
    return array(
      'ppw_wartosc' => 'value',
    );
  }

  static public function getOrderCustomFieldFieldsMap() {
    return array(
      'order_id' => 'order_id', //własny getter
      'zpw_id' => 'erp_zpw_id',
      'zpw_nazwa' => 'name',
      'zpw_wartosc' => 'value',
    );
  }

  static public function getProducerFieldsMap() {
    return array(
      'pc_id' => 'erp_pc_id',
      'pc_nazwa' => 'name',
//      'record_key' => 'record_key',
    );
  }

  static public function getProductPictureFieldsMap() {
    return array(
      'zd_glowne' => 'is_default',
      'file_url' => 'file_by_url', //własny getter + wlasny setter
    );
  }

  static public function getDiscountFieldsMap() {
    return array(
      'pm_id' => 'erp_pm_id',
      'pm_wartosc' => 'discount_value',
      'pm_dataod' => 'time_start',
      'pm_datado' => 'time_end',
      'tariff_id' => 'tariff_id', //własny getter
    );
  }

  static public function populateByErp($fieldsMapMethod, $object, $erpObject) {
    $is_changed = false;

    // dla każdego pola, które trzeba synchronizować
    foreach (self::$fieldsMapMethod() as $erp_field => $sell_field) {
      // wartość pola w Erp
      $erpValue = $erpObject->get($erp_field);
//if ($fieldsMapMethod == 'getProductPictureFieldsMap') {
//var_dump($erpValue);
//var_dump('---');
//}
      // wartość pola w Sell
      $sellValue = $object->get($sell_field);
//if ($fieldsMapMethod == 'getProductPictureFieldsMap') {
//var_dump($sellValue);
//var_dump('+++');
//}

      // jeśli są różne
      if ($sellValue != $erpValue) {
        // ustaw w Sell wartość z Erp
        $object->set($sell_field, $erpValue);
        $is_changed = true;
      }
    }

    return $is_changed;
  }

}

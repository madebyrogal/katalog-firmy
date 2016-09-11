<?php

class stgGapi extends gapi
{
  public static function isValid() {
    $temp = new stgGapi();
    return $temp->auth_token ? true : false;
  }

  public function __construct()
  {
      try {
        parent::__construct(Tools::getValueKey('google_analytics_login'),Tools::getValueKey('google_analytics_password'));
      } catch (Exception $e) {
          return null;
      }
//    parent::__construct(Tools::getValueKey('google_analytics_login'),Tools::getValueKey('google_analytics_password'));
  }

  public function getReport($dimensions, $metrics, $sort_metric=null, $filter=null, $start_index=1, $max_results=30)
  {
    $report_id = Tools::getValueKey('google_analytics_profile_id');
    $start_date = date("Y-m-d", strtotime(Tools::getValueKey('google_analytics_start_date')));
    $end_date = date("Y-m-d", strtotime(Tools::getValueKey('google_analytics_end_date')));

    try {
      $results = parent::requestReportData($report_id, $dimensions, $metrics, $sort_metric, $filter, $start_date, $end_date, $start_index, $max_results);
      $report = array();
      $report['results'] = $results;

      $report['dimensions'] = $dimensions;
      $report['metrics'] = $metrics;

      $report['updated'] = $this->getUpdated();

      $report['total'] = array();
      foreach ($report['metrics'] as $metric) {
        $report['total'][$metric] = self::getParam($this, $metric);
      }

      return $report;
    }
    catch (Exception $e) {
      return null;
    }
  }

  /**
   * Zwraca gettera dla parametru,
   * np. dla parametru 'name' zwroci 'getName'
   */
  public static function getGetter($param_name)
  {
    return 'get'.substr_replace($param_name, strtoupper($param_name[0]), 0, 1);
  }

  /**
   * Zwraca parametr danego obiektu za pomocą gettera
   */
  public static function getParam($object, $param_name)
  {
    $getter = self::getGetter($param_name);
    return $object->$getter();
  }

  /**
   * Zamienia date w formacie Google (YYYYMMDD) na DD.MM.YYYY
   */
  public static function formatDate($date)
  {
    $year = substr($date,0,4);
    $month = substr($date,4,2);
    $day = substr($date,6,2);
    return $day.'.'.$month.'.'.$year;
  }
}
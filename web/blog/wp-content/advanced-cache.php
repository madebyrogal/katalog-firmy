<?php
$hyper_cache['path'] = "/web/blog/wp-content/cache/";
$hyper_cache['charset']= "UTF-8";
$hyper_cache['comment'] = true;
$hyper_cache['archive'] = true;
$hyper_cache['timeout'] = 1440;
$hyper_cache['load'] = 17;
$hyper_cache['expire_type'] = "post";
$hyper_cache['redirects'] = true;
$hyper_cache['notfound'] = true;
$hyper_cache['mobile'] = false;
$hyper_cache['plugin_mobile_pack'] = false;
$hyper_cache['feed'] = false;
$hyper_cache['cache_qs'] = false;
$hyper_cache['strip_qs'] = false;
$hyper_cache['home'] = false;
$hyper_cache['smarthome'] = false;
$hyper_cache['lastmodified'] = false;
$hyper_cache['gzip'] = true;
$hyper_cache['store_compressed'] = true;
$hyper_cache['reject'] = false;
$hyper_cache['reject_agents'] = false;
$hyper_cache['reject_cookies'] = false;
if(!defined("HYPER_CACHE_EXTENDED_OPTIONS") || HYPER_CACHE_EXTENDED_OPTIONS!="yes"){
	include(WP_CONTENT_DIR . '/plugins/hyper-cache-extended/cache.php');
}
define('HYPER_CACHE_EXTENDED', '1.6.1');
?>
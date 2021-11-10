<?php
defined('ABSPATH') or die('No script kiddies please!');
if(!class_exists('TrustindexPlugin'))
{
$plugin_dirs = scandir(WP_PLUGIN_DIR);
$ti_plugins = [];
foreach($plugin_dirs as $dir)
{
$class_file = WP_PLUGIN_DIR . '/' . $dir . '/trustindex-plugin.class.php';
if($dir == '.' || $dir == '..' || !is_dir(WP_PLUGIN_DIR . '/' . $dir) || !file_exists($class_file) || $dir == 'customer-reviews-for-woocommerce')
{
continue;
}
$second_line = array_slice(file($class_file), 1, 1)[0];
$ti_plugins[$class_file] = (substr($second_line , 0, 14) == '/* GENERATED: ' ? (int)preg_replace('/[^\d]/m', '', $second_line) : 0);
}
$plugin_file = array_search(max($ti_plugins), $ti_plugins);
if(empty($plugin_file))
{
$plugin_file = "trustindex-plugin.class.php";
}
require_once($plugin_file);
}
?>
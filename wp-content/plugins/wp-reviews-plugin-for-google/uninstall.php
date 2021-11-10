<?php
require_once plugin_dir_path( __FILE__ ) . 'plugin-load.php';
$trustindex_pm_google = new TrustindexPlugin("google", __FILE__, "7.3", "Widgets for Google Reviews", "Google");
$trustindex_pm_google->uninstall();
?>
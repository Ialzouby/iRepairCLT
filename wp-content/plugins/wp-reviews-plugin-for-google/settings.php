<?php
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
if (!current_user_can('edit_pages'))
{
die('The account you\'re logged in to doesn\'t have permission to access this page.');
}
if(isset($_GET['rate_us']))
{
switch(sanitize_text_field($_GET['rate_us']))
{
case 'open':
update_option($trustindex_pm_google->get_option_name('rate-us'), 'hide', false);
$url = 'https://wordpress.org/support/plugin/'. $trustindex_pm_google->get_plugin_slug() . '/reviews/?rate=5#new-post';
header('Location: '. $url);
die;
case 'later':
$time = time() + (30 * 86400);
update_option($trustindex_pm_google->get_option_name('rate-us'), $time, false);
break;
case 'hide':
update_option($trustindex_pm_google->get_option_name('rate-us'), 'hide', false);
break;
}
echo "<script type='text/javascript'>self.close();</script>";
die;
}
if(isset($_GET['wc_notification']))
{
switch(sanitize_text_field($_GET['wc_notification']))
{
case 'open':
update_option('trustindex-wc-notification', 'hide', false);
$url = 'https://wordpress.org/plugins/customer-reviews-for-woocommerce/';
header('Location: '. $url);
die;
case 'hide':
update_option('trustindex-wc-notification', 'hide', false);
break;
}
echo "<script type='text/javascript'>self.close();</script>";
die;
}
if(isset($_GET['test_proxy']))
{
delete_option($trustindex_pm_google->get_option_name('proxy-check'));
header('Location: admin.php?page=' . sanitize_text_field($_GET['page']) .'&tab=' . sanitize_text_field($_GET['tab']));
exit;
}
$tabs = [];
if($trustindex_pm_google->is_trustindex_connected())
{
$default_tab = 'setup_trustindex_join';
$tabs[ 'Trustindex admin' ] = "setup_trustindex_join";
$tabs[ TrustindexPlugin::___("Free Widget Configurator") ] = "setup_no_reg";
}
else
{
$default_tab = 'setup_no_reg';
$tabs[ TrustindexPlugin::___("Free Widget Configurator") ] = "setup_no_reg";
}
if($trustindex_pm_google->is_noreg_linked())
{
$tabs[ TrustindexPlugin::___("My Reviews") ] = "my_reviews";
}
$tabs[ TrustindexPlugin::___('Get Reviews') ] = "get_reviews";
$tabs[ TrustindexPlugin::___('Rate Us') ] = "rate";
if(!$trustindex_pm_google->is_trustindex_connected())
{
$tabs[ TrustindexPlugin::___('Get more Features') ] = "setup_trustindex";
$tabs[ TrustindexPlugin::___('Log In') ] = "setup_trustindex_join";
}
$tabs[ TrustindexPlugin::___('Troubleshooting') ] = "troubleshooting";
$selected_tab = isset($_GET['tab']) ? sanitize_text_field($_GET['tab']) : null;
$subtabs = null;
$found = false;
foreach($tabs as $tab)
{
if(is_array($tab))
{
if(array_search($selected_tab, $tab) !== FALSE)
{
$found = true;
break;
}
}
else
{
if($selected_tab == $tab)
{
$found = true;
break;
}
}
}
if(!$found)
{
$selected_tab = $default_tab;
}
$http_blocked = false;
if(defined('WP_HTTP_BLOCK_EXTERNAL') && WP_HTTP_BLOCK_EXTERNAL)
{
if(!defined('WP_ACCESSIBLE_HOSTS') || strpos(WP_ACCESSIBLE_HOSTS, '*.trustindex.io') === FALSE)
{
$http_blocked = true;
}
}
$proxy = new WP_HTTP_Proxy();
$proxy_check = true;
if($proxy->is_enabled())
{
$opt_name = $trustindex_pm_google->get_option_name('proxy-check');
$db_data = get_option($opt_name, "");
if(!$db_data)
{
$response = wp_remote_post("https://admin.trustindex.io/" . "api/userCheckLoggedIn", [
'timeout' => '30',
'redirection' => '5',
'blocking' => true
]);
if(is_wp_error($response))
{
$proxy_check = $response->get_error_message();
update_option($opt_name, $response->get_error_message(), false);
}
else
{
update_option($opt_name, 1, false);
}
}
else
{
if($db_data !== '1')
{
$proxy_check = $db_data;
}
}
}
?>
<div id="ti-assets-error" class="notice notice-warning" style="display: none; margin-left: 0; margin-right: 0; padding-bottom: 9px">
<p>
<?php echo TrustindexPlugin::___("You got an error while trying to run this plugin. Please upgrade all the plugins from Trustindex and if the error still persist send the content of the webserver's error log and the content of the Troubleshooting tab to the support!"); ?>
</p>
<a href="?page=<?php echo esc_attr($_GET['page']); ?>&tab=troubleshooting" class="button button-primary"><?php echo TrustindexPlugin::___("Troubleshooting") ;?></a>
</div>
<script type="text/javascript">
window.onload = function() {
let warning_box = document.getElementById("ti-assets-error");
let link = document.head.querySelector('link[href*="static/css/admin-page-settings.css"]');
if(typeof Trustindex_Autocomplete == "undefined" || typeof TI_copyTextToClipboard == "undefined" || !link || !Boolean(link.sheet))
{
warning_box.style.display = "block";
}
};
</script>
<div id="trustindex-plugin-settings-page" class="ti-toggle-opacity">
<h1 class="ti-free-title">
<?php echo TrustindexPlugin::___("Widgets for Google Reviews"); ?>
<a href="https://www.trustindex.io/ti-redirect.php?a=sys&c=wp-google-l" target="_blank" title="Trustindex" class="ti-pull-right">
<img src="<?php echo $trustindex_pm_google->get_plugin_file_url('static/img/trustindex.svg'); ?>" />
</a>
</h1>
<div class="container_wrapper">
<div class="container_cell" id="container-main">
<?php if($http_blocked): ?>
<div class="ti-box ti-notice-error">
<p>
<?php echo TrustindexPlugin::___("Your site cannot download our widget templates, because of your server settings not allowing that:"); ?><br /><a href="https://wordpress.org/support/article/editing-wp-config-php/#block-external-url-requests" target="_blank">https://wordpress.org/support/article/editing-wp-config-php/#block-external-url-requests</a><br /><br />
<strong><?php echo TrustindexPlugin::___("Solution"); ?></strong><br />
<?php echo TrustindexPlugin::___("a) You should define <strong>WP_HTTP_BLOCK_EXTERNAL</strong> as false"); ?><br />
<?php echo TrustindexPlugin::___("b) or you should add Trustindex as an <strong>WP_ACCESSIBLE_HOSTS</strong>: \"*.trustindex.io\""); ?><br />
</p>
</div>
<?php endif; ?>
<?php if($proxy_check !== TRUE): ?>
<div class="ti-box ti-notice-error">
<p>
<?php echo TrustindexPlugin::___("It seems you are using a proxy for HTTP requests but after a test request it returned a following error:"); ?><br />
<strong><?php echo $proxy_check; ?></strong><br /><br />
<?php echo TrustindexPlugin::___("Therefore, our plugin might not work properly. Please, contact your hosting support, they can resolve this easily."); ?>
</p>
<a href="?page=<?php echo esc_attr($_GET['page']); ?>&tab=<?php echo esc_attr($_GET['tab']); ?>&test_proxy" class="btn-text btn-refresh" data-loading-text="<?php echo TrustindexPlugin::___("Loading") ;?>"><?php echo TrustindexPlugin::___("Test again") ;?></a>
</div>
<?php endif; ?>
<div class="nav-tab-wrapper">
<?php foreach($tabs as $tab_name => $tab): ?>
<?php
$is_active = $selected_tab == $tab;
$action = $tab;
if(is_array($tab))
{
$is_active = array_search($selected_tab, $tab) !== FALSE;
$action = array_shift(array_values($tab));
if($is_active)
{
$subtabs = $tab;
}
}
?>
<a
id="link-tab-<?php echo esc_attr($action); ?>"
class="nav-tab<?php if($is_active): ?> nav-tab-active<?php endif; ?><?php if($tab == 'troubleshooting'): ?> nav-tab-right<?php endif; ?>"
href="<?php echo admin_url('admin.php?page='.$trustindex_pm_google->get_plugin_slug().'/settings.php&tab='. esc_attr($action)); ?>"
><?php echo esc_html($tab_name); ?></a>
<?php endforeach; ?>
</div>
<?php if($subtabs): ?>
<div class="nav-tab-wrapper sub-nav">
<?php foreach($subtabs as $tab_name => $tab): ?>
<a
id="link-tab-<?php echo esc_attr($tab); ?>"
class="nav-tab<?php if($selected_tab == $tab): ?> nav-tab-active<?php endif; ?>"
href="<?php echo admin_url('admin.php?page='.$trustindex_pm_google->get_plugin_slug().'/settings.php&tab='. esc_attr($tab)); ?>"
><?php echo esc_html($tab_name); ?></a>
<?php endforeach; ?>
</div>
<?php endif; ?>
<div id="tab-<?php echo esc_attr($selected_tab); ?>">
<?php include( plugin_dir_path(__FILE__ ) . "tabs/".$selected_tab.".php" ); ?>
</div>
</div>

</div>
</div>
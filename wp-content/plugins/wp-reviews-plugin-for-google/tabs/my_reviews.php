<?php
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
if(isset($_COOKIE['ti-success']))
{
$ti_success = sanitize_text_field($_COOKIE['ti-success']);
setcookie('ti-success', '', time() - 60, "/");
if($ti_success == 'reviews-loaded')
{
update_option( $trustindex_pm_google->get_option_name('download-timestamp') , time() + (86400 * 2), false);
}
}
if(isset($_POST['save-highlight']))
{
check_admin_referer( 'save-noreg_'.$trustindex_pm_google->get_plugin_slug(), '_wpnonce_highlight_save' );
$id = null;
$start = null;
$length = null;
if(isset($_POST['id']))
{
$id = intval(sanitize_text_field($_POST['id']));
}
if(isset($_POST['start']))
{
$start = sanitize_text_field($_POST['start']);
}
if(isset($_POST['length']))
{
$length = sanitize_text_field($_POST['length']);
}
if($id)
{
$highlight = "";
if(!is_null($start))
{
$highlight = $start . ',' . $length;
}
$wpdb->query("UPDATE `". $trustindex_pm_google->get_noreg_tablename() ."` SET highlight = '$highlight' WHERE id = '$id'");
}
exit;
}
$reviews = [];
if($trustindex_pm_google->is_noreg_linked() && $trustindex_pm_google->is_noreg_table_exists())
{
$reviews = $wpdb->get_results('SELECT * FROM '. $trustindex_pm_google->get_noreg_tablename() .' ORDER BY date DESC');
}
function trustindex_plugin_write_rating_stars($score)
{
global $trustindex_pm_google;
if($trustindex_pm_google->is_ten_scale_rating_platform())
{
return '<div class="ti-rating-box">'. $trustindex_pm_google->formatTenRating($score) .'</div>';
}
$text = "";
$link = "https://cdn.trustindex.io/assets/platform/".ucfirst("google")."/star/";
if(!is_numeric($score))
{
return $text;
}
for ($si = 1; $si <= $score; $si++)
{
$text .= '<img src="'. $link .'f.svg" class="ti-star" />';
}
$fractional = $score - floor($score);
if( 0.25 <= $fractional )
{
if ( $fractional < 0.75 )
{
$text .= '<img src="'. $link .'h.svg" class="ti-star" />';
}
else
{
$text .= '<img src="'. $link .'f.svg" class="ti-star" />';
}
$si++;
}
for (; $si <= 5; $si++)
{
$text .= '<img src="'. $link .'e.svg" class="ti-star" />';
}
return $text;
}
wp_enqueue_style('trustindex-widget-css', 'https://cdn.trustindex.io/assets/widget-presetted-css/4-light-background.css');
wp_enqueue_script('trustindex-review-js', 'https://cdn.trustindex.io/assets/js/trustindex-review.js', [], false, true);
wp_add_inline_script('trustindex-review-js', '
jQuery(".ti-review-content").TI_shorten({
"showLines": 2,
"lessText": "'. TrustindexPlugin::___("Show less") .'",
"moreText": "'. TrustindexPlugin::___("Show more") .'",
});
jQuery(".ti-review-content").TI_format();
');
$download_timestamp = get_option($trustindex_pm_google->get_option_name('download-timestamp'), time() - 1);
?>
<?php if(!$trustindex_pm_google->is_noreg_linked()): ?>
<div class="notice notice-warning" style="margin-left: 0">
<p><?php echo TrustindexPlugin::___("Connect your %s platform to download reviews.", ["Google"]); ?></p>
</div>
<?php else: ?>
<?php if($trustindex_pm_google->is_trustindex_connected() && in_array($selected_tab, [ 'setup_no_reg', 'my_reviews' ])): ?>
<div class="notice notice-warning" style="margin: 0 0 15px 0">
<p>
<?php echo TrustindexPlugin::___("You have connected your Trustindex account, so you can find premium functionality under the \"%s\" tab. You no longer need this tab unless you choose the limited but forever free mode.", ["Trustindex admin"]); ?>
</p>
</div>
<?php endif; ?>
<div class="ti-box">
<div class="ti-header"><?php echo TrustindexPlugin::___("My Reviews"); ?></div>
<?php if($download_timestamp < time()): ?>
<div class="tablenav top" style="margin-bottom: 15px">
<div class="alignleft actions">
<a href="?page=<?php echo esc_attr($_GET['page']); ?>&tab=setup_no_reg&refresh&my_reviews" class="btn-text btn-refresh btn-download-reviews" style="margin-left: 0" data-loading-text="<?php echo TrustindexPlugin::___("Loading") ;?>" data-delay=10><?php echo TrustindexPlugin::___("Download new reviews") ;?></a>
</div>
</div>
<?php endif; ?>
<?php if(isset($ti_success) && $ti_success == "reviews-loaded"): ?>
<div class="notice notice-success is-dismissible" style="margin: 0 0 15px 0">
<p><?php echo TrustindexPlugin::___("New reviews loaded!"); ?></p>
</div>
<?php endif; ?>
<?php if(!$trustindex_pm_google->is_trustindex_connected() && $download_timestamp < time()): ?>
<div class="notice notice-error" style="margin: 0 0 15px 0">
<p>
<?php echo TrustindexPlugin::___("Don't want to waste your time by updating your reviews every week? <a href='%s' target='_blank'>Create a free Trustindex account! »</a>", [ 'https://www.trustindex.io/ti-redirect.php?a=sys&c=wp-google-l' ]); ?>
</p>
</div>
<?php endif; ?>
<?php if(!count($reviews)): ?>
<div class="notice notice-warning" style="margin-left: 0">
<p><?php echo TrustindexPlugin::___("You had no reviews at the time of last review downloading."); ?></p>
</div>
<?php else: ?>
<table class="wp-list-table widefat fixed striped table-view-list ti-my-reviews ti-widget">
<thead>
<tr>
<th class="text-center"><?php echo TrustindexPlugin::___("Reviewer"); ?></th>
<th class="text-center" style="width: 90px;"><?php echo TrustindexPlugin::___("Rating"); ?></th>
<th class="text-center"><?php echo TrustindexPlugin::___("Date"); ?></th>
<th style="width: 48%"><?php echo TrustindexPlugin::___("Text"); ?></th>
<th></th>
</tr>
</thead>
<tbody>
<?php foreach ($reviews as $review): ?>
<tr data-id="<?php echo esc_attr($review->id); ?>">
<td class="text-center">
<img src="<?php echo esc_url($review->user_photo); ?>" class="ti-user-avatar" /><br />
<?php echo esc_html($review->user); ?>
</td>
<td class="text-center source-<?php echo ucfirst("google") ?>"><?php echo trustindex_plugin_write_rating_stars($review->rating); ?></td>
<td class="text-center"><?php echo esc_html($review->date); ?></td>
<td><div class="ti-review-content"><?php echo $trustindex_pm_google->getReviewHtml($review); ?></div></td>
<td>
<a href="<?php echo esc_attr($review->id); ?>" class="btn-text btn-highlight<?php if(isset($review->highlight) && $review->highlight): ?> has-highlight<?php endif; ?>" style="margin-left: 0"><?php echo TrustindexPlugin::___("Highlight text") ;?></a>
</td>
</tr>
<?php endforeach; ?>
</tbody>
</table>
<?php endif; ?>
</div>
<!-- Modal -->
<div class="ti-modal" id="ti-highlight-modal">
<?php wp_nonce_field( 'save-noreg_'.$trustindex_pm_google->get_plugin_slug(), '_wpnonce_highlight_save' ); ?>
<div class="ti-modal-dialog">
<div class="ti-modal-content">
<div class="ti-modal-header">
<span class="ti-modal-title"><?php echo TrustindexPlugin::___("Highlight text") ;?></span>
</div>
<div class="ti-modal-body">
<?php echo TrustindexPlugin::___("Just select the text you want to highlight") ;?>:
<div class="ti-highlight-content"></div>
</div>
<div class="ti-modal-footer">
<a href="#" class="btn-text btn-modal-close"><?php echo TrustindexPlugin::___("Back") ;?></a>
<a href="#" class="btn-text btn-primary btn-highlight-confirm" data-loading-text="<?php echo TrustindexPlugin::___("Loading") ;?>"><?php echo TrustindexPlugin::___("Save") ;?></a>
<a href="#" class="btn-text btn-danger btn-highlight-remove" style="position: absolute; left: 15px" data-loading-text="<?php echo TrustindexPlugin::___("Loading") ;?>"><?php echo TrustindexPlugin::___("Remove highlight") ;?></a>
</div>
</div>
</div>
</div>
<?php endif; ?>
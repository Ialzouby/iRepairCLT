<?php include( plugin_dir_path(__FILE__ ) . "setup_no_reg_header.php" ); ?>
<ul class="ti-free-steps">
<li class="<?php echo !$trustindex_pm_google->is_noreg_linked() ? "active" : "done"; ?><?php if($current_step == 1): ?> current<?php endif; ?>" href="?page=<?php echo esc_attr($_GET['page']); ?>&tab=setup_no_reg&step=1">
<span>1</span>
<?php echo TrustindexPlugin::___('Connect %s platform', [ 'Google' ]); ?>
</li>
<span class="ti-free-arrow"></span>
<li class="<?php echo $style_id ? "done" : ($trustindex_pm_google->is_noreg_linked() ? "active" : ""); ?><?php if($current_step == 2): ?> current<?php endif; ?>" href="?page=<?php echo esc_attr($_GET['page']); ?>&tab=setup_no_reg&step=2">
<span>2</span>
<?php echo TrustindexPlugin::___('Select Layout'); ?>
</li>
<span class="ti-free-arrow"></span>
<li class="<?php echo $scss_set ? "done" : ($style_id ? "active" : ""); ?><?php if($current_step == 3): ?> current<?php endif; ?>" href="?page=<?php echo esc_attr($_GET['page']); ?>&tab=setup_no_reg&step=3">
<span>3</span>
<?php echo TrustindexPlugin::___('Select Style'); ?>
</li>
<span class="ti-free-arrow"></span>
<li class="<?php echo $widget_setted_up ? "done" : ($scss_set ? "active" : ""); ?><?php if($current_step == 4): ?> current<?php endif; ?>" href="?page=<?php echo esc_attr($_GET['page']); ?>&tab=setup_no_reg&step=4">
<span>4</span>
<?php echo TrustindexPlugin::___('Set up widget'); ?>
</li>
<span class="ti-free-arrow"></span>
<li class="<?php echo $widget_setted_up ? "active" : ""; ?><?php if($current_step == 5): ?> current<?php endif; ?>" href="?page=<?php echo esc_attr($_GET['page']); ?>&tab=setup_no_reg&step=5">
<span>5</span>
<?php echo TrustindexPlugin::___('Insert code'); ?>
</li>
</ul>
<?php if($trustindex_pm_google->is_trustindex_connected() && in_array($selected_tab, [ 'setup_no_reg', 'my_reviews' ])): ?>
<div class="notice notice-warning" style="margin: 0 0 15px 0">
<p>
<?php echo TrustindexPlugin::___("You have connected your Trustindex account, so you can find premium functionality under the \"%s\" tab. You no longer need this tab unless you choose the limited but forever free mode.", ["Trustindex admin"]); ?>
</p>
</div>
<?php endif; ?>
<?php if($show_nonce_notification): ?>
<div class="notice notice-warning is-dismissible" id="ti-widget-nonce-notification" style="margin: 0 0 15px 0">
<p>
<?php echo TrustindexPlugin::___("If the widgets are there, but still hidden:"); ?>
 <a href="?page=<?php echo esc_attr($_GET['page']); ?>&tab=troubleshooting"><?php echo TrustindexPlugin::___("More info"); ?></a>
</p>
</div>
<?php endif; ?>
<?php
$reviews = [];
if($trustindex_pm_google->is_noreg_linked())
{
$reviews = $wpdb->get_results('SELECT * FROM '. $trustindex_pm_google->get_noreg_tablename() .' ORDER BY date DESC');
}
?>
<?php if($current_step == 1 || !$trustindex_pm_google->is_noreg_linked()): ?>
<h1 class="ti-free-title">
1. <?php echo TrustindexPlugin::___('Connect %s platform', [ 'Google' ]); ?>
</h1>
<?php if($trustindex_pm_google->is_noreg_linked()): ?>
<?php $page_details = get_option($trustindex_pm_google->get_option_name('page-details')); ?>
<div class="ti-source-box">
<?php if(isset($page_details['avatar_url'])): ?>
<img src="<?php echo esc_url($page_details['avatar_url']); ?>" />
<?php endif; ?>
<div class="ti-source-info">
<strong><?php echo esc_html($page_details['name']); ?></strong><br />
<?php if ($page_details['address']): ?>
<?php echo esc_html($page_details['address']); ?><br />
<?php endif; ?>
<a href="<?php echo esc_url($trustindex_pm_google->getPageUrl()); ?>" target="_blank"><?php echo esc_url($trustindex_pm_google->getPageUrl()); ?></a>
</div>
<a href="?page=<?php echo esc_attr($_GET['page']); ?>&tab=setup_no_reg&command=delete-page"><button class="btn btn-text btn-disconnect"><?php echo TrustindexPlugin::___("Disconnect") ;?></button></a>
<div class="clear"></div>
</div>
<?php else: ?>
<div class="ti-box">
<form method="post" action="" data-platform="google" id="submit-form">
<input type="hidden" name="command" value="save-page" />
<?php wp_nonce_field( 'save-noreg_'.$trustindex_pm_google->get_plugin_slug(), '_wpnonce_save' ); ?>
<input type="hidden"
name="page_details"
class="form-control"
required="required"
id="ti-noreg-page_details"
value=""
/>
<div class="autocomplete">
<?php include( plugin_dir_path(__FILE__ ) . "setup_no_reg_platform.php" ); ?>
</div>
<div class="ti-selected-source">
<label class="ti-left-label"><?php echo TrustindexPlugin::___("Source"); ?>:</label>
<div class="ti-source-box ti-original-source-box">
<img />
<div class="ti-source-info">
<strong id="label-noreg-page_name"></strong><br />
<span id="label-noreg-address"></span>
<span id="label-noreg-url"></span>
</div>
<button class="btn btn-text btn-connect" data-loading-text="<?php echo TrustindexPlugin::___("Loading") ;?>"><?php echo TrustindexPlugin::___("Connect") ;?></button>
</div>
<div class="clear"></div>
</div>
</form>
</div>
<?php endif; ?>
<div class="ti-box">
<div class="ti-header"><?php echo TrustindexPlugin::___('See a %s Widget example below:', [ 'Google Reviews' ]); ?></div>
<div class="ti-preview-box">
<?php echo $trustindex_pm_google->get_trustindex_widget('2d9bf9019f8d93ad1430e9135'); ?>
</div>
</div>

<?php elseif($current_step == 2 || !$style_id): ?>
<h1 class="ti-free-title">
2. <?php echo TrustindexPlugin::___('Select Layout'); ?>
<a href="?page=<?php echo esc_attr($_GET['page']); ?>&tab=setup_no_reg&step=1" class="ti-back-icon"><?php echo TrustindexPlugin::___('Back'); ?></a>
</h1>
<?php if(!count($reviews)): ?>
<div class="notice notice-warning" style="margin: 0 0 15px 0">
<p>
<?php echo TrustindexPlugin::___('There are no reviews on your %s platform.', [ 'Google' ]); ?>
</p>
</div>
<?php include( plugin_dir_path(__FILE__ ) . "demo_widgets.php" ); ?>
<?php else: ?>
<div class="ti-filter-row">
<label><?php echo TrustindexPlugin::___('Layout'); ?>:</label>
<span class="ti-checkbox">
<input type="radio" name="layout-select" value="" data-ids="" checked>
<label><?php echo TrustindexPlugin::___('All'); ?></label>
</span>
<?php foreach(TrustindexPlugin::$widget_templates['categories'] as $category => $ids): ?>
<span class="ti-checkbox">
<input type="radio" name="layout-select" value="<?php echo esc_attr($category); ?>" data-ids="<?php echo esc_attr($ids); ?>">
<label><?php echo esc_html(TrustindexPlugin::___(ucfirst($category))); ?></label>
</span>
<?php endforeach; ?>
</div>
<div class="ti-preview-boxes-container">
<?php foreach(TrustindexPlugin::$widget_templates['templates'] as $id => $template): ?>
<?php
$class_name = 'ti-full-width';
if(in_array($template['type'], [ 'badge', 'button', 'floating', 'popup', 'sidebar' ]))
{
$class_name = 'ti-half-width';
}
?>
<div class="<?php echo esc_attr($class_name); ?>">
<div class="ti-box ti-preview-boxes" data-layout-id="<?php echo esc_attr($id); ?>" data-set-id="light-background">
<div class="ti-header">
<span class="ti-header-layout-text">
<?php echo TrustindexPlugin::___('Layout'); ?>:
<strong><?php echo esc_html(TrustindexPlugin::___($template['name'])); ?></strong>
</span>
<a href="?page=<?php echo $_GET['page']; ?>&tab=setup_no_reg&command=save-style&style_id=<?php echo esc_attr(urlencode($id)); ?>" class="btn-text btn-refresh ti-pull-right" data-loading-text="<?php echo TrustindexPlugin::___("Loading") ;?>"><?php echo TrustindexPlugin::___("Select") ;?></a>
<div class="clear"></div>
</div>
<div class="preview">
<?php echo $trustindex_pm_google->get_noreg_list_reviews(null, true, $id, 'light-background', true); ?>
</div>
</div>
</div>
<?php endforeach; ?>
</div>
<?php endif; ?>
<?php elseif($current_step == 3 || !$scss_set): ?>
<h1 class="ti-free-title">
3. <?php echo TrustindexPlugin::___('Select Style'); ?>
<a href="?page=<?php echo esc_attr($_GET['page']); ?>&tab=setup_no_reg&step=2" class="ti-back-icon"><?php echo TrustindexPlugin::___('Back'); ?></a>
</h1>
<?php if(!count($reviews)): ?>
<div class="notice notice-warning" style="margin: 0 0 15px 0">
<p>
<?php echo TrustindexPlugin::___('There are no reviews on your %s platform.', [ 'Google' ]); ?>
</p>
</div>
<?php else: ?>
<?php
$class_name = 'ti-full-width';
if(in_array(TrustindexPlugin::$widget_templates['templates'][$style_id]['type'], [ 'badge', 'button', 'floating', 'popup', 'sidebar' ]))
{
$class_name = 'ti-half-width';
}
?>
<div class="ti-preview-boxes-container">
<?php foreach(TrustindexPlugin::$widget_styles as $id => $name): ?>
<div class="<?php echo esc_attr($class_name); ?>">
<div class="ti-box ti-preview-boxes" data-layout-id="<?php echo esc_attr($style_id); ?>" data-set-id="<?php echo esc_attr($id); ?>">
<div class="ti-header">
<span class="ti-header-layout-text">
<?php echo TrustindexPlugin::___('Style'); ?>:
<strong><?php echo TrustindexPlugin::___($name); ?></strong>
</span>
<a href="?page=<?php echo esc_attr($_GET['page']); ?>&tab=setup_no_reg&command=save-set&set_id=<?php echo esc_attr(urlencode($id)); ?>" class="btn-text btn-refresh ti-pull-right" data-loading-text="<?php echo TrustindexPlugin::___("Loading") ;?>"><?php echo TrustindexPlugin::___("Select") ;?></a>
<div class="clear"></div>
</div>
<div class="preview">
<?php echo $trustindex_pm_google->get_noreg_list_reviews(null, true, $style_id, $id, true); ?>
</div>
</div>
</div>
<?php endforeach; ?>
</div>
<?php endif; ?>
<?php elseif($current_step == 4 || !$widget_setted_up): ?>
<?php
$widget_type = TrustindexPlugin::$widget_templates[ 'templates' ][ $style_id ]['type'];
$widget_has_reviews = !in_array($widget_type, [ 'button', 'badge' ]) || in_array($style_id, [ 23, 30, 32 ]);
?>
<h1 class="ti-free-title">
4. <?php echo TrustindexPlugin::___('Set up widget'); ?>
<a href="?page=<?php echo esc_attr($_GET['page']); ?>&tab=setup_no_reg&step=3" class="ti-back-icon"><?php echo TrustindexPlugin::___('Back'); ?></a>
</h1>
<?php if(!count($reviews)): ?>
<div class="notice notice-warning" style="margin: 0 0 15px 0">
<p>
<?php echo TrustindexPlugin::___('There are no reviews on your %s platform.', [ 'Google' ]); ?>
</p>
</div>
<?php else: ?>
<div class="ti-box ti-preview-boxes" data-layout-id="<?php echo esc_attr($style_id); ?>" data-set-id="<?php echo esc_attr($scss_set); ?>">
<div class="ti-header">
<?php echo TrustindexPlugin::___('Widget Preview'); ?>
<?php if(!in_array($style_id, [ 17, 21 ])): ?>
<span class="ti-header-layout-text ti-pull-right">
<?php echo TrustindexPlugin::___('Style'); ?>:
<strong><?php echo esc_html(TrustindexPlugin::___(TrustindexPlugin::$widget_styles[$scss_set])); ?></strong>
</span>
<?php endif; ?>
<span class="ti-header-layout-text ti-pull-right">
<?php echo TrustindexPlugin::___('Layout'); ?>:
<strong><?php echo esc_html(TrustindexPlugin::___(TrustindexPlugin::$widget_templates['templates'][$style_id]['name'])); ?></strong>
</span>
</div>
<div class="preview">
<div id="ti-review-list"><?php echo $trustindex_pm_google->get_noreg_list_reviews(null, true); ?></div>
<div style="display: none; text-align: center">
<?php echo TrustindexPlugin::___("You do not have reviews with the current filters. <br />Change your filters if you would like to display reviews on your page!"); ?>
</div>
</div>
</div>
<div class="ti-box">
<div class="ti-header"><?php echo TrustindexPlugin::___('Widget Settings'); ?></div>
<div class="ti-left-block">
<?php if($widget_has_reviews): ?>
<div id="ti-filter" class="ti-input-row">
<label><?php echo TrustindexPlugin::___('Filter your ratings'); ?></label>
<div class="ti-select" id="show-star" data-platform="google">
<font></font>
<ul>
<li data-value="1,2,3,4,5" <?php echo count($filter['stars']) > 2 ? 'class="selected"' : ''; ?>><?php echo TrustindexPlugin::___('Show all'); ?></li>
<li data-value="4,5" <?php echo count($filter['stars']) == 2 ? 'class="selected"' : ''; ?>>

&starf;&starf;&starf;&starf; - &starf;&starf;&starf;&starf;&starf;
</li>
<li data-value="5" <?php echo count($filter['stars']) == 1 ? 'class="selected"' : ''; ?>>
<?php echo TrustindexPlugin::___('only'); ?> &starf;&starf;&starf;&starf;&starf;
</li>
</ul>
</div>
</div>
<?php endif; ?>
<div class="ti-input-row">
<label><?php echo TrustindexPlugin::___('Select language'); ?></label>
<form method="post" action="">
<input type="hidden" name="command" value="save-language" />
<?php wp_nonce_field( 'save-language_'.$trustindex_pm_google->get_plugin_slug(), '_wpnonce_language' ); ?>
<select class="form-control" name="lang" id="ti-lang-id">
<?php foreach(TrustindexPlugin::$widget_languages as $id => $name): ?>
<option value="<?php echo esc_attr($id); ?>" <?php echo $lang == $id ? 'selected' : ''; ?>><?php echo esc_html($name); ?></option>
<?php endforeach; ?>
</select>
</form>
</div>
<?php if($widget_has_reviews): ?>
<div class="ti-input-row">
<label><?php echo TrustindexPlugin::___('Select date format'); ?></label>
<form method="post" action="">
<input type="hidden" name="command" value="save-dateformat" />
<?php wp_nonce_field( 'save-dateformat_'.$trustindex_pm_google->get_plugin_slug(), '_wpnonce_dateformat' ); ?>
<select class="form-control" name="dateformat" id="ti-dateformat-id">
<?php foreach(TrustindexPlugin::$widget_dateformats as $format): ?>
<option value="<?php echo esc_attr($format); ?>" <?php echo $dateformat == $format ? 'selected' : ''; ?>><?php echo date($format); ?></option>
<?php endforeach; ?>
</select>
</form>
</div>
<?php endif; ?>
</div>
<div class="ti-right-block">
<form method="post" action="" id="ti-widget-options">
<input type="hidden" name="command" value="save-options" />
<?php wp_nonce_field( 'save-options_'.$trustindex_pm_google->get_plugin_slug(), '_wpnonce_options' ); ?>
<?php if($widget_has_reviews): ?>
<span class="ti-checkbox row">
<input type="checkbox" id="ti-filter-only-ratings" class="no-form-update" name="only-ratings" value="1" <?php if($filter['only-ratings']): ?>checked<?php endif;?>>
<label><?php echo TrustindexPlugin::___("Hide reviews without comments"); ?></label>
</span>
<?php endif; ?>
<?php if(!in_array($style_id, [ 17, 18, 21, 24, 25, 26, 27, 28, 29, 30, 35 ])): ?>
<span class="ti-checkbox row">
<input type="checkbox" name="no-rating-text" value="1" <?php if($no_rating_text): ?>checked<?php endif;?>>
<label><?php echo TrustindexPlugin::___("Hide rating text"); ?></label>
</span>
<?php endif; ?>
<?php if($widget_has_reviews): ?>
<span class="ti-checkbox row">
<input type="checkbox" name="verified-icon" value="1" <?php if($verified_icon): ?>checked<?php endif;?>>
<label><?php echo TrustindexPlugin::___("Show verified review icon"); ?></label>
</span>
<?php endif; ?>
<?php if(in_array($widget_type, [ 'slider', 'sidebar' ]) && !in_array($style_id, [ 8, 9, 10, 18, 19 ])): ?>
<span class="ti-checkbox row">
<input type="checkbox" name="show-arrows" value="1" <?php if($show_arrows): ?>checked<?php endif;?>>
<label><?php echo TrustindexPlugin::___("Show navigation arrows"); ?></label>
</span>
<?php endif; ?>
<?php if($widget_has_reviews): ?>
<span class="ti-checkbox row">
<input type="checkbox" name="show-reviewers-photo" value="1" <?php if($show_reviewers_photo): ?>checked<?php endif;?>>
<label><?php echo TrustindexPlugin::___("Show reviewers' photo"); ?></label>
</span>
<span class="ti-checkbox row disabled">
<input type="checkbox" value="1" disabled>
<label class="ti-tooltip">
<?php echo TrustindexPlugin::___("Show reviewers' photos locally, from a single image (less requests)"); ?>
<span class="ti-tooltip-message"><?php echo TrustindexPlugin::___("Paid package feature"); ?></span>
</label>
</span>
<?php endif; ?>
<span class="ti-checkbox row">
<input type="checkbox" name="enable-animation" value="1" <?php if($enable_animation): ?>checked<?php endif;?>>
<label><?php echo TrustindexPlugin::___("Enable mouseover animation"); ?></label>
</span>
<span class="ti-checkbox row">
<input type="checkbox" name="disable-font" value="1" <?php if($disable_font): ?>checked<?php endif;?>>
<label><?php echo TrustindexPlugin::___("Use site's font"); ?></label>
</span>
<?php if($widget_has_reviews): ?>
<span class="ti-checkbox row">
<input type="checkbox" name="show-logos" value="1" <?php if($show_logos): ?>checked<?php endif;?>>
<label><?php echo TrustindexPlugin::___("Show platform logos"); ?></label>
</span>
<?php if(!$trustindex_pm_google->is_ten_scale_rating_platform()): ?>
<span class="ti-checkbox row">
<input type="checkbox" name="show-stars" value="1" <?php if($show_stars): ?>checked<?php endif;?>>
<label><?php echo TrustindexPlugin::___("Show platform stars"); ?></label>
</span>
<?php endif; ?>
<?php endif; ?>
</form>
</div>
<div class="clear"></div>
<div class="ti-footer">
<a href="?page=<?php echo esc_attr($_GET['page']); ?>&tab=setup_no_reg&setup_widget" class="btn-text btn-refresh ti-pull-right" data-loading-text="<?php echo TrustindexPlugin::___("Loading") ;?>"><?php echo TrustindexPlugin::___("Save and get code") ;?></a>
<div class="clear"></div>
</div>
</div>
<?php endif; ?>
<?php else: ?>
<h1 class="ti-free-title">
5. <?php echo TrustindexPlugin::___('Insert code'); ?>
<a href="?page=<?php echo esc_attr($_GET['page']); ?>&tab=setup_no_reg&step=4" class="ti-back-icon"><?php echo TrustindexPlugin::___('Back'); ?></a>
</h1>
<?php if(!count($reviews)): ?>
<div class="notice notice-warning" style="margin: 0 0 15px 0">
<p>
<?php echo TrustindexPlugin::___('There are no reviews on your %s platform.', [ 'Google' ]); ?>
</p>
</div>
<?php else: ?>
<div class="ti-box">
<div class="ti-header"><?php echo TrustindexPlugin::___('Insert this shortcode into your website'); ?></div>
<div class="ti-input-row" style="margin-bottom: 2px">
<label><?php echo TrustindexPlugin::___('Shortcode'); ?></label>
<code class="code-shortcode">[<?php echo $trustindex_pm_google->get_shortcode_name(); ?> no-registration=google]</code>
<a href=".code-shortcode" class="btn-text btn-copy2clipboard"><?php echo TrustindexPlugin::___("Copy to clipboard") ;?></a>
</div>
<?php echo TrustindexPlugin::___('Copy and paste this shortcode into post, page or widget.'); ?>
</div>
<h1 class="ti-free-title"><?php echo TrustindexPlugin::___("Want to get more customers?"); ?></h1>
<div class="ti-box">
<div class="ti-header"><?php echo TrustindexPlugin::___('Increase SEO, trust and sales using customer reviews.'); ?></div>
<a class="btn-text" href="https://www.trustindex.io/ti-redirect.php?a=sys&c=wp-google-1" target="_blank"><?php echo TrustindexPlugin::___('Create a Free Account for More Features'); ?></a>
<div class="notice notice-success ti-special-offer">
<img src="<?php echo $trustindex_pm_google->get_plugin_file_url('static/img/special_30.jpg'); ?>">
<p><?php echo TrustindexPlugin::___('Now we offer you a 30%% discount off your subscription! Create your free account and benefit from the onboarding discount now!'); ?></p>
<div class="clear"></div>
</div>
<ul class="ti-seo-list">
<li>
<strong><?php echo TrustindexPlugin::___("%d Review Platforms", [ $trustindex_pm_google->get_platform_count() ]); ?></strong><br />
<?php echo TrustindexPlugin::___("Add more reviews to your widget from %s, etc. to enjoy more trust, and to keep customers on your site.", [ 'Google, Facebook, Yelp, Amazon, Tripadvisor, Booking.com, Airbnb, Hotels.com, Capterra, Foursquare, Opentable' ]); ?><br />
<img src="<?php echo $trustindex_pm_google->get_plugin_file_url('static/img/platforms.png'); ?>" alt="" style="margin-top: 5px" />
</li>
<li>
<strong><?php echo TrustindexPlugin::___("Create Unlimited Number of Widgets"); ?></strong><br />
<?php echo TrustindexPlugin::___("Use the widgets matching your page the best to build trust."); ?>
</li>
<li>
<strong><?php echo TrustindexPlugin::___("Mix Reviews"); ?></strong><br />
<?php echo TrustindexPlugin::___("You can mix your reviews from different platforms and display them in 1 review widget."); ?>
</li>
<li>
<strong><?php echo TrustindexPlugin::___("Get More Reviews!"); ?></strong><br />
<?php echo TrustindexPlugin::___("Use our Review Invitation System to collect hundreds of new reviews. Become impossible to resist!"); ?>
</li>
<li>
<strong><?php echo TrustindexPlugin::___("Manage Reviews"); ?></strong><br />
<?php echo TrustindexPlugin::___("Turn on email alert to ALL new reviews, so that you can manage them quickly."); ?>
</li>
<li>
<strong><?php echo TrustindexPlugin::___("Automatically update with NEW reviews"); ?></strong><br />
<?php echo TrustindexPlugin::___("Wordpress cannot update reviews, but Trustindex can! As soon as you get a new review, Trustindex Business can automatically add it to your website. Customers love fresh reviews!"); ?>
</li>
<li>
<strong><?php echo TrustindexPlugin::___("Display UNLIMITED number of reviews"); ?></strong><br />
<?php echo TrustindexPlugin::___("You can test Trustindex with 10 reviews in the free version. Upgrade to Business to display ALL the reviews received. Be the undisputed customer choice in your industry!"); ?>
</li>
</ul>
<a class="btn-text" href="https://www.trustindex.io/ti-redirect.php?a=sys&c=wp-google-2" target="_blank"><?php echo TrustindexPlugin::___('Create a Free Account for More Features'); ?></a>
</div>
<?php endif; ?>
<?php endif; ?>
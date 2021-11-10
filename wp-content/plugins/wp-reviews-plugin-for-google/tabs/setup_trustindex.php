<?php
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
wp_enqueue_script('trustindex-js', 'https://cdn.trustindex.io/loader.js', [], false, true);
?>
<div id="tab-setup_trustindex">
<div class="ti-box">
<div class="ti-row">
<div class="ti-col-6">
<h1><?php echo TrustindexPlugin::___('Skyrocket Your Sales with Customer Reviews'); ?></h1>
<h2>
<?php echo TrustindexPlugin::___('20,000+ WordPress websites use Trustindex to embed reviews fast and easily.'); ?><br />
<?php echo TrustindexPlugin::___('Increase SEO, trust and sales using customer reviews.'); ?>
</h2>
<h3><?php echo TrustindexPlugin::___('Top Features'); ?></h3>
<ul class="ti-check">
<li><?php echo TrustindexPlugin::___("%d Review Platforms", [ $trustindex_pm_google->get_platform_count() ]); ?></li>
<li><?php echo TrustindexPlugin::___('Create Unlimited Number of Widgets'); ?></li>
<li><?php echo TrustindexPlugin::___('Mix Reviews from Different Platforms'); ?></li>
<li><?php echo TrustindexPlugin::___('Get More Reviews!'); ?></li>
<li><?php echo TrustindexPlugin::___('Manage All Reviews in 1 Place'); ?></li>
<li><?php echo TrustindexPlugin::___('Automatically update with NEW reviews'); ?></li>
<li><?php echo TrustindexPlugin::___('Display UNLIMITED number of reviews'); ?></li>
</ul>
</div>
<div class="ti-col-6">
<div src='https://cdn.trustindex.io/loader.js?76afafc10ad42261d7587d98bf'></div>
</div>
</div>
<a class="btn-text btn-lg arrow-btn" href="https://www.trustindex.io/ti-redirect.php?a=sys&c=wp-google-3" target="_blank"><?php echo TrustindexPlugin::___('Create a Free Trustindex Account for More Features'); ?></a>
<div class="notice notice-success ti-special-offer">
<img src="<?php echo $trustindex_pm_google->get_plugin_file_url('static/img/special_30.jpg'); ?>">
<p><?php echo TrustindexPlugin::___('Now we offer you a 30%% discount off your subscription! Create your free account and benefit from the onboarding discount now!'); ?></p>
<div class="clear"></div>
</div>
</div>
</div>

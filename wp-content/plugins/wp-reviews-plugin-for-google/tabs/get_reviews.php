<?php
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
?>
<div class="ti-box">
<div class="ti-header"><?php echo TrustindexPlugin::___('Want more %s reviews?', [ 'Google' ]); ?></div>
<?php if($trustindex_pm_google->shortname == "google"): ?>
<p><?php echo TrustindexPlugin::___("Get 100+ REAL Google reviews, with only 3 minutes of work, without developer knowledge..."); ?></p>
<a href="https://wordpress.trustindex.io/collect-google-reviews/?source=wpcs-google" target="_blank" class="btn-text"><?php echo TrustindexPlugin::___("DOWNLOAD OUR FREE GUIDE"); ?></a>
<?php else: ?>
<p><?php echo TrustindexPlugin::___("Get 100+ REAL Customer reviews, with only 3 minutes of work, without developer knowledge..."); ?></p>
<a href="https://wordpress.trustindex.io/collect-reviews/?source=wpcs-google" target="_blank" class="btn-text"><?php echo TrustindexPlugin::___("DOWNLOAD OUR FREE GUIDE"); ?></a>
<?php endif; ?>
</div>
<?php if(class_exists('Woocommerce')): ?>
<div class="ti-box">
<div class="ti-header"><?php echo TrustindexPlugin::___('Get new features for your WooCommerce shop'); ?></div>
<?php if(!class_exists('TrustindexWoocommercePlugin')): ?>
<p><?php echo TrustindexPlugin::___("Download our new <a href='%s' target='_blank'>%s</a> plugin and get features for free!", [ 'https://wordpress.org/plugins/customer-reviews-for-woocommerce/', TrustindexPlugin::___('Customer Reviews for WooCommerce') ]); ?></p>
<?php endif; ?>
<ul class="ti-check" style="margin-bottom: 20px">
<li><?php echo TrustindexPlugin::___('set up Trustindex company profile and get high quality backlink'); ?></li>
<li><?php echo TrustindexPlugin::___('set up review-collector campaigns to get new ratings / reviews / recommendations automatically'); ?></li>
<li><?php echo TrustindexPlugin::___('show customer reviews in fancy widgets'); ?></li>
</ul>
<?php if(class_exists('TrustindexWoocommercePlugin')): ?>
<a href="?page=customer-reviews-for-woocommerce%2Fsettings.php" class="btn-text">
<?php echo TrustindexPlugin::___("Get Reviews"); ?>
</a>
<?php else: ?>
<a href="https://wordpress.org/plugins/customer-reviews-for-woocommerce/" target="_blank" class="btn-text">
<?php echo TrustindexPlugin::___("Download plugin"); ?>
</a>
<?php endif; ?>
</div>
<?php endif; ?>
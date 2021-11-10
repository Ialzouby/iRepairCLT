<label class="ti-left-label"><?php echo TrustindexPlugin::___("Google Place ID or URL"); ?>:</label>
<div class="input">
<input class="form-control"
placeholder="<?php echo TrustindexPlugin::___("e.g.:") . ' ' . esc_attr($example); ?>"
id="page-link"
type="text" required="required"
/>
<span class="info-text">
<?php echo TrustindexPlugin::___("Type your business/company's Place ID or your Google Search/Google Maps URL"); ?><br />
<?php echo TrustindexPlugin::___("For example: <a href='%s' target='_blank'>illustration</a>, <a href='%s' target='_blank'>illustration</a>", [ 'https://cdn.trustindex.io/' . 'assets/img/trustindex-google-search-1.jpg', 'https://cdn.trustindex.io/' . 'assets/img/trustindex-google-search-2.jpg' ]); ?>
</span>
<img class="loading" src="<?php echo admin_url('images/loading.gif'); ?>" />
<div class="results"
data-errortext="<?php echo TrustindexPlugin::___("Please add your Place ID again: this is not a valid %s page.", [ "Google" ]); ?>"
data-errortext-search="<?php echo TrustindexPlugin::___("Please give us that URL where you can see your business profile in Google Search or in Google Maps!"); ?>"
></div>
</div>
<button class="btn btn-text btn-check"><?php echo TrustindexPlugin::___("Check") ;?></button>
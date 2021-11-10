<div class="ti-preview-boxes-container">
<?php foreach(TrustindexPlugin::$widget_templates['templates'] as $id => $template): ?>
<?php
$class_name = 'ti-full-width';
if(in_array($template['type'], [ 'badge', 'button', 'floating', 'popup', 'sidebar' ]))
{
$class_name = 'ti-half-width';
}
if(!in_array($id, [ 17, 21 ]))
{
$random_set_id = array_rand(TrustindexPlugin::$widget_styles);
}
else
{
$random_set_id = 'light-background';
}
?>
<div class="<?php echo esc_attr($class_name); ?>">
<div class="ti-box ti-preview-boxes" data-layout-id="<?php echo esc_attr($id); ?>" data-set-id="<?php echo esc_attr($random_set_id); ?>">
<div class="ti-header">
<span class="ti-header-layout-text">
<?php echo TrustindexPlugin::___('More widget examples'); ?> -
<strong><?php echo esc_html(TrustindexPlugin::___($template['name'])); ?></strong>
<?php if(!in_array($id, [ 17, 21 ])): ?> (<?php echo esc_html(TrustindexPlugin::___(TrustindexPlugin::$widget_styles[$random_set_id])); ?>)<?php endif; ?>
</span>
</div>
<div class="preview">
<?php echo $trustindex_pm_google->get_noreg_list_reviews(null, true, $id, $random_set_id, true, true); ?>
</div>
</div>
</div>
<?php endforeach; ?>
</div>
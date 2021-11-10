<?php
/* GENERATED: 1634976944 */
class TrustindexPlugin
{
private $plugin_file_path;
private $plugin_name;
private $platform_name;
public $shortname;
private $version;
public function __construct($shortname, $plugin_file_path, $version, $plugin_name, $platform_name)
{
$this->shortname = $shortname;
$this->plugin_file_path = $plugin_file_path;
$this->version = $version;
$this->plugin_name = $plugin_name;
$this->platform_name = $platform_name;
}
public function getShortName()
{
return $this->shortname;
}


public function get_plugin_dir()
{
return plugin_dir_path($this->plugin_file_path);
}
public function get_plugin_file_url($file, $add_versioning = true)
{
$url = plugins_url($file, $this->plugin_file_path);
if ($add_versioning)
{
$append_mark = strpos($url, "?") === FALSE ? "?" : "&";
$url .= $append_mark . 'ver=' . $this->version;
}
return $url;
}
public function get_plugin_slug()
{
return basename($this->get_plugin_dir());
}

/* I18N
 * make sure you do not use any translatable string function calls before the call to our ‘load_plugin_textdomain’
 */
public function loadI18N()
{
load_plugin_textdomain('trustindex', false, $this->get_plugin_slug() . '/languages');
}
public static function ___($text, $params = null)
{
if (!is_array($params))
{
$params = func_get_args();
$params = array_slice($params, 1);
}
return vsprintf(__($text, 'trustindex'), $params);
}


public function output_buffer()
{
 ob_start();
}


public function uninstall()
{
foreach ($this->get_option_names() as $opt_name)
{
delete_option($this->get_option_name($opt_name));
}
global $wpdb;
$dbtable = $this->get_noreg_tablename();
$wpdb->query( "DROP TABLE IF EXISTS $dbtable" );
}


public function activate()
{
if ($this->is_need_update())
{
add_option($this->get_option_name('active'), '1');
update_option($this->get_option_name('version'), $this->version);
}
}
public function deactivate()
{
}
public function is_enabled()
{
$active = get_option($this->get_option_name('active'));
if (empty($active) || $active === '0')
{
return false;
}
return true;
}
public function is_need_update()
{
$version = (string)get_option($this->get_option_name('version'));
if (!$version)
{
$version = '0';
}
if (version_compare($version, $this->version, '<'))
{
return true;
}
return false;
}

public function add_setting_menu()
{
global $menu, $submenu;
$permission = 'edit_pages';
$settings_page_url = $this->get_plugin_slug() . "/settings.php";
$settings_page_title = $this->platform_name . ' ';
if(function_exists('mb_strtolower'))
{
$settings_page_title .= mb_strtolower(TrustindexPlugin::___('Reviews'));
}
else
{
$settings_page_title .= strtolower(TrustindexPlugin::___('Reviews'));
}
$top_menu = false;
foreach($menu as $key => $item)
{
if($item[0] == 'Trustindex.io')
{
$top_menu = $item;
break;
}
}
if($top_menu === false)
{
add_menu_page(
$settings_page_title,
'Trustindex.io',
$permission,
$settings_page_url,
'',
$this->get_plugin_file_url('static/img/trustindex-sign-logo.png')
);
}
else
{
if(!isset($submenu[$top_menu[2]]))
{
add_submenu_page(
$top_menu[2],
'Trustindex.io',
$top_menu[3],
$permission,
$top_menu[2]
);
}
add_submenu_page(
$top_menu[2],
'Trustindex.io',
$settings_page_title,
$permission,
$settings_page_url
);
}
}
public function add_plugin_action_links($links, $file)
{
$plugin_file = basename($this->plugin_file_path);
if (basename($file) == $plugin_file)
{
$new_item2 = '<a target="_blank" href="https://www.trustindex.io" target="_blank">by <span style="background-color: #4067af; color: white; font-weight: bold; padding: 1px 8px;">Trustindex.io</span></a>';
$new_item1 = '<a href="' . admin_url('admin.php?page=' . $this->get_plugin_slug() . '/settings.php') . '">' . TrustindexPlugin::___('Settings') . '</a>';
array_unshift($links, $new_item2, $new_item1);
}
return $links;
}
public function add_plugin_meta_links( $meta, $file )
{
$plugin_file = basename($this->plugin_file_path);
if (basename($file) == $plugin_file)
{
$meta[] = "<a href='http://wordpress.org/support/view/plugin-reviews/".$this->get_plugin_slug()."' target='_blank' rel='noopener noreferrer' title='" . TrustindexPlugin::___( 'Rate our plugin') . ': '.$this->plugin_name . "'>" . TrustindexPlugin::___('Rate our plugin') . '</a>';
}
return $meta;
}


public function init_widget()
{
if (!class_exists('TrustindexWidget_'.$this->shortname))
{
require $this->get_plugin_dir() . 'trustindex-'.$this->shortname.'-widget.class.php';
}
}
public function register_widget()
{
return register_widget('TrustindexWidget_'.$this->shortname);
}


public function get_option_name($opt_name)
{
if (!in_array($opt_name, $this->get_option_names()))
{
echo "Option not registered in plugin (Trustindex class)";
}
if(in_array($opt_name, [ 'subscription-id', 'proxy-check' ]))
{
return "trustindex-".$opt_name;
}
else
{
return "trustindex-".$this->shortname."-".$opt_name;
}
}
public function get_option_names()
{
return [
'active',
'version',
'page-details',
'subscription-id',
'proxy-check',
'style-id',
'review-content',
'filter',
'scss-set',
'css-content',
'lang',
'no-rating-text',
'dateformat',
'rate-us',
'verified-icon',
'enable-animation',
'show-arrows',
'content-saved-to',
'show-reviewers-photo',
'download-timestamp',
'widget-setted-up',
'disable-font',
'show-logos',
'show-stars',
'widget-nonce',
'widget-nonce-hidden-notification'
];
}
public function get_platforms()
{
return array (
 0 => 'facebook',
 1 => 'google',
 2 => 'tripadvisor',
 3 => 'yelp',
 4 => 'booking',
 5 => 'amazon',
 6 => 'arukereso',
 7 => 'airbnb',
 8 => 'hotels',
 9 => 'opentable',
 10 => 'foursquare',
 11 => 'capterra',
 12 => 'szallashu',
 13 => 'thumbtack',
 14 => 'expedia',
 15 => 'zillow',
 16 => 'wordpressPlugin',
 17 => 'aliexpress',
 18 => 'alibaba',
 19 => 'sourceForge',
 20 => 'ebay',
);
}
private $plugin_slugs = array (
 'facebook' => 'free-facebook-reviews-and-recommendations-widgets',
 'google' => 'wp-reviews-plugin-for-google',
 'tripadvisor' => 'review-widgets-for-tripadvisor',
 'yelp' => 'reviews-widgets-for-yelp',
 'booking' => 'review-widgets-for-booking-com',
 'amazon' => 'review-widgets-for-amazon',
 'arukereso' => 'review-widgets-for-arukereso',
 'airbnb' => 'review-widgets-for-airbnb',
 'hotels' => 'review-widgets-for-hotels-com',
 'opentable' => 'review-widgets-for-opentable',
 'foursquare' => 'review-widgets-for-foursquare',
 'capterra' => 'review-widgets-for-capterra',
 'szallashu' => 'review-widgets-for-szallas-hu',
 'thumbtack' => 'widgets-for-thumbtack-reviews',
 'expedia' => 'widgets-for-expedia-reviews',
 'zillow' => 'widgets-for-zillow-reviews',
 'wordpressPlugin' => 'reviews-widgets',
 'aliexpress' => 'widgets-for-aliexpress-reviews',
 'alibaba' => 'widgets-for-alibaba-reviews',
 'sourceForge' => 'widgets-for-sourceforge-reviews',
 'ebay' => 'widgets-for-ebay-reviews',
);
public function get_plugin_slugs()
{
return array_values($this->plugin_slugs);
}


public static function get_noticebox($type, $message)
{
return '<div class="notice notice-'.$type.' is-dismissible"><p>'.TrustindexPlugin::___($message).'</p></div>';
}
public static function get_alertbox($type, $content, $newline_content = true)
{
$types = array(
"warning" => array(
"css" => "color: #856404; background-color: #fff3cd; border-color: #ffeeba;",
"icon" => "dashicons-warning"
),
"info" => array(
"css" => "color: #0c5460; background-color: #d1ecf1; border-color: #bee5eb;",
"icon" => "dashicons-info"
),
"error" => array(
"css" => "color: #721c24; background-color: #f8d7da; border-color: #f5c6cb;",
"icon" => "dashicons-info"
)
);
return "<div style='margin:20px 0px; padding:10px; " . $types[$type]['css'] . " border-radius: 5px;'>"
. "<span class='dashicons " . $types[$type]['icon'] . "'></span> <strong>" . strtoupper(TrustindexPlugin::___($type)) . "</strong>"
. ($newline_content ? "<br />" : "")
. $content
. "</div>";
}


public function get_trustindex_widget($ti_id)
{
wp_enqueue_script('trustindex-js', 'https://cdn.trustindex.io/loader.js', [], false, true);
return "<div src='https://cdn.trustindex.io/loader.js?" . $ti_id . "'></div>";
}
public function get_shortcode_name()
{
return 'trustindex';
}
public function init_shortcode()
{
if (!shortcode_exists($this->get_shortcode_name()))
{
add_shortcode( $this->get_shortcode_name(), [$this, 'shortcode_func'] );
}
}
public function shortcode_func($atts)
{
$atts = shortcode_atts(
array(
'data-widget-id' => null,
'no-registration' => null
),
$atts
);
if (isset($atts["data-widget-id"]) && $atts["data-widget-id"])
{
return $this->get_trustindex_widget($atts["data-widget-id"]);
}
else if (isset($atts["no-registration"]) && $atts["no-registration"])
{
$force_platform = $atts["no-registration"];
if(substr($force_platform, 0, 5) != 'trust' && substr($force_platform, -4) != 'ilot' && !in_array($force_platform, $this->get_platforms()))
{
$av_platforms = $this->get_platforms();
$force_platform = $av_platforms[0];
}
$file_path = __FILE__;
if(isset($this->plugin_slugs[ $force_platform ]))
{
$chosed_platform_slug = $this->plugin_slugs[ $force_platform ];
$current_platform_slug = $this->plugin_slugs[ $this->shortname ];
$file_path = preg_replace('/\/[^\/]+\/trustindex-plugin\.class\.php/', "/$chosed_platform_slug/trustindex-plugin.class.php", $file_path);
}
$chosed_platform = new TrustindexPlugin($force_platform, $file_path, "do-not-care-7.3", "do-not-care-Widgets for Google Reviews", "do-not-care-Google");
if(!$chosed_platform->is_noreg_linked() || !$chosed_platform->is_noreg_table_exists($force_platform))
{
return self::get_alertbox(
"error",
" @ <strong>". TrustindexPlugin::___('Trustindex plugin') ."</strong><br /><br />"
.TrustindexPlugin::___('You have to connect your business (%s)!', [$force_platform]),
false
);
}
else
{
return $chosed_platform->get_noreg_list_reviews($force_platform);
}
}
else
{
return self::get_alertbox(
"error",
" @ <strong>". TrustindexPlugin::___('Trustindex plugin') ."</strong><br /><br />"
.TrustindexPlugin::___('Your shortcode is deficient: Trustindex Widget ID is empty! Example: ') . '<br /><code>['.$this->get_shortcode_name().' data-widget-id="478dcc2136263f2b3a3726ff"]</code>',
false
);
}
}

/* WITHOUT REG MODE HELPERS
 *
 * @force_platform - default ($this->shortname) platform name can be overriden, because of the general shortcode.
 * (For example: if Yelp plugin loaded first --> yelp plugin will load the widget, other Trustindex plugins will not load shortcode.
 * But Yelp plugins's shortcode should be able to operate other platforms' (ie.: Google) shortcodes, too. )
 */
public function is_noreg_linked()
{
$page_details = get_option($this->get_option_name('page-details'));
return $page_details && !empty($page_details);
}
public function get_noreg_tablename($force_platform = null)
{
global $wpdb;
$force_platform = $force_platform ? $force_platform : $this->shortname;
return $wpdb->prefix ."trustindex_".$force_platform."_reviews";
}
public function is_noreg_table_exists($force_platform = null)
{
global $wpdb;
$dbtable = $this->get_noreg_tablename($force_platform);
return ($wpdb->get_var("SHOW TABLES LIKE '$dbtable'") == $dbtable);
}
public function noreg_save_css($set_change = false)
{
$style_id = (int)get_option($this->get_option_name('style-id'), 4);
$set_id = get_option($this->get_option_name('scss-set'));
$args = array(
'timeout' => '20',
'redirection' => '5',
'blocking' => true
);
add_filter( 'https_ssl_verify', '__return_false' );
add_filter( 'block_local_requests', '__return_false' );
$params = [
'platform' => $this->shortname,
'layout_id' => $style_id,
'overrides' => [
'nav' => get_option($this->get_option_name('show-arrows'), 1) ? true : false,
'hover-anim' => get_option($this->get_option_name('enable-animation'), 1) ? true : false,
'enable-font' => get_option($this->get_option_name('disable-font'), 0) ? false : true,
]
];
if($set_change)
{
$params['set_id'] = $set_id;
}
$url = 'https://admin.trustindex.io/' . 'api/getLayoutScss?' . http_build_query($params);
$server_output = $this->post_request($url, [
'timeout' => '20',
'redirection' => '5',
'blocking' => true
]);
if($server_output[0] !== '[' && $server_output[0] !== '{')
{
$server_output = substr($server_output, strpos($server_output, '('));
$server_output = trim($server_output,'();');
}
$server_output = json_decode($server_output, true);
if(!$set_change)
{
update_option($this->get_option_name('scss-set'), $server_output['default'], false);
}
if($server_output['css'])
{
if($style_id == 17 || $style_id == 21)
{
$server_output['css'] .= '.ti-preview-box { position: initial !important }';
}
update_option($this->get_option_name('css-content'), $server_output['css'], false);
}
return $content;
}
public function plugin_loaded()
{
global $wpdb;
$version = $this->version;

if($this->is_noreg_table_exists())
{
$db_table_name = $this->get_noreg_tablename();

if($version >= 6.3 && count($wpdb->get_results("SHOW COLUMNS FROM $db_table_name LIKE 'highlight'")) == 0)
{
$wpdb->query("ALTER TABLE $db_table_name ADD highlight VARCHAR(11) NULL AFTER rating");
}
}
if($this->is_noreg_linked() && get_option( $this->get_option_name('review-content') ))
{
$content_version = get_option( $this->get_option_name('content-saved-to') );
if(!$content_version || $content_version != $version)
{
update_option( $this->get_option_name('content-saved-to'), $version, false );
delete_option( $this->get_option_name('review-content') );
$this->noreg_save_css(true);
}
}
$this->loadI18N();
if ( !class_exists('TrustindexGutenbergPlugin') && function_exists( 'register_block_type' ) )
{
require_once dirname( __FILE__ ) . '/static/block-editor/block-editor.php';
TrustindexGutenbergPlugin::instance();
}
}
public static $widget_templates = array (
 'categories' => 
 array (
 'slider' => '4,5,13,15,19,34',
 'sidebar' => '6,7,8,9,10,18',
 'list' => '33',
 'grid' => '16,31',
 'badge' => '11,12,20,22,23',
 'button' => '24,25,26,27,28,29,30,32,35',
 'floating' => '17,21',
 'popup' => '23,30,32',
 ),
 'templates' => 
 array (
 4 => 
 array (
 'name' => 'Slider I.',
 'type' => 'slider',
 ),
 15 => 
 array (
 'name' => 'Slider II.',
 'type' => 'slider',
 ),
 5 => 
 array (
 'name' => 'Slider III. - with badge',
 'type' => 'slider',
 ),
 34 => 
 array (
 'name' => 'Slider III. - with badge II.',
 'type' => 'slider',
 ),
 13 => 
 array (
 'name' => 'Slider III. - with company header',
 'type' => 'slider',
 ),
 19 => 
 array (
 'name' => 'Slider IV.',
 'type' => 'slider',
 ),
 33 => 
 array (
 'name' => 'List I.',
 'type' => 'list',
 ),
 16 => 
 array (
 'name' => 'Grid',
 'type' => 'grid',
 ),
 31 => 
 array (
 'name' => 'Mansonry grid',
 'type' => 'grid',
 ),
 6 => 
 array (
 'name' => 'Sidebar slider I.',
 'type' => 'sidebar',
 ),
 7 => 
 array (
 'name' => 'Sidebar slider II.',
 'type' => 'sidebar',
 ),
 8 => 
 array (
 'name' => 'Full sidebar I.',
 'type' => 'sidebar',
 ),
 18 => 
 array (
 'name' => 'Full sidebar I. - without header',
 'type' => 'sidebar',
 ),
 9 => 
 array (
 'name' => 'Full sidebar II.',
 'type' => 'sidebar',
 ),
 10 => 
 array (
 'name' => 'Full sidebar III.',
 'type' => 'sidebar',
 ),
 24 => 
 array (
 'name' => 'Button I.',
 'type' => 'button',
 ),
 25 => 
 array (
 'name' => 'Button II.',
 'type' => 'button',
 ),
 26 => 
 array (
 'name' => 'Button III.',
 'type' => 'button',
 ),
 27 => 
 array (
 'name' => 'Button IV.',
 'type' => 'button',
 ),
 28 => 
 array (
 'name' => 'Button V.',
 'type' => 'button',
 ),
 29 => 
 array (
 'name' => 'Button VI.',
 'type' => 'button',
 ),
 30 => 
 array (
 'name' => 'Button VII. - with dropdown',
 'type' => 'button',
 ),
 35 => 
 array (
 'name' => 'Button VII.',
 'type' => 'button',
 ),
 32 => 
 array (
 'name' => 'Button VII. - with popup',
 'type' => 'button',
 ),
 22 => 
 array (
 'name' => 'Company badge I.',
 'type' => 'badge',
 ),
 23 => 
 array (
 'name' => 'Company badge I. - with popup',
 'type' => 'badge',
 ),
 11 => 
 array (
 'name' => 'HTML badge I.',
 'type' => 'badge',
 ),
 12 => 
 array (
 'name' => 'HTML badge II.',
 'type' => 'badge',
 ),
 20 => 
 array (
 'name' => 'HTML badge III.',
 'type' => 'badge',
 ),
 17 => 
 array (
 'name' => 'Floating',
 'type' => 'floating',
 ),
 21 => 
 array (
 'name' => 'Floating II.',
 'type' => 'floating',
 ),
 ),
);
public static $widget_styles = array (
 'light-background' => 'Light background',
 'ligth-border' => 'Light border',
 'drop-shadow' => 'Drop shadow',
 'light-minimal' => 'Minimal',
 'soft' => 'Soft',
 'light-clean' => 'Light clean',
 'light-square' => 'Clean dark',
 'light-background-border' => 'Light background border',
 'blue' => 'Blue',
 'light-background-image' => 'Light background image',
 'dark-background' => 'Dark background',
 'dark-minimal' => 'Minimal dark',
 'dark-border' => 'Dark border',
 'light-contrast' => 'Light contrast',
 'dark-contrast' => 'Dark contrast',
 'dark-background-image' => 'Dark background image',
);
public static $widget_languages = [
'ar' => "العربية",
'zh' => "汉语",
'cs' => "Čeština",
'da' => "Dansk",
'nl' => "Nederlands",
'en' => "English",
'et' => "Eestlane",
'fi' => "Suomi",
'fr' => "Français",
'de' => "Deutsch",
'el' => "Ελληνικά",
'hi' => "हिन्दी",
'hu' => "Magyar",
'it' => "Italiano",
'no' => "Norsk",
'pl' => "Polski",
'pt' => "Português",
'ro' => "Română",
'ru' => "Русский",
'sk' => "Slovenčina",
'es' => "Español",
'sv' => "Svenska",
'tr' => "Türkçe",
'gd' => 'Gàidhlig na h-Alba',
'hr' => 'Hrvatski',
'id' => 'Bahasa Indonesia',
'is' => 'Íslensku',
'he' => 'עִברִית',
'ja' => '日本',
'ko' => '한국어',
'lt' => 'Lietuvių',
'ms' => 'Bahasa Melayu',
'sl' => 'Slovenščina',
'sr' => 'Српски',
'th' => 'ไทย',
'uk' => 'Українська',
'vi' => 'Tiếng Việt',
'mk' => 'Македонски',
'bg' => 'български',
'sq' => 'Shqip',
'af' => 'Afrikaans',
'az' => 'Azərbaycan dili',
'bn' => 'বাংলা',
];
public static $widget_dateformats = [ 'j. F, Y.', 'F j, Y.', 'Y.m.d.', 'Y-m-d', 'd/m/Y' ];
private static $widget_rating_texts = array (
 'en' => 
 array (
 0 => 'poor',
 1 => 'below average',
 2 => 'average',
 3 => 'good',
 4 => 'excellent',
 ),
 'fr' => 
 array (
 0 => 'faible',
 1 => 'moyenne basse',
 2 => 'moyenne',
 3 => 'bien',
 4 => 'excellent',
 ),
 'de' => 
 array (
 0 => 'Schwach',
 1 => 'Unterdurchschnittlich',
 2 => 'Durchschnittlich',
 3 => 'Gut',
 4 => 'Ausgezeichnet',
 ),
 'es' => 
 array (
 0 => 'Flojo',
 1 => 'Por debajo de lo regular',
 2 => 'Regular',
 3 => 'Bueno',
 4 => 'Excelente',
 ),
 'ar' => 
 array (
 0 => 'فيعض',
 1 => 'طسوتملا تحت',
 2 => 'طسوتم',
 3 => 'ديج',
 4 => 'زاتمم',
 ),
 'cs' => 
 array (
 0 => 'Slabý',
 1 => 'Podprůměrný',
 2 => 'Průměrný',
 3 => 'Dobrý',
 4 => 'Vynikající',
 ),
 'da' => 
 array (
 0 => 'Svag',
 1 => 'Under gennemsnitlig',
 2 => 'Gennemsnitlig',
 3 => 'God',
 4 => 'Fremragende',
 ),
 'et' => 
 array (
 0 => 'halb',
 1 => 'alla keskmise',
 2 => 'keskmine',
 3 => 'hea',
 4 => 'suurepärane',
 ),
 'el' => 
 array (
 0 => 'Χαμηλή',
 1 => 'Κάτω από τον μέσο όρο',
 2 => 'Μέτρια',
 3 => 'Καλή',
 4 => 'Άριστη',
 ),
 'fi' => 
 array (
 0 => 'Heikko',
 1 => 'Keskitasoa alhaisempi',
 2 => 'Keskitasoinen',
 3 => 'Hyvä',
 4 => 'Erinomainen',
 ),
 'hi' => 
 array (
 0 => 'कमज़ोर',
 1 => 'औसत से कम ',
 2 => 'औसत ',
 3 => 'अच्छा ',
 4 => 'अति उत्कृष्ट ',
 ),
 'hu' => 
 array (
 0 => 'Gyenge',
 1 => 'Átlag alatti',
 2 => 'Átlagos',
 3 => 'Jó',
 4 => 'Kiváló',
 ),
 'it' => 
 array (
 0 => 'Scarso',
 1 => 'Sotto la media',
 2 => 'Medio',
 3 => 'Buono',
 4 => 'Eccellente',
 ),
 'ja' => 
 array (
 0 => '悪い',
 1 => '平均以下の',
 2 => '平均',
 3 => '良い',
 4 => '優れた',
 ),
 'nl' => 
 array (
 0 => 'Zwak',
 1 => 'Onder gemiddeld',
 2 => 'Gemiddeld',
 3 => 'Goed',
 4 => 'Uitstekend',
 ),
 'no' => 
 array (
 0 => 'Dårlig',
 1 => 'Utilstrekkelig',
 2 => 'Gjennomsnittlig',
 3 => 'Bra',
 4 => 'Utmerket',
 ),
 'pl' => 
 array (
 0 => 'Śłaby',
 1 => 'Poniżej średniego',
 2 => 'Średni',
 3 => 'Dobry',
 4 => 'Doskonały',
 ),
 'pt' => 
 array (
 0 => 'Fraco',
 1 => 'Inferior ao médio',
 2 => 'Medíocre',
 3 => 'Bom',
 4 => 'Excelente',
 ),
 'ro' => 
 array (
 0 => 'Slab',
 1 => 'Sub nivel mediu',
 2 => 'Mediu',
 3 => 'Bun',
 4 => 'Excelent',
 ),
 'ru' => 
 array (
 0 => 'Слабо',
 1 => 'Ниже среднего',
 2 => 'Средний',
 3 => 'Хорошо',
 4 => 'Отлично',
 ),
 'sl' => 
 array (
 0 => 'slabo',
 1 => 'pod povprečjem',
 2 => 'povprečno',
 3 => 'dobro',
 4 => 'odlično',
 ),
 'sk' => 
 array (
 0 => 'Slabé',
 1 => 'Podpriemerné',
 2 => 'Priemerné',
 3 => 'Dobré',
 4 => 'Vynikajúce',
 ),
 'sv' => 
 array (
 0 => 'Dålig',
 1 => 'Under genomsnittet',
 2 => 'Genomsnittlig',
 3 => 'Bra',
 4 => 'Utmärkt',
 ),
 'tr' => 
 array (
 0 => 'Zayıf',
 1 => 'Ortanın altıi',
 2 => 'Orta',
 3 => 'İyi',
 4 => 'Mükemmel',
 ),
 'uk' => 
 array (
 0 => 'погано',
 1 => 'нижче середнього',
 2 => 'середній',
 3 => 'добре',
 4 => 'відмінно',
 ),
 'zh' => 
 array (
 0 => '差',
 1 => '不如一般',
 2 => '一般',
 3 => '好',
 4 => '非常好',
 ),
 'gd' => 
 array (
 0 => 'bochd',
 1 => 'nas ìsle na a ’chuibheasachd',
 2 => 'cuibheasach',
 3 => 'math',
 4 => 'sgoinneil',
 ),
 'hr' => 
 array (
 0 => 'siromašan',
 1 => 'ispod prosjeka',
 2 => 'prosjed',
 3 => 'dobro',
 4 => 'odličan',
 ),
 'id' => 
 array (
 0 => 'miskin',
 1 => 'dibawah rata-rata',
 2 => 'rata-rata',
 3 => 'bagus',
 4 => 'bagus sekali',
 ),
 'is' => 
 array (
 0 => 'fátækur',
 1 => 'fyrir neðan meðallag',
 2 => 'að meðaltali',
 3 => 'góður',
 4 => 'Æðislegt',
 ),
 'he' => 
 array (
 0 => 'עני',
 1 => 'מתחת לממוצע',
 2 => 'מְמוּצָע',
 3 => 'טוֹב',
 4 => 'מְעוּלֶה',
 ),
 'ko' => 
 array (
 0 => '가난한',
 1 => '평균 이하',
 2 => '평균',
 3 => '좋은',
 4 => '훌륭한',
 ),
 'lt' => 
 array (
 0 => 'vargšas',
 1 => 'žemiau vidurkio',
 2 => 'vidurkis',
 3 => 'gerai',
 4 => 'puikus',
 ),
 'ms' => 
 array (
 0 => 'miskin',
 1 => 'bawah purata',
 2 => 'purata',
 3 => 'baik',
 4 => 'cemerlang',
 ),
 'sr' => 
 array (
 0 => 'јадан',
 1 => 'испод просека',
 2 => 'просек',
 3 => 'Добро',
 4 => 'одличан',
 ),
 'th' => 
 array (
 0 => 'ยากจน',
 1 => 'ต่ำกว่าค่าเฉลี่ย',
 2 => 'เฉลี่ย',
 3 => 'ดี',
 4 => 'ยอดเยี่ยม',
 ),
 'vi' => 
 array (
 0 => 'nghèo nàn',
 1 => 'dưới mức trung bình',
 2 => 'Trung bình',
 3 => 'tốt',
 4 => 'thông minh',
 ),
 'mk' => 
 array (
 0 => 'Сиромашен',
 1 => 'под просек',
 2 => 'просек',
 3 => 'Добро',
 4 => 'одлично',
 ),
 'bg' => 
 array (
 0 => 'беден',
 1 => 'под средното',
 2 => 'средно аритметично',
 3 => 'добре',
 4 => 'отлично',
 ),
 'sq' => 
 array (
 0 => 'i varfer',
 1 => 'nën mesataren',
 2 => 'mesatare',
 3 => 'mire',
 4 => 'e shkëlqyeshme',
 ),
 'af' => 
 array (
 0 => 'arm',
 1 => 'onder gemiddeld',
 2 => 'gemiddeld',
 3 => 'goed',
 4 => 'uitstekend',
 ),
 'az' => 
 array (
 0 => 'kasıb',
 1 => 'ortalamadan aşağı',
 2 => 'orta',
 3 => 'yaxşı',
 4 => 'əla',
 ),
 'bn' => 
 array (
 0 => 'দরিদ্র',
 1 => 'গড়ের নিচে',
 2 => 'গড়',
 3 => 'ভাল',
 4 => 'চমৎকার',
 ),
);
private static $widget_recommendation_texts = array (
 'en' => 
 array (
 'negative' => 'NOT_RECOMMEND_ICON not recommends',
 'positive' => 'RECOMMEND_ICON recommends',
 ),
 'fr' => 
 array (
 'negative' => 'NOT_RECOMMEND_ICON ne recommande pas',
 'positive' => 'RECOMMEND_ICON recommande',
 ),
 'de' => 
 array (
 'negative' => 'NOT_RECOMMEND_ICON wird nicht empfohlen',
 'positive' => 'RECOMMEND_ICON empfiehlt',
 ),
 'es' => 
 array (
 'negative' => 'NOT_RECOMMEND_ICON no recomienda',
 'positive' => 'RECOMMEND_ICON recomienda',
 ),
 'ar' => 
 array (
 'negative' => 'لا توصي NOT_RECOMMEND_ICON',
 'positive' => 'توصي RECOMMEND_ICON',
 ),
 'cs' => 
 array (
 'negative' => 'NOT_RECOMMEND_ICON not nedoporučuje',
 'positive' => 'RECOMMEND_ICON doporučuje',
 ),
 'da' => 
 array (
 'negative' => 'NOT_RECOMMEND_ICON anbefaler ikke',
 'positive' => 'RECOMMEND_ICON anbefaler',
 ),
 'et' => 
 array (
 'negative' => 'NOT_RECOMMEND_ICON ei soovita',
 'positive' => 'RECOMMEND_ICON soovitab',
 ),
 'el' => 
 array (
 'negative' => 'NOT_RECOMMEND_ICON δεν συνιστά',
 'positive' => 'RECOMMEND_ICON συνιστά',
 ),
 'fi' => 
 array (
 'negative' => 'NOT_RECOMMEND_ICON ei suosittele',
 'positive' => 'RECOMMEND_ICON suosittelee',
 ),
 'hi' => 
 array (
 'negative' => 'NOT_RECOMMEND_ICON अनुशंसा नहीं करता है',
 'positive' => 'RECOMMEND_ICON अनुशंसा करता है',
 ),
 'hu' => 
 array (
 'negative' => 'NOT_RECOMMEND_ICON nem ajánlja',
 'positive' => 'RECOMMEND_ICON ajánlja',
 ),
 'it' => 
 array (
 'negative' => 'NOT_RECOMMEND_ICON non lo consiglia',
 'positive' => 'RECOMMEND_ICON consiglia',
 ),
 'ja' => 
 array (
 'negative' => 'NOT_RECOMMEND_ICON おすすめできない',
 'positive' => 'RECOMMEND_ICON おすすめ',
 ),
 'nl' => 
 array (
 'negative' => 'NOT_RECOMMEND_ICON raadt niet aan',
 'positive' => 'RECOMMEND_ICON raadt aan',
 ),
 'no' => 
 array (
 'negative' => 'NOT_RECOMMEND_ICON anbefaler ikke',
 'positive' => 'RECOMMEND_ICON anbefaler',
 ),
 'pl' => 
 array (
 'negative' => 'NOT_RECOMMEND_ICON nie zaleca',
 'positive' => 'RECOMMEND_ICON poleca',
 ),
 'pt' => 
 array (
 'negative' => 'NOT_RECOMMEND_ICON não recomenda',
 'positive' => 'RECOMMEND_ICON recomenda',
 ),
 'ro' => 
 array (
 'negative' => 'NOT_RECOMMEND_ICON nu recomandă',
 'positive' => 'RECOMMEND_ICON recomandă',
 ),
 'ru' => 
 array (
 'negative' => 'NOT_RECOMMEND_ICON не рекомендует',
 'positive' => 'RECOMMEND_ICON рекомендует',
 ),
 'sl' => 
 array (
 'negative' => 'NOT_RECOMMEND_ICON ne priporoča',
 'positive' => 'RECOMMEND_ICON priporoča',
 ),
 'sk' => 
 array (
 'negative' => 'NOT_RECOMMEND_ICON neodporúča',
 'positive' => 'RECOMMEND_ICON odporúča',
 ),
 'sv' => 
 array (
 'negative' => 'NOT_RECOMMEND_ICON rekommenderar inte',
 'positive' => 'RECOMMEND_ICON rekommenderar',
 ),
 'tr' => 
 array (
 'negative' => 'NOT_RECOMMEND_ICON önerilmez',
 'positive' => 'RECOMMEND_ICON önerir',
 ),
 'uk' => 
 array (
 'negative' => 'NOT_RECOMMEND_ICON не рекомендує',
 'positive' => 'RECOMMEND_ICON рекомендує',
 ),
 'zh' => 
 array (
 'negative' => 'NOT_RECOMMEND_ICON 不推荐',
 'positive' => 'RECOMMEND_ICON 推荐',
 ),
 'gd' => 
 array (
 'negative' => 'NOT_RECOMMEND_ICON no moladh',
 'positive' => 'RECOMMEND_ICON a ’moladh',
 ),
 'hr' => 
 array (
 'negative' => 'NOT_RECOMMEND_ICON ne preporučuje',
 'positive' => 'RECOMMEND_ICON preporučuje',
 ),
 'id' => 
 array (
 'negative' => 'NOT_RECOMMEND_ICON tidak merekomendasikan',
 'positive' => 'RECOMMEND_ICON merekomendasikan',
 ),
 'is' => 
 array (
 'negative' => 'NOT_RECOMMEND_ICON mælir ekki með',
 'positive' => 'RECOMMEND_ICON mælir með',
 ),
 'he' => 
 array (
 'negative' => 'NOT_RECOMMEND_ICON לא ממליץ',
 'positive' => 'RECOMMEND_ICON ממליץ',
 ),
 'ko' => 
 array (
 'negative' => 'NOT_RECOMMEND_ICON 권장하지 않음',
 'positive' => 'RECOMMEND_ICON 추천',
 ),
 'lt' => 
 array (
 'negative' => 'NOT_RECOMMEND_ICON nerekomenduoja',
 'positive' => 'RECOMMEND_ICON rekomenduoja',
 ),
 'ms' => 
 array (
 'negative' => 'NOT_RECOMMEND_ICON tidak mengesyorkan',
 'positive' => 'RECOMMEND_ICON mengesyorkan',
 ),
 'sr' => 
 array (
 'negative' => 'NOT_RECOMMEND_ICON не препоручује',
 'positive' => 'RECOMMEND_ICON препоручује',
 ),
 'th' => 
 array (
 'negative' => 'NOT_RECOMMEND_ICON ไม่แนะนำ',
 'positive' => 'RECOMMEND_ICON แนะนำ',
 ),
 'vi' => 
 array (
 'negative' => 'NOT_RECOMMEND_ICON không được đề xuất',
 'positive' => 'RECOMMEND_ICON đề xuất',
 ),
 'mk' => 
 array (
 'negative' => 'NOT_RECOMMEND_ICON не препорачува',
 'positive' => 'RECOMMEND_ICON препорачува',
 ),
 'bg' => 
 array (
 'negative' => 'NOT_RECOMMEND_ICON не препоръчва',
 'positive' => 'RECOMMEND_ICON препоръчва',
 ),
 'sq' => 
 array (
 'negative' => 'NOT_RECOMMEND_ICON nuk rekomandon',
 'positive' => 'RECOMMEND_ICON rekomandon',
 ),
 'af' => 
 array (
 'negative' => 'NOT_RECOMMEND_ICON beveel nie aan',
 'positive' => 'RECOMMEND_ICON beveel aan',
 ),
 'az' => 
 array (
 'negative' => 'NOT_RECOMMEND_ICON tövsiyə etmir',
 'positive' => 'RECOMMEND_ICON tövsiyə edir',
 ),
 'bn' => 
 array (
 'negative' => 'NOT_RECOMMEND_ICON সুপারিশ করে না',
 'positive' => 'RECOMMEND_ICON সুপারিশ করে',
 ),
);
private static $widget_verified_texts = array (
 'en' => 'Verified',
 'fr' => 'vérifié',
 'de' => 'Verifizierte',
 'es' => 'Verificada',
 'ar' => 'تم التحقق',
 'cs' => 'Ověřená',
 'da' => 'Bekræftet',
 'et' => 'Kinnitatud',
 'el' => 'επαληθεύτηκε',
 'fi' => 'Vahvistettu',
 'hi' => 'सत्यापित',
 'hu' => 'Hitelesített',
 'it' => 'Verificata',
 'ja' => '確認済み',
 'nl' => 'Geverifieerde',
 'no' => 'Bekreftet',
 'pl' => 'Zweryfikowana',
 'pt' => 'Verificada',
 'ro' => 'Verificată',
 'ru' => 'Проверенный',
 'sl' => 'Preverjeno',
 'sk' => 'Overená',
 'sv' => 'Verifierad',
 'tr' => 'Doğrulanmış',
 'uk' => 'Перевірено',
 'zh' => '已验证',
 'gd' => 'Dearbhaichte',
 'hr' => 'Potvrđen',
 'id' => 'Diverifikasi',
 'is' => 'Staðfesting',
 'he' => 'מְאוּמָת',
 'ko' => '검증 된',
 'lt' => 'Patvirtinta',
 'ms' => 'Disahkan',
 'sr' => 'Проверено',
 'th' => 'ตรวจสอบแล้ว',
 'vi' => 'Đã xác minh',
 'mk' => 'Потврдена',
 'bg' => 'Проверени',
 'sq' => 'Verifikuar',
 'af' => 'Geverifieer',
 'az' => 'Doğrulanmışdır',
 'bn' => 'যাচাই',
);
private static $widget_month_names = array (
 'en' => 
 array (
 0 => 'January',
 1 => 'February',
 2 => 'March',
 3 => 'April',
 4 => 'May',
 5 => 'June',
 6 => 'July',
 7 => 'August',
 8 => 'September',
 9 => 'October',
 10 => 'November',
 11 => 'December',
 ),
 'et' => 
 array (
 0 => 'jaanuar',
 1 => 'veebruar',
 2 => 'märts',
 3 => 'aprill',
 4 => 'mai',
 5 => 'juuni',
 6 => 'juuli',
 7 => 'august',
 8 => 'september',
 9 => 'oktoober',
 10 => 'november',
 11 => 'detsember',
 ),
 'ar' => 
 array (
 0 => 'يناير',
 1 => 'فبراير',
 2 => 'مارس',
 3 => 'أبريل',
 4 => 'مايو',
 5 => 'يونيو',
 6 => 'يوليه',
 7 => 'أغسطس',
 8 => 'سبتمبر',
 9 => 'أكتوبر',
 10 => 'نوفمبر',
 11 => 'ديسمبر',
 ),
 'zh' => 
 array (
 0 => '一月',
 1 => '二月',
 2 => '三月',
 3 => '四月',
 4 => '五月',
 5 => '六月',
 6 => '七月',
 7 => '八月',
 8 => '九月',
 9 => '十月',
 10 => '十一月',
 11 => '十二月',
 ),
 'cs' => 
 array (
 0 => 'Leden',
 1 => 'Únor',
 2 => 'Březen',
 3 => 'Duben',
 4 => 'Květen',
 5 => 'Červen',
 6 => 'Červenec',
 7 => 'Srpen',
 8 => 'Září',
 9 => 'Říjen',
 10 => 'Listopad',
 11 => 'Prosinec',
 ),
 'da' => 
 array (
 0 => 'Januar',
 1 => 'Februar',
 2 => 'Marts',
 3 => 'April',
 4 => 'Maj',
 5 => 'Juni',
 6 => 'Juli',
 7 => 'August',
 8 => 'September',
 9 => 'Oktober',
 10 => 'November',
 11 => 'December',
 ),
 'nl' => 
 array (
 0 => 'Januari',
 1 => 'Februari',
 2 => 'Maart',
 3 => 'April',
 4 => 'Mei',
 5 => 'Juni',
 6 => 'Juli',
 7 => 'Augustus',
 8 => 'September',
 9 => 'Oktober',
 10 => 'November',
 11 => 'December',
 ),
 'fi' => 
 array (
 0 => 'Tammikuu',
 1 => 'Helmikuu',
 2 => 'Maaliskuu',
 3 => 'Huhtikuu',
 4 => 'Toukokuu',
 5 => 'Kesäkuu',
 6 => 'Heinäkuu',
 7 => 'Elokuu',
 8 => 'Syyskuu',
 9 => 'Lokakuu',
 10 => 'Marraskuu',
 11 => 'Joulukuu',
 ),
 'fr' => 
 array (
 0 => 'Janvier',
 1 => 'Février',
 2 => 'Mars',
 3 => 'Avril',
 4 => 'Mai',
 5 => 'Juin',
 6 => 'Juillet',
 7 => 'Août',
 8 => 'Septembre',
 9 => 'Octobre',
 10 => 'Novembre',
 11 => 'Décembre',
 ),
 'de' => 
 array (
 0 => 'Januar',
 1 => 'Februar',
 2 => 'März',
 3 => 'April',
 4 => 'Mai',
 5 => 'Juni',
 6 => 'Juli',
 7 => 'August',
 8 => 'September',
 9 => 'Oktober',
 10 => 'November',
 11 => 'Dezember',
 ),
 'el' => 
 array (
 0 => 'Iανουάριος',
 1 => 'Φεβρουάριος',
 2 => 'Μάρτιος',
 3 => 'Aρίλιος',
 4 => 'Μάιος',
 5 => 'Iούνιος',
 6 => 'Iούλιος',
 7 => 'Αύγουστος',
 8 => 'Σεπτέμβριος',
 9 => 'Oκτώβριος',
 10 => 'Νοέμβριος',
 11 => 'Δεκέμβριος',
 ),
 'he' => 
 array (
 0 => 'ינואר',
 1 => 'פברואר',
 2 => 'מרץ',
 3 => 'אפריל',
 4 => 'מאי',
 5 => 'יוני',
 6 => 'יולי',
 7 => 'אוגוסט',
 8 => 'ספטמבר',
 9 => 'אוקטובר',
 10 => 'נובמבר',
 11 => 'דצמבר',
 ),
 'hi' => 
 array (
 0 => 'जनवरी',
 1 => 'फ़रवरी',
 2 => 'मार्च',
 3 => 'अप्रैल',
 4 => 'मई',
 5 => 'जून',
 6 => 'जुलाई',
 7 => 'अगस्त',
 8 => 'सितंबर',
 9 => 'अक्टूबर',
 10 => 'नवंबर',
 11 => 'दिसंबर',
 ),
 'hu' => 
 array (
 0 => 'Január',
 1 => 'Február',
 2 => 'Március',
 3 => 'Április',
 4 => 'Május',
 5 => 'Június',
 6 => 'Július',
 7 => 'Augusztus',
 8 => 'Szeptember',
 9 => 'Október',
 10 => 'November',
 11 => 'December',
 ),
 'it' => 
 array (
 0 => 'Gennaio',
 1 => 'Febbraio',
 2 => 'Marzo',
 3 => 'Aprile',
 4 => 'Maggio',
 5 => 'Giugno',
 6 => 'Luglio',
 7 => 'Agosto',
 8 => 'Settembre',
 9 => 'Ottobre',
 10 => 'Novembre',
 11 => 'Dicembre',
 ),
 'ja' => 
 array (
 0 => '1月',
 1 => '2月',
 2 => '3月',
 3 => '4月',
 4 => '5月',
 5 => '6月',
 6 => '7月',
 7 => '8月',
 8 => '9月',
 9 => '10月',
 10 => '11月',
 11 => '12月',
 ),
 'no' => 
 array (
 0 => 'Januar',
 1 => 'Februar',
 2 => 'Mars',
 3 => 'April',
 4 => 'Mai',
 5 => 'Juni',
 6 => 'Juli',
 7 => 'August',
 8 => 'September',
 9 => 'Oktober',
 10 => 'November',
 11 => 'Desember',
 ),
 'pl' => 
 array (
 0 => 'Styczeń',
 1 => 'Luty',
 2 => 'Marzec',
 3 => 'Kwiecień',
 4 => 'Maj',
 5 => 'Czerwiec',
 6 => 'Lipiec',
 7 => 'Sierpień',
 8 => 'Wrzesień',
 9 => 'Październik',
 10 => 'Listopad',
 11 => 'Grudzień',
 ),
 'pt' => 
 array (
 0 => 'Janeiro',
 1 => 'Fevereiro',
 2 => 'Março',
 3 => 'Abril',
 4 => 'Maio',
 5 => 'Junho',
 6 => 'Julho',
 7 => 'Agosto',
 8 => 'Setembro',
 9 => 'Outubro',
 10 => 'Novembro',
 11 => 'Dezembro',
 ),
 'ro' => 
 array (
 0 => 'Ianuarie',
 1 => 'Februarie',
 2 => 'Martie',
 3 => 'Aprilie',
 4 => 'Mai',
 5 => 'Iunie',
 6 => 'Iulie',
 7 => 'August',
 8 => 'Septembrie',
 9 => 'Octombrie',
 10 => 'Noiembrie',
 11 => 'Decembrie',
 ),
 'ru' => 
 array (
 0 => 'январь',
 1 => 'февраль',
 2 => 'март',
 3 => 'апрель',
 4 => 'май',
 5 => 'июнь',
 6 => 'июль',
 7 => 'август',
 8 => 'сентябрь',
 9 => 'октябрь',
 10 => 'ноябрь',
 11 => 'декабрь',
 ),
 'sk' => 
 array (
 0 => 'Január',
 1 => 'Február',
 2 => 'Marec',
 3 => 'Apríl',
 4 => 'Máj',
 5 => 'Jún',
 6 => 'Júl',
 7 => 'August',
 8 => 'September',
 9 => 'Október',
 10 => 'November',
 11 => 'December',
 ),
 'sl' => 
 array (
 0 => 'Januar',
 1 => 'Februar',
 2 => 'Marec',
 3 => 'April',
 4 => 'Maj',
 5 => 'Junij',
 6 => 'Julij',
 7 => 'Avgust',
 8 => 'September',
 9 => 'Oktober',
 10 => 'November',
 11 => 'December',
 ),
 'es' => 
 array (
 0 => 'Enero',
 1 => 'Febrero',
 2 => 'Marzo',
 3 => 'Abril',
 4 => 'Mayo',
 5 => 'Junio',
 6 => 'Julio',
 7 => 'Agosto',
 8 => 'Septiembre',
 9 => 'Octubre',
 10 => 'Noviembre',
 11 => 'Diciembre',
 ),
 'sv' => 
 array (
 0 => 'Januari',
 1 => 'Februari',
 2 => 'Mars',
 3 => 'April',
 4 => 'Maj',
 5 => 'Juni',
 6 => 'Juli',
 7 => 'Augusti',
 8 => 'September',
 9 => 'Oktober',
 10 => 'November',
 11 => 'December',
 ),
 'tr' => 
 array (
 0 => 'Ocak',
 1 => 'Şubat',
 2 => 'Mart',
 3 => 'Nisan',
 4 => 'Mayis',
 5 => 'Haziran',
 6 => 'Temmuz',
 7 => 'Ağustos',
 8 => 'Eylül',
 9 => 'Ekim',
 10 => 'Kasım',
 11 => 'Aralık',
 ),
 'uk' => 
 array (
 0 => 'Січня',
 1 => 'Лютий',
 2 => 'Березень',
 3 => 'квітень',
 4 => 'травень',
 5 => 'червень',
 6 => 'липень',
 7 => 'серпень',
 8 => 'вересень',
 9 => 'жовтень',
 10 => 'листопад',
 11 => 'грудень',
 ),
 'gd' => 
 array (
 0 => 'am Faoilleach',
 1 => 'an Gearran',
 2 => 'am Màrt',
 3 => 'an Giblean',
 4 => 'an Cèitean',
 5 => 'an t-Ògmhios',
 6 => 'an t-luchar',
 7 => 'an Lùnastal',
 8 => 'an t-Sultain',
 9 => 'an Dàmhair',
 10 => 'an t-Samhain',
 11 => 'an Dùbhlachd',
 ),
 'hr' => 
 array (
 0 => 'Siječanj',
 1 => 'Veljača',
 2 => 'Ožujak',
 3 => 'Travanj',
 4 => 'Svibanj',
 5 => 'Lipanj',
 6 => 'Srpanj',
 7 => 'Kolovoz',
 8 => 'Rujan',
 9 => 'Listopad',
 10 => 'Studeni',
 11 => 'Prosinac',
 ),
 'id' => 
 array (
 0 => 'Januari',
 1 => 'Februari',
 2 => 'Maret',
 3 => 'April',
 4 => 'Mei',
 5 => 'Juni',
 6 => 'Juli',
 7 => 'Agustus',
 8 => 'September',
 9 => 'Oktober',
 10 => 'November',
 11 => 'Desember',
 ),
 'is' => 
 array (
 0 => 'Janúar',
 1 => 'Febrúar',
 2 => 'Mars',
 3 => 'April',
 4 => 'Maí',
 5 => 'Júní',
 6 => 'Júlí',
 7 => 'Ágúst',
 8 => 'September',
 9 => 'Október',
 10 => 'Nóvember',
 11 => 'Desember',
 ),
 'ko' => 
 array (
 0 => '일월',
 1 => '이월',
 2 => '삼월',
 3 => '사월',
 4 => '오월',
 5 => '유월',
 6 => '칠월',
 7 => '팔월',
 8 => '구월',
 9 => '시월',
 10 => '십일월',
 11 => '십이월',
 ),
 'lt' => 
 array (
 0 => 'Sausis',
 1 => 'Vasaris',
 2 => 'Kovas',
 3 => 'Balandis',
 4 => 'Gegužė',
 5 => 'Birželis',
 6 => 'Liepa',
 7 => 'Rugpjūtis',
 8 => 'Rugsėjis',
 9 => 'Spalis',
 10 => 'Lapkritis',
 11 => 'Gruodis',
 ),
 'ms' => 
 array (
 0 => 'Januari',
 1 => 'Februari',
 2 => 'Mac',
 3 => 'April',
 4 => 'Mei',
 5 => 'Jun',
 6 => 'Julai',
 7 => 'Ogos',
 8 => 'September',
 9 => 'Oktober',
 10 => 'November',
 11 => 'Disember',
 ),
 'sr' => 
 array (
 0 => 'Јануар',
 1 => 'Фебруар',
 2 => 'Март',
 3 => 'Април',
 4 => 'мај',
 5 => 'Јуни',
 6 => 'Јул',
 7 => 'Август',
 8 => 'септембар',
 9 => 'Октобар',
 10 => 'Новембар',
 11 => 'Децембар',
 ),
 'th' => 
 array (
 0 => 'มกราคม',
 1 => 'กุมภาพันธ์',
 2 => 'มีนาคม',
 3 => 'เมษายน',
 4 => 'พฤษภาคม',
 5 => 'มิถุนายน',
 6 => 'กรกฎาคม',
 7 => 'สิงหาคม',
 8 => 'กันยายน',
 9 => 'ตุลาคม',
 10 => 'พฤศจิกายน',
 11 => 'ธันวาคม',
 ),
 'vi' => 
 array (
 0 => 'tháng một',
 1 => 'tháng hai',
 2 => 'tháng ba',
 3 => 'tháng tư',
 4 => 'tháng năm',
 5 => 'tháng sáu',
 6 => 'tháng bảy',
 7 => 'tháng tám',
 8 => 'tháng chín',
 9 => 'tháng mười',
 10 => 'tháng mười một',
 11 => 'tháng mười hai',
 ),
 'mk' => 
 array (
 0 => 'Jануари',
 1 => 'февруари',
 2 => 'март',
 3 => 'април',
 4 => 'мај',
 5 => 'јуни',
 6 => 'јули',
 7 => 'август',
 8 => 'септември',
 9 => 'октомври',
 10 => 'ноември',
 11 => 'декември',
 ),
 'bg' => 
 array (
 0 => 'Януари',
 1 => 'февруари',
 2 => 'Март',
 3 => 'Aприл',
 4 => 'май',
 5 => 'юни',
 6 => 'юли',
 7 => 'Август',
 8 => 'Септември',
 9 => 'Октомври',
 10 => 'Ноември',
 11 => 'Декември',
 ),
 'sq' => 
 array (
 0 => 'Janar',
 1 => 'Shkurt',
 2 => 'Mars',
 3 => 'Prill',
 4 => 'Maj',
 5 => 'Qershor',
 6 => 'Korrik',
 7 => 'Gusht',
 8 => 'Shtator',
 9 => 'Tetor',
 10 => 'Nëntor',
 11 => 'Dhjetor',
 ),
 'af' => 
 array (
 0 => 'Januarie',
 1 => 'Februarie',
 2 => 'Maart',
 3 => 'April',
 4 => 'Mei',
 5 => 'Junie',
 6 => 'Julie',
 7 => 'Augustus',
 8 => 'September',
 9 => 'Oktober',
 10 => 'November',
 11 => 'Desember',
 ),
 'az' => 
 array (
 0 => 'Yanvar',
 1 => 'Fevral',
 2 => 'Mart',
 3 => 'Aprel',
 4 => 'May',
 5 => 'İyun',
 6 => 'İyul',
 7 => 'Avqust',
 8 => 'Sentyabr',
 9 => 'Oktyabr',
 10 => 'Noyabr',
 11 => 'Dekabr',
 ),
 'bn' => 
 array (
 0 => 'জানুয়ারি',
 1 => 'ফেব্রুয়ারি',
 2 => 'মার্চ',
 3 => 'এপ্রিল',
 4 => 'মে',
 5 => 'জুন',
 6 => 'জুলাই',
 7 => 'আগস্ট',
 8 => 'সেপ্টেম্বর',
 9 => 'অক্টোবর',
 10 => 'নভেম্বর',
 11 => 'ডিসেম্বর',
 ),
);
private static $page_urls = array (
 'facebook' => 'https://www.facebook.com/pg/%page_id%',
 'google' => 'https://www.google.com/maps/search/?api=1&query=Google&query_place_id=%page_id%',
 'tripadvisor' => 'https://www.tripadvisor.com/%page_id%',
 'yelp' => 'https://www.yelp.com/biz/%25page_id%25',
 'booking' => 'https://www.booking.com/hotel/%page_id%',
 'amazon' => 'https://www.amazon.%domain%/sp?seller=%page_id%',
 'arukereso' => 'https://www.arukereso.hu/stores/%page_id%/#velemenyek',
 'airbnb' => 'https://www.airbnb.com/rooms/%page_id%',
 'hotels' => 'https://hotels.com/%page_id%',
 'opentable' => 'https://www.opentable.com/%page_id%',
 'foursquare' => 'https://foursquare.com/v/%25page_id%25',
 'capterra' => 'https://www.capterra.com/p/%page_id%/reviews',
 'szallashu' => 'https://szallas.hu/%page_id%?#rating',
 'thumbtack' => 'https://www.thumbtack.com/%page_id%',
 'expedia' => 'https://www.expedia.com/%page_id%',
 'zillow' => 'https://www.zillow.com/profile/%page_id%/#reviews',
 'wordpressPlugin' => 'https://www.wordpress.org/plugins/%page_id%',
 'aliexpress' => 'https://www.aliexpress.com/store/%page_id%',
 'alibaba' => 'https://%page_id%.en.alibaba.com',
 'sourceForge' => 'https://sourceforge.net/software/product/%page_id%/',
 'ebay' => 'https://www.ebay.com/fdbk/feedback_profile/%page_id%',
);
public function getPageUrl()
{
if(!isset(self::$page_urls[ $this->shortname ]))
{
return "";
}
$page_details = get_option($this->get_option_name('page-details'));
if(!$page_details)
{
return "";
}
$page_id = $page_details['id'];
$domain = "";
if($this->shortname == "amazon" || $this->shortname == "arukereso")
{
$tmp = explode('|', $page_id);
$domain = $tmp[0];
if(isset($tmp[1]))
{
$page_id = $tmp[1];
}
else
{
$domain = 'com';
}
}
$url = str_replace([ '%domain%', '%page_id%', '%25page_id%25' ], [ $domain, $page_id, $page_id ], self::$page_urls[ $this->shortname ]);
if($this->shortname == "airbnb")
{
$url = str_replace('rooms/experiences/', 'experiences/', $url);
}
return $url;
}
public function getReviewHtml($review)
{
$html = preg_replace('/\r\n|\r|\n/', "\n", html_entity_decode($review->text, ENT_HTML5 | ENT_QUOTES));
if(isset($review->highlight) && $review->highlight)
{
$tmp = explode(',', $review->highlight);
$start = (int)$tmp[0];
$length = (int)$tmp[1];
$html = mb_substr($html, 0, $start) . '<mark class="ti-highlight">' . mb_substr($html, $start, $length) . '</mark>' . mb_substr($html, $start + $length, mb_strlen($html));
/* format <mark></mark> tags in other tags
 * like:
 * <strong><mark>...</strong>...</mark>....
 * to:
 * <strong><mark>...</mark></strong><mark>...</mark>....
 */
preg_match('/<mark class="ti-highlight">(.*)<\/mark>/Us', $html, $matches);
if(isset($matches[1]))
{
$replaced_content = preg_replace('/(<\/?[^>]+>)/U', '</mark>$1<mark class="ti-highlight">', $matches[1]);
$html = str_replace($matches[0], '<mark class="ti-highlight">' . $replaced_content . '</mark>', $html);
}
}
return $html;
}
private $preview_content = null;
private $template_cache = null;
public function get_noreg_list_reviews($force_platform = null, $list_all = false, $default_style_id = 4, $default_set_id = 'light-background', $only_preview = false, $default_reviews = false)
{
global $wpdb;
$dbtable = $this->get_noreg_tablename($force_platform);
$page_details = get_option($this->get_option_name('page-details'));
$style_id = (int)get_option($this->get_option_name('style-id'), 4);
$content = get_option($this->get_option_name('review-content'));
$lang = get_option($this->get_option_name('lang'), 'en');
$dateformat = get_option($this->get_option_name('dateformat'), 'Y-m-d');
$no_rating_text = get_option($this->get_option_name('no-rating-text'));
$verified_icon = get_option($this->get_option_name('verified-icon'), 0);
$show_reviewers_photo = get_option($this->get_option_name('show-reviewers-photo'), 1);
$set_id = get_option($this->get_option_name('scss-set'), 'light-background');
$show_logos = get_option($this->get_option_name('show-logos'), 1);
$show_stars = get_option($this->get_option_name('show-stars'), 1);
$need_to_parse = true;
if($only_preview)
{
$content = false;
$style_id = $default_style_id;
$set_id = $default_set_id;
$show_logos = 1;
$show_stars = 1;
$show_reviewers_photo = 1;
if($this->preview_content && $this->preview_content['id'] == $style_id)
{
$content = $this->preview_content['content'];
$need_to_parse = false;
}
}
if(is_null($no_rating_text))
{
$no_rating_text = in_array($style_id, [ 15, 19 ]) ? 1 : 0;
}
if($default_reviews)
{
$page_details['rating_number'] = 9;
if($this->is_ten_scale_rating_platform())
{
$page_details['rating_score'] = number_format(rand(10, 100) / 10, 1);
}
else
{
$page_details['rating_score'] = rand(1, 5);
}
$reviews = $this->getRandomReviews();
}
else
{
$sql_rating_field = 'rating';
if($this->is_ten_scale_rating_platform())
{
$sql_rating_field = 'ROUND(rating / 2, 0)';
}
$sql = "SELECT *, rating as original_rating, $sql_rating_field as rating FROM $dbtable ";
$filter = get_option($this->get_option_name('filter'));
if(!$list_all && $filter)
{
if(count($filter['stars']) == 0)
{
$sql .= "WHERE 0 ";
}
else
{
$sql .= "WHERE ($sql_rating_field IN (". implode(',', $filter['stars']) .")";
if(in_array(5, $filter['stars']))
{
$sql .= ' or rating IS NULL';
}
$sql .= ') ';
if($filter['only-ratings'])
{
$sql .= "and text != '' ";
}
}
}
$sql .= "ORDER BY date DESC";
if($only_preview || !$list_all)
{
switch($style_id)
{
case 16:
case 31:
$sql .= " LIMIT 9";
break;
default:
$sql .= " LIMIT 10";
break;
}
}
$reviews = $wpdb->get_results($sql);
}
$script_name = 'trustindex-js';
if(!wp_script_is($script_name, 'enqueued'))
{
wp_enqueue_script($script_name, 'https://cdn.trustindex.io/loader.js', [], false, true);
}
$scripts = wp_scripts();
if(isset($scripts->registered[ $script_name ]) && !isset($scripts->registered[ $script_name ]->extra['after']))
{
wp_add_inline_script($script_name, '(function ti_init() {
if(typeof Trustindex == "undefined"){setTimeout(ti_init, 1985);return false;}
if(typeof Trustindex.pager_inited != "undefined"){return false;}
Trustindex.init_pager(document.querySelectorAll(".ti-widget"));
})();');
}
if($content === false || empty($content) || (strpos($content, '<!-- R-LIST -->') === false && $need_to_parse))
{
if(!$this->template_cache)
{
add_action('http_api_curl', function( $handle ){
curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($handle, CURLOPT_SSL_VERIFYHOST, false);
}, 10);
$response = wp_remote_get("https://cdn.trustindex.io/widget-assets/template/$lang.json");
if(is_wp_error($response))
{
echo $this->get_alertbox('error', '<br />' .$this->___('Could not download the template for the widget.<br />Please reload the page.<br />If the problem persists, please write an email to support@trustindex.io.'));
die;
}
$this->template_cache = json_decode($response['body'], true);
}
$content = $this->template_cache[$style_id];
if(!$only_preview)
{
update_option($this->get_option_name('review-content'), $content, false);
}
}
if($need_to_parse)
{
$content = $this->parse_noreg_list_reviews([
'content' => $content,
'reviews' => $reviews,
'page_details' => $page_details,
'style_id' => $style_id,
'set_id' => $set_id,
'no_rating_text' => $no_rating_text,
'dateformat' => $dateformat,
'language' => $lang,
'verified_icon' => $verified_icon,
'show_reviewers_photo' => $show_reviewers_photo
]);
$this->preview_content = [
'id' => $style_id,
'content' => $content
];
}
$content = preg_replace('/data-set[_-]id=[\'"][^\'"]*[\'"]/m', 'data-set-id="'. $set_id .'"', $content);
$class_appends = [];
if(!$show_logos)
{
array_push($class_appends, 'ti-no-logo');
}
if(!$show_stars)
{
array_push($class_appends, 'ti-no-stars');
}
$free_css_class = 'ti-' . substr($this->shortname, 0, 4);
if($only_preview)
{
wp_enqueue_style("trustindex-widget-css-". $this->shortname ."-". $style_id . "-". $set_id, "https://cdn.trustindex.io/assets/widget-presetted-css/". $style_id ."-". $set_id .".css");
}
else
{
$widget_css = get_option($this->get_option_name('css-content'));
if(!$widget_css)
{
wp_enqueue_style("trustindex-widget-css-" . $this->shortname, "https://cdn.trustindex.io/widget-assets/css/". $style_id ."-blue.css");
}
else
{
array_push($class_appends, $free_css_class);
}
}
if($class_appends)
{
$content = str_replace('class="ti-widget" data-layout-id=', 'class="ti-widget '. implode(' ', $class_appends) .'" data-layout-id=', $content);
if(!did_action('wp_head'))
{
$content .= '<style type="text/css">'. $widget_css .'</style>';
}
else
{
if(in_array($free_css_class, $class_appends) && wp_script_is('trustindex-frontend-js-' . $this->shortname, 'queue'))
{
$content = str_replace(' class="ti-widget ', ' style="display: none" class="ti-widget ', $content);
}
}
}
return $content;
}
public function parse_noreg_list_reviews($array = [])
{
preg_match('/<!-- R-LIST -->(.*)<!-- R-LIST -->/', $array['content'], $matches);
if(isset($matches[1]))
{
$reviewContent = "";
if($array['reviews'] && count($array['reviews'])) foreach($array['reviews'] as $r)
{
$date = "&nbsp;";
if($r->date && $r->date != '0000-00-00')
{
$date = str_replace(self::$widget_month_names['en'], self::$widget_month_names[$array['language']], date($array['dateformat'], strtotime($r->date)));
}
$rating_content = $this->get_rating_stars($r->rating);
if($this->shortname == 'facebook' && in_array($r->rating, [ 1, 5 ]))
{
if($r->rating == 1)
{
$rating_content = self::$widget_recommendation_texts[ $array['language'] ]['negative'];
}
else
{
$rating_content = self::$widget_recommendation_texts[ $array['language'] ]['positive'];
}
$r_text = trim(str_replace([ 'NOT_RECOMMEND_ICON', 'RECOMMEND_ICON' ], '', $rating_content));
$rating_content = '<span class="ti-recommendation">'. str_replace([
'NOT_RECOMMEND_ICON',
'RECOMMEND_ICON',
' ' . $r_text,
$r_text . ' '
], [
'<span class="ti-recommendation-icon negative"></span>',
'<span class="ti-recommendation-icon positive"></span>',
'<span class="ti-recommendation-title">'. $r_text .'</span>',
'<span class="ti-recommendation-title">'. $r_text .'</span>'
], $rating_content) .'</span>';
$rating_content .= '<span class="ti-dummy-stars">';
for($si = 1; $si <= 5; $si++)
{
$rating_content .= '<span class="ti-star '. ($si == 1 || $r->rating == 5 ? 'f' : 'e') .'"></span>';
}
$rating_content .= '</span>';
}
else if($this->shortname == 'ebay' && in_array($r->rating, [ 1, 3, 5 ]))
{
if($r->rating == 1)
{
$polarity = 'negative';
}
else if($r->rating == 3)
{
$polarity = 'neutral';
}
else
{
$polarity = 'positive';
}
$rating_content = '<span class="ti-polarity"><span class="ti-polarity-icon ' . $polarity . '"></span></span>';
}
else if($this->is_ten_scale_rating_platform())
{
$rating_content = '<div class="ti-rating-box">'. $this->formatTenRating($r->original_rating) .'</div>';
}
if($array['verified_icon'])
{
if($array['style_id'] == 21)
{
$rating_content .= '</div><div class="ti-logo-text"><span class="ti-verified-review"><span class="ti-verified-tooltip">'. self::$widget_verified_texts[ $array['language'] ] .'</span></span><span class="ti-logo-title">Trustindex</span></div><div>';
}
else
{
$rating_content .= '<span class="ti-verified-review"><span class="ti-verified-tooltip">'. self::$widget_verified_texts[ $array['language'] ] .'</span></span>';
}
}
$platform_name = ucfirst($this->getShortName());
if($platform_name == 'Szallashu')
{
$tmp = explode('/', $array['page_details']['id']);
$platform_name .= '" data-domain="' . $tmp[0];
}
if(!$array['show_reviewers_photo'])
{
$matches[1] = str_replace('<div class="ti-profile-img"> <img src="%reviewer_photo%" alt="%reviewer_name%" /> </div>', '', $matches[1]);
}
$reviewContent .= str_replace([
'%platform%',
'%reviewer_photo%',
'%reviewer_name%',
'%created_at%',
'%text%',
'<span class="ti-star f"></span><span class="ti-star f"></span><span class="ti-star f"></span><span class="ti-star f"></span><span class="ti-star f"></span>'
 ], [
$platform_name,
$r->user_photo,
$r->user,
$date,
$this->getReviewHtml($r),
$rating_content
 ], $matches[1]);
$reviewContent = str_replace('<div></div>', '', $reviewContent);
}
$array['content'] = str_replace($matches[0], $reviewContent, $array['content']);
}
$rating_count = $array['page_details']['rating_number'];
$rating_score = $array['page_details']['rating_score'];
if(empty($rating_count))
{
$rating_count = count($array['reviews']);
}
if(empty($rating_score))
{
$rating_sum = 0.0;
foreach($array['reviews'] as $review)
{
$rating_sum += (float)$review->rating;
}
$c = count($array['reviews']);
$rating_score = $c ? $rating_sum / $c : 0;
}
$array['content'] = str_replace([
'%platform%',
'%site_name%',
"RATING_NUMBER",
"RATING_SCORE",
"RATING_SCALE",
"RATING_TEXT",
"PLATFORM_URL_LOGO",
"PLATFORM_NAME",
'<span class="ti-star e"></span><span class="ti-star e"></span><span class="ti-star e"></span><span class="ti-star e"></span><span class="ti-star e"></span>',
'PLATFORM_SMALL_LOGO'
 ], [
ucfirst($this->getShortName()),
$array['page_details']['name'],
$rating_count,
$rating_score,
$this->is_ten_scale_rating_platform() ? 10 : 5,
$this->get_rating_text($rating_score, $array['language']),
$array['page_details']['avatar_url'],
$this->get_platform_name($this->getShortName(), $array['page_details']['id']),
$this->is_ten_scale_rating_platform() ? "<div class='ti-rating-box'>". $this->formatTenRating($rating_score) ."</div>" : $this->get_rating_stars($rating_score),
'<div class="ti-small-logo"><img src="'. $this->get_plugin_file_url('static/img/platform/logo.svg') . '" alt="'. ucfirst($this->getShortName()) .'"></div>',
 ], $array['content']);
if($this->isDarkLogo($array['style_id'], $array['set_id']))
{
$array['content'] = str_replace('img/platform/logo', 'img/platform/logo-dark', $array['content']);
$array['content'] = str_replace('platform/'. ucfirst($this->getShortName()) .'/logo', 'platform/'. ucfirst($this->getShortName()) .'/logo-dark', $array['content']);
}
if($this->is_ten_scale_rating_platform() && $array['style_id'] == 11)
{
$array['content'] = str_replace('<span class="ti-rating">'. $rating_score .'</span> ', '', $array['content']);
}
if($this->shortname == 'szallashu' || $this->shortname == 'arukereso')
{
$split = '/';
$replace_hu = false;
if($this->shortname == 'arukereso')
{
$split = '|';
$replace_hu = true;
}
$tmp = explode($split, $array['page_details']['id']);
$array['content'] = str_replace([ 'img/platform/logo.svg', 'img/platform/logo-dark.svg' ], [ 'img/platform/logo-'. $tmp[0] .'.svg', 'img/platform/logo-'. $tmp[0] .'-dark.svg' ], $array['content']);
$array['content'] = str_replace([ 'platform/'. ucfirst($this->getShortName()) .'/logo.svg', 'platform/'. ucfirst($this->getShortName()) .'/logo-dark.svg' ], [ 'platform/'. ucfirst($this->shortname) .'/logo-'. $tmp[0] .'.svg', 'platform/'. ucfirst($this->shortname) .'/logo-'. $tmp[0] .'-dark.svg' ], $array['content']);
if($replace_hu)
{
$array['content'] = str_replace('img/platform/logo-hu', 'img/platform/logo', $array['content']);
$array['content'] = str_replace('platform/'. ucfirst($this->getShortName()) .'/logo-hu', 'platform/'. ucfirst($this->getShortName()) .'/logo', $array['content']);
}
}
if(in_array($array['style_id'], [24, 25, 26, 27, 28, 29, 35]))
{
$array['content'] = str_replace('%footer_link%', $this->getPageUrl(), $array['content']);
}
else
{
$array['content'] = preg_replace('/<a href=[\'"]%footer_link%[\'"][^>]*>(.+)<\/a>/mU', '$1', $array['content']);
}
if($array['no_rating_text'])
{
if(in_array($array['style_id'], [6, 7]))
{
$array['content'] = preg_replace('/<div class="ti-footer">.*<\/div>/mU', '<div class="ti-footer"></div>', $array['content']);
}
else if(in_array($array['style_id'], [31, 33]))
{
$array['content'] = preg_replace('/<div class="ti-header source-.*<\/div>\s?<div class="ti-reviews-container">/mU', '<div class="ti-reviews-container">', $array['content']);
}
else if($array['style_id'] == 11)
{
$array['content'] = preg_replace('/<div class="ti-text">.*<\/div>/mU', '', $array['content']);
}
else
{
$array['content'] = preg_replace('/<div class="ti-rating-text">.*<\/div>/mU', '', $array['content']);
}
}
preg_match('/src="([^"]+logo[^\.]*\.svg)"/m', $array['content'], $matches);
if(isset($matches[1]) && !empty($matches[1]))
{
$array['content'] = str_replace($matches[0], $matches[0] . ' width="150" height="25"', $array['content']);
}
return $array['content'];
}
public function isDarkLogo($layout_id, $color_schema)
{
if(in_array($layout_id, [ 5, 9, 31, 34, 33 ]))
{
return substr($color_schema, 0, 5) == 'dark-';
}
switch($color_schema)
{
case 'light-contrast':
case 'dark-background':
case 'dark-border':
return true;
}
return false;
}
public function get_platform_name($type, $id = "")
{
$text = ucfirst($type);
if($text == "Szallashu")
{
$domains = [
'cz' => 'Hotely.cz',
'hu' => 'Szallas.hu',
'ro' => 'Hotelguru.ro',
'com' => 'Revngo.com',
'pl' => 'Noclegi.pl'
];
$tmp = explode('/', $id);
if(isset($domains[ $tmp[0] ]))
{
$text = $domains[ $tmp[0] ];
}
}
else if($text == "Arukereso")
{
$domains = [
'hu' => 'Árukereső.hu',
'bg' => 'Pazaruvaj.com',
'ro' => 'Compari.ro'
];
$tmp = explode('|', $id);
if(isset($domains[ $tmp[0] ]))
{
$text = $domains[ $tmp[0] ];
}
}
else if($text == "WordpressPlugin")
{
$text = "Wordpress Plugin";
}
return $text;
}
public function get_rating_text($rating, $lang = "en")
{
$texts = self::$widget_rating_texts[$lang];
$rating = round($rating);
if($rating < 1) $rating = 1;
elseif($rating > 5) $rating = 5;
if(function_exists('mb_strtoupper'))
{
return mb_strtoupper($texts[$rating - 1]);
}
else
{
return strtoupper($texts[$rating - 1]);
}
}
public function get_rating_stars($rating_score)
{
$text = "";
if(!is_numeric($rating_score))
{
return $text;
}
for ($si = 1; $si <= $rating_score; $si++)
{
$text .= '<span class="ti-star f"></span>';
}
$fractional = $rating_score - floor($rating_score);
if( 0.25 <= $fractional )
{
if ( $fractional < 0.75 )
{
$text .= '<span class="ti-star h"></span>';
}
else
{
$text .= '<span class="ti-star f"></span>';
}
$si++;
}
for (; $si <= 5; $si++)
{
$text .= '<span class="ti-star e"></span>';
}
return $text;
}
private function getRandomReviews()
{
$reviews = [];
for($i = 0; $i < 9; $i++)
{
$r = new stdClass();
$r->id = $i;
$r->user = self::___('Reviewer');
$r->user_photo = 'https://cdn.trustindex.io/assets/default-avatar/noprofile-01.svg';
$r->text = self::___('This is an example review about your business (to demonstrate the widgets...)');
$r->original_rating = rand(1, 5);
$r->rating = $r->original_rating;
$r->highlight = null;
$r->date = date('Y-m-d');
if($this->is_ten_scale_rating_platform())
{
$r->original_rating = number_format(rand(10, 100) / 10, 1);
$r->rating = round($r->original_rating / 2);
}
$reviews[] = $r;
}
return $reviews;
}
public function download_noreg_reviews($page_details, $force_platform = null)
{
$force_platform = $force_platform ? $force_platform : $this->getShortName();
$url = "https://admin.trustindex.io/" . "api/getPromoReviews?platform=".$force_platform."&page_id=" . $page_details['id'];
if($force_platform == 'facebook')
{
$url .= '&access_token='. $page_details['access_token'];
}
if(!isset($page_details['id']) && !trim($page_details['id']))
{
return [ 'success' => false ];
}
$server_output = $this->post_request($url, [
'body' => [ 'wp_info' => $this->get_wp_details() ],
'timeout' => '30',
'redirection' => '5',
'blocking' => true
]);
if($server_output[0] !== '[' && $server_output[0] !== '{')
{
$server_output = substr($server_output, strpos($server_output, '('));
$server_output = trim($server_output,'();');
}
$server_output = json_decode($server_output, true);
return $server_output;
}
public function download_noreg_details($page_details, $force_platform = null)
{
if(!isset($page_details['id']) || empty(trim($page_details['id'])))
{
return null;
}
$force_platform = $force_platform ? $force_platform : $this->getShortName();
$url = "https://admin.trustindex.io/" . "api/getPageDetails?platform=".$force_platform."&page_id=" . $page_details['id'];
if($force_platform == "facebook")
{
$url .= "&access_token=". $page_details['access_token'];
}
$server_output = $this->post_request($url, [
'timeout' => '20',
'redirection' => '5',
'blocking' => true
]);
if($server_output[0] !== '[' && $server_output[0] !== '{')
{
$server_output = substr($server_output, strpos($server_output, '('));
$server_output = trim($server_output,'();');
}
$server_output = json_decode($server_output, true);
return $server_output;
}
public function get_plugin_current_version()
{
add_action('http_api_curl', function( $handle ){
curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($handle, CURLOPT_SSL_VERIFYHOST, false);
}, 10);
$response = wp_remote_get('https://api.wordpress.org/plugins/info/1.2/?action=plugin_information&request[slug]='. $this->get_plugin_slug());
$json = json_decode($response['body'], true);
if(!$json && !isset($json['version']))
{
return false;
}
return $json['version'];
}
public function get_platform_count()
{
add_action('http_api_curl', function( $handle ){
curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($handle, CURLOPT_SSL_VERIFYHOST, false);
}, 10);
$response = wp_remote_get("https://cdn.trustindex.io/assets/platform/total.number");
if(is_wp_error($response))
{
return 0;
}
return intval($response['body']);
}


private function post_request($url, $args)
{
$response = wp_remote_post($url, $args);
if(is_wp_error($response))
{
echo $this->get_alertbox('error', '<br />Error with wp_remote_post, error message: <br /><b>'. $response->get_error_message() .'</b>');
die;
}
return wp_remote_retrieve_body($response);
}


public function is_trustindex_connected()
{
return get_option($this->get_option_name("subscription-id"));
}
public function get_trustindex_widget_number()
{
$widgets = $this->get_trustindex_widgets();
$number = 0;
foreach ($widgets as $wc)
{
$number += count($wc['widgets']);
}
return $number;
}
public function get_trustindex_widgets()
{
$widgets = array();
$trustindex_subscription_id = $this->is_trustindex_connected();
if ($trustindex_subscription_id)
{
$widgets = wp_remote_get("https://admin.trustindex.io/" . "api/getWidgets?subscription_id=".$trustindex_subscription_id);
if ($widgets)
{
$widgets = json_decode($widgets['body'], true);
}
}
return $widgets;
}
public function connect_trustindex_api($post_data, $mode = "new")
{
$url = "https://admin.trustindex.io/" . "api/connectApi";
$post_data['wp_info'] = $this->get_wp_details();
$server_output = $this->post_request($url, [
'body' => $post_data,
'timeout' => '5',
'redirection' => '5',
'blocking' => true
]);
if($server_output[0] !== '[' && $server_output[0] !== '{')
{
$server_output = substr($server_output, strpos($server_output, '('));
$server_output = trim($server_output,'();');
}
$server_output = json_decode($server_output, true);
if ($server_output['success'])
{
update_option( $this->get_option_name("subscription-id"), $server_output["subscription_id"]);
$GLOBALS['wp_object_cache']->delete( $this->get_option_name('subscription-id'), 'options' );
}
return $server_output;
}


public function register_tinymce_features()
{
if ( ! has_filter( "mce_external_plugins", "add_tinymce_buttons" ) )
{
add_filter( "mce_external_plugins", [$this, "add_tinymce_buttons"] );
add_filter( "mce_buttons", [$this, "register_tinymce_buttons"] );
}
}
public function add_tinymce_buttons( $plugin_array )
{
$plugin_name = 'trustindex';
if (!isset($plugin_array[$plugin_name]))
{
$plugin_array[$plugin_name] = $this->get_plugin_file_url('static/js/admin-editor.js');
}
wp_localize_script( 'jquery', 'ajax_object', array(
'ajax_url' => admin_url( 'admin-ajax.php' ),
));
return $plugin_array;
}
public function register_tinymce_buttons( $buttons )
{
$button_name = 'trustindex';
if (!in_array($button_name, $buttons))
{
array_push( $buttons, $button_name );
}
return $buttons;
}


public function list_trustindex_widgets_ajax()
{
$ti_widgets = $this->get_trustindex_widgets();
if ($this->is_trustindex_connected()): ?>
<?php if ($ti_widgets): ?>
<h2><?php echo TrustindexPlugin::___('Your saved widgets'); ?></h2>
<?php foreach ($ti_widgets as $wc): ?>
<p><strong><?php echo esc_html($wc['name']); ?>:</strong></p>
<p>
<?php foreach ($wc['widgets'] as $w): ?>
<a href="#" class="btn-copy-widget-id" data-ti-id="<?php echo esc_attr($w['id']); ?>">
<span class="dashicons dashicons-admin-post"></span>
<?php echo esc_html($w['name']); ?>
</a><br />
<?php endforeach; ?>
</p>
<?php endforeach; ?>
<?php else: ?>
<?php echo self::get_alertbox("warning",
TrustindexPlugin::___("You have no widget saved!") . " "
. "<a target='_blank' href='" . "https://admin.trustindex.io/" . "widget'>". TrustindexPlugin::___("Let's go, create amazing widgets for free!")."</a>"
); ?>
<?php endif; ?>
<?php else: ?>
<?php echo self::get_alertbox("warning",
TrustindexPlugin::___("You have not set up your Trustindex account yet!") . " "
. TrustindexPlugin::___("Go to <a href='%s'>plugin setup page</a> to complete the one-step setup guide and enjoy the full functionalization!", array(admin_url('admin.php?page='.$this->get_plugin_slug().'/settings.php&tab=setup_trustindex_join')))
); ?>
<?php endif;
wp_die();
}
public function trustindex_add_scripts($hook)
{
if ($hook === 'widgets.php')
{
wp_enqueue_script('trustindex_script', $this->get_plugin_file_url('static/js/admin-widget.js'));
wp_enqueue_style('trustindex_style', $this->get_plugin_file_url('static/css/admin-widget.css'));
}
elseif ($hook === 'post.php')
{
wp_enqueue_style('trustindex_editor_style', $this->get_plugin_file_url('static/css/admin-editor.css'));
}
else
{
$tmp = explode('/', $this->plugin_file_path);
$plugin_slug = preg_replace('/\.php$/', '', array_pop($tmp));
$tmp = explode('/', $hook);
$current_slug = array_shift($tmp);
if($plugin_slug == $current_slug)
{
if(file_exists($this->get_plugin_dir() . 'static/css/admin-page-settings.css'))
{
wp_enqueue_style('trustindex_settings_style_'. $this->shortname, $this->get_plugin_file_url('static/css/admin-page-settings.css'));
}
if(file_exists($this->get_plugin_dir() . 'static/js/admin-page-settings-common.js'))
{
wp_enqueue_script('trustindex_settings_script_common_'. $this->shortname, $this->get_plugin_file_url('static/js/admin-page-settings-common.js'));
}
if(file_exists($this->get_plugin_dir() . 'static/js/admin-page-settings-connect.js'))
{
wp_enqueue_script('trustindex_settings_script_connect_'. $this->shortname, $this->get_plugin_file_url('static/js/admin-page-settings-connect.js'));
}
if(file_exists($this->get_plugin_dir() . 'static/js/admin-page-settings.js'))
{
wp_enqueue_script('trustindex_settings_script_'. $this->shortname, $this->get_plugin_file_url('static/js/admin-page-settings.js') );
}
}
}
wp_register_script('trustindex_admin_popup', $this->get_plugin_file_url('static/js/admin-popup.js') );
wp_enqueue_script('trustindex_admin_popup');
}
public function add_noreg_css_head()
{
if($this->is_noreg_linked())
{
$widget_css = get_option($this->get_option_name('css-content'));
if($widget_css)
{
echo '<style type="text/css">'. html_entity_decode(str_replace('&#039;', "'", esc_html($widget_css))) .'</style>';
}
}
}
public function add_noreg_css_head_admin()
{
$tmp = explode('/', $this->plugin_file_path);
$plugin_slug = preg_replace('/\.php$/', '', array_pop($tmp));
$page = sanitize_text_field(isset($_GET['page']) ? $_GET['page'] : "");
$current_slug = explode('/', $page)[0];
if($plugin_slug == $current_slug)
{
$widget_css = get_option($this->get_option_name('css-content'));
if($widget_css)
{
echo '<style type="text/css">'. html_entity_decode(str_replace('&#039;', "'", esc_html($widget_css))) .'</style>';
}
}
}


public function get_plugin_details( $plugin_slug = null )
{
if (!$plugin_slug)
{
$plugin_slug = $this->get_plugin_slug();
}
$plugin_return = false;
$wp_repo_plugins= '';
$wp_response= '';
$wp_version = get_bloginfo('version');
if ( $plugin_slug && $wp_version > 3.8 )
{
$args = array(
'author' => 'Trustindex.io',
'fields' => array(
'downloaded'=> true,
'active_installs'=> true,
'ratings'=> true
)
);
$wp_response = wp_remote_post(
'http://api.wordpress.org/plugins/info/1.0/',
array(
'body' => array(
'action'=> 'query_plugins',
'request' => serialize( (object) $args )
)
)
);
if ( ! is_wp_error( $wp_response ) )
{
$wp_repo_response = unserialize( wp_remote_retrieve_body( $wp_response ) );
$wp_repo_plugins= $wp_repo_response->plugins;
}
if ( $wp_repo_plugins )
{
foreach ( $wp_repo_plugins as $plugin_details )
{
if ( $plugin_slug == $plugin_details->slug )
{
$plugin_return = $plugin_details;
}
}
}
}
return $plugin_return;
}
public function get_wp_details()
{
$data = [
'domain' => $_SERVER['SERVER_NAME'],
'current_theme' => [ 'slug' => get_template() ],
'themes' => [],
'plugins' => []
];
if(function_exists('wp_get_theme'))
{
$theme = wp_get_theme();
}
else
{
$theme = get_theme(get_current_theme());
}
$data['current_theme']['name'] = $theme['Name'];
$data['current_theme']['author'] = strip_tags($theme['Author']);
$data['current_theme']['version'] = $theme['Version'];
if(function_exists('wp_get_themes'))
{
$themes = wp_get_themes();
}
else
{
$themes = get_themes();
}
if($themes)
{
foreach($themes as $slug => $theme)
{
$data['themes'][] = [
'slug' => $theme['Template'],
'name' => $theme['Name'],
'author' => strip_tags($theme['Author']),
'version' => $theme['Version']
];
}
}
if(!function_exists('get_plugins'))
{
require_once ABSPATH . 'wp-admin/includes/plugin.php';
}
$plugins = get_plugins();
if($plugins)
{
foreach($plugins as $slug => $plugin)
{
$data['plugins'][] = [
'slug' => explode('/', $slug)[0],
'name' => $plugin['Name'],
'author' => strip_tags($plugin['Author']),
'version' => $plugin['Version']
];
}
}
return json_encode($data);
}


public function is_ten_scale_rating_platform()
{
return in_array($this->shortname, [ 'booking', 'hotels', 'foursquare', 'szallashu' ]);
}
public function formatTenRating($rating)
{
if($rating == 10)
{
$rating = '10';
}
if($this->shortname == "booking")
{
$rating = str_replace('.', ',', $rating);
}
return $rating;
}
public function register_block_editor()
{
if(!class_exists('WP_Block_Type_Registry'))
{
return;
}
if(!WP_Block_Type_Registry::get_instance()->is_registered('trustindex/block-selector'))
{
wp_register_script('trustindex-block-editor', $this->get_plugin_file_url('static/block-editor/block-editor.js'), [ 'wp-blocks', 'wp-editor' ], true);
register_block_type('trustindex/block-selector', [ 'editor_script' => 'trustindex-block-editor' ]);
}
}
function is_widget_setted_up() {
$result = [];
$active_plugins = get_option( 'active_plugins' );
$platforms = $this->get_platforms();
foreach ($this->get_plugin_slugs() as $index => $plugin_slug)
{
if (in_array($plugin_slug."/".$plugin_slug.".php", $active_plugins))
{
$active_plugin_slug = $plugin_slug;
$result[$platforms[$index]] = get_option("trustindex-".$platforms[$index]."-widget-setted-up", 0);
}
}
return array(
'result' => $result,
'setup_url' => admin_url('admin.php?page='.$active_plugin_slug.'/settings.php&tab=setup_trustindex_join')
);
}
function init_restapi() {
register_rest_route( 'trustindex/v1', '/get-widgets', array(
'methods' => 'GET',
'callback' => array($this, 'get_trustindex_widgets'),
'permission_callback' => '__return_true'
) );
register_rest_route( 'trustindex/v1', '/setup-complete', array(
'methods' => 'GET',
'callback' => array($this, 'is_widget_setted_up'),
'permission_callback' => '__return_true'
) );
}
}
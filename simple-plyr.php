<?php
/**
 *
 * @link              https://github.com/bestony/simple-plyr
 * @since             0.0.1
 * @package           Simple Plyr
 *
 * @wordpress-plugin
 * Plugin Name:       Simple Plyr
 * Plugin URI:        https://github.com/bestony/simple-plyr
 * Description:       Simple Plyr Video Player
 * Version:           0.0.1
 * Author:            Bestony
 * Author URI:        https://github.com/bestony
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       plyrio
 * Domain Path:       /languages
 */
// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
    die;
}

// Add Shortcode
function plyr_filter( $atts ) {

    // Attributes
    $atts = shortcode_atts(
        array(
            'url' => '/path/to/video.mp4',
            'poster' => '/path/to/poster.jpg',
        ),
        $atts,
        'plyr'
    );

    $str = sprintf("<video poster='%s' controls><source src='%s' type='video/mp4'></video><script>plyr.setup();</script>",$atts['poster'],$atts['url']);

    return $str;
}
add_shortcode( 'plyr', 'plyr_filter' );

function plyr_assets() {
    $plugin_url = plugin_dir_url( __FILE__ );
    wp_register_style( 'plyr-style',$plugin_url . 'assets/plyr.css');
    wp_enqueue_style( 'plyr-style' );

    wp_register_script ( 'plyr-script',$plugin_url . 'assets/plyr.js' );
    wp_enqueue_script ( 'plyr-script' );
}
add_action( 'wp_enqueue_scripts', 'plyr_assets' );


// Add Quicktags
function plyr_quicktags() {

    if ( wp_script_is( 'quicktags' ) ) {
    ?>
    <script type="text/javascript">
    QTags.addButton( 'plyr', 'Simple Plyr', '[plyr url="/path/to/video.mp4" poster="/path/to/poster.jpg"]', '', '', 'Plyr Video Player', 141 );
    </script>
    <?php
    }

}
add_action( 'admin_print_footer_scripts', 'plyr_quicktags' );
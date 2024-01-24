<?php
/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://atlasaidev.com/
 * @since             1.0.0
 * @package           TTA
 *
 * @wordpress-plugin
 * Plugin Name:       Atlas AiDev
 * Plugin URI:        https://atlasaidev.com/
 * Description:       Atlas AiDev Site Schema
 * Version:           1.0.0
 * Author:            Atlas AiDev
 * Author URI:        http://atlasaidev.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       atlasaidev-schema
 * Domain Path:       /languages
 */

 // If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}

// Absolute path to the WordPress directory.
if (!defined('ABSPATH')) {
    define('ABSPATH', dirname(__FILE__) . '/');
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */

if (!defined('ATLASAIDEV_SCHEMA_NONCE')) {

    define('ATLASAIDEV_SCHEMA_NONCE', 'ATLASAIDEV_SCHEMA_NONCE');
}

if (!defined('ATLASAIDEV_SCHEMA_TEXT_DOMAIN')) {

    define('ATLASAIDEV_SCHEMA_TEXT_DOMAIN', 'text-to-audio');
}

if (!defined('ATLASAIDEV_SCHEMA_ROOT_FILE')) {

    define('ATLASAIDEV_SCHEMA_ROOT_FILE', __FILE__);
}

if (!defined('ATLASAIDEV_SCHEMA_ROOT_FILE_NAME')) {
    $path = explode( DIRECTORY_SEPARATOR, ATLASAIDEV_SCHEMA_ROOT_FILE);
    $file = end($path);
    define('ATLASAIDEV_SCHEMA_ROOT_FILE_NAME', $file);
}


if (!defined('ATLASAIDEV_SCHEMA_DEBUG_MODE')) {

    define('ATLASAIDEV_SCHEMA_DEBUG_MODE', 0);
}


if ( ! defined( 'ATLASAIDEV_SCHEMA_PLUGIN_URL' ) ) {
    /**
     * Plugin Directory URL
     *
     * @var string
     * @since 1.2.2
     */
    define( 'ATLASAIDEV_SCHEMA_PLUGIN_URL', trailingslashit( plugin_dir_url( ATLASAIDEV_SCHEMA_ROOT_FILE ) ) );
}

if ( ! defined( 'ATLASAIDEV_SCHEMA_PLUGIN_PATH' ) ) {
    /**
     * Plugin Directory PATH
     *
     * @var string
     * @since 1.2.2
     */
    define( 'ATLASAIDEV_SCHEMA_PLUGIN_PATH', trailingslashit( plugin_dir_path( ATLASAIDEV_SCHEMA_ROOT_FILE ) ) );
}


if ( ! defined( 'ATLASAIDEV_SCHEMA_PLUGIN_URL' ) ) {
    /**
     * Plugin Directory URL
     *
     * @var string
     * @since 1.2.2
     */
    define( 'ATLASAIDEV_SCHEMA_PLUGIN_URL', trailingslashit( plugin_dir_url( ATLASAIDEV_SCHEMA_ROOT_FILE ) ) );
}

if ( ! defined( 'ATLASAIDEV_SCHEMA_FOLDER_URL' ) ) {
    /**
     * Plugin Directory URL
     *
     * @var string
     * @since 1.2.2
     */
    define( 'ATLASAIDEV_SCHEMA_FOLDER_URL', ATLASAIDEV_SCHEMA_PLUGIN_URL . '/schemas/' );
}

if ( ! defined( 'ATLASAIDEV_SCHEMA_PLUGIN_PATH' ) ) {
    /**
     * Plugin Directory PATH
     *
     * @var string
     * @since 1.2.2
     */
    define( 'ATLASAIDEV_SCHEMA_PLUGIN_PATH', trailingslashit( plugin_dir_path( ATLASAIDEV_SCHEMA_ROOT_FILE ) ) );
}

if ( ! defined( 'ATLASAIDEV_SCHEMA_FOLDER_PATH' ) ) {
    /**
     * Plugin Directory PATH
     *
     * @var string
     * @since 1.2.2
     */
    define( 'ATLASAIDEV_SCHEMA_FOLDER_PATH', ATLASAIDEV_SCHEMA_PLUGIN_PATH .'/schemas/' );
}

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */

class ATLASAIDEV_SCHEMA_Init {

    public function __construct() {
        $this->run();
    }

    public function run() {

        add_action('wp_head', [$this, 'add_schema']);
    }

    public function add_schema() {

            global $post;
            $post_slug = $post->post_name;

            if(is_home() || is_front_page()) {
                $post_slug = 'home';
            }
            
            $file_path  = ATLASAIDEV_SCHEMA_FOLDER_PATH . $post_slug .'.json';
            if(file_exists($file_path)) {
                $file_content = '';
                $file_content = file_get_contents($file_path);
                if(!$file_content) {
                    return;
                }
            ?>
            <script type="application/ld+json">
                "<?php echo $file_content ?>"
            </script>
            <?php
        }
    }
}

add_action('init', function () {
    //Rest api init.
    new ATLASAIDEV_SCHEMA_Init();
});

 /**
 * The code that runs during plugin activation.
 * This action is documented in includes/ATLASAIDEV_SCHEMA_Activator.php
 */
register_activation_hook(__FILE__, function () {
        // ATLASAIDEV_SCHEMA_Activator::activate();
    });
/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/ATLASAIDEV_SCHEMA_Deactivator.php
 */
register_deactivation_hook(__FILE__, function() {
        // ATLASAIDEV_SCHEMA_Deactivator::deactivate();
    });


<?php

/**
 * @package   Automatic_Order_Tasks
 */
/*
Plugin Name: Entrowoo
Plugin URI: https://github.com/wessen123
Description: Automation toolkit for seamless integration of online stores with Entro platform
Version: 2.0.0
Author: Wondwessen "Wessen" Haile
Author URI: https://wondwessenhaileinnovates.net/
*/

if (!defined('ABSPATH')) exit; // Exit if accessed directly

/** Globals **/
define('AOTFW_PLUGIN_NAME', 'EntroWoo');
define('EAOTFW_VERSION', '2.0.0');
define('AOTFW_PLUGIN_URL', plugin_dir_url(__FILE__));
define('AOTFW_PLUGIN_PATH', wp_normalize_path(plugin_dir_path(__FILE__)));
define('AOTFW_LOG_ID_OPTIONS_KEY', '_aotfw-logid');
define('AOTFW_LOG_FOLDER_PREFIX', 'aotfw-log-');

if (!class_exists('Entro_Automatic_Order_Tasks')) {
    class Entro_Automatic_Order_Tasks
    {
        public function __construct()
        {
            // Activation hook
            register_activation_hook(__FILE__, array($this, 'activate'));

            // Deactivation hook
            register_deactivation_hook(__FILE__, array($this, 'deactivate'));

            add_action('init', array($this, 'init'));
        }

        public function init()
        {
            if (!class_exists('woocommerce')) return; // Skip if WooCommerce is not active

            require_once(AOTFW_PLUGIN_PATH . 'inc/class-bootstrap.php');
            AOTFW_Bootstrap::get_instance();
        }

        public function activate()
        {
            global $wpdb;

            // Check if the custom table exists, if not, create it
            $table_name = $wpdb->prefix . 'entrowoo_custom_ordersa'; // Prefix the table name with WordPress prefix
            if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
                // Table does not exist, create it
                $sql = "CREATE TABLE $table_name (
                    id INT NOT NULL AUTO_INCREMENT,
                    order_id INT NOT NULL,
                    codeGenerated VARCHAR(255) NOT NULL,
                    bookingCustomerName VARCHAR(255) NOT NULL,
                    bookingCompanyEmail VARCHAR(255) NOT NULL,
                    bookingCustomerPhone VARCHAR(20) NOT NULL,
                    country VARCHAR(100) NOT NULL,
                    order_status VARCHAR(100) NOT NULL,
                    bookingStartsAtTime DATETIME NOT NULL,
                    PRIMARY KEY (id)
                )";
                require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
                dbDelta($sql);
            }
        }
        public function deactivate()
        {
            global $wpdb;

            // Drop the custom table if it exists
            $table_name = $wpdb->prefix . 'entrowoo_custom_ordersa';
            if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") == $table_name) {
                $wpdb->query("DROP TABLE IF EXISTS $table_name");
            }
        }
    }
}

new Entro_Automatic_Order_Tasks();


function entrowoo_add_plugin_site_link($links, $file)
{
    if (plugin_basename(__FILE__) === $file) {
        $plugin_site_url = 'https://wondwessenhaileinnovates.net'; // Replace with your plugin site URL
        $view_site_link = '<a href="' . esc_url($plugin_site_url) . '" target="_blank">' . __('View Plugin Site', 'entrowoo') . '</a>';
        $links[] = $view_site_link;
    }
    return $links;
}

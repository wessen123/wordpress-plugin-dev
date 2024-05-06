<?php



if (!defined('ABSPATH')) exit; // exit if accessed directly



if (!class_exists('AOTFW_Settings')) {

  /**

   * The plugin settings class

   *

   * Used to create menus, settings and options.

   *

   *

   * @since      1.0.0

   * @package    Automatic_Order_Tasks

   * @subpackage Automatic_Order_Tasks/settings

   * @author     Wondwessen H (wessen333@gmail.com)

   */

  class AOTFW_Settings
  {



    private static $instance;

    private $order_statuses;



    private function __construct()
    {

      $this->add_menu();

      $this->enqueue_settings_scripts();
    }



    public static function get_instance()
    {

      if (!self::$instance) {

        self::$instance = new AOTFW_Settings();
      }

      return self::$instance;
    }





    public function settings_html_callback()
    {

?>

      <div class="content-wrap">

        <div class="content-body">

          <div class="eam-panel" id="eam-status-manager">

            <div class="eam-row">

              <div class="eam-column-sm" id="eam-status-controls">

                <div class="eam-heavy-padded">

                  <h3><?php _e('Select Order Status', 'aotfw-domain') ?></h3>

                  <select name="eam-order-stage" id="eam-order-stage">

                    <?php
                    // Define the order statuses you want to include
                    $order_statuses = array(
                      'wc-completed' => __('Completed', 'woocommerce'),
                      'wc-processing' => __('Processing', 'woocommerce'),
                      'wc-waiting-transport' => __('Waiting Transport', 'woocommerce')
                    );

                    foreach ($order_statuses as $order_status => $order_label) {
                    ?>
                      <option value="<?php echo esc_attr($order_status) ?>"><?php echo esc_html($order_label) ?></option>
                    <?php
                    }
                    ?>
                  </select>



                  
                </div>

                <div class="eam-actions">

                  <?php $log_id = get_option(AOTFW_LOG_ID_OPTIONS_KEY) ?>

                  <a id="view-log-link" target="_blank" download href="<?php echo esc_attr(!empty($log_id) ? wp_get_upload_dir()['baseurl'] . '/' . AOTFW_LOG_FOLDER_PREFIX . $log_id . '/' . 'logfile.txt' : ''); ?>"><?php _e('View Log', 'aotfw-domain') ?></a>

                </div>

              </div>

              <div class="eam-column-lg" id="eam-order-controls">

                <div class="eam-heavy-padded">

                  <div id="eam-order-options"></div>

                </div>

              </div>

            </div>

          </div>

        </div>

      </div>
<div> 
 <?php
// Output notification settings content here
        echo '<h2>Notification Settings</h2>';
       
        // Fetch custom orders
        global $wpdb;
        $table_name = $wpdb->prefix . 'entrowoo_custom_ordersa';
    
        // Select data from the custom table
        $query = "SELECT * FROM $table_name";
        $results = $wpdb->get_results($query, ARRAY_A);
        ?>
        
        <div class="container">
            <h2>Custom Orders</h2>
            <table id="example" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Generated Code</th>
                        <th>Customer Name</th>
                        <th>Customer Email</th>
                        <th>Customer Phone</th>
                        <th>Country Code</th>
                        <th>Order Status</th>
                        <th>Order Date</th>
                        <!-- Add other necessary columns here -->
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($results as $order) : ?>
                        <tr>
                            <td><?php echo @$order['order_id']; ?></td>
                            <td><?php echo @$order['codeGenerated']; ?></td>
                            <td><?php echo @$order['bookingCustomerName']; ?></td>
                            <td><?php echo @$order['bookingCompanyEmail']; ?></td>
                            <td><?php echo @$order['bookingCustomerPhone']; ?></td>
                            <td><?php echo @$order['country']; ?></td>
                            <td><?php echo @$order['order_status']; ?></td>
                            <td><?php echo @$order['bookingStartsAtTime']; ?></td>
                            <!-- Add other necessary cells here -->
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
     
<table id="example" class="display" style="width:100%">
        <thead>
            <tr>
                <th>Name</th>
                <th>Position</th>
                <th>Office</th>
                <th>Extn.</th>
                <th>Start date</th>
                <th>Salary</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Name</th>
                <th>Position</th>
                <th>Office</th>
                <th>Extn.</th>
                <th>Start date</th>
                <th>Salary</th>
            </tr>
        </tfoot>
    </table></div>
      <div id="aotfw-msg-box"></div>

<?php

    }

    public function notification_settings_page_callback()
    {
        // Output notification settings content here
        echo '<h2>Notification Settings</h2>';
    
        // Fetch custom orders
        global $wpdb;
        $table_name = $wpdb->prefix . 'entrowoo_custom_ordersa';
    
        // Select data from the custom table
        $query = "SELECT * FROM $table_name";
        $results = $wpdb->get_results($query, ARRAY_A);
    
        ?>
        <div class="container">
            <h2>Custom Orders</h2>
            <table id="example" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Generated Code</th>
                        <th>Customer Name</th>
                        <th>Customer Email</th>
                        <th>Customer Phone</th>
                        <th>Country Code</th>
                        <th>Order Status</th>
                        <th>Order Date</th>
                        <!-- Add other necessary columns here -->
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($results as $order) : ?>
                        <tr>
                            <td><?php echo @$order['order_id']; ?></td>
                            <td><?php echo @$order['codeGenerated']; ?></td>
                            <td><?php echo @$order['bookingCustomerName']; ?></td>
                            <td><?php echo @$order['bookingCompanyEmail']; ?></td>
                            <td><?php echo @$order['bookingCustomerPhone']; ?></td>
                            <td><?php echo @$order['countryCode']; ?></td>
                            <td><?php echo @$order['orderStatus']; ?></td>
                            <td><?php echo @$order['bookingStartsAtTime']; ?></td>
                            <!-- Add other necessary cells here -->
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php
    }
    

    // Callback function for log submenu
    public function view_logs_page_callback()
    {
      // Output view logs content here
      echo '<h2>View Logs</h2>';
    }





    private function add_menu()
    {
      add_action('admin_menu', function () {
        add_menu_page(
          AOTFW_PLUGIN_NAME,
          AOTFW_PLUGIN_NAME,
          'manage_options',
          'automatic-order-tasks',
          array($this, 'settings_html_callback'),
          'dashicons-admin-tools',
          50
        );
        add_submenu_page('automatic-order-tasks', 'Notification Settings', 'Notification Settings', 'manage_options', 'notification-settings', array($this, 'notification_settings_page_callback'));
        add_submenu_page('automatic-order-tasks', 'View Logs', 'View Logs', 'manage_options', 'view-logs', array($this, 'view_logs_page_callback'));
      });
    }

    private function enqueue_settings_scripts()
    {


      add_action('admin_enqueue_scripts', function () {
        wp_enqueue_style(
          'automatic-order-tasks-settings',
          AOTFW_PLUGIN_URL . 'assets/css/automatic-order-tasks.css',
          array(),
          filemtime(AOTFW_PLUGIN_PATH . 'assets/css/automatic-order-tasks.css')
        );
        // Enqueue other scripts and styles...
        wp_enqueue_script(

          'automatic-order-tasks-settings',

          AOTFW_PLUGIN_URL . 'assets/js/automatic-order-tasks.min.js',

          array('wp-i18n'),

          filemtime(AOTFW_PLUGIN_PATH . 'assets/js/automatic-order-tasks.min.js')

        );
        wp_add_inline_script(

          'automatic-order-tasks-settings',

          'const eam_nonce = "' . wp_create_nonce('eam-nonce') . '"',

          'before'

        );



        // vendors

        wp_enqueue_style(

          'font-awesome-6',

          AOTFW_PLUGIN_URL . 'assets/vendor/font-awesome/css/all.min.css',

          array(),

          filemtime(AOTFW_PLUGIN_PATH . 'assets/vendor/font-awesome/css/all.min.css')

        );



        wp_enqueue_script(

          'quilljs',

          AOTFW_PLUGIN_URL . 'assets/vendor/quill/quill.min.js',

          array('jquery'),

          filemtime(AOTFW_PLUGIN_PATH . 'assets/vendor/quill/quill.min.js')

        );



        wp_enqueue_style(

          'quilljs',

          AOTFW_PLUGIN_URL . 'assets/vendor/quill/quill.snow.css',

          array(),

          filemtime(AOTFW_PLUGIN_PATH . 'assets/vendor/quill/quill.snow.css')

        );



        wp_enqueue_script(

          'select2',

          AOTFW_PLUGIN_URL . 'assets/vendor/select2/js/select2.min.js',

          array('jquery'),

          filemtime(AOTFW_PLUGIN_PATH . 'assets/vendor/select2/js/select2.min.js')

        );



        wp_enqueue_style(

          'select2',

          AOTFW_PLUGIN_URL . 'assets/vendor/select2/css/select2.min.css',

          array(),

          filemtime(AOTFW_PLUGIN_PATH . 'assets/vendor/select2/css/select2.min.css')

        );
      });
    }






    public function action__enqueue_settings_scripts()
    {

      add_action(

        'admin_enqueue_scripts',

        function () {



          wp_enqueue_style(

            'automatic-order-tasks-settings',

            AOTFW_PLUGIN_URL . 'assets/css/automatic-order-tasks.css',

            array(),

            filemtime(AOTFW_PLUGIN_PATH . 'assets/css/automatic-order-tasks.css')

          );



          wp_enqueue_script(

            'automatic-order-tasks-settings',

            AOTFW_PLUGIN_URL . 'assets/js/automatic-order-tasks.min.js',

            array('wp-i18n'),

            filemtime(AOTFW_PLUGIN_PATH . 'assets/js/automatic-order-tasks.min.js')

          );



          wp_set_script_translations('automatic-order-tasks-settings', 'aotfw-domain', AOTFW_PLUGIN_PATH . '/languages/');



          wp_add_inline_script(

            'automatic-order-tasks-settings',

            'const eam_nonce = "' . wp_create_nonce('eam-nonce') . '"',

            'before'

          );



          // vendors

          wp_enqueue_style(

            'font-awesome-6',

            AOTFW_PLUGIN_URL . 'assets/vendor/font-awesome/css/all.min.css',

            array(),

            filemtime(AOTFW_PLUGIN_PATH . 'assets/vendor/font-awesome/css/all.min.css')

          );



          wp_enqueue_script(

            'quilljs',

            AOTFW_PLUGIN_URL . 'assets/vendor/quill/quill.min.js',

            array('jquery'),

            filemtime(AOTFW_PLUGIN_PATH . 'assets/vendor/quill/quill.min.js')

          );



          wp_enqueue_style(

            'quilljs',

            AOTFW_PLUGIN_URL . 'assets/vendor/quill/quill.snow.css',

            array(),

            filemtime(AOTFW_PLUGIN_PATH . 'assets/vendor/quill/quill.snow.css')

          );



          wp_enqueue_script(

            'select2',

            AOTFW_PLUGIN_URL . 'assets/vendor/select2/js/select2.min.js',

            array('jquery'),

            filemtime(AOTFW_PLUGIN_PATH . 'assets/vendor/select2/js/select2.min.js')

          );



          wp_enqueue_style(

            'select2',

            AOTFW_PLUGIN_URL . 'assets/vendor/select2/css/select2.min.css',

            array(),

            filemtime(AOTFW_PLUGIN_PATH . 'assets/vendor/select2/css/select2.min.css')

          );
        }

      );
    }
  }
}

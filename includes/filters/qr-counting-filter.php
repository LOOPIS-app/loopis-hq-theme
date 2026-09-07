<?php
/**
 * Filter which redirects user after counting qr location.
 * 
 * Always included in functions.php
 * 
 * @package LOOPIS_Theme
 * @subpackage Frontend
 */

add_action('template_redirect', function () {
    if ($_SERVER['REQUEST_METHOD'] !== 'GET') return;

    $path = wp_parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    if ($path !== '/qr/') return;

    $post_code = isset($_GET['postnr']) ? (string) $_GET['postnr'] : '';
    $post_code =  preg_replace('/\s+/', '', trim($post_code));
    $post_code = preg_match('/^\d{5}$/', $post_code) ? $post_code : null;
    $info = isset($_GET['info']) ? (string) $_GET['info'] : '';

    if($post_code!=null){
        global $wpdb;
        $table = $wpdb->base_prefix . 'loopis_qr_visits';
        $wpdb->insert($table, 
            [
            'location' => $post_code,
            'info' => $info,
            'timestamp' =>current_time('Y-m-d H:i:s'),
            ]
        );
    }
    wp_safe_redirect( get_home_url( 1, '/' ) );
    exit;
    
});



function loopis_qrs_create() {
    loopis_elog_function_start('loopis_qr_table_create');

    // Access WordPress database object
    global $wpdb;

    // Define table name with WordPress prefix
    $table = $wpdb->base_prefix . 'loopis_qr_visits';
    $charset_collate = $wpdb->get_charset_collate();

    // Include WordPress database upgrade functions
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    
    // Create the table (or update if columns are missing)
    $sql = "CREATE TABLE {$table} (
        id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
        location VARCHAR(50) NOT NULL DEFAULT 'unknown',
        info VARCHAR(50) NOT NULL DEFAULT '',
        timestamp DATETIME NOT NULL,
        PRIMARY KEY (id),
        KEY timestamp_idx (timestamp)
    ) {$charset_collate};";

    dbDelta($sql);

    loopis_elog_function_end_success('loopis_qr_table_create');
}

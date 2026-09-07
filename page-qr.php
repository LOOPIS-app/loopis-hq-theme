<?php
/**
 * Filter which redirects user after counting qr location.
 * 
 * @package LOOPIS_Theme
 * @subpackage Frontend
 */

$location = isset($_GET['loc']) ? (string) $_GET['loc'] : '';

$info = isset($_GET['info']) ? (string) $_GET['info'] : '';

if($location!==''){
    global $wpdb;
    $table = $wpdb->base_prefix . 'loopis_qr_visits';
    $wpdb->insert($table, 
        [
        'location' => $location,
        'info' => $info,
        'timestamp' =>current_time('Y-m-d H:i:s'),
        ],
        ['%s', '%s', '%s']
    );
}

wp_safe_redirect( get_home_url( 1, '/' ) );
exit;

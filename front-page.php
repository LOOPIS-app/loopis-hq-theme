<?php
/**
 * Redirect logged-in users to their primary blog.
 * Users without a valid primary blog go to /start/.
 */

if (
    wp_doing_ajax()
    || ( defined( 'REST_REQUEST' ) && REST_REQUEST )
    || ( defined( 'DOING_CRON' ) && DOING_CRON )
) {
    return;
}

if ( ! is_user_logged_in() ) {
    wp_safe_redirect( get_home_url( 1, '/start/' ) );
    exit;
}

$user_id          = get_current_user_id();
$primary_blog_id  = (int) get_user_meta( $user_id, 'primary_blog', true );

// The main site is not allowed to be a primary blog.
$has_valid_primary_blog =
    $primary_blog_id > 1
    && is_user_member_of_blog( $user_id, $primary_blog_id );

if ( ! $has_valid_primary_blog ) {
    wp_safe_redirect( get_home_url( 1, '/start/' ) );
    exit;
}

// Avoid redirecting repeatedly when already on the primary blog.
if ( get_current_blog_id() === $primary_blog_id ) {
    return;
}

wp_safe_redirect( get_home_url( $primary_blog_id, '/' ) );
exit;
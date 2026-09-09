<?php
/**
 * Password reset mail content.
 *
 * @param string $first_name Recipient first name.
 * @param string $reset_url Reset password URL.
 * @return string HTML mail body.
 */

if (!defined('ABSPATH')) {
    exit;
}

function loopis_password_reset_mail(string $first_name = '', string $reset_url = ''): string {
    if(!function_exists('loopis_mail_template')){
        include_once  LOOPIS_THEME_HQ_DIR . '/includes/functions/mail/loopis-mail-template.php';
    }
    $first_name = sanitize_text_field($first_name);
    $reset_url = esc_url($reset_url);

    $greeting = '' !== $first_name ? 'Hej ' . esc_html($first_name) : 'Hej';
    $ingress =  'Vi fick en begäran om att återställa ditt lösenord.';
    $content = 'Tryck på länken för att välja ett nytt lösenord:<br><a href="' . $reset_url . '">' . esc_html($reset_url) . '</a>';
    $outro = 'Om du inte begärde detta kan du ignorera mailet.';

    return  loopis_mail_template($greeting, $outro, $content, $ingress);
}

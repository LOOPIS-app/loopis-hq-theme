<?php
/**
 * Signup welcome mail content.
 *
 * @param string $first_name Recipient first name.
 * @param string $username Activated username.
 * @param string $password Chosen password.
 * @return string HTML mail body.
 */

if (!defined('ABSPATH')) {
    exit;
}

function loopis_signup_welcome_mail(string $first_name = '', string $username = '', string $password = ''): string {
    if(!function_exists('loopis_mail_template')){
        include_once  LOOPIS_THEME_HQ_DIR . '/includes/functions/mail/loopis-mail-template.php';
    }
    $first_name = sanitize_text_field($first_name);
    $username = sanitize_user($username, true);
    $password = sanitize_text_field($password);

    $greeting = '' !== $first_name ? 'Hej ' . esc_html($first_name) : 'Hej';
    $ingress = '🎉 Ditt konto på LOOPIS.app har nu aktiverats och du kan logga in.';
    $outro ='→ Logga in med din vanliga webbläsare.';
    $content = 'Användarnamn: <strong>' . esc_html($username) . '</strong><br>' . 'Lösenord: <strong>' . esc_html($password) . '</strong>';

    return  loopis_mail_template($greeting, $outro, $content, $ingress);
}

<?php
/**
 * Signup activation mail content.
 *
 * @param string $first_name Recipient first name.
 * @param string $activation_url Activation URL.
 * @return string HTML mail body.
 */

if (!defined('ABSPATH')) {
    exit;
}

function loopis_signup_activation_mail(string $first_name = '', string $activation_url = ''): string {
    if(!function_exists('loopis_mail_template')){
        include_once  LOOPIS_THEME_HQ_DIR . '/includes/functions/mail/loopis-mail-template.php';
    }
    $first_name = sanitize_text_field($first_name);
    $activation_url = esc_url($activation_url);

    $greeting = '' !== $first_name ? 'Hej ' . esc_html($first_name) : 'Hej';
    $content ='Tryck på länken för att bekräfta din e-postadress:<br> <a href="' . $activation_url . '">' . esc_html($activation_url) . '</a>';
    $outro = 'När ditt konto är aktiverat får du ett nytt mail med inloggningsuppgifter.';

    return loopis_mail_template($greeting, $outro, $content);
}

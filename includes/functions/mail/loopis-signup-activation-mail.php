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

require_once get_template_directory() . '/templates/mail/mail-template.php';

function loopis_signup_activation_mail(string $first_name = '', string $activation_url = ''): string {
    
    $first_name = sanitize_text_field($first_name);
    $activation_url = esc_url($activation_url);

    $greeting = '' !== $first_name ? 'Hej ' . esc_html($first_name) : 'Hej';
    $content ='Tryck på länken för att bekräfta din e-postadress:<br> <a href="' . $activation_url . '">' . esc_html($activation_url) . '</a>';
    $outro = 'När ditt konto är aktiverat får du ett nytt mail med inloggningsuppgifter.';

    return loopis_mail_template($greeting, $outro, $content);
}

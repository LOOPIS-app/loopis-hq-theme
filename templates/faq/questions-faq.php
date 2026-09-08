<?php
/**
 * Block with FAQ info below faq post
 *
 * Included in single-faq.php
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
?>

<div class="wrapped">
<h5>⚠ Fler frågor?</h5>
<hr>
<p>→ Titta på sidan <a href="<?php echo esc_url(home_url('/faq/'));?>">Vanliga frågor</a></p>
<?php if ( is_user_logged_in() ) { ?>
<p>→ Skapa en supportfråga i ditt område.</p>
<p>→ Skriv i vår <a rel="noreferrer noopener" href="https://discord.com/channels/1480883243740954626/1480883244449927231" target="_blank">Discord-server</a> eller <a rel="noreferrer noopener" href="https://web.facebook.com/groups/loopis.medlemmar" target="_blank">Facebook-grupp</a></p>
<?php } else { ?>
<p>→ Maila admin på <a rel="noreferrer noopener" href="mailto:admin@loopis.app" target="_blank">admin@loopis.app</a></p>
<?php } ?>
</div>
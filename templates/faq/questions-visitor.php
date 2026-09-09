<?php
/**
 * Block for routing visitor to FAQ on post
 *
 * Included in single.php
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}   
?>

<div class="columns"><div class="column1"><h5>💡 Vanliga frågor</h5></div>
<div class="column2"><a href="<?php echo esc_url(home_url('/faq/'));?>">Alla frågor & svar →</a></div></div>
<hr>
<p><span class="big-link"><a href="<?php echo esc_url(home_url('/faq/hur-funkar-loopis/'));?>">📌 Hur funkar LOOPIS?</a></span></p>
<p><span class="big-link"><a href="<?php echo esc_url(home_url('/faq/var-finns-loopis/'));?>">📌 Var finns LOOPIS?</a></span></p>
<p><span class="big-link"><a href="<?php echo esc_url(home_url('/faq/varfor-medlemskap/'));?>">📌 Varför medlemskap?</a></span></p>

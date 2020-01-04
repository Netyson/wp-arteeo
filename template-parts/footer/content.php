<?php
/**
 * Template part for displaying the footer info
 *
 * @package wp_rig
 */

namespace WP_Rig\WP_Rig;

if ( is_active_sidebar( 'footer-1' ) ) {

	echo '<div id="footer-sidebar" class="footer-sidebar widget-area wp-block-columns alignwide" role="complementary">';
	dynamic_sidebar( 'footer-1' );
	echo '</div>';
	echo '<!-- #footer-sidebar -->';
}

?>

<p class="has-small-font-size">© 2020 Arteeo | <a rel="noreferrer noopener" href="https://dev.arteeo.ch/datenschutzerklaerung" target="_blank">Datenschutzerklärung</a> | <a href="https://dev.arteeo.ch/allgemeine-geschaeftsbedingungen/">AGB</a> | <a href="https://dev.arteeo.ch/impressum/">Impressum</a> </p>



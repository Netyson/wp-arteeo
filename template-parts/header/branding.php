<?php
/**
 * Template part for displaying the header branding
 *
 * @package wp_rig
 */

namespace WP_Rig\WP_Rig;

if ( !is_home() && !is_front_page() || is_paged() ) { 
    echo '<div class="site-branding">';
    echo '<h1>'; wp_title( '' ); echo '</h1>';
    echo '</div>';
    echo ' <!-- .site-branding -->';
} else {
    echo '<div class="site-branding">';
    echo '<h1>ARTEEO</h1>';
    echo '</div>';
    echo '<!-- .site-branding -->';
}
?>
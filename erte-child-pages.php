<?php
/*
Plugin Name: erte child pages
Plugin URI:  https://errasasas
Description: Schow child pages
Version:     
Author:      eRTe
Author URI:  https://erte.net.pl
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
*/


// Register style sheet.
add_action( 'wp_enqueue_scripts', 'register_plugin_styles' );

/**
 * Register style sheet.
 */
function register_plugin_styles() {
	wp_register_style( 'my-plugin', plugins_url( 'erte-child-pages/css/style.css' ) );
	wp_enqueue_style( 'my-plugin' );
}

function erte_schow_childp( $atts ){
	$mypages = get_pages( array( 'child_of' => 221, 'sort_column' => 'post_date', 'sort_order' => 'desc' ) );
	
	
	?>
		<h1>Wspólnoty</h1>
	<?php
	foreach( $mypages as $page ) {		
		$content = $page->post_content;
		if ( ! $content ) // Check for empty page
			continue;

		$content = apply_filters( 'the_content', $content );
	?>
		
		<div class="content-wpolnoty">
			<h3><a href="<?php echo get_page_link( $page->ID ); ?>"><?php echo $page->post_title; ?></a></h3>
			<div class="entry">
			<?php
				// echo $content; 
				// the_excerpt();
				echo apply_filters('the_excerpt', wp_trim_words( $content, 50, "..." ));
				?>
					<div class="read-more">
						<a href="<?php echo get_page_link( $page->ID ); ?>">Czytaj więcej</a>
					</div>
				<?php
			?></div>
		</div>
	<?php
	}	
	

}
add_shortcode( 'child-page', 'erte_schow_childp' );
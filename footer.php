
			<?php do_action( 'content_after' ); ?>
	
		</div><!-- content-main -->
	</div><!-- wrap -->
</div>

<div class="wrap wrap-footer" role="contentinfo">
	<div class="wrap-section-in">

		<?php do_action( 'footer_before' ); ?>

		<?php if ( is_active_sidebar( 'footer-area' ) ) : ?>
		<div id="footer">
			<?php dynamic_sidebar( 'footer-area' ); ?>
		</div>
		<?php endif; ?>

		<?php 
			$footer_menu = wp_nav_menu( array( 
					'theme_location' => 'footer_menu',
					'container_id' => 'nav-footer',
					'fallback_cb' => false,
					'echo' => false,
					'depth' => 1
				) );
			
			printf( 
				'<div class="footer-menu-wrap">
					<strong class="home"><a href="%s">%s</a></strong>
					%s
				</div>',
				home_url(),
				esc_html( get_bloginfo('name') ),
				$footer_menu
			);

			wp_nav_menu( array( 
				'theme_location' => 'social_menu',
				'container_id' => 'nav-social',
				'fallback_cb' => null,
				'depth' => 1
			) );

			if ( ! has_nav_menu( 'social_menu' ) && is_user_logged_in() && isset( $_POST['wp_customize'] ) ) {
				$message = __( 'Note: This area could display links to your social profiles. Add them as custom menu items to "Social menu" area.', 'frank' );

				printf( 
					'<p class="preview-notice">%s</p>', 
					esc_html( $message )
				);
			}
		?>

		<?php do_action( 'footer_after' ); ?>
		
		<?php
			// Add theme credits; can be disabled using the Theme Customizer
			if ( get_theme_mod( 'frank-credits', true ) ) {

				$credits = sprintf( 
					__( 'Powered by <a href="%s">WordPress</a> and <a href="%s" title="Created by Arnab Wahid">Frank</a>.', 'frank' ),
					'http://wordpress.org',
					'http://github.com/arnabwahid/Frank' 
				);

				printf( 
					'<div class="theme-credits"><p>%s</p></div>',
					$credits
				);

			}
		?>
	</div>
</div>

<?php wp_footer(); ?>

<!-- 
	Frank Theme by Arnab Wahid at http://github.com/arnabwahid/Frank
	<?php 
		// Display server performance
		printf( '%s queries in %s seconds on %s', get_num_queries(), timer_stop(0,4), date('r') ); 
	?>  
-->

</body>
</html>

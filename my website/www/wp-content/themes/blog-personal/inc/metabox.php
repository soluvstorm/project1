<?php
/**
 * Script to add Meta Boxes
 *
 * @package Blog_Personal
 */
/**
 * Adds a meta box to the post editing screen
 */
function blog_personal_register_meta() {
    add_meta_box( 'blog_personal_meta', esc_html__( 'Choose Sidebar Layout', 'blog-personal' ), 'blog_personal_meta_callback', array( 'post', 'page' ) );
}
add_action( 'add_meta_boxes', 'blog_personal_register_meta' );

/**
 * Callback for layout option.
 * Shows radio button to choose layout
 *
 * @param array $post current post information.
 */
function blog_personal_meta_callback( $post ) {

	// Use nonce for form verification.
	wp_nonce_field( basename( __FILE__ ), 'blog_personal_meta_nonce' );

	$layout = get_post_meta( $post->ID, 'blog_personal_meta', true );

	// Set default value if metabox returns empty.
	if ( empty( $layout ) ) {
		$layout = 'right';
	}
	?>
		<div class="radio-image-wrapper">
			<input type="radio" name="blog_personal_meta" id="blog-personal-post-layout" style="margin:4px;" value="right" <?php checked( $layout, 'right' ); ?>> <?php esc_html_e( 'Right Sidebar', 'blog-personal' ); ?> <br>
			<input type="radio" name="blog_personal_meta" id="blog-personal-post-layout" style="margin:4px;" value="left" <?php checked( $layout, 'left' ); ?>> <?php esc_html_e( 'Left Sidebar', 'blog-personal' ); ?> <br>
			<input type="radio" name="blog_personal_meta" id="blog-personal-post-layout" style="margin:4px;" value="no-sidebar" <?php checked( $layout, 'no-sidebar' ); ?>> <?php esc_html_e( 'No Sidebar', 'blog-personal' ); ?> <br>
		</div>
		
	<?php
}

/**
 * Saves metaboxes value to database
 *
 * @param int $post_id current post id.
 */
function blog_personal_save_metaboxes( $post_id ) {
	global $post;

	// verify nonce.
	$blog_personal_meta_nonce = '';
	if ( isset( $_POST['blog_personal_meta_nonce'] ) && ! wp_verify_nonce( 'blog_personal_meta_nonce', basename( __FILE__ ) ) ) {
		$blog_personal_meta_nonce = sanitize_text_field( wp_unslash( $_POST['blog_personal_meta_nonce'] ) );
	}
	if ( ! $blog_personal_meta_nonce ) {
		return;
	}

	// Stop wp from clearing custom fields on autosave.
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	// check user role.
	$blog_personal_post_type = '';
	if ( isset( $_POST['post_type'] ) ) {
		$blog_personal_post_type = sanitize_text_field( wp_unslash( $_POST['post_type'] ) );
	}

	if ( in_array( $blog_personal_post_type, array( 'post', 'pages' ), true ) ) {
		if ( ! current_user_can( 'edit_post', $post_id ) || ! current_user_can( 'edit_page', $post_id ) ) {
			return $post_id;
		}
	}

	$blog_personal_meta = '';
	if ( isset( $_POST['blog_personal_meta'] ) ) {
		$blog_personal_meta = sanitize_text_field( wp_unslash( $_POST['blog_personal_meta'] ) );
	}

	// Only save to database if the layout is not default.
	if ( $blog_personal_meta && 'right' !== $blog_personal_meta ) {
		$old_value = $blog_personal_meta;
		$new_value = sanitize_text_field( $old_value );

		if ( $new_value ) {
			update_post_meta( $post_id, 'blog_personal_meta', $new_value );
		}
	} else {
		delete_post_meta( $post_id, 'blog_personal_meta' );
	}
}

add_action( 'save_post', 'blog_personal_save_metaboxes' );
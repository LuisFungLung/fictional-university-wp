<?php
/**
 * PHP file to use when rendering the block type on the server to show on the front end.
 *
 * The following variables are exposed to the file:
 *     $attributes (array): The block attributes.
 *     $content (string): The block default content.
 *     $block (WP_Block): The block instance.
 *
 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
 */

// old code of the plugin
// Generates a unique id for aria-controls.
// $unique_id = wp_unique_id( 'p-' );

// Adds the global state.
// wp_interactivity_state(
// 	'create-block',
// 	array(
// 		'isDark'    => false,
// 		'darkText'  => esc_html__( 'Switch to Light', 'solved-counter' ),
// 		'lightText' => esc_html__( 'Switch to Dark', 'solved-counter' ),
// 		'themeText'	=> esc_html__( 'Switch to Dark', 'solved-counter' ),
// 	)
// );

wp_interactivity_state('create-block', array('solvedCount' => 0, 'grassColor' => 'green'));

?>

<div data-wp-interactive="create-block">
	<p>Questions solved: <strong><span data-wp-text="state.solvedCount" ></span></strong></p>
</div>

<!-- old code of the plugin -->
<!-- <div
	<?php echo get_block_wrapper_attributes(); ?>
	data-wp-interactive="create-block"
	<?php echo wp_interactivity_data_wp_context( array( 'isOpen' => false ) ); ?>
	data-wp-watch="callbacks.logIsOpen"
	data-wp-class--dark-theme="state.isDark"
>

	<button
		data-wp-on--click="actions.toggleTheme"
		data-wp-text="state.themeText"
	></button>

	<button
		data-wp-on--click="actions.toggleOpen"
		data-wp-bind--aria-expanded="context.isOpen"
		aria-controls="<?php echo esc_attr( $unique_id ); ?>"
	>
		<?php esc_html_e( 'Toggle', 'solved-counter' ); ?>
	</button>

	<p
		id="<?php echo esc_attr( $unique_id ); ?>"
		data-wp-bind--hidden="!context.isOpen"
	>
		<?php
			esc_html_e( 'Solved Counter - hello from an interactive block!', 'solved-counter' );
		?>
	</p>
</div> -->

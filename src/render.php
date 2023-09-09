<?php
/**
 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
 */
// require_once '..substar/user.php';

// return '<p>VER 2 You do </p>';
'<p>VER 2 You do </p>'
?>

<p <?php echo get_block_wrapper_attributes(); ?>>
	<?php esc_html_e( 'Subscribestar Manager 4 – hello from a dynamic block!', 'subscribestar-manager' ); ?>
</p>

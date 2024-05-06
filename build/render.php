<?php
/**
 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
 */

$final_render = $attributes['tier'];
$final_render2 = sprintf('<div>%s</div>', $content);
?>

<p <?php echo get_block_wrapper_attributes(); ?>>
<h2><?= $final_render ?></h2>
<h2><?= $final_render2 ?></h2>
	<?php esc_html_e( 'Subscribestar Manager 4 – hello from a dynamic block!', 'subscribestar-manager' ); ?>
</p>

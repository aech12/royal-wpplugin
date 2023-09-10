/**
 * Registers a new block provided a unique name and an object defining its behavior.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-registration/
 */
import { registerBlockType } from '@wordpress/blocks';

/**
 * @see https://www.npmjs.com/package/@wordpress/scripts#using-css
 */
import './style.scss';

import Edit from './edit';
// import Save from './save';
import metadata from './block.json';
import { useBlockProps, InnerBlocks, useInnerBlocksProps } from '@wordpress/block-editor';

registerBlockType(metadata.name, {
	/**
	 * @see ./edit.js
	 */
	// render_callback: render_substar_block,
	render: metadata.render,
	edit() {
		const blockProps = useBlockProps();
		const innerBlocksProps = useInnerBlocksProps()

		return (
			<div {...blockProps}>
			<div {...innerBlocksProps} />
	</div>
		);
	},
	save() {
		const blockProps = useBlockProps.save();

		return (
			<div {...blockProps}>
				<InnerBlocks.Content />
			</div>
		);
	},
	// edit: Edit,
	// save: Save,
	// save: () => null, // Save,
	attributes: metadata.attributes,
	// render_callback: (blockAttributes, innerContent) => {
	// 	console.log("props");
	// 	console.log("props", blockAttributes, innerContent);
	// 	return 'dynamic js';
	// },
});

